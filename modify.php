<!-- 掲示板修訂　-->
<?php 
    include $_SERVER['DOCUMENT_ROOT']."/1218Board/db/boarddb.php";

    $bno = $_GET['idx'];
    $sql = mq("select * from board where idx='$bno';");
    $board = $sql->fetch_array();
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>掲示板</title>
<link rel="stylesheet" href="/1218Board/css/style.css" />
</head>
<body>
    <div id="board_write">
        <h1><a href="/">自由掲示板</a></h1>
        <h4>分を修訂します。</h4>
            <div id="write_area">
                <form action="modify_ok.php?idx=<?php echo $bno; ?>" method="post">
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="55" placeholder="題目" maxlength="100" required><?php echo $board['title']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <textarea name="name" id="uname" rows="1" cols="55" placeholder="著者" maxlength="100" required><?php echo $board['name']; ?></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="ucontent" placeholder="内容"　required><?php echo $board['content']; ?></textarea>
                    </div>
                    <div id="in_pw">
                        <input type="password" name="pw" id="upw" placeholder="暗証番号" required />
                    </div>
                    <div class="bt_se">
                        <button type="submit">文の作成</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>