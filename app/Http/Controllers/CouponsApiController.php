<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponsApiController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderby('id', 'desc')->paginate(10);
        return new JsonResponse([
            'coupons' => $coupons
        ]);
    }

    public function edit($id)
    {
        $content = Coupon::whereId($id)->first();
        return new JsonResponse([
            'content' => $content
        ]);
    }


    public function store(Request $request)
    {

        $coupon = new Coupon();
        $coupon->title = $request->title;
        $coupon->code = $request->code;
        $coupon->discount=$request->discount;
        $coupon->discount_type = $request->type;
        $coupon->description = $request->description;
        $coupon->statue = $request->statue;
        $coupon->save();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Coupon created successfully'
        ]);

    }

    public  function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);

        $coupon->title = $request->title;
        $coupon->code = $request->code;
        $coupon->discount=$request->discount;
        $coupon->discount_type = $request->discount_type;
        $coupon->description = $request->description;
        $coupon->statue = $request->statue;

        $coupon->save();
        
        return new JsonResponse([
            'status' => 'success',
            'message' => 'Coupon updated successfully'
        ]);
    }

    public function destroy($id)
    {
        Coupon::find($id)->delete();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Coupon deleted successfully'
        ]);
    }

    public function changeStatus(Request $request)
    {
        $coupon = Coupon::find($request->id);
        $coupon->statue = $request->statue;
        $coupon->save();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Coupon status changed successfully'
        ]);
    }
}
