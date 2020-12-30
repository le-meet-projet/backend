<?php

namespace App\Http\Controllers\ApiController;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\Invitation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiInvitationController extends Controller
{
    private $currentUser;

    public function __construct()
    {
        $this->currentUser = Auth::guard('api')->user();
    }

    public function inviteUser(Request $request, int $space_id)
    {
        $request->validate([
            'id_user_invite' => 'required'
        ]);
        $user_id_invite = $request['id_user_invite'];
        $user_invite = User::find($user_id_invite);
        if ( !$user_invite || $user_invite === $user ) return response(['error' => 'no user found !'], 404);
        $space = Space::find($space_id);
        if ( !$space ) return response(['error' => 'space not found !'], 404);
        $user = Auth::guard('api')->user();
        $invitation = Invitation::where(['user_id' => $user->id, 'user_invite' => $user_id_invite])->first();
        if ( $invitation && !$invitation->accepted ) return response(['error' => 'There is already an invitation to the user !']);
        $invitation = new Invitation();
        $invitation->user_id = $user->id;
        $invitation->user_invite = $user_id_invite;
        $invitation->space_id = $space_id;
        $invitation->save();
        return response(['success' => 'the invitation was successfully sent to the user!']);
    }

    public function edit(int $invit_id)
    {
        $user = Auth::guard('api')->user();
        $invitation = Invitation::where(['id' => $invit_id, 'user_id' => $user->id])->first();
        if ( !$invitation ) return response(['error' => 'No favorite found !']);
        return response(['favorite' => $invitation]);
    }

    public function update(Request $request, int $invit_id)
    {
        $request->validate([
            'id_user_invite' => 'required'
        ]);
        $invitation = Invitation::find($invit_id);
        if ( !$invitation ) return response(['error' => 'the invitation not found !'], 404);
        $user_to_invite = User::find($request['id_user_invite']) ;
        if ( !$user_to_invite ) return response(['errpr' => 'not found user !'], 404);
        $invitation->user_invite = $request['id_user_invite'];
        $invitation->save();
        return response(['message' => 'the invitation was successfully updated !']);
    }

    public function answer(Request $request, int $invit_id)
    {
        $request->validate([
            'response' => 'required | string | max:255'
        ]);
        $invitation = Invitation::where(['id' => $invit_id, 'answered' => 'NULL'])->first();
        if ( !$invitation ) return response(['error' => 'not found invitation !'], 404);
        $answer = $request['answer'];
        if ( $answer !== 'accept' && $answer !== 'deny' ) return response(['error' => 'unknown answer !']);
        $invitation->answered = $answer;
        $invitation->save();
        if ( $answer === 'accept') {
            return response(['success' => 'You accepted the invitation !']);
        }
        return response(['success' => 'You denied the invitation !']);
    }

    public function delete(int $invit_id)
    {
        $invitation = Invitation::where(['user_id' => $this->currentUser, 'id' => $invit_id])->first();
        if ( !$invitation ) return response(['error' => 'not invitation found !'], 404);
        $invitation->delete();
        return response(['success' => 'the invitation was successfully deleted !']);
    }

}
