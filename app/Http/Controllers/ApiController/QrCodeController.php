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
            return response()->error(400, 'المعلومات غير صحيحة');
        }

        $qr_arr = explode('-', $request['qr_code']);
        if (count($qr_arr) !== 3) {
            return response()->error(400, 'المعلومات غير صحيحة');
        }

        $type = $qr_arr[1];

        if(!in_array($type, ['meeting', 'office', 'workshop', 'vacation'])) {
            return response()->error(400, 'المعلومات غير صحيحة');
        }

        $data = [
            'id' => intval($qr_arr[2]),
            'type' => $type
        ];

        return response()->data($data);
    }
}