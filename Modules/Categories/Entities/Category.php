<?php

namespace Modules\Categories\Entities;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
// replace HasFactory to enable Modules structure
use Modules\Core\Traits\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Categories\Entities\Scopes\CategoryScope;
use Modules\Products\Entities\Product;
use TypiCMS\NestableTrait;

class Category extends Model
{
    use HasFactory;
    use NestableTrait;

    protected $moduleName = 'Categories';

    protected $table = 'categories';

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
        //static::addGlobalScope(new CategoryScope);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeParent($query)
    {
        $query->with(['parent' => function($q){
            $q->select(['id','name']);
        }]);
    }

}
