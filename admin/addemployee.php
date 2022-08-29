<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['add'])) {
        $empid = $_POST['empcode'];
        $prefix = $_POST['prefix'];
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $department = $_POST['department'];
        $address = $_POST['address'];
        $provinces = $_POST['Ref_prov_id'];
        $districts = $_POST['Ref_dist_id'];
        $amphures = $_POST['Ref_subdist_id'];
        $zip_code = $_POST['zip_code'];
        $mobileno = $_POST['mobileno'];
        $Type_Employee = $_POST['Type_Employee'];
        $status = 1;

        $sql = "INSERT INTO tblemployees (EmpId,Prefix,FirstName,LastName,EmailId,Password,Gender,Dob,Department,Address,provinces,districts,amphures,zip_code,Phonenumber,Type_Employee,Status) VALUES(:empid,:prefix,:fname,:lname,:email,:password,:gender,:dob,:department,:address,:provinces,:districts,:amphures,:zip_code,:mobileno,:Type_Employee,:status)";
    
        $query = $dbh->prepare($sql);
        $query->bindParam(':empid', $empid, PDO::PARAM_STR);
        $query->bindParam(':prefix', $prefix, PDO::PARAM_STR);
        $query->bindParam(':fname', $fname, PDO::PARAM_STR);
        $query->bindParam(':lname', $lname, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':department', $department, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->bindParam(':provinces', $provinces, PDO::PARAM_STR);
        $query->bindParam(':districts', $districts, PDO::PARAM_STR);
        $query->bindParam(':amphures', $amphures, PDO::PARAM_STR);
        $query->bindParam(':zip_code', $zip_code, PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':Type_Employee', $Type_Employee, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        
        $query->execute();
      
        
         $lastInsertId = $dbh->lastInsertId();
         if ($lastInsertId) {
            $msg = "เพิ่มพนักงานเรียบร้อยแล้ว";
         } else {
             $error = "บางอย่างผิดพลาด กรุณาลองอีกครั้ง";
         }
    }

?>

<!DOCTYPE html>
<html lang="th">

<head>

    <!-- Title -->
    <title>เพิ่มพนักงาน</title>

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
    <script type="text/javascript">
    function valid() {
        if (document.addemp.password.value != document.addemp.confirmpassword.value) {
            alert("รหัสผ่านใหม่และฟิลด์ยืนยันรหัสผ่านไม่ตรงกัน !!");
            document.addemp.confirmpassword.focus();
            return false;
        }
        return true;
    }
    </script>

    <script>
    function checkAvailabilityEmpid() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'empcode=' + $("#empcode").val(),
            type: "POST",
            success: function(data) {
                $("#empid-availability").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
    </script>

    <script>
    function checkAvailabilityEmailid() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'emailid=' + $("#email").val(),
            type: "POST",
            success: function(data) {
                $("#emailid-availability").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
    </script>



</head>


<body>
    <?php include('includes/header.php'); ?>

    <?php include('includes/sidebar.php'); ?>
    <main class="mn-inner">
        <div class="row">
            <div class="col s12">
                <div class="page-title">เพิ่มพนักงาน</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <form id="example-form" method="post" name="addemp" enctype="multipart/form-data">
                            <div>
                                <h3>รายละเอียดพนักงาน</h3>
                                <section>
                                    <div class="wizard-content">
                                        <div class="row">
                                            <div class="col m6">
                                                <div class="row">
                                                    <?php if ($error) { ?><div class="errorWrap">
                                                        <strong>ข้อผิดพลาด</strong>:<?php echo htmlentities($error); ?>
                                                    </div><?php } else if ($msg) { ?><div class="succWrap">
                                                        <strong>สำเร็จ</strong>:<?php echo htmlentities($msg); ?>
                                                    </div>
                                                    <?php } ?>


                                                    <div class="input-field col  s12">
                                                        <label for="empcode">รหัสพนักงาน (ต้องไม่ซ้ำกัน)</label>
                                                        <input name="empcode" id="empcode"
                                                            onBlur="checkAvailabilityEmpid()" type="text"
                                                            autocomplete="off" required>
                                                        <span id="empid-availability" style="font-size:12px;"></span>
                                                    </div>

                                                    <div class="input-field col  s12">
                                                        <label for="prefix">คำนำหน้าชื่อ</label>
                                                        <input id="prefix" name="prefix" type="text" required>
                                                    </div>


                                                    <div class="input-field col m6 s12">
                                                        <label for="firstName">ชื่อ</label>
                                                        <input id="firstName" name="firstName" type="text" required>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="lastName">นามสกุล</label>
                                                        <input id="lastName" name="lastName" type="text"
                                                            autocomplete="off" required>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="email">อีเมล์</label>
                                                        <input name="email" type="email" id="email"
                                                            onBlur="checkAvailabilityEmailid()" autocomplete="off"
                                                            required>
                                                        <span id="emailid-availability" style="font-size:12px;"></span>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="password">รหัสผ่าน</label>
                                                        <input id="password" name="password" type="password"
                                                            autocomplete="off" required>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="confirm">ยีนยันรหัสผ่าน</label>
                                                        <input id="confirm" name="confirmpassword" type="password"
                                                            autocomplete="off" required>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <select name="gender" id="gender" autocomplete="off" required=""
                                                            aria-required="true">
                                                            <option disabled selected value="">เพศ...</option>
                                                            <option value="ชาย">ชาย</option>
                                                            <option value="หญิง">หญิง</option>
                                                            <option value="อื่นๆ">อื่นๆ</option>
                                                        </select>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="birthdate">วันเกิด</label>
                                                        <input id="birthdate" name="dob" type="date" class="datepicker"
                                                            autocomplete="off" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col m6">
                                                <div class="row">
                                                    <div class="input-field col  s12">
                                                        <select name="department" autocomplete="off" required=""
                                                            aria-required="true">
                                                            <option disabled selected value="">เลือกแผนก...</option>
                                                            <?php $sql = "SELECT DepartmentName from tbldepartments";
                                                                $query = $dbh->prepare($sql);
                                                                $query->execute();
                                                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                                $cnt = 1;
                                                                if ($query->rowCount() > 0) {
                                                                    foreach ($results as $result) {   ?>
                                                            <option
                                                                value="<?php echo htmlentities($result->DepartmentName); ?>">
                                                                <?php echo htmlentities($result->DepartmentName); ?>
                                                            </option>
                                                            <?php }
                                                                } ?>
                                                        </select>
                                                    </div>
                                                    <div class=" input-field col s12">
                                                        <label for="address">ที่อยู่</label>
                                                        <input id="address" name="address" type="text"
                                                            autocomplete="off" required>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <select id="provinces" name="Ref_prov_id" autocomplete="off"
                                                            required="" aria-required="true">
                                                            <option disabled selected value="">เลือกจังหวัด...</option>
                                                            <?php
                                                                $sql_provinces = "SELECT * FROM provinces";
                                                                $query = $dbh->prepare($sql_provinces);
                                                                $query->execute();

                                                                foreach ($query as $value) { ?>
                                                            <option value="<?= $value['id'] ?>"><?= $value['name_th'] ?>
                                                            </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <select id="amphures" name="Ref_dist_id" autocomplete="off"
                                                            required="" aria-required="true">
                                                            <option disabled value="">เลือกอำเภอ / แขวง...</option>

                                                        </select>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <select id="districts" name="Ref_subdist_id" autocomplete=" off"
                                                            required="" aria-required="true">
                                                            <option disabled selected value="">เลือกตำบล / เขต...
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label id="label_zip_code" for="zip_code">รหัสไปรณีย์</label>
                                                        <input id="zip_code" name="zip_code" type="text"
                                                            autocomplete="off" required>
                                                    </div>


                                                    <div class="input-field col m6 s12">
                                                        <label for="phone">เบอร์โทรศัพท์</label>
                                                        <input id="phone" name="mobileno" type="tel" maxlength="10"
                                                            autocomplete="off" required>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <select name="Type_Employee" id="Type_Employee"
                                                            autocomplete="off" required="" aria-required="true">
                                                            <option disabled selected value="">ประเภทพนักงาน...</option>
                                                            <option value="พนักงานทั่วไป">พนักงานทั่วไป</option>
                                                            <option value="แอดมิน">แอดมิน</option>
                                                        </select>
                                                    </div>


                                                    <div class="input-field col s12">
                                                        <button type="submit" name="add" onclick="return valid();"
                                                            id="add"
                                                            class="waves-effect waves-light btn indigo m-b-xs">บันทึก</button>

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



</body>

</html>
<?php } ?>

<script>
// for HTML5 "required" attribute
$("select[required]").css({
    display: "inline",
    position: "absolute",
    float: "left",
    padding: 0,
    margin: 0,
    border: "1px solid rgba(255,255,255,0)",
    height: 0,
    width: 0,
    top: "2em",
    left: "3em",
    opacity: 0,
    pointerEvents: "none",
});
$("#birthdate").prop('required', true);
</script>

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