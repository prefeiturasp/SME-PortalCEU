<?php
/*
 * Template Name: Página Mapa DRE`s
 * Description: Página Mapa DRE`s, bloco de texto e imagem acima, mapa das dres, respectivos botões e bloco de texto e imagem abaixo
 */

use Classes\ModelosDePaginas\PaginaMapaDres\PaginaMapaDres;

get_header();
$pagina_abas = new PaginaMapaDres();
get_footer();



