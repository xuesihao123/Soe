<?php

namespace app\index\model\Movie;

use think\Model;
use think\Db;

class Movie extends Model
{
    public function movie_add($name,$brief,$start,$end,$time,$type)
    { 
        $result = Db::name('movie')->insert(
            [
                'movie_Name' => "$name",
                'movie_Brief' => "$brief",
                'movie_Start' => "$start",
                'movie_End' => "$end",
                'movie_Time' => "$time",
                'movie_Type' => "$type",
                'movie_Cover' => ""
            ]
            );
        if($result)
            return 1;
        else
            return 0;
    }


    public function movie_update($id,$name,$brief,$start,$end,$time,$type,$cover)
    {
        $result = Db::name('movie')->where('movie_Id',$id)->update(
            [
                'movie_Name' => "$name",
                'movie_Brief' => "$brief",
                'movie_Start' => "$start",
                'movie_End' => "$end",
                'movie_Time' => "$time",
                'movie_Type' => "$type",
                'movie_Cover' => "$cover"
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

    public function movie_find($str)
    {
        if($str == '')
            return NUll;
        $strarr = $this->mb_str_split($str);
        $content = '%';
        foreach($strarr as $key => $value)
        {
            $content = $content.$value;
        }
        $content = $content.'%';
        $result = Db::name('movie')->where('movie_Name','like',$content)->select();
        return $result;
    }

    public function mb_str_split($str){
        return preg_split('/(?<!^)(?!$)/u', $str );
    }


}