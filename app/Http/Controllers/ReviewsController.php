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
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {

        $reviews = Reviews::orderby('id', 'desc')->paginate(2);
        return view('reviews.index', compact('reviews'));

      

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|Response|View
     */
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

       // return redirect()->route('admin.users.index')->with('notification','User successfully updated');

        Session::flash('statuscode','info');
        return redirect()->route('admin.reviews.index')->with('status','reviews Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Reviews::find($id)->delete();
        Session::flash('statuscode','error');
        return redirect()->route('admin.reviews.index')->with('status','Review Deleted');
    }
}
