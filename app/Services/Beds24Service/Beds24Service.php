<?php

namespace App\Services\Beds24Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class Beds24Service
{
    protected $apiUrl = 'https://api.beds24.com/json/';
    protected $apiKey = '0RH57PUM1PA9VYOA';

    public function setRate($data)
    {
        try {
            
            $auth = [
                'apiKey' => '2197477b-d0a1-4c4f-a100-5d242dd498ca',
                'propKey' => '4990911a-14e7-493e-9694-2a45f7ecf7be',
            ];
            $data = [
                    "authentication" => $auth,
                    "action"=> "new",
                    "roomId" => "460318",
                    // "roomId"=> $data['room_id'],
                    "name"=> $data['name'],
                    "firstNight"=> $data['from_date'],
                    "lastNight"=> $data['to_date'],
                    // "minNights"=> "1",
                    // "maxNights"=> "30",
                    //"minAdvance"=> "0",
                    //"maxAdvance"=> "365",
                    //"strategy"=> "0",
                    "roomPrice"=> $data['price'],
                    "roomPriceEnable"=> "1",
                    // "roomPriceGuests"=> "0",
                    // "1pPrice"=> "60.00",
                    // "1pPriceEnable"=> "1",
                   

            ];
            $json = json_encode($data);
            $url = "https://api.beds24.com/json/setRate";
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_POST, 1) ;
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            $result = curl_exec($ch);
            Log::info('Beds24Response: ' . print_r($result, true));
            curl_close ($ch);
            
          
        } catch (\Exception $e) {
           
            throw $e;
        }
    }
    public function createProperties($data)
    {
        try {
            $auth = [
                'apiKey' => '2197477b-d0a1-4c4f-a100-5d242dd498ca',
            ];
            $uuid = Str::uuid();
            $randomUniqueNumber = $uuid->toString();
            $createProperties = [
                [

                    'name' => $data['name'],
                    'propKey'=> $randomUniqueNumber, // randowm propKey
                    'propTypeId' => 28, // need check this
                   
                    
                ],
               
            ];
            
            $data = [
                'authentication' => $auth,
                'createProperties' => $createProperties,
            ];
            
            $json = json_encode($data);
            $url = 'https://api.beds24.com/json/createProperties';
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            
            $result = curl_exec($ch);
            Log::info('Beds24Response: ' . print_r($result, true));
            curl_close($ch);
            
        
        } catch (\Exception $e) {
           
            throw $e;
        }
    }
    public function getProperties()
    {
        try{
            $auth = [
                'apiKey' => '2197477b-d0a1-4c4f-a100-5d242dd498ca',
            ];
           
            $data = [
                'authentication' => $auth,
                
            ];
            
            $json = json_encode($data);
            $url = 'https://api.beds24.com/json/getProperties';
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
            
            $result = curl_exec($ch);
            Log::info('Beds24Response: ' . print_r($result, true));
            curl_close($ch);
        }catch(\Exception $e){
            throw $e;
        }
    }
    public function setBooking()
    {

    }
}
