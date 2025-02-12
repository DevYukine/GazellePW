<?
if (!ENABLE_SITEHISTORY) {
    error(404);
}
enforce_login();
if (!empty($_POST['action'])) {
    switch ($_POST['action']) {
        case 'take_create':
            include(SERVER_ROOT . '/sections/sitehistory/take_create.php');
            break;
        case 'take_edit':
            include(SERVER_ROOT . '/sections/sitehistory/take_edit.php');
            break;
        default:
            error(404);
            break;
    }
} elseif (!empty($_GET['action'])) {
    switch ($_GET['action']) {
        case 'search':
            include(SERVER_ROOT . '/sections/sitehistory/browse.php');
            break;
        case 'edit':
            include(SERVER_ROOT . '/sections/sitehistory/edit.php');
            break;
        default:
            error(404);
            break;
    }
} else {
    include(SERVER_ROOT . '/sections/sitehistory/browse.php');
}
