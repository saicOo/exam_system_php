<?php
require_once "Connect.php";
class Traffic extends Connect{

public function show(){
        $show = "SELECT * FROM `traffic` WHERE id = 1";
        $row = $this->conn->query($show);
        return $row->fetch(PDO::FETCH_ASSOC);
}

public function increaseTraffic(){
    $cookie_name ="traffic";
        if(!isset($_COOKIE[$cookie_name])) {
            setcookie($cookie_name, "test", time() + (86400 * 7), "/");
            $updateTraffic = "UPDATE `traffic` SET `traffic_count`= (SELECT traffic_count FROM traffic WHERE `id` = 1) + 1 WHERE `id` = 1";
            $this->conn->exec($updateTraffic);
        }

    }
}