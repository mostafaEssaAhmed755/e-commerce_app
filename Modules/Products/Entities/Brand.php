<?php

namespace Modules\Products\Entities;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
// replace HasFactory to enable Modules structure
use Modules\Core\Traits\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'brands';

    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'logo'];

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] =  strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $value));
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
