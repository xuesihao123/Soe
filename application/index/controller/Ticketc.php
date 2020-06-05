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
        $userId = input('userId');
        $movie_Id = input('movieId');
        $price = input('price');
        $seatId = input('seatId');
        $buy = new Ticket();
        $json = array();
        $json['flag'] = $buy->ticket_buy($userId,$performanceId,$seatId,$movie_Id,$price);
        return json_encode($json);
    }


    public function abandon()
    {
        $order_Id = input('order_Id');
        // $userId = Cache::get('Id');      
        $seatId = input('seat_Id');
        $movie_Id = input('movie_Id');
        $price = input('movie_Price');
        $buy = new Ticket();
        $json = array();
        $json['flag'] = $buy->ticket_abandon($order_Id,$seatId,$movie_Id,$price);
        return json_encode($json);
    }




    public function show()
    {
        // $userId = Cache::get('Id');
        $userId = input('user_Id');
        $show = new Ticket();
        $json = $show->ticket_show($userId);
        return json_encode($json);
    }
}