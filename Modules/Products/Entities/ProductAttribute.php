<?php

namespace Modules\Products\Entities;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
// replace HasFactory to enable Modules structure
use Modules\Core\Traits\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'product_attributes';

    /**
     * @var array
     */
    protected $fillable = ['product_id', 'quantity', 'price', 'attribute_value_id', 'attribute_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributesValue()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

}
