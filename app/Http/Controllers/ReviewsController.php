<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Reviews;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Session;
class ReviewsController extends Controller
{
     
    public function index()
    {

        $reviews = Reviews::orderby('id', 'desc')->paginate(10);
        return view('reviews.index', compact('reviews'));

      

    }

  
  
     public function edit($id) {
        $content = Reviews::find($id);
        return view ('reviews.edit',compact('content'));
    }

    public function update(Request $request, $id) {
        $reviews = Reviews::find($id);

        $reviews->rating     = $request->rating;
        $reviews->review    = $request->review;
        $reviews->user    = $request->user;
     
     
        $reviews->save();

      
        Session::flash('statuscode','info');
        return redirect()->route('admin.reviews.index')->with('status','reviews Updated');

    }

 
    public function destroy($id)
    {
        Reviews::find($id)->delete();
        Session::flash('statuscode','error');
        return redirect()->route('admin.reviews.index')->with('status','Review Deleted');
    }
}
