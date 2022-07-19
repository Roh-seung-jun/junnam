<?php

namespace App\Http\Controllers;

use App\Recruitment;
use Illuminate\Http\Request;

class BorderController extends Controller
{
    public function borderPage(Request $request){
        if(!empty($request->all()) && isset($request->category_id)){
            $category = $request->category_id;
        }else{
            $category = auth()->user()->category_id;
        }

        $data = Recruitment::where('category_id',$category)->paginate(10);
        return view('border',compact(['data','category']));
    }
}
