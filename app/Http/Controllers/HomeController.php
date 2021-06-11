<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $alluser = User::get();
        $roleType =  Role::get();
        $getUserType=[];
       if(auth()->user()->role_type == 'admin' ){

           $getUserType = [
               "admin" => array (
                  'id' => 2,
                   'role_type' => 'merchant'
               ),
               "officer" => array (
                   'id' => 3,
                   'role_type' => 'officer'
               ),
               "user" => array (
                   'id' => 4,
                   'role_type' => 'user'
               ),

           ];
       }
        if(auth()->user()->role_type == 'merchant' ){

            $getUserType = [
                "officer" => array (
                    'id' => 3,
                    'role_type' => 'officer'
                ),
                "user" => array (
                    'id' => 4,
                    'role_type' => 'user'
                ),

            ];
        }
        if(auth()->user()->role_type == 'officer' ){
            $getUserType = [
                "user" => array (
                    'id' => 4,
                    'role_type' => 'user'
                ),

            ];
        }
        return view('index', compact('getUserType'));
    }

    public function  store(Request $request){
        $validatedData = $request->validate([
            'user_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required | min:8',
            'user_type' => 'required',
        ]);
         $role_id = $request->input('user_type');
        $role_name =  Role::find($role_id);
        $createdBy = auth()->user()->id;
        $data = [
           'name' => $request->input('user_name'),
           'email' => $request->input('email'),
           'password' => Hash::make($request->input('password')),
           'role_id' => $request->input('user_type'),
           'role_type' => $role_name->role_type,
           'created_by' =>$createdBy,
        ];
       $success = User::create($data);
       if($success){
           return back()->with('msg', 'User Added Successfully!!');
       }else{
           return back()->with('error', 'User Add Error!!!');
       }



    }
}
