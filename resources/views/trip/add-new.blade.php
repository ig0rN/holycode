@extends('layouts.app')

@section('title')
 Add New Trip - Trip Tracker   
@endsection


@section('content')
<div class="container">
        <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center">Add New Trip</div>
        
                        <div class="card-body">
                        <form method="POST" action="{{ route('create-trip') }}" enctype="multipart/form-data">
                                @csrf
        
                                <div class="form-group row">
                                    <label for="title" class="col-md-4 col-form-label text-md-right">Trip Title</label>
        
                                    <div class="col-md-6">
                                        <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="date" class="col-md-4 col-form-label text-md-right">Trip Date</label>
        
                                    <div class="col-md-6">
                                        <input id="date" type="text" class="form-control date{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') }}" required>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="file" class="col-md-4 col-form-label text-md-right">Upload <strong>.gpx</strong> file</label>
        
                                    <div class="col-md-6">
                                        <input id="file" type="file" class="{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file" required>
                                    </div>
                                </div>
        
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-warning">
                                            Add New Trip
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <div class="col-md-6 offset-md-4">
                                        @include('errors')
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection

@section('script')
<!-- Date Picker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $( function() {
        $( ".date" ).datepicker({
            firstDay: 1,
            dateFormat: "dd-mm-yy",
            showOtherMonths: true
        });
    } );
</script>
    
@endsection
