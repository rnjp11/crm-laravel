<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // dd($re)
        if (!session()->has('userid')) {
            return redirect('/login');
        }

        $userid = session()->get('userid');
        $hotLeads = Enquiry::where('type', 'Hot')
            ->whereNotIn('status', ['Cancelled', 'Converted'])
            ->where('user_id', $userid)
            ->count();
        // dd($hotLeads);

        $warmLeads = Enquiry::where('type', 'Warm')
            ->whereNotIn('status', ['Cancelled', 'Converted'])
            ->where('user_id', $userid)
            ->count();

        $coldLeads = Enquiry::where('type', 'Cold')
            ->whereNotIn('status', ['Cancelled', 'Converted'])
            ->where('user_id', $userid)
            ->count();
        $convertedLeads = Enquiry::where('status', 'Converted')
            ->where('user_id', $userid)
            ->count();

        $cancelledLeads = Enquiry::where('status', 'Cancelled')
            ->where('user_id', $userid)
            ->count();
            
        $assignedLeads = Enquiry::where('assigned_by', $userid)->orwhere('assigned_to', $userid)->count();

        $today = Carbon::today(); // today's date (00:00:00)
        $todayEnquiry = Enquiry::where('status', 'left')->whereDate('date', '<=', $today)->where('user_id', $userid)->get();

        $thirtyDaysAgo = Carbon::today()->subDays(29); // Including today as 1 day

        $monthEnquiry = Enquiry::where('status', 'Pending')
            ->whereBetween('date', [$thirtyDaysAgo, $today])
            ->where('user_id', $userid)
            ->get();

        return view('index', compact('hotLeads', 'warmLeads', 'coldLeads', 'convertedLeads', 'cancelledLeads', 'assignedLeads', 'todayEnquiry', 'monthEnquiry', 'userid'));
    }

    public function updateStatus(Request $request)
    {
        $enquiry = Enquiry::find($request->id);

        if (!$enquiry) {
            return response()->json(['success' => false, 'message' => 'Enquiry not found']);
        }

        $enquiry->status = $request->status;

        // Store user ID from session
        if (session()->has('userid')) {
            $enquiry->converted_by = session('userid');
        }

        // Save reason if cancelled
        if ($request->status === 'Cancelled' && $request->has('reason')) {
            $enquiry->reason = $request->reason;
        }

        $enquiry->save();

        return response()->json(['success' => true, 'message' => 'Status updated']);
    }

    public function getMessages($enquiryId)
    {
        $messages = Message::where('customer_id', $enquiryId)->get(['followup_date', 'message']);
        return response()->json($messages);
    }
}
