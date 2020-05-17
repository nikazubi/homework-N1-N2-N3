<?php
// საჭიროა images საქაღალდის ქონა
// Username : user
// Password : user
session_start();
class UploadHelper{
    public $uploadOk;
    public $target_file;
    public function __construct () {
        $this->target_file = 'images/' . basename($_FILES["image"]["name"]);
        $this->uploadOk = 1;
        $this->imageFileType = $_FILES["image"]["type"];
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $this->uploadOk = 1;
            } else {
                echo "File is not an image.";
                $this->uploadOk = 0;
            }
        }

    }
     public function imageSize(){
         if ($_FILES["image"]["size"] > 500000) {
             echo "Sorry, your file is too large.";
             $uploadOk = 0;
         }
     }
     public function imageFormat(){
         if( $_FILES["image"]["type"] !== 'image/jpeg') {
             echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
             $uploadOk = 0;
         }
     }
    public function imageUpload(){
        if ($this->uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        }
        else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $this->target_file)) {
                $_SESSION['img']=$this->target_file;
                header("Location: sessionstart.php");
            }
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
$image = new UploadHelper();
$image->imageSize();
$image->imageFormat();
$image->imageUpload();
?>