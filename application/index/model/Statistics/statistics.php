<?php

namespace app\index\model\Statistics;

use think\Model;
use think\Db;

class statistics extends model{
    public function statistics_show()
    {
        $result = Db::name('statistics')->alias('s')
                ->join('movie m','s.movie_Id = m.movie_Id')
                ->field('m.movie_Name,s.statistics_Id,s.statistics_Num,s.statistics_Pnum,m.movie_Cover')
                ->select();
        return $result;
    }

    public function statistics_select($movieId)
    {
        $result = Db::name('statistics')->alias('s')
                ->join('movie m','s.movie_Id = m.movie_Id')
                ->where('movie_Id',$movieId)
                ->field('m.movie_Name,s.statistics_Id,s.statistics_Num,s.statistics_Pnum')
                ->find();
        return $result;
    }
}