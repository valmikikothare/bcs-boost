<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use App\Models\SessionLeads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class SlotController extends Controller
{


    public function index()
    {
        $today = Carbon::today();
        $slots = Slot::withCount('bookinghistory')->orderByRaw('ABS(DATEDIFF(date, ?))', [$today])->get();
       
        return view('slots.index', compact('slots'));
    }


    public function view_attendees($id){
        $attendees_list = Slot::where('id',$id)->with(['bookinghistory','bookinghistory.user'])->first();
        return view('slots.view_attendees', compact('attendees_list',));
    }


    // Show the form for creating a new slot
    public function create()
    {
        return view('slots.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'date' => 'required', 
            'start_time' => 'required',
            'end_time' => ['required',
                function ($attribute, $value, $fail) use ($request) {
                    // Convert both start time and end time to Carbon instances using the m-d-Y date
                    try {
                        $startDateTime = \Carbon\Carbon::createFromFormat('m-d-Y h:i A', $request->date . ' ' . $request->start_time);
                        $endDateTime = \Carbon\Carbon::createFromFormat('m-d-Y h:i A', $request->date . ' ' . $value);
    
                        // Ensure the end time is greater than the start time
                        if ($endDateTime->lte($startDateTime)) {
                            $fail('The end time must be after the start time.');
                        }
                    } catch (\Exception $e) {
                        // Catch any exceptions related to date/time formatting
                        $fail('Invalid date/time format.');
                    }
                },
            ],
            'no_of_attendees' => 'required|integer|min:1',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        // Convert the date from m-d-Y to Y-m-d
        $date = \Carbon\Carbon::createFromFormat('m-d-Y', $request->date)->format('Y-m-d');
        
        // Convert start time and end time to 24-hour format (HH:mm:ss)
        $start_time = \Carbon\Carbon::createFromFormat('h:i A', $request->start_time)->format('H:i:s');
        $end_time = \Carbon\Carbon::createFromFormat('h:i A', $request->end_time)->format('H:i:s');
    
        // Merge the converted values into the request
        $request->merge([
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);
    
        // Create the new Slot entry
        Slot::create($request->all());
    
        return response()->json(['success' => true]);
    }
    



    // Show the form for editing a specific slot
    public function edit(Slot $slot)
    {
        return response()->json([
            'slot' => [
                'id' => $slot->id,
                'name' => $slot->name,
                'date' => $slot->date,
                'start_time' => $slot->start_time,
                'end_time' => $slot->end_time,
                'no_of_attendees' => $slot->no_of_attendees,
            ],
        ]);
    }


    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'date' => 'required|date_format:m-d-Y', // Expecting m-d-Y format
            'start_time' => 'required',
            'end_time' => ['required',
                function ($attribute, $value, $fail) use ($request) {
                    // Convert both start time and end time to 24-hour format before comparison
                    $startDateTime = \Carbon\Carbon::createFromFormat('m-d-Y h:i A', $request->date . ' ' . $request->start_time);
                    $endDateTime = \Carbon\Carbon::createFromFormat('m-d-Y h:i A', $request->date . ' ' . $value);
                    if ($endDateTime->lte($startDateTime)) {
                        $fail('The end time must be after the start time.');
                    }
                },
            ],
            'no_of_attendees' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Convert the date from m-d-Y to Y-m-d
        $date = \Carbon\Carbon::createFromFormat('m-d-Y', $request->date)->format('Y-m-d');

        // Convert start time and end time to 24-hour format (HH:mm:ss) before saving to the database
        $start_time = \Carbon\Carbon::createFromFormat('h:i A', $request->start_time)->format('H:i:s');
        $end_time = \Carbon\Carbon::createFromFormat('h:i A', $request->end_time)->format('H:i:s');

        // Merge the converted values into the request
        $request->merge([
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
        ]);

        // Find the slot and update it
        $slot = Slot::findOrFail($id);
        $slot->update($request->all());

        return response()->json(['success' => true]);
    }



    // Delete a specific slot from the database
    public function destroy($slot)
    {
        $slot = Slot::findOrFail($slot);

        try {
            $slot->delete();
            return response()->json(['success' => true, 'message' => 'Slot deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete slot.']);
        }
    }



    public function showLeads(Slot $slot)
    {
        $leads = SessionLeads::where('slot_id', $slot->id)
            ->with('user') // Assuming you have a relationship with the User model
            ->get();

        return view('slots.leads', compact('slot', 'leads'));
    }
    // public function approveLead(Request $request, $leadId)
// {
//     $lead = SessionLeads::find($leadId);

    //     if ($lead) {
//         // Approve the lead
//         $lead->status = 1; // Approved
//         $lead->save();

    //         // Update the slot's status to approved
//         $slot = $lead->slot; // Assuming a relationship exists
//         if ($slot) {
//             $slot->status = 1; // Approved
//             $slot->save();
//         }

    //         return response()->json(['success' => true, 'message' => 'Lead and slot approved successfully.']);
//     }

    //     return response()->json(['success' => false, 'message' => 'Lead not found.'], 404);
// }




    public function approveLead(Request $request, $leadId)
    {
        // Find the lead to be approved
        $lead = SessionLeads::find($leadId);

        if ($lead) {
            // Approve the lead (set status to 1)
            $lead->status = 1;
            $lead->save();

            // Find all other leads with the same slot_id and set their status to 2
            SessionLeads::where('slot_id', $lead->slot_id)
                ->where('id', '!=', $leadId) // Exclude the current lead
                ->update(['status' => 2]);

            // Optionally, update the slot status as well if needed
            $slot = $lead->slot; // Assuming a relationship exists
            if ($slot) {
                $slot->status = 1; 
                $slot->save();
            }

            return response()->json(['success' => true, 'message' => 'Lead approved and other leads updated.']);
        }

        return response()->json(['success' => false, 'message' => 'Lead not found.'], 404);
    }




    public function approve($id)
    {
        $slot = Slot::findOrFail($id);
        $slot->status = 1;
        $slot->save();

        return response()->json(['success' => true, 'message' => 'Slot approved successfully.']);
    }

    public function markas_complete($id)
{


    $slot = SessionLeads::where('id', $id)
                        ->first();

    if (!$slot) {
        return response()->json(['success' => false, 'message' => 'Slot not found or you do not have access to this slot.']);
    }
    
    $slotdata = Slot::where('id',$slot->slot_id)->first();
    $slotdata->status = 2;
    $slotdata->save();

    $slot->status = 3;
    $slot->save();

    return redirect()->back()->with('success', 'The slot has been marked as completed.');
}



    

}