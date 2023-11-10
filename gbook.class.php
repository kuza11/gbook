<?php 

class gbook{
  public $conn;
    /**
     * Konstruktor se připojí k DB
     */
    public function __construct()
    {
        include "db.php";
        $dsn = "mysql:host=localhost;dbname=$dbname;port=3336";
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        try
        {
            $this->conn = new PDO($dsn, $user, $pass, $options);
        }
        catch(PDOException $e)
        {
            $file = fopen("err.log", "w");
            fprintf($file, "Connection failed: %s\n", $e->getMessage());
        }
    }
    public function writeWisit ($ip, $iplocal, $date, $browser, $system)    //chybí-li parametr, dosadí 2
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO `logs` (`ip`, `ip_local`, `date`, `browser`, `system`) VALUES (:ip, :iplocal, :date, :browser, :system);");
            $stmt->bindParam(':ip', $ip);
            $stmt->bindParam(':iplocal', $iplocal);
            $stmt->bindParam(':date', $date);  
            $stmt->bindParam(':browser', $browser);
            $stmt->bindParam(':system', $system);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $file = fopen("err.log", "w");
            fprintf($file, "Connection failed table kraj: %s\n", $e->getMessage());
            return false;
        }
    }
    public function navstevnost ()   
       {
        try {
            $stmt = $this->conn->prepare("SELECT COUNT(DISTINCT date, ip) as udn, COUNT(DISTINCT ip) as un, COUNT(ip) as n FROM logs; ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ)[0];
        } catch (PDOException $e) {
            $file = fopen("err.log", "w");
            fprintf($file, "Connection failed\n", $e->getMessage());
            return false;
        }
    }
    public function writePost($name, $email, $message, $date, $ip)    //chybí-li parametr, dosadí 2
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO `posts` (`name`, `email`, `text`, `ip`, `date`) VALUES (:name, :email, :text, :ip, :date); ");
            $stmt->bindParam(':ip', $ip);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':date', $date);  
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':text', $message);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            $file = fopen("err.log", "w");
            fprintf($file, "Connection failed table posts: %s\n", $e->getMessage());
            return false;
        }
    }
    public function getPosts()   
    {
     try {
         $stmt = $this->conn->prepare("SELECT * FROM `posts` ORDER BY `posts`.`id` DESC ");
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_OBJ);
     } catch (PDOException $e) {
         $file = fopen("err.log", "w");
         fprintf($file, "Connection failed\n", $e->getMessage());
         return false;
     }
 }

}


//SELECT COUNT(DISTINCT date, ip) as udn, COUNT(DISTINCT ip) as un, COUNT(ip) as n FROM logs; 
?>