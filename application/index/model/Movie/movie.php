<?php

namespace app\index\model\Movie;

use think\Model;
use think\Db;

class Movie extends Model
{
    public function movie_add($name,$brief,$start,$end)
    { 
        $result = Db::name('movie')->insert(
            [
                'movie_Name' => "$name",
                'movie_Brief' => "$brief",
                'movie_Start' => "$start",
                'movie_End' => "$end"
            ]
            );
        if($result)
            return 1;
        else
            return 0;
    } 

    public function movie_updata($id,$name,$brief,$start,$end)
    {
        $result = Db::name('movie')->where('movie_Id',$id)->update(
            [
                'movie_Name' => "$name",
                'movie_Brief' => "$brief",
                'movie_Start' => "$start",
                'movie_End' => "$end"
            ]
            );
        if($result)
            return 1;
        else
            return 0; 
    }

    public function movie_delete($movieId)
    {
        $result = Db::name('movie')->where('movie_Id',$movieId)->delete();
        if($result)
            return 1;
        else
            return 0;  
    }

    public function movie_select()
    {
        $result = Db::name('movie')->select();
        return $result;
    }

}