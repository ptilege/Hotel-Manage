<?php

namespace App\Http\Livewire;

use App\Models\FrontendUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Booking;
use App\Models\Property;
use PHPUnit\Framework\Constraint\IsEmpty;

class ProfileComponent extends Component
{
    use WithFileUploads;
    // form fields
    public $name;
    public $email;
    public $phone;
    public $nic;
    public $address;
    public $country;
    public $city;
    public $avatar;
    public $avatarUrl;
    public $updateAvatar;
    public $bookings;
    public $tab = 'profile';
    public $bookingStatus;
    public $currentPassword;
    public $newPassword;
    public $passwordConfirmation;
    protected $queryString = ['tab'];
    public $listeners = ['openFileInput'];

    public function mount()
    {

        $authCustomer = Auth::guard('customers')->user();
        if (!$authCustomer) {
            return redirect()->route('front.login');
        }

        $customer = Auth::guard('customers')->user();
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->phone = $customer->phone;
        $this->nic = $customer->nic;
        $this->address = $customer->address;
        $this->city = $customer->city;
        $this->country = $customer->country;
        
        // $latestBooking = Booking::where('email', $customer->email)
        // ->latest('created_at')
        // ->first();

    // Check if a booking exists
    // if ($latestBooking) {
    //     $this->nic = $latestBooking->nic;
    //     $this->address = $latestBooking->address;
    //     $this->city = $latestBooking->city;
    //     $this->country = $latestBooking->country;
    //     // Assign other booking properties as needed
    // } else {
    //     // Handle the case where there is no booking for the user
    //     $this->nic = null;
    // }
        
        
        $this->emit('avatarHover', $this->tab);

        $this->fetchBookings();
    }
    public function render()
    {
        $customer = Auth::guard('customers')->user();
        // dd($customer);
        $isGoogleAvatar = isset($customer->avatar) && strpos($customer->avatar, 'googleusercontent.com') !== false;

        // Determine the avatar URL based on the conditions
        $avatarUrl = $isGoogleAvatar
            ? $customer->avatar
            : ($customer->avatar
                ? asset('storage/' . $customer->avatar)
                : null);

        // If no avatar is available, create an avatar based on the user's name initial
        if (!$avatarUrl) {
            $initial = strtoupper(substr($customer->name, 0, 1));
            $avatarUrl = "https://ui-avatars.com/api/?name={$initial}&background=random&color=fff";
           
            
        }
        $this->avatarUrl = $avatarUrl;
        //  dd($avatarUrl);
        // Log::info("Avatar URL: " . $avatarUrl);
        return view('livewire.profile-component', compact('avatarUrl', 'customer'))->layout('frontend');
        // Pass the $customer and $avatarUrl to the Livewire component view
    // return view('livewire.profile-component', ['customer' => $this->customer, 'avatarUrl' => $this->avatarUrl])
    //     ->layout('frontend');
    }

    public function fetchBookings()
{
    $userEmail = Auth::guard('customers')->user()->email;

    // Fetch all bookings for the user
    $allBookings = Booking::where('email', $userEmail)->get();
//    dd($allBookings);
   
    $this->bookings = $allBookings->filter(function ($booking) {
        return in_array($booking->status, ['confirm', 'pending','cancel','reject','fail']);
    });

    if ($this->bookings->isEmpty() && !session()->has('messageb')) {
        $this->bookingStatus = '0';
        session()->flash('messageb', 'You don\'t have any bookings.');
    } else {
        $this->bookingStatus = '1';
    }

    return $this->bookingStatus;
}



    public function setTab($tabName = 'profile')
    {
        $this->tab = $tabName;

        if ($this->tab == 'profile-edit') {
            // dd("Inside profile-edit tab");
            $customer = Auth::guard('customers')->user();
            $this->name = $customer->name;
            $this->email = $customer->email;
            $this->phone = $customer->phone;
            $this->nic = $customer->nic;
            $this->address = $customer->address;
            $this->city = $customer->city;
            $this->country = $customer->country;
            
        //     $latestBooking = Booking::where('email', $customer->email)
        //     ->latest('created_at')
        //     ->first();

        // // Check if a booking exists
        // if ($latestBooking) {
        //     $this->nic = $latestBooking->nic;
        //     $this->address = $latestBooking->address;
        //     $this->city = $latestBooking->city;
        //     $this->country = $latestBooking->country;
        //     // Assign other booking properties as needed
        // } else {
        //     // Handle the case where there is no booking for the user
        //     $this->nic = null;
        // }
            $this->updateAvatar = null;
            // Add other fields as needed
            //  dd($this->name, $this->email, $this->phone);
        }

        $this->redirect(route('profile', ['tab' => $tabName]));
    }



    public function openFileInput()
    {
        $this->dispatchBrowserEvent('clickFileInput');
    }

    



    public function updateProfile()
    {

        // Validate the form fields
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'nic' => 'nullable|string|max:20',
            // 'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation for new avatar
        ]);
        // dd('Validation passed');

        

        $customer = Auth::guard('customers')->user();



        $customer->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'nic' => $this->nic,
            'address' => $this->address,
            'country' => $this->country,
            'city' => $this->city,
            
        ]);

        


        if ($this->updateAvatar) {
            $filename = $this->updateAvatar->store('avatars', 'public');
            $customer->update(['avatar' => $filename]);
            $this->avatarUrl = asset('storage/' . $filename);
        }
        
        $this->setTab('profile');


        session()->flash('message', 'Profile updated successfully.');
    }
    
     
    public function updatePassword()
{
    $this->validate([
        'currentPassword' => 'required',
        'newPassword' => 'required|string|min:8',
        'passwordConfirmation' => 'required|string|min:8|same:newPassword',
    ], [
        'passwordConfirmation.same' => 'The new password and confirmation must match.',
    ]);

    $customer = Auth::guard('customers')->user();

    if (!Hash::check($this->currentPassword, $customer->password)) {
        $this->addError('currentPassword', 'The provided current password is incorrect.');
        return;
    }

    // Update the user's password
    $customer->update(['password' => Hash::make($this->newPassword)]);

    // Clear the form fields
    $this->currentPassword = '';
    $this->newPassword = '';
    $this->passwordConfirmation = '';

    session()->flash('message', 'Password updated successfully.');
}





}
