<?php
include $_SERVER['DOCUMENT_ROOT']."/1218Board/db/boarddb.php";
$rno = $_POST['rno']; 
$sql = mq("select * from reply where idx='".$rno."'");//reply테이블에서 idx가 rno변수에 저장된 값을 찾음
$reply = $sql->fetch_array();

$bno = $_POST['b_no'];
$sql2 = mq("select * from board where idx='".$bno."'");//board테이블에서 idx가 bno변수에 저장된 값을 찾음
$board = $sql2->fetch_array();

$pwk = $_POST['pw'];
$bpw = $reply['pw'];
if(password_verify($pwk, $bpw)) 
	{
		$sql = mq("delete from reply where idx='".$rno."'"); ?>
	<script type="text/javascript">alert('コメント削除しました。'); location.replace("read.php?idx=<?php echo $board["idx"]; ?>");</script>
	<?php 
	}else{ ?>
		<script type="text/javascript">alert('暗証番号が違います。');history.back();</script>
    <?php } ?>
?>
