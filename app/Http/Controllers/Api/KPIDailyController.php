<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\System\KpiDailyReport;
use Illuminate\Support\Facades\Auth;

class KPIDailyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(Auth::user()->role == 'center manager'){
            if($request->input('period') && $request->input('center_id')){
                $date = new \DateTime($request->input('period'));
                return response()->json(KpiDailyReport::whereYear('created_at','=',date_format($date, "Y"))->whereMonth('created_at', '=', date_format($date, 'm'))->where(['center_id'=>$request->input('center_id')])->orderBy('created_at')->get());
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
        if(Auth::user()->role == 'center manager'){
            $entry = $request->all();
            $entry['prepared_by'] = Auth::user()->id;
            // dd($entry);
            $kpi_entry = KpiDailyReport::create($entry);
            
            
            return response()->json($kpi_entry);
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
