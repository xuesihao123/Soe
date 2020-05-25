<?php
    
namespace app\index\controller;

use think\Controller;
use app\index\model\Ticket\ticket;

class Ticketc extends Controller
{
    public function buy()
    {
        $performanceId = $_POST['performanceId'];
        $userId = $_SESSION['user_Id'];
        $buy = new Ticket();
        $json = array();
        $json['flag'] = $buy->ticket_buy($userId,$performanceId);
        return json_encode($json);
    }

    public function abandon()
    {
        $performanceId = $_POST['performanceId'];
        $userId = $_SESSION['user_Id'];
        $buy = new Ticket();
        $json = array();
        $json['flag'] = $buy->ticket_abandon($userId,$performanceId);
        return json_encode($json);
    }

    public function show()
    {
        $userId = $_SESSION['user_Id'];
        $show = new Ticket();
        $json = $show->ticket_show($userId);
        return json_encode($json);
    }
}