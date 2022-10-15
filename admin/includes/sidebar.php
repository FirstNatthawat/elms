     <aside id="slide-out" class="side-nav white fixed">
         <div class="side-nav-wrapper">
             <div class="sidebar-profile">
                 <div class="sidebar-profile-image">
                     <?php
                        $eid = $_SESSION['eid'];
                        $sql2 = "SELECT * from  tblemployees left join picture on picture.eid = tblemployees.id where tblemployees.id  =:eid order by picture.id desc";
                        $query2 = $dbh->prepare($sql2);
                        $query2->bindParam(':eid', $eid, PDO::PARAM_STR);
                        $query2->execute();
                        $results2 = $query2->fetch(PDO::FETCH_ASSOC);
                        if
                        (!is_null($results2['path'])){
                            $image_src = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/elms/images/" . $results2['path'];                       
                        }
                        else{
                            $image_src = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/elms/images/default.png" ;                       
                        }
?>
                     <a
                         href="form-images.php?eid=<?= $_SESSION['eid'] ?>&redirecturl=<?=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>"><img
                             src="<?= $image_src  ?>" alt=""></a>
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
                     <span>ประเภทพนักงาน :<?php echo htmlentities($result->Type_Employee) ?></span>
                     <?php }
                        } ?>
                 </div>
             </div>

             <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">
                 <li class="no-padding"><a class="waves-effect waves-grey" href="dashboard.php"><i
                             class="material-icons">settings_input_svideo</i>แผงควบคุม</a></li>
                 <li class="no-padding">
                     <a class="collapsible-header waves-effect waves-grey"><i class="material-icons">apps</i>แผนก<i
                             class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                     <div class="collapsible-body">
                         <ul>
                             <li><a href="adddepartment.php">เพิ่มแผนก</a></li>
                             <li><a href="managedepartments.php">จัดการแผนก</a></li>
                         </ul>
                     </div>
                 </li>
                 <li class="no-padding">
                     <a class="collapsible-header waves-effect waves-grey"><i
                             class="material-icons">code</i>ประเภทการลา<i
                             class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                     <div class="collapsible-body">
                         <ul>
                             <li><a href="addleavetype.php">เพิ่มประเภทการลา</a></li>
                             <li><a href="manageleavetype.php">จัดการประเภทการลา</a></li>
                         </ul>
                     </div>
                 </li>
                 <li class="no-padding">
                     <a class="collapsible-header waves-effect waves-grey"><i
                             class="material-icons">account_box</i>พนักงาน<i
                             class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                     <div class="collapsible-body">
                         <ul>
                             <li><a href="addemployee.php">เพิ่มพนักงาน</a></li>
                             <li><a href="manageemployee.php">จัดการพนักงาน</a></li>

                         </ul>
                     </div>
                 </li>

                 <li class="no-padding">
                     <a class="collapsible-header waves-effect waves-grey"><i
                             class="material-icons">desktop_windows</i>จัดการการลา<i
                             class="nav-drop-icon material-icons">keyboard_arrow_right</i></a>
                     <div class="collapsible-body">
                         <ul>
                             <li><a href="leaves.php">การลาทั้งหมด</a></li>
                             <li><a href="pending-leavehistory.php">รอดำเนินการการลา</a></li>
                             <li><a href="approvedleave-history.php">อนุมัติการลา</a></li>
                             <li><a href="notapproved-leaves.php">ไม่อนุมัติการลา</a></li>

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