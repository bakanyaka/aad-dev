<?php

namespace Tests\Unit;

use App\Services\CheckCfg\CheckCfgService;
use Tests\TestCase;

class CheckCfgServiceTest extends TestCase
{
    /**
     * @var \Illuminate\Filesystem\FilesystemAdapter
     */
    protected $disk;

    /**
     * @var CheckCfgService
     */
    protected $checkCfgService;

    public function setUp()
    {
        parent::setUp();
        $this->disk = \Storage::disk('checkcfg_testing');
        $this->checkCfgService = new CheckCfgService($this->disk);
    }

    /**
     * @test
     */
    public function it_parses_all_checkcfg_files_in_specified_directory ()
    {
        $result = $this->checkCfgService->parseAll();
        $this->assertCount(count($this->disk->files()), $result);
    }

    /**
     * @test
     */
    public function it_parses_checkcfg_file_and_retrieves_computer_details ()
    {
        $computer = $this->checkCfgService->parseFile('2C56DC4B2290');
        $this->assertInstanceOf(\App\Models\Computer::class, $computer);
        $this->assertEquals('2017-05-26', $computer->getDetailsUpdatedAt()->toDateString());
        $this->assertEquals('2C56DC4B2290', $computer->getMac());
        $this->assertEquals('OTD183-28061602', $computer->getName());
        $this->assertEquals('pvk47071', $computer->getLastLoggedOnUserAccount());
        $this->assertEquals('Windows 7 Professional build 7601 64x /Service Pack 1,Русский (Россия)', $computer->getOs());
        $this->assertEquals('4x Intel CPU Core i3-4130 CPU @ 3.40GHz 3390 MHz', $computer->getCpu());
        $this->assertEquals(8062,$computer->getMemorySizeInMb());
        $this->assertEquals(8,$computer->getMemorySizeInGb());
    }
}
