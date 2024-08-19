<div>


    <!-- <div class="bg-primary cart-icon" style="display:@if (count($cartItems)>0) flex @else none @endif;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <i class="fas fa-hotel"></i>
        </div> -->

    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" wire:ignore.self>
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Your Selected Room(s) Summary</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body position-relative">
            @foreach ($cartItems as $item)
            <div class="card cart-item mb-2" style="background:#f5f9ff;">
                <div class="card-header p-1 pb-0 d-flex align-items-center justify-content-between border-0" style="background:#f5f9ff;">
                    <h5 class="card-title m-0 ps-2 text-black">{{$item['room']?$item['room']->name:''}}</h5>
                    <button class="btn text-black" wire:click="removeItem('{{$item['rowId']}}')"><i class="fa fa-times"></i></button>
                </div>
                <div class="card-body pt-0">
                    <div class="room-data mb-1 text-black">
                        <div>{{$item['bed_type']?$item['bed_type']->name:''}}/{{$item['meal_type']?$item['meal_type']->name:''}}</div>
                        <div><b>{{$item['room_qty']?$item['room_qty']:'0'}} Room(s)</b></div>

                    </div>
                    <div class="room-data mb-1 text-black">
                        <div><b>{{$item['adult_qty']?$item['adult_qty']:'0'}} Extra Bed(s)</b></div>
                        <div>
                            <div><b>{{$item['bed_type']?$item['bed_type']->quantity:'0'}} Adult(s)</b></div>
                            <div><b>{{$item['child_qty']?$item['child_qty']:'0'}} Children</b></div>
                        </div>
                    </div>
                    <hr class="my-1">
                    <div class="room-data text-black">
                        <div style="font-size:16px;">
                            <b>Price:</b>
                        </div>
                        <div style="font-size:16px;">
                            <b>{{ $currencytext }} {{number_format($item['partial_amount']?$item['partial_amount']:$item['total_amount'], 2, '.', ',')}}</b>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
            <div class="cart-proceed-to-checkout">
                <div class="card " style="background:#f5f9ff;">
                    <div class="card-body text-black">
                        <div class="room-data">
                            <div>Tax </div>
                            <div>{{ $currencytext }} 0.00</div>
                        </div>
                        <div class="room-data">
                            <div>Net Amount </div>
                            <div>{{ $currencytext }} {{number_format($totalAmount, 2, '.', ',')}}</div>
                        </div>
                        <a class="btn btn-primary w-100 mt-2" href="{{route('checkout')}}">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>