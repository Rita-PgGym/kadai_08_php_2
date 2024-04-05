<!-- kadai08_PHP02 DB操作(登録・参照)--> 
<?php
//1.  DB接続 関数db_conn()を使う
include("funcs.php"); //include関数でfuncs.phpを読み込む
$pdo = db_conn();

//２．データ登録SQL作成
$sql    =  "SELECT * FROM rest_table";
$stmt   = $pdo->prepare($sql);
// ここまでが準備、次の行で実行！$statusにはTrueかFalseが返る
$status = $stmt->execute();

//３．データ表示
if($status==false) {
  sql_error($stmt);//SQLエラー関数：sql_error($stmt)
}

//全データ取得
// fetchAllを使って$valuesに値を入れる。
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONに値を渡す場合に使う.とってきたデータをまるっとJSONに渡す。下の方のscriptタグで扱う
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CA Moms</title>
  <link rel="stylesheet" href="css/index_style.css">
  <link rel="icon" type="img/png" href="img/favicon.png">
</head>

<body>
<header>
  <div class="container">
    <div><img src="img/cheers.png" alt=""></div>
    <div><h1>CA Moms</h1></div>
    <div><img src="img/cheers.png" alt=""></div>
  </div>
</header>

<section class="input_section">
  <h2>My Recommended Restaurant</h2>
  <form action="insert.php" method="POST">
    <div class="info_row">
      <div class="info_label">
        <label for="rest_name">店名：</label>
      </div>
      <div class="info_input">
        <input type="text" name="rest_name" class="text_space"><br>
      </div>
    </div>
    <div class="info_row">
      <div class="info_label">
        <label for="genre">ジャンル：</label>
      </div>
      <div class="info_input">
        <select name="genre"  class="select_area">
          <option value="イタリアン">イタリアン</option>
          <option value="フレンチ">フレンチ</option>
          <option value="和食">和食</option>
          <option value="中華">中華</option>
          <option value="焼き鳥">焼き鳥</option>
          <option value="居酒屋">居酒屋</option>
          <option value="ラーメン">ラーメン</option>
          <option value="その他" selected>その他</option>
        </select><br>
      </div>
    </div>
    <div class="info_row">
      <div class="info_label">
        <label for="url">URL：</label>
      </div>
      <div class="info_input">
        <input type="text" name = "url" class="text_space"><br>
      </div>
    </div>
    <div class="info_row">
      <div class="info_label">
        <label for="memo">おすすめポイント：</label>
      </div>
      <div class="info_input">
        <textArea name="memo" rows="4" cols="53"></textArea><br>
      </div>
    </div>
    <div class="info_row">
      <div class="info_label">
        <label for="name">投稿者：</label>
      </div>
      <div class="info_input">
        <select name="name" class="select_area">
          <option value="Mie">Mie</option>
          <option value="Mika">Mika</option>
          <option value="Rita">Rita</option>
        </select><br>
      </div>
    </div>
    <button type="submit">送信</button>
  </form>
</section>

<section class="list">
  <h2 class="h2_title">Our Favorite Restaurants</h2>
  <div>
    <div class="container jumbotron">
      <table>
        <th>No.</th>
        <th>店名</th>
        <th>ジャンル</th>
        <th>URL</th>
        <th>おすすめポイント</th>
        <th>投稿者</th>
        <th>投稿日</th>

        <?php foreach($values as $value){ ?>
          <tr>
            <td><?=$value["id"]?></td>
            <td><?=$value["rest_name"]?></td>
            <td><?=$value["genre"]?></td>
            <td><?=$value["url"]?></td>
            <td><?=$value["memo"]?></td>
            <td><?=$value["name"]?></td>
            <td><?=$value["indate"]?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</section>
</body>
</html>