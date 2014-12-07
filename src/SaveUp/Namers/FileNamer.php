<?php 

namespace SaveUp\Namers;

class FileNamer implements NamerInterface
{
    private $base;

    function __construct($base)
    {
        $this->base = $base;
    }

    public function name()
    {
        return date("Y-m-d_H-i-s") . "-" . $this->base . ".zip";
    }
}
