<?php

namespace App\Http\Controllers\ApiController;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\Invitation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiInvitationController extends Controller
{
    private $currentUser;

    public function __construct()
    {
        $this->currentUser = Auth::guard('api')->user();
    }

    public function inviteUser(Request $request, int $space_id)
    {
        $validator = Validator::make($request->all(), [
            'id_user_invite' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->error(400, $validator->errors()->first());
        }

        $user_id_invite = $request['id_user_invite'];
        $user_invite = User::find($user_id_invite);
        if ( !$user_invite || $user_invite === $user )
            return response()->error(404, 'no user found !');
        $space = Space::find($space_id);
        if ( !$space )
            return response()->error(404, 'space not found !');
        $user = Auth::guard('api')->user();
        $invitation = Invitation::where(['user_id' => $user->id, 'user_invite' => $user_id_invite])->first();
        if ( $invitation && !$invitation->accepted )
            return response()->error(401, 'There is already an invitation to the user !');
        $invitation = new Invitation();
        $invitation->user_id = $user->id;
        $invitation->user_invite = $user_id_invite;
        $invitation->space_id = $space_id;
        $invitation->save();
        return response()->success('the invitation was successfully sent to the user!');
    }

    public function edit(int $invit_id)
    {
        $user = Auth::guard('api')->user();
        $invitation = Invitation::where(['id' => $invit_id, 'user_id' => $user->id])->first();
        if ( !$invitation ) return response()->error(404, 'No favorite found !');
        return response()->data(['favorite' => $invitation]);
    }

    public function update(Request $request, int $invit_id)
    {
        $validator = Validator::make($request->all(), [
            'id_user_invite' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->error(400, $validator->errors()->first());
        }

        $invitation = Invitation::find($invit_id);
        if ( !$invitation ) return response()->error(404, 'the invitation not found !');
        $user_to_invite = User::find($request['id_user_invite']) ;
        if ( !$user_to_invite ) return response()->error(404, 'not found user !');
        $invitation->user_invite = $request['id_user_invite'];
        $invitation->save();
        return response()->success('the invitation was successfully updated !');
    }

    public function answer(Request $request, int $invit_id)
    {
        $validator = Validator::make($request->all(), [
            'answer' => 'required | string | max:255'
        ]);
        if ($validator->fails()) {
            return response()->error(400, $validator->errors()->first());
        }

        $invitation = Invitation::where('id', $invit_id)->first();
        if ( !$invitation ) return response()->error(404, 'not found invitation !');
        $answer = $request['answer'];
        if ( $answer !== 'accept' && $answer !== 'deny' ) return response()->error(404, 'unknown answer !');
        $invitation->accepted = $answer == 'accept' ? 1 : 0;
        $invitation->save();
        if ( $answer === 'accept') {
            return response()->success('You accepted the invitation !');
        }
        return response()->success('You denied the invitation !');
    }

    public function delete(int $invit_id)
    {
        $invitation = Invitation::where(['user_id' => $this->currentUser->id, 'id' => $invit_id])->first();
        if ( !$invitation ) return response()->error(404, 'not invitation found !');
        $invitation->delete();
        return response()->success('the invitation was successfully deleted !');
    }

}
