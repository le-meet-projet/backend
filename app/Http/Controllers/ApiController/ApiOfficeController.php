<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\ListSortHelper;
use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiOfficeController extends Controller
{

    /**
     * GET THE LIST OF THE OFFICE SPACE
     *
     * @return Response
     */
    public function index(): Response
    {
        $offices = Meeting::where(['type' => 'conference'])->get();
        if ( !$offices ) return \response(['error' => 'No office found !'], 404);
        return response(['offices' => $offices]);
    }

    /**
     * SORT THE LIST OF THE OFFICE SPACES
     *
     * @param Request $request
     * @return Response
     */
    public function sort(Request $request): Response
    {
        $offices = ListSortHelper::sortList($request, 'conference');
        return response(['offices' => $offices]);
    }

    /**
     * GET THE REVIEWS FOR AN OFFICE SPACE GIVEN
     *
     * @param int $id
     * @return Response
     */
    public function reviews(int $id): Response
    {
        $reviews = ListSortHelper::getReviews($id, 'conference');
        if ( !$reviews ) return response(['error' => 'No reviews found !']);
        return response(['reviews' => $reviews]);
    }

    /**
     * GET THE OFFICE BY THE ID
     *
     * @param int $id
     * @return Response
     */
    public function getOffice(int $id): Response
    {
        $office = Meeting::where(['type' => 'conference', 'id' => $id])->first();
        if ( !$office ) return response(['error' => 'No office found !']);
        return response(['office' => $office]);
    }

}
