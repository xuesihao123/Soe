<?php
    
namespace app\index\model\Ticket;

use think\Model;
use think\Db;

class Ticket extends Model
{
    public function ticket_buy($userId,$performanceId,$seatId,$movie_Id,$price)
    {
        $p = (float)$price;
        $result = Db::name('order')->insert(
            [
            'performance_Id' => $performanceId,
            'user_Id' => $userId,
            'seat_Id'=> $seatId
             ]
        );
        if($result)
        {
            $result = Db::name('seat')->where('seat_Id',$seatId)->update(['seat_Status' => 2 ]);

            $result = Db::name('statistics')->where('movie_Id',$movie_Id)->find();
            if($result)
            {   
                $p = $p+$result['statistics_Pnum'];
                $num = $result['statistics_Num']+1;
                $result = Db::name('statistics')->where('movie_Id',$movie_Id)
                ->update(
                    [
                        'statistics_Num' => $num,
                        'statistics_Pnum' => $p
                    ]
                    );
            }
            else
            {
                $result = Db::name('statistics')->insert(
                    [
                        'movie_Id' => $movie_Id,
                        'statistics_Num' => 1,
                        'statistics_Pnum' => $price
                    ]);
            }

                $result = Db::name('order')->alias('o')
                ->join('seat s','s.seat_Id = o.seat_Id')
                ->join('performance p','p.performance_Id = o.performance_Id')
                ->where('p.performance_Id',$performanceId)
                ->where('user_Id',$userId)
                ->where('s.seat_Id',$seatId)
                ->field('o.seat_Id,s.seat_Col,seat_Row,p.performance_Start,o.order_Id')
                ->find();
                return $result;
        } 
        else
            return 0;
    }

    public function ticket_abandon($order_Id,$seatId,$movie_Id,$price)
    {
         $p = (float)$price;
        $result = Db::name('order')
                ->where('order_Id',$order_Id)
                ->delete();
        if($result)
        {
            $p = $p+$result['statistics_Pnum'];
            $num = $result['statistics_Num']+1;
            $result = Db::name('statistics')->where('movie_Id',$movie_Id)
            ->update(
                [
                    'statistics_Num' => $num,
                    'statistics_Pnum' => $p
                ]
                );

            $result = Db::name('seat')->where('seat_Id',$seatId)->update(['seat_Status' => 1 ]);
            return 1;
        }    
        else
            return 0;        
    }

    public function ticket_show($userId)
    {
        $result = Db::name('order')->alias('o')
            ->join('seat s','s.seat_Id = o.seat_Id')
            ->join('performance p','p.performance_Id = o.performance_Id')
            ->join('movie m','p.movie_Id = m.movie_Id')
            ->join('theater t','t.theater_Id = p.theater_Id')
            ->where('user_Id',$userId)
            ->field('o.seat_Id,s.seat_Col,seat_Row,p.performance_Start,o.order_Id,movie_Name,theater_Name,p.movie_Price,m.movie_Id')
            ->select();
        return $result;
    }

}