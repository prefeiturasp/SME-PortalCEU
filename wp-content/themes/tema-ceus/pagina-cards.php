<?php
/*
 * Template Name: Página Cards
 * Description: Página Cards, página que exibe título, texto, thumbnail, e os cards da taxonomia escolhida
 */

use Classes\ModelosDePaginas\PaginaCards\PaginaCards;

get_header();

$pagina_cards = new PaginaCards();

get_footer();



