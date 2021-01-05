<div class="list-group" style="width: 40rem;">
<?php

$sql = "select v.* ".
       "  from core_variables v ".
       " where APP_CONTROL > 0 ".
       " order by v.COMM";

$ls = $pdo->query($sql)->fetchAll();

foreach ($ls as $row) {
    $c = decodeAppControl($row['APP_CONTROL']);
    
?>   
    <div class="list-group-item checked-edit-item">
        <div class="checked-edit-item-label">
            <?php print($c['label']); ?>
            <?php print($row['COMM']); ?>
        </div>
        <div class="checked-edit-item-edit">
            <a class="checked-edit-item-edit-a" id="add_<?php print($row['ID']); ?>" href="#">ДОБАВИТЬ</a>
        </div>
    </div>
<?php  
}
?>
</div>


<script>
    $('document').ready(() => {
        $('.checked-edit-item-edit-a').on('click', (e) => {
            e.preventDefault();
            
            let id = $(e.target).attr('id').substr(4);
            
            $(e.target).hide();
        });
    });
</script>