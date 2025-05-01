<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!session()->has('userid')) {
            redirect('/login')->send();
        }
        $references = Reference::all();
        return view('reference', compact('references'));
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

        Reference::create($request->only('name', 'status'));
        return response()->json(['message' => 'Inserted']);
    }

    // Edit - Return JSON for filling form
    public function edit($id)
    {
        if (!session()->has('userid')) {
            redirect('/login')->send();
        }
        $reference = Reference::findOrFail($id);
        return response()->json($reference);
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

        $reference = Reference::findOrFail($id);
        $reference->update($request->only('name', 'status'));

        return response()->json(['message' => 'Updated']);
    }

    // Delete
    public function destroy($id)
    {
        $reference = Reference::findOrFail($id);
        $reference->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
