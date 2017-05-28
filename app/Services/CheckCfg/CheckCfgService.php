<?php


namespace App\Services\CheckCfg;


use App\Models\Computer;
use Carbon\Carbon;
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
        $computer = new Computer();
        $fileContents = mb_convert_encoding($this->disk->get($file), 'UTF-8', 'Windows-1251');
        foreach (explode("\r\n", $fileContents) as $line) {
            if (preg_match('/Record_Date=(.+)/', $line, $matches)) {
                $computer->setDetailsUpdatedAt(Carbon::createFromFormat('d.m.Y', $matches[1]));
            } elseif (preg_match('/MAC_Addr=(.+)/', $line, $matches)) {
                $computer->setMac($matches[1]);
            } elseif (preg_match('/Computer_Name=(.+)/', $line, $matches)) {
                $computer->setName($matches[1]);
            } elseif (preg_match('/System=(.+)/', $line, $matches)) {
                $computer->setOs($matches[1]);
            } elseif (preg_match('/Current_User_Name=(.+)/', $line, $matches)) {
                $computer->setLastLoggedOnUserAccount(strtolower($matches[1]));
            } elseif (preg_match('/CPU=(.+)/', $line, $matches)) {
                $computer->setCpu($matches[1]);
            } elseif (preg_match('/Memory_in_Mb=(.+)/', $line, $matches)) {
                $computer->setMemorySize($matches[1]);
            }
        }

        return $computer;
    }

}