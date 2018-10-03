<html>
<body>
<?php
/**
 * Created by Tapan Kumar.
 * User: Tapan Kumar
 * Date: 03-09-2018
 * Time: 11:27
 */

/**************

Below is the test card details for doing a test transaction in the testing mode.

Card No - 4012001037141112
Expiry - 05/20
CVV - 123

****************/

/***************** NECESSARY FIELDS GOES HERE ***********************/
$key=$_POST["key"]; //posted merchant key from client
$salt="JEoXThKDZm"; // add salt here from your credentials in payUMoney dashboard
$txnId=$_POST["txnid"]; //posted txnid from client
$amount=$_POST["amount"]; //posted amount from client 
$productName=$_POST["productInfo"]; // posted product info from client
$firstName=$_POST["firstName"]; // posted firstname from and must be without space
$email=$_POST["email"]; // posted email from client

/***************** USER DEFINED VARIABLES GOES HERE ***********************/
//all varibles posted from client
$udf1=$_POST["udf1"];
$udf2=$_POST["udf2"];
$udf3=$_POST["udf3"];
$udf4=$_POST["udf4"];
$udf5=$_POST["udf5"];

/***************** DO NOT EDIT ***********************/
$payhash_str = $key . '|' . checkNull($txnId) . '|' .checkNull($amount)  . '|' .checkNull($productName)  . '|' . checkNull($firstName) . '|' . checkNull($email) . '|' . checkNull($udf1) . '|' . checkNull($udf2) . '|' . checkNull($udf3) . '|' . checkNull($udf4) . '|' . checkNull($udf5) . '||||||'. $salt;

function checkNull($value) {
            if ($value == null) {
                  return '';
            } else {
                  return $value;
            }
      }
$hash = strtolower(hash('sha512', $payhash_str));
/***************** DO NOT EDIT ***********************/

$arr['result'] = $hash;
$arr['status']=0;
$arr['errorCode']=null;
$arr['responseCode']=null;
$output=$arr;
echo json_encode($output);
?>
</body>
 </html>
