<?php


include $_SERVER['DOCUMENT_ROOT']."/1218Board/db/boarddb.php";
$date = date('Y-m-d');
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);


if(isset($_POST['lockpost'])){
	$lo_post = '1';
}else{
	$lo_post = '0';
}

$tmpfile =  $_FILES['b_file']['tmp_name'];
$o_name = $_FILES['b_file']['name'];
$filename = iconv("UTF-8", "EUC-JP",$_FILES['b_file']['name']);
$folder = "upload/".$filename;
move_uploaded_file($tmpfile,$folder);

$mqq = mq("alter table board auto_increment =1"); //auto_increment 값 초기화

$sql= mq("insert into board(name,pw,title,content,date,lock_post,file) values('".$_POST['name']."','".$userpw."','".$_POST['title']."','".$_POST['content']."','".$date."','".$lo_post."','".$o_name."')");
echo "<script>alert('書き込みを完了しました。');</script>";
?>
<meta http-equiv="refresh" content="0 url=/1218Board" />