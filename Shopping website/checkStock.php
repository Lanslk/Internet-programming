<?php


//create a connection to the database 
$conn = mysqli_connect("awseb-e-rqntn7erjh-stack-awsebrdsdatabase-8lwqs91idnrh.cjk60e66eklv.us-east-1.rds.amazonaws.com","uts","password", "assignment1");
if (!$conn)
    die("Could not connect to Server");


$queryParameter = $_REQUEST['queryParameter'];

$query_string = "select product_id, product_name, unit_quantity, unit_price, in_stock from products";
$query_string = $query_string." where product_id in (";
$query_string = $query_string.$queryParameter.")";
$query_string = $query_string." order by product_id";

//run the query and assign the return values to $result
$result = mysqli_query($conn, $query_string);


 //check the number of records returned using $num_rows
$num_rows = mysqli_num_rows($result);

$returnString = '';
//check if the $num_rows has values
if ($num_rows > 0) {
    $count = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $returnString = $returnString.$row['product_name'].' '.$row['unit_quantity'].':'.$row['in_stock'].'';
        if ($count < $num_rows - 1) {
            $returnString = $returnString.',';
        }
        $count = $count + 1;
    }
    echo $returnString;
}

// close connection
mysqli_close($conn);
?>
