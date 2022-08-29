     <aside id="slide-out" class="side-nav white fixed">
         <div class="side-nav-wrapper">
             <div class="sidebar-profile">
                 <div class="sidebar-profile-image">
                     <?php
                        $eid = $_SESSION['eid'];
                        $sql2 = "SELECT * from  tblemployees left join picture on picture.eid = tblemployees.id where tblemployees.id  =:eid";
                        $query2 = $dbh->prepare($sql2);
                        $query2->bindParam(':eid', $eid, PDO::PARAM_STR);
                        $query2->execute();
                        $results2 = $query2->fetch(PDO::FETCH_ASSOC);
                        if (!is_null($results2['path'])) {
                            $image_src = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/images/" . $results2['path'];
                        } else {
                            $image_src = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/images/default.png";
                        }
                        ?>
                     <a
                         href="admin/form-images.php?eid=<?= $_SESSION['eid'] ?>&redirecturl=<?= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"><img
                             src="<?= $image_src  ?>" class="circle" alt=""></a>
                 </div>
                 <div class="sidebar-profile-info">
                     <?php
                        $eid = $_SESSION['eid'];
                        $sql = "SELECT FirstName,LastName,EmpId,Type_Employee,Prefix from  tblemployees where id=:eid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {               ?>
                     <p><?php echo htmlentities($result->Prefix . " " . $result->FirstName . " " . $result->LastName); ?>
                     </p>
                     <span>รหัสพนักงาน : </span><span><?php echo htmlentities($result->EmpId) ?></span> <br>
                     <span><?php echo htmlentities($result->Type_Employee) ?></span>
                     <?php }
                        } ?>
                 </div>
             </div>

             <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">

                 <li class="no-padding"><a class="waves-effect waves-grey" href="myprofile.php"><i
                             class="material-icons">account_box</i>โปรไฟล์ของฉัน</a></li>
                 <li class="no-padding"><a class="waves-effect waves-grey" href="emp-changepassword.php"><i
                             class="material-icons">settings_input_svideo</i>เปลี่ยนรหัสผ่าน</a></li>
                 <li class="no-padding">
                     <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">apps</i>การลา<i
                             class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                     <div class="collapsible-body">
                         <ul>
                             <li><a href="apply-leave.php">ลางาน</a></li>
                             <li><a href="leavehistory.php">ประวัติการลา</a></li>
                         </ul>
                     </div>
                 </li>



                 <li class="no-padding">
                     <a class="waves-effect waves-grey" href="logout.php"><i
                             class="material-icons">exit_to_app</i>ออกจากระบบ</a>
                 </li>


             </ul>
         </div>
     </aside>