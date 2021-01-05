<?php

include 'app/connection.php';

$page = '';

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else
if (isset($_POST['page'])) {
    $page = $_POST['page'];
}

switch ($page) {
    case 'changes':
        if (isset($_GET['lastID']) && $_GET['lastID'] > -1) {
            $lastID = (int)$_GET['lastID'];
            $rows = $pdo->query("select c.ID, c.VARIABLE_ID, c.VALUE, UNIX_TIMESTAMP(c.CHANGE_DATE) * 1000 CHANGE_DATE ".
                                "  from core_variable_changes_mem c ".
                                " where c.ID > $lastID ".
                                " order by c.ID")->fetchAll();
            return print(json_encode($rows));
        } else {
            $d = $pdo->query('select max(ID) MAX_ID from core_variable_changes_mem')->fetchAll();
            if (count($d) > 0) {
                return print('LAST_ID: '.$d[0]['MAX_ID']);
            }
            return print('ERROR');
        }
        break;
    case 'data':
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
        break;
}