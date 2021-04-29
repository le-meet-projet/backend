<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\ListSortHelper;
use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        if (!$meetings) return response(['error' => 'Not found !'], 404);
        return response(['meetings' => $meetings]);
    }

    public function meetingResponse($type)
    {
        $meetings = Meeting::where(['type' => $type])->get()->map(function ($meeting) {
            return $this->helper->conference($meeting);
        });

        $api = [
            'state' => false,
            'message' => 'meetings not found!',
            'data' => []
        ];

        if (count($meetings) > 0) {
            $api['state'] = true;
            $api['message'] = '';
            $api['data'] = $meetings;
        }

        return response($api);
    }

    public function conference(Request $request)
    {
        $type = $request->order_by;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $meetings = (new \App\Filter\ConferenceFilter())->init($request);

        $api = [];
        $api['state'] = true;
        $api['message'] = '';
        $api['data'] = $meetings;
        return response()->json($api);

        return $this->meetingResponse('conference');
    }


    public function meeting(Request $request)
    {

        \Log::info($request->all());


        $type = $request->order_by;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $meetings = (new \App\Filter\MeetingFilter())->init($request);

        $api = [];
        $api['state'] = true;
        $api['message'] = '';
        $api['data'] = $meetings;
        return response()->json($api);
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
        $request->validate([
            'option' => 'string | max:255'
        ]);
        $meetings = ListSortHelper::sortList($request, 'meeting');
        return response(['meetings' => $meetings]);
    }

    /**
     * GET THE REVIEWS FOR THE MEETING GIVEN
     *
     * @param int $id
     * @return Response
     */
    public function reviews(int $id): Response
    {
        $spaceSubSpace = ListSortHelper::getReviews($id, 'meeting');
        if (!$spaceSubSpace) return \response(['error' => 'Not found !'], 404);
        return response(['reviews' => $spaceSubSpace->reviews]);
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
        if (!$meeting) return response(['error' => 'No meeting found !'], 404);
        return response(['meeting' => $meeting]);
    }
}
