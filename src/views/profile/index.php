<?php  const APP_URL = "http://localhost/Instagram"; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo APP_URL . "/src/views/css/estilos.css" ?>">

    <title>Profile</title>
</head>

<body>
    <?php require_once "src/components/menu.php"; ?>

    <div class="container w-100">
        <h2>Profile <?php echo $this->d['user']->getUsername(); ?> </h2>

        <div class="containerGrid" id="containerGrid">
        <?php
        $user = $this->d['user'];
        $posts = $user->d['posts'];

       

        foreach ($user->getPosts() as $p) { ?>



            <div class="card mt-2">

                <div class="card-body">

                    <img class="imgPerfil rounded-circle" src="<?php echo  APP_URL . '/public/img/photos/' . $p->getUser()->getProfile() ?>" width="32" />

                    <a class="namePerfil link-dark" href="/profile/<?php echo $p->getUser()->getUsername() ?>">
                        <?php echo $p->getUser()->getUsername() ?>
                    </a>
                </div>

                <img  class="imgPost"  src="<?php echo  APP_URL . '/public/img/photos/' . $p->getImage() ?>" width="100%" />



                <div class="card-body">

                    <div class="card-title">
                        <form action="addLike" method="POST">
                            <input type="hidden" name="post_id" value="<?php echo $p->getId() ?>">
                            <input type="hidden" name="origin" value="profile">
                            <button type="submit" class="btnLike"><i class="fa-regular fa-heart"></i></button><br>
                            
                            <?php echo $p->getLikes() . " Me gusta" ?>
                        </form>
                    </div>
                    <p class="card-text"><?php echo $p->getTitle() ?></p>
                </div>

                <a href="/instagram/edit/<?php echo $p->getId(); ?>" class="editBtn"><i class="fa-solid fa-pen-to-square"></i></a>


            </div>

        <?php } ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



    <script>
        function handleResize() {
        var containerGrid = document.querySelector("#containerGrid");
         
    // Verificar si el ancho de la ventana es menor o igual a 992 píxeles
    if (window.innerWidth <= 992) {
            containerGrid.className = "";
    }else{
        containerGrid.className = "containerGrid";

    }
}

// Adjuntar el evento de redimensionamiento a la ventana
window.addEventListener('resize', handleResize);

// Llamada inicial para manejar la condición actual al cargar la página
handleResize();

        </script>

</body>

</html>