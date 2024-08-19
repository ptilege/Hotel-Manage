<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\FrontendUser;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

use Carbon\Carbon; 
use App\Models\User; 
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ForgetPasswordLink extends Component
{
    public $token;
    use LivewireAlert;
    public function mount($token)
    {
        $this->token = $token;
    }

    public function render()
    {
        return view('livewire.forget-password-link')->layout('frontend');
    }
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
            $this->alert('success', 'Password Changed Successfully.', [
                'position' => 'top-end',
                'timer' => 3000,
                'timerProgressBar' => true,
                // 'text'=>
            ]);
           
        return redirect('/auth/customer')->with('message', 'Your password has been changed!');
    }

    return back()->withInput()->with('error', 'User not found!');
}
}
