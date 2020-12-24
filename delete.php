<?php
    include $_SERVER['DOCUMENT_ROOT']."/1218Board/db/boarddb.php";

    $bno = $_GET['idx'];
    $sql = mq("delete from board where idx='$bno';");
?>
<script type="text/javascript">alert("削除しました。");</script>
<meta http-equiv="refresh" content="0 url=/1218Board" />