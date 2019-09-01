<?php

namespace Spatie\ImageOptimizer;

use InvalidArgumentException;

class Image
{
    protected $pathToImage = '';

    public function __construct($pathToImage)
    {
        if (! file_exists($pathToImage)) {
            throw new InvalidArgumentException("`{$pathToImage}` does not exist");
        }

        $this->pathToImage = $pathToImage;
    }

    public function mime()
    {
        return mime_content_type($this->pathToImage);
    }

    public function path()
    {
        return $this->pathToImage;
    }

    public function extension()
    {
        $extension = pathinfo($this->pathToImage, PATHINFO_EXTENSION);

        return strtolower($extension);
    }
}
