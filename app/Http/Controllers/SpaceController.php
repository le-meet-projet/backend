<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Space;
class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $meetings=Space::where('type','=','meeting')->paginate(2);
        return view('spacesMeeting.index',compact('meetings'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('spacesMeeting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {     
        $content = Space::whereId($id)->first();
         return view('spacesMeeting.edit',compact('content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public  function update(Request $request, $id)
    {
          $this->validate($request, [
            'code' => 'required|unique:coupons',
                    ]);
        //dd($request);
        $coupon = Coupon::whereId($id)->first();

        if ($request->has('statue')) {
            $request->request->add(['statue' => 'active']);
        } else {
            $request->request->add(['statue' => 'inactive']);
        }

        $input = $request->all();

        $coupon->update($input);
        $notification = array(
            'message' => 'Coupon successfully updated.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.coupons.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        Space::find($id)->delete();
    
        return redirect()->route('admin.spaces.index');
    }
}
