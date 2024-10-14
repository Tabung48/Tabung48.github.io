<?php
use Phppot\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();
require_once ('vendor/autoload.php');

if (isset($_POST["import"])) {

    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = 'uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        for ($i = 1; $i <= $sheetCount; $i ++) {
            $name = "";
            if (isset($spreadSheetAry[$i][0])) {
                $name = mysqli_real_escape_string($conn, $spreadSheetAry[$i][0]);
            }
            $description = "";
            if (isset($spreadSheetAry[$i][1])) {
                $description = mysqli_real_escape_string($conn, $spreadSheetAry[$i][1]);
            }

            if (! empty($name) || ! empty($description)) {
                $query = "insert into tbl_info(name,description) values(?,?)";
                $paramType = "ss";
                $paramArray = array(
                    $name,
                    $description
                );
                $insertId = $db->insert($query, $paramType, $paramArray);
                // $query = "insert into tbl_info(name,description) values('" . $name . "','" . $description . "')";
                // $result = mysqli_query($conn, $query);

                if (! empty($insertId)) {
                    $type = "success";
                    $message = "Excel Data Imported into the Database";
                } else {
                    $type = "error";
                    $message = "Problem in Importing Excel Data";
                }
            }
        }
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<style>
body {
	font-family: Arial;
	width: 550px;
	font-size: 0.9em;
	margin: 60px auto;
}

.outer-container {
	border: #e0dfdf 1px solid;
	padding: 30px 30px 10px 30px;
	border-radius: 15px;
	text-align: center;
	margin: 10px auto;
	width: 350px;
}

.tutorial-table {
	margin-top: 40px;
	font-size: 1.0em;
	border-collapse: collapse;
	width: 100%;
}

.tutorial-table th {
	background: #f0f0f0;
	border-bottom: 2px solid #dddddd;
	padding: 10px;
	text-align: left;
}

.tutorial-table td {
	background: #FFF;
	border-bottom: 1px solid #dddddd;
	padding: 10px;
	text-align: left;
}

#response {
	padding: 10px;
	margin-top: 10px;
	border-radius: 2px;
	display: none;
}

.success {
	background: #c7efd9;
	border: #bbe2cd 1px solid;
}

.error {
	background: #fbcfcf;
	border: #f3c6c7 1px solid;
}

div#response.display-block {
	display: block;
}

.input-row {
	margin-top: 0px;
	margin-bottom: 20px;
	padding: 20px;
}

.btn-submit {
	background: #efefef;
	border: #d3d3d3 1px solid;
	width: 100%;
	border-radius: 20px;
	cursor: pointer;
	padding: 12px;
}

label {
	margin-bottom: 5px;
	display: inline-block;
	font-weight: normal;
}

.file {
	border: 1px solid #cfcdcd;
	padding: 12px;
	border-radius: 20px;
	color: #171919;
	width: 93%;
	margin-bottom: 20px;
}
</style>
</head>
<body>
	<h2>Import Excel File into MySQL Database using PHP</h2>

	<div class="outer-container">
		<div class="row">
			<form class="form-horizontal" action="" method="post"
				name="frmExcelImport" id="frmExcelImport"
				enctype="multipart/form-data" onsubmit="return validateFile()">
				<div Class="input-row">
					<label>Choose your file. <a href="Template/import-template.xlsx"
						download>Download excel template</a></label>
					<div>
						<input type="file" name="file" id="file" class="file"
							accept=".xls,.xlsx">
					</div>
					<div class="import">
						<button type="submit" id="submit" name="import" class="btn-submit">Import
							Excel and Save Data</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div id="response"
		class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
<?php
$sqlSelect = "SELECT * FROM tbl_info";
$result = $db->select($sqlSelect);
if (! empty($result)) {
    ?>

    <table class='tutorial-table'>
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
			</tr>
		</thead>
<?php
    foreach ($result as $row) { // ($row = mysqli_fetch_array($result))
        ?>
        <tbody>
			<tr>
				<td><?php  echo $row['name']; ?></td>
				<td><?php  echo $row['description']; ?></td>
			</tr>
<?php
    }
    ?>
        </tbody>
	</table>
<?php
}
?>
</body>
</html>