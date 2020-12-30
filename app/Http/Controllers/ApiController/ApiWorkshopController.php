<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\ListSortHelper;
use App\Workshop;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiWorkshopController extends Controller
{


    
    
    public $helper ;

    public function __construct(){
        
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

        $api = [
            'state' => false,
            'message' => 'workshops not found!',
            'data' => []
        ];

        if ( count($workshops) > 0 ){
            $api['state'] = true;
            $api['message'] = '';
            $api['data'] = $workshops;
        }

        return response($api);


        
    }

    /**
     * SORT THE WORKSHOP SPACES
     *
     * @param Request $request
     * @return Response
     */
    public function sort(Request $request)
    {
        $request->validate([
            'option' => 'string | max:255'
        ]);

        $workshops = ListSortHelper::sortList($request, 'workshop');
        return response($workshops);
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
        if ( !$workshop ) return response(['error' => 'Not found !'], 404);
        $spaceSubSpace = ListSortHelper::getReviews($id, 'workshops');
        if (!$spaceSubSpace) return response(['reviews' => 'Not found !'], 404);
        return response(['reviews' => $spaceSubSpace->reviews]);
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
        if ( !$workshop ) return response(['error' => 'Workshop not found !']);
        return response(['workshop' => $workshop]);
    }

}
