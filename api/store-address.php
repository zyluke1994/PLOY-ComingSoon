<?php // for MailChimp API v3.0

include('MailChimp.php');  // path to API wrapper downloaded from GitHub

use \DrewM\MailChimp\MailChimp;

function storeAddress() {

    $key        = "27900e3c074f4f2db696c684ab4b93f9-us12";
    $list_id    = "fb64dac83f";

    // $merge_vars = array(
    //     'FNAME'     => $_POST['fname'],
    //     'LNAME'     => $_POST['lname']
    // );

    $mc = new MailChimp($key);

    // add the email to your list
    $result = $mc->post('/lists/'.$list_id.'/members', array(
            'email_address' => $_POST['email'],
            // 'merge_fields'  => $merge_vars,
            //'status'        => 'pending'     // double opt-in
             'status'     => 'subscribed'  // single opt-in
        )
    );

    return json_encode($result);

}

// If being called via ajax, run the function, else fail

if ($_POST['ajax']) { 
    echo storeAddress(); // send the response back through Ajax
} else {
    echo 'Method not allowed - please ensure JavaScript is enabled in this browser';
}