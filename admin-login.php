<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .myDiv {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php require("head.html"); ?>

    <h2 align = 'center' >Admin Login</h2>

    <form class="row contact_form" action="./checkuser.php" method="post">
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input class="form-control" type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input class="form-control" type="password" placeholder="Enter Password" name="psw" required>
            <br>

        </div>

        <div class="container myDiv" style="background-color:#f1f1f1">
            <button class="btn_1 ml-auto mr-auto" type="submit">Login</button>
            <button class="btn_3 ml-auto mr-auto" type="button">Cancel</button>
        </div>
    </form>

</body>

</html>