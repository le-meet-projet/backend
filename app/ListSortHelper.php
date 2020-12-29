<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListSortHelper
{
    /**
     * @param Request $request
     * @param string $type
     * @return array|object
     */
    public static function sortList(Request $request, string $type)
    {
        if ($request['option'] === 'best_price') {
            if ($type === 'meeting' || $type === 'conference') {
                return Meeting::where(['type' => $type])->orderBy('price')->get();
            } else if ($type === 'workshop') {
                return Workshop::orderBy('price')->get();
            }
            else {
                return Vacation::orderBy('price')->get();
            }
        }

        if ($request['option'] === 'best_rating') {
            $spaces = SpaceSubSpace::where(['type_space' => $type])->get();
            $ratings = [];

            foreach ($spaces as $space) {
                $sub_rating = $space->ratings->toArray();

                if (count($sub_rating) > 0) {
                    usort($sub_rating, function ($r1, $r2) {
                        return $r1['value'] < $r2['value'];
                    });
                    $ratings[] = $sub_rating[0];
                    usort($ratings, function ($r1, $r2) {
                        return $r1['value'] < $r2['value'];
                    });
                }
            }

            $meetings = null;
            $returnedSpaces = [];
            foreach ($ratings as $rating) {
                $space = SpaceSubSpace::where(['id' => $rating['space_sub_space_id']])->first();
                if ($type === 'meeting' || $type === 'conference') {
                    $returnedSpaces[] = Meeting::where(['id' => $space['space_id'], 'type' => $type])->first();
                }
                else if ( $type === 'workshop' ) {
                    $returnedSpaces[] = Workshop::where(['id' => $space['space_id']])->first();
                }
                else {
                    $returnedSpaces[] = Vacation::where(['id' => $space['space_id']])->first();
                }
            }
            return $returnedSpaces;
        }

        if ($request['option'] === 'most_popular') {
            // GET THE COUNT FOR EACH SPACE MEETING
            $spaceSubSpaces = SpaceSubSpace::where(['type_space' => $type])->get();
            $rating_with_count_id = [];

            foreach ($spaceSubSpaces as $space) {
                $rating_with_count_id[] = [
                    'space_id' => $space['space_id'],
                    'rating_count' => $space->ratings->count()
                ];

                usort($rating_with_count_id, function ($r1, $r2) {
                    return $r1['rating_count'] < $r2['rating_count'];
                });
            }

            $spaces = [];
            foreach ($rating_with_count_id as $rating) {
                if ($type === 'meeting' || $type === 'conference') {
                    $spaces[] = Meeting::find($rating['space_id']);
                }
                elseif ($type === 'workshop')
                {
                    $spaces[] = Workshop::find($rating['space_id']);
                }
                else {
                    $spaces[] = Vacation::find($rating['space_id']);
                }
            }
            return $spaces;
        }
        $user = Auth::guard('api')->user();

        if (!$user) return response(['error' => 'unauthenticated'], 403);

        $spaces = [];
        if ($type === 'meeting' || $type === 'conference') {
            $spaces = Meeting::where(['type' => $type, 'city' => $user['city']])->get();
        } else if ($type == 'workshop') {
            $spaces = Workshop::where(['city' => $user['city']])->get();
        } else {
            $spaces = Vacation::where(['city' => $user['city']])->get();
        }
        return $spaces;
    }

    public static function getReviews(int $id, string $type)
    {
        return SpaceSubSpace::where(['space_id' => $id, 'type_space' => $type])->first();
    }
}
