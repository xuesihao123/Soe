<?php
    
namespace app\index\model\Ticket;

use think\Model;
use think\Db;

class Ticket extends Model
{
    public function ticket_buy($userId,$performanceId,$seatId)
    {
        $result = Db::name('order')->insert(
            [
            'order_Id' => 1,
            'performance_Id' => $performanceId,
            'user_Id' => $userId,
            'seat_Id'=> $seatId
             ]
        );
        if($result)
        {
            $result = Db::name('order')->where('performance_Id',$performanceId)
            ->where('user_Id',$userId)->where('seat_Id',$seatId)->find();
             return $result;
        } 
        else
            return 0;
    }

    public function ticket_abandon($userId,$performanceId,$seatId)
    {
        $result = Db::name('order')
                ->where('user_Id',$userId)
                ->where('performance_Id',$performanceId)
                ->where('seat_Id',$seatId)
                ->delete();
        if($result)
            return 1;
        else
            return 0;        
    }

    public function ticket_show($userId)
    {
        $result = Db::name('order')
        ->where('user_Id',$userId)
        ->select();
        if($result)
            return $result;
        else    
            return NULL;
    }
}