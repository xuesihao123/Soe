<?php

namespace app\index\model\Theater;

use think\Model;
use think\Db;

class Theater extends Model
{
    public function theater_add($col,$row)
    {
        $result = Db::name('theater')->insert(
            [
                'theater_colnum' => $col,
                'theater_rownum' => $row
            ]
            );
        if($result)
            return 1;
        else
            return 0;
    }

    public function theater_delete($theaterId)
    {
        $result = Db::name('theater')->where('theater_Id',$theaterId)->delete();
        if($result)
            return 1;
        else
            return 0;
    }

    public function theater_show()
    {
        $result = Db::name('theater')->select();
        return $result;
    }

    public function thrater_seat($theaterId)
    {
        $add = Db::table('theat')->alias('t')
                ->join('performance p','t.theater_Id = p.theater_Id')
                ->where('theater_Id',$theaterId)
                ->field('t.theater_Colnum,t.theater_Rownum,p.performance_End')
                ->find();
                if($add)
                {
                    $seat = array();
                    for($i = 1 ; $i <= $add['theater_Colnum'] ; $i++ )
                        for($j = 1 ; $j <= $add['theater_Rownum'] ; $j++ )
                        {
                            $a = ($i-1) * $add['theater_rownum'] + $j;
                            $seat["$a"]['theater_Id'] = $theaterId;
                            $seat["$a"]['seat_Col'] = $i;
                            $seat["$a"]['seat_Row'] = $j;
                            $seat["$a"]['seat_Status'] = 1;
                            $seat["$a"]['performance_Id'] = 0;
                            $seat["$a"]['performance_End'] = $add['performance_End'];
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
}