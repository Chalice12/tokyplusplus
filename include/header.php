<?php
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"], true, 301);
    exit;
}

include_once($_SERVER['DOCUMENT_ROOT'].'/api/toky.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/api/stupid.php');
if (!isset($_COOKIE["toky_cookie"]) || $_COOKIE["toky_cookie"] == "") {
	set_auth_cookies();
}
if (!isset($_COOKIE["theme"]) || $_COOKIE["theme"] == "") {
	setcookie("theme", "default", time() + (86400 * 365), "/");
	$_COOKIE["theme"] = "default";
}
if (!isset($_COOKIE["version"]) || $_COOKIE["version"] != "1.2.1") {
	setcookie("version", "1.2.1", time() + (86400 * 365), "/");
	$_COOKIE["version"] = "1.2.1";
	echo "<script>window.location.href = '/news/';</script>";
	die();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>TOKY++ web edishun</title>
<link rel="stylesheet" href="/css/normalize.css">
<meta name="apple-mobile-web-app-title" content="toky++"> <!-- why . . . doesnt this stuff last when you click a button or smth? -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<?php
switch ($_COOKIE["theme"]) {
	case "default":
		include_once($_SERVER['DOCUMENT_ROOT'].'/include/theme_default.php');
		break;
	case "material":
		include_once($_SERVER['DOCUMENT_ROOT'].'/include/theme_material.php');
		break;
	case "contrast":
		include_once($_SERVER['DOCUMENT_ROOT'].'/include/theme_contrast.php');
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
<link rel="icon" type="image/png" href="/meta/favicon-16x16.png" sizes="16x16">
<link rel="icon" type="image/png" href="/meta/favicon-32x32.png" sizes="32x32">
<link rel="icon" type="image/png" href="/meta/favicon-96x96.png" sizes="96x96">
<link rel="apple-touch-icon" href="/meta/ios/ios-appicon-1024-1024.png" />
<link rel="apple-touch-icon" sizes="57x57" href="/meta/ios/touchicon-57-57.png" />
<link rel="apple-touch-icon" sizes="76x76" href="/meta/ios/ios-appicon-76-76.png" />
<link rel="apple-touch-icon" sizes="114x114" href="/meta/ios/touchicon-114-114.png" />
<link rel="apple-touch-icon" sizes="120x120" href="/meta/ios/touchicon-120-120.png" />
<link rel="apple-touch-icon" sizes="144x144" href="/meta/ios/touchicon-144-144.png" />
<link rel="apple-touch-icon" sizes="152x152" href="/meta/ios/ios-appicon-152-152.png" />
<link rel="apple-touch-icon" sizes="180x180" href="/meta/ios/ios-appicon-180-180.png" />
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
