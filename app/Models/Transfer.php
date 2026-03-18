<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'type',
        'serie',
        'correlative',
        'date',
        'total',
        'observations',
        'origin_warehouse_id',
        'destination_warehouse_id',
    ];

    //Relación uno a muchos inversa
    public function originWarehouse(){
        return $this->belongsTo(Warehouse::class, 'origin_warehouse_id');
    }

    //Relación uno a muchos inversa
    public function destinationWarehouse(){
        return $this->belongsTo(Warehouse::class, 'destination_warehouse_id');
    }

    //relación muchos a muchos polimórfica
    public function products()
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity', 'price', 'subtotal')->withTimestamps();
    }

}
