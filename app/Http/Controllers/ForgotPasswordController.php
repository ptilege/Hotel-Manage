<?php 
  
  namespace App\Http\Controllers;
  
use App\Http\Controllers\Controller;
use App\Models\FrontendUser;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

use Carbon\Carbon; 
use App\Models\User; 
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

  
class ForgotPasswordController extends Controller
{
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('auth.forgetPassword');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:frontend_users',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password');
          });
  
          return back()->with('message', 'We have e-mailed your password reset link!');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('auth.forgetPasswordLink', ['token' => $token]);
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
    //   public function submitResetPasswordForm(Request $request)
    //   {
    //       $request->validate([
    //           'email' => 'required|email|exists:frontend_users',
    //           'password' => 'required|string|min:6|confirmed',
    //           'password_confirmation' => 'required'
    //       ]);
  
    //       $updatePassword = DB::table('password_resets')
    //                           ->where([
    //                             'email' => $request->email, 
    //                             'token' => $request->token
    //                           ])
    //                           ->first();
  
    //       if(!$updatePassword){
    //           return back()->withInput()->with('error', 'Invalid token!');
    //       }
  
    //       // Update the user's password
    //      $user = User::where('email', $request->email)->first();
    //     $user->password = Hash::make($request->password);
    //     $user->save();
 
    //       DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
    //       return redirect('/auth/customer')->with('message', 'Your password has been changed!');
    //   }
    public function submitResetPasswordForm(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:frontend_users',
        'password' => 'required|string|min:8|confirmed',
        'password_confirmation' => 'required'
    ]);

    // Validate the token and email
    $passwordReset = DB::table('password_resets')
        ->where('email', $request->email)
        ->where('token', $request->token)
        ->first();

    if (!$passwordReset) {
        return back()->withInput()->with('error', 'Invalid token!');
    }

    
    $user = FrontendUser::where('email', $request->email)->first();


    // dd('user');
    
    if ($user) {
        
        $hashedPassword = Hash::make($request->password);

        
        $user->password = $hashedPassword;
        $user->save();

       
        DB::table('password_resets')
            ->where('email', $request->email)
            ->delete();

        return redirect('/auth/customer')->with('message', 'Your password has been changed!');
    }

    return back()->withInput()->with('error', 'User not found!');
}
    
}