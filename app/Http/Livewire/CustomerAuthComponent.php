<?php

namespace App\Http\Livewire;

use App\Models\FrontendUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;

class CustomerAuthComponent extends Component
{
    use LivewireAlert;

    public $email;
    public $password;
 
    public $activeTab = 'login';
    public $firstName;
    public $lastName;
    public $emailAddress;
    public $mobile;
    public $password_confirmation;
    
    public function render()
    {
        // dd(Auth::guard('customers')->user());
        return view('livewire.customer-auth-component')->layout('frontend');
    }

    public function login()
    {
        $validatedDate = $this->validate([
            'email' => [
                'required',
                'email',
                'regex:/\.com$/i',
                
            ],
            'password' => 'required',
        ]);
        // dd($this);
        if(Auth::guard('customers')->attempt(array('email' => $this->email, 'password' => $this->password))){
            $this->alert('success', 'Login Successfully.', [
                'position' => 'top-end',
                'timer' => 3000,
                'timerProgressBar' => true,
                // 'text'=>
            ]);
            return redirect()->intended(route('home'));
        }else{
            $this->alert('error', 'These credentials do not match our records.', [
                'position' => 'top-end',
                'timer' => 3000,
                'timerProgressBar' => true,
                // 'text'=>
            ]);
            return redirect()->back();
        }
    }

    public function register()
{
    $validatedData = $this->validate([
        'firstName' => ['required', 'regex:/^[a-zA-Z]+$/'], 
        'lastName' => ['required', 'regex:/^[a-zA-Z]+$/'], 
        'emailAddress' => [
            'required',
            'email',
            'regex:/\.com$/i', 
            Rule::unique('frontend_users', 'email'),
        ],
        'mobile' => 'required|unique:frontend_users,phone',
        'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required|same:password',
    ], [
        'firstName.regex' => 'The first name must contain only alphabetic characters.',
        'lastName.regex' => 'The last name must contain only alphabetic characters.',
        'emailAddress.regex' => 'The email address must end with .com.'
    ]);

    $this->password = Hash::make($this->password); 

    $user = FrontendUser::create([
        'name' => $this->firstName .' '.$this->lastName,
        'email' => $this->emailAddress,
        'phone' => $this->mobile,
        'password' => $this->password
    ]);

    Auth::guard('customers')->login($user);

    $this->alert('success', 'Registered Successfully.', [
        'position' => 'top-end',
        'timer' => 3000,
        'timerProgressBar' => true,
    ]);

    return redirect()->intended(route('home'));
}


    public function logout()
    {
        Auth::guard('customers')->logout();

        // Redirect to a desired route after logout
        // return redirect()->route('home');
        return redirect()->back();
    }
    public function changeTab($tab)
    {
        $this->activeTab = $tab;
        $this->emit('changeTab', $tab);
    }
}
