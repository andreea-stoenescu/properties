@extends('layouts.app')

@section('content')

<div class='container'>
    <div class='row'>
        <div class='col-12'>
            <h2>New property</h2>
        </div>
    </div>
    <hr>
    <div class='row'>
        <div class='col-6'>
            <form method='POST'>
                {{ csrf_field() }}
                <div class='form-group'>
                    <label for='country'>Country</label>
                    <input class='form-control' type='text' name='country' id='country' required />
                </div>
                <div class='form-group'>
                    <label for='county'>County</label>
                    <input class='form-control' type='text' name='county' id='county' required />
                </div>
                <div class='form-group'>
                    <label for='town'>Town</label>
                    <input class='form-control' type='text' name='town' id='town' required />
                </div>
                <div class='form-group'>
                    <label for='description'>Description</label>
                    <textarea class='form-control' type='text' name='description' id='description' required></textarea>
                </div>
                <div class='form-group'>
                    <label for='address'>Address</label>
                    <textarea class='form-control' type='text' name='address' id='address' required></textarea>
                </div>
                <div class='form-group'>
                    <label for='latitude'>Latitude</label>
                    <input class='form-control' type='text' name='latitude' id='latitude' required />
                </div>
                <div class='form-group'>
                    <label for='longitude'>Longitude</label>
                    <input class='form-control' type='text' name='longitude' id='longitude' required />
                </div>
                <div class='form-group'>
                    <label for='num_bedrooms'>Bedrooms</label>
                    <input class='form-control' type='number' name='num_bedrooms' id='num_bedrooms' required />
                </div>
                <div class='form-group'>
                    <label for='num_bathrooms'>Bathrooms</label>
                    <input class='form-control' type='number' name='num_bathrooms' id='num_bathrooms' required />
                </div>
                <div class='form-group'>
                    <label for='price'>Price</label>
                    <input class='form-control' type='number' name='price' id='price' required />
                </div>
                <div class='form-group'>
                    <label for='listing_type_id'>Listing Type</label>
                    <select class='form-control' type='text' name='listing_type_id' id='listing_type_id' required>
                        <option></option>
                        @foreach(\App\Models\ListingType::all() AS $listing_type)
                        <option value="{{ $listing_type->id }}">{{ $listing_type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class='form-group'>
                    <label for='property_type_id'>Property Type</label>
                    <select class='form-control property-type-select' type='text' name='property_type_id' id='property_type_id' required>
                        <option></option>
                        @foreach(\App\Models\PropertyType::all() AS $property_type)
                        <option value="{{ $property_type->id }}">{{ $property_type->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class='form-group'>
                    <button type='submit' class='btn btn-success btn-block'>Create</button>
                </div>
                {{-- IMAGE UPLOAD --}}
            </form>
        </div>
    </div>
</div>

@endsection