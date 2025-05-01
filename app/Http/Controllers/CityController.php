<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!session()->has('userid')) {
            redirect('/login')->send();
        }
        $cities = City::all();

        return view('city', compact('cities'));
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

        City::create($request->only('name', 'status'));
        return response()->json(['message' => 'Inserted']);
    }

    public function edit($id)
    {
        if (!session()->has('userid')) {
            redirect('/login')->send();
        }
        $city = City::findOrFail($id);  
        return response()->json($city);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        };

        $city = City::findOrFail($id);
        $city->update($request->only('name', 'status'));

        return response()->json(['message' => 'Updated']);
    }

    // Delete
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response()->json(['message' => 'Deleted']);
    }
}
