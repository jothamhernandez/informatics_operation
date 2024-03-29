<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\System\Cluster;
use App\System\Logs;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user()->role == 'admin'){
            return response()->json(Cluster::all());
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
        if(Auth::user()->role == 'admin'){
            $cluster = $request->all();
            if($cluster){
                Logs::create(['action'=>'added a cluster', 'ip_address' => $request->server('REMOTE_ADDR'), 'user_id'=>Auth::user()->id]);
            }
            return response()->json(Cluster::create($cluster));
        }

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
        return response()->json(Cluster::find($id));
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
        if(Auth::user()->role == 'admin'){
            $cluster = Cluster::find($id);
            if($cluster->update($request->all())){
                Logs::create(['action'=>'updated a cluster information', 'ip_address'=>$request->server('REMOTE_ADDR'), 'user_id'=>Auth::user()->id]);
            }
            return response()->json($cluster);
        }
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
        $cluster = Cluster::find($id);
        return response()->json($cluster->delete());
    }
}
