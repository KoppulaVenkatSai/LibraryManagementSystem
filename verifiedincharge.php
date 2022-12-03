<html>
<head>
        <title>Incharge</title>
        <link rel="stylesheet" href="verifiedincharge.css">
        <script src="verifiedincharge.js"></script>
</head>
<body>
    <div class="container"> 
        <section id="authorise-scroll"></section>
        <div class="navdiv">
        <div class="nav-sub-div">
            <ul>
                <li class="navlist" id="authorise-li">
                    <a href="#authorise-scroll" onclick="authorisediv()">Authorise users</a>
                </li>
                <li class="navlist" id="see-li">
                    <a href="#see-scroll" onclick="seediv()">See users</a>
                </li>
                <li class="navlist" id="revoke-li">
                    <a href="#revoke-scroll" onclick="revokediv()">Revoke users</a>
                </li>
                <li class="navlist" id="books-li">
                    <a href="books.php?username=incharge">Books</a>
                </li>
            </ul>
        </div>
        </div>

        <div class="operations-con">
            <h2 class="heading" align="center" id="authorise-heading">Authorise Users</h2>
            <div class="operation" id="authorise">
                <div class="table-con" id="authorise-table-con">
                    <?php
                        $conn = new mysqli('localhost', 'root', '', 'LMS-PROJ');
                        $reqarr = [];
                        $reqselect = $conn -> query("select * from request;");
                        $userselect = $conn -> query("select * from user");
                        if ($reqselect->num_rows != 0) {
                            foreach ($reqselect as $row) {
                                array_push($reqarr, $row['username']);
                            }
                        }
                    ?>
                    <table>
                        <tr>
                            <th>Username</th>
                            <th>Authorisation</th>
                        </tr>
                        <?php
                            foreach ($reqarr as $users) {
                        ?>
                                <tr>
                                <td>
                                    <?php echo $users; ?>
                                </td>
                                <td>
                                    <form action="verifiedincharge.php" method="POST">
                                        <input class="ip" type="text" name="req" value="<?php echo $users; ?>">
                                        <input type="submit" name="submit" value="Authorise">
                                        <input type="submit" name="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                    </table>
                    <?php
                        if($_SERVER['REQUEST_METHOD'] == "POST"){
                            if (isset($_POST['req'])){
                                $req = $_POST['req'];
                                if ($_POST['submit'] == 'Authorise') {
                                    if ($req){
                                        $selectpass = $conn->query("select password from request where username = '$req';");
                                        foreach ($selectpass as $passrow) {
                                            $pass = $passrow['password'];
                                        }
                                        $conn -> query("insert into user values ('$req', '$pass', '')");
                                        $conn->query("delete from request where username = '$req'");
                                        // header("Refresh:0");
                                        echo "<script> location = location </script>";
                                    }
                                }
                                else {
                                    if ($req){
                                        $conn->query("delete from request where username = '$req'");
                                        // header("Refresh:0");
                                        echo "<script> location = location </script>";
                                    }
                                }
                            }
                        }
                    ?>
                </div>
                <section id="see-scroll"></section>
            </div>
            <h2 class="heading" align="center" id="see-heading">See Users</h2>
            <div class="operation" id="see">
                <div class="table-con" id="see-table-con">
                    <table>
                            <tr><th colspan="2" class='table-title'>Requests</th></tr>
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                            </tr>
                            <?php
                                foreach ($reqselect as $user) {
                            ?>
                                    <tr>
                                    <td>
                                        <?php echo $user['username']; ?>
                                    </td>
                                    <td>
                                        <?php echo $user['password']; ?>
                                    </td>
                                </tr>
                                <?php } ?>
                    </table>

                    <table>
                            <tr><th colspan="3" class='table-title'>Users</th></tr>
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Books</th>
                            </tr>
                            <?php
                                foreach ($userselect as $user) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $user['username']; ?>
                                    </td>
                                    <td>
                                        <?php echo $user['password']; ?>
                                    </td>
                                    <td>
                                        <?php echo $user['books']; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <section id="revoke-scroll"></section>
            </div>
            <h2 class="heading" align="center" id="revoke-heading">Revoke Users</h2>
            <div class="operation" id="revoke">
                <div class="table-con" id="revoke-table-con">
                    <table>
                            <tr>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                            <?php
                                foreach ($userselect as $user) {
                            ?>
                                    <tr>
                                    <td>
                                        <?php echo $user['username']; ?>
                                    </td>
                                    <td>
                                    <form action="verifiedincharge.php" method="POST">
                                            <input type="text" name="revoke" class="ip" value="<?php echo $user['username']; ?>">
                                            <input type="submit" name="submit" value="Revoke">
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                        </table>
                    </div>
                    <?php
                        if($_SERVER['REQUEST_METHOD'] == "POST"){
                            if (isset($_POST['revoke'])) {
                                $revoke = $_POST['revoke'];
                                if ($revoke){
                                    $selectpass = $conn->query("delete from user where username = '$revoke';");
                                    echo "<script> location = location </script>";
                                    // header("Refresh:0");
                                }
                            }
                        }
                    ?>
            </div>
        </div>
    </div>

</body>
</html>