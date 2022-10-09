<?php

namespace App\Http\Controllers\Api;

use App\Models\Hotel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\stdClass;
use App\Models\Room;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = Hotel::all();
        return $hotels;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hotel = new Hotel();
        $hotel->name = $request->name;
        $hotel->description = $request->description;
        $hotel->save();

        return $hotel;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hotelInfo = Hotel::find($id);

        $rooms = DB::table('rooms')
            ->where('id_hotel', '=', $id)->get();

        $hotel = array(
            "hotelName" => $hotelInfo->name,
            "hotelDescription" => $hotelInfo->description,
            "hotelImage" => $hotelInfo->imageUrl,
            "rooms" => $rooms

        );

        return json_encode($hotel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $hotel =  Hotel::findOrFail($request->id);
        $hotel->name = $request->name;
        $hotel->description = $request->description;

        $hotel->save();
        return $hotel;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel =  Hotel::destroy($id);
        return $hotel;
    }
}
