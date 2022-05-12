<?php

namespace Modules\Products\Entities;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
// replace HasFactory to enable Modules structure
use Modules\Core\Traits\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'attributes';

    /**
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'frontend_type', 'is_filterable', 'is_required'
    ];

    /**
     * @var array
     */
    protected $casts  = [
        'is_filterable' =>  'boolean',
        'is_required'   =>  'boolean',
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
