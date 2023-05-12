<?php

//echo "<script>console.log('entered')<\script>";
//echo  "<script>console.log(".$_FILES['myFile']['name'].")<\script>";
if (isset($_FILES['myFile'])) {
    // Example:
    $realpath="others/photos/".date(My)."/".$_POST['path'];
    $newfilename=$_POST['category']."-".$_POST['store']."-".date(j)."-".$_FILES['myFile']['name'];
   // echo "<script>console.log(".$realpath.")<\script>";
    if (!file_exists($realpath)) {
       $x= mkdir($realpath, 0777, true);
        if($x)
        {
            echo "<script>console.log('created')<\script>";
        }
        else{
            echo "<script>console.log('failed')<\script>";
        }
    }
    move_uploaded_file($_FILES['myFile']['tmp_name'], $realpath . $newfilename);
    echo 'successful';
    return;
}
?>