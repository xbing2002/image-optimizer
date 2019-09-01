<?php

namespace Spatie\ImageOptimizer\Optimizers;

use Spatie\ImageOptimizer\Optimizer;

abstract class BaseOptimizer implements Optimizer
{
    public $options = [];

    public $imagePath = '';

    public $binaryPath = '';

    public function __construct($options = [])
    {
        $this->setOptions($options);
    }

    public function binaryName()
    {
        return $this->binaryName;
    }

    public function setBinaryPath($binaryPath)
    {
        if (substr($binaryPath, -1) !== DIRECTORY_SEPARATOR) {
            $binaryPath = $binaryPath.DIRECTORY_SEPARATOR;
        }

        $this->binaryPath = $binaryPath;

        return $this;
    }

    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function setOptions(array $options = [])
    {
        $this->options = $options;

        return $this;
    }

    public function getCommand()
    {
        $optionString = implode(' ', $this->options);

        return "\"{$this->binaryPath}{$this->binaryName}\" {$optionString} ".escapeshellarg($this->imagePath);
    }
}
