<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use \App\OrderUnit;

class MeetingEndReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meeting:endreminder';

    /**
     * Variable to hold message
     * 
     * @var string
     */
    private $msg;

    /**
     * Duration before remind order owner.
     * 
     * @var int
     */
    private $duration = 10;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Meeting end reminder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function createMessage($order, $status = null)
    {
        switch($order->type){
            case 'meeting':
            case 'office' : $type = 'meeting';
                            break;
            case 'shared_table': $type = 'table';
                                break;
        }

        $msg = $status == 'busy' ? ': رسالة تذكير انتهاء موعد حجز مع عدم امكانية التمديد: ' : 'رسالة تذكير انتهاء موعد حجز مع امكانية التمديد';

        $msg .= 'مرحباً '.$order->user->name.' نود تذكيركم بأنه تبقى للحجز رقم'.$order->id.' قاعة'.$order->$type->name.' '.$this->duration.' دقائق ،';
        $space_is_busy_next_hour = 'علماً بأن القاعة محجوزة في الساعة '.explode('-', $order->order_time)[1].' لعميل آخر.';
        $you_can_take_it_next_hour = 'في حال الرغبة بتمديد الحجز نرجو الضغط على الرابط التالي :(... الرابط) ';
        $msg .= $status == 'busy' ? $space_is_busy_next_hour : $you_can_take_it_next_hour;
        
        $msg .= '
        شكراً لاستعمالكم LE MEET
        ';

        $this->msg = $msg;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $today = Carbon::now()->toDateString();
        $now = Carbon::now();
        $orders = OrderUnit::where('order_date', $today)->get();
        $check = 0;
        foreach($orders as $order){
            if($now->diffInMinutes($order->order_to) < $this->duration){
                $next_hour_order = OrderUnit::where('order_date', $today)
                    ->where('order_time', 'LIKE', explode('-', $order->order_time)[1].'-%')
                    ->first();
                if($next_hour_order){
                    $this->createMessage($order, 'busy');
                } else{
                    $this->createMessage($order);
                }
                sms()
                    ->to($order->user->phone)
                    ->msg($this->msg)
                    ->send();
                \Log::channel('commands')->info('[meeting:endreminder] sms sent to ' . $order->user->phone);
                $check++;
            }
        }
        return $check;
    }
}
