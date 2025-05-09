<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\Enquiry;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EnquiryshowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!session()->has('userid')) {
            redirect('/login')->send();
        }
        $userid = session()->get('userid');

        $status = $request->query('status') ?? '';
        if ($status == "Hot" || $status == "Warm" || $status == "Cold") {
            $enquiries = DB::table('enquiries')
                ->join('services', 'enquiries.service', '=', 'services.id')
                ->join('references', 'enquiries.reference', '=', 'references.id')
                ->join('cities', 'enquiries.city', '=', 'cities.id')
                ->select(
                    'enquiries.*',
                    'services.name as service_name',
                    'references.name as reference_name',
                    'cities.name as city_name'
                )->where('enquiries.type', $status)
                ->whereNotIn('enquiries.status', ['Cancelled', 'Converted'])
                ->where('user_id', $userid)
                ->get();
        } elseif ($status == "Cancelled" || $status == "Converted") {
            $enquiries = DB::table('enquiries')
                ->join('services', 'enquiries.service', '=', 'services.id')
                ->join('references', 'enquiries.reference', '=', 'references.id')
                ->join('cities', 'enquiries.city', '=', 'cities.id')
                ->join('users', 'enquiries.converted_by', '=', 'users.id')
                ->select(
                    'enquiries.*',
                    'services.name as service_name',
                    'references.name as reference_name',
                    'cities.name as city_name',
                    'users.name as user_name'
                )->where('enquiries.status', $status)
                ->where('user_id', $userid)
                ->get();
        } elseif ($status == "Assigned") {
            $enquiries = DB::table('enquiries')
                ->leftJoin('services', 'enquiries.service', '=', 'services.id')
                ->leftJoin('references', 'enquiries.reference', '=', 'references.id')
                ->leftJoin('cities', 'enquiries.city', '=', 'cities.id')
                ->leftJoin('users as converted_user', 'enquiries.converted_by', '=', 'converted_user.id')
                ->leftJoin('users as assigned_to_user', 'enquiries.assigned_to', '=', 'assigned_to_user.id')
                ->leftJoin('users as assigned_by_user', 'enquiries.assigned_by', '=', 'assigned_by_user.id')
                ->select(
                    'enquiries.*',
                    'services.name as service_name',
                    'references.name as reference_name',
                    'cities.name as city_name',
                    'converted_user.name as converted_user_name',
                    'assigned_to_user.name as assigned_to_name',
                    'assigned_by_user.name as assigned_by_name'
                )
                ->where('assigned_to', $userid)
                ->orWhere('assigned_by', $userid)
                ->get();
        } else {
            $enquiries = [];
        }

        $services = DB::table('services')->where('status', 'Active')->get();
        $references = DB::table('references')->where('status', 'Active')->get();
        $cities = DB::table('cities')->where('status', 'Active')->get();
        $users = DB::table('users')->get();

        $userid = session()->get('userid');
        $iseditable = true;

        return view('enquiry-show', compact('enquiries', 'services', 'references', 'cities', 'userid', 'status', 'iseditable', 'users'));
    }


    // Edit - Return JSON for filling form
    public function edit($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $messages = Message::where('customer_id', $id)->get();

        return response()->json([
            'enquiry' => $enquiry,
            'messages' => $messages
        ]);
    }

    // Update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'mobile' => 'required|max:10',
            'service' => 'required',
            'reference' => 'required',
            'city' => 'required',
            'date' => 'required',
            'type' => 'nullable|in:Hot,Warm,Cold',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        };

        $enquiry = Enquiry::findOrFail($id);
        $updated = $enquiry->update($request->only('name', 'email', 'mobile', 'service', 'reference', 'city', 'type', 'date'));
        if ($request->description != "") {
            Message::create([
                'customer_id'   => $request->id,
                'message'       => $request->description,
                'followup_date' => $request->date,
            ]);
        }
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

    public function viewmodal(Request $request)
    {
        // dd($request->id);
        $enquiry = Enquiry::findOrFail($request->id);
        $service = DB::table('services')->where('id', $enquiry->service)->value('name');
        $references = DB::table('references')->where('id', $enquiry->reference)->value('name');
        $city = DB::table('cities')->where('id', $enquiry->city)->value('name');
        $messages = DB::table('messages')->where('customer_id', $request->id)->select('followup_date', 'message')->get();
        if ($enquiry) {
            $messageHtml = '';
            if (count($messages)) {
                foreach ($messages as $msg) {
                    $messageHtml .= "<div>
                        <strong>Follow-up Date:</strong> {$msg->followup_date}<br>
                        <strong>Message:</strong> {$msg->message}
                        <hr>
                    </div>";
                }
            } else {
                $messageHtml = "<em>No messages yet.</em>";
            }

            $response = <<<HTML
                <table class="table table-bordered">
                    <tr><th>Name</th><td>{$enquiry->name}</td></tr>
                    <tr><th>Email</th><td>{$enquiry->email}</td></tr>
                    <tr><th>Mobile</th><td>{$enquiry->mobile}</td></tr>
                    <tr><th>Service</th><td>{$service}</td></tr>
                    <tr><th>Reference</th><td>{$references}</td></tr>
                    <tr><th>City</th><td>{$city}</td></tr>
                    <tr><th>Follow-up Date</th><td>{$enquiry->date}</td></tr>
                    <tr><th>Type</th><td>{$enquiry->type}</td></tr>
                    <tr><th>Description</th><td>{$messageHtml}</td></tr>
                </table>
            HTML;
        }


        return $response;
    }
}
