<?php

namespace App\Http\Controllers;

use App\Category;
use App\Recruitment;
use App\Recruitment_application;
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
        if($request['category_id'] === 'all') {
            $category = 'all';
            $data = Recruitment::paginate(10);
        }
        $type = Category::all();
        return view('border',compact(['data','category','type']));
    }

    public function viewPage($id){
        $data = [];
        $data['border'] = Recruitment::find($id);
        return view('border_view',compact(['data']));
    }

    public function accept(Request $request){
        $find = Recruitment_application::find($request['id']);
        $find['state'] = $request['state'];
        $find->update();

        $recruitment = Recruitment::find($find['recruitment_id']);
        $all = Recruitment_application::where('recruitment_id',$find['recruitment_id'])->get();
        if($all->count() >= $recruitment['personnel']-1){
            foreach ($all as $item){
                if($item['state'] === 'wait'){
                    $item['state'] = 'reject';
                    $item->update();
                }
            }
        }
        return back()->with('msg','thank you');
    }

    public function create(Request $request){
        $input = [];
        $input['user_id'] = auth()->user()->id;
        $input['recruitment_id'] = $request['id'];
        $input['state'] = 'wait';
        Recruitment_application::create($input);
        return back();
    }

    public function write(Request $request){
        $input = $request->only(['title','contents','personnel','category_id']);
        $input['user_id'] = auth()->user()->id;
        Recruitment::create($input);
        return back()->with('msg','모집게시물이 정상적으로 올라감');
    }
}
