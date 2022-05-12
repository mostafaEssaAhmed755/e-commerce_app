<?php

namespace Modules\Core\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadAble
{
    public function uploadOne(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = (!is_null($filename) ? $filename : time() . '_' . rand(1111, 9999)) .'.'. $file->getClientOriginalExtension();

        return $file->storeAs($folder, $name, $disk);
    }

    public function deleteOne($path = null, $disk = 'public')
    {
        Storage::disk($disk)->delete($path);
    }
}
