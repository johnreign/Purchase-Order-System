<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $guarded = [];

    public function scopeActive($query){
        $query->where('is_deleted', '!=', true)
              ->orWhere('is_deleted', null);
    }
    public function scopeLatest($query){
        return $query->orderBy('created_at', 'desc');
    }
    public function createdBy(){
        return $this->belongsTo('App\Models\Auth\User', 'created_by');
    }

    public function supplier(){
        return $this->belongsTo('App\Models\Supplier','supplier_id');
    }
}
