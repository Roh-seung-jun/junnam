<?php

namespace App\Http\Controllers;

use App\Recruitment;
use App\User;
use Illuminate\Http\Request;

class MyController extends Controller
{
    public function myPage(){
        $data = [];
        $data['list'] = Recruitment::where('user_id',auth()->user()->id)->get();
        return view('my');
    }
    public function set(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user['name'] = $request['name'];
        $user['category_id'] = $request['category_id'];
        $user['introduce'] = $request['introduce'];
        if ($request['image']) {
            $file_name = time() . '.' . $request['image']->getClientOriginalName();
            $request['image']->move(base_path('./public/user'), $file_name);
            $user['image'] = $file_name;
        }
        $user->update();
        return back();
    }
}
