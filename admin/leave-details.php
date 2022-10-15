<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {

    // code for update the read notification status
    $isread = 1;
    $did = intval($_GET['leaveid']);
    date_default_timezone_set('Asia/Bangkok');
    $admremarkdate = date('Y-m-d G:i:s ', strtotime("now"));
    $sql = "update tblleaves set IsRead=:isread where id=:did";
    $query = $dbh->prepare($sql);
    $query->bindParam(':isread', $isread, PDO::PARAM_STR);
    $query->bindParam(':did', $did, PDO::PARAM_STR);
    $query->execute();

    // code for action taken on leave
    if (isset($_POST['update'])) {
        $did = intval($_GET['leaveid']);
        $description = $_POST['description'];
        $status = $_POST['status'];
        date_default_timezone_set('Asia/Bangkok');
        $admremarkdate = date('Y-m-d G:i:s ', strtotime("now"));
        $sql = "update tblleaves set AdminRemark=:description,Status=:status,AdminRemarkDate=:admremarkdate where id=:did";
        $query = $dbh->prepare($sql);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->bindParam(':admremarkdate', $admremarkdate, PDO::PARAM_STR);
        $query->bindParam(':did', $did, PDO::PARAM_STR);
        $query->execute();
        $msg = "แก้ไขการลาเรียบร้อยแล้ว";
    }



?>
<!DOCTYPE html>
<html lang="th">

<head>

    <!-- Title -->
    <title>รายละเอียดการลา</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta charset="UTF-8">
    <meta name="description" content="Responsive Admin Dashboard Template" />
    <meta name="keywords" content="admin,dashboard" />
    <meta name="author" content="Steelcoders" />

    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="../assets/plugins/materialize/css/materialize.min.css" />
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../assets/plugins/material-preloader/css/materialPreloader.min.css" rel="stylesheet">
    <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">

    <link href="../assets/plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css" />
    <!-- Theme Styles -->
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
                <div class="page-title" style="font-size:24px;">รายละเอียดการลา</div>
            </div>

            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content">
                        <?php if ($msg) { ?><div class="succWrap"><strong>สำเร็จ</strong> :
                            <?php echo htmlentities($msg); ?> </div><?php } ?>
                        <table id="example" class="display responsive-table ">


                            <tbody>
                                <?php
                                    $lid = intval($_GET['leaveid']);
                                    $sql = "SELECT *,tblleaves.Status from tblleaves left join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.id=:lid";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':lid', $lid, PDO::PARAM_STR);
                                    $query->execute();
                                    $result = $query->fetch(PDO::FETCH_ASSOC);


                                    ?>

                                <tr>
                                    <td style="font-size:16px;"> <b>ชื่อพนักงาน :</b></td>
                                    <td><a href="editemployee.php?empid=<?php echo ($result['id']); ?>" target="_blank">
                                            <?php echo htmlentities($result['FirstName'] . " " . $result['LastName']); ?></a>
                                    </td>
                                    <td style="font-size:16px;"><b>รหัสพนักงาน :</b></td>
                                    <td><?php echo htmlentities($result['EmpId']); ?></td>
                                    <td style="font-size:16px;"><b>เพศ :</b></td>
                                    <td><?php echo htmlentities($result['Gender']); ?></td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b>อีเมล์พนักงาน :</b></td>
                                    <td><?php echo htmlentities($result['EmailId']); ?></td>
                                    <td style="font-size:16px;"><b>เบอร์โทรศัพท์พนักงาน :</b></td>
                                    <td><?php echo htmlentities($result['Phonenumber']); ?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b>ประเภทการลา :</b></td>
                                    <td><?php echo htmlentities($result['LeaveType']); ?></td>
                                    <td style="font-size:16px;"><b>วันที่ลา :</b></td>
                                    <td>วันที่เริ่ม
                                        <?php echo date('d/m/Y', strtotime("+543 years", strtotime(($result['ToDate'])))); ?>
                                        วันที่สิ้นสุด
                                        <?php echo date('d/m/Y', strtotime("+543 years", strtotime(($result['FromDate'])))); ?>
                                    </td>
                                    <td style="font-size:16px;"><b>วันที่โพลต์</b></td>
                                    <td><?php echo date('d/m/Y H:i:s', strtotime("+543 years", strtotime(($result['PostingDate'])))); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b>รายละเอียดการลา :</td>
                                    <td ><?php echo htmlentities($result['Description']); ?></td>


                                </tr>

                                <tr>
                                    <?php if
                        (!is_null($result['leave_picture'])){
                            $image_src = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/elms/images/" . $result['leave_picture'];                       
                        }
                        else{
                            $image_src = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/elms/images/download.png" ;                       
                        }?>
                                    <td style="font-size:16px;"><b>รูปภาพเพิ่มเติม : </b></td>
                                    <td colspan=""><img width=450px
                                            src="<?=    $image_src ?>">
                                    </td>

                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b>สถานะการลา :</b></td>
                                    <td colspan="5"><?php  $stats = $result['Status'];
                                                        if ($stats == 1) {
                                                        ?>
                                        <span style="color: green">อนุมัติ</span>
                                        <?php }
                                                        if ($stats == 2) { ?>
                                        <span style="color: red">ไม่อนุมัติ</span>
                                        <?php }
                                                        if ($stats == 0) { ?>
                                        <span style="color: blue">รอการอนุมัติ</span>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b>หมายเหตุ: </b></td>
                                    <td colspan="5"><?php
                                                        if ($result['AdminRemark'] == "") {
                                                            echo "รอการอนุมัติ";
                                                        } else {
                                                            echo htmlentities($result['AdminRemark']);
                                                        }
                                                        ?></td>
                                </tr>

                                <tr>
                                    <td style="font-size:16px;"><b>วันที่ดำเนินการของผู้ดูแลระบบ : </b></td>
                                    <td colspan="5"><?php
                                                        if ($result['AdminRemarkDate'] == "") {
                                                            echo "ยังไม่ได้ดำเนินการ";
                                                        } else {
                                                            echo htmlentities($result['AdminRemarkDate']);
                                                        }
                                                        ?></td>
                                </tr>
                                <?php
                                    if ($stats == 0) {

                                    ?>
                                <tr>
                                    <td colspan="5">
                                        <a class="modal-trigger waves-effect waves-light btn"
                                            href="#modal1">ดำเนินการ</a>
                                        <form name="adminaction" method="post">
                                            <div id="modal1" class="modal modal-fixed-footer" style="height: 60%">
                                                <div class="modal-content" style="width:90%">
                                                    <h4>ดำเนินการเกี่ยวกับการลา</h4>
                                                    <select class="browser-default" name="status" required="">
                                                        <option value="">เลือก</option>
                                                        <option value="1">อนุมัติ</option>
                                                        <option value="2">ไม่อนุมัติ</option>
                                                    </select></p>
                                                    <p><textarea id="textarea1" name="description"
                                                            class="materialize-textarea" name="description"
                                                            placeholder="รายละเอียด" length="500" maxlength="500"
                                                            required></textarea></p>
                                                </div>
                                                <div class="modal-footer" style="width:90%">
                                                    <input type="submit"
                                                        class="waves-effect waves-light btn blue m-b-xs" name="update"
                                                        value="บันทึก">
                                                </div>

                                            </div>

                                    </td>
                                </tr>
                                <?php } ?>
                                </form>
                                </tr>

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
    <script src="../assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/alpha.min.js"></script>
    <script src="../assets/js/pages/table-data.js"></script>
    <script src="assets/js/pages/ui-modals.js"></script>
    <script src="assets/plugins/google-code-prettify/prettify.js"></script>

</body>

</html>
<?php } ?>