<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\{Favorite, Order, Space, User, Workshop};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use phpDocumentor\Reflection\Types\This;

class ApiController extends Controller
{
    private $user;
    /**
     * SET CURRENT USER
     */
    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * GET ALL THE USERS
     *
     * @return JsonResponse
     */
    public function users()
    {
        return new JsonResponse(['Users' => User::all()]);
    }

    /**
     * GET ALL THE FAVORITES OF THE CURRENT USER
     *
     * @return JsonResponse
     */
    public function favorites()
    {
        $user = Auth::user();
        return new JsonResponse(['Favorites' => $user->favorites()->get()]);
    }

    /**
     * GET ALL THE ORDERS OF THE CURRENT USER
     */
    public function orders()
    {
        $user = Auth::user();
        return new JsonResponse(['Orders' => $user->orders()->paginate(10)]);
    }

    /**
     * RETURN THE DETAILS OF ORDER BY ID
     * @param int $id
     * @return null
     */
    public function orderDetails(int $id)
    {
        $order = Order::find(1);
        return new JsonResponse(['Order Details' => $order->details()]);
    }

    /**
     * USE_FILTER
     * return all the workshops by filter
     */
    public function workshops()
    {
        $user = Auth::user();
        return new JsonResponse($user->workshops());
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
     * CHECK THE PRODUCT IF EXISTS
     *
     * @param int $id
     * @return bool
     */
    private function checkSpace(int $id): bool
    {
        return NULL !== Space::find($id);
    }

    /**
     * ADD SPACE TO FAVORITE
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function addToFavorite(Request $request, int $id)
    {
        $user = Auth::user();
        if ( !$this->checkSpace($id) ) return new JsonResponse(['status' => 'error', 'message' => 'The space doesn\'t exist',]);
        $data = ['user_id' => $user->id, 'space_id' => $id];
        $exists = Favorite::firstOrCreate($data);
        $message = TRUE === $exists ? 'The favorite was added !' : 'The space is already in your favorites !';
        return new JsonResponse([
            'status' => 'success',
            'message' => $message,
        ]);
    }

    /**
     * REMOVE PRODUCT FROM FAVORITE
     * DELETE FAVORITE
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function removeFromFavorite(Request $request, int $id)
    {
        try {
            $favorite = Favorite::where(['user_id' => $request->user()->id, 'space_id' => $id])->firstOrFail();
        }
        catch(ModelNotFoundException $exception) {
            return new jsonResponse(['error' => 'The favorite doesn\'t exists !']);
        }
        $favorite->delete();
        return new JsonResponse([
            'message' => 'The favorite was deleted !'
        ]);
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
     * @return null
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
     * @return null
     */
    public function listFeatured()
    {
        return null;
    }
}
