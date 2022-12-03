<html>
<head>
        <title>User</title>
        <link rel="stylesheet" href="verifieduser.css">
        <style>
            h3{
                color: red;
                text-align: center;
                margin: 10px;
            }
        </style>
        <script>
            function mybooksdiv() {
                navmybooks = document.getElementById('mybooks-li');
                navtakebooks = document.getElementById('takebooks-li');
                navbooks = document.getElementById('booksgallery-li');
                navmybooks.style.backgroundColor = 'aqua';
                navtakebooks.style.backgroundColor = 'white';
                navbooks.style.backgroundColor = 'white';
            }

            function takebooksdiv() {
                navmybooks = document.getElementById('mybooks-li');
                navtakebooks = document.getElementById('takebooks-li');
                navbooks = document.getElementById('booksgallery-li');
                navmybooks.style.backgroundColor = 'white';
                navtakebooks.style.backgroundColor = 'aqua';
                navbooks.style.backgroundColor = 'white';
            }

            function bookspage() {
                navmybooks = document.getElementById('mybooks-li');
                navtakebooks = document.getElementById('takebooks-li');
                navbooks = document.getElementById('booksgallery-li');
                navmybooks.style.backgroundColor = 'white';
                navtakebooks.style.backgroundColor = 'white';
                navbooks.style.backgroundColor = 'aqua';
            }
        </script>

        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>
<body>
    <?php
        $username = $_GET['username'];
        $conn = new mysqli('localhost', 'root', '', 'LMS-PROJ');
        $userselect = $conn -> query("select * from user where username='$username';");
        $booksstr = "";
        if ($userselect->num_rows != 0) {
            foreach ($userselect as $row) {
                $booksstr = $row['books'];
            }
        }
        $booksarr = explode(" ", $booksstr);
        $booksselect = $conn -> query("select * from books;");
        function bookname($bookid){
            // $bookidint = (int)$bookid;
            $conn = new mysqli('localhost', 'root', '', 'LMS-PROJ');
            $bookobj = $conn -> query("select * from books where bookid = $bookid;");
            foreach ($bookobj as  $bookrow) {
                $bookname = $bookrow['name'];
                return $bookname;
            }
        }
    ?>
    <div class="container"> 
        <section id="mybooks-scroll"></section>
        <div class="navdiv">
        <div class="nav-sub-div">
            <ul>
                <li class="navlist" id="welcome-li">
                    <p id="welcometext">Welcome</p>
                    <p id="welcomename"><?php echo $username; ?></p>
                </li>
                <li class="navlist" id="mybooks-li">
                    <a href="#mybooks-scroll" onclick="mybooksdiv()">My Books</a>
                </li>
                <li class="navlist" id="takebooks-li">
                    <a href="#takebooks-scroll" onclick="takebooksdiv()">Take Books</a>
                </li>
                <li class="navlist" id="booksgallery-li">
                    <a href = "books.php?username=<?php echo $username;?>" onclick="bookspage()">Books Gallery</a>
                </li>
                <li class="navlist" id="logout-li">
                    <a id="logout" href="login.html">Logout</a>
                </li>
            </ul>
        </div>
        </div>
        <div class="operations-con">
            <h2 class="heading" align="center" id="mybooks-heading">My Books</h2>
            <div class="operation" id="mybooks">
                <div class="table-con" id="mybooks-table-con">
                    <table>
                        <tr>
                            <th>Books ID</th>
                            <th>Book Name</th>
                            <th>Action</th>
                        </tr>
                        <?php
                            foreach ($booksarr as $bookid) {
                                if ($bookid != "") {
                        ?>
                                <tr>
                                <td>
                                    <?php echo $bookid; ?>
                                </td>
                                <td>
                                    <?php echo bookname($bookid); ?>
                                </td>
                                <td>
                                    <form action="verifieduser.php?username=<?php echo $username; ?>" method="POST">
                                        <input class="ip" type="text" name="return" value="<?php echo $bookid; ?>">
                                        <input type="submit" name="submit" value="Return">
                                    </form>
                                </td>
                            </tr>
                            <?php }} ?>
                    </table>
                    <?php
                        if($_SERVER['REQUEST_METHOD'] == "POST"){
                            if (isset($_POST['return'])){
                                $return = $_POST['return'];
                                $booksstr = "";
                                $userselect = $conn -> query("select * from user where username='$username';");
                                if ($userselect->num_rows != 0) {
                                    foreach ($userselect as $row) {
                                        $booksstr = $row['books'];
                                    }
                                }
                                $booksarr = explode(" ", $booksstr);
                                $setarr = array_diff($booksarr, array($return));
                                $setstr = implode(" ", $setarr);
                                $conn -> query("update user set books = '$setstr' where username = '$username';");
                                $conn -> query("update books set quantity = quantity+1 where bookid = '$return';");
                                echo "<script> location = location </script>";
                            }
                        }
                    ?>
                </div>
                <section id="takebooks-scroll"></section>
            </div>
            <h2 class="heading" align="center" id="takebooks-heading">Take Books</h2>
            <div class="operation" id="takebooks">
                <div class="table-con" id="takebooks-table-con">
                <?php
                        if($_SERVER['REQUEST_METHOD'] == "POST"){
                            if (isset($_POST['take'])){
                                $take = $_POST['take'];
                                $booksstr = "";
                                $userselect = $conn -> query("select * from user where username='$username';");
                                if ($userselect->num_rows != 0) {
                                    foreach ($userselect as $row) {
                                        $booksstr = $row['books'];
                                    }
                                }
                                $booksarr = explode(" ", $booksstr);
                                if (count($booksarr) > 5) {
                                    echo "<h3>Error: You can't take morethan 5 books</h3>";
                                }
                                else if (in_array($take, $booksarr)) {
                                    echo "<h3>Error: You have that book already</h3>";
                                }
                                else{
                                    array_push($booksarr, "$take");
                                    $setstr = implode(" ", $booksarr);
                                    echo $setstr . "<br>";
                                    $conn -> query("update user set books = '$setstr' where username = '$username';");
                                    $conn -> query("update books set quantity = quantity-1 where bookid = $take;");
                                    echo "<script> location = location </script>";
                                }
                            }
                        }
                    ?>

                    <table>
                            <tr>
                                <th>Bookid</th>
                                <th>Book name</th>
                                <th>Availability</th>
                                <th>Action</th>
                            </tr>
                            <?php
                                foreach ($booksselect as $book) {
                            ?>
                                    <tr>
                                    <td>
                                        <?php echo $book['bookid']; ?>
                                    </td>
                                    <td>
                                        <?php echo $book['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $book['quantity']; ?>
                                    </td>
                                    <td>
                                    <form action="verifieduser.php?username=<?php echo $username; ?>" method="POST">
                                        <input class="ip" type="text" name="take" value="<?php echo $book['bookid']; ?>">
                                        <input type="submit" name="submit" value="Request">
                                    </form>
                                    </td>
                                </tr>
                                <?php } ?>
                    </table>
                    
                    </div>
            </div>
        </div>
    </div>

</body>
</html>