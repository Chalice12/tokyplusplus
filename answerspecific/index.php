<?php
$menu = "list";
include_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');
include_once($_SERVER['DOCUMENT_ROOT'].'/api/stupid.php');

if (isset($_POST["words"])) {
	reply_question($_POST["words"], $_GET["num"]);
}

echo "<div id='chat_container' style='flex-direction: column; overflow-y: unset;'>";
echo "<div class='listquestion'>";
echo "<div class='listquestionuser'><span>";
	echo @$_GET["nickname"] == "" ? "Anon" : @$_GET["nickname"];
	echo "<span style='font-weight: 300; font-size: 0.7rem;'> " . @$_GET["id"] . (@$_GET["id"] == "33498" ? " ☆" : "") . "</span>";
	@$time = date_parse($_GET["date"]);
	echo "</span><span>". substr($time["year"],2) . "-" . str_pad($time["month"], 2, "0", STR_PAD_LEFT) . "-" . str_pad($time["day"], 2, "0", STR_PAD_LEFT) . " " . str_pad($time["hour"], 2, "0", STR_PAD_LEFT) . ":" . str_pad($time["minute"], 2, "0", STR_PAD_LEFT) ." UTC</span>";
echo "</div>";
echo "<div class='listquestiontext'><p>". htmlspecialchars($_GET["text"]) ."</p></div>";
echo "<div class='listquestionetc'>";
    echo "<span>question no. " . @$_GET["qid"] . " - specific answer mode, less info provided... sorry :(</span>";
echo "</div>";
echo "</div>";
if (isset($_POST["words"]) && !isset($_POST["skip"])) {
	echo "<p style='text-align: center;'><a href='/inbox/'>Sent! Click here to go to your inbox, or carry on answering...</a></p>";
}
echo "</div>";

?>

<div id="chat_reply">
	<form action="/answer/?who=<?php echo $_GET["num"]; ?>&uid=<?php echo $_GET["id"]; ?>" method="post">
		<button style="width: 6rem;" formnovalidate name="block">block</button>
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
