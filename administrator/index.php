<?php
session_start();
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> APLIKASI KARTU PESERTA UJIAN </title>
<link rel="icon" href="../gambar/skaone.png">
<style>
*{padding:0px; margin:0px;}
body{background:#eee;}
*{padding:0px; margin:0px;}
body{background:#eee;}
#tengah{
	width:100%;
	padding:0px;
	height:100%;
	margin:0px auto;
}
#bawah{
	bottom:0px;
	position:fixed;
	padding:10px 0px 10px 0px;
	width:100%;
	font:12px "Calibri";
	text-align:center;
	background:#ccc;

}
input[type="text"], input[type="password"]{
	width:285px;
	padding:5px;
	font:14px "Calibri";
	border:none;
	color:#808080;
}
input[type="submit"]{
	width:300px;
	padding:10px;
	font:14px "Calibri";
	border:none;
	background:#333;
	color:white;
	border-radius:3px;
}
select{
	width:285px;
	padding:5px;
	font:14px "Calibri";
	border:none;
	color:#808080;
	
}
input[type="submit"]:hover{
	background:maroon;
	cursor:pointer;
}
form{
	padding:30px 20px;
	box-shadow: 0px 0px 10px 0px #333;
	margin:50px auto;
	width:310px;
	border-radius:5px;
}
.garis{
	border-left:1px #808080 solid;
	border-top:1px #808080 solid;
	border-right:1px #808080 solid;
	border-bottom:1px #808080 solid;
	padding:5px;
	background:#fff;
}
.logout{
	padding:3px 10px;
	margin:0px 30px;
	border-radius:3px;
	background:orange;
	color:white;
	text-decoration:none;
}
.salah{
	padding:1px 10px;
	border-radius:10px;
	background:orange;
	color:white;
	text-decoration:none;
}
.logout:hover{
	background:white;
	color:maroon;
}
small{
	font:14px "Calibri";
}
H2{
	font:28px "Calibri";
	font-weight:bold;
	color:#808080;
}
</style>
</head>
<body>
<?php
if(isset($_SESSION['kdPT'])&&($_SESSION['passw0rd'])){
	$kdPT=$_SESSION['kdPT'];
	$passw0rd=$_SESSION['passw0rd'];
	if($kdPT=="skaone"&&$passw0rd=="skaone"){

		if(isset($_GET['aksi'])){
			$aksi=$_GET['aksi'];
			if($aksi=="logout"){
			session_destroy();	
				?>
			<meta http-equiv="refresh" content="1;url=?">
			<?php
			}
		}else

		{
		?>
		<div id="tengah">
			<div id="kanan"><iframe name="kanan" width="100%" height="100%" src="kartu.php" frameborder=no></iframe></div>
		</div>
		<div id="bawah">Copyright &copy 2019 <a href="?aksi=logout" class="logout">Logout</a></div>
	<?php
		}
	}else{
		session_destroy();
	?>
		<link rel="stylesheet" href="css/style.css">
		<center><form><small><h2>Maaf !!!</h2> Username atau Kata Sandi Salah!<p>Silahkan klik <a href="?" class="salah">disini</a> untuk kembali !</small><p>&nbsp;</form>
		<?php
	}
} else {
	?>
<form method="POST" action="?aksi=proses">
	<table cellspacing="5">
		<tr>
			<td align="center"><h2>LOGIN USER</h2></td>
		</tr>
		<tr>
			<td class="garis"><input type="text" name="kdPT" placeholder="User Name" style="outline: none;" autocomplete="off" autofocus="on"></td>
		</tr>
		<tr>
			<td class="garis"><input type="password" name="passw0rd" placeholder="Kata Sandi" style="outline: none;" autocomplete="off"></td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="login" value="Login">
			</td>
		</tr>
		</table>
	</form>
	<?php
	if(isset($_GET['aksi'])){
		$aksi=$_GET['aksi'];
		if($aksi=="proses"){
			if(isset($_POST['login'])){
				$passw0rd=$_POST['passw0rd'];
				$kdPT=$_POST['kdPT'];
				$_SESSION['kdPT']="$kdPT";
				$_SESSION['passw0rd']="$passw0rd";
				?>
				<meta http-equiv="refresh" content="1;url=?">
				<?php
			}
		}
	}
}
?>
</body>
</html>