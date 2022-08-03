<?php
require_once("includes/config.php");
// code for empid availablity
if (!empty($_POST["empcode"])) {
	$empid = $_POST["empcode"];

	$sql = "SELECT EmpId FROM tblemployees WHERE EmpId=:empid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':empid', $empid, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		echo "<span style='color:red'>มีรหัสพนักงานอยู่แล้ว</span>";
		echo "<script>$('#add').prop('disabled',true);</script>";
	} else {

		echo "<span style='color:green'>รหัสพนักงานสามารถลงทะเบียนได้</span>";
		echo "<script>$('#add').prop('disabled',false);</script>";
	}
}

// code for emailid availablity
if (!empty($_POST["emailid"])) {
	$empid = $_POST["emailid"];
	$sql = "SELECT EmailId FROM tblemployees WHERE EmailId=:emailid";
	$query = $dbh->prepare($sql);
	$query->bindParam(':emailid', $empid, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		echo "<span style='color:red'>มีอีเมล์อยู่แล้ว</span>";
		echo "<script>$('#add').prop('disabled',true);</script>";
	} else {

		echo "<span style='color:green'>อีเมล์สามารถลงทะเบียนได้</span>";
		echo "<script>$('#add').prop('disabled',false);</script>";
	}
}


// code for username availablity
if (!empty($_POST["username"])) {
	$username = $_POST["username"];
	$sql = "SELECT UserName FROM admin WHERE UserName=:username";
	$query = $dbh->prepare($sql);
	$query->bindParam(':username', $username, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		echo "<span style='color:red'>มีชื่อผู้ใช้อยู่แล้ว</span>";
		echo "<script>$('#add').prop('disabled',true);</script>";
	} else {

		echo "<span style='color:green'>ชื่อผู้ใช้สามารถลงทะเบียนได้</span>";
		echo "<script>$('#add').prop('disabled',false);</script>";
	}
}
