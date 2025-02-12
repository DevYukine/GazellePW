<?
/*
 * Common header linkbox for Reports v2
 */
?>
<div class="BodyNavLinks thin">
    <a href="reportsv2.php" class="brackets"><?= Lang::get('reportsv2', 'views') ?></a>
    <a href="reportsv2.php?action=new" class="brackets"><?= Lang::get('reportsv2', 'new_auto_assigned') ?></a>
    <a href="reportsv2.php?view=unauto" class="brackets"><?= Lang::get('reportsv2', 'new_un_auto') ?></a>
    <a href="reportsv2.php?view=staff&amp;id=<?= $LoggedUser['ID'] ?>" class="brackets"><?= Lang::get('reportsv2', 'view_your_claimed_reports') ?></a>
    <a href="reportsv2.php?view=resolved" class="brackets"><?= Lang::get('reportsv2', 'view_old_reports') ?></a>
    <a href="reportsv2.php?action=search" class="brackets"><?= Lang::get('reportsv2', 'search_reports') ?></a>
</div>