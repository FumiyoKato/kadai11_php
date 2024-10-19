<?php
session_start();
//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//   POSTデータ受信 → DB接続 → SQL実行 → 前ページへ戻る
//2. $id = POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

// 1. POSTデータ取得
$company_name = $_POST["company_name"];
$fctunit_name = $_POST["fctunit_name"]; 
$pv_capacity = $_POST["pv_capacity"];
$pcs_capacity = $_POST["pcs_capacity"];
$direction = $_POST["direction"];
$angle = $_POST["angle"];
$pcs_efficiency = $_POST["pcs_efficiency"];
$lossrate = $_POST["lossrate"];
$prefecture = $_POST["prefecture"];
$primary_wxarea = $_POST["primary_wxarea"];
$id = $_POST["id"];

// 2. DB接続します
include("funcs.php"); //外部ファイル読み込み
sschk();
$pdo = db_conn();

// 3. データ登録SQL作成（バインド変数を通してハッキングを防止）
$sql = "UPDATE pvfct_setting 
    SET company_name=:company_name,
        fctunit_name=:fctunit_name,
        pv_capacity=:pv_capacity,
        pcs_capacity=:pcs_capacity,
        direction=:direction,
        angle=:angle,
        pcs_efficiency=:pcs_efficiency,
        lossrate=:lossrate,
        prefecture=:prefecture,
        primary_wxarea=:primary_wxarea 
    WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':company_name', $company_name, PDO::PARAM_STR);  // バインド変数でハッキング等を阻止
$stmt->bindValue(':fctunit_name', $fctunit_name, PDO::PARAM_STR);  // Srting（文字列の場合 PDO::PARAM_STR)
$stmt->bindValue(':pv_capacity', $pv_capacity, PDO::PARAM_INT);  // Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':pcs_capacity', $pcs_capacity, PDO::PARAM_INT);
$stmt->bindValue(':direction', $direction, PDO::PARAM_INT);
$stmt->bindValue(':angle', $angle, PDO::PARAM_INT);
$stmt->bindValue(':pcs_efficiency', $pcs_efficiency, PDO::PARAM_INT);
$stmt->bindValue(':lossrate', $lossrate, PDO::PARAM_INT);
$stmt->bindValue(':prefecture', $prefecture, PDO::PARAM_STR);
$stmt->bindValue(':primary_wxarea', $primary_wxarea, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

// 4. データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("select.php");
}

?>
