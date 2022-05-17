<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;

class PenggunaController extends Controller
{
    public function index(){
        if(Auth::check()){
            return view('users');
        }else{
            return view('auth.login');
        }
    }

    public function loadUserDatatable(){
        $result = DB::select(DB::raw("SELECT users.*,DATE_FORMAT(updated_at,'%d/%m/%Y %h:%i%p') AS update_date FROM users"));
        return response()->json(array('result' => $result));
    }

    public function postNewUser(){
        //dd(request()->all());

        $validator = Validator::make(request()->all(), [
            'name' => ['required', 'string', 'max:255'],
            'ic_number' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required','in:admin,normal,guest,client'],
        ]);

        //Insert new record if no errors, else return errors
        if($validator->fails()){
            return response()->json(array('status'=>'fails','errors'=>$validator->errors()));
        }else{
            $rec = new User;
            $rec->name = request('name');
            $rec->ic_number = request('ic_number');
            $rec->email = request('email');
            $rec->password = Hash::make(request('password'));
            $rec->role = request('role');
            $rec->save();

            $result = DB::select(DB::raw("SELECT users.*,DATE_FORMAT(updated_at,'%d/%m/%Y %h:%i%p') AS update_date FROM users"));

            return response()->json(array('status'=>'success','result'=>$result));
        }
    }

    public function postUpdateUser(){
        // dd(request()->all());

        if(request('password')){
            if(Auth::user()->role = "super admin"){
                $validator = Validator::make(request()->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:8'],
                ]);
            }else{
                $validator = Validator::make(request()->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:8'],
                    'role' => ['required','in:admin,normal,guest,client'],
                ]);
            }
        }else{
            if(Auth::user()->role = "super admin"){
                $validator = Validator::make(request()->all(), [
                    'name' => ['required', 'string', 'max:255'],
                ]);
            }else{
                $validator = Validator::make(request()->all(), [
                    'name' => ['required', 'string', 'max:255'],
                    'role' => ['required','in:admin,normal,guest,client'],
                ]);
            }
        }

        //IC and email custom validation
        $emailExistError = "";
        $icNumberExsitError  = "";
        $errorStatus = "";

        if(User::where('email','=',request('email'))->where('id','<>',request('user_id'))->exists()){
            $errorStatus = "fail";
            $emailExistError = "Email ".request('email').' already taken!';
        }
        if(User::where('ic_number','=',request('ic_number'))->where('id','<>',request('user_id'))->exists()){
            $errorStatus = "fail";
            $icNumberExsitError = "IC Number ".request('ic_number').' already taken!';
        }

        //Insert new record if no errors, else return errors
        if($validator->fails()){
            return response()->json(array('status'=>'fails','errors'=>$validator->errors(),'email_error'=>$emailExistError,'ic_error'=>$icNumberExsitError));
        }else{
            $rec = User::find(request('user_id'));
            $rec->name = request('name');
            $rec->ic_number = request('ic_number');
            $rec->email = request('email');
            if(request('password')){
                $rec->password = Hash::make(request('password'));
            }
            if(request('role')){
                $rec->role = request('role');
            }
            $rec->save();

            $result = DB::select(DB::raw("SELECT users.*,DATE_FORMAT(updated_at,'%d/%m/%Y %h:%i%p') AS update_date FROM users"));

            if($errorStatus == "fail"){
                return response()->json(array('status'=>'fails','errors'=>$validator->errors(),'email_error'=>$emailExistError,'ic_error'=>$icNumberExsitError));
            }else{
                return response()->json(array('status'=>'success','result'=>$result));
            }
        }

    }
}
