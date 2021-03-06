<?php

namespace App\Http\Controllers\Day2;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Student;

class AdminController extends Controller
{
    //用户注册
    public function add(){
        return view('admin.add');
    }
    //保存
    public function save(Request $request){
        //数据验证
        //username不能为空
        //email不能为空 格式必须是邮箱（唯一）
        //tel不能为空  格式必须是手机号码  （唯一）
        $this->validate($request,[
    //        'title'=>'required|unique:posts|max:255',
     //       'body'=>'required',
            'username'=>'required|min:3|max:20',
            'email'=>'email',
            'tel'=>[
                'required',
                'regex:/^1\d{10}$/',
            ]
        ],
        [//自定义错误提示信息
            'username.required'=>'用户名不能为空',
            'username.min'=>'用户名不能少于三位',
            'username.max'=>'用户名不能多余二十位',
            'email.email'=>'邮箱格式不正确',
            'tel.required'=>'手机号不能为空',
            'tel.regex'=>'手机号格式不正确',
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',

            ]);

      Admin::create([
          'username'=>$request->username,
          'email'=>$request->email,
          'tel'=>$request->tel,
      ]);
      //添加成功的提示信息
        session()->flash('success','添加成功！');
        return redirect()->route('user.add');
    }

    public function test(){
        //添加成功的提示信息
        session()->flash('warning','警告！');
        return redirect()->route('user.add');
    }

//    //分页
//    public function list(){
//        //分页第一种简单版：
//       // $students=Student::simplePaginate(2);
//        //第二种：加条件
//        $students=Student::where('age','>',100)->paginate(3);
//        return view('admin.list',compact('students'));
//
//    }
public function list(){
        $admins=Admin::paginate(2);
        return view('admin.index',compact('admins'));
}

    //修改用户
    public function edit(Admin $admin){
//        $id=$_GET['id'];
//       $admin=Admin::find($id);

        return view('admin.edit',compact('admin'));
    }
    public function update(Admin $admin,Request $request)
    {
        $this->validate($request, [
//            'title' => 'required|unique:posts|max:255',
//            'body' => 'required',
            'username'=>'required|min:3|max:20',
            'email'=>'email',
            'tel'=>[
                'required',
                'regex:/^1\d{10}$/',
            ]
        ],
            [//自定义错误提示
                'username.required'=>'用户名不能为空',
                'username.min'=>'用户名不能少于三位',
                'username.max'=>'用户名不能多于20位',
                'email.email'=>'邮箱格式不正确',
                'tel.required'=>'手机号不能为空',
                'tel.regex'=>'手机号格式不正确',
            ]);
        //dd($request->input());
        //$admin->update($request->input());
        $admin->update([
            'username'=>$request->username,
            'email'=>$request->email,
            'tel'=>$request->tel,
        ]);

        session()->flash('success','用户修改成功');

        return redirect()->route('user.list');
    }


    //删除
    public  function delete(Admin $admin){
     $admin->delete();
     session()->flash('success',$admin->username.'删除成功');
     return redirect()->route('user.list');

    }

}
