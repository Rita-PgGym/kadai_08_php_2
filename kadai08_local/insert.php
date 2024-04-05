<!-- kadai08_PHP02 DB操作(登録・参照)--> 
<?php
//1. POSTデータ取得　index.phpで入力した(POSTされた）データを受け取る
$rest_name = $_POST["rest_name"];
$genre     = $_POST["genre"];
$url       = $_POST["url"];
$memo      = $_POST["memo"];
$name      = $_POST["name"];

//2. DB接続 関数db_conn()を使う
include("funcs.php"); //include関数でfuncs.phpを読み込む
$pdo = db_conn();

//３．データ登録SQL作成
$sql ="INSERT INTO rest_table(rest_name,genre,url,memo,name,indate)VALUES(:rest_name,:genre,:url,:memo,:name,sysdate());";
$stmt = $pdo->prepare($sql);
// bind変数を使って値をクリーンにする.危ない文字をクリーンにする
$stmt->bindValue(':rest_name', $rest_name, PDO::PARAM_STR);  //varcharの場合 PDO::PARAM_STR
$stmt->bindValue(':genre',     $genre,     PDO::PARAM_STR);  //varcharの場合 PDO::PARAM_STR
$stmt->bindValue(':url',       $url,       PDO::PARAM_STR);  //varcharの場合 PDO::PARAM_STR
$stmt->bindValue(':memo',      $memo,      PDO::PARAM_STR);  //Textの場合 PDO::PARAM_STR
$stmt->bindValue(':name',      $name,      PDO::PARAM_STR);  //Textの場合 PDO::PARAM_STR
// ここまでが準備、次の行で実行！$statusにはTrueかFalseが返る
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  sql_error($stmt);//SQLエラー関数：sql_error($stmt)
}else{
//５．index.phpへリダイレクト
  redirect("index.php");//リダイレクト関数: redirect($file_name)
  }
?>