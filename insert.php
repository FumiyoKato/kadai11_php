<?php
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

// 2. DB接続します
include("funcs.php"); //外部ファイル読み込み
$pdo = db_conn();

// 3. データ登録SQL作成（バインド変数を通してハッキングを防止）
$sql = "INSERT INTO pvfct_setting(id,company_name,fctunit_name,pv_capacity,pcs_capacity,direction,angle,pcs_efficiency,lossrate,prefecture,primary_wxarea,indate)
        VALUES(NULL, :company_name, :fctunit_name, :pv_capacity, :pcs_capacity, :direction, :angle, :pcs_efficiency, :lossrate, :prefecture, :primary_wxarea, sysdate())";
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
$status = $stmt->execute(); // true or false

// 4. データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("mypage.php");
}
?>
