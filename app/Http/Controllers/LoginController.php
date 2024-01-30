<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{
    public function index(){
        return view('login');
    }

    public function loginCheck(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()){
            return response()->json(['status' => 0, 'message' => $validator->errors()->first()]);
        }

        if(Auth::guard('web')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
            return response()->json(['status' => 1, 'message' => 'Logged in successfully']);
        }else{
            return response()->json(['status' => 0, 'message' => 'Invalid email or password']);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect(route('home'));
    }

    public function registerView(){
        return view('register');
    }

    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()){
            return response()->json(['status' => 0, 'message' => $validator->errors()->first()]);
        }

        try {
            $user = new User();
            $user->email = $request->email;
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->save();


            return response()->json(['status' => 1, 'message' => 'Registered Successfully.']);
        }catch (\Exception $exception){
            return response()->json(['status' => 0, 'message' => $exception->getMessage()]);
        }
    }
}
