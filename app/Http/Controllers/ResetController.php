<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Http\Requests\ResetRequest;
use DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\ForgetMail;

class ResetController extends Controller
{
    public function resetPassword(ResetRequest $request){

        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);

        $emailcheck = DB::table('password_resets')->where('email', $email)->first();
        $pincheck = DB::table('password_resets')->where('token', $token)->first();

        if(!$emailcheck) {
            return response([
                'message' => 'Email not found'
            ], 401);
        }
        if(!$pincheck){
            return response([
                'message' => 'Incorrect token'
        ], 401);
        }

        DB::table('users')->where('email', $email)->update([ 'password' => $password]);
        DB::table('password_resets')->where('email', $email)->delete();

        return response([
            'message' => 'Password sucessfully changed'
        ], 200);

    }//end method
} 
