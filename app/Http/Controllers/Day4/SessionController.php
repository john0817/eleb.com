<?php

namespace App\Http\Controllers\Day4;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //只允许游客访问
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>['create','store']
        ]);
        $this->middleware('auth',[
            'only'=>['destroy']
        ]);
    }

    //登录
    public function create(){
        //登录表单
   return view('session.create');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
        ]);
        //验证  账号密码是否正确
        if (Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember'))){
            //认证通过 登陆成功 提示登录成功 跳转到上一次访问的页面
            //return redirect()->route('user.index')->with('success','登陆成功');
            return redirect()->intended(route('user.index'))->with('success','登陆成功');
        }else{
            //登录失败
            return back()->with('danger','用户名或密码错误，请重新登录！')->withInput();
        }
    }
    public function destroy(){
        //用户退出  注销
        Auth::logout();
        return redirect()->route('login')->with('success','您已退出登录');

    }
}
