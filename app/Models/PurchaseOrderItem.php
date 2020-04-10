<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
	protected $table = 'purchase_order_items';

    protected $guarded = [];

    public function item(){
        return $this->belongsTo(Item::class,'item_id','id');
    }
    public function purchase_order(){
        return $this->belongsTo(PurchaseOrder::class,'id');
    }


}
