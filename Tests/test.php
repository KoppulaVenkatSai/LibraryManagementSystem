<?php                  
    $conn = new mysqli("localhost", "root", "", "LMS-PROJ");
    $conn -> query("update books set quantity = quantity+1 where bookid = 1001;");

?>