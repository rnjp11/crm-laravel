<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\Enquiry;
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
                ->get();
        } else {
            $enquiries = [];
        }

        $services = DB::table('services')->where('status', 'Active')->get();
        $references = DB::table('references')->where('status', 'Active')->get();
        $cities = DB::table('cities')->where('status', 'Active')->get();

        $userid = session()->get('userid');
        $iseditable = session()->get('roleid') == 2;

        return view('enquiry-show', compact('enquiries', 'services', 'references', 'cities', 'userid', 'status', 'iseditable'));
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
}
