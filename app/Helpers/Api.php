<?php 

namespace App\Helpers;


class Api {

    public function conference($meeting){
        $thumbnail = ($meeting->thumbnail  != 'NULL' ) ?  env('SPACE_THUMBNAIL').$meeting->thumbnail : env('NO_IMAGE');
        return [
            'id' => $meeting->id,
            'image' =>  $thumbnail,
            'roomName' => $meeting->name,
            'price' => "$meeting->price",
            'rate' => '4.5',
            'location' => $meeting->address,
        ];
    }




}