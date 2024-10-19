<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
    <title>ログイン</title>

</head>
<body>

    <!-- /// ヘッダー領域 /// -->
    <section class="login_header">
        <!-- WDSアイコンパーツ -->
        <div class="WDS_icon">
            <a href="https://www.weatherdatascience.tokyo/" target="_blank" rel="noopener noreferrer">
                <img src="img/WDSlogo.png" alt="WeahterDataScience_logo">
            </a>
        </div>
    </section>

    <!-- /// フォーム領域 /// -->
    <div>
        <form name="login_form" action="login_act.php" method="post" class="login-form">
            <center>
                <h1 class="login-title">ログイン</h1>
                <p>ID, Passwordご入力の上、「認証」ボタンをクリックしてください.</p>
            </center>
            <div>
                <center>
                    <div>
                        <input type="text" name="lid" placeholder="ID">
                    </div>
                    <br>  
                    <div>
                        <input type="password" name="lpw" placeholder="Password">
                    </div>
                </center>
            </div>
            <div class="certification_btn">
                <button type="submit">ログイン</button>
            </div>
        </form>
    </div>
    <!-- <script type="module" src="js/script.js"></script> -->
   
</body>
</html>