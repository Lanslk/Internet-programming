<!DOCTYPE html>
<html>
<style type="text/css">
.center {
  text-align: center;
  vertical-align: middle;
}
.logo {
    cursor: pointer;
}
/* Popup container - can be anything you want */
.category {
  position: relative;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* The actual popup */
.category .cartArea {
  visibility: hidden;
  width: 500px;
  background-color: #ffffff;
  color: #000000;
  text-align: center;
  border: 1px solid silver;
  border-radius: 10px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  top: 100%;
  left: 80px;
  margin-left: -80px;
}

/* The actual popup */
.category .c_item {
  visibility: hidden;
  width: 150px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  top: 125%;
  left: 55%;
  margin-left: -80px;
}

.category .c_item .c_div:hover {
    color: orange;
}

/* Toggle this class - hide and show the popup */
.category .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

.category .hide {
  visibility: hidden;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}

.itemTable {
    border-spacing: 30px;
}

.items { 
    border: 1px solid silver;
    border-radius: 10px;
    padding: 30px;
}

.items:hover {
    border: 3px solid silver;
}

.cartTable {
    border-spacing: 10px;
}

</style>
<head>
</head>
<body onload="getProductList('all')">
        <table border=0 class="center">
            <form id="myForm" action="delivery.php" method="GET">
            <tr>
                <td rowspan="2">
                    <div>
                        <img class="logo" src ="picture/logo.png" onclick="getProductList('all');" width="115" height="107">
                    </div>
                </td>    
                <td colspan="3">
                    <h1>Lan's online market</h1>
                </td>
                <td colspan="2">
                    <input id="searchInput" type="text" placeholder="Search products" length="100">
                    <button type="button" onclick="searchProduct()">search</button>
                </td>
                    
                <td rowspan="2" style="vertical-align:middle">
                    <button type="button" id="viewCart" onclick="showCart()" style="font-size:20px;" class="category">
                        <img src ="picture/cart.jpeg" width="25" height="25">
                        &nbsp;&nbsp;
                        <a id="amount">$0</a>
                    </button>
                    <div class="category">
                        <br>
                        <span class="cartArea" id="cartArea">
                            Your Cart
                            <span id="cartList">
                                
                            </span>
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="center">
                    <div class="category" id="frozen_food" style="width: 150px;" onclick="showCategory(this);">
                        Frozen Food
                        <span class="c_item" id="c_frozen_food">
                            <div class="c_div" onclick="getProductList(1000);">All</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Fish Fingers</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Hamburger Patties</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Shelled Prawns</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Tub Ice Cream</div>
                        </span>
                    </div>
                </td>
                
                <td class="center">
                    <div class="category" id="home-health" style="width: 150px;" onclick="showCategory(this)">
                        Home Health
                        <span class="c_item" id="c_home-health">
                            <div class="c_div" onclick="getProductList(2000);">All</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Panadol</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Bath Soap</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Garbage Bags</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Washing Powder</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Laundry Bleach</div>
                        </span>
                    </div>
                </td>
                
                <td class="center">
                    <div class="category" id="freash_food" style="width: 150px;" onclick="showCategory(this)">
                        Fresh Food
                        <span class="c_item" id="c_freash_food">
                            <div class="c_div" onclick="getProductList(3000);">All</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Cheddar Cheese</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">T Bone Steak</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Navel Oranges</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Bananas</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Peaches</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Grapes</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Apples</div>
                        </span>
                    </div>
                </td>
                
                <td class="center">
                    <div class="category" id="beverages" style="width: 150px;" onclick="showCategory(this)">
                        Beverages
                        <span class="c_item" id="c_beverages">
                            <div class="c_div" onclick="getProductList(4000);">All</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Earl Grey Tea Bags</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Instant Coffee</div>
                        </span>
                    </div>
                </td>
                
                <td class="center">
                    <div class="category" id="pet-food" style="width: 150px;" onclick="showCategory(this)">
                        Pet-food
                        <span class="c_item" id="c_pet-food">
                            <div class="c_div" onclick="getProductList(5000);">All</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Dry Dog Food</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Bird Food</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Cat Food</div> <br>
                            <div class="c_div" onclick="getProductList(this.innerHTML);">Fish Food</div>
                        </span>
                    </div>
                </td>
            </tr>
            </form>
        </table>
    </div>
    <div id = "category" style="width: 500px; float:left; height:1000px; margin:10px">
    </div>
</body>
<script>

    var amount = 0;
    var cart = Array();
    
    // Event listener to hide area when clicking outside

    document.addEventListener('click', function(event) {
        var target = event.target;
    
        if (!target.closest('.category')) {
            var c_items = document.getElementsByClassName("c_item");
            for (var i = 0; i < c_items.length; i++) {
                if (c_items[i].className == "c_item show") {
                    c_items[i].classList.toggle("show");
                }
            }
        }
        
        if (!target.closest('#cartArea') && !target.closest('#viewCart')) {
            var cart = document.getElementById("cartArea");

                if (cart.className == "cartArea show") {
                    cart.className = "cartArea";


                }

        }
    });
    
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
    
    function cartCookie() {
        // get shopping cart from cookie
        let cartCookie = getCookie("cart");
        var cartJson = [];
        if (cartCookie != '') {
            cartJson = JSON.parse(cartCookie);
        }
        
        for (var i = 0; i < cartJson.length; i++) {
            var myMap = jsonToMap(cartJson[i]);
            cart[i] = myMap
        }
        renewCart();
    }

    function showCategory(dom) {
        var popup = document.getElementById("c_" + dom.id);
        popup.classList.toggle("show");

        var c_items = document.getElementsByClassName("c_item");
        for (var i = 0; i < c_items.length; i++) {
            if (c_items[i].id != ("c_" + dom.id)) {
                if (c_items[i].className == "c_item show") {
                    c_items[i].classList.toggle("show");
                }
            }
            
        }
    }
    
    function searchProduct() {
        var searchText = document.getElementById("searchInput").value;
        getProductList(searchText);
        
    }
    
    function getProductList(queryParameter) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                document.getElementById("category").innerHTML = xhttp.responseText;
                cartCookie();
            }
        };
        xhttp.open("GET", "productList.php?queryParameter=" + queryParameter, true);
        xhttp.send();
    }
    
    function showCart() {
        var popup = document.getElementById("cartArea");
        popup.classList.toggle("show");
    }
    
    function mapToJson(map) {
        const obj = {};
        for (const [key, value] of map) {
            obj[key] = value instanceof Map ? mapToJson(value) : value;
        }
        return JSON.stringify(obj);
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
    
    function renewCart() {
        // put shopping cart to cookie
        var jsonCart = [];
        for (var i = 0; i < cart.length; i++) {
            jsonCart[i] = mapToJson(cart[i]);
        }
        document.cookie = "cart=" + JSON.stringify(jsonCart) + "; max-age=36000";
        
        // renew shopping cart
        var cartTable = '';
        amount = 0;
        document.getElementById("amount").innerHTML = '$0';
        
        for (var i = 0; i < cart.length; i++) {
            if (i == 0) {
               cartTable += "<table class='cartTable'>";
            }
            cartTable += "<tr class='cartItems'>";
            cartTable += "<td>";
            cartTable += '<img src ="picture/' + cart[i].get('productId') + '.jpeg"  width="70" height="70">';
            cartTable += "</td>";
            cartTable += "<td>";
            cartTable += cart[i].get('productName');
            cartTable += "</td>";
            cartTable += "<td>";
            cartTable += "$";
            cartTable += cart[i].get('unitPrice');
            cartTable += "</td>";
            cartTable += "<td>";
            
            cartTable +=  "<button type=\"button\" onclick=\"minusCart(this, " + cart[i].get('productId') +")\">-</button>";
            cartTable +=  "<input readonly name = 'cartItem" + cart[i].get('productId') + "' id='cartItem" + cart[i].get('productId') + 
                "' class='cartItemInput' type='text' value='" + cart[i].get('count') + "' onkeypress='return isNumberKey(event)' size='10' length='10' style='text-align:center'>";
            cartTable +=  "<button type=\"button\" onclick=\"addCart(this, " + cart[i].get('productId') + ")\">+</button>";
            
            cartTable += "</td>";
            cartTable += "<td>";
            cartTable +=  "<button type=\"button\" onclick=\"removeCart(this, " + cart[i].get('productId') +")\">Remove</button>";
            cartTable += "</td>";
            cartTable += "</tr>";
            
            amount = amount + parseFloat(cart[i].get('unitPrice')) * parseInt(cart[i].get('count'));
            amount.toFixed(2);
            document.getElementById("amount").innerHTML = '$' + String(amount.toFixed(2));
        }
        cartTable += "</table>";
        if (cart.length > 0) {
            cartTable += "<button type=\"button\" onclick=\"clearCart()\">Clear Cart</button>";
            cartTable += "&nbsp";
            cartTable += "<button type=\"submit\"onclick=\"checkOut()\">Place an order</button>";
        }
        document.getElementById("cartList").innerHTML = cartTable;
        
        document.cookie = "total=" + amount + "; max-age=36000";
        
        // synchorize cart and itemList
        var cartDom = document.querySelectorAll("input.cartItemInput");
        for (var i = 0; i < cartDom.length; i++) {
            var updateId = "i" + cartDom[i].id.substring(5);
            document.getElementById(updateId).value = cartDom[i].value;
        }
    }
    
    function addToCart(productId, unitPrice, unit_quantity, productName, dom) {
        var count = dom.parentElement.previousElementSibling.childNodes[1].value;
        var find = false;
        for (var i = 0; i < cart.length; i++) {
            if (cart[i].get('productId') == productId) {
                find = true;
                if (count == 0) {
                    cart.splice(i, 1);
                } else {
                    cart[i].set('count', parseInt(count));
                }
                break;
            }
        }
        
        if (!find && count > 0) {
            var item = new Map();
            item.set('productId', productId);
            item.set('unitPrice', unitPrice);
            item.set('unitQuantity', unit_quantity);
            item.set('productName', productName);
            item.set('count', count);
            cart[cart.length] = item;
        }
        renewCart();
    }
    
    function minus(dom) {
        var num = dom.nextSibling;
        if (num.value > 0) {
            num.value = parseInt(num.value) - 1;
        }
    }
    
    function add(dom) {
        var num = dom.previousElementSibling;
        num.value = parseInt(num.value) + 1;
    }
    
    function removeCart(dom, productId) {
        for (var i = 0; i < cart.length; i++) {
            if (cart[i].get('productId') == productId) {
                cart.splice(i, 1);
                // synchorize cart and itemList
                document.getElementById("item" + productId).value = 0;
                break;
            }
        }
        renewCart();
    }
    
    function clearCart() {
        cart = [];
        renewCart();
        // synchorize cart and itemList
        var cartDom = document.querySelectorAll("input.itemInput");
        for (var i = 0; i < cartDom.length; i++) {
            cartDom[i].value = 0;
        }
    }
    
    function minusCart(dom, productId) {
        var num = dom.nextSibling;
        
        if (num.value > 0) {
            num.value = parseInt(num.value) - 1;
            for (var i = 0; i < cart.length; i++) {
                if (cart[i].get('productId') == productId) {
                    if (num.value == 0) {
                        cart.splice(i, 1);
                        // synchorize cart and itemList
                        document.getElementById("item" + productId).value = 0;
                    } else {
                        cart[i].set('count', parseInt(num.value));
                    }
                    
                    break;
                }
            }
            renewCart();
        }
    }
    
    function addCart(dom, productId) {
        var num = dom.previousElementSibling;
        
        num.value = parseInt(num.value) + 1;
        for (var i = 0; i < cart.length; i++) {
            if (cart[i].get('productId') == productId) {
                cart[i].set('count', parseInt(num.value));
                break;
            }
        }
        renewCart();
    }
    
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode < 48 || charCode > 57) {
            return false;
        }
        return true;
    }
    
    function checkOut() {
        document.getElementById("myForm").submit();
    }
</script>
</html>