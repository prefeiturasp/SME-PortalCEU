<?php
/*
 * Template Name: Página Imagem ou Vídeo
 * Description: Página Imagem ou Vídeo, página que exibe uma coluna e permite escolher entre imagem ou vídeo
 */

use Classes\ModelosDePaginas\PaginaImagemVideo\PaginaImagemVideo;

get_header();

$pagina_cards = new PaginaImagemVideo();

get_footer();



