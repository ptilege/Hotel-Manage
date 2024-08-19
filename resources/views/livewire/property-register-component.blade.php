<section class="page-banner" style="background-image: url('{{ asset('images/main-slider/1.jpg') }}'); padding-bottom:30px;">
    <div class="d-flex justify-content-center align-items-center mt-5">
        <div class="card auth-form property-register bg-light-blue">
            <div class="card-body">
                <h5 class="text-center mt-3 mb-2">Register Your Property</h5>
                <!-- Form Steps / Progress Bar -->
                <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                    @for ($i = 1; $i <= 4; $i++) <li class="{{ $currentStep == $i - 1 ? 'form-stepper-active' : ($currentStep >= $i ? 'form-stepper-completed' : 'form-stepper-unfinished') }} text-center form-stepper-list" step="{{ $i }}">
                        <a class="mx-2">
                            <span class="form-stepper-circle">
                                <span>{{ $i }}</span>
                            </span>
                        </a>
                        </li>
                        @endfor
                </ul>
                <div class="tab-content" id="myTabContent">
                    @if ($currentStep == 0)
                    <div class="" id="profile">

                        <form class="mt-4" wire:submit.prevent="saveUser">
                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Full Name<span style="color: red; margin-left: 5px; font-size:20px;">*</span></label>
                                <input type="text" class="form-control" id="f_name" wire:model="name" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Full Name" wire:ignore>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Email Address<span style="color: red; margin-left: 5px; font-size:20px;">*</span></label>
                                <input type="email" class="form-control" id="r_email" wire:model="email" wire:keydown="checkuserEmail" wire:keyup="checkuserEmail" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Email Address" wire:ignore>
                                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Mobile Number<span style="color: red; margin-left: 5px; font-size:20px;">*</span></label>
                                <input type="text" class="form-control" id="mobile" wire:model="mobile" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Mobile Number" wire:ignore>
                                @error('mobile') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>
                                    Password<span style="color: red; margin-left: 5px; font-size:20px;">*</span>
                                </label>
                                <div style="position: relative; width: 100%;">
                                    <input type="password" class="form-control" id="r_password" wire:model="password" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Password" wire.ignore>
                                </div>
                                @error('password') 
                                    <div class="text-danger" style="margin-top: 10px;">{{ $message }}</div> 
                                @enderror

                                <div style="margin-top: 10px; width: 100%;">
                                    <div style="display: flex; align-items: center; margin-bottom: 5px;">
                                        <i class="fas fa-check-circle {{ strlen($password) >= 8 ? 'text-success' : 'text-muted' }}" style="margin-right: 5px;"></i>
                                        <label class="{{ strlen($password) >= 8 ? 'text-success' : 'text-muted' }}" for="">Minimum of 8 characters</label>
                                    </div>
                                    <div style="display: flex; align-items: center; margin-bottom: 5px;">
                                        <i class="fas fa-check-circle {{ preg_match('/[0-9]/', $password) ? 'text-success' : 'text-muted' }}" style="margin-right: 5px;"></i>
                                        <label class="{{ preg_match('/[0-9]/', $password) ? 'text-success' : 'text-muted' }}" for="">At least one number</label>
                                    </div>
                                    <div style="display: flex; align-items: center; margin-bottom: 5px;">
                                        <i class="fas fa-check-circle {{ preg_match('/[!@#$%^]/', $password) ? 'text-success' : 'text-muted' }}" style="margin-right: 5px;"></i>
                                        <label class="{{ preg_match('/[!@#$%^]/', $password) ? 'text-success' : 'text-muted' }}" for="">At least one symbol(!@#$%^)</label>
                                    </div>
                                </div>
                            </div>




                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Confirm Password<span style="color: red; margin-left: 5px; font-size:20px;">*</span></label>
                                <input type="password" class="form-control" id="c_password" wire:model="confirmPassword" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Confirm Password" wire:ignore>
                                @error('confirmPassword') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="container" style="padding: 0;">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <div class="button-box">
                                                <a class="btn-style-three theme-btn" style="padding: 4px 50px 4px 50px;" wire:click.prevent="previousStep">
                                                    <div class="btn-wrap">
                                                        <span class="text-one">Back</span>
                                                        <span class="text-two">Back</span>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="px-2"></div>

                                            <div class="button-box">
                                                <a class="btn-style-two theme-btn next-step" style="padding: 11px 50px 11px 50px;" wire:click.prevent="saveUser">
                                                    <div class="btn-wrap">
                                                        <span class="text-one">Next</span>
                                                        <span class="text-two">Next</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                    @elseif($currentStep == 1)
                    <div class="" id="profile">
                        <hr>
                        <form class="mt-4" wire:submit.prevent="createProperty">
                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Property Name <span style="color: red; margin-left: 5px; font-size:20px;">*</span></label>
                                <!-- <label>Property Name<span style="color: red; margin-left: 5px; font-size:20px;">*</span></label> -->
                                <input type="text" class="form-control" id="property_name" wire:model="propertyName" wire:keydown="checkPropertyName" wire:keyup="checkPropertyName" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Property Name" wire:ignore>

                                @error('propertyName') <div class="text-danger">{{ $message }}</div> @enderror


                            </div>
                            <div class="mb-2 text-primary">{{env('APP_URL')}}/{{$slug}}</div>
                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Property Type <span style="color: red; margin-left: 5px; font-size:20px;">*</span></label>
                                <!-- <label>Property Type<span style="color: red; margin-left: 5px; font-size:20px;">*</span></label> -->
                                <select name="" id="" style="font-size: 14px" class="form-select form-select-lg" wire:model="type" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Property Type" wire:ignore>
                                    <option value="" selected>Select Property Type</option>
                                    @foreach ($propertyType as $pType)
                                    <option value="{{$pType->id}}">{{$pType->name}}</option>
                                    @endforeach
                                </select>
                                @error('type') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Property Email address<span style="color: red; margin-left: 5px; font-size:20px;">*</span></label>
                                <!-- <label  class="form-label"  wire:ignore>Property Email address<span style="color: red; margin-left: 5px; font-size:20px;">*</span></label> -->
                                <input type="email" class="form-control" id="property_email" wire:model="propertyEmail" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Property Email address" wire:ignore>
                                @error('propertyEmail') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Property Contact Number<span style="color: red; margin-left: 5px; font-size:20px;">*</span></label>
                                <input type="text" class="form-control" id="property_contact" wire:model="propertyContact" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Property Contact Number" wire:ignore>
                                @error('propertyContact') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Property Address<span style="color: red; margin-left: 5px; font-size:20px;">*</span></label>
                                <input type="text" class="form-control" id="p_address" wire:model="address" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Property Address" wire:ignore>
                                @error('address') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="container" style="padding: 0;">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <div class="button-box">
                                                <a class="btn-style-three theme-btn" style="padding: 4px 50px 4px 50px;" wire:click.prevent="previousStep">
                                                    <div class="btn-wrap">
                                                        <span class="text-one">Back</span>
                                                        <span class="text-two">Back</span>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="px-2"></div>

                                            <div class="button-box">
                                                <a class="btn-style-two theme-btn" style="padding: 11px 50px 11px 50px;" wire:click.prevent="createProperty">
                                                    <div class="btn-wrap">
                                                        <span class="text-one">Next</span>
                                                        <span class="text-two">Next</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    @elseif($currentStep == 2)
                    <div class="" id="profile" wire:ignore.self>
                        <hr>
                        <form class="mt-4" wire:submit.prevent="destination-data">
                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Property Destination<span style="color: red; margin-left: 5px; font-size:20px;">*</span></label>
                                <select name="" id="" style="font-size: 14px" class="form-select form-select-lg" wire:model="dtype" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Property Destination" wire:ignore>
                                    <option value="" selected>Select Property Destination</option>
                                    @foreach ($destination as $dType)
                                    <option value="{{$dType->id}}">{{$dType->name}}</option>
                                    @endforeach
                                </select>
                                @error('dtype') <div class="text-danger">{{ $message }}</div> @enderror

                            </div>


                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Property Video Url</label>
                                <!-- <label  class="form-label"   wire:ignore>Property Video Url</label> -->
                                <input type="text" class="form-control" id="propertyvideourl" wire:model="propertyvideourl" wire:model="dtype" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Property Embed Youtube Video Url" wire:ignore>
                                @error('propertyvideourl') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Property Star Rate</label>
                                <select class="form-select" id="propertystarRate" wire:model="propertystarRate" wire:model="dtype" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enter Your Property Star Rate" wire:ignore>
                                    <option value="">Select Star Rating</option>
                                    <option value="5">5 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="2">2 Stars</option>
                                    <option value="1">1 Star</option>
                                </select>
                                @error('propertystarRate') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3" style="display: flex; align-items: center; flex-wrap: wrap;">
                                <label>Property Description <span style="color: red; margin-left: 5px; font-size:20px;">*</span></label>
                                <textarea class="form-control" id="additionalComments" wire:model="propertydescription" placeholder="Provide a comprehensive description of your property, incorporating essential details such as basic information, style, neighbourhood, and amenities. Every meticulous detail contributes to securing your next booking." name="additionalComments" rows="7" wire:ignore></textarea>
                                @error('propertydescription') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="space" style="padding-bottom: 20px;"></div>

                            <div class="container" style="padding: 0;">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex" style="padding-left: 0px;">
                                            <div class="button-box">
                                                <a class="btn-style-three theme-btn" style="padding: 4px 50px 4px 50px;" wire:click.prevent="previousStep">
                                                    <div class="btn-wrap">
                                                        <span class="text-one">Back</span>
                                                        <span class="text-two">Back</span>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="px-2"></div>

                                            <div class="button-box">
                                                <a class="btn-style-two theme-btn" style="padding: 11px 50px 11px 50px;" wire:click.prevent="createdestination">
                                                    <div class="btn-wrap">
                                                        <span class="text-one">Next</span>
                                                        <span class="text-two">Next</span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>



                    @elseif($currentStep == 3)
                    <div class="" id="profile" wire:ignore.self>
                        <hr>
                        <form class="mt-4" wire:submit.prevent="description">
                            <div class="animation" style="text-align: center;">
                                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                                <lord-icon src="https://cdn.lordicon.com/cqofjexf.json" trigger="loop" delay="2000" stroke="light" colors="primary:#121331,secondary:#ffc738,tertiary:#1b1091" style="width:100px;height:100px">
                                </lord-icon>
                            </div>

                            <div class="mb-3" style="text-align: center;">
                                <label class="lableCon">Congratulations</label>
                                <p style="margin-top: 5px;"> The completion of the listing is a result of careful attention to detail, thorough research, and a commitment to delivering high-quality work. </p>
                            </div>
                        </form>
                    </div>

                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<style>
    .lableCon {
        text-align: center;
        font-size: 35px;
        color: #00427F;
    }

    .text-xs {
        font-size: .75rem;
        line-height: 1rem;
    }

    .text-neutral-500 {
        color: #9CA3AF;
    }

    .pl-1 {
        padding-left: 0.25rem;
    }

    .text-primary-6000 {
        color: #00427F;
    }

    .font-medium {
        font-weight: 500;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .relative {
        position: relative;
    }

    .card-container {
        position: relative;
        top: 70%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
    }
</style>
<script>
    $(document).ready(function() {

        // Enable Bootstrap tooltips on page load
        $('[data-bs-toggle="tooltip"]').tooltip();

        // Ensure Livewire updates re-instantiate tooltips
        if (typeof window.Livewire !== 'undefined') {
            window.Livewire.hook('message.processed', (message, component) => {
                $('[data-bs-toggle="tooltip"]').tooltip('dispose').tooltip();
            });
        }

    });


    function limitInput(input) {
        if (input.value > 5) {
            input.value = 5;
        }
    }
</script>