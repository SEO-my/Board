<?php
    include $_SERVER['DOCUMENT_ROOT']."/1218Board/db/boarddb.php";


    $bno = $_GET['idx'];
    $userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
    
    if($bno && $_POST['dat_user'] && $userpw && $_POST['content']){
        $sql = mq("insert into reply(con_num,name,pw,content) values('".$bno."','".$_POST['dat_user']."','".$userpw."','".$_POST['content']."')");
        echo "<script>alert('コメントが書かれました。'); 
        location.href='/1218Board/read.php?idx=$bno';</script>";
    }else{
        echo "<script>alert( 'コメントがかかれないんです。'); 
        history.back();</script>";
    }
	
?>
