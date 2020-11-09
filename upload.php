<?php
session_start();

include ('dbconnection.php');
$up_id = $_SESSION['buyer_id'];
static $pass_error = "";
if (isset($_POST['itype'])) {
    $itype = $_POST["itype"];
    $nm = $_POST["Name"];
    $cp = $_POST["cmp"];
    $exp = $_POST["exp"];
    $qt = $_POST["quant"];
    $op = $_POST["oprice"];
    $sp = $_POST["sprice"];
    $desc = $_POST["desc"];
    $ver =  $_POST["version"];

    if ($itype == 11) {
        $pass_error = "Please select an item";
    } else {
        if ($itype == 12) {
            $query = "insert into food_items(name,company,quantity,price,expiry,user_id,description)
                    values('{$nm}', '{$cp}', {$qt}, {$sp}, '{$exp}', {$up_id}, '{$desc}');";
        } elseif ($itype == 13) {
            $query = "insert into tech_items(name,company,version,quantity,orig_price,seller_price,user_id, description) 
                                values('{$nm}', '{$cp}', '{$ver}', {$qt}, {$op}, {$sp}, {$up_id}, '{$desc}');";
        }
        elseif ($itype == 14) {
            $query = "insert into house_items(name,quantity,price,user_id, description) 
                    values('{$nm}', {$qt}, {$sp}, {$up_id}, '{$desc}');";
        }
    }
    //echo $query;
    if ($mysql->query($query)) {
        header("Location: home.php");
    } else {
        echo "Could not insert";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Sell on HMD</title>
    <link rel="stylesheet" href="upload/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="upload/fonts/ionicons.min.css">
    <link rel="stylesheet" href="upload/css/Contact-Form-Clean.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/css/pikaday.min.css">
</head>

<body style="background-color: rgb(132,240,255);">
    <main class="page hire-me-page">
        <section class="portfolio-block hire-me">
            <div class="container">
                <form name="itform" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" style="background-color: #f5f8f4;">
                    <div class="heading">
                        <h1 style="margin-bottom: 0px;">Add product</h1>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="itype" id="prikey" onclick="setform();" required>
                            <option value="11">--Select--</option>
                            <option value="12">Food</option>
                            <option value="13">Tech</option>
                            <option value="14">Household</option>
                        </select>
                    </div>
                    <span id="extf"></span>
                    <script>
                        function setform() {
                            let nm = '<div class="form-group"><label>Name</label><input class="form-control" type="text" name="Name" required></div>';
                            let cp = '<div class="form-group"><label>Company</label><input class="form-control" type="text" name="cmp" required></div>';
                            let exp = '<div class="form-group"><label>Expiry</label><input class="form-control" type="date" name="exp" required></div>';
                            let qt = '<div class="form-group"><label>Quantity</label><input class="form-control" type="number" value="1" name="quant" required></div>';
                            let op = '<div class="form-group"><label>Original Price</label><input class="form-control" type="number" name="oprice" required></div>';
                            let sp = '<div class="form-group"><label>Your Price</label><input class="form-control" type="number" name="sprice" required></div>';
                            let desc = '<div class="form-group"><label>Description</label><input class="form-control" type="text" name="desc" required></div>';
                            let ver = '<div class="form-group"><label>Version</label><input class="form-control" type="text" name="version" required></div>';


                            let valu = document.forms["itform"]["itype"].value;

                            if (valu == 11) document.getElementById("extf").innerHTML = "";
                            else if (valu == 12) document.getElementById("extf").innerHTML = nm + cp + qt + exp + desc + sp;
                            else if (valu == 13) document.getElementById("extf").innerHTML = nm + cp + qt + ver + desc + op + sp;
                            else document.getElementById("extf").innerHTML = nm + qt + sp + desc;
                        }
                    </script>
                    <div class="form-group text-center">
                        <div class="form-row">
                            <!--  type="submit" -->
                            <div class="col"><button class="btn btn-primary" type="submit" style="padding-top: 6px;margin: 12px;">Submit</button></div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
    <footer class="page-footer" style="background-color: #00676d;">
        <div class="container">
            <div class="links"><a class="text-truncate text-white" href="chrome://dino" style="background-color: rgba(166,81,81,0.09);">About Us</a></div>
            <div class="social-icons"><a href="http://www.github.com/ayagrwl1080"><i class="icon ion-social-github"></i></a></div>
        </div>
    </footer>
    <script src="upload/js/jquery.min.js"></script>
    <script src="upload/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.6.1/pikaday.min.js"></script>
    <!-- <script src="upload/js/theme.js"></script> -->
</body>

</html>