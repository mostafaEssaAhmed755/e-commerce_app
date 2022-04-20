<?php

namespace Modules\Categories\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\Entities\Scopes\CategoryScope;
use App\Models\Product;
use TypiCMS\NestableTrait;

class Category extends Model
{
    use HasFactory;
    use NestableTrait;

    protected $fillable = ['name', 'slug', 'description', 'parent_id', 'featured', 'menu', 'image'];

    protected $casts = [
        'parent_id' =>  'integer',
        'featured'  =>  'boolean',
        'menu'      =>  'boolean'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $value));
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany(Category::class , 'parent_id');
    }

    protected static function booted()
    {
        static::addGlobalScope(new CategoryScope);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
