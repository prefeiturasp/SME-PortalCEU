<?php
/*
 * Template Name: Página Mais Notícias
 * Description: Página Mais Notícias, o layout de mais notícias
 */

use Classes\ModelosDePaginas\PaginaMaisNoticias\PaginaMaisNoticias;

get_header();
$pagina_mais_noticias = new PaginaMaisNoticias();
$pagina_mais_noticias->init();
get_footer();



