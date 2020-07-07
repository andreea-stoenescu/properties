@extends('layouts.app')

@section('content')

<div class='container'>
        <div class='row'>
            <div class='col-12'>
                <select class="form-control" required id="countriesFilter">
                    <option>Select Country</option>
                    @foreach(\App\Models\Country::orderBy('name')->get() AS $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class='row mt-2'>
            <div class='col-12'>
                <select class="form-control" required id="countiesFilter">
                </select>
            </div>
        </div>
        <div class='row'>
            <div class='col-12'>
                <table class='table table-striped'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($properties AS $property)
                        <tr>
                        <td><a href="{{ route('edit_property', ['uuid' => $property->uuid]) }}">{{ $property->id }}</a></td>
                        <td>{{ "I forgot to get the title" }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $properties->links() }}
            </div>
        </div>
</div>

@endsection