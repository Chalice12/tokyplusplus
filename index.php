<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/include/header.php');

echo "<div style='display: flex; flex-flow: column wrap; justify-content: center; align-items: center; height: calc(100vh - 10rem);'><h1>welcome to toky++, bitch</h1>";
echo "<p>get started by clicking one of items up there</p><p>known bugs:</p><ul><li>ask page does not reliably report whether the question was sent or not, double check on list page</li><li>past questions asked are ...sometimes... not saved</li><li>specific replies are wonky when you first reply to them</li><li>your full inbox is not shown if you have many messages</li></ul><p>upcoming features:</p><ul><li>message notifications</li><li>pwa support</li><li>(eventually) a native ios app so itll be tons faster and i wont get inevitably ip banned</li></ul><a href='https://gitlab.com/miniwa/tokyplusplus'>https://gitlab.com/miniwa/tokyplusplus</a></div>";

include_once($_SERVER['DOCUMENT_ROOT'].'/include/footer.php');
?>
