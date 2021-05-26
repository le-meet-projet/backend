<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\ListSortHelper;
use App\Vacation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApiVacationController extends Controller
{


    
    public $helper ;

    public function __construct(){
        
        $this->helper = new \App\Helpers\Api();
        
    }

    /**
     * GET ALL THE VACATION SPACE
     *
     * @return Response
     */
    public function index(): Response
    {
        $vacations = Vacation::all()->map(function($vacation){
            return $this->helper->vacation($vacation);
        });

        if ( count($vacations) > 0 ){
            return response()->data($vacations);
        }

        return response()->error(404, 'vacations not found!');
    }

    /**
     * SORT THE VACATION SPACES
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

        $vacations = ListSortHelper::sortList($request, 'vacation');
        if ( count($vacations) < Vacation::all()->count() ) {
            foreach (Vacation::all() as $vacation) if ( !in_array($vacation, $vacations)) array_push($vacations, $vacation);
        }
        return response()->data(['vacations' => $vacations]);
    }

    /**
     * GET THE REVIEWS FOR THE VACATION SPACE
     *
     * @param int $id
     * @return Response
     */
    public function reviews(int $id): Response
    {
        $vacation = Vacation::find($id);
        if ( !$vacation ) return response()->error(404, 'No vacation found !');
        $reviews = ListSortHelper::getReviews($id, 'vacation');
        if ( !$reviews ) return response()->error(404, 'Not found !');
        return response()->data(['reviews' => $reviews]);
    }

    /**
     * GET THE VACATION BY ID
     *
     * @param int $id
     * @return Response
     */
    public function getVacation(int $id): Response
    {
        $vacation = Vacation::find($id);
        if ( !$vacation ) return response()->error(404, 'Not found !');
        return response()->data(['vacation' => $vacation]);
    }
}
