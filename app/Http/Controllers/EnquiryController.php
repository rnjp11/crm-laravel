<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Message;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Validator;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        if (!session()->has('userid')) {
            redirect('/login')->send();
        }
        $userid = session()->get('userid');
        $enquiries = DB::table('enquiries')
            ->join('services', 'enquiries.service', '=', 'services.id')
            ->join('references', 'enquiries.reference', '=', 'references.id')
            ->join('cities', 'enquiries.city', '=', 'cities.id')
            ->select(
                'enquiries.*',
                'services.name as service_name',
                'references.name as reference_name',
                'cities.name as city_name'
            )
            ->where('enquiries.user_id', $userid)
            ->get();
        $services = DB::table('services')->where('status', 'Active')->get();
        $references = DB::table('references')->where('status', 'Active')->get();
        $cities = DB::table('cities')->where('status', 'Active')->get();
        $users = DB::table('users')->whereNot('id', $userid)->get();

        return view('enquiry', compact('enquiries', 'services', 'references', 'cities', 'userid', 'users'));
    }

    // Insert
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'mobile' => 'required|max:10|unique:enquiries,mobile',
            'service' => 'required',
            'reference' => 'required',
            'city' => 'required',
            'date' => 'required',
            'type' => 'nullable|in:Hot,Warm,Cold',
        ], [
            'mobile.unique' => 'The mobile number already exists.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $save = Enquiry::create($request->only('name', 'email', 'mobile', 'service', 'reference', 'city', 'type', 'date', 'user_id'));

        if ($save) {
            return response()->json(['status' => 1, 'message' => 'Enquiry saved successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong!']);
        }
    }

    // Edit - Return JSON for filling form
    public function edit($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        return response()->json($enquiry);
    }

    // Update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'mobile' => 'required|digits:10|unique:enquiries,mobile,' . $id,
            'service' => 'required',
            'reference' => 'required',
            'city' => 'required',
            'date' => 'required|date',
            'type' => 'nullable|in:Hot,Warm,Cold',
        ], [
            'mobile.unique' => 'The mobile number already exists.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $enquiry = Enquiry::findOrFail($id);
        $updated = $enquiry->update($request->only('name', 'email', 'mobile', 'service', 'reference', 'city', 'type', 'date'));

        if ($updated) {
            return response()->json(['status' => 1, 'message' => 'Enquiry updated successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong!']);
        }
    }


    // Delete
    public function destroy($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->delete();

        return response()->json(['message' => 'Deleted']);
    }

    public function bulkDelete(Request $request)
    {
        Enquiry::whereIn('id', $request->ids)->delete();
        return response()->json(['success' => true]);
    }

    public function downloadPdf(Request $request)
    {
        $userid = session()->get('userid');
        $enquiries = DB::table('enquiries')
            ->join('services', 'enquiries.service', '=', 'services.id')
            ->join('references', 'enquiries.reference', '=', 'references.id')
            ->join('cities', 'enquiries.city', '=', 'cities.id')
            ->select(
                'enquiries.*',
                'services.name as service_name',
                'references.name as reference_name',
                'cities.name as city_name'
            )
            ->where('enquiries.user_id', $userid)
            ->get();

        $pdf = Pdf::loadView('pdf.enquiries', ['enquiries' => $enquiries]);
        return $pdf->download('enquiries.pdf');
    }

    public function sendEnquiryEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'id' => 'required|exists:enquiries,id',
            'followupdate' => 'required|date',
            'message' => 'required|string',
        ]);

        try {
            $email = $request->email;
            $enquiry_id = $request->id;
            $followUpDate = $request->followupdate;
            $textmessage = $request->message;

            $emailContent = "Date: {$followUpDate}\nMessage: {$textmessage}";

            FacadesMail::raw($emailContent, function ($msg) use ($email) {
                $msg->to($email)->subject('Follow-up Enquiry');
            });

            $message = new Message();
            $message->message = $textmessage;
            $message->followup_date = $followUpDate;
            $message->customer_id = $enquiry_id;
            $message->save();

            return response()->json(['status' => 1, 'message' => 'Email sent successfully']);
        } catch (\Exception $e) {
            Log::error('Mail sending failed: ' . $e->getMessage());
            return response()->json(['status' => 0, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
    public function assignEnquiry(Request $request)
    {
        $enquiry = Enquiry::findOrFail($request->id);
        $enquiry->assigned_by = $request->assignBy;
        $enquiry->assigned_to = $request->assignTo;
        $enquiry->user_id = $request->assignTo;

        $updated = $enquiry->save(); // returns true if changes were made

        if ($updated) {
            return response()->json(['status' => 1, 'message' => 'Task Assigned successfully']);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong!']);
        }
    }
}
