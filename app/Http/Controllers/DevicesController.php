<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use Illuminate\Http\Request;



class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // dd($request->ids);


        $ids = explode(",",$request->ids);

         $works = explode(",",$request->works);

       for ($i = 0; $i< count($ids);$i++){
          $device = Devices::find($ids[$i]);
          $device->update(['works'=>$works[$i]]);
       }
       return response()->json(

        ['ids'=>$ids]
       );

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Devices;
       $data->season_id = $request->season_id;
        $data->fan = $request->fan;
        $data->pump = $request->pump;
        $data->led = $request->led;
        $data->save();
        return response()->json([
            'data' => $data,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Devices $devices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Devices $devices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Devices $devices)
    {
        // dd($request->works);
         $devices->update(["works"=>$request->works]);
         return response()->json([
            'device'=>$devices
         ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Devices $devices)
    {
        //
    }
}
