<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Favorite, Order, Space, User, Workshop};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    /**
     * SET CURRENT USER
     */
    public function __construct()
    {
    }

    public function user(Request $request)
    {
        echo User::all()->toJson(JSON_PRETTY_PRINT);
        exit;
    }

    /**
     * GET ALL THE FAVORITES OF THE CURRENT USER
     */
    public function favorites()
    {
        $user = Auth::user();
        echo $user->favorites()->paginate(10)->toJson(JSON_PRETTY_PRINT);
        exit();
    }

    /**
     * GET ALL THE ORDERS OF THE CURRENT USER
     */
    public function orders()
    {
        $user = Auth::user();
        echo $user->orders()->paginate(10)->toJson(JSON_PRETTY_PRINT);
        exit();
    }

    /**
     * RETURN THE DETAILS OF ORDER BY ID
     * @param int $id
     */
    public function orderDetails(int $id)
    {
        return null;
    }

    /**
     * USE_FILTER
     * return all the workshops by filter
     */
    public function workshops()
    {
        $user = Auth::user();
        echo $user->workshops()->toJson(JSON_PRETTY_PRINT);
    }

    /**
     * USE FILTER
     * RETURN ALL THE WORKSHOPS BY FILTER
     * @param $id
     * @return null
     */
    public function search(int $id)
    {
        echo Workshop::find($id);
        exit();
    }

    /**
     * ADD PRODUCT TO FAVORITE
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function addToFavorite(Request $request, $id)
    {
          $user_id = Auth::user()->id;
          $data = ['user_id' => $user_id, 'productID' => $id];
          Favorite::firstOrCreate($data);
          unset($user,$data);
          echo Response()->json(['success'=>'added successfully to favorite']);
          exit();
    }

    /**
     * REMOVE PRODUCT FROM FAVORITE
     * DELETE FAVORITE
     *
     * @param Request $request
     * @param $id
     * @return void
     */
    public function removeFromFavorite(Request $request, $id)
    {
        $favorite = Favorite::findOrFails(['user_id' => $request->user()->id, 'product_id' => $id]);
        $favorite->delete();
        echo Response::json(['success' => 'Removed from favorite']);
        exit();
    }

    public function findClose()
    {
        return null;
    }

    /**
     * VALIDATE THE REQUEST
     * SAVE THE ORDER
     * SEND EMAIL TO USER
     */
    public function request()
    {
        return null;
    }

    /**
     * PAGINATE THE WORKSHOP
     */
    public function index()
    {
        $workshops = Workshop::all();
        echo Response::json(['workshops' => $workshops]);
        unset($workshops);
        exit();
    }

    /**
     * LOAD CATEGORIES (ID, NAME) TO ARRAY
     * SHOW THE CREATE PAGE WITH CATEGORIES
     * VALIDATE THE REQUEST
     * STORE IN DATABASE
     * REDIRECT WITH SUCCESS
     */
    public function create()
    {
        return null;
    }

    /**
     * GET THE WORKSHOP
     * LOAD CATEGORIES (ID, NAME) TO ARRAY
     * SHOW THE CREATE PAGE WITH WORKSHOP & CATEGORIES
     */
    public function edit()
    {
        return null;
    }

    /**
     * VALIDATE THE REQUEST
     * GET THE WORKSHOP
     * UPDATE
     * REDIRECT WITH SUCCESS
     */
    public function update()
    {
        return null;
    }

    /**
     * GET THE WORKSHOP
     * DELETE
     * REDIRECT WITH SUCCESS
     * @param int $id
     * @return null
     */
    public function delete(int $id)
    {
        $workshop = Workshop::find($id);
        $workshop->delete();
        unset($workshop);
        echo Response::json(['success' => 'The workshop was deleted with successfully']);
        exit();
    }

    /**
     * RETURN VALIDATION RULES ARRAY
     */
    public function rules()
    {
        return null;
    }

    /**
     * GET BOOKING
     *
     * @return |null
     */
    public function getBooking()
    {
        return null;
    }

    /**
     * SHOW SPACE DETAILS WITH REVIEWS
     *
     * @param int $id
     * @return null
     */
    public function showSpaceDetails(int $id)
    {
        echo Space::find($id);
        exit();
    }

    public function applyCoupon()
    {
        echo Response::json(['success' => 'Your coupon was applied']);
        exit();
    }

    /**
     * RETURN THE LIST FEATURED
     *
     * @return |null
     */
    public function listFeatured()
    {
        return null;
    }
}
