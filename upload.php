

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body class="container">

<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3 container">
        <label class="form-label">Obrázek k uploadu:</label>
        <input class="form-control" type="file" name="uploadedName" accept=".mp4, .webm, .ogg, .mp3, .wav, .ogg, .jpg, .jpeg, .png, .gif, .bmp"/>
        <input class="btn btn-primary" type="submit" value="Nahrát" name="submit"/>
    </div>
</form>
<?php
if($_FILES) {
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES['uploadedName']['name']);
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $uploadSuccess = true;

    if($_FILES['uploadedName']['error'] != 0) {
        echo "Chyba serveru!";
        $uploadSuccess = false;
    }
    elseif(file_exists($targetFile)) {
        echo "Soubor už existuje!";
        $uploadSuccess = false;
    }
    elseif($_FILES['uploadedName']['size'] > 8388608) {
        echo "Soubor je moc velký!";
        $uploadSuccess = false;
    }
    elseif($fileType !== "mp4" && $fileType !== "webm" && $fileType !== "ogg" && $fileType !== "mp3" && $fileType !== "wav" && $fileType !== "jpg" && $fileType !== "jpeg" && $fileType !== "png" && $fileType !== "gif" && $fileType !== "png" && $fileType !== "bmp") {
        echo "Soubor nemá správný typ!";
        $uploadSuccess = false;
    }

    if(!$uploadSuccess) {
        echo " Došlo k chybě";
    }
    else {
        if(move_uploaded_file($_FILES['uploadedName']['tmp_name'], $targetFile)) {
            if( $fileType === "jpg" || $fileType === "jpeg" || $fileType === "png" || $fileType === "gif" || $fileType === "png" || $fileType === "bmp") {
                echo "<img class='img-fluid' src='$targetFile' alt='{$_FILES['uploadedName']['name']}' style='width: 60vw'/>";
            }
            elseif($fileType === "mp3" || $fileType === "wav" || $fileType === "ogg"){
                echo "<audio class='embed-responsive-item' controls src='$targetFile' autoplay='true' style='width: 60vw'/>";
            }
            elseif( $fileType === "mp4" || $fileType === "webm" || $fileType === "ogg"){
                echo "<video class='embed-responsive-item' controls src='$targetFile' autoplay='true' style='width: 60vw'/>";
            }
        }
        else " Došlo k chybě uploadu";
    }
}
?>
</body>
</html>