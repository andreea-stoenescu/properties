<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;

class PropertyController extends Controller
{
    public function search(Request $request)
    {
    }

    public function new()
    {
        return view('properties.new');
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'country' => 'required|max:255',
            'county' => 'required|max:255',
            'town' => 'required|max:255',
            'description' => 'required',
            'address' => 'required',
            'latitude' => 'required|numeric|min:-86|max:86',
            'longitude' => 'required|numeric|min:-180|max:180',
            'num_bedrooms' => 'required|integer|min:0',
            'num_bathrooms' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'listing_type_id' => 'required|exists:listing_types,id',
            'property_type_id' => 'required|exists:property_types,id'
        ]);
        $country = Models\Country::where('name', $validatedData['country'])->first();
        if ($country) {
            $country->load('counties.towns');
            $county = $country->counties->where('name', $validatedData['county'])->first();
            if ($county) {
                $town = $county->towns->where('name', $validatedData['town'])->first();
                if (!$town) {
                    $town = Models\Town::create([
                        'county_id' => $county->id,
                        'name' => $validatedData['town']
                    ]);
                }
            } else {
                $county = Models\County::create([
                    'country_id' => $country->id,
                    'name' => $validatedData['county']
                ]);
                $town = Models\Town::create([
                    'county_id' => $county->id,
                    'name' => $validatedData['town']
                ]);
            }
        } else {
            $country = Models\Country::create(['name' => $validatedData['country']]);
            $county = Models\County::create([
                'country_id' => $country->id,
                'name' => $validatedData['county']
            ]);
            $town = Models\Town::create([
                'county_id' => $county->id,
                'name' => $validatedData['town']
            ]);
        }
        $property_data = $validatedData;
        $property_data['town_id'] = $town->id;
        //I don't have time to do the file upload
        $property_data['image_full'] = 'img_full';
        $property_data['image_thumbnail'] = 'image_thumbnail';
        $property = Models\Property::create($property_data);

        return redirect()->route('edit_property', ['uuid' => $property->uuid]);
    }

    public function edit($uuid)
    {
        $property = Models\Property::where('uuid', $uuid)->first();
        if ($property) {
            $data['property'] = $property;
            return view('properties.edit')->with($data);
        } else {
            return redirect()->route('home')->withErrors("Property not found ($uuid).");
        }
    }

    public function update(Request $request)
    {
    }
}
