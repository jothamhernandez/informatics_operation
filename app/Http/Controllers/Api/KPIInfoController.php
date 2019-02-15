<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\System\KpiMonthInfo;
use App\User;
use App\System\Logs;

class KPIInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $user = User::with('centerAssignment')->find(Auth::user()->id);
        $center_id = [];
        // dd($user->toArray());
        // return response()->json($user->toArray()['center_assignment']);
        collect($user->toArray()['center_assignment'])->each(function($d) use (&$center_id){
            array_push($center_id, $d['id']);
        });

        // return response()->json($center_id);

        if(Auth::user()->role == 'admin' || Auth::user()->role == 'center manager'){
            if($request->input('period') && $request->input('center_id')){
                $date = new \DateTime($request->input('period'));
                // dd(date_format($date,'Y'));
               return response()->json(KpiMonthInfo::whereYear('kpi_month', '=', date_format($date, 'Y'))->whereMonth('kpi_month','=',date_format($date, 'm'))->where(['center_id'=>$request->input('center_id')])->first());
            }
            else if($request->input('column') && $request->input('value')){
                return response()->json(KpiMonthInfo::where([$request->input('column') => $request->input('value')])->get());
            } else {
                return response()->json(KpiMonthInfo::all());
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
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'center manager'){
            $kpi = $request->all();
            $kpi['manager_id'] = Auth::user()->id;
            $entry = KpiMonthInfo::create($kpi);
            if($entry){
                Logs::create(['action'=>'added kpi month targets','ip_address'=>$request->server('REMOTE_ADDR'),'user_id'=>Auth::user()->id]);
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
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'center manager'){
            return response()->json(KpiMonthInfo::find($id));
        }
        
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
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'center manager'){
            $data = $request->all;
            $kpi = KpiMonthInfo::find($id);
            if($kpi->update($data)){
                Logs::create(['action'=>'updated kpi target per month','ip_address'=>$request->server('REMOTE_ADDR'),'user_id'=>Auth::user()->id]);
            }
            
            return response()->json($kpi);
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
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'center manager'){
            $kpi = KpiMonthInfo::find($id);
            if($kpi->delete()){
                Logs::create(['action'=>'deleted kpi configuration','ip_address'=>$request->server('REMOTE_ADDR'),'user_id'=>Auth::user()->id]);
            }
            return response()->json();
        }
    }
}
