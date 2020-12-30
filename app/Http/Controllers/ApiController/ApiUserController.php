<?php

namespace App\Http\Controllers\ApiController;

use App\Ads;
use App\Http\Controllers\Controller;
use App\Notification;
use App\Order;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    /**
     * @var Authenticatable|null
     */
    private $currentUser;

    public function __construct()
    {
        $this->currentUser = Auth::guard('api')->user();
    }

    /**
     * @return Response
     */
    public function editUser(): Response
    {
        return \response(['Information_user' => $this->currentUser]);
    }

    /**
     * GET THE INFORMATION OF THE CURRENT USER
     *
     * @return Response
     */
    public function profileUser(): Response
    {
        return \response(['profile' => $this->currentUser]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function updateUser(Request $request): Response
    {
        $request->validate([
            'name' => 'string | max:255',
            'email' => 'email | string | max:255',
            'password' => 'string | max:255 | confirmed',
            'old_password' => 'string | max:255',
        ]);

        if ( $request['email'] !== $this->currentUser->email ) {
            $request->validate([
                'email' => 'unique:users',
            ]);
        }

        if ( $request->has('password') ) {
            if ( $request['password'] === null )
                return \response(['message' => 'The old password is missed !']);
            elseif ( !Hash::check($request['old_password'], Auth::user()->getAuthPassword()) )
                return \response(['message' => 'The old password is not correct !'], 403);
            else
                $request['password'] = Hash::make($request['password']);
        }

        $user = Auth::user();
        $user->email = $request['email'] ?? $user->email;
        $user->password = $request['password'] ?? $user->getAuthPassword();
        $user->name = $request['name'] ?? $user->name;
        $user->save();

        return response(['message' => 'The user information was updated !'], 200);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function updateAvatar(Request $request): Response
    {
        $request->validate([
            'avatar' => 'string | max:255 | required',
        ]);
        $user = $this->currentUser;
        $user->avatar = $request['avatar'];
        $user->save();

        return response(['message' => 'The avatar of the user was updated with success !']);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function deleteUser(int $id): Response
    {
        if ( $this->currentUser->role !== 'admin' || $this->currentUser->id === $idD ) return response(['error' => 'Unauthorized'], 403);
        $user = User::find($id);
        if ( $user === null ) return response(['error' => 'The user was not found !'], 404);
        $user->delete();

        return response(['message' => 'The user was deleted with success !']);
    }

    public function userAds(int $id)
    {
        if ($this->currentUser->role !== 'admin') return \response(['error' => 'unauthorized'], 403);
        $ads = Ads::where(['user_id' => $id])->get()->toArray();
        if ( count($ads) === 0 ) return response(['error' => 'The ads was not found !'], 404);
        return response(['ads' => $ads]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function userNotification(int $id): Response
    {
        $notifications = Notification::where(['user_id' => $id])->get()->toArray();
        if ( count($notifications) === 0 ) return response(['error' => 'No notifications for the user !'], 404);
        return response(['notifications' => $notifications], 200);
    }

    /**
     * @return Response
     */
    public function currentUserNotifications(): Response
    {
        $notifications = $this->currentUser->notifications;
        if ( count($notifications) === 0 ) return response(['error' => 'No notifications'], 404);
        return response(['notifications' => $notifications]);
    }

    /**
     * @return Response
     */
    public function userOrders(): Response
    {
        $orders = $this->currentUser->orders;
        if ( count($orders) === 0 ) return response(['error' => 'No orders'], 404);
        return response(['orders' => $orders]);
    }

}
