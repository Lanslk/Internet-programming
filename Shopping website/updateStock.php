<?php


//create a connection to the database 
$conn = mysqli_connect("awseb-e-rqntn7erjh-stack-awsebrdsdatabase-8lwqs91idnrh.cjk60e66eklv.us-east-1.rds.amazonaws.com","uts","password", "assignment1");
if (!$conn)
    die("Could not connect to Server");


$updateParameter = $_REQUEST['updateParameter'];
$updateArray = explode(",", $updateParameter);

for ($x = 0; $x < sizeof($updateArray); $x++) {
    $splitArray = explode(":", $updateArray[$x]);
    $update_string = "update products set in_stock = in_stock - ".$splitArray[1];
    $update_string = $update_string." where product_id ='".$splitArray[0]."'";
    
    if (mysqli_query($conn, $update_string)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// insert orders
$insertParameter = $_REQUEST['insertParameter'];
$insertArray = explode(",", $insertParameter);

$insert_string = "insert into orders values ('0', ";
for ($x = 0; $x < sizeof($insertArray); $x++) {
    $splitArray = explode(":", $insertArray[$x]);
    $insert_string = $insert_string."'".$splitArray[1]."'";
    if ($x == sizeof($insertArray) - 1) {
        $insert_string = $insert_string.");";
    } else {
        $insert_string = $insert_string.", ";
    }
}

if (mysqli_query($conn, $insert_string)) {
    echo "Record inserted successfully";
} else {
    echo "Error inserting record: " . $conn->error;
}


// close connection
mysqli_close($conn);
?>
