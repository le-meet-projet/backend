<?php

namespace App\Http\Controllers\ApiController;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\SpaceSubSpace;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiFavoriteController extends Controller
{

    /*
      {
                    'id':'1',
                    'image':'https://.....',
                    'type':'meeting', or office/vacation/workshop
                    'description':'فوكس',
                    'price':'50ريال\\ساعة',
                    'rate':'4.3\\5',
                    'location':'الرياض\n352م',
                },
                */
    public function list() {
        $user_id = \Auth::user()->id;

        $favorites = Favorite::with('meeting','workshop','vacation')->where('user_id', $user_id)->get()->map(function($favorite) {
           return $this->prepareFavoritesForApi($favorite, $favorite->type);
        })->toArray();

        return response()->json([
            'state' => true,
            'message' => '',
            'data' => $favorites
        ]);
    }


    public function prepareFavoritesForApi($favorite,$type){

       
        
        if($type == 'meeting' || $type == 'office'){
            $thumbnail = ($favorite->meeting->thumbnail  != 'NULL' and $favorite->meeting->thumbnail  != NULL) ?  env('SPACE_THUMBNAIL').$favorite->meeting->thumbnail : env('NO_IMAGE');

            $data = [
                'image'=> $thumbnail,
                'description'=> $favorite->meeting->description,
                'price'=> $favorite->meeting->price,
                'rate'=> $favorite->meeting->rate,
                'location'=> $favorite->meeting->address,
            ];
        }
        if($type == 'vacation' ){
            $data = [
                'image'=> $thumbnail,
                'description'=> $favorite->meeting->description,
                'price'=> $favorite->meeting->price,
                'rate'=> $favorite->meeting->rate,
                'location'=> $favorite->meeting->address,
            ];
        }
        if($type == 'workshop'){
            $data = [
                'image'=> $thumbnail,
                'description'=> $favorite->meeting->description,
                'price'=> $favorite->meeting->price,
                'rate'=> $favorite->meeting->rate,
                'location'=> $favorite->meeting->address,
            ];
        }

        $data['id'] = $favorite->id;
        $data['type'] = $favorite->type;

       
        return $data;
    }
    
    public function add_to_favorite(Request $request) {

        $types = ['workshop','office','meeting','vacation'];
           
        $validator = \Validator::make($request->all(), [
            'type' => 'required|in:' . implode(',', $types),
            'type_id' => 'required | numeric ',
        ]);
       
       if ($validator->fails()) {
           $api = [
               'state' => false,
               'message' => 'المعلومات غير صحيحة',
               'data' => [],
           ];
           return \response($api);
       }

       
        $count = Favorite::where('type',$request->type)->where('type_id',$request->type_id)->where('user_id', Auth::user()->id)->count();

        if($count == 0 ){
            $favorite = new Favorite();
            $favorite->type = $request->type;
            $favorite->type_id = $request->type_id;
            $favorite->user_id =  Auth::user()->id;
            $saved = $favorite->save();   

            if($saved)  {
                $api = [
                    'state' => true,
                    'message' => '',
                    'data' => true
                ];
                return \response($api);
            }
        }



        $api = [
            'state' => false,
            'message' => 'حصل خطأ ما ',
            'data' => false
        ];
        return \response($api);
    }

    

    public function remove_many_from_favorite(Request $request){
     
        $ids = json_decode($request->listIdsFavorites);
        $favorites = Favorite::find($ids);
        foreach($favorites as $item){
            $item->delete();
        }
        

        $api = [
            'state' => true,
            'message' => '',
            'data' => [],
        ];
        return \response($api);
    }



    public function remove_from_favorite(Request $request){

        $types = ['workshop','office','meeting','vacation'];
           
        $validator = \Validator::make($request->all(), [
            'type' => 'required|in:' . implode(',', $types),
            'type_id' => 'required | numeric ',
        ]);
       
       if ($validator->fails()) {
           $api = [
               'state' => false,
               'message' => 'المعلومات غير صحيحة',
               'data' => [],
           ];
           return \response($api);
       }

       $user_id = \Auth::user()->id;
       $type   = $request->type;
       $type_id = $request->type_id;

       $query = Favorite::where('type',$type)->where('type_id',$type_id)->where('user_id', $user_id);
       $count = $query->count();
       
       
       if($count != 0 ){
           $favorite = $query->first();
           $api = [
                'state' => true,
                'message' => '',
                'data' => [
                    'id' => $favorite->id,
                    'favorite' => $favorite->type
                ]
            ];
            $favorite->delete();
            return \response($api);
       }
       
        $api = [
            'state' => false,
            'message' => 'حصل خطأ ما ',
            'data' => false
        ];
        return \response($api);
    }




    public function add(int $space_id)
    {
        $favorite = Favorite::where(['space_id' => $space_id])->first();
        if ( $favorite ) return response(['message' => 'The space is already in your favorites !']);
        $space = SpaceSubSpace::find($space_id);
        if ( !$space ) return response(['error' => 'space not found !'], 404);
        $user = Auth::guard('api')->user();
        $favorite = new Favorite();
        $favorite->user_id = $user->id;
        $favorite->space_id = $space_id;
        $favorite->save();
        return response(['success' => 'The favorite was added with success !']);
    }

    public function delete(int $id)
    {
        $user = Auth::guard('api')->user();
        $favorite = Favorite::where(['user_id' => $user->id, 'id' => $id])->first();
        if ( !$favorite ) return response(['error' => 'favorite not found !'], 404);
        $favorite->delete();
        return response(['success' => 'The favorite was deleted with success !']);
    }

}
