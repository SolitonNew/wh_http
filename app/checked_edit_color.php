<div style="width: 40rem;">
    <div class="alert alert-dark" style="display:flex;margin-bottom:1rem;">
        <input id="keyword" type="text" class="form-control" value="" style="flex-grow:1;margin-right:1rem;">
        <input id="color" type="text" class="form-control" value="" style="width:10rem;margin-right:1rem;">
        <a id="btn_add" href="#" class="btn btn-primary">ДОБАВИТЬ</a>
        <a id="btn_set" href="#" class="btn btn-primary" style="margin-left:1rem;">ОБНОВИТЬ</a>
    </div>

    <div class="list-group">
<?php
        $q = $pdo->query("select VALUE from core_propertys where NAME = 'WEB_COLOR'")->fetchAll();
        if (count($q)) {
            $a = json_decode($q[0]['VALUE'], true);
            if (count($a)) {
                foreach ($a as $row) {
?>
        <div class="list-group-item" style="display:flex;align-items: center;">
            <a class="set_keyword" style="flex-grow: 1;" href="#"><?php print($row['keyword']); ?></a>
            <a class="set_color" style="width: 10rem;" href="#"><?php print($row['color']); ?></a>
            <a class="btn btn-primary btn-sm btn_del" href="#" data="<?php print($row['keyword']); ?>" >УДАЛИТЬ</a>
        </div>
<?php
                } 
            }
        }

?>        
    </div>
</div>

<script>
    $('document').ready(() => {
        $('#btn_add').on('click', (e) => {
            e.preventDefault();
            if ($('#keyword').val()) {
                $.post({
                    method: 'POST',
                    url: 'api.php',
                    data: {
                        page: 'checked_color',
                        action: 'add',
                        keyword: $('#keyword').val(),
                        color: $('#color').val(),
                    }
                }).done((res) => {
                    window.location.reload();
                });
            }
        });
        
        $('#btn_set').on('click', (e) => {
            e.preventDefault();
            if ($('#keyword').val()) {
                $.post({
                    method: 'POST',
                    url: 'api.php',
                    data: {
                        page: 'checked_color',
                        action: 'set',
                        keyword: $('#keyword').val(),
                        color: $('#color').val(),
                    }
                }).done((res) => {
                    window.location.reload();
                });
            }
        });
        
        $('.btn_del').on('click', (e) => {
            e.preventDefault();
            $.post({
                method: 'POST',
                url: 'api.php',
                data: {
                    page: 'checked_color',
                    action: 'del',
                    keyword: $(e.target).attr('data'),
                }
            }).done((res) => {
                window.location.reload();
            });            
        });
        
        $('.set_keyword').on('click', (e) => {
            e.preventDefault();
            $('#keyword').val($(e.target).text());
            $('#color').val($(e.target).next().text());
        });

        $('.set_color').on('click', (e) => {
            e.preventDefault();
            $('#color').val($(e.target).text());
            $('#keyword').val($(e.target).prev().text());
        });        
    });
    
</script>