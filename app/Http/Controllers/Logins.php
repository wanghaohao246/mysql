<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admins;
class Logins extends Controller
{
    public function logindo(Request $request){
    	$user = $request->except('_token');
    	// dd($user);
    	$user['u_pwd'] = $user['u_pwd'];
    	// dd($user);
    	$admins=Admins::where($user)->first();
    	// dd($admin);
        session(['admins'=>$admins]);
            $request->session()->save();
    	if($admins['is_sf']==2){
    		
    		return redirect('/n/cre');
    	}else{
            return view('/num/liu');
            
        }
    	return redirect('/logins')->with('msg','没有此用户');
    }
}
