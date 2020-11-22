<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Order;
use App\Rating;
use App\Review;
use App\Space;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    // START SPACE FUNCTIONS
    /**
     * GET ALL THE SPACES
     *
     * @return Response
     */
    public function spaces()
    {
        $response = ['spaces' => Space::all()];
        return response($response, 200);
    }

    /**
     * CREATE NEW SPACE
     *
     * @param Request $request
     * @return Response
     */
    public function createSpace(Request $request)
    {
        $space = Space::where(['name' => $request['name']])->withTrashed()->first();
        if ( $space !== null ) {
            $space->restore();
        }
        else {
            $this->validateSpaceOrderRequest($request);

            $space = new Space();
            $space->name = $request['name'];
        }

        $space->price = $request['price'];
        $space->address = $request['address'];
        $space->description = $request['description'];
        $space->map = $request['map'];
        $space->thumbnail = $request['thumbnail'];
        $space->gallery = $request['gallery'];
        $space->type = $request['type'];
        $space->date = $request['date'];
        $space->time = $request['time'];
        $space->capacity = $request['capacity'];

        $space->save();

        $response = ['message' => 'The space was created with success !'];
        return response($response, 200);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function spaceOrderDetails(int $id)
    {
        $order = Order::where(['space_id' => $id])->first();
        if ( $order === null ) return response(['error' => 'nothing found'], 404);
        $response = ['details' => $order];
        return response($response);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function editSpace(int $id)
    {
        return response(['Space' => Space::find($id)]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function deleteSpace(int $id)
    {
        $space = Space::find($id);
        if ( null === $space ) return response(['error' => 'Not found'], 404);

        $space->delete();

        $response = ['message' => 'The space was deleted with success !'];
        return response();
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateSpace(Request $request, int $id)
    {
        $space = Space::find($id);
        if ( null === $space ) return response(['error' => 'Not found'], 404);
        $this->validateSpaceOrderRequest($request);

        $space = new Space();
        $space->name = $request['name'];
        $space->price = $request['price'];
        $space->address = $request['address'];
        $space->description = $request['description'];
        $space->map = $request['map'];
        $space->thumbnail = $request['thumbnail'];
        $space->gallery = $request['gallery'];
        $space->type = $request['type'];
        $space->date = $request['date'];
        $space->time = $request['time'];
        $space->capacity = $request['capacity'];

        $space->save();

        $response = ['message' => 'The space was update with success !'];
        return response($response, 200);
    }

    private function validateSpaceOrderRequest(Request $request)
    {
        $request->validate([
            'name' => 'required | string | max:255 | unique:spaces',
            'price' => 'required',
            'address' => 'required | string',
            'description' => 'required | string',
            'map' => 'required | string',
            'thumbnail' => 'required | string | max:255',
            'gallery' => 'required | string | max:255',
            'type' => 'required | string | max:255',
            'date' => 'required | date',
            'time' => 'required | time',
            'capacity' => 'required | string',
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function addFavorite(int $id)
    {
        $user_id = Auth::user()->id;
        $space = Space::find($id);
        $favorite = Favorite::where(['user_id' => $user_id, 'space_id' => $id])->first();
        if ( null === $space ) return response(['error' => 'Not found'], 404);
        if ( null !== $favorite ) return response(['error' => 'The space is already in your favorite !']);

        $favorite = Favorite::where(['user_id' => $user_id, 'space_id' => $id])->withTrashed();
        if ( $favorite !== null ) {
            $favorite->restore();

            $response = ['message' => 'The space was added to your favorite with success !'];
            return response($response, 200);
        }
        $favorite = new Favorite();
        $favorite->user_id = $user_id;
        $favorite->space_id = $id;
        $favorite->save();

        $response = ['message' => 'The space was added to your favorite with success !'];
        return response($response, 200);
    }

    public function deleteFavorite(int $id)
    {
        $user_id = Auth::user()->id;
        $favorite = Favorite::where(['user_id' => $user_id, 'space_id' => $id])->first();
        if ( null === $favorite ) return response(['error' => 'The favorite does not exists !']);

        $favorite->delete();
        $response = ['message' => 'The favorite was deleted with success !'];
        return response($response);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function addReview(Request $request, int $id)
    {
        $user_id = Auth::user()->id;
        $space = Space::find($id);
        if ( $space === null ) return response(['error' => 'Not found'], 404);
        $review = new Review();
        $rating = new Rating();
        $review->user_id = $user_id;
        $rating->user_id = $user_id;
        $review->space_id = $id;
        $rating->space_id = $id;
        $request->validate([
            'rating_value' => 'required | int',
            'review_value' => 'string | max:255',
        ]);
        $rating->value = $request['rating_value'];
        $review->value = $request['review_value'];

        $rating->save();
        if ( $review->value !== null ) $review->save();

        return response(['message' => 'The rating was added with success !'], 200);
    }
    // END SPACE FUNCTIONS
}
