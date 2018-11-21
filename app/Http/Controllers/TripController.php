<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use \App\Models\Trip;
use \App\Models\User;
use \Illuminate\Http\Request;
use \App\Http\Requests\NewTripRequest;
use \App\Http\Requests\EditTripRequest;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('order_by') && $request->has('order')) {
            $trips = auth()->user()->trips()->orderBy($request->order_by, $request->order)->get();
        } else {
            $trips = auth()->user()->trips()->orderBy('created_at', 'DESC')->get();
        }

        return view('trip.home', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('trip.add-new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewTripRequest $request)
    {
        $file = $request->file('file');

        $extension = strtolower($file->getClientOriginalExtension());

        if ($extension == 'gpx'){

            $name  = auth()->user()->name;
            $name .= '_';
            $name .= time();
            $name .= '.';
            $name .= $extension;
            
            $dbDate = Trip::convertToDbDate($request->date);

            $file->storeAs('public', $name);

            Trip::create([
                'title'     => $request->title,
                'trip_date' => $dbDate,
                'file_name' => $name,
                'user_id'   => auth()->user()->id
            ]);

            return redirect()->route('home')->with(['success' => 'You have successfully uploaded a new trip.']);

        }

        return redirect()->back()->with(['error' => 'You just can upload file that have the extension: .gpx']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        abort_unless(auth()->user()->isOwner($trip), 403);

        return view('trip.show', compact('trip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        abort_if(!auth()->user()->isOwner($trip), 403);

        return view('trip.edit', compact('trip'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditTripRequest $request, Trip $trip)
    {
        abort_if(!auth()->user()->isOwner($trip), 403);

        $trip->update([
            'title'     => $request->title,
            'trip_date' => Trip::convertToDbDate($request->date)
        ]);

        return redirect()->route('home')->with(['success' => "You have successfully updated a \"$trip->title\" trip."]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        Storage::delete('public/' . $trip->file_name);
        
        $trip_title = $trip->title;

        $trip->delete();

        return redirect()->route('home')->with(['success' => "You have successfully deleted a \"{$trip_title}\" trip."]);
    }
}
