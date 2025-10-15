<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredVerification;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showRegistrationForm()
    {
        return view('auth.register');  // Make sure this Blade file exists
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Laravel event - still allows use of 'registered()' method below
        event(new Registered($user));

        // Call registered() manually, and redirect to login
        return $this->registered($request, $user)
            ?: redirect()->route('login')->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/@mit\.edu$/',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&^()\-_=+{}\[\]|\:;"\'<>,.\/?]).{8,}$/'
            ],
        ], [
            'email.regex' => 'You must register with an @mit.edu email address.',
            'password.regex' => 'Password must be at least 8 characters long and include at least one letter, one number, and one special character.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Check if the user already exists based on the email
        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            // If the user doesn't exist, create a new user
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'laboratory_name' => $data['laboratory_name'],
                'password' => Hash::make($data['password']),
            ]);
        }

        return $user;
    }

    // protected function registered(Request $request, $user)
    // {
    //     // Send registration email (optional)
    //     $registeremail = [
    //         'email' => $user->email,
    //     ];
    //     Mail::to($user->email)->send(new RegisterEmail($registeremail));

    //     session()->flash('success', 'Registration successful! Welcome, ' . $user->name . '.');
    //     return redirect()->route('user.user_dashboard');
    // }

    protected function registered(Request $request, $user)
    {
        // Generate email verification token
        $token = Str::random(64);
        $user->email_verification_token = $token;
        $user->verified_status = 0;  // Ensure it's set to 0 at registration
        $user->save();

        // Prepare verification link
        $verificationLink = route('verify.email', ['token' => $token]);

        // Send verification email
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'verification_link' => $verificationLink,
        ];
        Mail::to($user->email)->send(new UserRegisteredVerification($data));

        // Flash success message
        session()->flash('success', 'Registration successful! Please check your email to verify your account.');

        // Redirect to login page
        return redirect()->route('login');
    }

    public function verifyEmail($token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid or expired verification link.');
        }

        $user->email_verified_at = now();
        $user->email_verification_token = null;
        $user->verified_status = 1;  // Set as verified
        $user->save();

        return redirect()->route('login')->with('success', 'Email verified successfully! You can now log in.');
    }
}
