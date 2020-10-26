<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\{Favorite, Order, Space, User, Workshop};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
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

    // START FAVORITE FUNCTIONS

    /**
     * GET ALL THE FAVORITES OF THE CURRENT USER
     *
     * @return JsonResponse
     */
    public function favorites()
    {
        return new JsonResponse(['Favorites' => Auth::user()->favorites]);
    }

    /**
     * ADD SPACE TO FAVORITE
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function addSpaceToFavorite(Request $request, int $id)
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
            return new JsonResponse(['error' => 'The favorite doesn\'t exists !']);
        }
        catch (\Exception $exception)
        {
            return new JsonResponse(['error' => 'Something happened !']);
        }
        $favorite->delete();
        return new JsonResponse([
            'message' => 'The favorite was deleted !'
        ]);
    }

    // END FAVORITE FUNCTIONS

    // START WORKSHOPS FUNCTIONS

    /**
     * PAGINATE THE WORKSHOP
     */
    public function workshops()
    {
        return new JsonResponse(['Workshops' => Workshop::all()]);
    }

    /**
     * LOAD CATEGORIES (ID, NAME) TO ARRAY
     * SHOW THE CREATE PAGE WITH CATEGORIES
     * VALIDATE THE REQUEST
     * STORE IN DATABASE
     * REDIRECT WITH SUCCESS
     */
    public function createWorkshop()
    {
        return null;
    }

    /**
     * GET THE WORKSHOP
     * LOAD CATEGORIES (ID, NAME) TO ARRAY
     * SHOW THE CREATE PAGE WITH WORKSHOP & CATEGORIES
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function editWorkshop(Request $request, int $id)
    {
        $user_id = Auth::user()->id;
        $workshop = Workshop::find($id);
        if ( !$workshop ) return new JsonResponse(['error' => 'The workshop is not found !']);
        if ( $workshop['user_id'] !== $user_id) {
            return new JsonResponse(['error' => 'You didn\'t have the authorization to edit the workshop']);
        }
        return new JsonResponse(['success' => 'The workshop was updated !']);
    }

    /**
     * GET THE WORKSHOP
     * VERIFY THE CREATOR
     * DELETE THE WORKSHOP
     *
     * @param int $id
     * @return JsonResponse
     */
    public function deleteWorkshop(int $id)
    {
        $user_id = Auth::user()->id;
        $workshop = Workshop::find($id);
        if ( !$workshop ) { return new JsonResponse(['error' => 'The workshop doesn\'t exist']); }
        if ( $workshop['user_id'] !== $user_id ) return new JsonResponse(['error' => 'You don\'t have the permission for this action !']);
        $workshop->delete();
        return new JsonResponse(['success' => 'The workshop was deleted !']);
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

    // END WORKSHOPS FUNCTIONS

    // START SPACE FUNCTIONS

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
    // END SPACE FUNCTIONS

    // STARTS ORDER FUNCTIONS

    /**
     * @return JsonResponse
     */
    public function applyCoupon()
    {
        return new JsonResponse(['success' => 'Your coupon was applied']);
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
     * VALIDATE THE REQUEST
     * SAVE THE ORDER
     * SEND EMAIL TO USER
     *
     *
     * @param Request $request
     * @return null
     */
    public function createOrder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:4|max:10'
        ]);
        $order = new Order();
        $order->date = new \DateTime();
        $order->user_id = Auth::user()->id;
        if ( $order->save() ) {
            return new JsonResponse(['message' => 'The order was created with successfully !']);
        }
        return new JsonResponse(['error' => 'Something happened please try again']);
    }

    /**
     * RETURN THE DETAILS OF ORDER BY ID
     * @param int $id
     *
     * @return JsonResponse
     */
    public function orderDetails(int $id)
    {
        $order = Order::find(1);
        return new JsonResponse(['Order Details' => $order->details()]);
    }

    // END ORDER FUNCTIONS

    /**
     * USE FILTER
     * RETURN ALL THE WORKSHOPS BY FILTER
     *
     *
     * @return null
     */
    public function search()
    {
        return null;
    }

    public function findClose()
    {
        return null;
    }

    /**
     * RETURN VALIDATION RULES ARRAY
     *
     * @return array|null
     */
    public function rules():? array
    {
        return array();
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
