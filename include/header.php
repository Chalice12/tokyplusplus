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
if (!isset($_COOKIE["version"]) || $_COOKIE["version"] != "1.0.1") {
	setcookie("version", "1.0.1", time() + (86400 * 365), "/");
	$_COOKIE["version"] = "1.0.1";
	echo "<script>window.location.href = '/news/';</script>";
	die();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>TOKY++ web edishun</title>
<link rel="stylesheet" href="/css/normalize.css">
<style><?php echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/css/main.css'); ?></style>
<style><?php if (@$_COOKIE["dark"] == "true") echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/css/dark.css'); ?></style>
<style>
@media (prefers-color-scheme: dark) {
<?php echo file_get_contents($_SERVER['DOCUMENT_ROOT'].'/css/dark.css'); ?>
p#darkmodep::after {
    content: 'System-wide dark mode enabled, so you cannot disable it from here.';
}
#darkmode {
	display: none;
}
}
</style>
<?php
if (is_phone($_SERVER['HTTP_USER_AGENT']) == "true") {
	echo "<style>".file_get_contents($_SERVER['DOCUMENT_ROOT'].'/css/phone_patch.css')."</style>";
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
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
