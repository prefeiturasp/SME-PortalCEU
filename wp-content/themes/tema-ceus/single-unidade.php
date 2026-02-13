<?php
use Classes\TemplateHierarchy\LoopUnidades\LoopUnidades;
get_header();
$loop_unidades = new LoopUnidades();
//contabiliza visualizações de noticias
setPostViews(get_the_ID()); /*echo getPostViews(get_the_ID());*/
get_footer();