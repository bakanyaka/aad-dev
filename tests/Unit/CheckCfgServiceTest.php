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
    public function it_parses_checkcfg_file_and_retrieves_correct_computer_details ()
    {
        $result = $this->checkCfgService->parseFile('2C56DC4B2290');
        $this->assertInstanceOf(\App\Models\Computer::class, $result);
    }
}
