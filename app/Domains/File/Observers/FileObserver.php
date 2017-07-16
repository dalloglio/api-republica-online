<?php

namespace App\Domains\File\Observers;

use App\Domains\File\File;
use Illuminate\Http\UploadedFile;
use Storage;

class FileObserver
{
    /**
     * @param File $file
     */
    public function creating(File $file)
    {
        $uploadedFile = $file->getAttribute('file');
        if ($uploadedFile instanceof UploadedFile) {
            if ($uploadedFile->isValid()) {
                $path = Storage::disk($file->disk)->put('files', $uploadedFile);
                if (Storage::disk($file->disk)->exists($path)) {
                    $url = Storage::disk($file->disk)->url($path);
                    $size = Storage::disk($file->disk)->size($path);
                    $type = Storage::disk($file->disk)->mimeType($path);
                    $name = $uploadedFile->getClientOriginalName();

                    if (!empty($path)) {
                        $file->setAttribute('file', $path);
                    }
                    if (!empty($url)) {
                        $file->setAttribute('url', $url);
                    }
                    if (!empty($size)) {
                        $file->setAttribute('size', $size);
                    }
                    if (!empty($type)) {
                        $file->setAttribute('type', $type);
                    }
                    if (!empty($name)) {
                        $file->setAttribute('name', $name);
                    }
                }
            }
        }
    }

    /**
     * @param File $file
     */
    public function updating(File $file)
    {
        $uploadedFile = $file->getAttribute('file');
        if ($uploadedFile instanceof UploadedFile) {
            if ($uploadedFile->isValid()) {
                $path = Storage::disk($file->disk)->put('files', $uploadedFile);
                if (Storage::disk($file->disk)->exists($path)) {
                    $url = Storage::disk($file->disk)->url($path);
                    $size = Storage::disk($file->disk)->size($path);
                    $type = Storage::disk($file->disk)->mimeType($path);
                    $name = $uploadedFile->getClientOriginalName();

                    if (!empty($path)) {
                        $file->setAttribute('file', $path);
                    }
                    if (!empty($url)) {
                        $file->setAttribute('url', $url);
                    }
                    if (!empty($size)) {
                        $file->setAttribute('size', $size);
                    }
                    if (!empty($type)) {
                        $file->setAttribute('type', $type);
                    }
                    if (!empty($name)) {
                        $file->setAttribute('name', $name);
                    }

                    $this->deleteFile($file);
                }
            }
        }
    }

    /**
     * @param File $file
     */
    public function deleted(File $file)
    {
        $this->deleteFile($file);
    }

    /**
     * @param File $file
     */
    public function deleteFile(File $file)
    {
        $path = $file->getOriginal('file');
        if (Storage::disk($file->disk)->exists($path)) {
            Storage::disk($file->disk)->delete($path);
        }
    }
}