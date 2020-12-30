<?php

namespace App\Http\Controllers\ApiController;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\SpaceSubSpace;
use Illuminate\Support\Facades\Auth;

class ApiFavoriteController extends Controller
{

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
