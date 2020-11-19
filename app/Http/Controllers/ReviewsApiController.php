<?php

namespace App\Http\Controllers;

use App\Reviews;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewsApiController extends Controller
{
    public function index()
    {
        $reviews = Reviews::orderby('id', 'desc')->paginate(10);
        return new JsonResponse([
            'reviews' => $reviews
        ]);
    }

    public function edit($id) {
        $content = Reviews::find($id);
        return new JsonResponse([
            'content' => $content
        ]);
    }

    public function update(Request $request, $id) {
        $reviews = Reviews::find($id);

        $reviews->rating     = $request->rating;
        $reviews->review    = $request->review;
        $reviews->user    = $request->user;
     
        $reviews->save();

        return new JsonResponse([
            'status' => 'success',
            'message' => 'Review updated successfully'
        ]);

    }

    public function destroy($id)
    {
        Reviews::find($id)->delete();
        return new JsonResponse([
            'status' => 'success',
            'message' => 'Review deleted successfully'
        ]);
    }
}
