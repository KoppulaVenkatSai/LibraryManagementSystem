<html>
<head>
    <title>Verifing Incharge</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Cookie&family=EB+Garamond&family=El+Messiri&family=Karma&family=Montserrat+Alternates&family=Poppins:wght@200;400&display=swap");

        * {
            font-family: "Poppins", sans-serif;
            margin: 0px;
            padding: 0px;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #222327;
            color: white;
            justify-content: center;
            align-items: center;
        }

        #container{
            display: none;
            /* display: flex; */
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: relative;
            width: 50vw;
            height: 50vh;

        }

        .loadingcon{
            position: absolute;
            animation: loadingscreen 5s linear forwards;
        }

        @keyframes loadingscreen{
            0%{
                opacity: 1;
            }
            99%{
                opacity: 1;
            }
            100%{
                opacity: 0;
            }
        }

        #loading{
            height: 5px;
            width: 500px;
            background-color: rgba(255, 255, 255, 0.25);
            border-radius: 20px;
        }
        #progress{
            height: 100%;
            width: 1%;
            border-radius: 20px;
            background-image: linear-gradient(90deg, red, orange, lightgreen);
            background-size: 400%;
            background-position: left;
            animation: progress 5s linear forwards;
            box-shadow: 0px 0px 5px red;
        }

        @keyframes progress {
            0%{
                width: 1%;
                background-position: left;
            }
            33%{
                box-shadow: 0px 0px 5px orange;
            }
            66%{
                box-shadow: 0px 0px 5px lightgreen;
            }
            90%{
                width: 90%;
                background-position: right;
            }
            100%{
                width: 90%;
                background-position: right;
            }
        }

        .errorcon{
            position: absolute;
            opacity: 0;
            animation: errorscreen 0s linear 5.1s forwards;
        }

        @keyframes errorscreen{
            to{
                opacity: 1;
            }
        }

        #heading{
            font-size: 10rem;
            background-image: linear-gradient(
                90deg,
                red,
                rgb(255, 128, 0),
                rgb(255, 225, 0),
                rgb(255, 57, 149),
                rgb(215, 57, 255),
                red
            );
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-size: 200%;
            animation: gradientflow 10s linear 0s infinite;
            opacity: 0;
        }

        @keyframes gradientflow{
            from{
                opacity: 1;
            }
            to{
                opacity: 1;
                background-position: 400% center;
            }
        }

        #para{
            font-size: 2rem;
            /* display: none; */
        }

        #loading-text{
            font-size: 2rem;
            display: block;
            /* display: none; */
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="container">
        <div class="loadingcon">
            <p id="loading-text">Loading...</p>
            <div id="loading">
                <div id="progress"></div>
            </div>
        </div>
        <div class="errorcon">
            <h2 id="heading">404</h2>
            <p id="para">Incharge not found</p>
        </div>
    </div>
    <?php
        $inchargename = $_POST['incharge-name'];
        $password = $_POST['incharge-pass'];
        $conn = new mysqli('localhost','root', '', 'LMS-PROJ');

        if (($inchargename == 'venky') and ($password == 'incharge')) {
            echo "<script> window.location.href = 'verifiedincharge.php';</script>";
        }
        else {
            echo "<script>document.getElementById('container').style.display = 'flex';</script>";
        }
    ?>
</body>

</html>