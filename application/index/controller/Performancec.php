<?php
    
namespace app\index\controller;

use think\Controller;
use app\index\model\Performance\performance;

class Performancec extends Controller
{
    public function content()
    {
        $movieId = $_POST['movieId'];
        $per = new Performance();
        $json = $per->performance_content($movieId);
        if($json == NULL)
            return NULL;
        else
            return json_encode($json);

    }

    public function show()
    {
        $date = date("Y-m-d H:i:s");
        $per = new Performance();
        $json = $per->performance_show($date);
        if($json == NULL)
            return NULL;
        else
            return json_encode($json);
    }

    public function find()
    {
        $name = $_POST['name'];
        $find = new performacne();
        $json = $find->performance_find($name);
        return json_encode($json);
    }
    
    public function will()//展示最近三天会播出的电影
    {
        $date = date("Y-m-d H:i:s",strtotime("+3 day"));
        $per = new Performance();
        $json = $per->performance_show($date);
        if($json == NULL)
            return NULL;
        else
            return json_encode($json);
    }

    public function hot()
    {
        
    }

    public function plan()//安排演出 要处理时间上的冲突
    {
        $movieId = $_POST['movieId'];
        $theaterId = $_POST['theaterId'];
        $start = $_POST['start'];
        $time = $_POST['time'];
        $plan = new performance();
        $json = array();
        $json['flag'] = $plan->performance_plan($movieId,$theaterId,$start,$time);
        return json_encode($json);
    }

    public function delete()
    {
        $performanceId = $_POST['performanceId'];
        $delete = new performance();
        $json = array();
        $json['flag'] = $delete->performance_delete($performanceId);
        return json_encode($json);
    }
}