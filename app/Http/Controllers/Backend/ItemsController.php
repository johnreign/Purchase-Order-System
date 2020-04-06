<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;

class ItemsController extends Controller
{
    public function search(Request $request){

        if(isset($request->keyword))
            $item = Item::where('description', 'LIKE', '%' . $request->keyword . '%')->orWhere('code', 'LIKE', '%' . $request->keyword . '%');


        return $items = $item->orderBy('code')->get();  
    }
}
