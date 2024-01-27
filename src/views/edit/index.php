<?php
const APP_URL = "http://localhost/Instagram";
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo APP_URL . "/src/views/css/estilos.css" ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <?php $post = $this->d['post']; ?>

    <h1>Editar</h1>
    <div class="container w-25">
        <div class="card mt-2">

            <div class="card-title">
                <form action="/instagram/editOn" method="POST" enctype="multipart/form-data" id="myForm">

                    <input type="hidden" value="<?php echo ($post['post_id']); ?>" name="post_id">
                    <input type="file"  class="w-50" name="image" accept="image/png, image/jpeg">


                    <input type="hidden" value="<?php echo ($post['media']); ?>" name="imagenDefault">

                    <img class="imgPost" id="previewImage" src="<?php echo  APP_URL . "/public/img/photos/" . ($post['media']) ?>" alt="" width="100%">


                    <input class="titleEdit" type="text" value="<?php echo ($post['title']); ?>" name="title">
                    <div class="d-flex justify-content-center ConEdit">
                        <button class="btn btn-primary" type="submit">Editar <i class="fa-solid fa-check"></i></button>
                    </div>



   


                </form>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var inputFile = document.querySelector('input[type="file"]');
        var previewImage = document.getElementById("previewImage");

        inputFile.addEventListener("change", function() {
            showImagePreview();
        });

        function showImagePreview() {
            var file = inputFile.files[0];
            console.log(file);

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                };

                reader.readAsDataURL(file);
            } else {
                // No se seleccionó ningún archivo
                previewImage.src = "<?php echo APP_URL . "/public/img/photos/" . ($post['media']) ?>";
            } 


        
        }
    });
</script>

</html>