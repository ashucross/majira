<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\Facades\Image;
use File;

class ConvertImagesToWebp extends Command
{
    protected $signature = 'images:convert-webp {path=storage/app/public/products}';
    protected $description = 'Convert already uploaded product images to WebP format';

    public function handle()
    {
        $path = base_path($this->argument('path'));

        $this->info("Converting images in: $path");

        $files = File::allFiles($path);

        foreach ($files as $file) {
            $ext = strtolower($file->getExtension());
            if (! in_array($ext, ['jpg', 'jpeg', 'png'])) {
                continue; // skip non-image files
            }

            $sourcePath = $file->getPathname();
            $webpPath = $file->getPath() . '/' . $file->getFilenameWithoutExtension() . '.webp';

            try {
                $image = Image::make($sourcePath);

                // Resize if too large (optional, adjust width if needed)
                if ($image->width() > 1200) {
                    $image->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                // Save as WebP (quality 75)
                $image->encode('webp', 75)->save($webpPath);

                $this->info("Converted: " . $file->getFilename() . " → " . basename($webpPath));
            } catch (\Exception $e) {
                $this->error("Failed: {$file->getFilename()} - " . $e->getMessage());
            }
        }

        $this->info('✅ All images converted to WebP successfully!');
    }
}
