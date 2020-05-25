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
        $result = Db::name('performance')
                ->whereTime('performance_Start','<',"$date")
                ->whereTime('performance_End','>',"$date")
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

    public function performance_plan($movieId,$theaterId,$start,$time)//安排演出
    {
        $end = data('Y-m-d H:i:s',strtotime($start)+strtotime($time));
        $query = new think\db\Query();
        $data = $query->table('performance')->where(function($query) {
            $query ->whereTime('performance_Start','<',"$start")
                   ->whereTime('performance_End','>',"$start");
        })->whereor(function($query){
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
                    'performance_End' => "$End"
                ]
                );
            if($result)
            {
                $add = Db::name('theat')->where('theater_Id',$theaterId)->find();
                if($add)
                {
                    $seat = array();
                    for($i = 1 ; $i <= $add['theater_Colnum'] ; $i++ )
                        for($j = 1 ; $j <= $add['theater_Rownum'] ; $j++ )
                        {
                            $a = ($i-1) * $add['theater_Rownum'] + $j;
                            $seat["$a"]['theater_Id'] = $theaterId;
                            $seat["$a"]['seat_Col'] = $i;
                            $seat["$a"]['seat_Row'] = $j;
                            $seat["$a"]['seat_Status'] = 1;
                            $seat["$a"]['performance_Id'] = $performanceId;
                            $seat["$a"]['performance_End'] = $End;
                        }
                    $f = Db::name('seat')->insert($seat);
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
}