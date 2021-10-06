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
    .post{
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
    }
    .post-header{
      padding: .5rem 1rem;
      margin-bottom: 0;
      background-color: rgba(0,0,0,.01);
      border: 1px solid rgba(0,0,0,.125);
      font-size: 12px;
    }
    .post-body{
      flex: 1 1 auto;
      padding: 1rem 1rem;
      background-color: rgb(255,255,255);
      border: 1px solid rgba(0,0,0,.125);
    }
    .profile-img{
      width: 25px;
      height: 25px;
      border-radius: 50%;
      margin-right: 1vw;
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
      if (!empty(strpos($url, 'instagram.com/reel'))) {
        $url = str_replace('instagram.com/reel','instagram.com/p',$url);
      }
      $post_data = new InstagramDownload($url);
      ?>
      <hr>
      <div class="row justify-content-center">
      <?php
      try {
        $pd = json_decode($post_data->getData());
        // print_r($pd);

        if ($pd->is_carousel) {
          
          foreach ($pd->post_data as $data ) {
            
            ?>
            <div class="post m-3 p-0" style="width: 18rem; min-height: 15vh">
              <div class="post-header d-flex flex-row align-items-center">
                <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents($pd->owner->profile_pic_url)) ?>" class="profile-img" alt="">
                <p class="m-0"><?php echo $pd->owner->username ?></p>
              </div>
              <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents($data->thumbnail)) ?>" class="" alt="" style="width: 100%; height: 100%;">
              <div class="post-body">
                <div class="d-flex flex-row mb-3 justify-content-around">
                  <p class="m-0"><?php echo $pd->post_comments_count.' Comments'; ?></p>
                <?php
                  if ($data->is_video) {
                    ?>
                    <p class="m-0"><?php echo $data->video_view_count.' Views'; ?></p>
                    </div>
                    <div class="d-flex flex-column align-items-center ">
                      <button class="btn btn-primary" onclick="window.open('<?php echo $data->video_url.'&dl=1' ?>' ,'_blank')">Download Video .mp4</button>
                    </div>
                    <?php
                  }
                  else {
                    ?>
                    </div>
                    <div class="d-flex flex-column align-items-center ">
                      <button class="btn btn-primary my-2" onclick="window.open('<?php echo $data->display_resources[0]->src.'&dl=1' ?>' ,'_blank')">Download Photo <?php echo $data->display_resources[0]->config_width.'x'.$data->display_resources[0]->config_height ?> </button>
                      <button class="btn btn-primary my-2" onclick="window.open('<?php echo $data->display_resources[1]->src.'&dl=1' ?>' ,'_blank')">Download Photo <?php echo $data->display_resources[1]->config_width.'x'.$data->display_resources[1]->config_height ?> </button>
                      <button class="btn btn-primary my-2" onclick="window.open('<?php echo $data->display_resources[2]->src.'&dl=1' ?>' ,'_blank')">Download Photo <?php echo $data->display_resources[2]->config_width.'x'.$data->display_resources[2]->config_height ?> </button>
                    </div>
                    <?php
                  }
                ?>
              </div>
            </div>
          <?php
          }
        }
        else{
          ?>
          <div class="post m-3 p-0" style="width: 18rem; min-height: 15vh">
            <div class="post-header d-flex flex-row align-items-center">
              <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents($pd->owner->profile_pic_url)) ?>" class="profile-img" alt="">
              <p class="m-0"><?php echo $pd->owner->username ?></p>
            </div>
            <img src="<?php echo 'data:image/jpg;base64,'.base64_encode(file_get_contents($pd->thumbnail)) ?>" class="" alt="" style="width: 100%; height: 100%;">
            <div class="post-body">
              <div class="d-flex flex-row mb-3 justify-content-around">
                <p class="m-0"><?php echo $pd->post_comments_count.' Comments'; ?></p>
              <?php
                if ($pd->is_video) {
                  ?>
                  <p class="m-0"><?php echo $pd->video_view_count.' Views'; ?></p>
                  </div>
                  <div class="d-flex flex-column align-items-center ">
                    <button class="btn btn-primary" onclick="window.open('<?php echo $pd->video_url.'&dl=1' ?>' ,'_blank')">Download Video .mp4</button>
                  </div>
                  <?php
                }
                else {
                  ?>
                  </div>
                  <div class="d-flex flex-column align-items-center ">
                    <button class="btn btn-primary my-2" onclick="window.open('<?php echo $pd->display_resources[0]->src.'&dl=1' ?>' ,'_blank')">Download Photo <?php echo $pd->display_resources[0]->config_width.'x'.$pd->display_resources[0]->config_height ?> </button>
                    <button class="btn btn-primary my-2" onclick="window.open('<?php echo $pd->display_resources[1]->src.'&dl=1' ?>' ,'_blank')">Download Photo <?php echo $pd->display_resources[1]->config_width.'x'.$pd->display_resources[1]->config_height ?> </button>
                    <button class="btn btn-primary my-2" onclick="window.open('<?php echo $pd->display_resources[2]->src.'&dl=1' ?>' ,'_blank')">Download Photo <?php echo $pd->display_resources[2]->config_width.'x'.$pd->display_resources[2]->config_height ?> </button>
                  </div>
                  <?php
                }
              ?>
            </div>
          </div>
      <?php }
      ?></div><?php
      }catch (Exception $e) {
        // print_r($e);
        ?>
        <script>
          alert('Please check your Instagram content url again!');
          window.location.href = './<?php echo basename($_SERVER['PHP_SELF']) ?>'
        </script>
        <?php
      }
      unset($_POST);
    }
    ?>
  </div>
</body>
</html>