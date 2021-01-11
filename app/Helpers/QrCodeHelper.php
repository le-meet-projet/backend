<?php

namespace App\Helpers;

use LaravelQRCode\Facades\QRCode;

class QrCodeHelper
{

    public static function storeQrCode($code): string
    {
        $rs = md5(time(). mt_rand(1,100000));
        $rs .= '.png';
        $file = base_path().'/public/qr_codes/' . $rs;
        $qr_code = QrCode::text($code)->setSize(15)->setOutfile($file)->png();
        return $rs;
    }

}
