<?php
//error_reporting(0);

include "../Connection.php";

$p_User= "";
$curs = oci_new_cursor($conn);

$REG = oci_parse($conn, 
"begin DPG_MED_ADD_TO_CART.DPD_CUST_MESSAGE
(:Cur_Data,:p_User);end;");

oci_bind_by_name($REG, ":Cur_Data", $curs, -1, OCI_B_CURSOR);
oci_bind_by_name($REG, ":p_User", $p_User, -1, SQLT_CHR);



oci_execute($REG);
oci_execute($curs);
while (($row = oci_fetch_array($curs, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {

	if(isset($row["DEVICE_ID"])){
		
		$val = htmlentities($row["DEVICE_ID"]);
		$row["DEVICE_ID"]= $val;
	}
	
	push_notification_android($row["DEVICE_ID"],$row["MESSAGE_TITLE"],$row["MESSAGE"],$row["MESAGE_ID"],$row["REGISTRATION_CODE"]);
	
}



function push_notification_android($device_id,$title,$message,$MESAGE_ID,$REGISTRATION_CODE){

    //API URL of FCM
    $url = 'https://fcm.googleapis.com/fcm/send';
	$api_key = 'AAAAhwmc_58:APA91bFdN53SXsk-0pIp8mg26kjU2bMI980cSCIiCjJYnX5C5S7RMOT7vYPmcXD3rrMsN3vOOLzYObMA04ZL0JyyDx7IKRRtEQmoMnipdFrG93P2w1c3Kk3rutCsfJSPbaMnsU4dz0oF';
                
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
    echo $result ."<br>";	
	
	echo $P_MESSAGE_ID = $MESAGE_ID ;
	$P_Cust_Reg_Code = $REGISTRATION_CODE;

	include('DPD_CUST_MESSAGE_UPDATE.php');
	
	
	if($returnval =="1"){
			$post_data = array(
				'status_code' => '200',
				'msg' => 'Success',
				'values' => 'Data Update Success',
			);
	}else{
		$post_data = array(
			'status_code' => '400',
			'msg' => 'Failed',
			'values' => 'Data Update Failed !!',
		);
	}
}


?>