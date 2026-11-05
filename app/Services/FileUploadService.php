<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Service untuk menangani unggah dan penghapusan berkas pada disk public.
 */
class FileUploadService
{
    /**
     * Menyimpan berkas yang diunggah ke sub-direktori disk public.
     */
    public function upload(UploadedFile $file, string $directory): string
    {
        return $file->store($directory, 'public');
    }

    /**
     * Menghapus berkas dari disk public jika berkas tersebut ada.
     */
    public function delete(?string $path): bool
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}
