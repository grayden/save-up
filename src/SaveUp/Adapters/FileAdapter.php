<?php 

namespace SaveUp\Adapters;

class FileAdapter implements SourceAdapter
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function toBackup()
    {
        shell_exec("zip -R save_up_archive.zip $this->path");

        return "save_up_archive.zip";
    }

    public function clean()
    {
        shell_exec("rm save_up_archive.zip");
    }
}
