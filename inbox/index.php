<?php
$menu = "inbox";
include_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/api/stupid.php');
$questions = get_chats();

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
	    echo $value["users"][0]["nickname"] == "" ? "Anon <span style='font-weight: 300; font-size: 0.7rem;'>" . $value["users"][0]["id"] . "</span>" : $value["users"][0]["nickname"];
		$time = date_parse($value["lastInteractionDate"]);
		echo "</span><span>". substr($time["year"],2) . "-" . str_pad($time["month"], 2, "0", STR_PAD_LEFT) . "-" . str_pad($time["day"], 2, "0", STR_PAD_LEFT) . " " . str_pad($time["hour"], 2, "0", STR_PAD_LEFT) . ":" . str_pad($time["minute"], 2, "0", STR_PAD_LEFT) ." UTC</span>";
	echo "</div>";
	echo "<div class='listquestiontext'><p style='margin-bottom: 0;'>your question: <b>". $value["title"] ."</b></p></div>";
	echo "<div class='listquestiontext'><p style='margin-top: 0;'>latest answer: <b>". $value["lastChatText"] ."</b></p></div>";
	echo "<div class='listquestionetc'>";
	    echo "<span>answer id. " . $value["answerId"] . " - </span>";
		echo "<span>" . ($value["users"][0]["isOnline"] == true ? "<span style='color: lightgreen;'>user online</span>" : "<span style='color: lightcoral';>user offline</span>") . "</span>";
	echo "</div>";
	echo "</div></a>";
}

include_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
?>