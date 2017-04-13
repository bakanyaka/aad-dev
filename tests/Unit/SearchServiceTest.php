<?php

namespace Tests\Unit;

use App\Models\Ad\User;
use App\Repositories\Ad\AdUserRepository;
use App\Services\SearchService;
use Illuminate\Support\Collection;
use Tests\TestCase;

class SearchServiceTest extends TestCase
{
    /**
     * @var \App\Services\SearchService
     */
    protected $searchService;
    protected $fakeUserRepository;

    public function setUp()
    {
        $this->fakeUserRepository = $this->mock(AdUserRepository::class);
        $this->searchService = new SearchService($this->fakeUserRepository);
    }

    /** @test */
    public function it_initiates_search_by_account_in_user_repo_when_findUser_method_is_called_with_user_account_in_query_string()
    {
        $account = 'aka46932';
        $this->fakeUserRepository->shouldReceive('getByAccount')->once()->with($account);
        $this->searchService->findUser($account);
    }

    /** @test */
    public function it_initiates_search_by_name_in_user_repo_when_findUser_method_is_called_with_text_only_in_query_string()
    {
        $nameString = "Пупкин";
        $this->fakeUserRepository->shouldReceive('findByName')->once()->with($nameString);
        $this->searchService->findUser($nameString);
    }

    /** @test */
    public function findUser_method_returns_empty_collection_when_user_is_not_found() {
        $this->fakeUserRepository->shouldReceive('getByAccount')->once()->andReturn(null);
        $searchResult = $this->searchService->findUser('xxx99999');
        $this->assertInstanceOf(Collection::class, $searchResult );
        $this->assertEquals(0,$searchResult->count());
    }

}
