<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Qrcode
 * @package App\Models
 * @version June 6, 2018, 1:24 pm UTC
 *
 * @property integer user_id
 * @property string website
 * @property string company_name
 * @property string product_name
 * @property string product_url
 * @property string callback_url
 * @property string qrcode_path
 * @property float amount
 * @property boolean status
 */
class QrCode extends Model
{
    use SoftDeletes;

    
 
    
    
}
