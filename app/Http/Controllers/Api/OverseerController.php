<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\System\Center;
use App\System\KpiDailyReport;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;

class OverseerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if(Auth::user()->role == 'admin' || Auth::user()->role == 'overseer' || Auth::user()->role == 'center manager'){
            if($request->input('query') && $request->input('center_id')){
                $center = Center::with(['centerKpi','centerKpiTarget'])->find($request->input('center_id'));
                $center->centerKpi = $center->centerKpi->sortBy('created_at')->groupBy(function($d){
                    return Carbon::parse($d->created_at)->format('Y');
                });
                $center->centerKpi = collect($center->centerKpi)->map(function($d){
                    return $d->groupBy(function($e){
                        return Carbon::parse($e->created_at)->format('M');
                    });
                });

                $center->centerKpiTarget = $center->centerKpiTarget->sortBy('created_at')->groupBy(function($d){
                    return Carbon::parse($d->created_at)->format('Y');
                });
                $center->centerKpiTarget = collect($center->centerKpiTarget)->map(function($d){
                    return $d->groupBy(function($e){
                        return Carbon::parse($e->created_at)->format('M');
                    });
                });

                
                unset($center->center_kpi);
                return response()->json($center);
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
