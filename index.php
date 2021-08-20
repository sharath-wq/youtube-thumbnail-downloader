<?php 
    if(isset($_POST['download'])) {
        $imgUrl = $_POST['imgurl'];
        $ch = curl_init($imgUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $download = curl_exec($ch);
        curl_close($ch);
        header('content-type: image/jpg');
        header('content-Disposition: attachment; filename="thumbnail.jpg"');
        echo $download;
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download YouTube Thumbnail</title>
    <link rel="stylesheet" href="stylesheet.css">
    <!-- Font Awesome CDN link for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <header>Download Thumbnail</header>
        <div class="url-input">
            <span class="title">Paste video url:</span>
            <div class="field">
                <input type="text" placeholder="https://www.youtube.com" required>
                <input type="hidden" name="imgurl" class="hidden-input">
                <div class="bottom-line"></div>
            </div>
        </div>
        <div class="preview-area">
            <img class="thumbnail" src="" alt="Thumbnail">
            <i class="icon fas fa-cloud-download-alt"></i>
            <span>Paste video url to see preview</span>
        </div>
        <button class="download-btn" name="download" type="submit">Download Thumbnail</button>
    </form>
    <script>
        const urlField = document.querySelector(".field input")
const previewArea = document.querySelector(".preview-area")
const imgTag = previewArea.querySelector(".thumbnail")
const hiddenInput = document.querySelector(".hidden-input")

urlField.onkeyup = () => {
    let imgUrl = urlField.value
    previewArea.classList.add("active")

    if (imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1) {
        let vidId = imgUrl.split("v=")[1].substring(0, 11)
        let ytThumbUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`
        imgTag.src = ytThumbUrl
    } else if (imgUrl.indexOf("https://youtu.be/") != -1) {
        let vidId = imgUrl.split("be/")[1].substring(0, 11)
        let ytThumbUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`
        imgTag.src = ytThumbUrl
    } else {
        imgTag.src = "" 
        previewArea.classList.remove("active")
    }
    hiddenInput.value = imgTag.src
}
    </script>
</body>
</html>