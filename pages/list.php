<?php
// 外部ファイルの読み込み
require_once "db.php";
require_once "Product.php";
?>

<?php
$products = [];
$pstmt = null;

try{
    $pdo = connectDB();
    $sql = "select * from product";
    $pstmt = $pdo->prepare($sql);
    $pstmt->execute();
    $records = $pstmt->fetchALL(PDO::FETCH_ASSOC);
    $products = null;
    
    foreach ($records as $record){
        $id = $record["id"];
        $name = $record["name"];
        $price = $record["price"];
        $category = $record["category"];
        $detail = $record["detail"];
        
        $product = new Product($id, $name, $price, $category, $detail);
        
        $products[] = $product;
    }
}catch (PDOException $e) {
	echo $e->getMessage();
	die;
} finally {
	unset($pstmt);
	unset($pdo);
}
?>




<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>商品データベース</title>
	<link rel="stylesheet" href="../assets/css/style.css" />
</head>
<body>
<header>
	<h1>商品データベース</h1>
</header>
<main id="list">
	<h2>商品一覧</h2>
	<table class="list">
		<tr>
			<th>商品ID</th>
			<th>カテゴリ</th>
			<th>商品名</th>
			<th>価格</th>
			<th></th>
		</tr>
		<?php foreach ($products as $product): ?>
		<tr>
			<td><?= $product->getId() ?></td>
			<td><?= $product->getCategory() ?></td>
			<td><?= $product->getName() ?></td>
			<td>&yen;<?= $product->getPrice() ?></td>
			<td class="buttons">
				<form name="inputs">
					<input type="hidden" name="id" value="<?= $product->getId() ?>" />
					<button formaction="update.php" formmethod="get" name="action" value="update">更新</button>
					<button formaction="confirm.php" formmethod="get" name="action" value="delete">削除</button>
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
		<!-- <tr>
		    <td>2</td>
		    <td>財布・小物入れ</td>
		    <td>市松文様 小物入れ</td>
		    <td>&yen;2500</td>
		    <td class="buttons">
		        <form name="inputs">
		            <input type="hidden" name="id" value="" />
		            <button formaction="update.php" formmethod="post" name="action" value="update">更新</button>
		            <button formaction="confirm.php" formmethod="post" name="action" value="delete">削除</button>
		        </form>
		    </td>
		</tr>
		<tr>
		    <td>3</td>
		    <td>財布・小物入れ</td>
		    <td>籠</td>
		    <td>&yen;1900</td>
		    <td class="buttons">
		        <form name="inputs">
		            <input type="hidden" name="id" value="" />
		            <button formaction="update.php" formmethod="post" name="action" value="update">更新</button>
		            <button formaction="confirm.php" formmethod="post" name="action" value="delete">削除</button>
		        </form>
		    </td>
		</tr>
		<tr>
		    <td>4</td>
		    <td>食卓用</td>
		    <td>ランチョンマット</td>
		    <td>&yen;900</td>
		    <td class="buttons">
		        <form name="inputs">
		            <input type="hidden" name="id" value="" />
		            <button formaction="update.php" formmethod="post" name="action" value="update">更新</button>
		            <button formaction="confirm.php" formmethod="post" name="action" value="delete">削除</button>
		        </form>
		    </td>
		</tr>
		<tr>
		    <td>5</td>
		    <td>食卓用</td>
		    <td>お椀</td>
		    <td>&yen;900</td>
		    <td class="buttons">
		        <form name="inputs">
		            <input type="hidden" name="id" value="" />
		            <button formaction="update.php" formmethod="post" name="action" value="update">更新</button>
		            <button formaction="confirm.php" formmethod="post" name="action" value="delete">削除</button>
		        </form>
		    </td>
		</tr>
		<tr>
		    <td>6</td>
		    <td>食卓用</td>
		    <td>夫婦箸</td>
		    <td>&yen;1800</td>
		    <td class="buttons">
		        <form name="inputs">
		            <input type="hidden" name="id" value="" />
		            <button formaction="update.php" formmethod="post" name="action" value="update">更新</button>
		            <button formaction="confirm.php" formmethod="post" name="action" value="delete">削除</button>
		        </form>
		    </td>
		</tr>
		<tr>
		    <td>7</td>
		    <td>その他</td>
		    <td>扇子</td>
		    <td>&yen;820</td>
		    <td class="buttons">
		        <form name="inputs">
		            <input type="hidden" name="id" value="" />
		            <button formaction="update.php" formmethod="post" name="action" value="update">更新</button>
		            <button formaction="confirm.php" formmethod="post" name="action" value="delete">削除</button>
		        </form>
		    </td>
		</tr>
		<tr>
		    <td>8</td>
		    <td>その他</td>
		    <td>手染め 手ぬぐい</td>
		    <td>&yen;520</td>
		    <td class="buttons">
		        <form name="inputs">
		            <input type="hidden" name="id" value="" />
		            <button formaction="update.php" formmethod="post" name="action" value="update">更新</button>
		            <button formaction="confirm.php" formmethod="post" name="action" value="delete">削除</button>
		        </form>
		    </td>
		</tr> -->
	</table>
</main>
<footer>
	<div id="copyright">&copy; 2021 The Applied Course of Web System Development.</div>
</footer>
</body>
</html>