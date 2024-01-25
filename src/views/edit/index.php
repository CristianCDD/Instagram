<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php $post = $this->d['post']; ?>
<?php const APP_URL = "http://localhost/Instagram/public/img/photos/";?>
   <h1>Hola</h1>

   <form action="/instagram/editOn"  method="POST" enctype="multipart/form-data">

   <input type="hidden" value="<?php echo($post['post_id']); ?>" name="post_id">
   <input type="file" class="w-50" name="image" accept="image/png, image/jpeg">

    <img src="<?php echo  APP_URL . ($post['media'])?>" alt="">
    <input type="text" value="<?php echo($post['title']); ?>" name="title">
    <button type="submit">Editar</button>

   </form>
</body>
</html>