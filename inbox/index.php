<?php
$menu = "inbox";
include_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/api/stupid.php');

$page = "0";

if (isset($_GET["page"])) {
	$page = $_GET["page"];
}

$questions = get_chats($page);

if (@$_COOKIE["debug"] == "true") {
echo "<pre class='debuginfo'>";
echo var_dump($questions);
echo "</pre>" ;
}

?>

<style>
a {
color: var(--text);
text-decoration: none;
}
</style>
<?php

foreach ($questions as $key => $value) {
	$ok = true;
	foreach (explode(",", @$_COOKIE["blocklist"]) as $swag) {
		if ($value["users"][0]["id"] == $swag) {
			$ok = false;
		}
	}
	if ($ok == false) continue;
	echo "<a href='/chat/?who=".$value["id"]."'><div class='listquestion ". ($key % 2 == 0 ? "listquestionaltbg" : "") ."'>";
	echo "<div class='listquestionuser'><span>";
		echo $value["users"][0]["nickname"] == "" ? "Anon" : $value["users"][0]["nickname"];
		echo "<span style='font-weight: 300; font-size: 0.7rem;'> " . $value["users"][0]["id"] . "</span>";
		$time = date_parse($value["lastInteractionDate"]);
		echo "</span><span>". substr($time["year"],2) . "-" . str_pad($time["month"], 2, "0", STR_PAD_LEFT) . "-" . str_pad($time["day"], 2, "0", STR_PAD_LEFT) . " " . str_pad($time["hour"], 2, "0", STR_PAD_LEFT) . ":" . str_pad($time["minute"], 2, "0", STR_PAD_LEFT) ." UTC</span>";
	echo "</div>";
	echo "<div class='listquestiontext'><p style='margin-bottom: 0;'>your question: <b>". htmlspecialchars($value["title"]) ."</b></p></div>";
	echo "<div class='listquestiontext'><p style='margin-top: 0;'>latest answer: <b>". htmlspecialchars($value["lastChatText"]) ."</b></p></div>";
	echo "<div class='listquestionetc'>";
	    echo "<span>answer id. " . $value["answerId"] . " - </span>";
		echo "<span>" . ($value["users"][0]["isOnline"] == true ? "<span style='color: lightgreen;'>user online</span>" : "<span style='color: lightcoral';>user offline</span>") . "</span>";
	echo "</div>";
	echo "</div></a>";
}

echo "<div style='justify-content: space-around; max-width: 32rem; width: 100%; display: flex; margin: auto;'>";
if (isset($_GET["page"]) && $_GET["page"] != "0") {
	echo "<a href='/inbox?page=";
	echo (int) $page - 1;
	echo "'>Back one page</a>";
} else {
	echo "<a>Back no pages</a>";
}

echo "Page " . $page;

echo "<a href='/inbox?page=";
echo (int) $page + 1;
echo "'>Forward one page</a>";
echo "</div>";


include_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
?>