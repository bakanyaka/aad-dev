<?php

namespace App\Http\Controllers\Api\Computers;

use Adldap\Laravel\Facades\Adldap;
use App\Services\SearchService;
use App\Transformers\ComputerTransformer;
use App\Http\Controllers\Controller;

class ComputerController extends Controller
{
    /**
     * @var SearchService
     */
    protected $search;

    /**
     * ComputerController constructor.
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->search = $searchService;
    }

    public function show($computer)
    {
        $searchResult = $this->search->findComputer($computer);
        return fractal()->item($searchResult)->transformWith(new ComputerTransformer)->toArray();
    }
}
