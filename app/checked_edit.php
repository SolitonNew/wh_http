<nav aria-label="breadcrumb">
    <ol class="row breadcrumb">
        <li class="breadcrumb-item"><a href="/"><?php print($MAIN_MENUS['main']); ?></a></li>
        <li class="breadcrumb-item"><a href="?page=checked"><?php print($MAIN_MENUS['checked']); ?></a></li>
        <li class="breadcrumb-item"><?php print($MAIN_MENUS['checked_edit']); ?></li>
    </ol>
</nav>

<?php
    $regime = 'add';
    if (isset($_GET['regime'])) {
        $regime = $_GET['regime'];
    }
?>

<div class="nav nav-tabs justify-content-center" style="margin-bottom: 1rem;">
    <div class="nav-item">
        <a href="?page=checked_edit&regime=add" class="nav-link <?php if ($regime == 'add') print('active'); ?>">ДОБАВИТЬ</a>
    </div>
    <div class="nav-item">
        <a href="?page=checked_edit&regime=order" class="nav-link <?php if ($regime == 'order') print('active'); ?>">ПОРЯДОК</a>
    </div>
</div>

<div class="justify-content-center" style="display: flex;">
<?php
    switch ($regime) {
        case 'add':
            include 'checked_edit_add.php';
            break;
        case 'order':
            include 'checked_edit_order.php';
            break;
    }
?>
</div>