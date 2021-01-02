<?php
if (isset($_POST["block"]) && @$_POST["words"] == "") {
	setcookie("blocklist", @$_COOKIE["blocklist"].",".$_GET["uid"], time() + (86400 * 365), "/");
	echo "<script>window.location = '/';</script>";
}

$menu = "answer";
include_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/api/stupid.php');

if (isset($_POST["skip"])) {
	skip_question($_GET["who"]);
}

if (isset($_POST["words"])) {
	reply_question($_POST["words"], $_GET["who"]);
}

$questions = get_question();

if (@$_COOKIE["debug"] == "true") {
echo "<pre class='debuginfo'>";
echo var_dump($questions);
echo "</pre>" ;
}

$ok = true;
foreach (explode(",", @$_COOKIE["blocklist"]) as $swag) {
	if ($questions["user"]["id"] == $swag) {
		$ok = false;
	}
}
if ($ok == false) {
	echo "question from blocked user, please press skip!";
} else if ($value["userUserAgent"] == "dickinyourass") {
	echo "Likely spam auto-blocked, please press skip!";
} else {
echo "<div id='chat_container' style='flex-direction: column; overflow-y: unset;'>";
echo "<div class='listquestion'>";
echo "<div class='listquestionuser'><span>";
    echo $questions["user"]["nickname"] == "" ? "Anon <span style='font-weight: 300; font-size: 0.7rem;'>" . $questions["user"]["id"] . "</span>" : $questions["user"]["nickname"];
	$time = date_parse($questions["date"]);
	echo "</span><span>". substr($time["year"],2) . "-" . str_pad($time["month"], 2, "0", STR_PAD_LEFT) . "-" . str_pad($time["day"], 2, "0", STR_PAD_LEFT) . " " . str_pad($time["hour"], 2, "0", STR_PAD_LEFT) . ":" . str_pad($time["minute"], 2, "0", STR_PAD_LEFT) ." UTC</span>";
echo "</div>";
echo "<div class='listquestiontext'><p>". $questions["text"] ."</p></div>";
echo "<div class='listquestionetc'>";
    echo "<span>question no. " . $questions["id"] . " - </span>";
	echo "<span>" . ($questions["user"]["isOnline"] == true ? "<span style='color: lightgreen;'>user online</span>" : "<span style='color: lightcoral';>user offline</span>") . " - </span>";
	echo "<span>" . $questions["deviceType"] . ", ";
	    echo get_operating_system($questions["userUserAgent"]);
	echo "</span>";
echo "</div>";
echo "</div>";
if (isset($_POST["words"]) && !isset($_POST["skip"])) {
	echo "<p style='text-align: center;'><a href='/inbox/'>Sent! Click here to go to your inbox, or carry on answering...</a></p>";
}
echo "</div>";
}
?>

<div id="chat_reply">
	<form action="/answer/?who=<?php echo $questions["id"]; ?>" method="post">
		<button style="width: 6rem;" formnovalidate name="skip">skip</button>
		<input type="text" name="words" required style="width: calc(100% - 14rem);" placeholder="answer" autocomplete="off"></input>
		<input type="submit"></input>
	</form>
</div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
?>
