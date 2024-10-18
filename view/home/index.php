<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../utils/bootstrap/css/bootstrap/css/bootstrap-grid.min.css">
    <link  href="./../../utils/style/layout.css" media="all" rel="Stylesheet" type="text/css" /> 
    <link rel="stylesheet" href="./../../utils/style/normalize.css" />
    <title>Al Dia Express</title>
</head>
<body>
<?php
    $ruta = "../../page";
?>
    
   <header class="container header-custom">
     <nav>
        <div>
            <div class="logo"></div>
            <h2>AL DIA EXPRESS</h2>
        </div>
        <ul>
            <a href="<?=$ruta?>/distritos"><li>Inicio</li></a>
            <li>Servicios</li>
            <li>Contacto</li>
        </ul>
     </nav>
   </header>
   <div class="custom-container">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 text-center text-md-start">
                    <h1>Envíos rápidos y seguros en Lima y Callao</h1>
                    <p>AL DÍA EXPRESS: Tu mejor opción en paquetería y mensajería. Entrega el mismo día garantizada.</p>
                    <div>
                        <a href="#" class="btn btn-light me-2 mb-2">Cotizar envío</a>
                        <a href="#" class="btn btn-outline-light mb-2">Nuestros servicios</a>
                    </div>
                </div>
                <div class="col-md-7 d-none d-md-block">
                    <div class="slider-img"></div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>