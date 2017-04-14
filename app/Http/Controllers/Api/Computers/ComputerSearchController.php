<?php

namespace App\Http\Controllers\api\computers;

use App\Services\SearchService;
use App\Transformers\ComputerTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComputerSearchController extends Controller
{
    protected $search;

    /**
     * ComputerSearchController constructor.
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->search = $searchService;
    }

    public function index(Request $request)
    {
        if ($request->has('username')){
            $searchResult = $this->search->findComputerByUser($request->input('username'));
            return fractal()->collection($searchResult)->transformWith(new ComputerTransformer)->toArray();
        }

    }
}
