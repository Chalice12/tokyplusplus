<?php
$menu = "list";
include_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/api/stupid.php');
$questions = get_questions(isset($_GET["amount"]) ? $_GET["amount"] : 10, isset($_GET["page"]) ? $_GET["page"] : 0);

if (@$_COOKIE["debug"] == "true") {
echo "<pre class='debuginfo'>";
echo var_dump($questions);
echo "</pre>" ;
}

//nickname, date
//text
//id, userUserAgent, isonline?, answers or answerscount, hasanswered

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
		if ($value["user"]["id"] == $swag) {
			$ok = false;
		}
	}
	if ($value["userUserAgent"] == "dickinyourass") {
		echo "Likely spam auto-blocked";
		$ok = false;
	}
	if ($ok == false) continue;
	echo "<a href='/answerspecific/?num=".$value["id"]."&id=".$value["user"]["id"]."&text=".urlencode(htmlspecialchars($value["text"]))."&nickname=".$value["user"]["nickname"]."&date=".$value["date"]."&qid=".$value["id"]."'><div class='listquestion ". ($key % 2 == 0 ? "listquestionaltbg" : "") ."'>";
	echo "<div class='listquestionuser'><span>";
		echo $value["user"]["nickname"] == "" ? "Anon" : $value["user"]["nickname"];
		echo "<span style='font-weight: 300; font-size: 0.7rem;'> " . $value["user"]["id"] . ($value["user"]["id"] == "33498" ? " ☆" : "") . "</span>";
		$time = date_parse($value["date"]);
		echo "</span><span>". substr($time["year"],2) . "-" . str_pad($time["month"], 2, "0", STR_PAD_LEFT) . "-" . str_pad($time["day"], 2, "0", STR_PAD_LEFT) . " " . str_pad($time["hour"], 2, "0", STR_PAD_LEFT) . ":" . str_pad($time["minute"], 2, "0", STR_PAD_LEFT) ." UTC</span>";
	echo "</div>";
	echo "<div class='listquestiontext'><p>". htmlspecialchars($value["text"]) ."</p></div>";
	echo "<div class='listquestionetc'>";
	    echo "<span>question no. " . $value["id"] . " - </span>";
		echo "<span>" . ($value["user"]["isOnline"] == true ? "<span style='color: lightgreen;'>user online</span>" : "<span style='color: lightcoral';>user offline</span>") . " - </span>";
		echo "<span>" . $value["deviceType"] . ", ";
		    echo get_operating_system($value["userUserAgent"]);
		echo "</span>";
	echo "</div>";
	echo "</div></a>";
}
?>

<style>
.dumbasdf {
    display: flex;
	flex-flow: column wrap;
	align-items: center;
	text-align: center;
	justify-content: center;
}
.dumbasdf input {
	max-width: 5rem;
	width: 100%;
}
form {
	width: 15rem;
}
</style>
<div class="dumbasdf">
<p>Load more?</p>
<form action="/list/">
<div>Amount: <input style="margin-bottom: 0.2rem;" type="number" placeholder="10" value=10 min=1 max=50 name="amount"></div>
<div>Page: <input type="number" placeholder="0" value=0 min=0 name="page"></div>
<br>
<input type="submit" value="Go!">
</form>
</div>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
?>
