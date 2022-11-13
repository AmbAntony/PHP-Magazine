<?php
$tokenu = Functions::Filter($_GET['tokenu']);
$TEMP['#descode'] = Functions::Filter($_GET[$RUTE['#p_insert']]);
if ($TEMP['#loggedin'] === true || $TEMP['#settings']['verify_email'] == 'off' || empty($tokenu)) {
	header("Location: " . Functions::Url());
	exit();
}


$verify_email = $dba->query('SELECT user_id, expires, COUNT(*) as count FROM '.T_TOKEN.' WHERE verify_email = ?', $tokenu)->fetchArray();

$page = Functions::ValidateToken($verify_email['expires'], 'verify_email') || $verify_email['count'] == 0 || $dba->query('SELECT status FROM '.T_USER.' WHERE id = ?', $verify_email['user_id'])->fetchArray(true) == 'active' || (strlen($TEMP['#descode']) != 6 && !empty($TEMP['#descode'])) ? 'invalid-auth' : 'check-code';


$TEMP['title'] = $TEMP['#word']['check_your_email'];
$TEMP['type'] = 'verify_email';
$TEMP['token'] = $tokenu;
$TEMP['url'] = Functions::Url($RUTE['#r_verify_email']);
if(!empty($_GET[$RUTE['#p_insert']])){
	$TEMP['desone'] = substr($TEMP['#descode'], 0, 1);
	$TEMP['destwo'] = substr($TEMP['#descode'], 1, 1);
	$TEMP['desthree'] = substr($TEMP['#descode'], 2, 1);
	$TEMP['desfour'] = substr($TEMP['#descode'], 3, 1);
	$TEMP['desfive'] = substr($TEMP['#descode'], 4, 1);
	$TEMP['dessix'] = substr($TEMP['#descode'], 5, 1);
}

$TEMP['#page']        = 'verify-email';
$TEMP['#title']       = $TEMP['#word']['verify_your_account'] . ' - ' . $TEMP['#settings']['title'];
$TEMP['#description'] = $TEMP['#settings']['description'];
$TEMP['#keyword']     = $TEMP['#settings']['keyword'];
$TEMP['#content'] = Functions::Build("auth/{$page}/content");
?>