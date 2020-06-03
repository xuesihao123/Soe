<?php

namespace app\index\model\Theater;

use think\Model;
use think\Db;

class Theater extends Model
{
    public function theater_add($col,$row,$name)
    {
        $result = Db::name('theater')->insert(
            [
                'theater_colnum' => $col,
                'theater_rownum' => $row,
                'theater_Name' => $name
            ]
            );
        $r = Db::name('theater')->where('theater_Name',$name)->find();
        if($r)
        {
            if($this->theater_seat($r['theater_Id'],$col,$row))
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
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

    public function theater_seat($theaterId,$col,$row)//创建影厅的座位
    {
        // $add = Db::table('theater')->alias('t')
        //         ->join('performance p','t.theater_Id = p.theater_Id')
        //         ->where('theater_Id',$theaterId)
        //         ->field('t.theater_Colnum,t.theater_Rownum,p.performance_End')
        //         ->find();
                
                    $seat = array();
                    for($i = 1 ; $i <= $col ; $i++ )
                        for($j = 1 ; $j <= $row ; $j++ )
                        {
                            $a = ($i-1) * $row + $j - 1;
                            $seat["$a"]['theater_Id'] = $theaterId;
                            $seat["$a"]['seat_Col'] = $i;
                            $seat["$a"]['seat_Row'] = $j;
                            $seat["$a"]['seat_Status'] = 1;
                            $seat["$a"]['performance_Id'] = 0;
                            $seat["$a"]['performance_End'] = '2100-01-01';
                        }
                    $f = Db::name('seat')->insertAll($seat);
                    if($f)
                        return 1;
                    else{
                        Db::name('theater')->where('theater_Id',$r['theater_Id'])->delete();
                        return 0;
                    }
                }
        
                public function theater_update($Id,$name)
                {
                    $result = Db::name('theater')->where('theater_Id',$Id)->update(['theater_Name' => "$name"]);
                    if($result)
                        return 1;
                    else
                        return 0;
                }

                public function theater_shows($Id)
                {
                    $result = Db::name('seat')->where('theater_Id',$Id)->where('performance_Id',0)->select();
                    if($result)
                        return $result;
                    else
                        return 0;
                }
            
            
    }

