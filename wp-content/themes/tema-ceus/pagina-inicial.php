<?php
/*
 * Template Name: Página Inicial do Portal
 * Description: Página Home do Novo Portal da SME
 */

use Classes\ModelosDePaginas\PaginaInicial\PaginaInicial;

get_header();

$paginaInicial = new PaginaInicial();

get_footer();



