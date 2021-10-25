<?php


function sendFEM(){
	 $url = 'https://fcm.googleapis.com/fcm/send';
	 $apiKey = "AAAAhwmc_58:APA91bFdN53SXsk-0pIp8mg26kjU2bMI980cSCIiCjJYnX5C5S7RMOT7vYPmcXD3rrMsN3vOOLzYObMA04ZL0JyyDx7IKRRtEQmoMnipdFrG93P2w1c3Kk3rutCsfJSPbaMnsU4dz0oF";
	 $to="ePXt4JUbRHGDCoGjM0q4iU:APA91bFXNwCkM-yNrfG6Exy8BglA3GJbLZ9OeqyYI9DOGqJBqD43liw3AxmJadiqGXQu06P_buz-BeKDcRvg3nBn6f4gyCSRl1faYh_vEfdKi6O8lRp8M6yPch39q5BY71DYy0u_jWpU";

	$headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$apiKey
    );
	
	
	$notifData = [
		'title' => "Test Title",
		'body' => "Test notification body",
		//  "image": "url-to-image",//Optional
		'click_action' => "activities.NotifHandlerActivity"
	];
	
	
	$dataPayload = ['to'=> 'My Name', 
	  'points'=>80, 
	  'other_data' => 'This is extra payload'
	];

	// Create the api body
	$apiBody = [
		'notification' => $notifData,
		'data' => $dataPayload,
		'time_to_live' => 600,
		'to' => $to
	];

	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_POST, true);
	curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, json_encode($apiBody));

	$result = curl_exec($ch);
	print($result);
	curl_close($ch);

	return $result;
}
print_r(sendFEM());

?>