<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Offer;
use App\Models\Property;
use App\Models\Partner;
use App\Models\Rate;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $backendProperty = PropertyController::getBackendProperty();
        // $user->properties();
    //   dd($user->id);
        $userProperty = $user->properties;
        // dd($userProperty);
        $userrole = $user->roles;
        $typeColumn = $userrole->pluck('type')->toArray();
        $propertyTypeId = $request->input('property_type_id');
        
        if (in_array('property', $typeColumn)) {
           
            if($backendProperty){
                // dd($backendProperty->id);
                //allincome
                $AllIncome = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->sum('total_amount');
                
                //incomelastweek
                $IncomeLastWeek = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->where('created_at', '>=', now()->subWeek())->sum('total_amount');
            
                //incomelastmonth
                $IncomeLastMonth = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->where('created_at', '>=', now()->subMonth())->sum('total_amount');
    
                //allbookincount
                $BookingsCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->count();
    
                //bookingcountlastweek
                $BookingsLastWeekCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->where('created_at', '>=', now()->subWeek())->count();
    
                //bookingcountlastmonth
                $BookingsLastMonthCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->where('created_at', '>=', now()->subMonth())->count();
               
                //allPbookincount
                $PBookingsCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'pending'])->count();
    
                //Pbookingcountlastweek
                $PBookingsLastWeekCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'pending'])->where('created_at', '>=', now()->subWeek())->count();
    
                //Pbookingcountlastmonth
                $PBookingsLastMonthCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'pending'])->where('created_at', '>=', now()->subMonth())->count();
    
    
                $propertytype = DB::table('property_types')
                ->leftJoin('properties', 'property_types.id', '=', 'properties.property_type_id')
                ->select('property_types.id', 'property_types.name', 'property_types.status', DB::raw('COUNT(properties.property_type_id) as property_count'))
                ->groupBy('property_types.id', 'property_types.name', 'property_types.status')
                ->get();
                // dd($propertytype);
                //topproperties
                $topOffers = Offer::where(['property_id'=>$backendProperty->id, 'status'=> 1])->orderByDesc('created_at')->limit(4)->get(); 
    
                $rates = Rate::where(['property_id'=>$backendProperty->id, 'status'=> 1])->orderByDesc('created_at')->limit(6)->get(); 
               
    
                //propertydetails
                $propertyDetails = Property::limit(5)->get(['name', 'status', 'address_1']);
                //  dd($propertyDetails);
    
                $bookingDetails = Booking::where(['property_id'=>$backendProperty->id])->orderByDesc('created_at')->limit(10)->get();
                //  dd($bookingDetails);
    
                $AllIncomedetails = Booking::where(['property_id' => $backendProperty->id])->sum('total_amount');
    
                // Check if $AllIncomedetails is not zero before performing the division
                $incomeprecentage = $AllIncomedetails != 0 ? $AllIncome / $AllIncomedetails * 100 : 0;
                $incomeprecentage = number_format($incomeprecentage, 1);
                
                $BookingsCountdetails = Booking::where(['property_id' => $backendProperty->id])->count();
                
                // Check if $BookingsCountdetails is not zero before performing the division
                $bookingconfirmprecentage = $BookingsCountdetails != 0 ? $BookingsCount / $BookingsCountdetails * 100 : 0;
                $bookingconfirmprecentage = number_format($bookingconfirmprecentage, 1);
                
                // Check if $BookingsCountdetails is not zero before performing the division
                $bookingpendingprecentage = $BookingsCountdetails != 0 ? $PBookingsCount / $BookingsCountdetails * 100 : 0;
                $bookingpendingprecentage = number_format($bookingpendingprecentage, 1);
                
                // dd($incomeprecentage);
    
                $income = ['AllIncome'=> $AllIncome, 'IncomeLastWeek'=> $IncomeLastWeek, 'IncomeLastMonth'=> $IncomeLastMonth ];
                $counts = ['BookingsCount'=>$BookingsCount, 'BookingsLastWeekCount'=>$BookingsLastWeekCount, 'BookingsLastMonthCount'=>$BookingsLastMonthCount, 'PBookingsCount'=>$PBookingsCount, 'PBookingsLastWeekCount'=>$PBookingsLastWeekCount,'PBookingsLastMonthCount'=>$PBookingsLastMonthCount];
            
                return Inertia::render('HotelDashboard/Index', ['counts'=> $counts, 'income'=>$income, 'topOffers'=> $topOffers, 'propertyDetails'=>$propertyDetails, 'propertytype'=>$propertytype, 'bookingDetails'=>$bookingDetails, 'rates'=>$rates, 'incomeprecentage'=> $incomeprecentage, 'bookingconfirmprecentage'=> $bookingconfirmprecentage, 'bookingpendingprecentage'=>$bookingpendingprecentage]);
                
            }
            else{
                //allincome
                $AllIncome = Booking::where(['status'=>'confirm'])
                ->whereIn('property_id', $userProperty->pluck('id'))
                ->sum('total_amount');
                // dd($AllIncome);
                //incomelastweek
                $IncomeLastWeek = Booking::where(['status'=>'confirm'])
                ->whereIn('property_id', $userProperty->pluck('id'))
                ->where('created_at', '>=', now()->subWeek())->sum('total_amount');
            
                //incomelastmonth
                $IncomeLastMonth = Booking::where(['status'=>'confirm'])
                ->whereIn('property_id', $userProperty->pluck('id'))
                ->where('created_at', '>=', now()->subMonth())->sum('total_amount');
    
                //allpropertiescount
                $AllPropertiesCount = Property::where(['status'=> 1])
                ->whereIn('id', $userProperty->pluck('id'))
                ->count();
                
                

                //propertiescountlastweek
                $PropertiesCountLastWeek = Property::where(['status'=> 1])
                ->whereIn('id', $userProperty->pluck('id'))
                ->where('created_at', '>=', now()->subWeek())->count();
            
                //propertiescountlastmonth
                $PropertiesCountLastMonth = Property::where(['status'=> 1])
                ->whereIn('id', $userProperty->pluck('id'))
                ->where('created_at', '>=', now()->subMonth())->count();
    
                //allbookincount
                $BookingsCount = Booking::where(['status'=>'confirm'])
                ->whereIn('property_id', $userProperty->pluck('id'))
                ->count();
    
                //bookingcountlastweek
                $BookingsLastWeekCount = Booking::where(['status'=>'confirm'])
                ->whereIn('property_id', $userProperty->pluck('id'))
                ->where('created_at', '>=', now()->subWeek())->count();
    
                //bookingcountlastmonth
                $BookingsLastMonthCount = Booking::where(['status'=>'confirm'])
                ->whereIn('property_id', $userProperty->pluck('id'))
                ->where('created_at', '>=', now()->subMonth())->count();
    
                //allpartnerscount
                $PartnerCount = Partner::where(['status'=> 1])->count();
                
                //partnerscountlastweek
                $PartnerLastWeekCount = Partner::where(['status'=> 1])->where('created_at', '>=', now()->subWeek())->count();
                
                //allpartnerscountlastmonth
                $PartnerLastMonthCount = Partner::where(['status'=> 1])->where('created_at', '>=', now()->subMonth())->count();
    
                $propertytype = DB::table('property_types')
                ->leftJoin('properties', 'property_types.id', '=', 'properties.property_type_id')
                ->select('property_types.id', 'property_types.name', 'property_types.status', DB::raw('COUNT(properties.property_type_id) as property_count'))
                ->groupBy('property_types.id', 'property_types.name', 'property_types.status');

                $propertytype->whereIn('properties.id', $userProperty->pluck('id'));
                $propertytype = $propertytype->get();
                // dd($propertytype);
                //topproperties
                $topProperties = DB::table('bookings')
                ->join('properties', 'bookings.property_id', '=', 'properties.id')
                ->select('properties.id', 'properties.name', DB::raw('COUNT(bookings.id) as booking_count'))
                ->groupBy('properties.id', 'properties.name')
                ->whereIn('properties.id', $userProperty->pluck('id'))
                ->orderByDesc('booking_count')
                ->limit(4) 
                ->get();
               
    
                //propertydetails
                $propertyDetails = Property::limit(5)
                ->whereIn('properties.id', $userProperty->pluck('id'))
                ->get(['name', 'status', 'address_1']);
                //  dd($propertyDetails);
    
                $bookingDetails = Booking::whereIn('property_id', $userProperty->pluck('id'))->orderByDesc('created_at')->limit(10)->get();
                //  dd($bookingDetails);
    
                $income = ['AllIncome'=> $AllIncome, 'IncomeLastWeek'=> $IncomeLastWeek, 'IncomeLastMonth'=> $IncomeLastMonth ];
                $counts = ['BookingsCount'=>$BookingsCount, 'BookingsLastWeekCount'=>$BookingsLastWeekCount, 'BookingsLastMonthCount'=>$BookingsLastMonthCount, 'AllPropertiesCount'=> $AllPropertiesCount, 'PropertiesCountLastWeek'=> $PropertiesCountLastWeek, 'PropertiesCountLastMonth'=> $PropertiesCountLastMonth, 'PartnerCount'=>$PartnerCount,'PartnerLastWeekCount'=>$PartnerLastWeekCount,'PartnerLastMonthCount'=>$PartnerLastMonthCount];
            
                return Inertia::render('Dashboard/Index', ['counts'=> $counts, 'income'=>$income, 'topProperties'=> $topProperties, 'propertyDetails'=>$propertyDetails, 'propertytype'=>$propertytype, 'bookingDetails'=>$bookingDetails]);
            }
        } else {
            if($backendProperty){
                // dd($backendProperty->id);
                //allincome
                $AllIncome = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->sum('total_amount');
                
                //incomelastweek
                $IncomeLastWeek = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->where('created_at', '>=', now()->subWeek())->sum('total_amount');
            
                //incomelastmonth
                $IncomeLastMonth = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->where('created_at', '>=', now()->subMonth())->sum('total_amount');
    
                //allbookincount
                $BookingsCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->count();
    
                //bookingcountlastweek
                $BookingsLastWeekCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->where('created_at', '>=', now()->subWeek())->count();
    
                //bookingcountlastmonth
                $BookingsLastMonthCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'confirm'])->where('created_at', '>=', now()->subMonth())->count();
               
                //allPbookincount
                $PBookingsCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'pending'])->count();
    
                //Pbookingcountlastweek
                $PBookingsLastWeekCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'pending'])->where('created_at', '>=', now()->subWeek())->count();
    
                //Pbookingcountlastmonth
                $PBookingsLastMonthCount = Booking::where(['property_id'=>$backendProperty->id,'status'=>'pending'])->where('created_at', '>=', now()->subMonth())->count();
    
    
                $propertytype = DB::table('property_types')
                ->leftJoin('properties', 'property_types.id', '=', 'properties.property_type_id')
                ->select('property_types.id', 'property_types.name', 'property_types.status', DB::raw('COUNT(properties.property_type_id) as property_count'))
                ->groupBy('property_types.id', 'property_types.name', 'property_types.status')
                ->get();
                // dd($propertytype);
                //topproperties
                $topOffers = Offer::where(['property_id'=>$backendProperty->id, 'status'=> 1])->orderByDesc('created_at')->limit(4)->get(); 
    
                $rates = Rate::where(['property_id'=>$backendProperty->id, 'status'=> 1])->orderByDesc('created_at')->limit(6)->get(); 
               
    
                //propertydetails
                $propertyDetails = Property::limit(5)->get(['name', 'status', 'address_1']);
                //  dd($propertyDetails);
    
                $bookingDetails = Booking::where(['property_id'=>$backendProperty->id])->orderByDesc('created_at')->limit(10)->get();
                //  dd($bookingDetails);
    
                $AllIncomedetails = Booking::where(['property_id' => $backendProperty->id])->sum('total_amount');
    
                // Check if $AllIncomedetails is not zero before performing the division
                $incomeprecentage = $AllIncomedetails != 0 ? $AllIncome / $AllIncomedetails * 100 : 0;
                $incomeprecentage = number_format($incomeprecentage, 1);
                
                $BookingsCountdetails = Booking::where(['property_id' => $backendProperty->id])->count();
                
                // Check if $BookingsCountdetails is not zero before performing the division
                $bookingconfirmprecentage = $BookingsCountdetails != 0 ? $BookingsCount / $BookingsCountdetails * 100 : 0;
                $bookingconfirmprecentage = number_format($bookingconfirmprecentage, 1);
                
                // Check if $BookingsCountdetails is not zero before performing the division
                $bookingpendingprecentage = $BookingsCountdetails != 0 ? $PBookingsCount / $BookingsCountdetails * 100 : 0;
                $bookingpendingprecentage = number_format($bookingpendingprecentage, 1);
                
                // dd($incomeprecentage);
    
                $income = ['AllIncome'=> $AllIncome, 'IncomeLastWeek'=> $IncomeLastWeek, 'IncomeLastMonth'=> $IncomeLastMonth ];
                $counts = ['BookingsCount'=>$BookingsCount, 'BookingsLastWeekCount'=>$BookingsLastWeekCount, 'BookingsLastMonthCount'=>$BookingsLastMonthCount, 'PBookingsCount'=>$PBookingsCount, 'PBookingsLastWeekCount'=>$PBookingsLastWeekCount,'PBookingsLastMonthCount'=>$PBookingsLastMonthCount];
            
                return Inertia::render('HotelDashboard/Index', ['counts'=> $counts, 'income'=>$income, 'topOffers'=> $topOffers, 'propertyDetails'=>$propertyDetails, 'propertytype'=>$propertytype, 'bookingDetails'=>$bookingDetails, 'rates'=>$rates, 'incomeprecentage'=> $incomeprecentage, 'bookingconfirmprecentage'=> $bookingconfirmprecentage, 'bookingpendingprecentage'=>$bookingpendingprecentage]);
                
            }
            else{
                //allincome
                $AllIncome = Booking::where(['status'=>'confirm'])->sum('total_amount');
                
                //incomelastweek
                $IncomeLastWeek = Booking::where(['status'=>'confirm'])->where('created_at', '>=', now()->subWeek())->sum('total_amount');
            
                //incomelastmonth
                $IncomeLastMonth = Booking::where(['status'=>'confirm'])->where('created_at', '>=', now()->subMonth())->sum('total_amount');
    
                //allpropertiescount
                $AllPropertiesCount = Property::where(['status'=> 1])->count();
               
    //             $activeSelectedPropertiesCount = Property::where('status', 1)
    // ->whereIn('id', $userProperty->pluck('id'))
    // ->count();
     
    // $inActiveSelectedPropertiesCount = Property::where('status', 0)
    // ->whereIn('id', $userProperty->pluck('id'))
    // ->count();
               
                
                //propertiescountlastweek
                $PropertiesCountLastWeek = Property::where(['status'=> 1])->where('created_at', '>=', now()->subWeek())->count();
            
                //propertiescountlastmonth
                $PropertiesCountLastMonth = Property::where(['status'=> 1])->where('created_at', '>=', now()->subMonth())->count();
    
                //allbookincount
                $BookingsCount = Booking::where(['status'=>'confirm'])->count();
    
                //bookingcountlastweek
                $BookingsLastWeekCount = Booking::where(['status'=>'confirm'])->where('created_at', '>=', now()->subWeek())->count();
    
                //bookingcountlastmonth
                $BookingsLastMonthCount = Booking::where(['status'=>'confirm'])->where('created_at', '>=', now()->subMonth())->count();
    
                //allpartnerscount
                $PartnerCount = Partner::where(['status'=> 1])->count();
                
                //partnerscountlastweek
                $PartnerLastWeekCount = Partner::where(['status'=> 1])->where('created_at', '>=', now()->subWeek())->count();
                
                //allpartnerscountlastmonth
                $PartnerLastMonthCount = Partner::where(['status'=> 1])->where('created_at', '>=', now()->subMonth())->count();
    
                $propertytype = DB::table('property_types')
                ->leftJoin('properties', 'property_types.id', '=', 'properties.property_type_id')
                ->select('property_types.id', 'property_types.name', 'property_types.status', DB::raw('COUNT(properties.property_type_id) as property_count'),
                DB::raw('SUM(CASE WHEN properties.status = "1" THEN 1 ELSE 0 END) as active_properties'),
        DB::raw('SUM(CASE WHEN properties.status = "0" THEN 1 ELSE 0 END) as inactive_properties'))
                ->groupBy('property_types.id', 'property_types.name', 'property_types.status')
                ->get();
                
    //             $propertyTypes = DB::table('property_types')
    // ->leftJoin('properties', 'property_types.id', '=', 'properties.property_type_id')
    // ->select(
    //     'property_types.id', 
    //     'property_types.name', 
    //     'property_types.status', 
    //     DB::raw('COUNT(properties.property_type_id) as total_properties'),
    //     DB::raw('SUM(CASE WHEN properties.status = "1" THEN 1 ELSE 0 END) as active_properties'),
    //     DB::raw('SUM(CASE WHEN properties.status = "0" THEN 1 ELSE 0 END) as inactive_properties')
    // )
    // ->groupBy('property_types.id', 'property_types.name', 'property_types.status')
    // ->get();
             //dd($propertytype);
                //topproperties
                $topProperties = DB::table('bookings')
                ->join('properties', 'bookings.property_id', '=', 'properties.id')
                ->select('properties.id', 'properties.name', DB::raw('COUNT(bookings.id) as booking_count'))
                ->groupBy('properties.id', 'properties.name')
                ->orderByDesc('booking_count')
                ->limit(4) 
                ->get();
               
    
                //propertydetails
                $propertyDetails = Property::limit(5)->get(['name', 'status', 'address_1']);
                //  dd($propertyDetails);
    
                $bookingDetails = Booking::orderByDesc('created_at')->limit(10)->get();
                //  dd($bookingDetails);
    
                $income = ['AllIncome'=> $AllIncome, 'IncomeLastWeek'=> $IncomeLastWeek, 'IncomeLastMonth'=> $IncomeLastMonth ];
                $counts = ['BookingsCount'=>$BookingsCount, 'BookingsLastWeekCount'=>$BookingsLastWeekCount, 'BookingsLastMonthCount'=>$BookingsLastMonthCount, 'AllPropertiesCount'=> $AllPropertiesCount,'PropertiesCountLastWeek'=> $PropertiesCountLastWeek, 'PropertiesCountLastMonth'=> $PropertiesCountLastMonth, 'PartnerCount'=>$PartnerCount,'PartnerLastWeekCount'=>$PartnerLastWeekCount,'PartnerLastMonthCount'=>$PartnerLastMonthCount];
            
                return Inertia::render('Dashboard/Index', ['counts'=> $counts, 'income'=>$income, 'topProperties'=> $topProperties, 'propertyDetails'=>$propertyDetails, 'propertytype'=>$propertytype, 'bookingDetails'=>$bookingDetails]);
            }
           
        }
      
       
       
            
        

       
    
        

        

    }
}
