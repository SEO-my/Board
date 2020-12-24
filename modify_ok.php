<?php
include $_SERVER['DOCUMENT_ROOT']."/1218Board/db/boarddb.php";

$bno = $_GET['idx'];
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$sql = mq("update board set name='".$username."',pw='".$userpw."',title='".$title."',content='".$content."' where idx='".$bno."'"); ?>

<script type="text/javascript">alert("修訂しました。"); </script>
<meta http-equiv="refresh" content="0 url=/1218Board/read.php?idx=<?php echo $bno; ?>">