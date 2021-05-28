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
    public function list()
    {
        $user_id = \Auth::user()->id;

        $favorites = Favorite::with('meeting', 'workshop', 'vacation')->where('user_id', $user_id)->get()->map(function ($favorite) {
            return $this->prepareFavoritesForApi($favorite, $favorite->type);
        })->toArray();


        return response()->data($favorites);
    }


    public function prepareFavoritesForApi($favorite, $type)
    {
        if ($type == 'meeting' || $type == 'office') {

            $data = [
                'id_favorite' => $favorite->id,
                'image' => $favorite->meeting->thumbnail != null ?  env('SPACE_THUMBNAIL') . $favorite->meeting->thumbnail : no_image(),
                'description' => $favorite->meeting->name,
                'price' => $favorite->meeting->price,
                'rate' => $favorite->meeting->rate,
                'location' => $favorite->meeting->address,
            ];

            $data['id'] = $favorite->meeting->id;
        }
        if ($type == 'vacation') {
            $data = [
                'id_favorite' => $favorite->id,
                'image' => $favorite->vacation->thumbnail != null ?  env('SPACE_THUMBNAIL') . $favorite->vacation->thumbnail : no_image(),
                'description' => $favorite->vacation->name,
                'price' => $favorite->vacation->price,
                'rate' => $favorite->vacation->rate,
                'location' => $favorite->vacation->address,
            ];
            $data['id'] = $favorite->vacation->id;
        }
        if ($type == 'workshop') {
            $data = [
                'id_favorite' => $favorite->id,
                'image' => $favorite->workshop->thumbnail != null ?  env('SPACE_THUMBNAIL') . $favorite->workshop->thumbnail : no_image(),
                'description' => $favorite->workshop->name,
                'price' => $favorite->workshop->price,
                'rate' => $favorite->workshop->rate,
                'location' => $favorite->workshop->address,
            ];
            $data['id'] = $favorite->workshop->id;
        }


        if ($type == 'shared_table') {
            $data = [
                'id_favorite' => $favorite->id,
                'image' => $favorite->shared_table->thumbnail != null ?  env('SHARED_TABLE_THUMBNAIL') . $favorite->shared_table->thumbnail : no_image(),
                'description' => $favorite->shared_table->name,
                'price' => $favorite->shared_table->pricmeetinge,
                'rate' => $favorite->shared_table->rate,
                'location' => $favorite->shared_table->address,
            ];
            $data['id'] = $favorite->shared_table->id;
        }

        $data['type'] = $favorite->type;


        return $data;
    }

    public function add_to_favorite(Request $request)
    {
        $types = ['workshop', 'office', 'meeting', 'vacation', 'shared_table'];

        $validator = \Validator::make($request->all(), [
            'type' => 'required | string | in:' . implode(',', $types),
            'type_id' => 'required | numeric ',
        ]);

        if ($validator->fails()) {
            return response()->error(400, 'المعلومات غير صحيحة');
        }


        $count = Favorite::where('type', $request->type)->where('type_id', $request->type_id)->where('user_id', Auth::user()->id)->count();

        if ($count == 0) {
            $favorite = new Favorite();
            $favorite->type = $request->type;
            $favorite->type_id = $request->type_id;
            $favorite->user_id =  Auth::user()->id;
            $saved = $favorite->save();

            if ($saved) {
                return response()->success('Added to favorite successfully');
            }
        }
        return response()->error(400, 'حصل خطأ ما');
    }



    public function remove_many_from_favorite(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'listIdsFavorites' => 'required'
        ]);
        
        if ($validator->fails() || !is_array(json_decode($request->listIdsFavorites))) {
            return response()->error(400, 'المعلومات غير صحيحة');
        }

        $ids = json_decode($request->listIdsFavorites);
        $favorites = Favorite::find($ids);
        foreach ($favorites as $item) {
            $item->delete();
        }
        return response()->success('Removed from favorite successfully');
    }



    public function remove_from_favorite(Request $request)
    {

        $types = ['workshop', 'office', 'meeting', 'vacation', 'shared_table'];

        $validator = \Validator::make($request->all(), [
            'type' => 'required | string | in:' . implode(',', $types),
            'type_id' => 'required | numeric ',
        ]);

        if ($validator->fails()) {
            return response()->error(400, 'المعلومات غير صحيحة');
        }

        $user_id = \Auth::user()->id;
        $type   = $request->type;
        $type_id = $request->type_id;

        $query = Favorite::where('type', $type)->where('type_id', $type_id)->where('user_id', $user_id);
        $count = $query->count();


        if ($count != 0) {
            $favorite = $query->first();
            $data = [
                'id' => $favorite->id,
                'favorite' => $favorite->type
            ];
            $favorite->delete();
            return response()->success('Removed from favorite successfully', $data);
        }
        return response()->error(400, 'حصل خطأ ما');
    }




    public function add(int $space_id)
    {
        $favorite = Favorite::where(['type_id' => $space_id])->first();
        if ($favorite) return response()->error(400, 'The space is already in your favorites !');
        $space = SpaceSubSpace::find($space_id);
        if (!$space) return response()->error(404, 'space not found !');
        $user = Auth::guard('api')->user();
        $favorite = new Favorite();
        $favorite->user_id = $user->id;
        $favorite->type = $space->type_space;
        $favorite->type_id = $space_id;
        $favorite->save();
        return response()->success('The favorite was added with success !');
    }

    public function delete(int $id)
    {
        $user = Auth::guard('api')->user();
        $favorite = Favorite::where(['user_id' => $user->id, 'id' => $id])->first();
        if (!$favorite) return response()->error(404, 'favorite not found !');
        $favorite->delete();
        return response()->success('The favorite was deleted with success !');
    }
}
