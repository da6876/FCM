<?php
include '../Connection.php';

$P_MESSAGE_ID = $P_MESSAGE_ID ;
$P_Cust_Reg_Code = $P_Cust_Reg_Code;
$P_User = "";

if($P_MESSAGE_ID!="" && $P_Cust_Reg_Code!=""){

	$returnval=0;
	
	$REG = oci_parse($conn, 
	"begin DPG_MED_ADD_TO_CART.DPD_CUST_MESSAGE_UPDATE
	(:o_status,:P_MESSAGE_ID,:P_Cust_Reg_Code,:P_User);
	end;");

	oci_bind_by_name($REG, ":o_status", $returnval, -1, SQLT_INT);
	oci_bind_by_name($REG, ":P_MESSAGE_ID", $P_MESSAGE_ID, -1, SQLT_CHR);
	oci_bind_by_name($REG, ":P_Cust_Reg_Code", $P_Cust_Reg_Code, -1, SQLT_CHR);
	oci_bind_by_name($REG, ":P_User", $P_User, -1, SQLT_CHR);

	oci_execute($REG);
	
	
		
}else{
	$responce_data = array(
				'status_code' => "205",
				'msg' => "Failed",
				'values' => "Mandatory Field Empty"
			);
}
	
?>