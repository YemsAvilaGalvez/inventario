<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'vaucher_type',
        'serie',
        'correlative',
        'date',
        'quote_id',
        'customer_id',
        'warehouse_id',
        'total',
        'observations'
    ];

    //relación uno a muchos inversa
    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    //relación muchos a muchos polimórfica
    public function products()
    {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity', 'price', 'subtotal')->withTimestamps();
    }   
}
