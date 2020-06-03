<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Seat\seat;

class Seatc extends Controller
{
    public function update()
    {
        $seatId = input('seat_Id');
        $status = input('seat_Status');
        $update = new seat();
        $json = array();
        $json['flag'] = $update->seat_update($seatId,$status);
        return json_encode($json);  
    }

    public function show()
    {
        $theaterId = input('theaterId');
        $performanceId = input('performanceId');

        $performanceId = 0;
        
        $show = new seat();
        $json = $show->seat_show($theaterId,$performanceId);
        return json_encode($json); 
    }
    
}