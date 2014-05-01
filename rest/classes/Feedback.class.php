<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Christof
 * Date: 1/05/14
 * Time: 20:11
 * To change this template use File | Settings | File Templates.
 */

include_once "db.class.php";

class Feedback {

    private $score;
    private $feedback;
    private $show;

    public function getAllById($id)
    {

        $db = new db();
        $query ="SELECT * FROM feedback where restaurantid = $id AND rshow = 1 order by tijd;";
        return $db->conn->query($query);

}

    public function create($restid,$id)
    {

        $db = new db();
        $query = "INSERT INTO feedback(feedback,score,tijd,fshow,restaurantid,ownerid) values ('$this->feedback',$this->score,NOW(),$this->show,$restid,$id);";
        $db->conn->query($query);
    }

    public function getAllByScore($id,$nr)
    {

        $db = new db();
        if($nr ==1)
        {
        $query = "SELECT * FROM feedback where restaurantid = $id AND rshow = 1 AND score > 7 order by tijd;";
        }
        else
        {
            $query = "SELECT * FROM feedback where restaurantid = $id AND rshow = 1 AND score < 5 order by tijd;";
        }
        return $db->conn->query($query);
    }

    public function getByTime($id,$time)
    {

        $db = new db();
        if($time ==1)
        {
            $query = "SELECT * FROM feedback where restaurantid = $id AND rshow = 1 order by tijd;";
        }
        elseif($time==2)
        {
            $query = "SELECT * FROM feedback where restaurantid = $id AND rshow = 1 AND DATE(tijd) = CURDATE()-1  order by tijd;";
        }
        elseif($time==3)
        {
            $query = "SELECT * FROM feedback where restaurantid = $id AND rshow = 1 AND tijd >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
AND tijd < curdate() - INTERVAL DAYOFWEEK(curdate())-1 DAY  order by tijd;";
        }
        elseif($time==4)
        {
            $query = "SELECT * FROM feedback where restaurantid = $id AND rshow = 1 AND YEAR(tijd) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                        AND MONTH(tijd) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)  order by tijd;";
        }
        return $db->conn->query($query);

    }

    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }

    public function getFeedback()
    {
        return $this->feedback;
    }

    public function setScore($score)
    {
        $this->score = $score;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function setShow($show)
    {
        $this->show = $show;
    }

    public function getShow()
    {
        return $this->show;
    }


}