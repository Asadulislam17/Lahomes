<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use Illuminate\Support\Facades\File;

class PropertyController extends Controller
{
    
    public function grid() {
        return view('property.grid'); 
    }

    public function list() {
        $properties = Property::latest()->paginate(10); 
    
        return view('property.list', compact('properties')); 
    }

    public function details(Request $request) {
   
    $propertyId = $request->get('id');
    
    if ($propertyId) {
        $property = Property::find($propertyId);
    } else {
        $property = Property::latest()->first();
    }

    
    if (!$property) {
        $property = new Property();
        $property->name = 'No Property Available';
        $property->category = 'N/A';
        $property->price = 0;
        $property->property_for = 'Sale';
        $property->address = 'N/A';
        $property->city = 'N/A';
        $property->country = 'N/A';
        $property->image = null;
    }

    return view('property.details', compact('property')); 
}


    public function add() {
        return view('property.add'); 
    }

   
    public function publicIndex() {
        return view('property.grid'); 
    }

    
    public function publicDetails($id) {
        $property = Property::findOrFail($id);
        return view('property.details', compact('property')); 
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'property_for' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/properties'), $imageName);
            $imagePath = 'uploads/properties/' . $imageName;
        }

        Property::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'property_for' => $request->property_for,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'sqft' => $request->sqft,
            'floor' => $request->floor,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'country' => $request->country,
            'image' => $imagePath,
        ]);

        return redirect()->route('property.list')->with('success', 'Property added successfully!');
    }

    
    public function edit($id) {
        $property = Property::findOrFail($id);
        return view('property.edit', compact('property')); 
    }

   
    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'property_for' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $property->image;

        
        if ($request->hasFile('image')) {
            if ($property->image && File::exists(public_path($property->image))) {
                File::delete(public_path($property->image));
            }
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/properties'), $imageName);
            $imagePath = 'uploads/properties/' . $imageName;
        }

        $property->update([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'property_for' => $request->property_for,
            'bedroom' => $request->bedroom,
            'bathroom' => $request->bathroom,
            'sqft' => $request->sqft,
            'floor' => $request->floor,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'country' => $request->country,
            'image' => $imagePath,
        ]);

        return redirect()->route('property.list')->with('success', 'Property updated successfully!');
    }

   
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        
        if ($property->image && File::exists(public_path($property->image))) {
            File::delete(public_path($property->image));
        }

        $property->delete();

        return redirect()->route('property.list')->with('success', 'Property deleted successfully!');
    }
}
