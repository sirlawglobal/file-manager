<!DOCTYPE html>
<html>
<head>
    <title>Multiple Image Upload Example</title>
    <style>
        .upload-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007BFF;
            color: #FFFFFF;
            border: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .upload-btn:hover {
            background-color: #0056b3;
        }

        #image-container {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .image-wrapper {
            margin: 10px;
        }

        img {
            width: 100%;
            max-width: 200px;
            max-height: 200px;
        }
    </style>
</head>
<body>

<h1>Upload Multiple Images</h1>

<button class="upload-btn" onclick="document.getElementById('file-input').click();">Upload Images</button>

<input type="file" id="file-input" accept="image/*" style="display: none;" multiple onchange="loadImages(event)">

<div id="image-container"></div>

<script>
    function loadImages(event) {
        var files = event.target.files;
        var imageContainer = document.getElementById('image-container');
        imageContainer.innerHTML = ''; // Clear existing images

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var url = URL.createObjectURL(file);

            var imageWrapper = document.createElement('div');
            imageWrapper.classList.add('image-wrapper');

            var img = document.createElement('img');
            img.src = url;
            img.alt = 'Uploaded Image';

            imageWrapper.appendChild(img);
            imageContainer.appendChild(imageWrapper);
        }

        if (files.length > 0) {
            imageContainer.style.display = 'flex';
        }
    }
</script>

</body>
</html>
