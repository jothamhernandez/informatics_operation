<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Helpers extends Controller
{
    //
    function getEnum(Request $request, $table, $field){
        $type = DB::select( DB::raw("SHOW COLUMNS FROM " . $table . " WHERE Field = '".$field."'") )[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = [];
        foreach( explode(',', $matches[1]) as $value )
        {
            $v = trim( $value, "'" );
            array_push($enum, $v);
        }
        return response()->json($enum);
    }
    function getColumnName(Request $request, $table){
        return Schema::getColumnListing($table);
    }
}
