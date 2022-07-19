<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function loginPage(){
        return view('login');
    }


    public function login(Request $request){
        $user = User::find($request['id']);
        if( !$user || $user['pw'] !== $request['password'] ) return back()->with('msg','■ 아이디 혹은 비밀번호를 다시 확인해주세요.');
        Auth::login($user);
        return redirect('/')->with('msg','환영합니다.');
    }

    public function sign(Request $request){

        $input = $request->only(['id','pw','name','category_id','phone']);
        $input['introduce'] = '';
        $input['type'] = 'normal';
        if(User::find($request['id'])) return back()->with('msg','이미 사용중인 아이디입니다.');
        if(session()->get('captcha')[0] !== $request['captcha']){
            return back()->with('msg','캡차를 확인해주십시오');
        }
        $file = $request['photo'];
        $file_name = time().'.'.$file->extension();
        $file->move(base_path('public/user'),$file_name);
        $input['image'] = $file_name;
        User::create($input);
        return redirect('/')->with('msg','회원가입이 완료되었습니다.');
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('msg','잘가라 게이야');
    }

    public function captcha(){
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = "";
        for ($i = 0; $i < 5; $i++) {
            $code .= substr($str, rand(0, strlen($str) - 1), 1);
        }

        session()->forget('captcha');
        session()->push('captcha', $code);

        $img = imagecreatetruecolor(60, 30);
        $bg = imagecolorallocate($img, 0, 0, 0);
        $txt = imagecolorallocate($img, 255, 255, 255);

        imagefill($img, 0, 0, $bg);
        imagestring($img, 6, 8, 8, $code, $txt);

        header('Content-type:image/png');

        imagepng($img);
        imagedestroy($img);
    }
}
