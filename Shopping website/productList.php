<?php


//create a connection to the database 
$conn = mysqli_connect("awseb-e-rqntn7erjh-stack-awsebrdsdatabase-8lwqs91idnrh.cjk60e66eklv.us-east-1.rds.amazonaws.com","uts","password", "assignment1");
if (!$conn)
    die("Could not connect to Server");


$query_string = "select product_id, product_name, unit_quantity, unit_price, in_stock from products";
$queryParameter = $_REQUEST['queryParameter'];
$subCategory = array("1000", "2000", "3000", "4000", "5000");

if ('all' == $queryParameter) {
    //do nothing
} else if (in_array($queryParameter, $subCategory)) {
    $sub = substr($queryParameter,0,1);
    $query_string = $query_string." where product_id like '".$sub."___'";
} else {
    $query_string = $query_string." where product_name like '%".$queryParameter."%'";
}

$query_string = $query_string." order by product_id";

//run the query and assign the return values to $result
$result = mysqli_query($conn, $query_string);


 //check the number of records returned using $num_rows
$num_rows = mysqli_num_rows($result);

//check if the $num_rows has values
if ($num_rows > 0) {
    $count = 0;
    print "<table class = 'itemTable'>";
    while ($row = mysqli_fetch_assoc($result)){
        $count = $count + 1;
        if ($count % 4 == 1) {
            if ($count != 1) {
                echo "</tr>";
            }
            echo "<tr>";
        }
        echo '<td class="items">';
        
        echo "<table border=0>";
        echo "<tr>";
        echo '<td colspan="2">';
        echo '<img src ="picture/'.$row['product_id'].'.jpeg"  width="250" height="250">';
        echo "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td colspan='2'>$".$row['unit_price']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>".$row['unit_quantity']."</td>";
        $inStock = true;
        $disable = "";
        if ($row['in_stock'] == 0) {
            $inStock = false;
        }
        
        if ($inStock) {
            echo "<td style='text-align:right'>In stock</td>";
        } else {
            echo "<td style='text-align:right;color:red'>Out of stock</td>";
            $disable = "disabled";
        }
        echo "</tr>";
        echo "<tr>";
        echo "<td>".$row['product_name']."</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo "<button ".$disable." onclick=\"minus(this)\">-</button>";
        echo "<input ".$disable." id='item".$row['product_id']."' class='itemInput' type='text' value='0' onkeypress='return isNumberKey(event)' size='10' length='10' style='text-align:center'>";
        echo "<button ".$disable." onclick=\"add(this)\">+</button>";
        echo "</td>";
        echo "<td style=text-align:right>";
        echo "<button ".$disable." onclick=\"addToCart('".$row['product_id']."', '"
                                            .$row['unit_price']."', '"
                                            .$row['unit_quantity']."', '"
                                            .$row['product_name']."', this)\">Add to cart</button>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        echo "</td>";
        
    }
    print "</table>";

    
} else {
    echo "<h2>Sorry, we couldn't find results for ".$queryParameter."</h2>";
}

// close connection
mysqli_close($conn);

?>
