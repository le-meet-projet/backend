<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\ListSortHelper;
use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
        if ( !$offices ) return response()->error(404, 'No office found !');
        return response()->data(['offices' => $offices]);
    }

    /**
     * SORT THE LIST OF THE OFFICE SPACES
     *
     * @param Request $request
     * @return Response
     */
    public function sort(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'option' => 'string | max:255 | in:best_price,best_rating,most_popular'
        ]);

        if ($validator->fails())
        {
            return response()->error(400, $validator->errors()->all()[0]);
        }

        $offices = ListSortHelper::sortList($request, 'conference');
        return response()->data(['offices' => $offices]);
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
        if ( !$reviews ) return response()->error(404, 'No reviews found !');
        return response()->data(['reviews' => $reviews]);
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
        if ( !$office ) return response()->error(404, 'No office found !');
        return response()->data(['office' => $office]);
    }

}
