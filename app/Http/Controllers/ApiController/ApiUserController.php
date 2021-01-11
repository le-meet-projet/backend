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

        $user =  $this->currentUser;
        if($user['avatar'] == 'NULL' or $user['avatar'] == '' or is_null($user['avatar'])){
            $user['avatar'] = env('API_URL').'default-user-avatar.png';
        }
        
        $api = [
            'state' => true,
            'message' => '',
            'data' => $user
        ];
        return \response($api);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function updateUser(Request $request): Response
    {
        $id = \Auth::user()->id;
        $validator = \Validator::make($request->all(), [
            'name' => 'string | max:255',
            'email' => 'email | string | max:255',
            'password' => 'max:255',
            'address' => 'max:400',
            'phone' => 'string | max:400 | unique:users,phone,'.$id.',id',
        ]);

        if ($validator->fails())
        {
            $api = [
                'state' => false,
                'message' =>  $validator->errors()->all()[0] ,
                'data' => ''
            ];
            return response($api, 200);
        }


        $user = Auth::user();


        $password = $user->getAuthPassword();

        if ( $request->has('password') and !is_null($request->password)) {
            $password = Hash::make($request['password']);
        }

        $user->email = $request['email'] ?? $user->email;
        $user->password = $password; 
        $user->phone = $request['phone'] ?? $user->phone;
        $user->name = $request['name'] ?? $user->name;
        $user->address = $request['address'] ?? $user->address;
        $user->save();


        $api = [
            'state' => true,
            'message' => 'تم تعديل المعلومات بنجاح',
            'data' => []
        ];
        return \response($api);

        
        return response($api, 200);
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
