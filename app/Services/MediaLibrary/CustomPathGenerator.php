<?php

namespace App\Services\MediaLibrary;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator as BasePathGenerator;

class CustomPathGenerator implements BasePathGenerator {
    /*
     * Get the path for the given media, relative to the root storage path.
     */
    public function getPath(Media $media): string {
        return $media->collection_name .'/'. $media->uuid . '/';
    }

    /*
     * Get the path for conversions of the given media, relative to the root storage path.
     */
    public function getPathForConversions(Media $media): string {
        return $media->collection_name .'/'. $media->uuid . '/conversions/';
    }

    /*
     * Get the path for responsive images of the given media, relative to the root storage path.
     */
    public function getPathForResponsiveImages(Media $media): string {
        return $media->collection_name .'/'. $media->uuid . '/responsive-images/';
    }
}