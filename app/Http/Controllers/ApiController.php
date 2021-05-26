<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Helpers\IncrementViewSpaceHelper;
use App\Notification;
use App\Order;
use App\Rating;
use App\Review;
use App\Space;
use App\User;
use App\Meeting;
use App\Vacation;
use App\Workshop;
use App\Table;
use Cartalyst\Stripe\Stripe;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Invitation;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public $helper;

    public function __construct()
    {

        $this->helper = new \App\Helpers\Api();
    }


    public function transformNotification($result)
    {
        $notifications = collect($result);

        return $notifications->map(function ($notification) {

            $ok = [
                'office' => 'space_office',
                'meeting' => 'space_meeting',
                'shared_table' => 'space_shared_table',
            ];
            $in = $notification['order'][$ok[$notification['type']]]['name'];

            $f = \Carbon\Carbon::parse($notification['order_from'])->format('A') == 'PM' ? 'مساءً' : 'صباحاً';
            $n = \Carbon\Carbon::parse($notification['order_from'])->format('g');

            $at = explode('-', $notification['order_time']);
            $text = 'تذكير بالموعد:  لديك اجتماع' . ' ' . $notification['ar_day'] . ' الساعة ' . $n . ' ' . $f . ' في  ' . $in;
            return [
                'id' => $notification['id'],
                'date' => $notification['ar_day'] . ' ',
                'text' => $text,
                'is_invitation' => false,
            ];
        });
    }


    public function notifications(Request $request)
    {

        $notifications = [];
        $result = \App\OrderUnit::with('order', 'order.user', 'order.spaceMeeting', 'order.spaceOffice',  'order.spaceShared_table')->forCurrentUser()->New()->get()->toArray();

        if (!empty($result)) {
            $notifications = $this->transformNotification($result);
        }

        return response()->data($notifications);
    }


    public function rate(Request $request)
    {
        $found = 0;

        if ($found == 1) {
            $data = [
                'id' => '1',
                'type' => 'meeting',
                'image' => 'https://www.businesscomparison.com/uk/wp-content/uploads/2019/10/Startup-business-getting-your-first-office.jpg',
                'description' => 'كيف كانت تجربتك في قاعة “نجد”',
            ];
        } elseif ($found == 0) {
            $data = [];
        }
        return response()->data($data);
    }

    public function getDetails(Request $request)
    {
        $header = $request->header('Authorization');

        $validator = \Validator::make($request->all(), [
            'type' => 'required | string | in:workshop,office,meeting,vacation,shared_table',
            'id'   => 'required | numeric ',
        ]);
        $ratings =  [
            [
                'starsNumber' => '5',
                'rateLabel' => 'ممتاز جداً',
                'name' => 'أحمد المطيري',
                'date' => '2012-02-23',
                'rateText'  => 'أنا ممتن لكم على الخدمات الراقية',
            ],
            [
                'starsNumber' => '5',
                'rateLabel' => 'ممتاز جداً',
                'name' => 'أحمد المطيري',
                'date' => '2012-02-23',
                'rateText'  => 'أنا ممتن لكم على الخدمات الراقية',
            ],
            [
                'starsNumber' => '5',
                'rateLabel' => 'ممتاز جداً',
                'name' => 'أحمد المطيري',
                'date' => '2012-02-23',
                'rateText'  => 'أنا ممتن لكم على الخدمات الراقية',
            ],
            [
                'starsNumber' => '5',
                'rateLabel' => 'ممتاز جداً',
                'name' => 'أحمد المطيري',
                'date' => '2012-02-23',
                'rateText'  => 'أنا ممتن لكم على الخدمات الراقية',
            ],
        ];

        if ($validator->fails()) {
            return response()->error(400, $validator->errors()->first());
        }

        $type = $request->type;
        $id   = $request->id;

        if ($type == 'meeting') {
            $meeting = Meeting::with('favorite')->where('id', $id)->first();
            if ($meeting) {
                IncrementViewSpaceHelper::increment($meeting);
            }
            $favorite = 0;
            if (\Auth::guard('api')->check()) {
                $user_id = \Auth::guard('api')->user()->id;
                $favorite = Favorite::where('type_id', $id)->where('user_id', $user_id)->where('type', 'meeting')->count();
            }

            $arOptions = [
                'wifi' =>  '  - ويفي ',
                'conditioner' => ' - مكيف',
                'blackboard' => ' - سبورة',
                'presentation_tools' => ' - ادوات العروض',
                'speaker' => ' - مكبر صوت',
                'display_screen' => ' - شاشة العرض'
            ];

            $list = [];
            $options = [];
            if (!empty($meeting->options)) {
                $list = json_decode($meeting->options);
                $options = array_map(function ($ok) use ($arOptions) {
                    return $arOptions[$ok];
                }, $list);
            }
            
            $result = $this->helper->conference($meeting);
            $result['favorite']  = $favorite > 0 ? true : false;
            $result['content']   = $meeting->description;
            $result['location']   = $meeting->address;
            $result['latitude']  = $meeting->latitude;
            $result['longitude'] = $meeting->longitude;
            $result['zoom']      = 14.4746;
            $result['ratings']   = [];
            $result['content']   = implode(" \n  ", $options);

            return response()->data($result);
        }



        if ($type == 'office') {

            $meeting = Meeting::with('favorite')->where('id', $id)->first();
            if ($meeting) {
                IncrementViewSpaceHelper::increment($meeting);
            }

            $favorite = 0;
            if (\Auth::guard('api')->check()) {
                $user_id = \Auth::guard('api')->user()->id;
                $favorite = Favorite::where('type_id', $meeting->id)->where('user_id', $user_id)->where('type', 'office')->count();
            }

            $result = $this->helper->conference($meeting);
            $result['favorite']  = ($favorite != 0) ? true : false;
            $result['content']   = $meeting->description;
            $result['location']   = $meeting->address;
            $result['place']      = $result['roomName'];
            $result['latitude']  = $meeting->latitude;
            $result['longitude'] = $meeting->longitude;
            $result['zoom']      = 14.4746;
            $result['ratings']   = [];

            $api = [
                'state' => true,
                'message' => '',
                'data' => $result
            ];
            return \response($api);
        }




        if ($type == 'vacation') {

            $vacation =  Vacation::where('id', $id)->first();
            if ($vacation) {
                IncrementViewSpaceHelper::increment($vacation);
            }

            $favorite = 0;
            if (\Auth::guard('api')->check()) {
                $user_id = \Auth::guard('api')->user()->id;
                $favorite = Favorite::where('type_id', $vacation->id)->where('user_id', $user_id)->where('type', 'vacation')->count();
            }


            $result = $this->helper->vacation($vacation);
            $result['favorite']  = ($favorite != 0) ? true : false;
            $result['content']   = $vacation->description;
            $result['location']   = $vacation->address;
            $result['latitude']  = 30.393496;
            $result['longitude'] = -9.600167;
            $result['zoom']      = 14.4746;
            $result['time']      = 'من: 04:00 م - إلى: 12:00 م';
            $result['date']      = 'الخميس - 5 نوفمبر';
            $result['activityType']      = 'حركي';
            $result['participationType']      = 'فردي';


            $result['ratings']   = [];


            $api = [
                'state' => true,
                'message' => '',
                'data' => $result
            ];
            return \response($api);
        }




        if ($type == 'workshop') {

            $vacation =  Workshop::where('id', $id)->first();
            if ($vacation) {
                IncrementViewSpaceHelper::increment($vacation);
            }


            $favorite = 0;
            if (\Auth::guard('api')->check()) {
                $user_id = \Auth::guard('api')->user()->id;
                $favorite = Favorite::where('type_id', $vacation->id)->where('type', 'workshop')->count();
            }


            $result = $this->helper->vacation($vacation);
            $result['favorite']  = ($favorite != 0) ? true : false;
            $result['content']   = $vacation->description;
            $result['location']   = $vacation->address;
            $result['latitude']  = 30.393496;
            $result['longitude'] = -9.600167;
            $result['zoom']      = 14.4746;
            $result['time']      = 'من: 04:00 م - إلى: 12:00 م';
            $result['date']      = 'الخميس - 5 نوفمبر';
            $result['activityType']      = 'حركي';
            $result['participationType']      = 'فردي';


            $result['ratings']   = [];


            $api = [
                'state' => true,
                'message' => '',
                'data' => $result
            ];
            return \response($api);
        }

        if ($type == 'shared_table') {

            $table   =  Table::with('favorite')->where('id', $id)->first();
            if ($table) {
                IncrementViewSpaceHelper::increment($table);
            }
            $favorite = 0;
            if (\Auth::guard('api')->check()) {
                $user_id = \Auth::guard('api')->user()->id;
                $favorite  = Favorite::where('type_id', $table->id)->where('user_id', $user_id)->where('type', 'shared_table')->count();
            }

            $result                 = $this->helper->table($table);
            $result['favorite']     = ($favorite != 0) ? true : false;
            $result['content']      = $table->description;
            $result['location']     = $table->address;
            $result['latitude']     = $table->latitude;
            $result['longitude']    = $table->longitude;
            $result['zoom']         = 14.4746;
            $result['ratings']      = $ratings;

            $api = [
                'state' => true,
                'message' => '',
                'data' => $result
            ];
            return \response($api);
        }
    }








    // OTP CONFIRMATION
    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function otpConfirm(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'phone' => 'required | string | max:15 | min:10'
        ]);

        if ($validator->fails()) {
            return response()->error(400, $validator->errors()->all()[0]);
        }

        $phone = $request['phone'];

        $generatedOtp =  rand(1111, 9999);

        /*
        $generatedOtp =  123456;
        */

        $apiUrl = "https://mapi.moreify.com/api/v1/sendSms";
        $postParams = array(
            'project' =>        'lemeet1253',
            'password' =>       'a03aa7346dc2f9e6',
            'phonenumber' =>    $phone,
            'message' =>        'Your verification code is ' . $generatedOtp,
        );

        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postParams);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        $response = curl_exec($curl);

        return response()->data(['otp' => $generatedOtp]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function editSpace(int $id)
    {
        return response(['Space' => Space::find($id)]);
    }

    private function validateSpaceOrderRequest(Request $request)
    {
        $request->validate([
            'name' => 'required | string | max:255 | unique:spaces',
            'price' => 'required',
            'address' => 'required | string',
            'description' => 'required | string',
            'map' => 'required | string',
            'thumbnail' => 'required | string | max:255',
            'gallery' => 'required | string | max:255',
            'type' => 'required | string | max:255',
            'date' => 'required | date',
            'time' => 'required | time',
            'capacity' => 'required | string',
        ]);
    }

    /**
     * @param Request $request
     * @param string $spaceType
     * @return array
     */
    private function searchSpace(Request $request, string $spaceType)
    {
    }

    /**
     * @param Request $request
     * @param string $spaceType
     * @return array
     */
    private function sortSpace(Request $request, string $spaceType)
    {
        $request->validate([
            'option' => 'required | string | max:255',
        ]);
        $sort_option = $request['option'];
        $spaces = Space::where(['type' => $spaceType])->get();
        if ($sort_option === 'best_price') $spaces = Space::where(['type' => $spaceType])->orderBy('price', 'asc')->get();
        elseif ($sort_option === 'best_rating') {
            $ratings = [];
            foreach ($spaces as $space) {
                if ($space->ratings()->count() > 0) {
                    $space_rating_array = $space->ratings()->get()->toArray();

                    usort($space_rating_array, function ($sr1, $sr2) {
                        return $sr1['value'] < $sr2['value'];
                    });

                    $ratings[] = [
                        'space_id' => $space->id,
                        'value' => $space_rating_array[0]['value'],
                    ];
                }
            }

            usort($ratings, function ($r1, $r2) {
                return $r1['value'] < $r2['value'];
            });
            $sorted_spaces = [];

            foreach ($ratings as $rating) {
                $sorted_spaces[] = Space::find((int) $rating['space_id']);
            }

            return $sorted_spaces;
        } elseif ($sort_option === 'most_popular') {
            $ratings_with_space_id = [];

            foreach ($spaces as $space) {
                if ($space->ratings()->count())
                    $ratings_with_space_id[] = [
                        'id' => $space->id,
                        'rating_count' => $space->ratings()->count(),
                    ];
            }

            usort($ratings_with_space_id, function ($r1, $r2) {
                return  $r1['rating_count'] < $r2['rating_count'];
            });

            $spaces_meetings_sort = [];

            foreach ($ratings_with_space_id as $item) {
                $spaces_meetings_sort[] = Space::find((int) $item['id']);
            }

            return $spaces_meetings_sort;
        } else {
            $spaces = Space::where(['city' => Auth::user()->city])->get();
        }

        return $spaces;
    }

    public function verify(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required | string',
        ]);

        if ($validator->fails())
        {
            return response()->error(400, $validator->errors()->all()[0]);
        }

        $phone = $request->phone;
        $user = User::where('phone', $phone)->first();
        if ($user) {
            return response()->success('user exist');
        }
        return response()->error(404, 'user not exist');
    }

    public function timeToText($time)
    {
    }


    function findWhere($array, $matching)
    {
        foreach ($array as $item) {
            $is_match = true;
            foreach ($matching as $key => $value) {

                if (is_object($item)) {
                    if (!isset($item->$key)) {
                        $is_match = false;
                        break;
                    }
                } else {
                    if (!isset($item[$key])) {
                        $is_match = false;
                        break;
                    }
                }

                if (is_object($item)) {
                    if ($item->$key != $value) {
                        $is_match = false;
                        break;
                    }
                } else {
                    if ($item[$key] != $value) {
                        $is_match = false;
                        break;
                    }
                }
            }

            if ($is_match) {
                return $item;
            }
        }

        return false;
    }


    public function order_dates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required | numeric',
            'type' => 'required | string | in:meeting,office,vacation,workshop,shared_table'
        ]);
        if ($validator->fails()) {
            return response()->error(400, $validator->errors()->first());
        }

        $type = $request->type;
        $id   = $request->id;

        if ($type == 'meeting' or $type == 'office') {
            if ($type == 'office') {
                $type = 'conference';
            }
            $price = Meeting::where('id', $id)->where('type', $type)->firstorfail()->price;
        }

        if ($type == 'vacation') {
            $price =  Vacation::where('id', $id)->firstorfail()->price;
        }

        if ($type == 'workshop') {
            $price =  Workshop::where('id', $id)->firstorfail()->price;
        }

        if ($type == 'shared_table') {
            $table = Table::with('favorite')->where('id', $id)->firstorfail();
            $price = $table->price;
            $this->capacity = $table->capacity;
        }

        $this->price = $price;
        $this->type  = $type;

        $order_dates_time = array_values($this->load_order_date_time());

        $where  = [
            'type' => $request->type,
            'type_id' => $request->id,
        ];

        if ($type == 'shared_table') {

            $found_chaires =  \DB::table('order_unit')->where($where)->select('unique_id', 'chaire_count')->get()->keyBy('unique_id')->toArray();
            $found_days = array_keys($found_chaires);


            $filtred = [];
            foreach ($order_dates_time as $day) {

                $times = $day['times'];
                unset($day['times']);

                $day_times = array_map(function ($unit) use ($found_days, $found_chaires, $where) {

                    $chairs = $unit['chairs_numbers'];
                    unset($unit['chairs_numbers']);

                    if (in_array($unit['key'], $found_days)) {

                        $where['unique_id'] = $unit['key'];
                        $reserved = \DB::table('order_unit')->where($where)->select('unique_id', 'chaire_count')->sum('chaire_count');

                        $loop =  $this->capacity   -  $reserved;

                        $chairs =  [];
                        for ($i = 1; $i <= $loop; $i++) {
                            $chairs[] = [
                                'number' => "$i",
                                'active' => false,
                                'price' => $this->price,
                                'reserved' =>  false,
                            ];
                        }
                    }
                    $unit['chairs_numbers'] = $chairs;
                    return $unit;
                }, $times);

                $day['times'] = array_values(array_filter($day_times));
                $filtred[] = $day;
            }
        } else {

            $found =  \DB::table('order_unit')->where($where)->select('unique_id')->pluck('unique_id')->toArray();

            $filtred = [];
            foreach ($order_dates_time as $day) {

                $times = $day['times'];
                unset($day['times']);

                $day_times = array_map(function ($unit) use ($found) {
                    if (!in_array($unit['key'], $found)) {
                        return $unit;
                    }
                    return;
                }, $times);

                $day['times'] = array_values(array_filter($day_times));
                $filtred[] = $day;
            }
        }

        return response()->data(['reservation_dates' => $filtred]);

        if ($type == 'shared_table') {
            for ($i = 0; $i < 4; $i++) {

                $reservation_dates['chairs_numbers'][] = [
                    'number' => "$i",
                    'active' => false,

                    'price' => 50.00,
                ];
            }
        }

        $date = now();
        for ($i = 0; $i < 7; $i++) {
            $month = date_format($date, 'M');
            $day = date_format($date, 'D');

            $reservation_times = $this->reservation_times($date, $price);

            if ($type == 'shared_table') {
                $reservation_dates['reservation_dates'][] = [
                    'date' => date_format($date, 'y-m-d'),
                    'day' => $arDays[$day],
                    'month' => date_format($date, 'd') . ' ' . $arMonths[$month],
                    'active' => false,
                    'reserved_chairs' => ['1', '2', '3']
                ];
            } else {
                $reservation_dates['reservation_dates'][] = [
                    'date' => date_format($date, 'y-m-d'),
                    'day' => $arDays[$day],
                    'month' => date_format($date, 'd') . ' ' . $arMonths[$month],
                    'active' => false,
                    'times' => $reservation_times
                ];
            }
            $date->addDays(1);
        }

        return response()->data($reservation_dates);
    }



    public function arabic_month($month)
    {
        $arMonths = [
            'Jan' => 'يناير',
            'Feb' => 'فبراير',
            'Mar' => 'مارس',
            'Apr' => 'ابريل',
            'May' => 'ماي',
            'Jun' => 'يونيو',
            'Jul' => 'يوليوز',
            'Aug' => 'غشت',
            'Sep' => 'شتنبر',
            'Oct' => 'اكتوبر',
            'Nov' => 'نونبر',
            'Dec' => 'دجنبر',
        ];
        return $arMonths[$month];
    }

    public function arabic_day($day)
    {
        $arDays = [
            'Mon' => 'الإتنين',
            'Tue' => 'الثلاثاء',
            'Wed' => 'الاربعاء',
            'Thu' => 'الخميس',
            'Fri' => 'الجمعة',
            'Sat' => 'السبت',
            'Sun' => 'الأحد'
        ];
        return $arDays[$day];
    }


    public function load_order_date_time()
    {



        // dd($chairs);

        $dates = $this->load_dates();
        $result = [];
        foreach ($dates as $day) {
            $date = $day['date'];
            $result[$date] = $day;
            $result[$date]['times'] = $this->load_time($date);
            //$result[$date]['times']['chairs_numbers'] = $chairs;
        }




        return $result;
    }


    public function get_Am_pm($hour)
    {
        return $hour < 12 ? 'ص' : 'م';
    }


    public function load_chaires()
    {
        // count used chaires in this day , in this time 
        /*
        $where = [
            'day' => $day,
            'time' => $day,
            'type' => $day,
            'type_id' => $day,
            'count' => $day,
        ];
        $used_tables = OrderDates::where($where)->sum('count');
        */

        $used_tables = 0;
        $capacity = $this->capacity - $used_tables;

        $chairs = [];
        if ($this->type == 'shared_table') {
            for ($i = 1; $i <= $capacity; $i++) {
                $chairs[] = [
                    'number' => "$i",
                    'active' => false,
                    'price' => $this->price,
                    'reserved' =>  false,
                ];
            }
        }
        return $chairs;
    }

    public function load_time($day)
    {
        $start = Carbon::createFromDate($day)->setHour(9)->minute(0)->minute(0);
        $end = Carbon::createFromDate($day)->setHour(9)->minute(0)->minute(0)->addHours(14);

        $time = [];
        for ($d = $start; $d < $end; $d->addHour()) {
            if (!$d->isPast()) {
                $time[] = $this->prepare_times($d);
            }
        }
        return $time;
    }



    public function load_dates()
    {
        $today = today()->toDateString();
        $nextWeek = today()->addDays(7)->toDateString();
        $period = \Carbon\CarbonPeriod::create($today, $nextWeek)->toArray();

        return array_map(function ($day) {
            $arDay = $this->arabic_day($day->format('D'));
            $arMonth = $this->arabic_month($day->format('M'));
            return [
                'date' => $day->toDateString(),
                'day' =>  $arDay,
                'month' => $day->format('d') . ' ' . $arMonth,
                'active' => false
            ];
        }, $period);
    }


    public function prepare_times2($d)
    {
        $day_string = $d->toDateString();
        $h    = $d->format('H');
        $from = $h;
        $to   = $h + 1;
        $from_text = 'من : ' . $from . ':00' . ' ' . $this->get_Am_pm($from);
        $to_text = 'من : '  . $to . ':00' . ' ' . $this->get_Am_pm($to);
        $timeUnit = [
            'time' => $day_string . '@' . $from . '-' . $to . '@' . $d->toDateTimeString() . '@' . $d->addHour()->toDateTimeString(),
            'from' => $from_text,
            'to' => $to_text,
            'active' => false,
            'price' => $this->price,
            'key'     => $day_string . '@' . $from . '-' . $to,
        ];


        if ($this->type == 'shared_table') {
            $timeUnit['chairs_numbers'] = $this->load_chaires();
        }

        $d->subHour();

        return $timeUnit;
    }



    public function prepare_times($d)
    {
        $day_string = $d->toDateString();
        // ghir hna
        $h    = $d->format('H');
        $x    = $d->format('h');
        $o    = $x + 1;
        $from = $h;
        $to   = $h + 1;
        $from_text = 'من : ' . $x . ':00' . ' ' . $this->get_Am_pm($from);
        $to_text = 'الى  : '  . $o . ':00' . ' ' . $this->get_Am_pm($to);
        $timeUnit = [
            'time' => $day_string . '@' . $from . '-' . $to . '@' . $d->toDateTimeString() . '@' . $d->addHour()->toDateTimeString(),
            'from' => $from_text,
            'to' => $to_text,
            'active' => false,
            'price' => $this->price,
            'key'     => $day_string . '@' . $from . '-' . $to,
        ];


        if ($this->type == 'shared_table') {
            $timeUnit['chairs_numbers'] = $this->load_chaires();
        }

        $d->subHour();

        return $timeUnit;
    }

    public function verify_coupon(Request $request)
    {
        $coupon = $request->coupon;
        $id = $request->id;
        $type = $request->type;

        return response()->success('تم خصم 14 ريال', ['percent' => 30]);
    }


    public function pay_secure()
    {
        return response()->success('paid successfully');
    }


    public function ar_days($key)
    {
        $ok = [
            'Monday' => 'الإثنين',
            'Tuesday' => 'الثلاثاء',
            'Wednesday' => 'الأربعاء',
            'Thursday' => 'الخميس',
            'Friday' => 'الجمعة',
            'Saturday' => 'السبت',
            'Sunday' => ' الأحد',
        ];
        return $ok[$key];
    }












    public function confirm_payment(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'type' => 'required | string | max:255 | in:shared_table,meeting,vacation,workspace',
            'id'   => 'required | numeric',
            'dates' => 'required | string'
        ]);

        if ($validator->fails()) {
            return response()->error(400, $validator->errors()->first());
        }

        $models = [
            'shared_table' => Table::query(),
            'meeting' => Meeting::query(),
            'vacation' => Vacation::query(),
            'workspace' => Workshop::query()
        ];

        $user_id = NULL;
        if (\Auth::guard('api')->check()) {
            $user_id = \Auth::guard('api')->user()->id;
        }
        $order = [
            'user_id' => $user_id,
            'type' => $request->type,
            'type_id' => $request->id,
            'price' => $request->price,
            'promo_code' => $request->coupon
        ];

        $type = $models[$request->type]->whereId($request->id)->with(['brand' => function($query){
            $query->with('user');
        }])->first();

        $brand_email = $type->brand->user->email;

        \DB::table('lemeet_orders')->insert($order);
        $order_id = \DB::getPdo()->lastInsertId();
        $dates = json_decode($request->dates, TRUE);

        if ($request->type != 'shared_table') {
            $times_units = [];

            foreach ($dates as $date) {
                $times_units[] = $this->parse_time_unit($date);
            }
            $times_units = \Arr::flatten($times_units);
            $order_units = [];

            foreach ($times_units as $single_unit) {

                $sv = explode('@', $single_unit);
                $order_date = $sv[0];
                $order_time = $sv[1];

                $sm = explode('-', $sv[1]);
                $order_from_time = $sm[0];
                $order_to_time =  $sm[1];


                $d    = new \DateTime($order_date);

                $ar_day = $this->ar_days($d->format('l'));

                $order_from = $order_date . ' ' . $order_from_time . ':00:00';
                $order_to = $order_date . ' ' . $order_to_time . ':00:00';


                $order_unit = [
                    'user_id' => \Auth::guard('api')->user()->id,
                    'order_from' => $order_from,
                    'order_to' => $order_to,
                    'ar_day' => $ar_day,
                    'unique_id' => $single_unit,
                    'order_id' => $order_id,
                    'order_date' => $order_date,
                    'order_time' => $order_time,
                    'chaire_count' => $request->chaire_count ?? NULL,
                    'type' => $request->type,
                    'type_id' => $request->id,
                ];
                $order_units[] = $order_unit;
            }

            \DB::table('order_unit')->insert($order_units);
        } else {

            $times_units = [];

            foreach ($dates as $date) {
                $times_units[] = $this->parse_shared_table_time_unit($date);
            }

            foreach (array_values($times_units) as $single_unit) {
                foreach ($single_unit as $chaire_unit) {
                    $order_unit = [
                        'unique_id' => $chaire_unit['time'],
                        'order_id' => $order_id,
                        'chaire_count' => $chaire_unit['chaires_count'],
                        'type' => $request->type,
                        'type_id' => $request->id,
                    ];
                    $order_units[] = $order_unit;
                }

            }
            \DB::table('order_unit')->insert($order_units);
        }

        $data = [
            'order' => $order,
            'order_units' => $order_units
        ];

        $email = email()
            ->to($brand_email)
            ->subject('New order')
            ->view('emails.order')
            ->data($data)
            ->send();

        if (!$email->success()) {
            \Log::alert('Email error: '. $email->errors());
        }else{
            \Log::info('Email success: Sent');
        }

        /*
        $cardnumber = $request->cardnumber;
        $month = explode('/', $request->cardexpirydate)[0];
        $year = explode('/', $request->cardexpirydate)[1];
        $name = $request->cardnameonthefront;
        $cvv = $request->cardverificationnumber;

        $booking_id = rand(0, 9999999999);
        $url = "https://test.oppwa.com/v1/payments";
        $data = "entityId=8ac7a4c877afa7980177afff3bd40196" .
            "&amount=" . "50.00" .
            "&currency=SAR" .
            "&paymentBrand=VISA" .
            "&paymentType=DB" .
            "&card.number=" . $cardnumber .
            "&card.holder=" . $name .
            "&card.expiryMonth=" . $month .
            "&card.expiryYear=" . $year .
            "&card.cvv=" . $cvv .
            "&shopperResultUrl=http://test_oppaw.test/" .
            "&testMode=EXTERNAL" .
            "&merchantTransactionId=$booking_id" .
            "&customer.email=akoutoss.med@gmail.com" .
            "&billing.street1=" .
            "&billing.city=agadir" .
            "&billing.state=Souss massa" .
            "&billing.country=MA" .
            "&billing.postcode=80000" .
            "&customer.givenName=layki" .
            "&customer.surname=sama";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGFjN2E0Yzg3N2FmYTc5ODAxNzdhZmZlM2NlMzAxOTJ8S1BteFpIcDI0Ug=='
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseData;



        /*
        $responseData = request();

        echo $responseData;
        exit;
    */
        return response()->data(['reservation_number' => $order_id]);
    }


    public function parse_shared_table_time_unit($date)
    {
        $times = [];
        foreach ($date['times'] as $timing) {
            $count = $timing;
            $parts = explode('@', $timing['time']);
            $xs = [
                'time' => $parts[0] . '@' . $parts[1],
                'chaires_count' => count($timing['chairs_numbers']),
            ];
            $times[] = $xs;
        }
        //  dd(array_values($times));
        return array_values($times);
    }




    public function parse_time_unit($date)
    {
        $times = [];
        foreach ($date['times'] as $timing) {
            $parts = explode('@', $timing['id']);
            $times[] = $parts[0] . '@' . $parts[1];
        }
        return array_values($times);
    }


    public function user_orders_list()
    {

        $orders = \App\OrderLeMeet::with('shared_table', 'meeting')->get()->map(function ($model) {


            $name = '';
            if ($model->type == 'meeting') {
                $name = $model->meeting->name;
                $thumbnail = $model->meeting->thumbnail;
            } elseif ($model->type == 'shared_table') {
                $thumbnail = $model->shared_table->thumbnail;
                $name = $model->shared_table->name;
            }

            if ($thumbnail == NULL) {
                $thumbnail = no_image();
            }
            return [
                'date' =>  $model->created_at->toDateTimeString(),
                'image' => $thumbnail,
                'type' =>  $model->type,
                'description' => $name,
                'price' => $model->price,
                'reservationNumber' =>  $model->id,
                'rate' => '4.3 \\ 5 '
            ];
        })->toArray();

        return response()->data($orders);
    }

    public function user_order()
    {

        $orders = \App\OrderLeMeet::with('shared_table', 'meeting')->latest()->get()->map(function ($model) {
            $thumbnail = no_image();
            $name = '';
            if ($model->type == 'meeting') {
                $name = $model->meeting->name ?? null;
                $thumbnail = $model->meeting->thumbnail ?? null;
            } elseif ($model->type == 'shared_table') {
                $thumbnail = $model->shared_table->thumbnail ?? null;
                $name = $model->shared_table->name ?? null;
            }


            return [
                'date' =>  $model->created_at->toDateTimeString(),
                'image' => $thumbnail ?? '',
                'type' =>  $model->type ?? 'meeting',
                'description' => $name ?? '',
                'price' => $model->price ?? '',
                'reservationNumber' =>  $model->id ?? '',
                'rate' => '4.3 \\ 5 '
            ];
        })->toArray();

        return response()->data($orders);
    }

    public function review(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'review' => 'required | string'
        ]);

        if ($validator->fails())
        {
            return response()->error(400, $validator->errors()->all()[0]);
        }

        $data = [];
        $data['user_id'] = $request->user_id;
        $data['brand_id'] = $request->brand_id;
        $data['rating'] = $request->rating;
        $data['review'] = $request->review;

        \DB::table('reviews')->insert($data);

        return response()->success('review added successfully');
    }

    public function search_data()
    {

        $json['cities'] = [
            ['key' => 'riad', 'value' => 'الرياض'],
            ['key' => 'jaddah', 'value' => 'مكة'],
            ['key' => 'damam', 'value' => 'الدمام']
        ];
        $json['dates'] = [
            ['key' => '1', 'value' => 'الأربعاء - 4 نوفمبر']
        ];
        $json['times'] = [
            ['key' => '1', 'value' => '10:00 ص']
        ];
        $json['capacities'] = [
            ['key' => '3', 'value' => '3 أشخاص'],
            ['key' => '10', 'value' => '10 أشخاص']
        ];
        $json['features'] = [
            ['key' => 'display_screen', 'value' => 'شاشة عرض'],
            ['key' => 'wifi', 'value' => 'واي فاي'],
            ['key' => 'blackboard', 'value' => 'سبورة'],
            ['key' => 'conditioner', 'value' => 'مكيف'],
            ['key' => 'speaker', 'value' => 'مكبر صوت'],
            ['key' => 'presentation_tools', 'value' => 'أدوات العروض'],

        ];
        $json['place_types'] = [
            ['key' => 'sharing_working_space', 'value' => 'مساحات العمل المشتركة فقط'],
            ['key' => 'cafes_only', 'value' => 'الكوفيهات فقط'],
            ['key' => 'restaurants_only', 'value' => 'المطاعم فقط']
        ];

        $api = [
            'state' => true,
            'message' => '',
            'data' => $json
        ];

        return response()->data($api);
    }
}
