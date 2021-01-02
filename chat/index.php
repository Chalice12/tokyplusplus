<?php
$menu = "inbox";
include_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');

if (!isset($_GET["who"])) {
echo "error!";
die();
}

if (isset($_POST["words"])) {
	echo send_chat($_POST["words"], $_GET["who"]);
}

$questions = get_chat($_GET["who"]);

if (@$_COOKIE["debug"] == "true") {
echo "<pre class='debuginfo'>";
echo var_dump($questions);
echo "</pre>" ;
}

echo '<div id="chat_container">';

$user1 = $questions[0]["user"]["id"];
$user2 = $questions[1]["user"]["id"];

foreach ($questions as $key => $value) {
	echo "<div class='listquestion ". ($value["user"]["id"] == $user1 ? "listquestionaltbg" : "") ."'>";
	echo "<div class='listquestionuser'><span>";
	    echo $value["user"]["nickname"] == "" ? "Anon <span style='font-weight: 300; font-size: 0.7rem;'>" . $value["user"]["id"] . "</span>" : $value["user"]["nickname"];
		$time = date_parse($value["date"]);
		echo "</span><span>". substr($time["year"],2) . "-" . str_pad($time["month"], 2, "0", STR_PAD_LEFT) . "-" . str_pad($time["day"], 2, "0", STR_PAD_LEFT) . " " . str_pad($time["hour"], 2, "0", STR_PAD_LEFT) . ":" . str_pad($time["minute"], 2, "0", STR_PAD_LEFT) ." UTC</span>";
	echo "</div>";
	echo "<div class='listquestiontext'><p>". htmlspecialchars($value["text"]) ."</p></div>";
	echo "<div class='listquestionetc'>";
	    echo "<span>reply id. " . $value["id"] . " - </span>";
		echo "<span>" . ($value["user"]["isOnline"] == true ? "<span style='color: lightgreen;'>user online</span>" : "<span style='color: lightcoral';>user offline</span>") . "</span>";
	echo "</div>";
	echo "</div>";
}

echo '</div>';

?>

<div id="chat_reply">
	<form action="/chat/?who=<?php echo $_GET["who"]; ?>" method="post">
		<input type="text" name="words" required autocomplete="off"></input>
		<input type="submit" value="Send!"></input>
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
