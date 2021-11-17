<?php
if(ISSET($_POST))
{
  $name=$_POST['name'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $address=$_POST['address'];
  $city=$_POST['city'];
  $state=$_POST['state'];
  $zip_code=$_POST['zip_code'];
  $country=$_POST['country'];
  $check_in_date=$_POST['check_in_date'];
  $check_out_date=$_POST['check_out_date'];
  $no_of_person=$_POST['no_of_person'];
  $no_of_male=$_POST['no_of_male'];
  $no_of_female=$_POST['no_of_female'];
  $no_of_kids=$_POST['no_of_kids'];
  

  $field1="<b>Address: </b>"."<br>"."Street: ".$address."<br>"."City: ".$city."<br>"."State: ".$state."<br>"."Zip Code: ".$zip_code."<br>"."Country: ".$country."<br>"."<b>Check In date:</b> ".$check_in_date."<br>"."<b>Check Out Date:</b> ".$check_out_date."<br>"."<b>Number Of Person:</b> ".$no_of_person."<br>"."<b>No Of Male:</b> ".$no_of_male."<br>"."<b>No Of Female:</b> ".$no_of_female."<br>"."<b>No Of Kids:</b> ".$no_of_kids;
}
else
{
echo "Thanks";	
exit();	
}
$Token_Key='#'; // Located in admin section under setup
$WebURL='#'; // CRM Url like https://www.abc.com/crm-folder
//Lead Fields
$post_data=array('name'=>$name,'phone'=>$phone,'email'=>$email, 'field_1'=>$field1);
$PHPCRM = curl_init();
curl_setopt_array($PHPCRM, array(
  CURLOPT_URL=>$WebURL.'/index.php/crm_api/leads/add_lead/'.$Token_Key,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $post_data,
));

$response = curl_exec($PHPCRM);
curl_close($PHPCRM);
header("Location:thanks.php");
exit();
//echo $response;
?>