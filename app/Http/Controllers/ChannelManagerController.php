<?php

namespace App\Http\Controllers;

use App\Http\CustomHelpers;
use App\Models\Room;
use App\Services\Beds24Service\Beds24Service;
use Illuminate\Http\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class ChannelManagerController extends Controller
{
    private $helper;
    private $beds24Service;

    public function __construct()
    {
        $this->helper = new CustomHelpers();
        $this->beds24Service = new Beds24Service();
    }

    public function setAllotments($data) {
        $room = Room::where('id',$data['room_id'])->first();

        $cmRoomId = $room->channel_m_room_id;

        $period = $this->helper->getDateRange($data['from_date'], $data['to_date']);

        $qtyArray = [];
        foreach ($period as $date) {
            $day = $date->format('Ymd');
            $qtyArray[$day]=array(
                'i' => $data['qty'],
            );
        }
        // dd($qtyArray);

        $data = array(
            'authentication' =>array(
                'apiKey' => '2197477b-d0a1-4c4f-a100-5d242dd498cb',
                'propKey'=> $data['prop_key'],
            ),
            'roomId'	=>  $cmRoomId,
            'dates'     =>  $qtyArray
        );

        $this->beds24Service->setAllotments($data);


    }

    public static function cmLog($log_text)
    {
        $log_file_path = storage_path('logs/Beds24/cm.log');
        $log = [$log_text];
        $orderLog = new Logger("CHANNEL_MANAGER");
        $orderLog->pushHandler(new StreamHandler($log_file_path), Logger::INFO);
        $orderLog->info('Beds24Response', $log);
    }
}
