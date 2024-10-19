<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>ユーザー登録</title>
</head>
<body>
    <!-- /// ヘッダー領域 /// -->
    <section class="disclaimer_header">
        <!-- WDSアイコンパーツ -->
        <div class="WDS_icon">
            <a href="https://www.weatherdatascience.tokyo/" target="_blank" rel="noopener noreferrer">
                <img src="img/WDSlogo.png" alt="WeahterDataScience_logo">
            </a>
        </div>
    </section>

<!-- Main[Start] -->
    <form method="post" action="user_insert.php">
    <div class="jumbotron">
        <center>  
            <h1 class="login-title">ユーザー登録</h1>
            <label>事業者名：<input type="text" name="name"></label><br>
            <br>
            <label>Login ID：<input type="text" name="lid"></label><br>
            <br>
            <label>Login PW：<input type="text" name="lpw"></label><br>
            <br>
            <label>管理FLG：
            一般<input type="radio" name="kanri_flg" value="0">
            管理者<input type="radio" name="kanri_flg" value="1">
            </label>
            <br>
            <!-- <label>退会FLG：<input type="text" name="life_flg"></label><br> -->
            <button type="submit">登録</button>
        </center>
    </div>
    </form>
<!-- Main[End] -->
   
</body>
</html>