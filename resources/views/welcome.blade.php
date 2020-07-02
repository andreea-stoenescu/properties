@extends('layouts.app')

@section('content')
<div class='container'>
    <a href="{{ route('search_properties') }}" class='btn btn-success'>View Properties</a>
    <a href="{{ route('new_property') }}" class='btn btn-primary'>New Property</a>
</div>
@endsection