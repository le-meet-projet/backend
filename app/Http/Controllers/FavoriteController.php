<?php

namespace App\Http\Controllers;
use App\Models\Favourite;
use Auth;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function clear(Request $request) {
        $user = Auth::user();
        $user->wishlist->each->delete();
        return redirect()->route('wishlist',['store' => $request->store ])->with('success',trans('wishlist.cleared'));   
     }
 
    
     public function add($store,$id,Request $request) {
       if (Auth::check()) {
           $user_id = Auth::user()->id;
          $data = [ 'user_id' => $user_id, 'productID' => $id ];
          Favourite::firstOrCreate($data);
          return redirect()->back()->with('success',trans('wishlist.added')); 
       }
        return view ('website.user');  
     }
 
     
     public function remove($id,Request $request){
         $wish = Favourite::find($id);
         if($wish){
             $wish->delete();
             return redirect()->route('wishlist',['store' => $request->store ])->with('success',trans('wishlist.removed'));   
         }
         return redirect()->route('wishlist',['store' => $request->store ]);   
     }
}
