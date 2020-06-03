<?php

namespace app\index\model\Seat;

use think\Model;
use think\Db;

class Seat extends Model
{
    public function seat_update($seatId,$status)
    {
        if($status == 1)
            $status = 2;
        elseif($status == 2)
            $status = 1;
        $result = Db::name('seat')->where('seat_Id',$seatId)->update(['seat_Status' => $status]);
        if($result)
            return 1;
        else
            return 0;        
    }

    
    public function seat_show($theaterId,$performanceId)
    {
        $result = Db::name('seat')->where('theater_Id',$theaterId)->where('performance_Id',$performanceId)
            ->select();
        return $result;
    }
}