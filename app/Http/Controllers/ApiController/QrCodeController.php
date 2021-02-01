<?php 

namespace App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Meeting;
use App\Vacation;
use App\Workshop;

class QrCodeController extends Controller 
{
    public function index(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'qr_code' => 'required | string '
        ]);

        if ($validator->fails()) {
            $api = [
                'state' => false,
                'message' => 'المعلومات غير صحيحة',
                'data' => [],
            ];
            return \response($api);
        }

        $qr_arr = explode('-', $request['qr_code']);
        if (count($qr_arr) !== 3) {
            $api = [
                'state' => false,
                'message' => 'المعلومات غير صحيحة',
                'data' => [],
            ];
            return \response($api);
        }

        $type = $qr_arr[1];

        if(!in_array($type, ['meeting', 'office', 'workshop', 'vacation'])) {
            $api = [
                'state' => false,
                'message' => 'المعلومات غير صحيحة',
                'data' => [],
            ];
            return \response($api);
        }

        $api = [
            'id' => intval($qr_arr[2]),
            'type' => $type
        ];

        return response()->json([
            'state' => true,
            'message' => '',
            'data' => $api
        ]);
    }
}