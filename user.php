<!DOCTYPE html>
<html lang="en">

<head>
    <title>User</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=EB+Garamond&family=El+Messiri&family=Karma&family=Montserrat+Alternates&family=Poppins:wght@200;400&display=swap");

        * {
            font-family: "Poppins", sans-serif;
            margin: 0px;
            padding: 0px;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #222327;
            color: white;
        }
    </style>
</head>

<body>
        <?php
            $username = $_POST['user-name'];
            $password = $_POST['user-pass'];
            $conn = new mysqli('localhost','root', '', 'LMS-PROJ');
            $userarr = [];
            $requestarr = [];
            $userselect = $conn -> query("select * from user");
            $reqselect = $conn -> query("select * from request");
            // if ($reqselect->num_rows != 0) {
            //     foreach ($reqselect as $row) {
            //         foreach ($row as $key => $value) {
            //             echo $key . '----->' . $value . '<br>';
            //         }
            //     }
            // }
            // else {
            //     echo 'Request table is empty';
            // }

            if ($userselect->num_rows != 0) {
                foreach ($userselect as $row) {
                    array_push($userarr, $row['username']);
                }
            }
            if (in_array($username, $userarr)) {
                $selectpass = $conn -> query("select * from user where username = '$username';");
                foreach ($selectpass as $row) {
                    $userpassword = $row['password'];
                }
                if ($userpassword != $password) {
                    echo "Wrong password entered for user -> $username" . "<br>";
                    echo "Please contact the lab incharge to reset your account";
                }
                else {
                    echo "<script> window.location.href = 'verifieduser.php?username=$username'</script>";
                }
            }
            else {
                if ($reqselect->num_rows != 0) {
                    foreach ($reqselect as $row) {
                        array_push($requestarr, $row['username']);
                    }
                }
                if (in_array($username, $requestarr)) {
                    echo $username . ' already requested for access. <br> Please get verified to access the library.';
                }
                else {
                    $conn -> query("insert into request values ('$username', '$password');");
                    echo 'Requested access for user -> ' . $username;
                }
            }
        ?>
</body>

</html>