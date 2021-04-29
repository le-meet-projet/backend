<?php

namespace App\Helpers;

use App\Favorite;

class SpaceClientHelper {

    /**
     * Get the infos spaces especialy for the client `Hide sensible informations`
     */
    public static function getSapce($spaces, $type) {
        $results = [];
        foreach ($spaces as $space) {
            $favorite = 0;
            if (\Auth::guard('api')->check()) {
                $user_id = \Auth::guard('api')->user()->id;
                $favorite = Favorite::where('type_id', $space->id)->where('user_id', $user_id)->where('type', 'meeting')->count();
            }
            $helper = new Api();
            if ($type === 'meeting' or $type === 'conference') 
                $result = $helper->conference($space); 
            else if ($type === 'workshop' or $type === 'vacation')
                $result = $helper->vacation($space);
            else if ($type === 'shared_table')
                $result = $helper->table($space);
            else if ($type === 'shared_table')
            $result['favorite']  = ($favorite != 0) ? true : false;
            $result['content']   = $space->description;
            $result['location']   = $space->address;
            $result['latitude']  = $space->latitude;
            $result['longitude'] = $space->longitude;
            $result['zoom']      = 14.4746;
            $result['ratings']   = [];

            $results[] = $result;
        }
        return $results;
    }

}