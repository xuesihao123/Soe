<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Statistics\statistics;

class Statisticsc extends Controller
{
    public function show()
    {
        $show = new statistics();
        $json = $show->statistics_show();
        return json_encode($json);
    }

    public function select()
    {
        $movieId = input('movie_Id');
        $select = new statistics();
        $json = $select->statistics_select($movieId);
        return json_encode($json);
    }

}