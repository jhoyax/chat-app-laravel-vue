<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait HasUpload
{
    /**
     * Get disk
     */
    public function getDisk()
    {
        return env('FILESYSTEM_DRIVER', 'public');
    }

    /**
     * Store file
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     *
     * @return string|false
     */
    public function storeFile($file): string
    {
        $filePath = $file->storePubliclyAs(
            $this->generatePath(),
            $this->generateName($file)
        );

        return Storage::disk($this->getDisk())->url($filePath);
    }

    /**
     * Generate path and append filename if data is provided.
     *
     * @param  string  $fileName
     *
     * @return string
     */
    public function generatePath($fileName = ''): string
    {
        $path = 'uploads/' .
                date('Y') . '/' .
                date('m') . '/' .
                date('d');

        if ($fileName) {
            $path .= '/' . $fileName;
        }

        return $path;
    }

    /**
     * Generate file name using original name and append number if exist.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     *
     * @return string
     */
    public function generateName($file): string
    {
        $fileName = $file->getClientOriginalName();

        $name = pathinfo($fileName, PATHINFO_FILENAME);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        $counter = 1;
        while (Storage::exists($this->generatePath($fileName))) {
            $fileName = $name . '-' . $counter . '.' . $extension;
            $counter++;
        }

        return $fileName;
    }

    /**
     * Delete file
     *
     * @param  string  $path
     */
    public function deleteFile($path)
    {
        $file = parse_url($path, PHP_URL_PATH);

        if ($this->getDisk() === 'public') {
            $file = ltrim($file, '/storage');
        }

        Storage::disk($this->getDisk())->delete($file);
    }
}
