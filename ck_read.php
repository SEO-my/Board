<?php
    include $_SERVER['DOCUMENT_ROOT']."/1218Board/db/boarddb.php";
?>
<link rel="stylesheet" type="text/css" href="/1218Board/css/jquery-ui.css" />
<script type="text/javascript" src="/1218Board/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/1218Board/js/jquery-ui.js"></script>
<script type="text/javascript">
	$(function(){
		$("#writepass").dialog({
		 	modal:true,
		 	title:'秘密の文です。',
		 	width:400,
	 	});
	});
</script>
<?php

$bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
$sql = mq("select * from board where idx='".$bno."'"); /* 받아온 idx값을 선택 */
$board = $sql->fetch_array();

?>
<div id='writepass'>
	<form action="" method="post">
 		<p>暗証番号<input type="password" name="pw_chk" /> <input type="submit" value="確認" /></p>
 	</form>
</div>
	 <?php
	 	$bpw = $board['pw'];

         if(isset($_POST['pw_chk'])) //만약 pw_chk POST값이 있다면
	 	{
	 		$pwk = $_POST['pw_chk']; // $pwk변수에 POST값으로 받은 pw_chk를 넣습니다.
			if(password_verify($pwk,$bpw)) //다시 if문으로 DB의 pw와 입력하여 받아온 bpw와 값이 같은지 비교를 하고
			{
				$pwk == $bpw;
			?>
				<script type="text/javascript">location.replace("read.php?idx=<?php echo $board["idx"]; ?>");</script><!-- pwk와 bpw값이 같으면 read.php로 보내고 -->
			<?php 
            } else { 
            ?>
                <script type="text/javascript">alert('暗証番号違います');</script>
            <?php    
            }
        }   ?>