<?php
function push_notification_android($device_id,$title,$message){

    //API URL of FCM
    $url = 'https://fcm.googleapis.com/fcm/send';


	$api_key = 'AAAAhwmc_58:APA91bFWWLy1qYhoiO00ECF8RJH1-nqpoIit3pRTEAdju37hCFxz-rxolsvV1xYRWXz2kwNKetH9EKPNR2TAKTf2WS-fcFkdbOxICxnwxNv3Fk7ED_o20JPJDYXJ29X7mhc7_zZ3w3RM';
                
    $fields = array (
        'registration_ids' => array (
                $device_id
        ),
        'data' => array (
				"title"=>$title,
                "message" => $message,
				"image" =>  "https://static.vecteezy.com/system/resources/thumbnails/000/382/288/small/ZZZZZ2729.jpg",
				'click_action' => "MyCardItem"
        )
    );

    //header includes Content type and api key
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$api_key
    );
                
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;	
}
$to="e12YGJ_gTT-cHN_MEuJeyM:APA91bEpOk59JMTZLQohaeEIOwPiX1QBo6oTeu8aVRoB1-Z4ZNIfclay9kh8bT-wyvwXieEFUKOwd5wb-d8vSTVs50EeIGE6KXWCz7jeQ6tUxQ_v2TfWvJ3W-Tu48doyFtgiS_CziDZ8";
$data="In this video we ll learn how we can send notifications to Android or other device using PHP.We use Firebase for sending notifications.In this video we'll learn how we can send notifications to Android or other device using PHP. We use Firebase for sending notifications. We use Firebase for sending notifications..In this video we'll learn how we can send notifications to Android or other device using PHP. We use Firebase for sending notifications.";
$title='😎Mega Offer😊';
print_r(push_notification_android($to,$title,$data));
?>
