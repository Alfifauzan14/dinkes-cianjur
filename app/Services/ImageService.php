<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Compress, optionally resize, and save an uploaded image file.
     * Converts to WebP when supported for maximum compression efficiency.
     *
     * @param  UploadedFile  $file  The uploaded file
     * @param  string  $destinationPath  Absolute path to destination directory
     * @param  int  $maxWidth  Max width in pixels (default: 1920)
     * @param  int  $quality  Compression quality (1-100, default: 82)
     * @return string The saved filename
     */
    public static function compressAndUpload(
        UploadedFile $file,
        string $destinationPath,
        int $maxWidth = 1920,
        int $quality = 82
    ): string {
        if (! File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        $extension = strtolower($file->getClientOriginalExtension());
        $realPath = $file->getRealPath();

        // If not a standard raster image (e.g., SVG, PDF, CSV), just move it normally
        if (! in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp']) || ! function_exists('imagecreatefromstring')) {
            $filename = time().'_'.Str::random(10).'.'.$extension;
            $file->move($destinationPath, $filename);

            return $filename;
        }

        try {
            $fileContent = file_get_contents($realPath);
            if ($fileContent === false) {
                throw new \RuntimeException('Failed to read image file');
            }

            $sourceImage = @imagecreatefromstring($fileContent);
            if (! $sourceImage) {
                throw new \RuntimeException('Failed to create GD image resource');
            }

            // Fix EXIF orientation for JPEGs from mobile devices
            if (in_array($extension, ['jpg', 'jpeg']) && function_exists('exif_read_data')) {
                $exif = @exif_read_data($realPath);
                if (! empty($exif['Orientation'])) {
                    switch ($exif['Orientation']) {
                        case 3:
                            $sourceImage = imagerotate($sourceImage, 180, 0);
                            break;
                        case 6:
                            $sourceImage = imagerotate($sourceImage, -90, 0);
                            break;
                        case 8:
                            $sourceImage = imagerotate($sourceImage, 90, 0);
                            break;
                    }
                }
            }

            $origWidth = imagesx($sourceImage);
            $origHeight = imagesy($sourceImage);

            // Calculate new dimensions if exceeds max width
            if ($origWidth > $maxWidth && $maxWidth > 0) {
                $newWidth = $maxWidth;
                $newHeight = (int) round(($origHeight / $origWidth) * $maxWidth);
            } else {
                $newWidth = $origWidth;
                $newHeight = $origHeight;
            }

            // Create target canvas
            $targetImage = imagecreatetruecolor($newWidth, $newHeight);

            // Preserve alpha transparency for PNG / WebP / GIF
            imagealphablending($targetImage, false);
            imagesavealpha($targetImage, true);
            $transparent = imagecolorallocatealpha($targetImage, 255, 255, 255, 127);
            imagefilledrectangle($targetImage, 0, 0, $newWidth, $newHeight, $transparent);

            // Resample with high quality
            imagecopyresampled(
                $targetImage,
                $sourceImage,
                0, 0, 0, 0,
                $newWidth,
                $newHeight,
                $origWidth,
                $origHeight
            );

            // Determine output format (prefer WebP for high compression ratio)
            if (function_exists('imagewebp')) {
                $filename = time().'_'.Str::random(10).'.webp';
                $savePath = rtrim($destinationPath, '/\\').DIRECTORY_SEPARATOR.$filename;
                imagewebp($targetImage, $savePath, $quality);
            } else {
                // Fallback to JPEG / PNG if WebP unsupported
                $filename = time().'_'.Str::random(10).'.jpg';
                $savePath = rtrim($destinationPath, '/\\').DIRECTORY_SEPARATOR.$filename;
                imagejpeg($targetImage, $savePath, $quality);
            }

            imagedestroy($sourceImage);
            imagedestroy($targetImage);

            return $filename;
        } catch (\Throwable $e) {
            // Safe fallback: normal upload if GD compression fails
            $filename = time().'_'.Str::random(10).'.'.$extension;
            $file->move($destinationPath, $filename);

            return $filename;
        }
    }
}
