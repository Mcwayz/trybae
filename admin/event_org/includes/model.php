<?php
class model
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    //function that registers users 
    

    public function registerUser($username, $first_name, $surname, $email, $pass)
    {   $role = "User";
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO `user_tbl` (`username`, `first_name`, `surname`, `email_address`, 
        `usr_password`, `usr_role) VALUES (:username, :fname, :surname, :email, :usr_pass, :usr_role)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':username', $username);
        $query->bindParam(':fname', $first_name);
        $query->bindParam(':surname', $surname);
        $query->bindParam(':email', $email);
        $query->bindParam(':usr_pass', $pass);
        $query->bindParam(':usr_role', $role);
        if($query->execute())
        {
            echo"<script>window.location.href = 'login.php'</script>";
        }
    }



        //Function that gets all events


    public function getAllEvents($id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT events.id, events.event_name, events.city_id, events.user_id, cities.city,
        events.start_time, events.end_time, users.username, events.vip, events.ordinary, events.published
        FROM  events INNER JOIN users ON users.id = events.user_id
        INNER JOIN cities ON cities.id = events.city_id
        WHERE events.user_id = :id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query;
    }

    //Function that logs in users


    public function login($email, $pass)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$pass' LIMIT 1";
        $query = $dbConn->query($sql);
        if ($query->rowCount() > 0) 
        {
           $result = $query->fetch(PDO::FETCH_ASSOC);
           $_SESSION['id'] = $result['id'];
           $_SESSION['email'] = $result['email'];
           $_SESSION['name'] = $result['username'];
           $_SESSION['role'] = $result['role'];
           $_SESSION['user_pass'] = $result['password'];
           $role = $result['role'];
           if($role == "Admin")
           {
                echo"<script>alert('Login Successful');</script>";
                header("Location: ../try_bae/index.php");
           }
           elseif($role == "eventOrg")
           {
                echo"<script>alert('Login Successful');</script>";
                header("Location: ../event_org/index.php");
           }
          
        } 
        else 
        {
            echo "<script>alert('Invalid Username / Password Error');</script>";
        }
    }


    // Function That Gets All The Equipment


    public function getEquipment()
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `equipment_tbl`";
        return $dbConn->query($sql);
    }


    // Function That Searches for Equipment


    public function searchProduct($search)
    {
        $dbConn = $this->db->getConnection();
        $sql = "SELECT * FROM `equipment_tbl` LIKE %'$search'%";
        return $dbConn->query($sql);
    }


    // Function that adds  Equipment


    public function addEquipment($e_name, $e_type, $pic, $e_price, $e_plan)
    {
        $dbConn = $this->db->getConnection();
        $sql = "INSERT INTO `equipment_tbl`(`equipment_name`, 
        `equipment_type`, `pic_location`, `e_price`, `p_plan`) VALUES (
        :e_name, :e_type, :p_location, :e_price, :e_plan)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':e_name', $e_name);
        $query->bindParam(':e_type', $e_type);
        $query->bindParam(':p_location', $pic);
        $query->bindParam(':e_price', $e_price);
        $query->bindParam(':e_plan', $e_plan);
        if($query->execute())
        {
            echo"<script>alert('Equipment Added Successfully')</script>";
            echo"<script>window.location.href = 'products.php'</script>";
        }

    }

    

    // Function That Deletes Equipment


    public function deleteEquipment($id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="DELETE FROM `equipment_tbl` WHERE equipment_id=:e_id";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':e_id', $e_id);
        if($query->execute())
        {
            echo"<script>alert('Equipment Deleted Successfully')</script>";
            echo"<script>window.location.href = 'products.php'</script>";
        }
    }


    // Function That Adds To Cart


    public function addCart($e_id, $user_id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="INSERT INTO `cart_tbl`(`equipment_id`, `user_id`) 
        VALUES(:e_id, :u_id)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':e_id', $e_id);
        $query->bindParam(':u_id', $e_id);
        if($query->execute())
        {
            echo"<script>alert('Equipment Added Successfully')</script>";
            echo"<script>window.location.href = 'products.php'</script>";
        }
    }


    // Function That Deletes From Cart


    public function removeCart($p_id)
    {
            $dbConn = $this->db->getConnection();
            $sql ="DELETE FROM `cart_tbl` WHERE `P_id`=:p_id";
            $query = $dbConn->prepare($sql);
            $query->bindParam(':p_id', $p_id);
            if($query->execute())
            {
                echo"<script>alert('Equipment Removed Successfully')</script>";
                echo"<script>window.location.href = 'products.php'</script>";
            }
    }


    // Function that gets all orders

    public function getOrders()
    {
        $dbConn = $this->db->getConnection();
        $sql ="SELECT cart_tbl.P_id, equipment_tbl.equipment_name, equipment_tbl.e_price, 
        user_tbl.first_name, user_tbl.surname
        FROM cart_tbl
        INNER JOIN user_tbl ON user_tbl.user_id = cart_tbl.user_id
        INNER JOIN equipment_tbl ON equipment_tbl.equipment_id = cart_tbl.equipment_id";
        return $dbConn->query($sql);
    }



        // Function that gets all cities


        public function getCities()
        {
            $dbConn = $this->db->getConnection();
            $sql ="SELECT * FROM cities";
            return $dbConn->query($sql);
        }
    
    
        // Function that gets all Age Groups
    
        public function getAgeGroups()
        {
            $dbConn = $this->db->getConnection();
            $sql ="SELECT * FROM Age";
            return $dbConn->query($sql);
        }
    
    
// Function that creates new Events

    public function createEvent($event_name, $limits, $published, $address, 
    $start_time, $end_time, $vip, $ordinary, $img, $add_info,  $age_id, $city_id, $user_id)
    {
        $dbConn = $this->db->getConnection();
        $sql ="INSERT INTO `events`(`event_name`, `attendance_limit`, `published`, `address`,
        `start_time`, `end_time`, `vip`, `ordinary`, `images`, `add_info`, `age_id`, `city_id`,
        `user_id`) VALUES(:event_name, :limits, :published, :addres, :start_time, :end_time, :vip, :ordinary, 
        :img_location, :add_info, :age_id, :city_id, :user_id)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':event_name', $event_name);
        $query->bindParam(':limits', $limits);
        $query->bindParam(':published', $published);
        $query->bindParam(':addres', $address);
        $query->bindParam(':start_time', $start_time);
        $query->bindParam(':end_time', $end_time);
        $query->bindParam(':vip', $vip);
        $query->bindParam(':ordinary', $ordinary);
        $query->bindParam(':img_location', $img);
        $query->bindParam(':add_info', $add_info);
        $query->bindParam(':age_id', $age_id);
        $query->bindParam(':city_id', $city_id);
        $query->bindParam(':user_id', $user_id);
        if($query->execute())
        {
            echo"<script>alert('Event Added Successfully')</script>";
            header("Location: ../event_org/view-events.php");
        }else{
            echo"<script>alert('Event Not Added')</script>";
            echo"<script>window.location.href = 'add-events.php'</script>";
        }
    }



}