<?php
    include 'app/connection.php';
    
    $sql = 'select max(ID) MAX_ID from core_variable_changes_mem';
    $d = $pdo->query($sql)->fetchAll();
    $lastVariableID = -1;
    if (count($d) > 0) {
        $lastVariableID = $d[0]['MAX_ID'];
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>WISEHOUSE</title>
        <link rel="shortcut icon" href="favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css?v=0.0.17">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <script src="js/jquery-3.5.1.min.js"></script>
    </head>
<body>
    <div id="masterBody">
        <div id="masterMenu" class="bg-light">
            <a href="/" class="btn btn-light">
                <img src="img/spreadsheet-3x.png">
            </a>
            <a href="?page=choisen" class="btn btn-light">
                <img src="img/star-3x.png">
            </a>
        </div>
        <div id="masterContent">
            <div id="dummyNav"></div>
            <div id="mainContainer" class="container-fluid">
            <?php 
                include 'app/utils.php';
                include 'app/router.php'; 
            ?>
            </div>
        </div>
    </div>
    
<script>
    $('document').ready(() => {
        $('.custom-control-input').on('change', (e) => {
            let obj = $(e.target);
            varID = obj.attr('id').substr(9);
            if (obj.prop('checked')) {
                varVal = 1;
            } else {
                varVal = 0;
            }
            $.ajax({
                method: "POST",
                url: "data.php",
                data: {id: varID, value: varVal},
            }).done((data)=>{
                if (data) {
                    alert(data);
                }
            });
        });
        
        loadChanges();
        
        $(window).on('resize', () => {
            if ($('nav').length) {
                $('body').addClass('fixed-nav');
                $('#dummyNav').height($('nav').height());
            }
        }).resize();
        
        $(window).scroll(() => {
            if ($('nav').length) {
                if (this.pageYOffset > 5) {
                    $('body').addClass('fixed-nav-offset');
                } else {
                    $('body').removeClass('fixed-nav-offset');
                }
            }
        }).scroll();
    });
    
    let lastVariableID = <?php print($lastVariableID); ?>;
    
    function loadChanges() {
        $.ajax({url: 'changes.php?lastID=' + lastVariableID, 
        success: (data) => {           
            setTimeout(loadChanges, 500);
            
            if (data.substr(0, 9) == 'LAST_ID: ') {
                lastVariableID = data.substr(9);
                console.log('LAST_ID = ' + lastVariableID);
            } else {
                let values = JSON.parse(data);
                for (let i = 0; i < values.length; i++) {
                    let rec = values[i];
                    let varID = parseInt(rec.VARIABLE_ID);
                    let varValue = parseFloat(rec.VALUE);
                    let varTime = parseInt(rec.CHANGE_DATE);
                    lastVariableID = rec.ID;
                    
                    /* Call Event */
                    variableOnChanged(varID, varValue, varTime);
                    /* ---------- */
                }
            }
        }, 
        error: () => {
            setTimeout(loadChanges, 5000);
            console.log('ERROR');
        }});
    }
</script>
    
</body>
</html>