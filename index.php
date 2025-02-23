<?php
// filepath: /C:/xampp/htdocs/vendaplus/index.php
define('ROOT_DIR', __DIR__); // __DIR__ is the directory of the current file

require __DIR__.'/vendor/autoload.php';

include __DIR__.'/app/includes/header.php';
include __DIR__.'/app/includes/listagem.php'; // Remove a inclusão direta
include __DIR__.'/app/includes/footer.php';
