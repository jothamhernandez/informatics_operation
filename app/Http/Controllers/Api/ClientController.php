<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\System\Clients;
use App\System\Logs;
use App\User;


class ClientController extends Controller
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
            return response()->json(Clients::all());
        }

        if(Auth::user()->role == 'course consultant'){
            $centers = User::with('centerAssignment')->find(Auth::user()->id);
            $cid = $centers->centerAssignment()->get()->pluck('id');
            return response()->json(Clients::whereIn('center_id',$cid)->orWhere(['emp_id'=>Auth::user()->id])->get());
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

        if(Auth::user()->role == 'course consultant'){
            $client = $request->all();
            $user = User::with("centerAssignment")->find(Auth::user()->id);
            $cid = $user->centerAssignment()->get()->pluck('id');
            $client['center_id'] = $cid[0];
            $client['emp_id'] = Auth::user()->id;

            $entry = Clients::create($client);

            if($entry){
                Logs::create(['action'=>'Added a Client on the Record', 'ip_address' => $request->server('REMOTE_ADDR'), 'user_id'=>Auth::user()->id]);
            }
            return response()->json($entry);

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
    }
}
