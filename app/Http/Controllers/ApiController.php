<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\Notification;
use App\Order;
use App\Rating;
use App\Review;
use App\Space;
use App\User;
use App\Meeting;
use App\Vacation;
use App\Workshop;
use App\Table;
use Cartalyst\Stripe\Stripe;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Invitation;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ApiController extends Controller
{

    public $helper;

    public function __construct()
    {

        $this->helper = new \App\Helpers\Api();
    }

    public function getDetails(Request $request)
    {

        $header = $request->header('Authorization');
       // dd(\Auth::check());
     //   dd($header);

       // dd('loldlldd');
        $types = ['workshop', 'office', 'meeting', 'vacation', 'shared_table'];

        $validator = \Validator::make($request->all(), [
            'type' => 'required|in:' . implode(',', $types),
            'id'   => 'required | numeric ',
        ]);

        $ratings =  [
            [
                'starsNumber' => '5',
                'rateLabel' => 'ممتاز جداً',
                'name' => 'أحمد المطيري',
                'date' => '2012-02-23',
                'rateText'  => 'أنا ممتن لكم على الخدمات الراقية',
            ],
            [
                'starsNumber' => '5',
                'rateLabel' => 'ممتاز جداً',
                'name' => 'أحمد المطيري',
                'date' => '2012-02-23',
                'rateText'  => 'أنا ممتن لكم على الخدمات الراقية',
            ],
            [
                'starsNumber' => '5',
                'rateLabel' => 'ممتاز جداً',
                'name' => 'أحمد المطيري',
                'date' => '2012-02-23',
                'rateText'  => 'أنا ممتن لكم على الخدمات الراقية',
            ],
            [
                'starsNumber' => '5',
                'rateLabel' => 'ممتاز جداً',
                'name' => 'أحمد المطيري',
                'date' => '2012-02-23',
                'rateText'  => 'أنا ممتن لكم على الخدمات الراقية',
            ],
        ];

        if ($validator->fails()) {
            $api = [
                'state' => false,
                'message' => $validator->errors()->first(),
                'data' => [],
            ];
            return \response($api);
        }



        $type = $request->type;
        $id   = $request->id;

        if ($type == 'meeting') {

            $meeting = Meeting::with('favorite')->where('id', $id)->first();

            $favorite = 0;
        //   dd($request->user());
            if (Auth::check()) {
                $user_id = \Auth::user()->id;
             //   dd(Favorite::where('type_id', $id)->where('user_id', $user_id)->where('type', 'meeting')->count());
                $favorite = Favorite::where('type_id', $id)->where('user_id', $user_id)->where('type', 'meeting')->count();
            }


          //  dd($favorite);
            $result = $this->helper->conference($meeting);
            $result['favorite']  = $favorite > 0 ? true : false;
            $result['content']   = $meeting->description;
            $result['location']   = $meeting->address;
            $result['latitude']  = $meeting->latitude;
            $result['longitude'] = $meeting->longitude;
            $result['zoom']      = 14.4746;
            $result['ratings']   = [];

            $api = [
                'state' => true,
                'message' => '',
                'data' => $result
            ];
            return \response($api);
        }



        if ($type == 'office') {

            $meeting = Meeting::with('favorite')->where('id', $id)->first();


            $favorite = 0;
            if (Auth::check()) {
                $user_id = \Auth::user()->id;
                $favorite = Favorite::where('type_id', $meeting->id)->where('user_id', $user_id)->where('type', 'office')->count();
            }

            $result = $this->helper->conference($meeting);
            $result['favorite']  = ($favorite != 0) ? true : false;
            $result['content']   = $meeting->description;
            $result['location']   = $meeting->address;
            $result['place']      = $result['roomName'];
            $result['latitude']  = $meeting->latitude;
            $result['longitude'] = $meeting->longitude;
            $result['zoom']      = 14.4746;
            $result['ratings']   = [];

            $api = [
                'state' => true,
                'message' => '',
                'data' => $result
            ];
            return \response($api);
        }




        if ($type == 'vacation') {

            $vacation =  Vacation::where('id', $id)->first();



            $favorite = 0;
            if (Auth::check()) {
                $user_id = \Auth::user()->id;
                $favorite = Favorite::where('type_id', $vacation->id)->where('user_id', $user_id)->where('type', 'vacation')->count();
            }


            $result = $this->helper->vacation($vacation);
            $result['favorite']  = ($favorite != 0) ? true : false;
            $result['content']   = $vacation->description;
            $result['location']   = $vacation->address;
            $result['latitude']  = 30.393496;
            $result['longitude'] = -9.600167;
            $result['zoom']      = 14.4746;
            $result['time']      = 'من: 04:00 م - إلى: 12:00 م';
            $result['date']      = 'الخميس - 5 نوفمبر';
            $result['activityType']      = 'حركي';
            $result['participationType']      = 'فردي';


            $result['ratings']   = [];


            $api = [
                'state' => true,
                'message' => '',
                'data' => $result
            ];
            return \response($api);
        }




        if ($type == 'workshop') {

            $vacation =  Workshop::where('id', $id)->first();



            $favorite = 0;
            if (Auth::check()) {
                $user_id = \Auth::user()->id;
                $favorite = Favorite::where('type_id', $vacation->id)->where('type', 'workshop')->count();
            }


            $result = $this->helper->vacation($vacation);
            $result['favorite']  = ($favorite != 0) ? true : false;
            $result['content']   = $vacation->description;
            $result['location']   = $vacation->address;
            $result['latitude']  = 30.393496;
            $result['longitude'] = -9.600167;
            $result['zoom']      = 14.4746;
            $result['time']      = 'من: 04:00 م - إلى: 12:00 م';
            $result['date']      = 'الخميس - 5 نوفمبر';
            $result['activityType']      = 'حركي';
            $result['participationType']      = 'فردي';


            $result['ratings']   = [];


            $api = [
                'state' => true,
                'message' => '',
                'data' => $result
            ];
            return \response($api);
        }

        if ($type == 'shared_table') {

            $table   =  Table::with('favorite')->where('id', $id)->first();

            $favorite = 0;
            if (Auth::check()) {
                $user_id = \Auth::user()->id;
                $favorite  = Favorite::where('type_id', $table->id)->where('user_id', $user_id)->where('type', 'table')->count();
            }

            $result                 = $this->helper->table($table);
            $result['favorite']     = ($favorite != 0) ? true : false;
            $result['content']      = $table->description;
            $result['location']     = $table->address;
            $result['latitude']     = $table->latitude;
            $result['longitude']    = $table->longitude;
            $result['zoom']         = 14.4746;
            $result['ratings']      = $ratings;

            $api = [
                'state' => true,
                'message' => '',
                'data' => $result
            ];
            return \response($api);
        }
    }








    // OTP CONFIRMATION
    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    public function otpConfirm(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'phone' => 'required | string | max:15 | min:10'
        ]);

        if ($validator->fails()) {
            $api = [
                'state' => false,
                'message' => 'The phone number is not correct !',
                'data' => [],
            ];
            return \response($api);
        }

        $phone = $request['phone'];
    
        $generatedOtp =  rand(1111, 9999);
        
        /*
        $generatedOtp =  123456;
        */

        $apiUrl = "https://mapi.moreify.com/api/v1/sendSms";
        $postParams = array(
            'project' =>        'lemeet1253',
            'password' =>       'a03aa7346dc2f9e6',
            'phonenumber' =>    $phone,
            'message' =>        'Your verification code is ' . $generatedOtp,
        );
       

        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postParams);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        $response = curl_exec($curl);
        


        $api = [
            'state' => true,
            'message' => '',
            'data' => [
                'otp' => $generatedOtp,
            ],
        ];

        return \response($api);
    }
    // OTP CONFIRMATION
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
        if ($space !== null) {
            $space->restore();
        } else {
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
        $order = Order::where(['space_id' => $id])->get()->toArray();
        if (count($order) === 0) return response(['error' => 'nothing found'], 404);
        $response = ['Orders' => $order];
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
        if (null === $space) return response(['error' => 'Not found'], 404);

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
        if (null === $space) return response(['error' => 'Not found'], 404);
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
        if (null === $space) return response(['error' => 'Not found'], 404);
        if (null !== $favorite) return response(['error' => 'The space is already in your favorite !']);

        $favorite = Favorite::where(['user_id' => $user_id, 'space_id' => $id])->withTrashed();
        if ($favorite !== null) {
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
        if (null === $favorite) return response(['error' => 'The favorite does not exists !']);

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
        if ($space === null) return response(['error' => 'Not found'], 404);

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
        if ($review->value !== null) $review->save();

        return response(['message' => 'The rating was added with success !'], 200);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function inviteUserToSpace(Request $request, int $id)
    {
        $request->validate([
            'user_id' => 'required | string',
        ]);

        $user_id = (int) $request['user_id'];
        if (User::find($user_id) === null or $request['user_id'] === Auth::user()->id) return \response(['error' => 'User not found !'], 404);

        $space = Space::find($id);
        if (null === $space) return response(['message' => 'Space not found', 404]);

        $invitation = Invitation::where(['user_id' => $user_id, 'creator_id' => Auth::user()->id])->withTrashed()->first();

        if ($invitation === null)
            $invitation = new Invitation();
        else
            $invitation->restore();
        $invitation->creator_id = Auth::user()->id;
        $invitation->user_id = $user_id;
        $invitation->space_id = $id;
        $invitation->accepted = false;
        $invitation->save();

        $response = ['message' => 'The Invitation sent with success !'];
        return response($response);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function editInvitation(int $id)
    {
        $invitation = Invitation::where(['id' => $id, 'creator_id' => Auth::user()->id])->first();
        if ($invitation === null) return response(['error' => 'Invitation was not found']);
        $response = ['Invitation' => $invitation];
        return response($response);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updateInvitation(Request $request, int $id)
    {
        $invitation = Invitation::where(['id' => $id, 'creator_id' => Auth::user()->id])->first();
        if ($invitation === null) return response(['error' => 'The invitation was not found !'], 404);

        $request->validate([
            'user_id' => 'required',
            'space_id' => 'required',
        ]);

        $request['user_id'] = (int) $request['user_id'];
        $request['space_id'] = (int) $request['space_id'];
        if (User::find($request['user_id']) === null or $request['user_id'] === Auth::user()->id) return response(['error' => 'User was not found !']);
        if (Space::find($request['space_id']) === null) return response(['error' => 'Space was not found !']);

        $invitation->user_id = $request['user_id'];
        $invitation->space_id = $request['space_id'];
        $invitation->save();

        $response = ['message' => 'The invitation was updated with success !'];
        return response($response, 200);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function deleteInvitation(int $id)
    {
        $invitation = Invitation::find($id);
        if (null === $invitation) return response(['error' => 'The invitation was not found !'], 404);

        if (Auth::user()->id !== $invitation->creator()->first()->id) return response(['error' => 'Unauthorized'], 403);

        $invitation->delete();
        return response(['message' => 'The invitation was deleted with success'], 200);
    }

    public function acceptOrDenyInvitation(Request $request, int $id)
    {
        $invitation = Invitation::where(['id' => $id, 'date' => null])->first();
        if ($invitation === null) return response(['error' => 'The invitation was not found '], 404);

        if ($invitation->user()->first()->id !== Auth::user()->id) return response(['error' => 'Unauthorized'], 403);

        $request->validate([
            'action' => 'required | string | max:255',
        ]);

        if ($request['action'] !== 'accept' and $request['action'] !== 'deny') return response(['error' => 'Action not defined'], 404);
        elseif ($request['action'] === 'accept') $invitation->accepted = true;
        else $invitation->accepted = false;

        $invitation->date = new \DateTimeImmutable();
        $invitation->save();

        if ($request['action'] === 'deny')
            return response(['message' => 'You are denied the invitation'], 200);

        return response(['message' => 'You are accepted the invitation'], 200);
    }

    /**
     * @return Response
     */
    public function getMeetingSpaces()
    {
        $meeting_spaces = Space::where(['type' => 'meeting'])->get();
        if ($meeting_spaces === null) return \response(['error' => 'No meeting spaces found'], 404);
        return response(['meetings_spaces' => $meeting_spaces]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function sortMeetingSpaces(Request $request)
    {
        if (count($this->sortSpace($request, 'meeting')) === 0) return response(['error' => 'No spaces found !']);
        return response(['meeting_spaces' => $this->sortSpace($request, 'meeting')]);
    }

    /**
     * @return Response
     */
    public function searchMeetingSpaces()
    {
        $meeting_spaces = Space::where(['type' => 'meeting'])->get();
        return response(['meeting_spaces' => $meeting_spaces]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getMeetingId(int $id)
    {
        $meeting_space = Space::where(['id' => $id, 'type' => 'meeting'])->first();
        if ($meeting_space === null) return response(['error' => 'Space not found !'], 404);
        return response(['meeting_space' => $meeting_space]);
    }

    public function getMeetingReviews(int $id)
    {
        $meeting_space = Space::where(['type' => 'meeting', 'id' => $id])->first();
        if ($meeting_space === null) return response(['error' => 'Space not found !'], 404);

        $reviews = $meeting_space->reviews()->get();
        if (count($reviews) === 0) return \response(['reviews' => 'No reviews for this space'], 404);
        return response(['reviews' => $reviews], 200);
    }

    /**
     * @return Response
     */
    public function getWorkShopsSpaces()
    {
        $workshops = Space::where(['type' => 'workshop'])->orderBy('id', 'ASC')->get();
        if (count($workshops) === 0) return response(['error' => 'No workshops found !']);
        return response(['WorkShops' => $workshops]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function sortWorkShops(Request $request)
    {
        $sortedWorkshops = $this->sortSpace($request, 'workshop');
        return response(['workshop' => $sortedWorkshops]);
    }

    public function searchWorkShops(Request $request)
    {
        return response(['workshops' => $this->searchSpace($request, 'workshop')]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getWorkshopId(int $id)
    {
        $space = Space::where(['id' => $id, 'type' => 'workshop'])->first();
        if ($space === null) return response(['error' => 'Not found !'], 404);

        return response(['workshop' => $space]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getWorkshopReviews(int $id)
    {
        $workshop_space = Space::where(['type' => 'workshop', 'id' => $id])->first();
        if ($workshop_space === null) return response(['error' => 'Workshop not found !'], 404);

        $reviews = $workshop_space->reviews()->get();
        if (count($reviews) === 0) return \response(['reviews' => 'No reviews for this space'], 404);
        return response(['reviews' => $reviews], 200);
    }

    /**
     * @return Response
     */
    public function getOfficesSpaces()
    {
        $offices = Space::where(['type' => 'office'])->get()->toArray();
        if (count($offices) === 0) return response(['error' => 'No office found !'], 404);
        return \response(['offices' => $offices]);
    }

    public function sortOffices(Request $request)
    {
        $sorted_offices = $this->sortSpace($request, 'office');
        if (count($sorted_offices) === 0) return response(['error' => 'No offices !'], 404);
        return response(['offices' => $sorted_offices]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function searchOffices(Request $request)
    {
        return $this->searchSpace($request, 'office');
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getOfficeId(int $id)
    {
        $office = Space::where(['type' => 'office', 'id' => $id])->first();
        if ($office === null) return response(['error' => 'Office not found !'], 404);
        return \response(['office' => $office]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getOfficeReviews(int $id)
    {
        $office = Space::where(['id' => $id, 'type' => 'office'])->first();
        if ($office === null) return response(['error' => 'Office not found !'], 404);
        $office_reviews = $office->reviews()->get()->toArray();
        if (count($office_reviews) === 0) return response(['error' => 'No reviews for the office !']);
        return response(['Reviews' => $office_reviews]);
    }

    /**
     * @return Response
     */
    public function getHolidaysSpaces()
    {
        $holidaySpaces = Space::where(['type' => 'holiday'])->get()->toArray();
        if (count($holidaySpaces) === 0) return response(['error' => 'No holiday spaces found !'], 404);
        return response(['Holiday' => $holidaySpaces]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function sortHolidays(Request $request)
    {
        $sortedSpaces = $this->sortSpace($request, 'holiday');
        if (count($sortedSpaces) === 0 && $request['option'] === 'nearby') return response(['error' => 'No offices nearby !']);
        return \response(['Offices' => $sortedSpaces]);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function searchHolidays(Request $request)
    {
        return $this->searchSpace($request, 'holiday');
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getHolidayId(int $id)
    {
        $holiday_space = Space::where(['type' => 'holiday', 'id' => $id])->first();
        if (null === $holiday_space) return response(['error' => 'No holiday space found !'], 404);
        return response(['Holiday_space' => $holiday_space]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function getHolidayReviews(int $id)
    {
        $holiday_space = Space::where(['type' => 'holiday', 'id' => $id])->first();
        if (null === $holiday_space) return \response(['error' => 'Holiday space not found !']);
        $space_reviews = $holiday_space->reviews()->get()->toArray();
        if (count($space_reviews) === 0) return response(['error' => 'No reviews for the space'], 404);
        return \response(['space_reviews' => $space_reviews], 200);
    }

    /**
     * @param Request $request
     * @param string $spaceType
     * @return array
     */
    private function searchSpace(Request $request, string $spaceType)
    {
    }

    /**
     * @param Request $request
     * @param string $spaceType
     * @return array
     */
    private function sortSpace(Request $request, string $spaceType)
    {
        $request->validate([
            'option' => 'required | string | max:255',
        ]);
        $sort_option = $request['option'];
        $spaces = Space::where(['type' => $spaceType])->get();
        if ($sort_option === 'best_price') $spaces = Space::where(['type' => $spaceType])->orderBy('price', 'asc')->get();
        elseif ($sort_option === 'best_rating') {
            $ratings = [];
            foreach ($spaces as $space) {
                if ($space->ratings()->count() > 0) {
                    $space_rating_array = $space->ratings()->get()->toArray();

                    usort($space_rating_array, function ($sr1, $sr2) {
                        return $sr1['value'] < $sr2['value'];
                    });

                    $ratings[] = [
                        'space_id' => $space->id,
                        'value' => $space_rating_array[0]['value'],
                    ];
                }
            }

            usort($ratings, function ($r1, $r2) {
                return $r1['value'] < $r2['value'];
            });
            $sorted_spaces = [];

            foreach ($ratings as $rating) {
                $sorted_spaces[] = Space::find((int) $rating['space_id']);
            }

            return $sorted_spaces;
        } elseif ($sort_option === 'most_popular') {
            $ratings_with_space_id = [];

            foreach ($spaces as $space) {
                if ($space->ratings()->count())
                    $ratings_with_space_id[] = [
                        'id' => $space->id,
                        'rating_count' => $space->ratings()->count(),
                    ];
            }

            usort($ratings_with_space_id, function ($r1, $r2) {
                return  $r1['rating_count'] < $r2['rating_count'];
            });

            $spaces_meetings_sort = [];

            foreach ($ratings_with_space_id as $item) {
                $spaces_meetings_sort[] = Space::find((int) $item['id']);
            }

            return $spaces_meetings_sort;
        } else {
            $spaces = Space::where(['city' => Auth::user()->city])->get();
        }

        return $spaces;
    }
    // END SPACE FUNCTIONS

    // ORDERS FUNCTIONS
    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function orderSpace(Request $request, int $id)
    {
        $request->validate([
            'date' => 'required | date',
            'space_id' => 'required',
            'day' => 'required | string | max:255',
            'hour' => 'required | time',
            'coupon' => 'string | max:255',
            'price' => 'required',
        ]);

        $user_id = Auth::user()->id;
        $space = Space::find($id);

        if (null === $space) return \response(['error' => 'The space wasn\'t found !'], 404);

        $order = new Order();
        $order->date = $request['date'];
        $order->user_id = $user_id;
        $order->space_id = $id;
        $order->price = $request['price'];
        $order->payment_method = $request['payment_method'];
        $order->day = $request['day'];
        $order->hour = $request['hour'];
        $order->type = $request['type'];
        $order->capacity = $request['capacity'];
        $order->status = $request['status'];
        $order->coupon = $request['coupon'];
        $order->save();

        return response(['message' => 'The order was success !']);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function orderDetails(int $id)
    {
        $order = Order::find($id);
        if ($order === null) return \response(['error' => 'The order was not found ']);
        return \response(['Order_details' => $order]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function PayOrder(Request $request, int $id)
    {
        $request->validate([
            'stripe_token' => 'required | string | max:255',
        ]);

        $order = Order::where(['id' => $id, 'user_id' => Auth::user()->id])->first();
        if ($order === null) return \response(['error' => 'The order was not found !'], 404);
        $token_stripe = $request['stripe_token'];
        $stripe = Stripe::make(env('STRIPE_SECRET_KEY', ''));

        $charge = $stripe->charges()->create([
            'amount'   => $order->price,
            'currency' => 'USD',
            'source' => $token_stripe,
            'receipt_email' => "admin@email.com",
        ]);

        return response(['message' => 'The payment was with success !'], 200);
    }
    // END ORDERS FUNCTIONS
    // START USER FUNCTIONS

    /**
     * GET THE INFORMATION OF THE CURRENT USER
     *
     * @return Response
     */
    public function profileUser(): Response
    {

        dd('dmdmm');
        $user = User::find(Auth::user()->id);
        if (is_null($user->avatar) or $user->avatar == 'NULL' or $user->avatar == '' or empty($user->avatar)) {
            $user->avatar = env('API_URL') . 'default-user-avatar.png';
        }
        return \response(['profile' => $user]);
    }

    /**
     * @return Response
     */
    public function editUser(): Response
    {
        return \response(['Information_user' => User::find(Auth::user()->id)]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function updateUser(Request $request)
    {
        $request->validate([
            'name' => 'string | max:255',
            'email' => 'email | string | max:255 | unique:users',
            'password' => 'string | max:255 | confirmed',
            'old_password' => 'string | max:255',
        ]);

        if ($request->has('password')) {
            if ($request['password'] === null)
                return \response(['message' => 'The old password is missed !']);
            elseif (!Hash::check($request['old_password'], Auth::user()->getAuthPassword()))
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
     * @param int $id
     * @return Response
     */
    public function updateAvatar(Request $request): Response
    {
        $request->validate([
            'avatar' => 'string | max:255 | required',
        ]);
        $user = User::find(Auth::user()->getAuthIdentifier());
        if (null === $user) return response(['error' => 'No user found !'], 404);
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
        $current_user = Auth::user();
        if ($current_user->role !== 'admin') return response(['error' => 'Unauthorized'], 403);
        $user = User::find($id);
        if ($user === null) return response(['error' => 'The user was not found !'], 404);
        $user->delete();

        return response(['message' => 'The user was deleted with success !']);
    }

    public function userAds(int $id)
    {
        $ads = Ads::where(['user_id' => $id])->get()->toArray();
        if (count($ads) === 0) return response(['error' => 'The ads was not found !'], 404);
        return response(['ads' => $ads]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function userNotification(int $id): Response
    {
        $notifications = Notification::where(['user_id' => $id])->get()->toArray();
        if (count($notifications) === 0) return response(['error' => 'No notifications for the user !'], 404);
        return response(['notifications' => $notifications], 200);
    }

    /**
     * @return Response
     */
    public function userOrders(): Response
    {
        $orders = Order::where(['user_id' => Auth::user()->id])->get()->toArray();
        if (count($orders) === 0) return response(['error' => 'No orders'], 404);
        return response(['orders' => $orders]);
    }

    /**
     * @return Response
     */
    public function currentUserNotifications(): Response
    {
        $notifications = Notification::where(['user_id' => Auth::user()->id])->get()->toArray();
        if (count($notifications) === 0) return response(['error' => 'No notifications'], 404);
        return response(['notifications' => $notifications]);
    }
    // END USER FUNCTIONS


  

    public function order_dates(Request $request)
    {
        $type = $request->type;
        /*
        *
        *   to do : 
        *   dir li hna lyouma  + osbo3 ykon bdak chkel dyal reservation_dates 
        */

        $reservation_dates = [];

        $type = $request->type;
        $id   = $request->id;

        if ($type == 'meeting' or $type == 'office') {
            $price = Meeting::where('id', $id)->first()->price;
        }
        
        if ($type == 'vacation') {
            $price =  Vacation::where('id', $id)->first()->price;;
        }
        
        if ($type == 'workshop') {
            $price =  Workshop::where('id', $id)->first()->price;;
        }
        
        if ($type == 'shared_table') {
            $price = Table::with('favorite')->where('id', $id)->first()->price;;
        }

        $reservation_dates['price'] = $price;



        

        $arDays = [
            'Mon' => 'الإتنين',
            'Tue' => 'الثلاثاء',
            'Wed' => 'الاربعاء',
            'Thu' => 'الخميس',
            'Fri' => 'الجمعة',
            'Sat' => 'السبت',
            'Sun' => 'الأحد'
        ];

        $arMonths = [
            'Jan' => 'يناير',
            'Feb' => 'فبراير',
            'Mar' => 'مارس',
            'Apr' => 'ابريل',
            'May' => 'ماي',
            'Jun' => 'يونيو',
            'Jul' => 'يوليوز',
            'Aug' => 'غشت',
            'Sep' => 'شتنبر',
            'Oct' => 'اكتوبر',
            'Nov' => 'نونبر',
            'Dec' => 'دجنبر',
        ];

        $reservation_times = [
            [
                'from' => 'من : 09:00 ص',
                'to' => 'الى : 10:00 ص',
                'active' => false,
            ],
            [
                'from' => 'من : 10:00 ص',
                'to' => 'الى : 11:00 ص',
                'active' => false,
            ],
            [
                'from' => 'من : 11:00 ص',
                'to' => 'الى : 12:00 م',
                'active' => false,
            ],
            [
                'from' => 'من : 12:00 م',
                'to' => 'الى : 01:00 م',
                'active' => false,
            ],
            [
                'from' => 'من : 01:00 م',
                'to' => 'الى : 02:00 م',
                'active' => false,
            ],
            [
                'from' => 'من : 02:00 م',
                'to' => 'الى : 03:00 م',
                'active' => false,
            ],
            [
                'from' => 'من : 04:00 م',
                'to' => 'الى : 05:00 م',
                'active' => false,
            ],
            [
                'from' => 'من : 05:00 م',
                'to' => 'الى : 06:00 م',
                'active' => false,
            ]
        ];

        if ($type == 'shared_table') {
            for ($i = 0; $i < 4; $i++) {
                $reservation_dates['chairs_numbers'][] = [
                    'number' => "$i",
                    'active' => false,
                ];
            }
        }

        for ($i = 0; $i < 7; $i++) {

            $date = (Carbon::now())->addDays($i);
            $month = date_format($date, 'M');
            $day = date_format($date, 'D');

            if ($type == 'shared_table') {
                $reservation_dates['reservation_dates'][] = [
                    'date' => date_format($date, 'y-m-d'),
                    'day' => $arDays[$day],
                    'month' => date_format($date, 'd') . ' ' . $arMonths[$month],
                    'active' => false,
                    'times' => $reservation_times,
                    'reserved_chairs' => ['1', '2', '3']
                ];
            } else {
                $reservation_dates['reservation_dates'][] = [
                    'date' => date_format($date, 'y-m-d'),
                    'day' => $arDays[$day],
                    'month' => date_format($date, 'd') . ' ' . $arMonths[$month],
                    'active' => false,
                    'times' => $reservation_times
                ];
            }
        }

        

        $api = [
            'state' => true,
            'message' => '',
            'data' => $reservation_dates,
        ];

        return response()->json($api);
    }




    public function verify_coupon(Request $request)
    {
        $coupon = $request->coupon;
        $id = $request->id;
        $type = $request->type;

        // now we verify the coupon here !

        $api = [
            'state' => true,
            'message' => '',
            'data' => 'تم خصم 14 ريال'
        ];

        return response()->json($api);
    }


    public function pay_secure()
    {


        $api = [
            'state' => true,
            'message' => 'paid successfully',
            'data' => []
        ];

        return response()->json($api);
    }
    public function confirm_payment()
    {
        $api = [
            'state' => true,
            'message' => '',
            'data' => []
        ];

        return response()->json($api);
    }


    public function user_orders_list()
    {
        $api = [
            'state' => true,
            'message' => '',
            'data' => [
                [
                    'date' => '20 أكتوبر :',
                    'image' => 'https://i1.wp.com/www.manae-business.fr/wp-content/uploads/2020/03/you-x-ventures-Oalh2MojUuk-unsplash.jpg?resize=2000%2C1200&ssl=1',
                    'type' =>  'meeting',
                    'description' => 'مجرد وصف',
                    'price' => '50 ريال ',
                    'reservationNumber' => '212',
                    'rate' => '4.3 \\ 5 '
                ],
                [
                    'date' => '20 أكتوبر :',
                    'image' => 'https://i1.wp.com/www.manae-business.fr/wp-content/uploads/2020/03/you-x-ventures-Oalh2MojUuk-unsplash.jpg?resize=2000%2C1200&ssl=1',
                    'type' =>  'meeting',
                    'description' => 'مجرد وصف',
                    'price' => '50 ريال ',
                    'reservationNumber' => '212',
                    'rate' => '4.3 \\ 5 '
                ],
                [
                    'date' => '20 أكتوبر :',
                    'image' => 'https://i1.wp.com/www.manae-business.fr/wp-content/uploads/2020/03/you-x-ventures-Oalh2MojUuk-unsplash.jpg?resize=2000%2C1200&ssl=1',
                    'type' =>  'meeting',
                    'description' => 'مجرد وصف',
                    'price' => '50 ريال ',
                    'reservationNumber' => '212',
                    'rate' => '4.3 \\ 5 '
                ],
                [
                    'date' => '20 أكتوبر :',
                    'image' => 'https://i1.wp.com/www.manae-business.fr/wp-content/uploads/2020/03/you-x-ventures-Oalh2MojUuk-unsplash.jpg?resize=2000%2C1200&ssl=1',
                    'type' =>  'meeting',
                    'description' => 'مجرد وصف',
                    'price' => '50 ريال ',
                    'reservationNumber' => '212',
                    'rate' => '4.3 \\ 5 '
                ]
            ]
        ];

        return response()->json($api);
    }
}
