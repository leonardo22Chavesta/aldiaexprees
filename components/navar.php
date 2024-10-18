<?php
  $ruta = '../../page/';
?>

<nav class="navbar navbar-expand-lg " style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Al Dia Exprex</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?=$ruta?>home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Envio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Mantenedores</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?=$ruta?>distritos">Distritos</a></li>
            <li><a class="dropdown-item" href="<?=$ruta?>servicios">Services</a></li>
            <li><a class="dropdown-item" href="<?=$ruta?>estado">Estado</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script src="../utils/bootstrap/css/bootstrap/js/bootstrap.bundle.min.js"></script>