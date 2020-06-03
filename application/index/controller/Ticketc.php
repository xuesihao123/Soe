<?php
    
namespace app\index\controller;

use think\Controller;
use app\index\model\Ticket\ticket;
use think\Cache;

class Ticketc extends Controller
{
    public function buy()
    {
        $performanceId = input('performanceId');
        $userId = Cache::get('Id');
        $seatId = input('seatId');
        $buy = new Ticket();
        $json = array();
        $json['flag'] = $buy->ticket_buy($userId,$performanceId,$seatId);
        return json_encode($json);
    }

    public function abandon()
    {
        $performanceId = input('performanceId');
        $userId = Cache::get('Id');      
        $seatId = input('seatId');
        $buy = new Ticket();
        $json = array();
        $json['flag'] = $buy->ticket_abandon($userId,$performanceId,$seatId);
        return json_encode($json);
    }

    public function show()
    {
        $userId = Cache::get('Id');
        $show = new Ticket();
        $json = $show->ticket_show($userId);
        return json_encode($json);
    }
}