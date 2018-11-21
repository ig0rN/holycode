@extends('layouts.app')

@section('title')
 Home - Trip Tracker   
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="slova col-md-8 text-center">

            <h2>Hello {{ auth()->user()->name }}. <br> Welcome to your Trip Tracker Application.</h2>
            <a href="{{ route('new-trip') }}"><button type="button" class="btn btn-warning mt-4">You want to add new trip?</button></a>
    
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header text-center">
                    <strong>Here is all your uploaded trips</strong>
                </div>

                <div class="card-body" style="padding-left: 90px">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <span class="nav-link" style="">Sort by:</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ urldecode(route('home', array_merge(request()->query(), ['order_by' => 'title', 'order' =>'asc']), false)) }}">Trip Name Z-A</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ urldecode(route('home', array_merge(request()->query(), ['order_by' => 'title', 'order' =>'desc']), false)) }}">Trip Name Z-A</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ urldecode(route('home', array_merge(request()->query(), ['order_by' => 'trip_date', 'order' =>'asc']), false)) }}">Date ASC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ urldecode(route('home', array_merge(request()->query(), ['order_by' => 'trip_date', 'order' =>'desc']), false)) }}">Date DESC</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body"> 

                    <table style="text-align:center;" id="project-table" class="table table-responsive-lg table-bordered">
                        <thead style=" color:rgba(198, 77, 7, 0.9);">
                        <tr>
                            <th scope="col">Trip Name</th>
                            <th scope="col">Date</th>
                            <th scope="col">View</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>

                        <tbody>
        
                        @if($trips->count())
        
                            @foreach($trips as $trip)
        
                                <tr>
                                    <td>{{ $trip->title }}</td>
                                    
                                    <td>{{ date('d-m-Y', strtotime($trip->trip_date)) }}</td>

                                    <td class="table-icons">
                                        <a href="{{ route('show-trip', $trip->id) }}"><img class="icon" src="/svg/eye.svg" height="24px" width="24px" alt="Preview"></a>
                                    </td>
        
                                    <td class="table-icons">
                                        <a href="{{ route('edit-trip', $trip->id) }}"><img class="icon" src="/svg/pen.svg" height="24px" width="24px" alt="Edit"></a>
                                    </td>
        
                                    <td class="table-icons">
                                        <img class="icon" src="/svg/trash.svg" height="24px" width="24px" alt="Delete" data-toggle="modal" data-target="#exampleModal{{ $trip->id }}">
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $trip->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModal{{ $trip->id }}Title" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header row">
                                            <div class="col-3">
                                                {{-- Empty space --}}
                                            </div>
                                            <div class="col-6">
                                                <h5 class="modal-title text-center" id="exampleModalLongTitle">Delete Trip: <strong>{{ $trip->title }}</strong></h5>
                                            </div>
                                            <div class="col-3">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-body text-center">
                                            You sure want to delete this trip?
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                        <form method="POST" action="{{ route('delete-trip', $trip->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Yes, I want to DELETE trip!</button>
                                        </form>
                                        </div>
                                    </div>
                                    </div>
                                </div>
        
                            @endforeach

                        @else
    
                            <tr>
                                <td class="text-muted" colspan="8" style="letter-spacing: 1px;font-size: 20px;"><strong>You didn't upload any trip yet</strong></td>
                            </tr>
        
                        @endif

                        </tbody>
        
                    </table>
                        
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
