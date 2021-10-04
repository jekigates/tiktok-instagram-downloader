<?php
    require_once('./src/InstagramDownload.php');

    if (isset($_POST['url'])) {
        $url = $_POST['url'];
        $client = new InstagramDownload($url);
        
        try {
            $link_download = $client->getDownloadUrl();
    
            header("Location: $link_download");
        } catch (Exception $e) {
            ?>
            <script>
                alert('Please check your Instagram content url again!');
            </script>
            <?php
        }
        unset($_POST);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.min.js"></script>
</head>
    <style>
        img {
            object-fit: cover;
        }
    </style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 text-center pt-4">
                <h2>Instagram Downloader</h2>
                <form action="" method="POST">
                    <div class="input-group mt-4">
                        <input type="text" name="url" id="url" class="form-control" placeholder="Search or paste instagram video or post link here" aria-label="Search or paste instagram video or post link here" aria-describedby="btn-download">
                        <button class="btn btn-primary" type="submit" id="btn-download">Download</button>
                    </div>
                </form>
                <p class="text-secondary mt-2">Want to download TikTok videos? <a href="index.php" class="position-relative stretched-link">Click here</a></p>            
            </div>
        </div>
    </div>
</body>
</html>