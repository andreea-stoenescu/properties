@extends('layouts.app')

@section('content')

<div class='container'>
    @foreach($property->getAttributes() AS $name => $value)
    <div class='row'>
        <div class='col-2'>
            {{ $name }}
        </div>
        <div class='col-6'>
            {{ $value }}
        </div>
    </div>
    @endforeach
</div>

@endsection