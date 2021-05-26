<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\ListSortHelper;
use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApiMeetingController extends Controller
{

    public $helper;

    public function __construct()
    {

        $this->helper = new \App\Helpers\Api();
    }
    /**
     * GET ALL THE MEETING SPACES
     *
     * @return Response
     */
    public function index(): Response
    {
        $meetings = Meeting::get();
        if (!$meetings) return response()->error(404, 'Not found !');
        return response()->data(['meetings' => $meetings]);
    }

    public function meetingResponse($type)
    {
        $meetings = Meeting::where(['type' => $type])->get()->map(function ($meeting) {
            return $this->helper->conference($meeting);
        });

        if (count($meetings) > 0) {
            return response()->data($meetings);
        }

        return response()->error(404, 'meetings not found!');
    }

    public function conference(Request $request)
    {
        $type = $request->order_by;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $meetings = (new \App\Filter\ConferenceFilter())->init($request);
        
        if($meetings instanceof Response){
            return $meetings;
        };
        
        return response()->data($meetings);
    }


    public function meeting(Request $request)
    {
        \Log::info($request->all());

        $type = $request->order_by;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $meetings = (new \App\Filter\MeetingFilter())->init($request);

        if($meetings instanceof Response){
            return $meetings;
        };
        
        return response()->data($meetings);
        //return $this->meetingResponse('meeting');
    }


    /**
     * SORT THE MEETING SPACE
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

        $meetings = ListSortHelper::sortList($request, 'meeting');
        return response()->data(['meetings' => $meetings]);
    }

    /**
     * GET THE REVIEWS FOR THE MEETING GIVEN
     *
     * @param int $id
     * @return Response
     */
    public function reviews(int $id): Response
    {
        $reviews = ListSortHelper::getReviews($id, 'meeting');
        if (!$reviews) return response()->error(404, 'Not found !');
        return response()->data(['reviews' => $reviews]);
    }

    /**
     * GET THE MEETING BY THE ID
     *
     * @param int $id
     * @return Response
     */
    public function getMeeting(int $id): Response
    {
        $meeting = Meeting::find($id);
        if (!$meeting) return response()->error(404, 'No meeting found !');
        return response()->data(['meeting' => $meeting]);
    }
}
