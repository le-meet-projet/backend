<?php 

namespace App\Helpers;

class Api {

    public function conference($meeting) {
        $thumbnail = ($meeting->thumbnail  != 'NULL') ? env('SPACE_THUMBNAIL') . $meeting->thumbnail : env('NO_IMAGE');
        return [
            'id' => $meeting->id,
            'image' =>  $thumbnail,
            'roomName' => $meeting->name,
            'price' => "$meeting->price",
            'rate' => '4.5',
            'location' => $meeting->address,
            'latitude' => $meeting->latitude,
            'longitude' => $meeting->longitude,
            'period' => $meeting->period,
            'qr_code' => env('QR_CODE_URL') . $meeting->qrcode
        ];
    }

    public function vacation($vacation){
        $thumbnail = ($vacation->thumbnail  != 'NULL' ) ? env('SPACE_THUMBNAIL').$vacation->thumbnail : env('NO_IMAGE');
        return [
            'id' => $vacation->id,
            'image' =>  $thumbnail,
            'title' => $vacation->name,
            'price' => "$vacation->price",
            'rate' => '4.5',
            'location' => $vacation->address,
            'latitude' => $vacation->latitude,
            'longitude' => $vacation->longitude,
            'period' => $vacation->period,
            'qr_code' => env('QR_CODE_URL') . $vacation->qrcode
        ];
    }



    public function singleMeeting($meeting){
        $thumbnail = ($meeting->thumbnail  != 'NULL' ) ?  env('SPACE_THUMBNAIL').$meeting->thumbnail : env('NO_IMAGE');
        return [
            'id' => $meeting->id,
            'image' =>  $thumbnail,
            'roomName' => $meeting->name,
            'price' => $meeting->price,
            'rate' => '4.5',
            'location' => $meeting->address,
            'latitude' => $meeting->latitude,
            'longitude' => $meeting->longitude,
            'period' => $meeting->period,
            'qr_code' => env('QR_CODE_URL') . $meeting->qrcode
        ];
    }



}