<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use \App\OrderUnit;

class MeetingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'meeting:reminder';
    
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
    private $duration = 61;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Meeting reminder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function createMessage($order)
    {
        switch($order->type){
            case 'meeting':
            case 'office' : $type = 'meeting';
                            break;
            case 'shared_table': $type = 'table';
                                break;
        }
        
        $mapLink = '';
        if(!is_null($order->$type->latitude) && !is_null($order->$type->longitude)){
            $mapLink = 'الموقع 📍 https://www.google.com/maps/@'.$order->$type->latitude.','.$order->$type->longitude.',13z';
        }
        $msg = 'رسالة تذكير بموعد اجتماع : 

        مرحباً '.$order->user->name.' نود تذكيركم بالحجز رقم  '.$order->id.' يوم.'.$order->ar_day.'. في '.$order->$type->brand->name.' قاعة '.$order->$type->name.' الساعة'.explode(' ', $order->order_from)[1].'';
        
        $msg .= $mapLink;
        
        $msg .= '
        نتمنى لكم تجربة رائعة .
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
            if($now->diffInMinutes($order->order_from) < $this->duration){
                $this->createMessage($order);
                sms()
                    ->to($order->user->phone)
                    ->msg($this->msg)
                    ->send();
                \Log::channel('commands')->info('[meeting:reminder] sms sent to ' . $order->user->phone);
                $check++;
            }
        }
        return $check;
    }
}
