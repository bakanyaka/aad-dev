<?php


namespace App\Services\CheckCfg;


use Illuminate\Filesystem\FilesystemAdapter;

class CheckCfgService
{
    /**
     * @var FilesystemAdapter
     */
    protected $disk;

    /**
     * CheckCfgService constructor.
     * @param FilesystemAdapter $disk
     */
    public function __construct(FilesystemAdapter $disk)
    {
        $this->disk = $disk;
    }

    public function parseAll()
    {
        $files = $this->disk->allFiles();
        return $files;
    }

    public function parseFile($file)
    {
    }
}