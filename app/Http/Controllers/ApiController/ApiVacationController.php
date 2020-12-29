<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\ListSortHelper;
use App\Vacation;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiVacationController extends Controller
{

    /**
     * GET ALL THE VACATION SPACE
     *
     * @return Response
     */
    public function index(): Response
    {
        $vacations = Vacation::all();
        if ( !$vacations ) return response(['error' => 'No vacation found !'], 404);
        return response(['vacations' => $vacations]);
    }

    /**
     * SORT THE VACATION SPACES
     *
     * @param Request $request
     * @return Response
     */
    public function sort(Request $request): Response
    {
        $request->validate([
            'option' => 'string | max:255'
        ]);

        $vacations = ListSortHelper::sortList($request, 'vacation');
        if ( count($vacations) < Vacation::all()->count() ) {
            foreach (Vacation::all() as $vacation) if ( !in_array($vacation, $vacations)) array_push($vacations, $vacation);
        }
        return response(['vacations' => $vacations]);
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
        if ( !$vacation ) return response(['error' => 'No vacation found !'], 404);
        $reviews = ListSortHelper::getReviews($id, 'vacation')->reviews;
        if ( !$reviews ) return response(['reviews' => 'Not found !'], 404);
        return response(['reviews' => $reviews]);
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
        if ( !$vacation ) return response(['error' => 'Not found !'], 404);
        return response(['vacation' => $vacation]);
    }
}
