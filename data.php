<?php
    include 'connection.php';

    if (isset($_GET['id'])) {
        
    } else 
    if (isset($_POST['id'])) {
        $varID = (int)$_POST['id'];
        $varVal = (float)$_POST['value'];
        try {
            $pdo->query("CALL CORE_SET_VARIABLE($varID, $varVal, -1)");
        } catch (Exception $e) {
            print($e);
        }
    }