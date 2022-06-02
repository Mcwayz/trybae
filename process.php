<?php
session_start();
require_once "includes_ui/database.php";
require_once "includes_ui/payment_model.php";
$model = new model();
if(isset($_GET['status']))
    {
        //* check payment status
        if($_GET['status'] == 'cancelled')
        {
            echo"<script>alert('Transaction Cancelled')</script>";
            header('Location: index.php');
        }
        elseif($_GET['status'] == 'successful')
        {
            $txid = $_GET['transaction_id'];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                  "Content-Type: application/json",
                  "Authorization: Bearer FLWSECK_TEST-eee25be1b44ef9a132a872075b3a0910-X"
                ),
              ));
              
              $response = curl_exec($curl);
              
              curl_close($curl);
              
              $res = json_decode($response);
              if($res->status)
              {
                    echo 'Payment successful';
                    //* Continue to give item to the user
                    $email = $_SESSION['email'];
                    $name = $_SESSION['name'];
                    $event_id = $_SESSION['event_id'];
                    $amount = $_SESSION['amount'];
                    $tx_time = date('Y-m-d H:i:s');
                    $model->addTransaction($txid, $event_id, $amount, $email, $name, $tx_time);
              }
              else
              {
                echo"<script>alert('Transaction Failed')</script>";
              }
        }
    }
?>