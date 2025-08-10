<?php

namespace App\Helpers;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class ImageHelper
{
    /**
     * Check if the uploaded file is a valid image.
     */
    public static function isValidImage(UploadedFile $file): bool
    {
        return in_array($file->getMimeType(), ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
    }

    /**
     * Generate a unique image filename.
     */
    public static function generateUniqueName(UploadedFile $file): string
    {
        return Str::uuid() . '.' . $file->getClientOriginalExtension();
    }

    /**
     * Get image dimensions.
     */
    public static function getDimensions(UploadedFile $file): array
    {
        $image = Image::make($file->getRealPath());
        return ['width' => $image->width(), 'height' => $image->height()];
    }

    /**
     * Get MIME type of the image.
     */
    public static function getMimeType(UploadedFile $file): string
    {
        return $file->getMimeType();
    }

    /**
     * Resize an image and return as Intervention image instance.
     */
    public static function resize(UploadedFile $file, int $width, int $height)
    {
        return Image::make($file->getRealPath())->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }

    /**
     * Create a thumbnail and save it.
     */
    public static function createThumbnail(UploadedFile $file, string $path, int $width = 150, int $height = 150): string
    {
        $filename = 'thumb_' . self::generateUniqueName($file);
        $thumbnail = self::resize($file, $width, $height);
        $thumbnail->save(public_path($path . '/' . $filename));
        return $filename;
    }

    /**
     * Save an uploaded image to the public directory.
     */
    public static function saveImage(UploadedFile $file, string $path): string
    {
        $filename = self::generateUniqueName($file);
        $file->move(public_path($path), $filename);
        return $filename;
    }

    /**
     * Delete an image from the public path.
     */
    public static function deleteImage(string $path): bool
    {
        $fullPath = public_path($path);
        if (file_exists($fullPath)) {
            return unlink($fullPath);
        }
        return false;
    }
}
