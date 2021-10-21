<?php
function getContent($url, $geturl = false)
{
    $ch = curl_init();
    $options = array(
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Mobile Safari/537.36',
        CURLOPT_ENCODING       => "utf-8",
        CURLOPT_AUTOREFERER    => false,
        CURLOPT_COOKIEJAR      => 'cookie.txt',
	    CURLOPT_COOKIEFILE     => 'cookie.txt',
        CURLOPT_REFERER        => 'https://www.tiktok.com/',
        CURLOPT_CONNECTTIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_MAXREDIRS      => 10,
    );
    curl_setopt_array( $ch, $options );
    if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
      curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    }
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($geturl === true)
    {
        return curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    }
    curl_close($ch);
    return strval($data);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TikTok Downloader</title>
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
                <h2>TikTok Downloader</h2>
                <form action="" method="POST">
                    <div class="input-group mt-4">
                        <input type="text" name="tiktok-url" id="tiktok-url" class="form-control" placeholder="Search or paste tiktok video link here" aria-label="Search or paste tiktok video link here" aria-describedby="btn-start">
                        <button class="btn btn-primary" type="submit" id="btn-start">Start</button>
                    </div>
                </form>
                <p class="text-secondary mt-2">Want to download Instagram posts and videos? <a href="instagram.php" class="position-relative stretched-link">Click here</a></p>            
            </div>
        </div>

        <?php
		if (isset($_POST['tiktok-url']) && !empty($_POST['tiktok-url'])) {
			$url = trim($_POST['tiktok-url']);
			$resp = getContent($url);
      $urls = getContent("https://godownloader.com/api/tiktok-no-watermark-free?url=$url&key=godownloader.com");
      // print_r($urls);
			if (!isset(json_decode($urls)->error)){
				$thumb = explode("\"",explode('og:image" content="', $resp)[1])[0];
				$username = explode('/',explode('"$pageUrl":"/@', $resp)[1])[0];
				$create_time = explode(',', explode('"createTime":', $resp)[1])[0];
				$dt = new DateTime("@$create_time");
				$create_time = $dt->format("d M Y H:i:s A");

        $wmUrl = json_decode($urls)->video_watermark;
        $cvUrl = json_decode($urls)->video_no_watermark;
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
			}
			else
			{
				?>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-danger mb-0"><b>Please double check your url and try again.</b></div>
                    </div>
                </div>
				<?php
			}
		}
	?>


    </div>
</body>
</html>