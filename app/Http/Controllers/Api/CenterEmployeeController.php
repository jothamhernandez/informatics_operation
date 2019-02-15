<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\System\CenterEmployee;
use App\System\Logs;
use App\User;

class CenterEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(Auth::user()->role == 'admin'){
            if($request->input('column') && $request->input('value')){
                return response()->json(CenterEmployee::where([$request->input('column') => $request->input('value')])->get());
            } else {
                return response()->json(CenterEmployee::all());
            }
            
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
            $centerEmployee = $request->all();
            $employeeRecord = CenterEmployee::create($centerEmployee);
            $employee = User::find($employeeRecord->employee_id)->toArray();
            if($employeeRecord){
                Logs::create(['action'=>'added employee to a center', 'ip_address' => $request->server('REMOTE_ADDR'), 'user_id'=>Auth::user()->id]);
            }
            $employee['position'] = $centerEmployee["position"];
            return response()->json($employee);
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
        return response()->json(CenterEmployee::find($id));
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
