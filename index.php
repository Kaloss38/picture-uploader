<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Picture - Uploader</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="dist/style.css">
    <script src="main.js"></script>
</head>
    <body>

        <?php require("dist/header.php"); ?>
        
        <?php 
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                $error = 1;
            
                if($_FILES['image']['size'] <= 3000000){
                    $imageInfo = pathinfo($_FILES['image']['name']);
                    $imageExtension = $imageInfo['extension'];
                    $extensionsArray = array('png', 'jpg', 'jpeg', 'gif');
            
                    if(in_array($imageExtension, $extensionsArray)){
                        $pictureDirectory= 'uploads/'.time().rand().rand(). '.' . $imageExtension;
                        move_uploaded_file($_FILES['image']['tmp_name'], $pictureDirectory);
                        $error = 0;
                        
                    }
                }
            
            }
            
            
                
        ?>

        <div class="container">
        <article>
            <form method="post" action="index.php" enctype="multipart/form-data">
                <p> 
                    <h2> Upload your picture </h2>
                    <?php 
                    if(isset($error) && $error == 0){
                        echo '
                        <img src="'.$pictureDirectory.'" id="your_img" alt="Your picture" /><br/>
                        <p id="p_upload">Your picture has been uploaded.</p></br>
                        <input type="text" value="http://localhost/'.$pictureDirectory.'" /><br/>';
                    }elseif(isset($error) && $error == 1){
                        echo 'Your picture is invalid (3Mo min, jpeg, jpg, png, gif) <br/>';
                    }
                    ?> 
                    <input type="file" name="image"><br/>
                    <button type="submit">Upload</button>
                </p>
            </form>
        </article>
    </div>

    </body>
</html>
