<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Video</title>
</head>
<body>
    <h1>Upload Video</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="video" accept="video/*">
        <button type="submit">Upload</button>
    </form>
</body>
</html>
