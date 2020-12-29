<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\ListSortHelper;
use App\Meeting;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiMeetingController extends Controller
{
    /**
     * GET ALL THE MEETING SPACES
     *
     * @return Response
     */
    public function index(): Response
    {
        $meetings = Meeting::where(['type' => 'meeting'])->get();
        if (!$meetings) return response(['error' => 'Not found !'], 404);
        return response(['meetings' => $meetings]);
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
        if ( !$meeting ) return response(['error' => 'No meeting found !'], 404);
        return response(['meeting' => $meeting]);
    }
}
