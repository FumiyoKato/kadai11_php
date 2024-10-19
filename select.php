<?php
//0. SESSION開始！！
session_start();

//１．関数群の読み込み
include("funcs.php");

//LOGINチェック → funcs.phpへ関数化しましょう！
sschk();

//旧// 2. データ取得SQL作成・実行
//旧//  $pdo = db_conn();
//旧//  $sql = "SELECT * FROM pvfct_setting";
//旧//  $stmt = $pdo->prepare($sql);
//旧//  $status = $stmt->execute();

/////
//2. データ取得SQL作成・実行
$pdo = db_conn();
$sql = "SELECT * FROM pvfct_setting WHERE company_name = :company_name";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':company_name', $_SESSION['name'], PDO::PARAM_STR);
$status = $stmt->execute();
/////


//3. SQLエラー処理
$values = "";
if($status == false) {
  sql_error($stmt);
}

//4. データ取得
// $values = "";
$values = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($values, JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PV予測設定一覧</title>
  <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table, th, td {
        border: 1px solid #ddd;
    }

    th {
        background-color: #f0f0f0;
        font-weight: bold;
        padding: 8px;
    }

    td {
        padding: 8px;
        text-align: left;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .action-btn {
        text-align: center;
    }

    a {
        margin-right: 5px;
        color: blue;
    }

    a.delete {
        color: red;
    }
  </style>
</head>
<body>
  <h1>PV予測対象一覧</h1>
  <br>
  <?=$_SESSION["name"]?>さん、こんにちは！
  <a href="mypage.php">データ登録</a>
  <a href="logout.php">ログアウト</a>

  <?php if (!empty($values)) { ?>
    <table>
      <!-- カラムヘッダー表示 -->
      <tr>
        <?php foreach (array_keys($values[0]) as $header) { ?>
          <th><?= h($header) ?></th>
        <?php } ?>
        <!-- 追加: アクション列 -->
        <th>アクション</th>
      </tr>
      
      <!-- データ表示 -->
      <?php foreach ($values as $row) { ?>
        <tr>
          <?php foreach ($row as $cell) { ?>
            <td><?= h($cell) ?></td>
          <?php } ?>
          <!-- 追加: 更新・削除ボタン -->
          <td class="action-btn">
            <a href="detail.php?id=<?= h($row['id']) ?>">更新</a>
            <?php if($_SESSION["kanri_flg"]=="1"){ ?>
              <a href="delete.php?id=<?= h($row['id']) ?>" class="delete" onclick="return confirm('本当に削除しますか？')">削除</a>
            <?php } ?>
          </td>
        </tr>
      <?php } ?>
    </table>
  <?php } else { ?>
    <p>データベースにデータがありません。</p>
  <?php } ?>

  <script>
    // JSONデータを受け取り、コンソールに表示
    const jsonData = '<?= $json ?>';
    const obj = JSON.parse(jsonData);
    console.log(obj);
  </script>
</body>
</html>