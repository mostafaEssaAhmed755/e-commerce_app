<?php

namespace Modules\Orders\Entities;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
// replace HasFactory to enable Modules structure
use Modules\Core\Traits\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
