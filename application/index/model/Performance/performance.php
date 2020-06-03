<?php
    
namespace app\index\model\Performance;

use think\Model;
use think\Db;

class Performance extends Model
{
    public function performance_content($movieId)//返回movie的详细数据
   {
        $result =  Db::name('movie')
                ->where('movie_Id',$movieId)
                ->find();
        if($result)
            return $result;
        else    
            return NULL;
    }

    public function performance_show($date)//返回上架所有影片
    {
        $result = Db::name('movie')
                ->whereTime('movie_Start','<',"$date")
                ->whereTime('movie_End','>',"$date")
                ->select();
        if($result)
            return $result;
        else    
            return NULL;
    }

    public function performance_find($name)
    {
        $result = Db::name('movie')
                ->where('movie_Name','like','%'.$name.'%')
                ->select();
        return $result;
    }

    public function performance_hot()
    {
                
    }

    // public function performance_plan($movieId,$theaterId,$start,$time)//安排演出
    // {
    //     $end = date('Y-m-d H:i:s',strtotime($start)+strtotime($time));
    //     $query = new \think\db\Query;
    //     $data = $query->name('performance')->where(function($query)use($start) {
    //         $query ->whereTime('performance_Start','<',"$start")
    //                ->whereTime('performance_End','>',"$start");
    //     })->whereor(function($query)use($end) {
    //         $query->whereTime('performance_Start','<',"$end")
    //               ->whereTime('performance_End','>',"$end");
    //     })->select();
    //     if($data)
    //     {
    //         return 2;//时间重合
    //     }
    //     else
    //     {
    //         $result = Db::name('performance')->insert(
    //             [
    //                 'movie_Id' => $movieId,
    //                 'theater_Id' => $theaterId,
    //                 'performance_Start' => "$start",
    //                 'performance_End' => "$end"
    //             ]
    //             );
    //         if($result)
    //         {
    //             $add = Db::name('theater')->where('theater_Id',$theaterId)->find();
    //             if($add)
    //             {
    //                 $seat = array();
    //                 for($i = 1 ; $i <= $add['theater_colnum'] ; $i++ )
    //                     for($j = 1 ; $j <= $add['theater_rownum'] ; $j++ )
    //                     {
    //                         $a = ($i-1) * $add['theater_rownum'] + $j;
    //                         $seat["$a"]['theater_Id'] = $theaterId;
    //                         $seat["$a"]['seat_Col'] = $i;
    //                         $seat["$a"]['seat_Row'] = $j;
    //                         $seat["$a"]['seat_Status'] = 1;
    //                         $seat["$a"]['performance_Id'] = $performanceId;
    //                         $seat["$a"]['performance_End'] = $End;
    //                     }
    //                 $f = Db::name('seat')->insert($seat);
    //                 if($f)
    //                     return 1;
    //                 else
    //                     return 0;
    //             }
    //             else
    //                 return 3;//演出厅不存在
    //         }       
    //         else
    //             return 0;
    //     }
    // }

    public function performance_plan($movieId,$theaterId,$start,$time)//安排演出
    {
        $end = date('Y-m-d H:i:s',strtotime($start)+strtotime($time));
        echo $end;
        $query = new \think\db\Query;
        $data = $query->name('performance')->where(function($query)use($start) {
            $query ->whereTime('performance_Start','<',"$start")
                   ->whereTime('performance_End','>',"$start");
        })->whereor(function($query)use($end){
            $query->whereTime('performance_Start','<',"$end")
                  ->whereTime('performance_End','>',"$end");
        })->select();
        if($data)
        {
            return 2;//时间重合
        }
        else
        {
            $result = Db::name('performance')->insert(
                [
                    'movie_Id' => $movieId,
                    'theater_Id' => $theaterId,
                    'performance_Start' => "$start",
                    'performance_End' => "$end"
                ]
                );
            if($result)
            {
                // $add = Db::name('theater')->where('theater_Id',$theaterId)->find();
                $add = Db::name('performance')->alias('p')
                    ->join('theater,t','t.theater_Id = p.theater_Id')
                    ->where('theater_Id',$theaterId)
                    ->where('movie_Id',$movieId)
                    ->where('performance_Start',$start)
                    ->field('t.theater_colnum , t.theater_rownum , p.performance_Id')
                    ->find();
                if($add)
                {
                    $seat = array();
                    $col = $add['theater_colnum'];
                    $row = $add['theater_rownum'];
                    $num = $col * $row-1;
                    $performanceId = $add['performance_Id'];
                    $status = Db::name('seat')->where('theater_Id',$theaterId)
                                ->where('performacne_Id',0)
                                ->field('seat_Status')
                                ->select();
                    for($i = 1 ; $i <= $col ; $i++ )
                        for($j = 1 ; $j <= $row ; $j++ )
                        {
                            $a = ($i-1) * $row + $j -1;
                            $seat["$a"]['theater_Id'] = $theaterId;
                            $seat["$a"]['seat_Col'] = $i;
                            $seat["$a"]['seat_Row'] = $j;
                            $seat["$a"]['seat_Status'] = $status[$num-$a];
                            $seat["$a"]['performance_Id'] = $performanceId;
                            $seat["$a"]['performance_End'] = $End;
                        }
                    $f = Db::name('seat')->insertAll($seat);
                    if($f)
                        return 1;
                    else
                        return 0;
                }
                else
                    return 3;//演出厅不存在
            }       
            else
                return 0;
        }
    }

    public function performance_delete($performanceId)
    {
        $result = Db::name('performance')->where('performance_Id',$performanceId)->delete();
        if($result)
            return 1;
        else
            return 0;
    }

    public function performance_select($movieId,$theaterId)
    {
        $result = Db::name('performance')->where('movie_Id',$movieId)
                ->where('theater_Id',$theaterId)->select();
        return $result;
    }

    public function performance_pshow($date)
    {
        $result = Db::name('performance')->alias('p')
                ->join('theater t','p.theater_Id = t.theater_Id')
                ->join('movie m','m.movie_Id = p.movie_Id')
                ->whereTime('performance_Start','>',"$date")
                ->field('p.performance_Id,p.performance_Start,p.performance_End,p.movie_Id,p.theater_Id
                        ,m.movie_Name,t.theater_Name')
                ->select();
        return $result;
    }

}