<?php
include 'config.php';

$is_upload = false;
$msg = null;

if(isset($_POST['submit'])){
    $ext_arr = array('jpg','png','gif');
    $file_name = $_FILES['upload_file']['name'];
    $temp_file = $_FILES['upload_file']['tmp_name'];
    $file_ext = substr($file_name,strrpos($file_name,".")+1);
    $upload_file = UPLOAD_PATH . '/' . $file_name;

    if(move_uploaded_file($temp_file, $upload_file)){
        if(in_array($file_ext,$ext_arr)){
             $img_path = UPLOAD_PATH . '/'. rand(10, 99).date("YmdHis").".".$file_ext;
             rename($upload_file, $img_path);
             $is_upload = true;
        }else{
            $msg = "ֻ�����ϴ�.jpg|.png|.gif�����ļ���";
            unlink($upload_file);
        }
    }else{
        $msg = '�ϴ�����';
    }
}
?>

<div id="upload_panel">
    <ol>
            <h3>�뿪ʼ��ı���</h3>
            <form enctype="multipart/form-data" method="post">
                <p>Ҫ�ϴ���ͼƬ��<p>
                <input class="input_file" type="file" name="upload_file"/>
                <input class="button" type="submit" name="submit" value="�ϴ�"/>
            </form>
            <div id="msg">
                <?php 
                    if($msg != null){
                        echo "��ʾ��".$msg;
                    }
                ?>
            </div>
            <div id="img">
                <?php
                    if($is_upload){
                        echo '<img src="'.$img_path.'" width="250px" />';
                    }
                ?>
            </div>
        </li>
        
    </ol>
</div>

