<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(['token'=>$token,'email'=>$request->query('email')]);
    }

    public function reset(Request $request)
    {
        $request->validate(['token'=>'required','email'=>'required|email','password'=>'required|confirmed|min:6']);
        $status = Password::reset(
            $request->only('email','password','password_confirmation','token'),
            function($user,$password){ $user->forceFill(['password'=>Hash::make($password)])->save(); Auth::login($user); }
        );
        if ($status === Password::PASSWORD_RESET) {
            DB::table('password_resets')->where('email', $request->email)->delete();
        return 
        redirect()->route('home')->with('status','Password reset successful. You can logged in.');
       }
       return 
       redirect()->route('password.token.invalid');
   }
}
