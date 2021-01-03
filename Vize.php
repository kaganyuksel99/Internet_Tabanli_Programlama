<?php
require 'Medoo.php';

// Using Medoo namespace
use Medoo\Medoo;

$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'itp_vt',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '',

	// [optional]
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci',
	'port' => 3306
]);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Yer Altı Kaynakları</title>
	<meta charset="utf-8">
<style>
table.steelBlueCols {
  border: 4px solid #BBE500;
  background-color: #A71114;
  width: 400px;
  text-align: center;
  border-collapse: collapse;
}
table.steelBlueCols td, table.steelBlueCols th {
  border: 1px solid #555555;
  padding: 5px 10px;
}
table.steelBlueCols tbody td {
  font-size: 12px;
  font-weight: bold;
  color: #FFFFFF;
}
table.steelBlueCols td:nth-child(even) {
  background: #398AA4;
}
table.steelBlueCols thead {
  background: #398AA4;
  border-bottom: 10px solid #398AA4;
}
table.steelBlueCols thead th {
  font-size: 15px;
  font-weight: bold;
  color: #FFFFFF;
  text-align: left;
  border-left: 2px solid #398AA4;
}
table.steelBlueCols thead th:first-child {
  border-left: none;
}

table.steelBlueCols tfoot td {
  font-size: 13px;
}
table.steelBlueCols tfoot .links {
  text-align: right;
}
table.steelBlueCols tfoot .links a{
  display: inline-block;
  background: #FFFFFF;
  color: #398AA4;
  padding: 2px 8px;
  border-radius: 5px;
}
</style>
</head>
<body>
	<form action="" method="post">
		<p>Yer Altı Kaynağı Giriniz</p>
		<input type="text" name="yerad"><br>
		<p>Çıkarıldığı Yer</p>
		<input type="text" name="cikyer"><br>
		<p>Kullanım Alanı</p>
		<input type="text" name="kulalan"><br>
		<p>Toplam Rezerv Miktarı</p>
		<input type="number" name="rezerv"><br>
		<input type="submit" value="Kaydet">
		<input type="reset" value="Formu Sıfırla">
	</form>



<?php
$kaynakadi="";
$cikarildigiyer="";
$kullanimalani="";
$rezervmiktari="";
if(isset($_POST["yerad"]) && isset($_POST["cikyer"]) && isset($_POST["kulalan"]) && isset($_POST["rezerv"])){
	$kaynakadi=$_POST["yerad"];
	$cikarildigiyer=$_POST["cikyer"];
	$kullanimalani=$_POST["kulalan"];
	$rezervmiktari=$_POST["rezerv"];
	if ($kaynakadi=="" || $cikarildigiyer=="" || $kullanimalani=="" || $rezervmiktari=="" ) {
			echo '<script>alert("Boş Alan Bırakmayınız!");</script>';
	}else {
		$database->insert("tbl_385217", ["kaynak_adi" => $kaynakadi, "cikarildigi_yer" => $cikarildigiyer, "kullanim_alani" => $kullanimalani, "rezerv" => $rezervmiktari ]);
		$kaydedilen=0;
		$kaydedilen=$database->id();
		if ($kaydedilen>0){
			echo '<script>alert("Kayıt Başarılı");</script>';
		}else {
			echo '<script>alert("Hata Bulundu!");</script>';
		}
	}
}
?>


<table class="steelBlueCols">
<thead>
<tr>
<th>Kayıt Numarası</th>
<th>Yer Altı Kaynağı Adı</th>
<th>Çıkarıldığı Yer</th>
<th>Kullanım Alanı</th>
<th>Rezerv Bilgisi</th>
</tr>
</thead>
<tbody>

<?php
$baslangicsirasi=1;
$vericekme = $database->select("tbl_385217", "*");
foreach ($vericekme as $kayit) {
	echo "<tr>
	<td>$baslangicsirasi</td>
	<td>".$kayit["kaynak_adi"]."</td>
	<td>".$kayit["cikarildigi_yer"]."</td>
	<td>".$kayit["kullanim_alani"]."</td>
	<td>".$kayit["rezerv"]."</td>
	</tr>";
	$baslangicsirasi++;
}
?>
</tbody>
</table>

</body>
</html>
