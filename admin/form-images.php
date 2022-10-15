<head>
<link rel="icon" type="image/x-icon" href="../favicon.ico">
</head>
<form method="post" enctype="multipart/form-data">
    <input name="file" type="file" onchange="preview()">
    <img name="image" id="image" src="" width="150px">
    <input type="submit" name="submit">
</form>

<?php
// uploading image on submit
if ($_POST) {
   /// echo "<pre>";
   // print_r($_FILES);
    //echo "</pre>";
    upload_image();
}
function upload_image()
{
    $eid = $_GET['eid'];
    $redirecturl=$_GET['redirecturl'];
    $uploadTo = "../images/";
    $allowedImageType = array('jpg', 'png', 'jpeg', 'gif');
    $imageName = $_FILES['file']['name'];
    $tempPath = $_FILES["file"]["tmp_name"];

    $basename = basename($imageName);
    $originalPath = $uploadTo . $basename;
    $imageType = pathinfo($originalPath, PATHINFO_EXTENSION);
    if (!empty($imageName)) {

        if (in_array($imageType, $allowedImageType)) {
            // Upload file to server 
            if (move_uploaded_file($tempPath, $originalPath)) {
                echo $imageName . " อัปโหลดเรียบร้อยแล้ว";
                // write here sql query to store image name in database
                include('includes/config.php');

                $sql = "INSERT INTO picture (path,eid) VALUES ('" . $imageName . "','" . $eid . "')";
                $query = $dbh->prepare($sql);
                $query->execute();
                header("location:$redirecturl");

            } else {
                echo 'ไม่สามารถอัปโหลดได้ โปรดลองอีกครั้ง';
            }
        } else {
            echo $imageType . " ไม่อนุญาตประเภทไฟล์นี้";
        }
    } else {
        echo "โปรดเลือกรูปภาพ";
    }
}
?>

<script>
function preview() {
    image.src = URL.createObjectURL(event.target.files[0]);
}
</script>