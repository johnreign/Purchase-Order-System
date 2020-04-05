<?php

namespace App\Http\Controllers\Backend;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use App\Models\Item;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(){

        $po = PurchaseOrder::get();
    	return view('backend.purchase_order.index', compact('po'));
    }

    public function create(){

        $items = Item::get();
        $suppliers = Supplier::get(); 
    	return view('backend.purchase_order.create',compact('suppliers','items'));
    }

    public function store(Request $request){

    	$this->validate($request , [
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
        return redirect('/admin/list')->with('message', 'Purchase Order Added!');
    }

    
}
