<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Instagram</title>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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
    <?php
    require_once('./src/InstagramDownload.php');

    if (isset($_POST['url'])) {
      $url = $_POST['url'];
      $client = new InstagramDownload($url);
      
      try {
        $link_download = $client->getData();
          
          // header("Location: $link_download");
      ?>
        <hr>
        <div class="row">
          <div class="col-xl-auto col-md-auto col-sm-12 d-flex justify-content-center mb-4">
            <img src="<?php echo $thumb; ?>" class="img-thumbnail" alt="" style="width: 20rem; height: auto;">
          </div>

          <div class="col-xl-6 col-md-6 col-sm-12">
            <div class="">
              <table class="table">
                <tr>
                  <th>Creator</th>
                  <td>:</td>
                  <td>@<?php echo $username; ?></td>
                </tr>
                <tr>
                  <th>Upload Date</th>
                  <td>:</td>
                  <td><?php echo $create_time; ?></td>
                </tr>
              </table>
              <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-primary" type="button" onclick="window.location.href='<?php echo $wmUrl; ?>'">Download Video</button>
                <button class="btn btn-info" type="button" onclick="window.location.href='<?php echo $cvUrl; ?>'">Download Video Without Watermark</button>
              </div>
              <div class="alert alert-primary mt-4" role="alert">
                If the video opens directly, try saving it by pressing CTRL+S or on phone, save from three dots in the bottom left corner
              </div>
            </div>
          </div>
        </div>
        <?php
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
  </div>
</body>
</html>