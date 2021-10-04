<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
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
                <h2>TikTok Downloader</h2>
                <div class="input-group mt-4">
                    <input type="text" class="form-control" placeholder="Search or paste tiktok video link here" aria-label="Search or paste tiktok video link here" aria-describedby="btn-start">
                    <button class="btn btn-primary" type="button" id="btn-start">Start</button>
                </div>
                <p class="text-secondary mt-2">Want to download Instagram posts and videos? <a href="instagram.php" class="position-relative stretched-link">Click here</a></p>            
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-auto col-md-auto col-sm-12 d-flex justify-content-center mb-4">
                <img src="./image.jpg" class="img-thumbnail" alt="" style="width: 20rem; height: 12rem;">
            </div>

            <div class="col-xl-6 col-md-6 col-sm-12">
                <div class="">
                    <table class="table">
                        <tr>
                            <th>Video Title</th>
                            <td>:</td>
                            <td>Morning Sunlight</td>
                        </tr>
                        <tr>
                            <th>Upload Date</th>
                            <td>:</td>
                            <td>27 Sep 2021 15:46:43 PM</td>
                        </tr>
                    </table>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-primary" type="button">Download Video</button>
                        <button class="btn btn-info" type="button">Download Video Without Watermark</button>
                    </div>
                    <div class="alert alert-primary mt-4" role="alert">
                        If the video opens directly, try saving it by pressing CTRL+S or on phone, save from three dots in the bottom left corner
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>