<?php include $_SERVER['DOCUMENT_ROOT']."/1218Board/db/boarddb.php"; ?>
<!doctype html>
<head>
<meta charset="UTF-8">
<title>掲示板</title>
<link rel="stylesheet" type="text/css" href="/1218Board/css/style.css" />
</head>
<body>
<div id="board_area">
  <h1>自由掲示板</h1>
  <h4>自由に入力してください。</h4>
<div id="search_box">
    <form action="/1218Board/search_result.php" method="GET">
    <select name="catgo">
        <option value="title">題目</option>
        <option value="name">著書</option>
        <option value="content">内容</option>
    </select>
    <input type="text" name="search" size="40" required="required" /> <button>検索</button>
</form>
</div>
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
      if(isset($_GET['page'])){
        $page = $_GET['page'];
          }else{
            $page = 1;
          }
            $sql = mq("select * from board");
            $row_num = mysqli_num_rows($sql); //게시판 총 레코드 수
            $list = 5; //한 페이지에 보여줄 개수
            $block_ct = 5; //블록당 보여줄 페이지 개수

            $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
            $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
            $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

            $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
            if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
            $total_block = ceil($total_page/$block_ct); //블럭 총 개수
            $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

        $sql2 = mq("select * from board order by idx desc limit $start_num, $list");
            while($board = $sql2->fetch_array())
            {
                $title=$board["title"];
                if(strlen($title)>30)
                {
                    $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
                }
                //댓글 수 카운트
                $sql3 = mq("select * from reply where con_num='".$board['idx']."'");
                $rep_count = mysqli_num_rows($sql3);
             ?>
       
        <tbody>
            <tr>
                <td width="70"><?php echo $board['idx']; ?></td>
                <td width="500"><?php
                    $lockimg = "<img src='/1218Board/img/lock.png' alt='lock' title='lock' with='20' height='20' />";
                    if($board['lock_post']=="1")
                        { ?>
                            <a href='/1218Board/ck_read.php?idx=<?php echo $board["idx"];?>'><?php echo $title, $lockimg;
                        } else {
                            $boardtime = $board['date'];
                            $timenow = date("Y-m-d");
                        
                        if($boardtime == $timenow){
                            $img = "<img src='/1218Board/img/new.png' alt='new' title='new' />"; 
                        } else {
                            $img ="";
                        } ?>
                        <a href='/1218Board/read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title; }?>
                        <span class="re_ct">[<?php echo $rep_count; ?>]<?php echo $img; ?></span></a>
                </td>
                <td width="120"><?php echo $board['name']; ?></td>
                <td width="100"><?php echo $board['date']; ?></td>
                <td width="100"><?php echo $board['hit']; ?></td>
            </tr>
        </tbody>
            <?php } ?>
        </table>
        <!-- 페이징 넘버 -->
        <div id="page_num">
            <ul>
            <?php 
                if($page <= 1)
                {
                    echo "<li class='fo_re'>最初</li>";
                } else {
                    echo "<li><a href='?page=1'>最初</a></li>";
                }
                if($page <= 1){

                } else {
                    $pre = $page-1;
                    echo "<li><a href='?page=$pre'>以前</a></li>";
                }
                for($i=$block_start; $i<=$block_end; $i++){
                    if($page == $i) {
                        echo "<li class='fo_re'>[$i]</li>";
                    } else {
                        echo "<li><a href='?page=$i'>[$i]</a></li>";
                    }
                }
                if($block_num >= $total_block) {

                } else {
                    $next = $page + 1;
                    echo "<li><a href='?page=$next'>次に</a></li>";
                }

                if($page >= $total_page) {
                    echo "<li class='fo_re'>最後</li>";
                } else {
                    echo "<li><a href='?page=$total_page'>最後</a></li>";
                } ?>
            </ul>
        </div>
        <div id="write_btn">
            <a href="/1218Board/writer.php"><button>書く</button></a>
        </div>
    </div>
</body>
</html>
        