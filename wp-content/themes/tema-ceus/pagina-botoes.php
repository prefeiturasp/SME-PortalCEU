<?php
/*
 * Template Name: Página Botões
 * Description: Página Botões, página que exibe título, texto, categoria de botões
 */

use Classes\ModelosDePaginas\PaginaBotoes\PaginaBotoes;

get_header();
$pagina_botoes = new PaginaBotoes();
$pagina_botoes->init();
get_footer();



