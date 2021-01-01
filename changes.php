<?php

include 'app\connection.php';

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
