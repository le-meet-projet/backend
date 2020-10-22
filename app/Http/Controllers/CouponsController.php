<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function index()
    {
        $media = Media::orderby('id', 'desc')->paginate(10);
        return view('admin.media.index', compact('media'));
    }

    public function bulkdelete()
    {
        Media::truncate();
        return redirect()->route('admin.media.home')->with('success', 'data has been deleted successfully');
    }

    // Store coupon record
    public function store(Request $request)
    {
        $this->validate($request, [
            'coupon' => 'required|unique:coupons',
            'discount' => 'required|max:3'
        ]);

        $input = $request->all();
        Coupon::create($input);
        $notification = array(
            'message' => 'Coupon successfully created.',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    // Update coupon record
    public  function update(Request $request, $id)
    {
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
    }

    // Update coupon record
    public  function update(Request $request, $id)
    {
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
    }

    // Apply Coupon
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

    // Remove Coupon
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
