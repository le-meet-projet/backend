<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\ListSortHelper;
use App\{Meeting, Workshop , Vacation};
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{



    public $helper ;
    public $data = [];

    public function __construct(){
        
        $this->helper = new \App\Helpers\Api();
        
    }
    
    public function index(Request $request): Response
    {

        
        $data=  [];

        // get the meeting 
        $meetings = Meeting::where(['type' => 'meeting'])->get()->map(function($meeting) {
            $item =  $this->helper->conference($meeting);
            $item['type'] = 'meeting';
            $item['description'] = $item['roomName'];
            $this->result[] = $item;
            return $item;
        });
        

        // get the conference
        $conferences = Meeting::where(['type' => 'conference'])->get()->map(function($meeting)  {
            $item =  $this->helper->conference($meeting);
            $item['type'] = 'office';
            $item['description'] = $item['roomName'];
            $this->result[] = $item;
            return $item;
        });

        // get the workshops
        $workshops = Workshop::all()->map(function($workshop) {
            $item =   $this->helper->vacation($workshop);
            $item['type'] = 'workshop';
            $item['description'] = $item['title'];
            $this->result[] = $item;
            return $item;
        });

        // get the vacation
        $vacations = Vacation::get()->map(function($vacation)  {
            $item =   $this->helper->vacation($vacation);
            $item['type'] = 'vacation';
            $item['description'] = $item['title'];
            $this->result[] = $item;
            return $item;
        });

        
        $limit = $request->limit ;

        $data = ( count($this->result) < $limit  or $limit == 'all' ) ?  $this->result : array_slice($this->result,0, $limit) ;


        $api = [
            'state' => true,
            'message' => '',
            'data' => $data,
        ];
        
        return response($api);

    }

    
    

    public function meetingResponse($type){
        $meetings = Meeting::where(['type' => $type])->get()->map(function($meeting){
            return $this->helper->conference($meeting);
        });

        $api = [
            'state' => false,
            'message' => 'meetings not found!',
            'data' => []
        ];

        if ( count($meetings) > 0 ){
            $api['state'] = true;
            $api['message'] = '';
            $api['data'] = $meetings;
        }

        return response($api);
    }






}
