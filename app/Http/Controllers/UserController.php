<?php

namespace App\Http\Controllers;

use App\Mail\AdminCancellationMail;
use App\Mail\LeadCancellationMail;
use App\Mail\ParticipantCancellationMail;
use App\Models\BookingHistory;
use App\Models\CancellationMail;
use App\Models\CancellationRequest;
use App\Models\NewsletterSubscriber;
use App\Models\SessionEmailJob;
use App\Models\SessionLeads;
use App\Models\Slot;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function verify(Request $request)
    {
        $user = User::find($request->id);

        if (! $user) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }

        $user->verified_status = 1;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function showcancellatRequeest()
    {
        $cancellationRequests = CancellationRequest::with([
            'user' => function ($query) {
                $query->withTrashed(); // Include soft-deleted users
            },
            'slot' => function ($query) {
                $query->withTrashed(); // Include soft-deleted slots (if applicable)
            },
        ])->get();

        return view("admin.cancellation_request.index", compact('cancellationRequests'));
    }
    public function approveCancellationrequest($id)
    {
        DB::transaction(function () use ($id) {
            $request = CancellationRequest::findOrFail($id);
            $request->update(['cancellation_status' => 1]);

            // 🔹 Instead of deleting, update status = 5 (cancelled)
            SessionLeads::where('slot_id', $request->slot_id)
                ->where('user_id', $request->user_id)
                ->update(['status' => 5]);
            SessionLeads::where('slot_id', $request->slot_id)
                ->where('status', 2)
                ->update(['status' => 0]);

            $oldSlot = Slot::findOrFail($request->slot_id);

            // --- Save mails for Leads ---
            $sessionLeadUsers = SessionLeads::where('slot_id', $request->slot_id)
                ->where('status', 5) // only cancellation requester
                ->with('user:id,name,email')
                ->get();

            foreach ($sessionLeadUsers as $lead) {
                if ($lead->user && $lead->user->email) {
                    $mailable = new LeadCancellationMail($lead->user, $oldSlot);

                    CancellationMail::create([
                        'email'             => $lead->user->email,
                        'mail_template'     => $mailable->render(),
                        'role'              => 1,
                        'subject'           => 'Session Cancellation Notice',
                        'email_send_status' => 0,
                    ]);
                }
            }

            // --- Save mails for Participants ---
            $bookingUsers = BookingHistory::where('slot_id', $request->slot_id)
                ->with('user:id,name,email')
                ->get();

            foreach ($bookingUsers as $booking) {
                if ($booking->user && $booking->user->email) {
                    $mailable = new ParticipantCancellationMail($booking->user, $oldSlot);

                    CancellationMail::create([
                        'email'             => $booking->user->email,
                        'mail_template'     => $mailable->render(),
                        'role'              => 2,
                        'subject'           => 'Booking Cancellation Notice',
                        'email_send_status' => 0,
                    ]);
                }
                // 🔹 Delete booking after saving mail
                $booking->delete();
            }

            // ✅ Reset slot status to 0 (available again)
            $oldSlot->update(['status' => 0]);
        });

        return redirect()->back()->with('success', 'Cancellation Request Approved.');
    }

    public function Cancellation_request($slotId)
    {
        $userId = Auth::id();
        // Save cancellation request
        $cancellation = CancellationRequest::create([
            'slot_id'             => $slotId,
            'user_id'             => Auth::id(),
            'cancellation_status' => 0, // pending
        ]);

        // ✅ Get the latest session lead for this user & slot
        $latestLead = SessionLeads::where('slot_id', $slotId)
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->first();

        if ($latestLead) {
            // If this is not an already cancelled one, mark as cancellation pending
            if ($latestLead->status != 5) {
                $latestLead->status = 4; // cancellation pending
                $latestLead->save();
            }
            // If it's already 5, do nothing (keep cancelled status)
        }

        // Get the slot details
        $oldSlot = Slot::findOrFail($slotId);

        // Get the user who made the request
        $requestedUser = Auth::user();

        // --- Send mails directly to Admins ---
        $admins = User::where('role', 1)->get();
        foreach ($admins as $admin) {
            if ($admin->email) {
                $mailable = new AdminCancellationMail($admin, $oldSlot, $requestedUser);
                Mail::to($admin->email)->send($mailable); // 🚀 direct email
            }
        }

        return redirect()->back()->with('success', 'Your cancellation request has been sent to the admin.');
    }

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
        $endDate   = Carbon::now()->endOfDay();

        $userCount            = User::where('role', '!=', 1)->count();
        $slotCount            = Slot::count();
        $completed_slot       = Slot::where('status', 1)->count();
        $Cancellation_request = CancellationRequest::count();
        $pending_slot         = Slot::where('status', 0)->count();

        $NewUserCount = User::whereBetween('created_at', [$startDate, $endDate]);
        $recentUsers  = User::orderBy('created_at', 'desc')
            ->where('role', '!=', 1)
            ->limit(6)
            ->get();

        $recentSlot = Slot::orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('admin.admin_dashboard', compact('userCount', 'NewUserCount', 'recentUsers', 'recentSlot', 'slotCount', 'completed_slot', 'pending_slot', 'Cancellation_request'));
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
            'name'     => 'required',
            'email'    => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@mit\.edu$/',         // only allow @mit.edu emails
                Rule::unique('users')->whereNull('deleted_at'), // ignore soft-deleted users
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&^()\-_=+{}\[\]|\:;"\'<>,.\/?]).{8,}$/',
            ],
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:100000', // 100 MB
        ], [
            'email.regex'    => 'Only @mit.edu email addresses are allowed.',
            'password.regex' => 'Password must be at least 8 characters long and include at least one letter, one number, and one special character.',
        ]);

        $user           = new User;
        $user->name     = $validatedData['name'];
        $user->email    = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role     = 2; // Always set role = 2

        if ($request->hasFile('image')) {
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            $imageName      = 'image_' . time() . '.' . $imageExtension;
            $request->file('image')->move(public_path('/admin/assets/images/'), $imageName);
            $user->image = $imageName;
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
            'name'             => 'required|string|max:255',
            'email'            => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@mit\.edu$/', // Only allow @mit.edu emails
                Rule::unique('users')->ignore($id)->whereNull('deleted_at'),
            ],
            'password'         => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&^()\-_=+{}\[\]|\:;"\'<>,.\/?]).{8,}$/',
            ],
            'confirm_password' => 'nullable|string|same:password|min:8',
            'laboratory_name'  => 'nullable|string|max:255',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:100000',
        ], [
            'email.regex'           => 'Only @mit.edu email addresses are allowed.',
            'password.regex'        => 'Password must be at least 8 characters and include at least one letter, one number, and one special character.',
            'confirm_password.same' => 'Confirm password must match the password.',
        ]);

        $user                  = User::findOrFail($id);
        $user->name            = $validatedData['name'];
        $user->email           = $validatedData['email'];
        $user->laboratory_name = $validatedData['laboratory_name'] ?? null;
        // Ensure role always stays valid
        $user->role = $user->role ?? 2; // If somehow null, set to 2

        if (! empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            $imageExtension = $request->file('image')->getClientOriginalExtension();
            $imageName      = 'image_' . time() . '.' . $imageExtension;
            $request->file('image')->move(public_path('/admin/assets/images/'), $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Admin has been updated successfully.');
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
    // Add this method in your UserController
    public function checkBeforeDelete(Request $request)
    {
        $user = User::with(['sessionLeads', 'bookingHistory'])->find($request->id);

        if (! $user) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }

        $hasSessionLeads   = $user->sessionLeads && $user->sessionLeads->count() > 0;
        $hasBookingHistory = $user->bookingHistory && $user->bookingHistory->count() > 0;

        return response()->json([
            'success'           => true,
            'hasSessionLeads'   => $hasSessionLeads,
            'hasBookingHistory' => $hasBookingHistory,
            'message'           => ($hasSessionLeads || $hasBookingHistory)
                ? 'This user has ' .
                ($hasSessionLeads ? 'session leads' : '') .
                ($hasSessionLeads && $hasBookingHistory ? ' and ' : '') .
                ($hasBookingHistory ? 'booking history' : '') .
                '. Do you want to delete them along with the user?'
                : 'Are you sure you want to delete this user?',
        ]);
    }

    // Existing destroy method (keeps deletion logic)
    public function destroy(Request $request)
    {
        $user = User::with(['sessionLeads', 'bookingHistory'])->find($request->id);

        if (! $user) {
            return response()->json(['success' => false, 'message' => 'User not found']);
        }

        // Collect all related slot IDs from session leads and booking history
        $slotIds = [];

        if ($user->sessionLeads) {
            $slotIds = array_merge($slotIds, $user->sessionLeads->pluck('slot_id')->toArray());
        }

        if ($user->bookingHistory) {
            $slotIds = array_merge($slotIds, $user->bookingHistory->pluck('slot_id')->toArray());
        }

        // Remove duplicates
        $slotIds = array_unique($slotIds);

        // Update slot status to 0 for these slots
        if (! empty($slotIds)) {
            \DB::table('slots')->whereIn('id', $slotIds)->update(['status' => 0]);
        }

        // Delete related records
        $user->sessionLeads()->delete();
        $user->bookingHistory()->delete();

        // Delete user
        $user->delete();

        return response()->json(['success' => true, 'message' => 'User and related slots updated successfully']);
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

    public function exportCSV()
    {
        // Only get users with role_id = 2
        $users = User::where('role', 2)->get();

        $csvData = [];

        // Header
        $csvData[] = [
            'Name',
            'Email',
            'Email Verified Status',
            'Laboratory Name',
            'Created At',
        ];

        // Data rows
        foreach ($users as $user) {
            $csvData[] = [
                $user->name,
                $user->email,
                $user->verified_status == 1 ? 'Verified' : 'Not Verified',
                $user->laboratory_name,
                optional($user->created_at)->format('Y-m-d H:i:s'),
            ];
        }

        // Create CSV content
        $filename = 'Boost_User_List_' . now()->format('m-d-y') . '.csv';
        $handle   = fopen('php://temp', 'r+');

        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }

        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        return Response::make($csvContent, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }

    public function exportNewsletterSubscribers()
    {
        // Get all subscribers using Eloquent
        $subscribers = NewsletterSubscriber::all();

        // Prepare CSV data
        $csvData   = [];
        $csvData[] = ['Email', 'Date']; // Header row

        foreach ($subscribers as $subscriber) {
            $csvData[] = [
                $subscriber->email,
                $subscriber->date,
            ];
        }

        // Create CSV content
        $output = fopen('php://temp', 'r+');
        foreach ($csvData as $row) {
            fputcsv($output, $row);
        }
        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        $filename = 'boost_newsletter_subscribers_' . now()->format('Y-m-d') . 'csv';

        // Return CSV as a download response
        return Response::make($csv, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    public function resetSystem(Request $request)
    {
        // Require exact lowercase 'delete'
        if ($request->input('confirm') !== 'delete') {
            return back()->with('error', 'Confirmation word is incorrect. Please type "delete" in lowercase.');
        }

        try {
            DB::beginTransaction();

            // Delete users with role = 2 (including soft-deleted ones)
            User::withTrashed()->where('role', 2)->forceDelete();

            // Truncate other tables (truncate removes all, including soft-deleted rows)
            NewsletterSubscriber::truncate();
            Slot::truncate();
            SessionLeads::truncate();
            BookingHistory::truncate();
            SessionEmailJob::truncate();
            CancellationRequest::truncate();
            CancellationMail::truncate();

            DB::commit();

            return back()->with('success', 'System has been reset successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'System reset failed: ' . $e->getMessage());
        }
    }
}
