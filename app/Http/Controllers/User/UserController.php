<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function login(Request $request){
        //验证数据
        $validator =\Illuminate\Support\Facades\Validator::make($request->all(),[
            'username'=>'required',
            'password'=>'required',
        ],[
            'username.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
        ]);
        //验证失败
        if ($validator->fails()){
            return [
                'error_code'=>-2,
               // 'message'=>'用户名密码不能为空',
                'message'=>$validator->errors(),//获取字段错误信息
            ];
        }

        //登录验证
        if (Auth::attempt(['username'=>$request->username,'password'=>$request->password])){
            return[
                "error_code"=>0,
                "message"=>"登录成功",
            ];
            return[
                "error_code"=>-1,
                "message"=>[
                    'username'=>[
                        '用户名或密码错误，请重新输入'
                    ]
                ]
            ];

        }
    }





}
