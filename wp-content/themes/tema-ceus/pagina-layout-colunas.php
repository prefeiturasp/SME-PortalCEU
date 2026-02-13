<?php
/*
 * Template Name: Página Layout Colunas
 * Description: Página Layout Colunas, página que permite escolher entre uma, duas ou três colunas
 */

use Classes\ModelosDePaginas\PaginaLayoutColunas\PaginaLayoutColunas;

get_header();
$pagina_layout_colunas = new PaginaLayoutColunas();
get_footer();



