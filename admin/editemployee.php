<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $eid = intval($_GET['empid']);
    if (isset($_POST['update'])) {
        $prefix = $_POST['prefix'];
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $department = $_POST['department'];
        $address = $_POST['address'];
        $provinces = $_POST['Ref_prov_id'];
        $districts = $_POST['Ref_subdist_id'];
        $amphures = $_POST['Ref_dist_id'];
        $zip_code = $_POST['zip_code'];
        $mobileno = $_POST['mobileno'];
        $Type_Employee = $_POST['Type_Employee'];

        $sql = "update tblemployees set Prefix='" . $prefix . "',FirstName='" . $fname . "',LastName='" . $lname . "',Gender='" . $gender . "',Dob='" . $dob . "',Department='" . $department . "',Address='" . $address . "',provinces='" . $provinces . "',districts='" . $districts . "',amphures='" . $amphures . "',zip_code='" . $zip_code . "',Phonenumber='" . $mobileno . "',Type_Employee='" . $Type_Employee . "' where id='" . $eid . "';";
        $query = $dbh->prepare($sql);

        //echo "<pre>";
        //print_r($_POST);
       // echo "</pre>";
        //die;
        // $query->bindParam(':prefix', $prefix, PDO::PARAM_STR);
        // $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        // $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        //$query->bindParam(':gender', $gender, PDO::PARAM_STR);
        //$query->bindParam(':dob', $dob, PDO::PARAM_STR);
        //$query->bindParam(':department', $department, PDO::PARAM_STR);
        //$query->bindParam(':address', $address, PDO::PARAM_STR);
        //$query->bindParam(':provinces', $provinces, PDO::PARAM_STR);
        // $query->bindParam(':districts', $districts, PDO::PARAM_STR);
        //$query->bindParam(':amphures', $amphures, PDO::PARAM_STR);
        // $query->bindParam(':zip_code', $zip_code, PDO::PARAM_STR);
        // $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        // $query->bindParam(':Type_Employee', $Type_Employee, PDO::PARAM_STR);
        // $query->bindParam(':eid', $eid, PDO::PARAM_STR);
        $query->execute();
        $msg = "อัปเดตข้อมูลพนักงานเรียบร้อยแล้ว";
    }


?>

<!DOCTYPE html>
<html lang="th">

<head>

    <!-- Title -->
    <title>แก้ไขข้อมูลพนักงาน</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
    <link href="../assets/css/alpha.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/custom.css" rel="stylesheet" type="text/css" />
    <style>
    .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }

    .succWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
    }
    </style>





</head>

<body>
    <?php include('includes/header.php'); ?>

    <?php include('includes/sidebar.php'); ?>
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">แก้ไขข้อมูลพนักงาน</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <form id="example-form" method="post" name="updatemp">
                            <div>
                                <?php if ($error) { ?><div class="errorWrap">
                                    <strong>ข้อผิดพลาด</strong>:<?php echo htmlentities($error); ?>
                                </div>
                                <?php } else if ($msg) { ?><div class="succWrap"><strong>สำเร็จ</strong> :
                                    <?php echo htmlentities($msg); ?> </div><?php } ?>
                                <section>
                                    <div class="wizard-content">
                                        <div class="row">
                                            <div class="col m6">
                                                <div class="row">
                                                    <?php
                                                        $eid = intval($_GET['empid']);
                                                        $sql = "SELECT * from  tblemployees where id=:eid";
                                                        $query = $dbh->prepare($sql);
                                                        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($query->rowCount() > 0) {
                                                            foreach ($results as $result) {               ?>
                                                    <div class="input-field col  s12">
                                                        <label for="empcode">รหัสพนักงาน (ต้องไม่ซ้ำกัน)</label>
                                                        <input name="empcode" id="empcode"
                                                            value="<?php echo htmlentities($result->EmpId); ?>"
                                                            type="text" autocomplete="off" readonly required>
                                                        <span id="empid-availability" style="font-size:12px;"></span>
                                                    </div>

                                                    <div class="input-field col  s12">
                                                        <label for="prefix">คำนำหน้าชื่อ</label>
                                                        <input id="prefix" name="prefix"
                                                            value="<?php echo htmlentities($result->Prefix); ?>"
                                                            type="text" required>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="firstName">ชื่อ</label>
                                                        <input id="firstName" name="firstName"
                                                            value="<?php echo htmlentities($result->FirstName); ?>"
                                                            type="text" required>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="lastName">นามสกุล</label>
                                                        <input id="lastName" name="lastName"
                                                            value="<?php echo htmlentities($result->LastName); ?>"
                                                            type="text" autocomplete="off" required>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="email">อีเมล์</label>
                                                        <input name="email" type="email" id="email"
                                                            value="<?php echo htmlentities($result->EmailId); ?>"
                                                            readonly autocomplete="off" required>
                                                        <span id="emailid-availability" style="font-size:12px;"></span>
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <label class="active" for="gender">เพศ</label>
                                                        <select name="gender" id="gender" autocomplete="off" required=""
                                                            aria-required="true">
                                                            <option
                                                                value="<?php echo htmlentities($result->Gender); ?>">
                                                                <?php echo htmlentities($result->Gender); ?></option>
                                                            <option value="ชาย">ชาย</option>
                                                            <option value="หญิง">หญิง</option>
                                                            <option value="อื่นๆ">อื่นๆ</option>
                                                        </select>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <input id="birthdate" name="dob" class="datepicker"
                                                            value="<?php echo htmlentities($result->Dob); ?>">
                                                    </div>


                                                </div>
                                            </div>

                                            <div class="col m6">
                                                <div class="row">

                                                    <div class="input-field col  s12">
                                                        <label for="department">แผนก</label>
                                                        <select name="department" autocomplete="off">
                                                            <option
                                                                value="<?php echo htmlentities($result->Department); ?>">
                                                                <?php echo htmlentities($result->Department); ?>
                                                            </option>
                                                            <?php $sql = "SELECT DepartmentName from tbldepartments";
                                                                $query = $dbh->prepare($sql);
                                                                $query->execute();
                                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                $cnt = 1;
                                                                if ($query->rowCount() > 0) {
                                                                    foreach ($results as $resultt) {   ?>
                                                            <option
                                                                value="<?php echo htmlentities($resultt->DepartmentName); ?>">
                                                                <?php echo htmlentities($resultt->DepartmentName); ?>
                                                            </option>
                                                            <?php }
                                                                } ?>
                                                        </select>
                                                    </div>

                                                    <div class="input-field col  s12">
                                                        <label for="address">ที่อยู่</label>
                                                        <input id="address" name="address" type="text"
                                                            value="<?php echo htmlentities($result->Address); ?>"
                                                            autocomplete="off" required>
                                                    </div>
                                                    <div class="input-field col  s12">
                                                        <select id="provinces" name="Ref_prov_id" autocomplete="off"
                                                            required="" aria-required="true">

                                                            <?php
                                                                $sql_provinces = "SELECT * FROM provinces";
                                                                $query = $dbh->prepare($sql_provinces);
                                                                $query->execute();

                                                                foreach ($query as $value) { ?>
                                                            <option value="<?= $value['id'] ?>"
                                                                <?php echo ($result->provinces == $value['id']) ? "selected" : " " ?>>
                                                                <?= $value['name_th'] ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="input-field col  s12">
                                                        <select id="amphures" name="Ref_dist_id" autocomplete="off"
                                                            required="" aria-required="true">
                                                            <?php
                                                                $amphures = "SELECT * FROM amphures";
                                                                $query = $dbh->prepare($amphures);
                                                                $query->execute();

                                                                foreach ($query as $value) { ?>
                                                            <option value="<?= $value['id'] ?>"
                                                                <?php echo ($result->amphures == $value['id']) ? "selected" : " " ?>>
                                                                <?= $value['name_th'] ?>
                                                            </option>
                                                            <?php } ?>

                                                        </select>
                                                    </div>

                                                    <div class="input-field col  s12">
                                                        <select id="districts" name="Ref_subdist_id" autocomplete=" off"
                                                            required="" aria-required="true">

                                                            <?php
                                                                $districts = "SELECT * FROM districts";
                                                                $query = $dbh->prepare($districts);
                                                                $query->execute();

                                                                foreach ($query as $value) { ?>
                                                            <option value="<?= $value['id'] ?>"
                                                                <?php echo ($result->districts == $value['id']) ? "selected" : " " ?>>
                                                                <?= $value['name_th'] ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label id="label_zip_code" for="zip_code">รหัสไปรณีย์</label>
                                                        <input id="zip_code" name="zip_code" type="text"
                                                            value="<?php echo htmlentities($result->zip_code); ?>"
                                                            autocomplete="off" required>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="phone">เบอร์โทรศัพท์</label>
                                                        <input id="phone" name="mobileno" type="tel"
                                                            value="<?php echo htmlentities($result->Phonenumber); ?>"
                                                            maxlength="10" autocomplete="off" required>
                                                    </div>

                                                    <div class="input-field col s12 ">
                                                        <label class="active" for="Type_Employee">ประเภทพนักงาน</label>
                                                        <select name="Type_Employee" id="Type_Employee"
                                                            autocomplete="off" required="" aria-required="true">
                                                            <!-- <option
                                                                value="<?php echo nl2br($result->Type_Employee); ?>">
                                                                <?php echo nl2br($result->Type_Employee); ?>
                                                            </option> -->
                                                            <option value="พนักงานทั่วไป"
                                                                <?php echo ($result->Type_Employee == "พนักงานทั่วไป") ? "selected" : " " ?>>
                                                                พนักงานทั่วไป</option>
                                                            <option value="แอดมิน"
                                                                <?php echo ($result->Type_Employee == "แอดมิน") ? "selected" : " " ?>>
                                                                แอดมิน</option>
                                                        </select>
                                                    </div>

                                                    <?php }
                                                        } ?>

                                                    <div class="input-field col s12">
                                                        <button type="submit" name="update" id="update"
                                                            class="waves-effect waves-light btn indigo m-b-xs">อัปเดต</button>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>


                                </section>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
    <div class="left-sidebar-hover"></div>

    <!-- Javascripts -->
    <script src="../assets/plugins/jquery/jquery-2.2.0.min.js"></script>
    <script src="../assets/plugins/materialize/js/materialize.min.js"></script>
    <script src="../assets/plugins/material-preloader/js/materialPreloader.min.js"></script>
    <script src="../assets/plugins/jquery-blockui/jquery.blockui.js"></script>
    <script src="../assets/js/alpha.min.js"></script>
    <script src="../assets/js/pages/form_elements.js"></script>
    <script type="text/javascript">
    $('#provinces').change(function() {
        var id_province = $(this).val();

        $.ajax({
            type: "POST",
            url: "ajax_db.php",
            data: {
                id: id_province,
                function: 'provinces'
            },
            success: function(data) {

                console.log(data);
                $('#amphures').html(data);
                $("select").material_select('update');

                $('#districts').html(' ');
                $('#districts').val(' ');
                $('#zip_code').val(' ');
            }
        });
    });

    $('#amphures').change(function() {
        var id_amphures = $(this).val();

        $.ajax({
            type: "POST",
            url: "ajax_db.php",
            data: {
                id: id_amphures,
                function: 'amphures'
            },
            success: function(data) {
                $('#districts').html(data);
                $("select").material_select('update');

            }
        });
    });

    $('#districts').change(function() {
        var id_districts = $(this).val();

        $.ajax({
            type: "POST",
            url: "ajax_db.php",
            data: {
                id: id_districts,
                function: 'districts'
            },
            success: function(data) {
                $('#zip_code').val(data)
                $('#label_zip_code').addClass('active');
                $("select").material_select('update');

            }
        });

    });
    </script>

</body>

</html>
<?php } ?>