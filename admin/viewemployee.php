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
        $msg = "????????????????????????????????????????????????????????????????????????????????????????????????";
    }


?>

<!DOCTYPE html>
<html lang="th">

<head>

    <!-- Title -->
    <title>?????????????????????????????????????????????</title>

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
    <link rel="icon" type="image/x-icon" href="../favicon.ico">

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
                <div class="page-title">?????????????????????????????????????????????</div>
            </div>
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <form id="example-form" method="post" name="updatemp">
                            <div>
                                <?php if ($error) { ?><div class="errorWrap">
                                    <strong>??????????????????????????????</strong>:<?php echo htmlentities($error); ?>
                                </div>
                                <?php } else if ($msg) { ?><div class="succWrap"><strong>??????????????????</strong> :
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
                                                        <label for="empcode">????????????????????????????????? (???????????????????????????????????????)</label>
                                                        <input name="empcode" id="empcode" readonly
                                                            value="<?php echo htmlentities($result->EmpId); ?>"
                                                            type="text" autocomplete="off" readonly required>
                                                        <span id="empid-availability" style="font-size:12px;"></span>
                                                    </div>

                                                    <div class="input-field col  s12">
                                                        <label for="prefix">????????????????????????????????????</label>
                                                        <input id="prefix" name="prefix" readonly
                                                            value="<?php echo htmlentities($result->Prefix); ?>"
                                                            type="text" required>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="firstName">????????????</label>
                                                        <input id="firstName" name="firstName" readonly
                                                            value="<?php echo htmlentities($result->FirstName); ?>"
                                                            type="text" required>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="lastName">?????????????????????</label>
                                                        <input id="lastName" name="lastName" readonly
                                                            value="<?php echo htmlentities($result->LastName); ?>"
                                                            type="text" autocomplete="off" required>
                                                    </div>

                                                    <div class="input-field col s12">
                                                        <label for="email">??????????????????</label>
                                                        <input name="email" type="email" id="email" readonly
                                                            value="<?php echo htmlentities($result->EmailId); ?>"
                                                            readonly autocomplete="off" required>
                                                        <span id="emailid-availability" style="font-size:12px;"></span>
                                                    </div>
                                                    <div class="input-field col m6 s12">
                                                        <label class="active" for="gender">?????????</label>
                                                        <select name="gender" id="gender" autocomplete="off" required=""
                                                            disabled="true" aria-required="true">
                                                            <option
                                                                value="<?php echo htmlentities($result->Gender); ?>">
                                                                <?php echo htmlentities($result->Gender); ?></option>
                                                            <option value="?????????">?????????</option>
                                                            <option value="????????????">????????????</option>
                                                            <option value="???????????????">???????????????</option>
                                                        </select>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <input id="birthdate" name="dob" class="datepicker"
                                                            disabled="true"
                                                            value="<?php echo htmlentities($result->Dob); ?>">
                                                    </div>


                                                </div>
                                            </div>

                                            <div class="col m6">
                                                <div class="row">

                                                    <div class="input-field col  s12">
                                                        <label for="department">????????????</label>
                                                        <select name="department" autocomplete="off" disabled="true">
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
                                                        <label for="address">?????????????????????</label>
                                                        <input id="address" name="address" type="text" readonly
                                                            value="<?php echo htmlentities($result->Address); ?>"
                                                            autocomplete="off" required>
                                                    </div>
                                                    <div class="input-field col  s12">
                                                        <select id="provinces" name="Ref_prov_id" autocomplete="off"
                                                            disabled="true" required="" aria-required="true">

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
                                                            disabled="true" required="" aria-required="true">
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
                                                            disabled="true" required="" aria-required="true">

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
                                                        <label id="label_zip_code" for="zip_code">?????????????????????????????????</label>
                                                        <input id="zip_code" name="zip_code" type="text" readonly
                                                            value="<?php echo htmlentities($result->zip_code); ?>"
                                                            autocomplete="off" required>
                                                    </div>

                                                    <div class="input-field col m6 s12">
                                                        <label for="phone">???????????????????????????????????????</label>
                                                        <input id="phone" name="mobileno" type="tel" readonly
                                                            value="<?php echo htmlentities($result->Phonenumber); ?>"
                                                            maxlength="10" autocomplete="off" required>
                                                    </div>

                                                    <div class="input-field col s12 ">
                                                        <label class="active" for="Type_Employee">???????????????????????????????????????</label>
                                                        <select name="Type_Employee" id="Type_Employee" disabled="true"
                                                            autocomplete="off" required="" aria-required="true">
                                                            <!-- <option
                                                                value="<?php echo nl2br($result->Type_Employee); ?>">
                                                                <?php echo nl2br($result->Type_Employee); ?>
                                                            </option> -->
                                                            <option value="???????????????????????????????????????"
                                                                <?php echo ($result->Type_Employee == "???????????????????????????????????????") ? "selected" : " " ?>>
                                                                ???????????????????????????????????????</option>
                                                            <option value="??????????????????"
                                                                <?php echo ($result->Type_Employee == "??????????????????") ? "selected" : " " ?>>
                                                                ??????????????????</option>
                                                        </select>
                                                    </div>

                                                    <?php }
                                                        } ?>


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
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">????????????????????????????????????</span>
                        <?php if ($msg) { ?><div class="succWrap"><strong>??????????????????</strong> :
                            <?php echo htmlentities($msg); ?> </div><?php } ?>
                        <table id="example" class="display responsive-table ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th width="200">?????????????????????????????????</th>
                                    <th width="120">?????????????????????????????????</th>

                                    <th width="180">?????????????????????????????????</th>
                                    <th>???????????????</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id WHERE tblemployees.id =$eid order by lid desc; ";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;
                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) {
                                    ?>

                                <tr>
                                    <td> <b><?php echo htmlentities($cnt); ?></b></td>
                                    <td><a href="editemployee.php?empid=<?php echo htmlentities($result->id); ?>"
                                            target="_blank"><?php echo htmlentities($result->FirstName . " " . $result->LastName); ?>(<?php echo htmlentities($result->EmpId); ?>)</a>
                                    </td>
                                    <td><?php echo htmlentities($result->LeaveType); ?></td>
                                    <td><?php echo date('d/m/Y H:i:s',strtotime("+543 years",strtotime(($result->PostingDate)))); ?>
                                    </td>
                                    <td><?php $stats = $result->Status;
                                                    if ($stats == 1) {
                                                    ?>
                                        <span style="color: green">?????????????????????</span>
                                        <?php }
                                                    if ($stats == 2) { ?>
                                        <span style="color: red">??????????????????????????????</span>
                                        <?php }
                                                    if ($stats == 0) { ?>
                                        <span style="color: blue">????????????????????????????????????</span>
                                        <?php } ?>


                                    </td>



                                </tr>
                                <?php $cnt++;
                                        }
                                    } ?>
                            </tbody>
                        </table>
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