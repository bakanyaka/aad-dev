<?php

namespace App\Http\Controllers\Api\Users;
use App\Services\SearchService;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserSearchController extends Controller
{
    protected $search;

    /**
     * UserSearchController constructor.
     * @param SearchService $searchService
     */
    public function __construct(SearchService $searchService)
    {
        $this->search = $searchService;
    }

    public function index(Request $request)
    {
        $searchResult = $this->search->findUser($request->q);
        return fractal()->collection($searchResult)->transformWith(new UserTransformer)->toArray();
    }
}
