<?php
$status=$_POST["status"];
$firstname=$_POST["firstname"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];

$salt="JEoXThKDZm"; // PLACE YOUR SALT KEY HERE

// Salt should be same Post Request
if(isset($_POST["additionalCharges"])){
  $additionalCharges=$_POST["additionalCharges"];
  $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
}else{
  $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
}

$hash = strtolower(hash('sha512', $retHashSeq)); // NOTE: THIS PART IN YOUR KIT MAY HAVE AN ERROR. THERE YOU MIGHT GET $hash_string instead of $retHashSeq. JUST REPLACE $hash_string with $retHashSeq.

if($hash != $posted_hash){
  // Transaction completed but is Invalid as Hash Values are not Matching. Notify Admin.
  //header('Location: fail.php');
  //exit();
}else{
  // Transaction is Valid. Process orders here.
  //header('Location: thanks.php');
  //exit();
}
?>
