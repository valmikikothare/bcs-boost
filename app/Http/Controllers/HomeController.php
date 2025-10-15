<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Forum;
use App\Models\Contact;
use App\Models\Fooditem;
use App\Models\Sidedish;
use App\Models\Managediet;
use App\Models\Managemeat;
use App\Models\Newsletter;
use App\Models\ForumAnswer;
use App\Models\Managetaste;
use Illuminate\Http\Request;
use App\Models\Managekitchen;
use App\Models\Managevegetable;
use App\Models\Managepreference;
use App\Models\Managepreparation;
use App\Models\RandomDishCounter;
use App\Mail\DynamicTemplateEmail;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home_page(Request $request)
    {
     
        return view('frontend.home_page');
    }


    function food_item_suggestions(Request $request)
    {
        $keyword = $request->keyword;
        $suggestions = FoodItem::where('name', 'like', '%' . $keyword . '%')->get();
        $html = '<ul id="suggestionlist">';
        foreach ($suggestions as $fooditem) {
            $html .= '<a class="suggetionopt d-block" href="' . route('dishdetails', [base64_encode($fooditem->id)]) . '" onClick="selectCountry(\'' . $fooditem->name . '\');">';

            $html .= $fooditem->name;
            $html .= '</a>';
        }
        $html .= '</ul>';
        return $html;
    }


    public function generate_random_dish(Request $request) {
        $fooditems = Fooditem::all();
        $randomFoodItem = $fooditems->random();
        
        $RandomDishCounter = new RandomDishCounter;
        $RandomDishCounter->ip_address = $request->ip();
        $RandomDishCounter->save();

        $generateCount = RandomDishCounter::where('ip_address',$request->ip())->count();


        $html = '<div class="p-4 rounded-3 border border-warning" id="food_generator">
                    <div class="row g-lg-5 g-3 align-items-center">
                        <div class="col-md-6">
                            <div class="">
                                <img src="' . env('AWS_URL').env('AWS_S3_FOLDER_NAME') . $randomFoodItem->image . '" class="rounded-5" alt="food-img" style="
                                width: 500px;         
                                height: 290px;
                            " />
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="pe-3">
                                <h2 class="pb-4">' . $randomFoodItem->name . '</h2>
    
                                <ul class="list-unstyled d-flex flex-wrap justify-content-between pb-4">
                                    <li>
                                        <p><span class="text-warning pe-2"><i class="fa-regular fa-clock"></i></span>' . $randomFoodItem->type_meal . '</p>
                                    </li>
                                    <li>
                                        <p><span class="text-warning pe-2"><i class="fa-regular fa-clock"></i></span>' . $randomFoodItem->time . '</p>
                                    </li>
                                    <li>
                                        <p><span class="text-warning pe-2"><i class="fa-regular fa-user"></i></span>' . $randomFoodItem->portions . '</p>
                                    </li>
                                </ul>
    
                                <p class="pb-4">' . $randomFoodItem->short_desc . '
                                </p>
    
                                <div>
                                    <a href="' .  route('dishdetails',[base64_encode($randomFoodItem->id)]). '" class="btn btn-primary rounded-pill">View Dish</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';

                return response()->json([
                    'html'=> $html,
                    'count'=>$generateCount,
                ]);
      
    }
    

    public function contact()
    {

        return view('frontend.contact');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function privacypolicy()
    {

        return view('frontend.privacypolicy');
    }

    public function faq()
    {

        return view('frontend.faq');
    }

    public function terms()
    {

        return view('frontend.terms');
    }

    public function recipes()
    {

        return view('frontend.recipes');
    }

    public function forums()
    {
        $forums = Forum::withCount('answers')->with('user')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('frontend.forums',compact('forums'));
    }

    public function store_forum(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Forum::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::User()->id,
        ]);

        return redirect()->route('views.forums')->with('success', 'Forum post created successfully.');
    }

    public function forumdetails($id)
    {
        $forum_id = base64_decode($id);
        $forumData = Forum::with('user','forumansers','forumansers.answeruser')->where('id',$forum_id)->first();
        // $likesCount = Like::where('user_id', Auth::User()->id)->where('likeable_id', $forum_id)->count();
        return view('frontend.details',compact('forumData'));
    }


    public function store_forum_answer(Request $request)
    {
        $request->validate([
            'answer' => 'required',
            'forum_id' => 'required',
        ]);

        ForumAnswer::create([
            'answer' => $request->answer,
            'forum_id' => $request->forum_id,
            'user_id' => Auth::User()->id,
        ]);

        return redirect('forumdetails/'.base64_encode($request->forum_id))->with('success', 'Your answer has been successfully submited.');
    }
    


    public function editreply($id)
{
    $reply = ForumAnswer::find($id);
    return view('frontend.editreply', compact('reply'));
}

public function deleteReply($id)
{
    $reply = ForumAnswer::find($id);
    $reply->delete();
    return redirect()->back()->with('success', 'Reply deleted successfully');
}

public function updateReply(Request $request, $id)
{
    $reply = ForumAnswer::find($id);

    if (Auth::user()->id !== $reply->answeruser->id) {
        return redirect()->back()->with('error', 'You are not authorized to edit this reply');
    }

    $validator = Validator::make($request->all(), [
        'answer' => 'required|string',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $reply->update([
        'answer' => $request->input('answer'),
    ]);

    return redirect()->route('views.forumdetails', ['id' =>base64_encode($reply->forum_id)])->with('success', 'Reply updated successfully');
}

public function Like($type, $id)
{
    if (Auth::check()) {
        $user = Auth::user();
        $likeableType = ($type === 'question') ? Forum::class : ForumAnswer::class;
        $likeable = Like::where('likeable_id', $id)
                        ->where('likeable_type', 'App\\Models\\' . ucfirst($type))
                        ->where('user_id', $user->id)
                        ->first();

        if ($likeable) {
            // User has already liked the post, so let's remove the like
            $likeable->delete();
        } else {
            // User hasn't liked the post, so let's add the like
            Like::create([
                'user_id' => $user->id,
                'likeable_id' => $id,
                'likeable_type' => 'App\\Models\\' . ucfirst($type),
                'type' => 'like',
            ]);
        }

        $likesCount = Like::where('likeable_id', $id)
                          ->where('likeable_type', 'App\\Models\\' . ucfirst($type))
                          ->where('type', 'like')
                          ->count();

        $dislikesCount = Like::where('likeable_id', $id)
                             ->where('likeable_type', 'App\\Models\\' . ucfirst($type))
                             ->where('type', 'dislike')
                             ->count();

        $forumData = Forum::find($id);
        $forumData->likes_count = $likesCount;
        $forumData->dislikes_count = $dislikesCount;
        $forumData->save();
    } else {
        return redirect()->back()->with('error', 'You are not logged in.');
    }

    return redirect()->back();
}







// public function like($type, $id)
// {
//     $user_id = Auth::id();

//     if (Auth::check()) {
//         $likeableType = ($type === 'question') ? Forum::class : ForumAnswer::class;
//         $likeable = Like::where('likeable_id', $id)
//                         ->where('likeable_type', 'App\\Models\\' . ucfirst($type))
//                         ->where('user_id', $user_id)
//                         ->first();

//         if (!$likeable) {
//             Like::create([
//                 'user_id' => $user_id,
//                 'likeable_id' => $id,
//                 'likeable_type' => 'App\\Models\\' . ucfirst($type),
//                 'type' => 'like', 
//             ]); 
//         } else {
//             return redirect()->back()->with('error', 'You have already liked this post.');
//         }

//         $likesCount = Like::where('likeable_id', $id)
//                           ->where('likeable_type', 'App\\Models\\' . ucfirst($type))
//                           ->where('type', 'like')
//                           ->count();

//         $forumData = Forum::find($id);
//         $forumData->likes_count = $likesCount;
//         $forumData->save();
//     } else {
//         return redirect()->back()->with('error', 'You are not logged in.');
//     }

//     return redirect()->back();
// }



// public function dislike($type, $id)
// {
//     if (Auth::check()) {
//         $user = Auth::user();
//         $likeableType = ($type === 'question') ? Forum::class : ForumAnswer::class;
//         $likeable = Like::where('likeable_id', $id)
//                         ->where('likeable_type', 'App\\Models\\' . ucfirst($type))
//                         ->where('user_id', $user->id)
//                         ->first();

//         if (!$likeable) {
//             Like::create([
//                 'user_id' => $user->id,
//                 'likeable_id' => $id,
//                 'likeable_type' => 'App\\Models\\' . ucfirst($type),
//                 'type' => 'dislike',
//             ]);
//         } else {
//             return redirect()->back()->with('error', 'You have already disliked this post.');
//         }

//             $dislikesCount = Like::where('likeable_id', $id)
//                                  ->where('likeable_type', 'App\\Models\\' . ucfirst($type))
//                                  ->where('type', 'dislike')
//                                  ->count();

//             $forumData = Forum::find($id);
//             $forumData->dislikes_count = $dislikesCount;
//             $forumData->save();
       
//     } else {
//         return redirect()->back()->with('error', 'You are not logged in.');
//     }

//     return redirect()->back();
// }





    public function dashboard()
    {
        return view('frontend.home_page');
    }

   

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function viewallcuisine()
    {

   
    
        $kitchens = Managekitchen::all();
      
       
        return view('frontend.viewallcuisine', compact('kitchens'));
    }

    public function dishdetails($id="")
    {
        $fooditems = Fooditem::where('id',base64_decode($id))->first();
        $ketech_data = Managekitchen::get();
        return view('frontend.dishdetails',compact('fooditems','ketech_data'));
    }

    public function Contact_us(Request $request)
    {
      $contact = new Contact;
      $contact->name=$request->name;
      $contact->email=$request->email;
      $contact->message=$request->message;
      $contact->save();
      return redirect()->route('home_page')->with('success', 'Contact details successfully save.'); 
    }

    public function save_email(Request $request){
      $users = new NewsletterSubscriber ;
      $users->email=$request->email;
      $users->save();
      return redirect()->route('home_page')->with('success', 'Email successfully send.');
    }

    public function setLocale(Request $request)
    {
        $locale = $request->input('locale', 'en');

        Cookie::queue(Cookie::forever('language', $locale));
        $request->session()->put('locale', $locale);

        // dd($locale);
        // if (auth()->check()) {
        //     $user = auth()->user();
        //     $user->update(['language' => $locale]);
        // } else {
        //     Cookie::queue(Cookie::forever('language', $locale));
        //     $request->session()->put('locale', $locale);
        // }
    
        app()->setLocale($locale);
    
        return redirect()->back();
    }
    public function dishes_menu($kitchen){
   
        // $kitchens = Managekitchen::all();
        $kitchens = ManageKitchen::where('id',$kitchen)->get();
        // dd($kitchens);die;
        // return view('frontend.members.food_image_add', compact('kitchens'));
          $fooditems = Fooditem::get();
          $fooditems =  Fooditem::where('kitchen_region', $kitchen)->get();
        // dd($fooditems);die;
        return view('frontend.members.food_image_add', compact('fooditems','kitchens'));
    }



    
    // public function forgetpassword(Request $request)
    // {
       
    //     $userdata=
        
    //         $confirmationLink = 'https://example.com/confirm-email'; // Replace with actual confirmation link
    //         $data = [
    //             'alias_name' => 'tow_request',
    //             'name' => 'My name Is ashish TOmar',
    //             'confirmation_link' => $confirmationLink,
    //         ];
    //     Mail::to($userdata->user->email)->send(new DynamicTemplateEmail($data));
    
    //     if (count(Mail::failures()) > 0) {
    //         return response()->json([
    //             'success' => "Some Error",
    //             'status' => 0,
    //         ]);
    //     } else {
    //         // $sendTo = $data->user->id;
    //         // $sendBy = $request->userId;
    
    //         // $existingRecord = SendTowRequestHistory::where('send_to', $sendTo)
    //         //     ->where('send_by', $sendBy)
    //         //     ->exists();
    
    //         // if (!$existingRecord) {
    //         //     SendTowRequestHistory::create([
    //         //         'send_to' => $sendTo,
    //         //         'send_by' => $sendBy,
    //         //     ]);
    //         // }
    
    //         return response()->json([
    //             'success' => "Successfully Sent",
    //             'status' => 1,
    //         ]);
    //     }
    // }
}