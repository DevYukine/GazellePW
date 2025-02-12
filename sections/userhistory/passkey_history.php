<?

/************************************************************************
||------------|| User passkey history page ||--------------------------||

This page lists previous passkeys a user has used on the site. It gets
called if $_GET['action'] == 'passkey'.

It also requires $_GET['userid'] in order to get the data for the correct
user.

 ************************************************************************/

$UserID = $_GET['userid'];
if (!is_number($UserID)) {
    error(404);
}

$DB->query("
	SELECT
		um.Username,
		p.Level AS Class
	FROM users_main AS um
		LEFT JOIN permissions AS p ON p.ID = um.PermissionID
	WHERE um.ID = $UserID");
list($Username, $Class) = $DB->next_record();

if (!check_perms('users_view_keys', $Class)) {
    error(403);
}

View::show_header(Lang::get('userhistory', 'passkey_history_for_before') . "$Username" . Lang::get('userhistory', 'passkey_history_for_after'), '', 'PageUserHistoryPasskey');

$DB->query("
	SELECT
		OldPassKey,
		NewPassKey,
		ChangeTime,
		ChangerIP
	FROM users_history_passkeys
	WHERE UserID = $UserID
	ORDER BY ChangeTime DESC");

?>
<div class="BodyHeader">
    <h2 class="BodyHeader-nav"><?= Lang::get('userhistory', 'passkey_history_for_before') ?><a href="/user.php?id=<?= $UserID ?>"><?= $Username ?></a><?= Lang::get('userhistory', 'passkey_history_for_after') ?></h2>
</div>
<div class="TableContainer">
    <table class="TableUserPasskeyHihstory Table">
        <tr class="Table-rowHeader">
            <td class="Table-cell"><?= Lang::get('userhistory', 'old') ?></td>
            <td class="Table-cell"><?= Lang::get('userhistory', 'new') ?></td>
            <td class="Table-cell"><?= Lang::get('userhistory', 'changed') ?></td>
            <td class="Table-cell">IP <a href="/userhistory.php?action=ips&amp;userid=<?= $UserID ?>" class="brackets">H</a></td>
        </tr>
        <? while (list($OldPassKey, $NewPassKey, $ChangeTime, $ChangerIP) = $DB->next_record()) { ?>
            <tr class="Table-row">
                <td class="Table-cell"><?= display_str($OldPassKey) ?></td>
                <td class="Table-cell"><?= display_str($NewPassKey) ?></td>
                <td class="Table-cell"><?= time_diff($ChangeTime) ?></td>
                <td class="Table-cell"><?= display_str($ChangerIP) ?> <a href="user.php?action=search&amp;ip_history=on&amp;ip=<?= display_str($ChangerIP) ?>" class="brackets" data-tooltip="Search">S</a><br /><?= display_str(Tools::get_host_by_ip($ChangerIP)) ?></td>
            </tr>
        <? } ?>
    </table>
</div>
<? View::show_footer(); ?>