<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>掲示板</title>
<link rel="stylesheet" type="text/css" href="/1218Board/css/style.css" />
</head>
<body>
    <div id="board_write">
        <h1><a href="/">自由掲示板</a></h1>
        <h4>自由に書かれてください</h4>
            <div id="write_area">
                <form action="write_ok.php" method="post" enctype="multipart/form-data">
                    <div id="in_title">
                        <textarea name="title" id="utitle" rows="1" cols="55" placeholder="題目" maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_name">
                        <textarea name="name" id="uname" rows="1" cols="55" placeholder="著者"　maxlength="100" required></textarea>
                    </div>
                    <div class="wi_line"></div>
                    <div id="in_content">
                        <textarea name="content" id="ucontent" placeholder="内容" required></textarea>
                    </div>
                    <div id="in_pw">
                        <input type="password" name="pw" id="upw" placeholder="暗証番号" required />
                    </div>
                    <div id="in_lock">
                        <input type="checkbox" value="1" name="lockpost" />この分を閉じます。
                    </div>
                    <div id="in_file">
                        <input type="file" value="1" name="b_file" />
                    </div>
                    <div class="bt_se">
                        <button type="submit">文の作成</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
