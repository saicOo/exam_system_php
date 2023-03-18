<?php
class Connect{
    private $host = "localhost";
    private $db ="exam_system_online_v3";
    private $user ="root";
    private $pass ="";
    public $conn;
    function __construct(){
            try {
                $this->conn = new PDO ("mysql:host=".$this->host.";dbname=".$this->db."","$this->user",$this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                $this->conn = null;
                exit;
            }
        
    }

}