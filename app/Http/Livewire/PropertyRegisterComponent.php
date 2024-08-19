<?php

namespace App\Http\Livewire;

use App\Models\Destination;
use App\Models\FrontendUser;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use App\Mail\PropertyRegistered;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Validation\Rule;
class PropertyRegisterComponent extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $coverImage;
    public $placeImages = [];
    public $currentStep = 0;
    public $currentUser = null;

     // Step 1: User Information
     public $name;
     public $email;
     public $mobile;
     public $password;
     public $confirmPassword;
 
     // Step 2: Property Information
     public $propertyName;
     public $type;
     public $propertyEmail;
     public $propertyContact;
     public $address;
     public $slug;

    // Step 3: Property Destination
    public $dtype;
    public $propertyvideourl;
    public $propertydescription;
    public $propertystarRate;

    public $role = 'Property Group Admin';

    protected $listeners = ['refreshComponent' => '$refresh'];

    
    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
        'mobile' => 'required|string',
        'password' => 'required|min:6',
        'confirmPassword' => 'required|same:password',
        'propertyName' => 'required|string',
        'type' => 'required',
        'propertyEmail' => 'required|email',
        'propertyContact' => 'required|string',
        'address' => 'required|string',
        'propertydescription' => 'required',
       
       
    ];
    public function pictureOfPlace()
    {
        // Logic to store images goes here (you can save to storage, database, etc.)
        // For now, we'll just keep the selected images in the $placeImages array
        foreach ($this->placeImages as $image) {
            $this->placeImages[] = $image;
        }

        // Clear the selected images after processing
        $this->placeImages = [];
    }
    public function mount()
    {
        $this->currentStep = Session::get('property_register_step', 0);
        $this->currentUser = Session::get('user_data', null);
        // dd($this->currentStep);
        $user = $this->currentUser;
        // dd($user);
        if ($this->currentUser) {
            // Check if $this->currentUser is an object
            if (is_object($this->currentUser)) {
                $this->name = $this->currentUser->name;
                $this->email = $this->currentUser->email;
                $this->mobile = $this->currentUser->mobile;
                $this->password = '';
                $this->confirmPassword = '';
            } else {
                // Handle the case where $this->currentUser is not an object (possibly an array)
                // You can modify this part according to your data structure
                $this->name = $this->currentUser['name'] ?? '';
                $this->email = $this->currentUser['email'] ?? '';
                $this->mobile = $this->currentUser['mobile'] ?? '';
                $this->password = '';
                $this->confirmPassword = '';
            }
        }
    }

    public function render()
    {
        $propertyType = PropertyType::where('status', 1)->get();
        $destination = Destination::where('status', 1)->get();
        // dd($destination);
        return view('livewire.property-register-component', compact('destination', 'propertyType'))->layout('frontend');
    }


     // Step 1: Save User Information
     public function saveUser()
     {
        $this->validate([
            'name' => ['required', 'regex:/^[a-zA-Z]+$/'], 
            // 'email' => 'required|email|unique:backend_users,email',
            'email' => [
                'required',
                'email',
                'unique:backend_users,email',
                'regex:/\.com$/i', 
                Rule::unique('frontend_users', 'email'),
            ],
            'mobile' => 'required|string',
            'password' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[!@#$%^&*])/',
            'confirmPassword' => 'required|same:password',
        ], [
            'name.regex' => 'The  name must contain only alphabetic characters.',
            'email.unique' => 'The email address has already been taken. Please Login',
            'emailAddress.regex' => 'The email address must end with .com.',
        ]);
          // Store the user data in the session
        session(['user_data' => [
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'password' => $this->password,
          
        ]]);
        Log::info('User data stored in session:', session('user_data'));
         $this->nextStep();
     }
 
     // Step 2: Save Property Information
     public function createProperty()
     {
         $this->validate([
            'propertyName' => 'required|string|unique:properties,name',
            'type' => 'required ',
            'propertyEmail' => 'required|email',
            'propertyContact' => 'required|string',
            'address' => 'required|string',
         ]);
         session(['property_data' => [
            'propertyName' => $this->propertyName,
            'type' => $this->type,
            'propertyEmail' => $this->propertyEmail,
            'propertyContact' => $this->propertyContact,
            'address' => $this->address,
         ]]);
        
         Log::info('property data stored in session:', session('property_data'));
         $this->nextStep();
     }
 
     // Step 3: Save Property Destination
     public function createdestination()
     {
         $this->validate([
            'dtype' => 'required',
             'propertyvideourl' => 'nullable',
            'propertydescription' => 'required|string',
            'propertystarRate' => 'nullable'
         ]);
         session(['destination_data' => [
            'dtype' => $this->dtype,
     
            'propertyvideourl' => $this->propertyvideourl,
            'propertydescription' => $this->propertydescription,
            'propertystarRate' => $this->propertystarRate,
         ]]);
         Log::info('destination data stored in session:', session('destination_data'));

         $userData = session('user_data');
         $propertyData = session('property_data');
         $destinationData = session('destination_data');

        //  dd($userData);
         if($userData && $propertyData && $destinationData){
            try{

                $user = User::where('email', $userData['email'])
                        ->orWhere('mobile_no', $userData['mobile'])
                        ->first();
                if(!$user){
                    $user = User::create([
                        'name' => $userData['name'],
                        'email' => $userData['email'],
                        'mobile_no' => $userData['mobile'],
                        'password' => Hash::make($userData['password']),
                        'status' => 1,
                    ]);
                    $user->assignRole($this->role);
                }
               
               
                DB::commit();
               

                $property = Property::create([
                    'name' => $propertyData['propertyName'],
                    'slug' => $this->slug,
                    'property_type_id' => $propertyData['type'],
                    'email' => $propertyData['propertyEmail'],
                    'contact_1' => $propertyData['propertyContact'],
                    'address_1' => $propertyData['address'],
                    'destination_id' => $destinationData['dtype'],
                    'video_url' => $destinationData['propertyvideourl'],
                    'description' => $destinationData['propertydescription'],
                    'stars' => $destinationData['propertystarRate'] ?? 0,
                    'country_id' => 0,
                    'status' => 0,
                ]);
                $property->users()->sync([$user->id]);

                Mail::to($userData['email'])->send(new PropertyRegistered());

                $this->nextStep();

            }catch(Exception $ex){
                DB::rollBack();
                dd($ex);
                abort(500);
            }
        }
      

        
     }

     public function checkPropertyName()
    {
        // Validate property name
        $this->validate([
            'propertyName' => 'required|unique:properties,name',
        ]);

        // Generate slug
        $this->slug = Str::slug($this->propertyName);
    }
    public function checkuserEmail()
    {
        // Validate property name
        $this->validate([
            'email' => 'required|unique:backend_users,email',
        ], [
            'email.unique' => 'The email address has already been taken. Please Login',
        ]);
    }
     // Add other steps' methods here...
 
     // Final Step: Save to Database
     public function saveToDatabase()
     {
         // Retrieve data from the session
         $userData = session('user_data');
         $propertyData = session('property_data');
         $destinationData = session('destination_data');
         // Retrieve data from other steps
 
         // Save to database
         // Example: Property::create($userData + $propertyData + $destinationData + ...);
 
         // Clear session data
      
 
         // Redirect or perform any other actions after saving
     }
 
     // Helper method to move to the next step
     public function nextStep()
     {
        
         $this->currentStep++;
     }
 
     // Helper method to move to the previous step
     public function previousStep()
     {
         $this->currentStep--;
     }
     public function generateSlug()
     {
         $this->slug = Str::slug($this->propertyName);
     }
}
