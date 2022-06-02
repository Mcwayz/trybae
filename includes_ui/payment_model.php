<?php
class model
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    //function that Adds Transactions to the database 

    public function addTransaction($txid, $event_id, $amountPaid, $email, $name, $tx_time)
    {
        $dbConn = $this->db->getConnection();
        $sql ="INSERT INTO `transactions`(`id`, `event_id`, `amount`, `email`, `name`, `tx_time`) 
        VALUES(:id, :event_id, :amount, :email, :u_name, :tx_time)";
        $query = $dbConn->prepare($sql);
        $query->bindParam(':id', $txid);
        $query->bindParam(':event_id', $event_id);
        $query->bindParam(':amount', $amountPaid);
        $query->bindParam(':email', $email);
        $query->bindParam(':u_name', $name);
        $query->bindParam(':tx_time', $tx_time);
        if($query->execute())
        {
            echo"<script>alert('Transaction Successful')</script>";
            session_destroy();
            header("Location: index.php");
        }
    }



}