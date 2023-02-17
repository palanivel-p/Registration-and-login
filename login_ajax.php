<?php

Include("conn.php");

date_default_timezone_set('Asia/Kolkata');

if(isset($_POST['email'])&& isset($_POST['password'])) {

    $email = clean($_POST['email']);
    $password = clean($_POST['password']);


    $sqlValidateCustomerid = "SELECT * FROM gbuser WHERE email='$email'";
    $resValidateCustomerid = mysqli_query($conn, $sqlValidateCustomerid);
    if (mysqli_num_rows($resValidateCustomerid) > 0) {

    $sqlValidateCustomer = "SELECT * FROM gbuser WHERE email='$email' AND password = '$password'";
    $resValidateCustomer = mysqli_query($conn, $sqlValidateCustomer);
    if (mysqli_num_rows($resValidateCustomer) > 0) {
                        
                            $json_array['status'] = "success";
                            $json_array['msg'] = "Login Successfully !!";
                            $json_response = json_encode($json_array);
                            echo $json_response;
                        }              
    
    else {
        $json_array['status'] = "failure";
        $json_array['msg'] = "Password Is Wrong !!";
        $json_response = json_encode($json_array);
        echo $json_response;
    }
    }
    else{
        $json_array['status'] = "failure";
        $json_array['msg'] = "email Is Wrong !!";
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
