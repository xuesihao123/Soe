<?php
    
namespace app\index\model\Ticket;

use think\Model;
use think\Db;

class Ticket extends Model
{
    public function ticket_buy($userId,$performanceId)
    {
        $result = Db::name('order')->insert(
            ['performance_Id' => $performanceId,
             'user_Id' => $userId]
        );
        if($result)
            return 1;
        else
            return 0;
    }

    public function ticket_abandon($userId,$performanceId)
    {
        $result = Db::name('order')
                ->where('user_Id',$userId)
                ->where('performance_Id',$performanceId)
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