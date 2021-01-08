<div class="alert alert-dark video-list">
<?php 
    $q = $pdo->query("select * from plan_video order by ORDER_NUM")->fetchAll();
    foreach ($q as $row) {
?>
    <a class="video-list-item" href="#">
        <img src="img/cams/<?php print($row['ID']); ?>.png">
    </a>
<?php
    }
?>
</div>