<div>

    <!-- Page Banner -->
    <section class="banner-one">
        <div class="banner-one_image-layer" style="background-image: url('{{ asset('images/main-slider/1.jpg') }}')"></div>
        <div class="auto-container">

            <!-- Content Column -->
            <div class="banner-one_content">
                <div class="banner-one_content-inner">
                    <div class="container">
                        <!--breadcrumb-->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active" style="color: #808080;" aria-current="page">Profile</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="banner-one_title">

                    </div>
                    <h1 class="banner-one_heading">Profile</h1>




                </div>
            </div>
        </div>
    </section>
    <!-- End Page Banner -->

    <div class="container bootstrap snippets bootdey">
        <div class="row">
            <div class="profile-nav col-md-3 mb-5 mt-5">
                <div class="card">
                    <div class="user-heading round bg-light-blue text-dark">
                        <!-- <a href="#">
                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="">
                    </a> -->

                        <label id="profileImageContainer" for="avatarInput" wire:loading.class="opacity-50">
                            <img id="profileImage" src="{{$avatarUrl}}" alt="" />

                        </label>

                        <h1 class="heding-text-main">{{$customer->name}}</h1>
                        <p class="text-main-sub">{{$customer->email}}</p>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <li><a class="nav-link py-3 @if($tab == 'profile' || $tab == 'profile-edit') active @endif" wire:click="setTab('profile')" id="v-pills-profile-tab" type="button" role="tab">Profile</a></li>

                        <li><a class="nav-link py-3 @if($tab == 'change-password') active @endif" wire:click="setTab('change-password')" id="v-pills-change-password-tab" type="button" role="tab">Change Password</a></li>

                        <li><a class="nav-link py-3 @if($tab == 'booking-history') active @endif" wire:click="setTab('booking-history')" id="v-pills-bookings-tab" type="button" role="tab">Bookings</a></li>
                    </div>
                    {{-- <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <ul class="nav nav-pills">
                      <li class="nav-item nav-link active" role="presentation"><a href="#"> <i class="fa fa-user"></i> Profile</a></li>
                      <li class="nav-item nav-link" role="presentation"><a href="#"> <i class="fa fa-calendar"></i> Recent Activity <span class="label label-warning pull-right r-activity">9</span></a></li>
                      <li class="nav-item nav-link" role="presentation"><a href="#"> <i class="fa fa-edit"></i> Edit profile</a></li>
                      
                  </ul>
                      </div> --}}
                </div>
            </div>
            <div class="profile-info col-md-9" style="padding: 20px;">
                <div class="panel">

                    <div class="panel-body bio-graph-info">
                        @if ($tab == 'profile')

                        <!-- <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <div class="row m-0">
                                            <div class="col-4">Name</div>
                                            <div class="col-8">: {{$customer->name}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <div class="row m-0">
                                            <div class="col-4">Email</div>
                                            <div class="col-8">: {{$customer->email}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <div class="row m-0">
                                            <div class="col-4">Mobile</div>
                                            <div class="col-8">: {{$customer->phone}}</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <div class="row m-0">
                                            <div class="col-4">NIC / Passport No.</div>
                                            <div class="col-8">: 1122554463 V</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <div class="row m-0">
                                            <div class="col-4">Address</div>
                                            <div class="col-8">: colombo, Sri Lanka</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <div class="row m-0">
                                            <div class="col-4">Country</div>
                                            <div class="col-8">: Sri Lanka</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12 mb-3">
                                        <div class="row m-0">
                                            <div class="col-4">City</div>
                                            <div class="col-8">: Colombo</div>
                                        </div>
                                    </div>
                                </div> -->
                        <!-- <div class="d-flex w-100 justify-content-end"> -->
                        <!-- <button class="btn btn-primary d-inline-block" wire:click="setTab('profile-edit')">Edit</button> -->
                        <!-- <div class="button-box">
                                        <button class="btn-style-two" wire:click="setTab('profile-edit')">
                                            <span class="btn-wrap">
                                                <span class="text-one">Edit</span>
                                                <span class="text-two">Edit</span>
                                            </span>
                                        </button>
                                    </div>
                                </div> -->
                        @php
                        $userEmail = Auth::guard('customers')->user()->email;
                        $userBookings = \App\Models\Booking::where('email', $userEmail)->get();
                        $latestBooking = $userBookings->last(); 
                        @endphp
                        <div class="card bg-light-blue">
                            <div class="card-header p-5 py-4">
                                <h4 class="mb-0 ff-base fw-semibold heding-text-main">Personal Information</h4>
                            </div>

                            <div class="card-body ">
                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-6" style="padding:20px;">
                                            <div class="form-group">
                                                <label class="form-label ">Full Name</label>
                                                <input type="text" class="form-control flatpickr bg-white flatpickr-input" name="full_name" value="{{$customer->name}}" placeholder="Full Name" required="" readonly="readonly">
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="padding:20px;">
                                            <div class="form-group">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control flatpickr bg-white flatpickr-input" name="email" value="{{$customer->email}}" placeholder="Email ID" required="" readonly="readonly">
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="padding:20px;">
                                            <div class="form-group">
                                                <label class="form-label">Phone</label>
                                                <input type="email" class="form-control flatpickr bg-white flatpickr-input" name="number" value="{{$customer->phone}}" placeholder="Phone Number" readonly="readonly">
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="padding:20px;">
                                            <div class="form-group">
                                                <label class="form-label">NIC / Passport No</label>
                                                <input type="text" class="form-control flatpickr bg-white flatpickr-input" name="number" value="{{$customer->nic}}" required="" readonly="readonly">
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="padding:20px;">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <input type="text" class="form-control flatpickr bg-white flatpickr-input" name="dob" value="{{$customer->address}}" required="" readonly="readonly">
                                            </div>
                                        </div>

                                        <div class="col-lg-6" style="padding:20px;">
                                            <div class="form-group">

                                                <label class="form-label">Country</label>
                                                <input type="text" class="form-control flatpickr bg-white flatpickr-input" name="dob" value="{{$customer->country}}" required="" readonly="readonly">
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="padding:20px;">
                                            <div class="form-group">
                                                <label class="form-label">city</label>
                                                <input type="text" class="form-control flatpickr bg-white flatpickr-input" name="dob" value="{{$customer->city}}" required="" readonly="readonly">
                                            </div>



                                            <!-- <div class="form-group mb-5 mt-5">

                                                <button class="btn-style-two" wire:click="setTab('profile-edit')">
                                                    <span class="btn-wrap">
                                                        <span class="text-one">Edit</span>
                                                        <span class="text-two">Edit</span>
                                                    </span>
                                                </button>

                                            </div> -->
                                            <div class="form-group mb-0 mt-5">
                                                <button class="btn-style-two" style=" width:200px;" wire:click.prevent="setTab('profile-edit')">
                                                    <span class="btn-wrap">
                                                        <span class="text-one">Edit Details</span>
                                                        <span class="text-two" style="width: 100%;">Edit Details</span>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        @endif
                        @if($tab == 'profile-edit')
                        <div class="card p-2 bg-light-blue">
                            <div class="card-body">
                                <form wire:submit.prevent="updateProfile">
                                    <div class="row m-0">
                                        <div class="col-lg-6 col-12 mb-2">
                                            <label class="form-label" for="name">Name</label>
                                            <div class="input-group mb-2">
                                                <input class="form-control" type="text" id="name" placeholder="Full Name" wire:model="name" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2">
                                            <label class="form-label" for="email">Email</label>
                                            <div class="input-group mb-2">
                                                <input class="form-control" type="email" id="email" placeholder="example@email.com" wire:model="email" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2">
                                            <label class="form-label" for="phone">Phone</label>
                                            <div class="input-group mb-2">
                                                <input class="form-control" type="text" id="phone" placeholder="0117555333" wire:model="phone"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2">
                                            <label class="form-label" for="nic_passport">NIC / Passport No</label>
                                            <div class="input-group mb-2">
                                                <input class="form-control" type="text" id="nic_passport" placeholder="123654125 V" wire:model="nic"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2">
                                            <label class="form-label" for="address">Address</label>
                                            <div class="input-group mb-2">
                                                <input class="form-control" type="text" id="address" placeholder="Colombo, Sri Lanka" wire:model="address"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2">
                                            <label class="form-label" for="country">Country</label>
                                            <div class="input-group mb-2">
                                            <input class="form-control" type="text" id="country" placeholder="Sri Lanka" wire:model="country"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2">
                                            <label class="form-label" for="city">City</label>
                                            <div class="input-group mb-2">
                                            <input class="form-control" type="text" id="city" placeholder="Colombo" wire:model="city"/>
                                            </div>
                                        </div>
                                        <!-- Avatar update -->
                                        <div class="mb-3">
                                            <label for="updateAvatar" class="form-label">Update Avatar</label>
                                            <input type="file" id="updateAvatar" wire:model="updateAvatar" class="form-control">
                                            @error('updateAvatar') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex w-100 justify-content-end">
                                        <!-- <button type="submit" class="btn-style-two" style=" width:200px;">
                                            <span class="btn-wrap">
                                                <span class="text-one">Update</span>
                                                <span class="text-two" style="width: 100%;">Update</span>
                                            </span>
                                        </button> -->
                                        <button class="btn-style-two" style=" width:200px;">
                                            <span class="btn-wrap">
                                                <span class="text-one">Update</span>
                                                <span class="text-two" style="width: 100%;">Update</span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                        @if($tab == 'change-password')
                        <div class="card p-2 bg-light-blue">
                            <div class="card-header p-5 py-4">
                                <h4 class="mb-0 ff-base fw-semibold heding-text-main">Change Password</h4>
                            </div>
                            <div class="card-body">

                                <form wire:submit.prevent="updatePassword">
                                    @csrf
                                    <div class="row m-0">
                                        <div class="col-lg-6 col-12 mb-2">
                                            <label class="form-label" for="currentPassword">Current Password</label>
                                            <div class="input-group mb-2">
                                                <input wire:model.defer="currentPassword" class="form-control" type="password" name="currentPassword" placeholder="Current Password" required />
                                            </div>
                                            @error('currentPassword') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2"></div>
                                        <div class="col-lg-6 col-12 mb-2">
                                            <label class="form-label" for="newPassword">New Password</label>
                                            <div class="input-group mb-2">
                                                <input wire:model.defer="newPassword" class="form-control" type="password" name="newPassword" placeholder="New Password" required />
                                            </div>
                                            @error('newPassword') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="col-lg-6 col-12 mb-2">
                                            <label class="form-label" for="passwordConfirmation">Confirm Password</label>
                                            <div class="input-group mb-2">
                                                <input wire:model.defer="passwordConfirmation" class="form-control" type="password" name="passwordConfirmation" placeholder="Confirm Password" required />
                                            </div>
                                            @error('passwordConfirmation') <span class="text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="d-flex w-100 justify-content-end">
                                        <button type="submit" class="btn btn-primary d-inline-block">Update</button>
                                    </div> -->
                                    <div class="d-flex w-100 justify-content-end">
                                    <button type="submit" class="btn-style-two d-inline-block " style=" width:200px;">
                                            <span class="btn-wrap">
                                                <span class="text-one">Update</span>
                                                <span class="text-two" style="width: 100%;">Update</span>
                                            </span>
                                        </button>
                                        </div>

                                    @if(session()->has('message'))
                                    <div class="mt-3 alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                        @endif

                        @if($tab == 'booking-history')
                        <div class="card p-2 bg-light-blue">
                            <div class="card-body" style="max-height: 450px; overflow-y: auto;">
                                <div class="card-header p-5 py-4">
                                    <h4 class="mb-0 ff-base fw-semibold heding-text-main">Booking Summary</h4>
                                    @if(session()->has('messageb'))
                                    <div class="mt-3 alert alert-success">
                                        {{ session('messageb') }}
                                    </div>
                                    @endif
                                </div>

                                @foreach($bookings as $booking)


                              
                                <div class="card-body">


                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="tab-1" role="tabpanel">
                                            <div class="card">
                                                <div class="card-body">

                                                    <table class="booking-table w-100">
                                                        <thead class="bg-soft-info">
                                                            <tr>
                                                                <th colspan="3">Property Name</th>
                                                                <th>Booking Number</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="3">
                                                                    <div class="fw-semibold">{{ $booking->property->name }}</div>

                                                                    <!-- <p class="mb-0">01:00 PM</p> -->
                                                                </td>
                                                                <td>
                                                                    <div class="fw-semibold">{{ $booking->id }}</div>
                                                                </td>

                                                            </tr>
                                                        </tbody>
                                                        <thead class="bg-soft-info">
                                                            <tr>
                                                                <th class="p-2">Check-In</th>
                                                                <th class="p-2">Check-Out</th>
                                                                <th class="p-2">Booking Created</th>
                                                                <th class="p-2">Booking Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="p-2">
                                                                    <div class="fw-semibold">{{ $booking->checkin_date}}</div>

                                                                </td>
                                                                <td class="p-2">
                                                                    <div class="fw-semibold">{{ $booking->checkout_date}}</div>

                                                                </td>
                                                                <td class="p-2">
                                                                    <div class="fw-semibold">{{ $booking->created_at }}</div>
                                                                </td>
                                                                <td class="p-2">
                                                                    <div class="fw-semibold">{{ $booking->status }}</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>


                                        </div>




                                    </div>

                                </div>

                                @endforeach
                            </div>

                        </div>
                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #profileImageContainer {
        position: relative;
        width: 150px;
        /* Set the desired width */
        height: 150px;
        /* Set the desired height */
        overflow: hidden;
        border-radius: 50%;
        cursor: pointer;
    }

    #profileImageContainer:hover .overlay {
        display: flex;
        /* show overlay on hover */
    }

    #profileImage {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    #avatarInput {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        display: none;
        background: rgba(0, 0, 0, 0.5);
        cursor: pointer;

        justify-content: center;
        align-items: center;

    }

    .overlay.hover:hover {
        display: block;
        /* show overlay on hover */
    }

    .contact-form-wrapper {
        -webkit-box-shadow: 0px 10px 60px rgba(28, 35, 31, 0.07);
        box-shadow: 0px 10px 60px rgba(28, 35, 31, 0.07);
        border-radius: 12px;
        background-color: #fff;
        padding: 53px 70px 60px;
    }

    .card {
        background-color: #ffffff;
        transition: all .5s ease-in-out;
        position: relative;
        border-radius: 0.875rem;
        margin-bottom: 1.875rem;
        overflow: hidden;
    }

    .card-header:first-child {
        border-radius: var(--vacasky-card-inner-border-radius) var(--vacasky-card-inner-border-radius) 0 0;
    }

    .card-header {
        border-color: #F5F5F5;
        border-bottom: 1px solid #F5F5F5;
        position: relative;
        background: transparent;
        padding: 0.625rem 0rem;
    }

    .py-4 {
        padding-top: 20px !important;
        padding-bottom: 20px !important;
    }

    .p-5 {
        padding: 30px !important;
    }

    .btn {
        --vacasky-btn-padding-x: 2.3rem;
        --vacasky-btn-padding-y: 0.75rem;

        --vacasky-btn-font-size: 1rem;
        --vacasky-btn-font-weight: 400;
        --vacasky-btn-line-height: 1.45;
        /* --vacasky-btn-bg: #00427F; */
        background-color: #00427F;
        /* --vacasky-btn-bg: transparent;
    --vacasky-btn-color: #ffffff;
    --vacasky-btn-bg: #00427F;;
      vacasky-btn-border-color: #00427F;
    --vacasky-btn-hover-color: #ffffff;
    --vacasky-btn-hover-bg: #3e80b3; */
        /* --vacasky-btn-border-width: 1px; */

        --vacasky-btn-border-radius: 0.5rem;
        /* --vacasky-btn-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(0, 0, 0, 0.075); */
        /* --vacasky-btn-disabled-opacity: 0.65; */
        /* --vacasky-btn-focus-box-shadow: 0 0 0 0.25rem rgba(var(--vacasky-btn-focus-shadow-rgb), .5); */

        padding: var(--vacasky-btn-padding-y) var(--vacasky-btn-padding-x);
        font-family: var(--vacasky-btn-font-family);
        font-size: var(--vacasky-btn-font-size);
        font-weight: var(--vacasky-btn-font-weight);
        line-height: var(--vacasky-btn-line-height);

        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        user-select: none;

        border-radius: var(--vacasky-btn-border-radius);
        /* background-color: var(--vacasky-btn-bg); */

    }
</style>


<script>


</script>