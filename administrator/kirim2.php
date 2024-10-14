<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="theme-color" content="#008080" />
  <!-- URL Theme Color untuk Windows Phone -->
  <meta name="msapplication-navbutton-color" content="#c6c6c6" />
  <!-- URL Theme Color untuk iOS Safari -->
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="#008080" />
    <link rel="icon" href="gambar/logostie.png">
  	<title>Form Registrasi KTM</title>
  	<link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/croppie.css">
    <style type="text/css">
    form{
      width:300px;
      margin:15px auto;
      padding:10px;
      border-radius:5px;
      box-shadow:0px 0px 10px 2px #808080;
      background:white;
    }
    .text1{
      width:330px;
      padding:10px 5px;
      border:none;
      border-bottom: 1px #ccccb3 solid;
      border-top: 1px #ccccb3 solid;
      border-left: 1px #ccccb3 solid;
      border-right: 1px #ccccb3 solid;  
    }
    .text2{
      width:250px;
      padding:5px;
      border:none;
      border-bottom: 1px #ccccb3 solid;
      border-top: 1px #ccccb3 solid;
      border-left: 1px #ccccb3 solid;
      border-right: 1px #ccccb3 solid;
    }
    .file{
      width:250px;
      padding:5px;
      border:none;
      border-bottom: 1px #ccccb3 solid;
      border-top: 1px #ccccb3 solid;
      border-left: 1px #ccccb3 solid;
      border-right: 1px #ccccb3 solid;
    }
    .submit{
      padding:10px 10px;
      margin:0px;
      background:orange;
      color:white;
      border-radius:3px;
      border:none;
      width:100%;
      cursor:pointer;
    }.submit2{
      padding:7px 10px;
      margin:0px;
      background:orange;
      color:white;
      border-radius:3px;
      border:none;
      cursor:pointer;
    }
    .batal{
      padding:7px 10px;
      background:red;
      color:white;
      border-radius:3px;
      text-decoration:none;
      border:none;
    }
    .submit:hover, .batal:hover, .submit2:hover{
      background:#333;
    }
    h2{
      font:22px "Calibri";
      color:green;
      font-weight:bold;
      margin:5px;
    }
     .salah{
      background:red;
      color:white;
      padding:2px 10px;
      font:15px "Calibri";
      font-weight:bold;
      border-radius:3px;
    }
    small{
      font:12px "Calibri";
      color:red;
      font-style:italic;
    }
  </style>
</head>
<body>
<?php 
if(isset($_POST['kirim'])) {
include "config.php";
    $nis=$_POST['nis'];
    $nim=$nis;
    $sqlk="select * from ktm where nim='$nim'";
    $resultk=mysqli_query($koneksi,$sqlk);
    if($datak=mysqli_fetch_array($resultk)){
    ?>
      <meta http-equiv="refresh" content="1;url=ktm_ctk.php?aksi=tampil&nim=<?= $nim ?>">
      <?php   
    }
    else{
      $sql="select * from siswa where nis='$nim'";
      $result=mysqli_query($koneksi,$sql);
      $data=mysqli_fetch_array($result);
      $nm_mhs=$data['nama_siswa'];
      $nmmhs=preg_replace("/[^a-zA-Z0-9' ]/", "", $nm_mhs);
      $nm_kapital=strtoupper($nmmhs);
      $temlhr=strtoupper($data['tempat_lahir']);
      $blnlhr=strtoupper($data['bulan_lahir']);
      $alamat=strtoupper($data['alamat']);
      $kota=strtoupper($data['kota']);
      $halaman=$_GET['halaman'];
      if($data){
      ?>

	<nav class="navbar navbar-dark"  style="text-align:center; padding: 5px 0px; background: #008080">
    <div class="col-sm-6 offset-sm-3">
	    <h3 class="navbar-brand text-white" style="font-size: 24px"><b>Kartu Tanda Mahasiswa (KTM)</b></h3>
	  </div>
	</nav>

	
	<!-- <div class="row"> -->
		<div class="col-sm-6 offset-sm-3">
			<div class="form-group">
<table class="table table" style="font:14px 'Calibri'">
          <!-- <tr>
            <th colspan="2" class="bg-warning"><h3>Input Data Mahasiswa</h3></th>
          </tr> -->
          <tr>
            <td width="80px">NIM</td>
            <td width="5px">:</td>
            <td class="list"><?= $data['nis'] ?></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td  class="list"><?= $nm_kapital ?></td>
          </tr>
          <tr>
            <td>Lahir di</td>
            <td>:</td>
            <td  class="list"><?= $temlhr ?></td>
          </tr>
          <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td class="list"><?= $data['tanggal_lahir'] ?> <?= $blnlhr ?> <?= $data['tahun_lahir'] ?></td>
          </tr>
          <tr>
            <td valign="top">Alamat</td>
            <td>:</td>
            <td class="list"><?= $alamat ?> <?= $kota ?></td>
          </tr>
          <tr>
            <td colspan="3">Upload File Photo <br><br>
            <input type="file" name="upload_image" id="upload_image" accept="image/*" /></td>
          </tr>
        <tfoot>
          <tr>
            <td></td>
          </tr>
        </tfoot>
        </table>



				<!-- <label>Pilih Gambar</label><br> -->
				

			</div>
				
			<div id="uploaded_image"></div>
     	</div>
    </div>

    <div id="uploadimageModal" class="modal" role="dialog">
	   <div class="modal-dialog">
	      <div class="modal-content">
	         <div class="modal-header">
	            <h4 class="modal-title" id="myModalLabel">Crop &amp; Upload Gambar</h4>
	            <button type="button" class="close" data-dismiss="modal" >
	                <span aria-hidden="true">&times;</span>
	                <span class="sr-only">Close</span>
	            </button>
	         </div>
	         <div class="modal-body">
	            <div class="row">
	               <div class="col-md-12 text-center">
	                  <div id="image_demo"></div>
	               </div>
	            </div>
	         </div>
	         <div class="modal-footer">
	            <button class="btn btn-success crop_image">Crop &amp; Upload</button>
	         </div>
	      </div>
	   </div>
	</div>
<?php
  }
    else
    {
      echo "<center><form><p><marquee>Maaf NIM &nbsp<b class=\"salah\">$nis</b>&nbsp Tidak di Temukan !!!</marquee></form><p></center>";
          ?>
        <meta http-equiv="refresh" content="6;index.php">
          <?php
    }
  }
?>
	<div class="navbar bg-light fixed-bottom">
		<div class="col-md-12 text-center" style="color: #666666; font-size: 12px">Copyright &copy <?php echo date('Y'); ?> By.  Patlapan
		</div>
	</div>
<?php   
}
  ?>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/croppie.min.js"></script>

  <script>  
    $(document).ready(function(){
      $image_crop = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
          width:150,
          height:200,
          type:'square' //circle
        },
        boundary:{
          width:300,
          height:300
        }
      });

      $('#upload_image').on('change', function(){
        var reader = new FileReader();
        reader.onload = function (event) {
          $image_crop.croppie('bind', {
            url: event.target.result
          }).then(function(){
            console.log('jQuery bind complete');
          });
        }
        reader.readAsDataURL(this.files[0]);
        $('#uploadimageModal').modal('show');
      });

      $('.crop_image').click(function(event){
        $image_crop.croppie('result', {
          type: 'canvas',
          size: 'viewport'
        }).then(function(response){
          $.ajax({
            url:"upload.php?nis=<?= $nis ?>&nama=<?= $nm_kapital ?>&halaman=<?= $halaman ?>",
            type: "POST",
            data:{"image": response},
            success:function(data)
            {
              $('#uploadimageModal').modal('hide');
              $('#uploaded_image').html(data);
            }
          });
        })
      });
    });  
  </script> 

</body>
</html>