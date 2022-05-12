<?php

namespace Modules\Core\Entities;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
// replace HasFactory to enable Modules structure
use Modules\Core\Traits\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = ['key', 'value'];

    public static function get($key)
    {
        $setting = new self();
        $entry = $setting::where('key',$key)->first();
        if (!$entry) {
            return;
        }
        return $entry->value;
    }
    public static function set($key, $value = null)
    {
        $setting = new self();
        $entry = $setting::where('key',$key)->firstOrFail();
        $entry->value = $value;
        $entry->saveOrFail();
        Config::set('key', $value);
        if (Config::get($key) == $value) {
            return true;
        }
        return false;
    }
}
