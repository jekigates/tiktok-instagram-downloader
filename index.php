<?php

$store_locally = true; /* change to false if you don't want to host videos locally */ 

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function downloadVideo($video_url, $geturl = false)
{
    $ch = curl_init();
    $headers = array(
        'Range: bytes=0-',
    );
    $options = array(
        CURLOPT_URL            => $video_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_FOLLOWLOCATION => true,
        CURLINFO_HEADER_OUT    => true,
        CURLOPT_USERAGENT => 'okhttp',
        CURLOPT_ENCODING       => "utf-8",
        CURLOPT_AUTOREFERER    => true,
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
    $filename = "user_videos/" . generateRandomString() . ".mp4";
    $d = fopen($filename, "w");
    fwrite($d, $data);
    fclose($d);
    return $filename;
}

if (isset($_GET['url']) && !empty($_GET['url'])) {
    if ($_SERVER['HTTP_REFERER'] != "") {
        $url = $_GET['url'];
        $name = downloadVideo($url);
        echo $name;
        exit();
    }
    else
    {
        echo "";
        exit();
    }
}

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

function getKey($playable)
{
  	$ch = curl_init();
  	$headers = [
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Accept-Encoding: gzip, deflate, br',
    'Accept-Language: en-US,en;q=0.9',
    'Range: bytes=0-200000'
	];

    $options = array(
        CURLOPT_URL            => $playable,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
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
    curl_close($ch);
    $tmp = explode("vid:", $data);
    if(count($tmp) > 1){
    	$key = trim(explode("%", $tmp[1])[0]);
    }
    else
    {
    	$key = "";
    }
    return $key;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
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
			$check = explode('"downloadAddr":"', $resp);
			if (count($check) > 1){
				$contentURL = explode("\"",$check[1])[0];
                $contentURL = str_replace("\\u0026", "&", $contentURL);
				$thumb = explode("\"",explode('og:image" content="', $resp)[1])[0];
				$username = explode('/',explode('"$pageUrl":"/@', $resp)[1])[0];
				$create_time = explode(',', explode('"createTime":', $resp)[1])[0];
				$dt = new DateTime("@$create_time");
				$create_time = $dt->format("d M Y H:i:s A");
				$videoKey = getKey($contentURL);
				$cleanVideo = "https://api2-16-h2.musical.ly/aweme/v1/play/?video_id=$videoKey&vr_type=0&is_play_url=1&source=PackSourceEnum_PUBLISH&media_type=4";
				$cleanVideo = getContent($cleanVideo, true);
				if (!file_exists("user_videos") && $store_locally){
					mkdir("user_videos");
				}
				if ($store_locally){
					?>
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('#wmarked_link').text("Please wait ...");
                            $.get('./<?php echo basename($_SERVER['PHP_SELF']); ?>?url=<?php echo urlencode($contentURL); ?>').done(function(data)
                                {
                                    $('#wmarked_link').removeAttr('disabled');
                                    $('#wmarked_link').attr('onclick', 'window.location.href="' + data + '"');
                                    $('#wmarked_link').text("Download Video");
                                });
                        });
                    </script>
                    <?php
				}
		?>
        <hr>
        <div class="row">
            <div class="col-xl-auto col-md-auto col-sm-12 d-flex justify-content-center mb-4">
                <img src="<?php echo $thumb; ?>" class="img-thumbnail" alt="" style="width: 20rem; height: 12rem;">
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
                        <button class="btn btn-primary" id="wmarked_link" type="button" onclick="window.location.href='<?php if ($store_locally){ echo $filename;} else { echo $contentURL; } ?>'">Download Video</button>
                        <button class="btn btn-info" type="button" onclick="window.location.href='<?php echo $cleanVideo; ?>'">Download Video Without Watermark</button>
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