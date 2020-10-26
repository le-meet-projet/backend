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
     * GET ALL THE FAVORITES OF THE CURRENT USER
     *
     * @return JsonResponse
     */
    public function favorites()
    {
        $favorites = Auth::user()->favorites;
        $user_spaces = [];
        if ( $favorites ) {
            foreach ($favorites as $favorite) {
                $space_id = Favorite::find(['user_id' => Auth::user()->id]);
                array_push($user_spaces, Space::find(1));
            }
        }
        return new JsonResponse(['Spaces' => Favorite::find(['user_id' => Auth::user()->id])->get('space_id')]);
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

    /**
     * GET ALL THE ORDERS OF THE CURRENT USER
     *
     * @return JsonResponse
     */
    public function orders()
    {
        $user = Auth::user();
        return new JsonResponse(['Orders' => $user->orders()->paginate(10)]);
    }

    /**
     * RETURN THE DETAILS OF ORDER BY ID
     * @param int $id
     *
     *
     * @return JsonResponse
     */
    public function orderDetails(int $id)
    {
        $order = Order::find(1);
        return new JsonResponse(['Order Details' => $order->details()]);
    }

    /**
     * USE_FILTER
     * return all the workshops by filter
     *
     * @return JsonResponse
     */
    public function userWorkshops()
    {
        return new JsonResponse([
            'Workshops' => Auth::user()->workshops
        ]);
    }

    /**
     * PAGINATE THE WORKSHOP
     */
    public function workshops()
    {
        return new JsonResponse(['Workshops' => Workshop::all()]);
    }

    /**
     * SHOW SPACE DETAILS WITH REVIEWS
     *
     * @param int $id
     * @return null
     */
    public function showSpaceDetails(int $id)
    {
        $space = Space::find($id);
        return new JsonResponse(['SpaceDetails' => $space->details()]);
    }

    public function applyCoupon()
    {
        echo Response::json(['success' => 'Your coupon was applied']);
        exit();
    }

    /**
     * USE FILTER
     * RETURN ALL THE WORKSHOPS BY FILTER
     *
     *
     * @param $id
     * @return null
     */
    public function search(int $id)
    {
        return null;
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
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteWorkshop(int $id)
    {
        $workshop = Workshop::find($id);
        if ( !$workshop ) return new JsonResponse(['error' => 'No work shop found !']);
        $workshop->delete();
        return new JsonResponse(['success' => 'The workshop was deleted with successfully']);
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
     * RETURN THE LIST FEATURED
     *
     * @return null
     */
    public function listFeatured()
    {
        return null;
    }
}
