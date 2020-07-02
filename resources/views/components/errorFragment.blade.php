@if (isset($errors) && $errors->count() )
<div class="row alert alert-danger">
    <div class="col-12">
        @foreach ($errors->all() AS $error)
        <div class="row">
            <div class="col-12">
                <span>{!! $error !!}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif