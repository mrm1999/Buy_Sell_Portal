<?php
session_start();
if (isset($_SESSION['email'])) {
    $_SESSION['buyer_email'] = $_SESSION['email'];
} else {
    header('location: login.php');
}
$buyEmail = $_SESSION['buyer_email'];

// Query to fetch buyer id
include ('dbconnection.php');
$buyer_id_query = "select user_id from user_addr where email='{$buyEmail}';";
$buyer_id = "";
$buy_id_result = "";
if ($mysql->query($buyer_id_query)) {
    $buy_id_result = $mysql->query($buyer_id_query);
    $buyer_id = $buy_id_result->fetch_assoc();
    $buyer_id = $buyer_id['user_id'];
    $_SESSION['buyer_id'] = $buyer_id;
} else {
    echo  "alert('Wrong Parameters Passed, Please Login Again')";
    session_destroy();
    sleep(1);
    header('Location:login.php');
}
$mysql->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home</title>
    <link rel="stylesheet" href="index/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="index/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="index/css/styles.css">
</head>

<body>
    <nav class="navbar navbar-dark navbar-expand-md fixed-top bg-dark">
        <div class="container"><a class="navbar-brand" href="home.php">HMD</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav flex-grow-1 justify-content-end">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="home.php">All Items</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="upload.php">Sell &nbsp;<i class="fas fa-dollar-sign"></i></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="donate.php">Donate</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="waste.php">Waste</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="text-center"><img class="img-fluid align-self-center mx-auto" src="index/img/Blog_roobykon_software.jpg" style="margin-top: 57px;width: 1200px;"></div>
    <div class="row">
        <div class="col-6 mx-auto">
            <p class="text-center">The Following products are available for purchase.</p>
        </div>
    </div>
    <div class="container">
        <p style="margin-top: 16px;margin-bottom: 0px;">Food Items :-&nbsp;</p>
        <div class="table-responsive text-center bg-secondary border rounded border-warning shadow-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Product Id</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Expiry</th>
                        <th>Description</th>
                        <th>Upload Date</th>
                        <th>Seller Id</th>
                        <th>Buy</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    include ('dbconnection.php');

                    if ($mysql === false)
                        die("ERROR: Could Not Connect. " . $mysql->connect_error);

                    $query = "SELECT * FROM food_items;";
                    $result = $mysql->query($query);
                    $row = $result->fetch_assoc();
                    $i = 1;

                    while ($row) {
                        $tprod_id = $row['prod_id'];
                        $seller_id = $row['user_id'];
                        //fetch Seller details;
                        $seller_details_query = "select * from user_addr where user_id = '{$seller_id}';";
                        $seller_res = $mysql->query($seller_details_query);
                        $seller_res = $seller_res->fetch_assoc();
                        //$seller_name = $seller_res['name'];
                        $seller_tel = $seller_res['phone'];
                        $message = "Please contact the seller on {$seller_tel}. Confirming now will delete the item from the list";
                        echo "<tr>
                <td>{$i}</td>
                <td>{$tprod_id}</td>
                <td>{$row['name']}</td>
                <td>{$row['company']}</td>
                <td>{$row['quantity']}</td> 
				<td>{$row['price']}</td>
				<td>{$row['expiry']}</td>
				<td>{$row['description']}</td>
				<td>{$row['upload_date']}</td>
                <td>{$seller_id}</td>
                <td>
<a onclick=\"javascript: return confirm('" . $message . "');\" href='transac.php?itid=" . $tprod_id . "&itype=1'>
                Buy</a>
                </td>
            </tr>";
                        $row = $result->fetch_assoc();
                        $i++;
                    }

                    $mysql->close();
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <p style="padding: 0px;margin-bottom: 0px;margin-top: 16px;">Tech Items :-</p>
        <div class="table-responsive text-center bg-secondary border rounded border-warning shadow-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Product Id</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Version</th>
                        <th>Quantity</th>
                        <th>Original Price</th>
                        <th>Seller Price</th>
                        <th>Description</th>
                        <th>Upload Date</th>
                        <th>Seller Id</th>
                        <th>Buy</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                    include ('dbconnection.php');

                    if ($mysql === false)
                        die("ERROR: Could Not Connect. " . $mysql->connect_error);

                    $query = "SELECT * FROM tech_items";
                    $result = $mysql->query($query);
                    $row = $result->fetch_assoc();
                    $i = 1;
                    while ($row) {
                        $tprod_id = $row['prod_id'];
                        $seller_id = $row['user_id'];
                        //fetch Seller details;
                        $seller_details_query = "select * from user_addr where user_id = '{$seller_id}';";
                        $seller_res = $mysql->query($seller_details_query);
                        $seller_res = $seller_res->fetch_assoc();
                        //$seller_name = $seller_res['name'];
                        $seller_tel = $seller_res['phone'];
                        $message = "Please contact the seller on {$seller_tel}. Confirming now will delete the item from the list";

                        echo "<tr>
                <td>{$i}</td>
                <td>{$tprod_id}</td>
                <td>{$row['name']}</td>
                <td>{$row['company']}</td>
				<td>{$row['version']}</td>
                <td>{$row['quantity']}</td> 
				<td>{$row['orig_price']}</td>
				<td>{$row['seller_price']}</td>
				<td>{$row['description']}</td>
                <td>{$row['upload_date']}</td>
                <td>{$seller_id}</td>
                <td>
    <a onclick=\"javascript: return confirm('" . $message . "');\" href='transac.php?itid=" . $tprod_id . "&itype=2'>
                Buy</a>
                </td>
            </tr>";
                        $row = $result->fetch_assoc();
                        $i++;
                    }

                    $mysql->close();
                    ?>


                </tbody>
            </table>
        </div>
    </div>
    <div class="container">
        <p style="margin-top: 16px;margin-bottom: 0px;">Household Items :-</p>
        <div class="table-responsive text-center bg-secondary border rounded border-warning shadow-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th>Sr no.</th>
                        <th>Product Id</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Upload Date</th>
                        <th>Seller Id</th>
                        <th>Buy</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include ('dbconnection.php');

                    if ($mysql === false)
                        die("ERROR: Could Not Connect. " . $mysql->connect_error);

                    $query = "SELECT * FROM house_items";
                    $result = $mysql->query($query);
                    $row = $result->fetch_assoc();
                    $i = 1;
                    while ($row) {
                        $tprod_id = $row['prod_id'];
                        $seller_id = $row['user_id'];
                        //fetch Seller details;
                        $seller_details_query = "select * from user_addr where user_id = '{$seller_id}';";
                        $seller_res = $mysql->query($seller_details_query);
                        $seller_res = $seller_res->fetch_assoc();
                        $seller_name = $seller_res['fname'];
                        $seller_tel = $seller_res['phone'];
                        $message = "Please contact the seller on {$seller_tel}. Confirming now will delete the item from the list";

                        echo "<tr>
                <td>{$i}</td>
                <td>{$tprod_id}</td>
                <td>{$row['name']}</td>
                <td>{$row['quantity']}</td> 
				<td>{$row['price']}</td>
				<td>{$row['description']}</td>
                <td>{$row['upload_date']}</td>
                <td>{$seller_id}</td>
                <td>
                <a onclick=\"javascript: return confirm('" . $message . "');\" href='transac.php?itid={$tprod_id}&itype=3'>
                Buy</a>
                </td>
            </tr>";
                        $row = $result->fetch_assoc();
                        $i++;
                    }

                    $mysql->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="index/js/jquery.min.js"></script>
    <script src="index/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>