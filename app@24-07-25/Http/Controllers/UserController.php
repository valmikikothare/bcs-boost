<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Slot;
use App\Models\User;
use Aws\S3\S3Client;
use App\Mail\SendMail;
use League\Csv\Reader;
use App\Mail\SendTitle;
use App\Models\Contact;
use App\Models\Fooditem;
use App\Models\Sidedish;
use App\Models\Managediet;
use App\Models\Managemeat;
use App\Models\Newsletter;
use App\Models\Managetaste;

use Illuminate\Http\Request;
use App\Models\Managekitchen;
use App\Models\Managevegetable;

use App\Models\Managepreference;
use App\Models\Managepreparation;
use App\Models\NewsletterSubscriber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function user_list(Request $request)
{
    $users = User::where('role', '!=', 1)->get();
    // dd($users);

    return view('admin.users.index', compact('users'));
}
    





    public function create()
    {

        return view('admin.users.create');
    }

    public function admin_dashboard()
    {
        $startDate = Carbon::now()->subDays(7)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $userCount = User::count();
        $slotCount = Slot::count();
        $completed_slot = Slot::where('status',1)->count();
        $pending_slot = Slot::where('status',0)->count();

        $NewUserCount = User::whereBetween('created_at', [$startDate, $endDate]);
        $recentUsers = User::orderBy('created_at', 'desc')->limit(6)
                    ->get();

        $recentSlot = Slot::orderBy('created_at', 'desc')->limit(6)
                    ->get();

        return view('admin.admin_dashboard', compact('userCount', 'NewUserCount','recentUsers','recentSlot','slotCount','completed_slot','pending_slot'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:100000', // 100 MB (100000 KB)

        ]);
    
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     // $imageName = time().'.'.$image->extension();
        //     // $image->move(public_path('images/user'), $imageName);
        //     $imageName = $this->upload_image_s3_bucket('user',$image);

        //     $user->image = $imageName;
        // }

        if ($request->hasFile('image')) {
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            $imageName = 'image_' . time() . '.' . $imageExtension;
            $request->file('image')->move(public_path('/admin/assets/images/'), $imageName);
            $user->image =  $imageName;
        }
        
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User has been created successfully.');
    }
     
    /**
     * Display the specified resource.
     *
     * @param  \App\user  $company
     * @return \Illuminate\Http\Response
     */
    public function show(user $users)
    {
        return view('admin.users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\user  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('admin.users.edit', compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\user  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|string|min:8',
            'confirm_password' => 'nullable|string|min:8|same:password',


        ]);

        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

     
        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            $imageName = 'image_' . time() . '.' . $imageExtension;
            $request->file('image')->move(public_path('/admin/assets/images/'), $imageName);
            $user->image =  $imageName;
        }
    

        $user->save();

        return redirect()->route('users.index')->with('success', 'Admin Has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\user  $company
     * @return \Illuminate\Http\Response
     */
    // public function destroy(User $user) // Use $user instead of $users
    // {
    //     $user->delete();
    //     return redirect()->route('admin.users.index')->with('success', 'User has been deleted successfully'); // Updated success message
    // }

    public function destroy(Request $request)
    {
        $user = User::find($request->id);
        if (!$user) {
            return redirect()->route('admin.users.index')->with('error', 'user  not found.');
        }

        $user->delete();
        return response()->json(['success' => true, 'message' => 'user deleted successfully']);

    }

   
 

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function indexslot()
    {
        $slots = Slot::all();
        return view('slots.index', compact('slots'));
    }
    
   
    
    
}