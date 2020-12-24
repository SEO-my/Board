<?php
    include $_SERVER['DOCUMENT_ROOT']."/1218Board/db/boarddb.php";
?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>掲示板</title>
<link rel="stylesheet" type="text/css" href="/1218Board/css/style.css" />
</head>
<body>
<div id="board_area">
<?php
    $catagory = $_GET['catgo'];
    $search_con = $_GET['search'];
?>
    <h1><?php echo $catagory; ?>で '<?php echo $search_con; ?>'検索結果</h1>
    <h4 style="margin-top:30px;"><a href="/1218Board">ホムへ</a></h4>
    <table class="list-table">
        <thead>
            <tr>
                <th width="70">番号</th>
                <th width="500">題目</th>
                <th width="120">著者</th>
                <th width="100">作成日</th>
                <th width="100">貯回</th>
            </tr>
        </thead>
        <?php
            $sql2 = mq("select * from board where $catagory like '%$search_con%' order by idx desc");
            while($board = $sql2->fetch_array()){

                $title=$board["title"];
                if(strlen($title)>30)
                {
                    $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                }
                $sql3 = mq("select * from reply where con_num='".$board['idx']."'");
                $rep_count = mysqli_num_rows($sql3);
        ?>
            <tbody>
                <tr>
                    <td width="70"><?php echo $board['idx']; ?></td>
                    <td width="500">
                        <?php
                        $lockimg = "<img src='/1218Board/img/lock.png' alt='lock' title='lock' with='20' height='20' />";
                        if($board['lock_post']=="1")
                        { ?><a href='/1218Board/ck_read.php?idx=<?php echo $board["idx"];?>'><?php echo $title, $lockimg;
                        } else { ?>
                    
                    <?php
                        $boardtime = $board['date'];
                        $timenow = date("Y-m-d");

                        if($boardtime==$timenow) {
                            $img = "<img src='/1218Board/img/new.png' alt='new' title='new' />";
                        } else {
                            $img ="";
                        } ?>

                    <a href='/page/board/read.php?idx=<?php echo $board["idx"]; ?>'>
                    <span style="background:yellow;"><?php echo $title; }?></span>
                    <span class="re_ct">[<?php echo $rep_count;?>]<?php echo $img; ?> </span></a></td>
                    <td width="120"><?php echo $board['name']?></td>
                    <td width="100"><?php echo $board['date']?></td>
                    <td width="100"><?php echo $board['hit']?></td>

                </tr>
            </tbody>

            <?php } ?>
    </table>
    <div id="search_box2">
        <form action="/1218Board/search_result.php" method="GET">
        <select name="catgo">
            <option value="title">題目</option>
            <option value="name">著者</option>
            <option value="content">内容</option>
        </select>
        <input type="text" name="search" size="40" required="required"/> <button>検索</button>
    </form>
    </div>
</div>
</body>
</html>