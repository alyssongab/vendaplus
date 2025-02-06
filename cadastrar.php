<?php

require __DIR__.'/vendor/autoload.php';

// Validação do post
if (isset($_POST['produtos'], $_POST['valor'], $_POST['cliente'], $_POST['status'])) {
    die('cadastrar');
}

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario.php';
include __DIR__.'/includes/footer.php';
