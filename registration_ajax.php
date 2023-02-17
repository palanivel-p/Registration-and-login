<?php

Include("conn.php");

date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['email'])&& isset($_POST['password'])) {

    $email = clean($_POST['email']);
    $password = clean($_POST['password']);


    $sqlValidateCustomerid = "SELECT * FROM gbuser WHERE email='$email'";
    $resValidateCustomerid = mysqli_query($conn, $sqlValidateCustomerid);
    //The query() / mysqli_query() function performs a query against a database.

    if (mysqli_num_rows($resValidateCustomerid) == 0) {
   //The mysqli_num_rows() function returns the number of rows in a result set.
   
        $sqlValidateCustomerid = "INSERT INTO `gbuser`(`email`, `password`) VALUES ('$email','$password')";
        $resValidateCustomerid = mysqli_query($conn, $sqlValidateCustomerid);

        $json_array['status'] = "success";
        $json_array['msg'] = "Register Successfully !!";
        $json_response = json_encode($json_array);
        echo $json_response;
 
    }
    else{
        $json_array['status'] = "failure";
        $json_array['msg'] = "email id is already register !!";
        $json_response = json_encode($json_array);
        echo $json_response;
    }
}
else{

    //Parameters missing

    $json_array['status'] = "failure";
    $json_array['msg'] = "Please try after sometime !!!";
    $json_response = json_encode($json_array);
    echo $json_response;
}
function clean($data) {
    $data= str_replace("'","",$data);
    $data= str_replace('"',"",$data);
    $data = filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    return $data;

}

?>
