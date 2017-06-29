<?php

namespace App\Observers;

use App\Domains\Photo\Photo;
use Illuminate\Http\UploadedFile;
use Storage;

class PhotoObserver
{
    protected $disk = 'public';

    public function creating(Photo $photo)
    {
        $file = $photo->getAttribute('photo');
        if ($file instanceof UploadedFile) {
            if ($file->isValid()) {
                $path = Storage::disk($this->disk)->put('photos', $file);
                if (Storage::disk($this->disk)->exists($path)) {
                    $url = Storage::disk($this->disk)->url($path);
                    $size = Storage::disk($this->disk)->size($path);
                    $type = Storage::disk($this->disk)->mimeType($path);
                    $name = $file->getClientOriginalName();

                    if (!empty($path)) {
                        $photo->setAttribute('photo', $path);
                    }
                    if (!empty($url)) {
                        $photo->setAttribute('url', $url);
                    }
                    if (!empty($size)) {
                        $photo->setAttribute('size', $size);
                    }
                    if (!empty($type)) {
                        $photo->setAttribute('type', $type);
                    }
                    if (!empty($name)) {
                        $photo->setAttribute('name', $name);
                    }
                }
            }
        }
    }
}