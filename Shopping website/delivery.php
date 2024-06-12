<!DOCTYPE html>
<html>
<style type="text/css">
.logo {
    cursor: pointer;
}
</style>
<head>
    <title>Deilvery details</title>
</head>
<body onload="checkStock()">
    <form id="myForm" action="index.php">
    <div>
        <table border=0 class="center">
            <tr>
                <td rowspan="2">
                    <div>
                        <img class="logo" src ="picture/logo.png" onclick="toHomepage()" width="115" height="107">
                    </div>
                </td>    
                <td colspan="3">
                    <h1>Lan's online market</h1>
                </td>
            </tr>
        </table>
        <table id="deliveryTable">
            <h2>Delivery details</h2>
            <tr>
                <td colspan="2">
                    <h3>FIRST NAME<font color="red"> *</font></h3>
                    <input class="details" name="first_name" id="firstName" type="text" length="30" size="30">
                </td>
                <td colspan="2">
                    <h3>LAST NAME<font color="red"> *</font></h3>
                    <input class="details" name="last_name" id="lastName" type="text" length="30" size="30">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3>EMAIL<font color="red"> *</font></h3>
                    <input class="details" name="email" id="email" type="text" length="30" size="30">
                </td>
                <td colspan="2">
                    <h3>PHEONE NO<font color="red"> *</font></h3>
                    <input class="details" name="phone_no" id="phoneNo" type="text" length="30" size="30">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <h3>ADDRESS<font color="red"> *</font></h3>
                    <input class="details" name="address" id="address" type="text" length="80" size="80">
                </td>
            </tr>
            <tr>
                <td>
                    <h3>CITY/SUBURB<font color="red"> *</font></h3>
                    <input class="details" name="city" id="city" type="text" length="20" size="20">
                </td>
                <td>
                    <h3>STATE<font color="red"> *</font></h3>
                    <select class="details" id="stateOptions" name = "state">
                        <option value="">Select a state</option>
                        <option value="NSW">NSW</option>
                        <option value="VIC">VIC</option>
                        <option value="QLD">QLD</option>
                        <option value="WA">WA</option>
                        <option value="SA">SA</option>
                        <option value="TAS">TAS</option>
                        <option value="ACT">ACT</option>
                        <option value="NT">NT</option>
                        <option value="Others">Others</option>
                    </select>
                </td>
                <td>
                    <h3>COUNTRY<font color="red"> *</font></h3>
                    <input class="details" name="country" id="country" type="text" length="20" size="20">
                </td>
                <td>
                    <h3>ZIP<font color="red"> *</font></h3>
                    <input class="details" name="zip" id="zip" type="text" length="20" size="20">
                </td>
            </tr>
            <tr>
                <td colspan="3" align="right">
                    <h3><button type='button' onclick='toHomepage()'>Back to homepage</button></h3>
                </td>
                <td colspan="1" align="right">
                    <h3><button type="button" onclick="confirm()">Confirm</button></h3>
                </td>
            </tr>
        </table>
    </div>
    </form>
</body>
<script>
    var cart = Array();
    
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
            }
        }
      return "";
    }

    function jsonToMap(jsonString)  {
        var jsonObject = JSON.parse(jsonString);
        var dataMap = new Map(Object.entries(jsonObject));
        var resultMap = new Map();
        for (const key of dataMap.keys())  {
            var value = dataMap.get(key);
            resultMap.set(key, value);
        }
        return resultMap;
    }
    
    function checkStock() {
        let cartCookie = getCookie("cart");
        
        var cartJson = [];
        if (cartCookie != '') {
            cartJson = JSON.parse(cartCookie);
        }
        
        cart = Array();
        var queryParameter = '';
        var itemMap = new Map();
        for (var i = 0; i < cartJson.length; i++) {
            var myMap = jsonToMap(cartJson[i]);
            cart[i] = myMap;
            queryParameter += "'";
            queryParameter += myMap.get("productId");
            queryParameter += "'";
            if (i != cartJson.length - 1) {
                queryParameter += ", ";
            }
            itemMap.set(myMap.get("productName") + ' ' + myMap.get("unitQuantity"), myMap.get("count"));
        }
        
        var xhttp = new XMLHttpRequest();
        var NoStockMsg = false;
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var result = xhttp.responseText;
                let each = result.split(',');
                for (var i = 0; i < each.length; i++) {
                    let item = each[i].split(':');
                    let productName = item[0];
                    let stock = item[1];
                    if (parseInt(itemMap.get(productName)) > parseInt(stock)) {
                        
                        if (!NoStockMsg) {
                            NoStockMsg = true;
                            document.getElementById("deliveryTable").innerHTML = 
                                "<tr><td><h3> The Items are out of stock:</h3></td></tr>";
                        }
                        document.getElementById("deliveryTable").innerHTML +=
                                "<tr><td>" + productName + ", <font color=\"red\">stock left:" + parseInt(stock) +"</font></td></tr>";
                    }
                }
                
                if (NoStockMsg) {
                    document.getElementById("deliveryTable").innerHTML += 
                        "<tr><td><button type='button' onclick='toHomepage()'>Back to homepage</button></td></tr>";
                }
            }
        };
        
        xhttp.open("GET", "checkStock.php?queryParameter=" + queryParameter, true);
        xhttp.send();
    }
    
    function confirm() {
        if (!validation()) {
            return;
        }
        
        //update stock
        var xhttp = new XMLHttpRequest();
        var updateParameter = '';
        for (var i = 0; i < cart.length; i++) {
            updateParameter += cart[i].get("productId");
            updateParameter += ":";
            updateParameter += cart[i].get("count");
            if (i != cart.length - 1) {
                updateParameter += ",";
            }
        }
        
        //insert order
        var insertParameter = '';
        var inputs = document.getElementsByClassName("details");
        for (var i = 0; i < inputs.length; i++) {
            insertParameter += inputs[i].name;
            insertParameter += ":";
            insertParameter += inputs[i].value.replaceAll(",", "").replaceAll(":", "");
            insertParameter += ",";
        }
        insertParameter += "orders_details";
        insertParameter += ":";
        insertParameter += updateParameter.replaceAll(",", ";").replaceAll(":", "=");
        
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var msg = "<tr><td colspan='4'><h3> Thanks for your order! An email will be sent to your email address.</h3></td></tr>";
                msg += "<tr><td colspan='4'><h3> Here is your order details:</h3></td></tr>";
                
                msg += "<tr class='cartItems'>";
                msg += "<td colspan='2' align ='center'>";
                msg += "Item";
                msg += "</td>";
                msg += "<td align ='center'>";
                msg += "Price";
                msg += "</td>";
                msg += "<td align ='center'>";
                msg += "Count";
                msg += "</td>";
                msg += "</tr>";
                
                for (var i = 0; i < cart.length; i++) {
                    msg += "<tr class='cartItems'>";
                    msg += "<td align ='center'>";
                    msg += '<img src ="picture/' + cart[i].get('productId') + '.jpeg"  width="70" height="70">';
                    msg += "</td>";
                    msg += "<td align ='center'>";
                    msg += cart[i].get('productName');
                    msg += "</td>";
                    msg += "<td align ='center'>";
                    msg += "$";
                    msg += cart[i].get('unitPrice');
                    msg += "</td>";
                    msg += "<td align ='center'>";
                    msg += cart[i].get('count');
                    msg += "</td>";
                    msg += "</tr>";
                }
                
                let total = getCookie("total");
                msg += "<tr class='cartItems'>";
                msg += "<td colspan='4' align ='right'>";
                msg += "Total : $" + String(parseFloat(total).toFixed(2));
                msg += "</td>";
                msg += "</tr>";
                
                msg += "<tr><td colspan='4'><button type='button' onclick='toHomepage()'>Back to homepage</button></td></tr>";
                
                document.getElementById("deliveryTable").innerHTML = msg;
                
                // clear cookie (shopping cart)
                document.cookie = "cart=";
            }
        };
        xhttp.open("GET", "updateStock.php?updateParameter=" + updateParameter 
            + "&insertParameter=" + insertParameter, true);
        xhttp.send();
    }
    
    function toHomepage() {
        document.getElementById("myForm").submit();
    }
    
    function changeBackGround(change, dom) {
        if (change) {
            dom.style.background = 'yellow';
        } else {
            dom.style.background = '';
        }
    }
    
    function validation() {
        var inputs = document.getElementsByTagName("input");
        var check = true;
        var errorMsg = '';
        
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].value.trim() == "") {
                check = false;
                changeBackGround(true, inputs[i]);
            } else {
                changeBackGround(false, inputs[i]);
            }
        }
        
        var select = document.getElementsByTagName("select");
        if (select[0].value.trim() == "") {
            check = false;
            changeBackGround(true, select[0]);
        } else {
            changeBackGround(false, select[0]);
        }
        
        if (!check) {
            errorMsg += "All details are compulsory for the order! Please fill in\n";
        }
        
        // name validation
        if (!/^[a-z ,.'-]+$/i.test(document.getElementById("firstName").value)) {
            errorMsg += "First name is invalid!\n";
            changeBackGround(true, document.getElementById("firstName"));
        } else {
            changeBackGround(false, document.getElementById("firstName"));
        }
        
        if (!/^[a-z ,.'-]+$/i.test(document.getElementById("lastName").value)) {
            errorMsg += "Last name is invalid!\n";
            changeBackGround(true, document.getElementById("lastName"));
        } else {
            changeBackGround(false, document.getElementById("lastName"));
        }
        
        // email validation
        var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
        if (!emailRegex.test(document.getElementById("email").value)) {
            errorMsg += "Email is invalid!\n";
            changeBackGround(true, document.getElementById("email"));
        } else {
            changeBackGround(false, document.getElementById("email"));
        }
        
        // phone validation
        if (!/^\d{10}$/.test(document.getElementById("phoneNo").value)) {
            errorMsg += "Phone No is invalid, need to be 10 digits!\n";
            changeBackGround(true, document.getElementById("phoneNo"));
        } else {
            changeBackGround(false, document.getElementById("phoneNo"));
        }
        
        // address validation
        if (!/^[a-zA-Z0-9\s,'-]+$/.test(document.getElementById("address").value)) {
            errorMsg += "Address is invalid!\n";
            changeBackGround(true, document.getElementById("address"));
        } else {
            changeBackGround(false, document.getElementById("address"));
        }
        
        // city validation
        if (!/^[a-zA-Z0-9\s,'-]+$/.test(document.getElementById("city").value)) {
            errorMsg += "City/Suburb is invalid!\n";
            changeBackGround(true, document.getElementById("city"));
        } else {
            changeBackGround(false, document.getElementById("city"));
        }
        
        // country validation
        if (!/^[a-zA-Z0-9\s,'-]+$/.test(document.getElementById("country").value)) {
            errorMsg += "Country is invalid!\n";
            changeBackGround(true, document.getElementById("country"));
        } else {
            changeBackGround(false, document.getElementById("country"));
        }
        
        // zip validation
        if (!/^[0-9\s,'-]+$/.test(document.getElementById("zip").value)) {
            errorMsg += "Zip is invalid!\n";
            changeBackGround(true, document.getElementById("zip"));
        } else {
            changeBackGround(false, document.getElementById("zip"));
        }
        
        if (errorMsg != '') {
            alert(errorMsg);
            return false;
        } else {
            return true;
        }
        
    }
</script>
</html>