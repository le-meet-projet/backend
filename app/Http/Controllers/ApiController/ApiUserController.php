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
        return response()->data(['Information_user' => $this->currentUser]);
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

        $user['avatar'] = env('AVATAR_URL').$user['avatar'];
        
        return response()->data($user);
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
            'password' => 'string | min:6 | max:255',
            'address' => 'max:400',
            'phone' => 'string | max:400 | unique:users,phone,'.$id.',id',
        ]);

        if ($validator->fails())
        {
            return response()->error(400, $validator->errors()->all()[0]);
        }

        $user = Auth::user();

        $password = $user->getAuthPassword();

        if ( $request->has('password') and !is_null($request->password)) {
            $password = Hash::make($request['password']);
        }

        if($request->hasFile('file')){
            $path = $request->file('file')->store('public/users');
            $user->avatar = explode('/', $path)[2];
        }

        $user->password = $password; 
        $user->phone = $request['phone'] ?? $user->phone;
        $user->name = $request['name'] ?? $user->name;
        $user->address = $request['address'] ?? $user->address;
        $user->save();

        return response()->success('تم تعديل المعلومات بنجاح');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function updateAvatar(Request $request): Response
    {
        $validator = \Validator::make($request->all(), [
            'avatar' => 'required | string | max:255',
        ]);

        if ($validator->fails())
        {
            return response()->error(400, $validator->errors()->all()[0]);
        }

        $user = $this->currentUser;
        $user->avatar = $request['avatar'];
        $user->save();

        return response()->success('The avatar of the user was updated with success !');
    }

    /**
     * @param int $id
     * @return Response
     */
    public function deleteUser(int $id): Response
    {
        if ( $this->currentUser->role !== 'admin' || $this->currentUser->id === $id )
            return response()->error(403, 'Unauthorized');
        $user = User::find($id);
        if ( $user === null )
            return response()->error(404, 'The user was not found !');
        $user->delete();
            return response()->success('The user was deleted with success !');
    }

    public function userAds(int $id)
    {
        if ($this->currentUser->role !== 'admin')
            return response()->error(403, 'Unauthorized');
        $ads = Ads::where(['user_id' => $id])->get()->toArray();
        if ( count($ads) === 0 )
            return response()->error(404, 'The ads was not found !');
        return response()->data(['ads' => $ads]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function userNotification(int $id): Response
    {
        $notifications = Notification::where(['user_id' => $id])->get()->toArray();
        if ( count($notifications) === 0 )
            return response()->error(404, 'No notifications for the user !');
        return response()->data(['notifications' => $notifications]);
    }

    /**
     * @return Response
     */
    public function currentUserNotifications(): Response
    {
        $notifications = $this->currentUser->notifications;
        if ( count($notifications) === 0 )
            return response()->error(404, 'No notifications');
        return response()->data(['notifications' => $notifications]);
    }

    /**
     * @return Response
     */
    public function userOrders(): Response
    {
        $orders = $this->currentUser->orders;
        if ( count($orders) === 0 )
            return response()->error(404, 'No orders');
        return response()->data(['orders' => $orders]);
    }

}
