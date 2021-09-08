<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller{
    //index page
    public function traceIndex(){
        return view('contacttracing');
    }

    // trace a user
    public function traceUser(Request $request){
        $data = $request->validate([
            'email_trace' => 'required|email|max:255'
       ]);
          // find user by email
        $userToFind = User::where([
        'email' => $data['email_trace']
    ])->first();
    // check if longitude and lat exists on user instance

    if($userToFind){
        if($userToFind->longitude !==null && $userToFind->latitude !== null){
            return view('traceUser')->with($userToFind);
        }else{
            return redirect()->back()->with('error', 'This user has not updated his location');
        }
    }else{
        return redirect()->back()->with('error', 'The email <b>'.$email.'<b> does not exist in our database'); 
    }
    }

    public function updateLocation(Request $request){
     
        
        // get auth user
        $userid = Auth::id();
        if($userid){
             // find the user
            $user = USER::findorfail($userid);
            if($user){
                $user->longitude = $request->longitude;
                $user->latitude = $request->latitude;
                $user->save();
                return response()->json([
                    'success' => 'Location updated'
                ],200);
            }else{
                return response()->json([
                    'error' => 'Internal server error'
                ], 400);
            }

        }else{
            return redirect('/login');
        }   
        
    }
  
}
