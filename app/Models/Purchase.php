<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'vaucher_type',
        'serie',
        'correlative',
        'date',
        'purchase_order_id',
        'supplier_id',
        'warehouse_id',
        'total',
        'observations',
    ];

    //relación uno a muchos inversa
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    //relación muchos a muchos polimórfica
    public function products()
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity', 'price', 'subtotal')->withTimestamps();
    }

}
