<?php
namespace Spatie\ImageOptimizer\Optimizers;

use Spatie\ImageOptimizer\Image;
use Tinify\Exception;

class Tinypng extends BaseOptimizer
{

    public $binaryName = 'tinypng';
    public function canHandle(Image $image)
    {
        return $image->mime() === 'image/jpeg' || $image->mime() === 'image/png';
    }

    public function getCommand()
    {
        if(empty($this->options)){
            throw new Exception("Need to set the tinypng api key");
        }
        $key=array_rand($this->options,1);

        \Tinify\setKey($this->options[$key]);
        $count=\Tinify\getCompressionCount();
        if($count>=500){
            array_splice($this->options,$key,1);
            $this->getCommand();
        }
        $source = \Tinify\fromFile($this->imagePath);
        $source->toFile($this->imagePath);
        return true;

    }
}