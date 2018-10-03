<?php

function getHashes($txnid, $amount, $productinfo, $firstname, $email, $user_credentials, $udf1, $udf2, $udf3, $udf4, $udf5,$cardBin)
{
      // $firstname, $email can be "", i.e empty string if needed. Same should be sent to PayU server (in request params) also.
      $key = 'uWnwLgWB';
      $salt = 'JEoXThKDZm';

      $payhash_str = $key . '|' . checkNull($txnid) . '|' .checkNull($amount)  . '|' .checkNull($productinfo)  . '|' . checkNull($firstname) . '|' . checkNull($email) . '|' . checkNull($udf1) . '|' . checkNull($udf2) . '|' . checkNull($udf3) . '|' . checkNull($udf4) . '|' . checkNull($udf5) . '||||||' . $salt;
      $paymentHash = strtolower(hash('sha512', $payhash_str));
      $arr['payment_hash'] = $paymentHash;

      $cmnNameMerchantCodes = 'get_merchant_ibibo_codes';
      $merchantCodesHash_str = $key . '|' . $cmnNameMerchantCodes . '|default|' . $salt ;
      $merchantCodesHash = strtolower(hash('sha512', $merchantCodesHash_str));
      $arr['get_merchant_ibibo_codes_hash'] = $merchantCodesHash;

      $cmnMobileSdk = 'vas_for_mobile_sdk';
      $mobileSdk_str = $key . '|' . $cmnMobileSdk . '|default|' . $salt;
      $mobileSdk = strtolower(hash('sha512', $mobileSdk_str));
      $arr['vas_for_mobile_sdk_hash'] = $mobileSdk;



      $cmnPaymentRelatedDetailsForMobileSdk1 = 'payment_related_details_for_mobile_sdk';
      $detailsForMobileSdk_str1 = $key  . '|' . $cmnPaymentRelatedDetailsForMobileSdk1 . '|default|' . $salt ;
      $detailsForMobileSdk1 = strtolower(hash('sha512', $detailsForMobileSdk_str1));
      $arr['payment_related_details_for_mobile_sdk_hash'] = $detailsForMobileSdk1;

      //used for verifying payment(optional)
      $cmnVerifyPayment = 'verify_payment';
      $verifyPayment_str = $key . '|' . $cmnVerifyPayment . '|'.$txnid .'|' . $salt;
      $verifyPayment = strtolower(hash('sha512', $verifyPayment_str));
      $arr['verify_payment_hash'] = $verifyPayment;
    return $arr;
}

function checkNull($value) {
            if ($value == null) {
                  return '';
            } else {
                  return $value;
            }
      }

$output=getHashes($_POST["txnid"], $_POST["amount"], $_POST["productinfo"], $_POST["firstname"], $_POST["email"], $_POST["user_credentials"], $_POST["udf1"], $_POST["udf2"], $_POST["udf3"], $_POST["udf4"], $_POST["udf5"],$_POST["offerKey"],$_POST["cardBin"]);

echo json_encode($output);

?>
