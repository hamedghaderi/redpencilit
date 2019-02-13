<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>
  <h1>Upload Your File</h1>
  <form action="/orders" method="POST" class="dropzone border border-dashed" enctype="multipart/form-data">
   <input type="file" name="document"> 
  </form>
  <script src="/js/vendors/dropzone.js"></script>
</body>
</html>