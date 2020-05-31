<?php

namespace app\index\controller;

use think\controller;
use app\index\model\Seat\seat;

class Seatc extends controller
{
    public function update()
    {
        $seatId = input('seatId');
        $status = input('status');
        $update = new seat();
        $json = array();
        $json['flag'] = $update->seat_update($seatId,$status);
        return json_encode($json);  
    }

    public function show()
    {
        $theaterId = input('theaterId');
        $performanceId = input('performanceId');
        $show = new seat();
        $json = $show->seat_show($theaterId,$performanceId);
        return json_encode($json); 
    }
}