<?php
include_once('includes/config.php');

if (isset($_POST['function']) && $_POST['function'] == 'provinces') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM amphures WHERE province_id='$id'";
    $query = $dbh->prepare($sql);
    $query->execute();
    foreach ($query as $value) {
        echo '<option value="' . $value['id'] . '">' . $value['name_th'] . '</option>';
    }
}


if (isset($_POST['function']) && $_POST['function'] == 'amphures') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM districts WHERE amphure_id='$id'";
    $query = $dbh->prepare($sql);
    $query->execute();
    foreach ($query as $value2) {
        echo '<option value="' . $value2['id'] . '">' . $value2['name_th'] . '</option>';
    }
}

if (isset($_POST['function']) && $_POST['function'] == 'districts') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM districts WHERE id='$id'";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results = $query->fetch(PDO::FETCH_OBJ);
    echo $results->zip_code;
    exit();
}