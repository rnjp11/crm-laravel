<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session()->has('userid')) {
            redirect('/login')->send();
        }
        $services = Service::all();
        return view('service', compact('services'));
    }

    // Insert
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        Service::create($request->only('name', 'status'));
        return response()->json(['message' => 'Inserted']);
    }

    // Edit - Return JSON for filling form
    public function edit($id)
    {
        if (!session()->has('userid')) {
            redirect('/login')->send();
        }
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    // Update
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        };

        $service = Service::findOrFail($id);
        $service->update($request->only('name', 'status'));

        return response()->json(['message' => 'Updated']);
    }

    // Delete
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
