<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\System\Center;
use App\User;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'overseer'){
            return response()->json(Center::all());
        }

        if(Auth::user()->role == 'center manager'){
            $user = User::with('centerAssignment')->find(Auth::user()->id)->toArray();
            $center = [];
            collect($user['center_assignment'])->each(function($d) use (&$center){
                array_push($center,$d);
            });
            return response()->json($center);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $center = Center::create($request->all());
        return response()->json($center);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return response()->json(Center::with('employees')->find($id));
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
        //
        $center = Center::find($id);
        $center->update($request->all());
        return response()->json($center);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $center =Center::find($id);
        return response()->json($center->delete());

    }
}
