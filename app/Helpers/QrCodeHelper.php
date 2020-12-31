<?php

namespace App\Helpers;

use LaravelQRCode\Facades\QRCode;

class QrCodeHelper
{

    public static function storeQrCode($space, $type): string
    {
        $rs = md5(time(). mt_rand(1,100000));
        $rs .= '.png';
        $file = 'qr_codes/' . $rs;
        $qr_code = QrCode::url(env('APP_NAME_QR_CODE') . '-'. $type . '-' . $space->type .$space->id)->setSize(6)->setOutfile($file)->png();
        return $rs;
    }

}
