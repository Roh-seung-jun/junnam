<?php

namespace App\Http\Controllers;

use App\Garden;
use Illuminate\Http\Request;

class GardenController extends Controller
{
    public function listPage(){
        $data = [];
        $data['garden'] = Garden::all();
        return view('list',compact(['data']));
    }
    public function viewPage($id){
        $data = [];
        $data['garden'] = Garden::find($id);

        $year = date('Y');
        $month = date('m');
        $date = "$year-$month-01";
        $time = strtotime($date);
        $start_week = date('w', $time);
        $total_day = date('t', $time);
        $total_week = ceil(($total_day + $start_week) / 7);
        $data['calendar'] = [];

        foreach ($data['garden']->busking_schedule as $item){
            $_date = explode('-',$item['date']);
            if($_date[0] === $year && $_date[1] === $month){
                array_push($data['calendar'],$item);
            }
        }

        return view('view',compact(['data','year','month','id','date','time','start_week','total_day','total_week']));
    }
}
