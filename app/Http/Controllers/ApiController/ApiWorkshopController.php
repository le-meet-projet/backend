<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\ListSortHelper;
use App\Workshop;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApiWorkshopController extends Controller
{
    public $helper ;

    public function __construct()
    {
        $this->helper = new \App\Helpers\Api();    
    }

    /**
     * GET ALL THE WORKSHOP SPACES
     *
     * @return Response
     */
    public function index(): Response
    {
        $workshops = Workshop::all()->map(function($workshop){
            return $this->helper->vacation($workshop);
        });

        if ( count($workshops) > 0 ){
            return response()->data($workshops);
        }

        return response()->error(404, 'workshops not found!');
    }

    /**
     * SORT THE WORKSHOP SPACES
     *
     * @param Request $request
     * @return Response
     */
    public function sort(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'option' => 'string | max:255 | in:best_price,best_rating,most_popular'
        ]);

        if ($validator->fails())
        {
            return response()->error(400, $validator->errors()->all()[0]);
        }

        $workshops = ListSortHelper::sortList($request, 'workshop');
        return response()->data($workshops);
    }

    /**
     * GET THE REVIEWS FOR A WORKSHOP
     *
     * @param $id
     * @return Response
     */
    public function reviews($id): Response
    {
        $workshop = Workshop::find($id);
        if ( !$workshop ) return response()->error(404, 'Not found !');
        $reviews = ListSortHelper::getReviews($id, 'workshop');
        if (!$reviews) return response()->error(404, 'Not found !');
        return response()->data(['reviews' => $reviews]);
    }

    /**
     * GET THE WORKSHOP SPACE BY ID
     *
     * @param int $id
     * @return Response
     */
    public function getWorkshop(int $id): Response
    {
        $workshop = Workshop::find($id);
        if ( !$workshop ) return response()->error(404, 'Workshop not found !');
        return response()->data(['workshop' => $workshop]);
    }

}
