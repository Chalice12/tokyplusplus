<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/api/toky.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/api/stupid.php');
if (!isset($_COOKIE["toky_cookie"]) || $_COOKIE["toky_cookie"] == "") {
	set_auth_cookies();
}
if (!isset($_COOKIE["theme"]) || $_COOKIE["theme"] == "") {
	setcookie("theme", "default", time() + (86400 * 365), "/");
	$_COOKIE["theme"] = "default";
}
if (!isset($_COOKIE["version"]) || $_COOKIE["version"] != "1.2") {
	setcookie("version", "1.2", time() + (86400 * 365), "/");
	$_COOKIE["version"] = "1.2";
	echo "<script>window.location.href = '/news/';</script>";
	die();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>TOKY++ web edishun</title>
<link rel="stylesheet" href="/css/normalize.css">
<?php
switch ($_COOKIE["theme"]) {
	case "default":
		include_once($_SERVER['DOCUMENT_ROOT'].'/include/theme_default.php');
		break;
	case "material":
		include_once($_SERVER['DOCUMENT_ROOT'].'/include/theme_material.php');
		break;
	default:
		include_once($_SERVER['DOCUMENT_ROOT'].'/include/theme_default.php');
}
if (is_phone($_SERVER['HTTP_USER_AGENT']) == "true") {
	echo "<style>".file_get_contents($_SERVER['DOCUMENT_ROOT'].'/css/phone_patch.css')."</style>";
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="icon" type="image/png" href="meta/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="meta/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="meta/favicon-96x96.png" sizes="96x96">
</head>
<body>
<header>
	<a href="/ask/" class="menuitem <?php if (isset($menu) && $menu =="ask") echo "menusel"; ?>"><div>
		<span>ask</span>
	</div></a>
	<a href="/answer/" class="menuitem <?php if (isset($menu) && $menu =="answer") echo "menusel"; ?>"><div>
		<span>answer</span>
	</div></a>
	<a href="/list/" class="menuitem <?php if (isset($menu) && $menu =="list") echo "menusel"; ?>"><div>
		<span>list</span>
	</div></a>
	<a href="/inbox/" class="menuitem <?php if (isset($menu) && $menu =="inbox") echo "menusel"; ?>"><div>
		<span>inbox</span>
	</div></a>
	<a href="/settings/" class="menuitem <?php if (isset($menu) && $menu =="settings") echo "menusel"; ?>"><div>
		<span>settings</span>
	</div></a>
</header>
<main>
