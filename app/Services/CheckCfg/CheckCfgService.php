<?php


namespace App\Services\CheckCfg;


use App\Models\Computer;
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
        $files = $this->disk->files();
        return $files;
    }

    public function parseFile($file) : Computer
    {
        $computerDetails = new Computer();
        $fileContents = $this->disk->get($file);
        foreach (explode("\r\n", $fileContents) as $line) {
/*            if (preg_match('/Record_Date=(.+)/', $line, $matches)) {

            }*/
        }
        return $computerDetails;
    }

}