<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Coupon;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CouponsController extends Controller
{

    public function index()
    {
        $coupons = Coupon::orderby('id', 'desc')->paginate(10);
        return view('coupons.index', compact('coupons'));
    }

    /**
     * @return RedirectResponse
     */
    public function bulkdelete()
    {
        Media::truncate();
        return redirect()->route('admin.media.home')->with('success', 'data has been deleted successfully');
    }

    /**
     * Create new coupon record
     *
     * @return View
     */
    public function create()
    {
        return view('coupons.create');
    }

    /**
     * Edit coupon record
     *
     * @param $id
     * @return View
     */
    public function edit( )
    {
       // $content = Coupon::whereId($id)->first();
        return view('coupons.edit', compact('content'));
    }


    /**
     * Store coupon record
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:coupon',
            'discount' => 'required|max:3'
        ]);

        $input = $request->all();
        Coupon::create($input);
        $notification = array(
            'message' => 'Coupon successfully created.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.coupons.home')->with($notification);
    }

    /*/ Update coupon record
    public  function update(Request $request, $id){
        $this->validate($request, [
            'coupon' => 'required',
            'discount' => 'required|max:3'
        ]);
        $input = $request->all();
        $coupon = Coupon::whereId($id)->first();
        $coupon->update($input);
        $notification = array(
            'message' => 'Coupon successfully updated.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.coupons.index')->with($notification);
    }*/


    /**
     * Update coupon record
     *
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     * @throws ValidationException
     */
    public  function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required',
            'discount' => 'required|max:3'
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
        return redirect()->route('admin.coupons.home')->with($notification);
    }

    /**
     * Delete coupon record
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id)
    {
        Coupon::find($id)->delete();

        $notification = array(
            'message' => 'Coupon successfully deleted.',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.coupons.home')->with($notification);
    }

    /**
     * Apply coupon
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function applyCoupon(Request $request)
    {
        $coupon = $request->coupon;
        $check = Coupon::where('coupon', $coupon)->first();
        if ($check) {
            Session::put('coupon', [
                'name' => $check->coupon,
                'discount' => $check->discount,
            ]);
            $notification = array(
                'message' => 'Coupon applied!',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Invalid Coupon!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    /**
     * Update coupon record
     *
     * @return RedirectResponse
     */
    public function removeCoupon()
    {
        Session::forget('coupon');
        $notification = array(
            'message' => 'Session Removed!',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
