<?php

namespace App\Http\Controllers\Backend;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\PurchaseOrderItem;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(){

        $po = PurchaseOrder::get();
    	return view('backend.purchase_order.index', compact('po'));
    }

    public function create(){

        $suppliers = Supplier::get(); 
    	return view('backend.purchase_order.create',compact('suppliers'));
    }

    public function store(Request $request){

        $request->validate([
            'lot_number' => 'required',
            'po_number' => 'required',
            'supplier_id' => 'required',
        ]);

        $po = new PurchaseOrder();
        $po->lot_number = $request->lot_number;
        $po->po_number = $request->po_number;
        $po->supplier_id = $request->supplier_id;
        $po->total_amount = $request->total_amount;
        $po->order_date = date('Y-m-d', strtotime($request->order_date));
        $po->save();

        if (count($request->items) > 0) {
            foreach ($request->items as $i => $item) {
                $po_item = new PurchaseOrderItem;
                $po_item->purchase_order_id = $po->id;
                $po_item->item_id = $item['item_id'];
                $po_item->quantity = $item['quantity'];
                $po_item->price = $item['price'];
                $po_item->amount = $item['amount'];
                $po_item->save();
            }
        }

        return redirect('/admin/list')->with('message', 'Purchase Order Added!');
    }

    public function show($id){

        $po = PurchaseOrder::where('id', $id)->first();
        return view ('backend.purchase_order.show',compact('po'));


    }

    public function edit($id){
        $po = PurchaseOrder::with('purchase_order_items')->where('id', $id)->first();
        $suppliers = Supplier::where('id', $id)->first(); 
        return view ('backend.purchase_order.edit',compact('po','suppliers'));   

    }

    public function update(Request $request, $id){
        $request->validate([
            'lot_number' => 'required',
            'po_number' => 'required',
            'supplier_id' => 'required',
        ]);

        $po = PurchaseOrder::find($id);
        $po->lot_number = $request->lot_number;
        $po->po_number = $request->po_number;
        $po->supplier_id = $request->supplier_id;
        $po->total_amount = $request->total_amount;
        $po->order_date = date('Y-m-d', strtotime($request->order_date));
        $po->save();

        if (count($request->items) > 0) {
            foreach ($request->items as $i => $item) {
                if (isset($item['id'])) {
                    $po_item = PurchaseOrderItem::find($item['id']);
                }else {
                    $po_item = new PurchaseOrderItem;
                }
                $po_item->purchase_order_id = $po->id;
                $po_item->item_id = $item['item_id'];
                $po_item->quantity = $item['quantity'];
                $po_item->price = $item['price'];
                $po_item->amount = $item['amount'];
                $po_item->save();
            }
        }

        return redirect()->back()->with('message', 'Purchase Order Updated!');

    }


    public function destroy($id){

      $po = PurchaseOrder::findorFail($id);
      $po->delete();

      return redirect('/admin/list')->with('message', 'Purchase Order Deleted!');
    }
    
}
