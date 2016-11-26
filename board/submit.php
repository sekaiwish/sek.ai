<?php
if (isset ($_FILES['fileToUpload'])) {
    $disallowed = array('bat','bin','cmd','cpl','gadget','inf','ins','inx','isu','job','jse','lnk','msc','msi','msp','mst','paf','pif','ps1','reg','sct','sh','shb','u3p','vb','vbe','vbs','vbscript','ws','wsf');

    $file_name = $_FILES['fileToUpload']['name'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_err = $_FILES['fileToUpload']['error'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_type = $_FILES['fileToUpload']['type']; //Unused
    
    $file_ext = explode('.',$_FILES['fileToUpload']['name']);
    $file_ext = end($file_ext);

    if ($file_size > 1000000000) {
        echo "ERROR: File cannot be larger than one gibibyte.";
        exit();
    }
    if (in_array($file_ext,$disallowed)) {
        echo ("ERROR: Specific executable filetypes and scripts are not allowed, for obvious reasons.");
        exit();
    }

    // !USE TO DUMP UPLOAD DATA!
    // !COMMENT HEADER REDIRECT!
    /*
    echo('[DUMP START]'
        .'<br>File Name: '.$file_name
        .'<br>File Size: '.$file_size
        .'<br>Temporary Disk Name: '.$file_tmp
        .'<br>File MIME: '.$file_type
        .'<br>File Extension: '.$file_ext
        .'<br>Error Code: '.$file_err
        .'<br>[DUMP END]<br><br>');
    */

    if (move_uploaded_file($file_tmp,"files/".$file_name)) {
        echo ("Upload successful.");
        header("Location: /board/files");
    } else {
        echo ("ERROR: Your upload was interrupted.<br>ERROR CODE: ".$file_err); //Write this to an error log
    }
}
?>