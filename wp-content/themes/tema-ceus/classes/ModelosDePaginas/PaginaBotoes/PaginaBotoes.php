<?php

namespace Classes\ModelosDePaginas\PaginaBotoes;

use Classes\ModelosDePaginas\PaginaAbas\PaginaAbasBotoes;
use Classes\TemplateHierarchy\ArchiveContato\ExibirContatosTodasPaginas;

class PaginaBotoes extends PaginaAbasBotoes
{
	protected $page_id;
	protected $args_botoes;
	protected $query_botoes;
	protected $categoria_de_botoes;

	public function __construct()
	{
		$this->page_id = get_the_ID();
		$this->page_slug = get_queried_object()->post_name;
		$this->categoria_de_botoes = get_field('escolha_a_categoria_de_botoes_que_deseja_exibir', $this->page_id);
	}

	public function init(){

		$container_conteudo_principal_botoes_tags = array('section', 'section');
		$container_conteudo_principal_botoes_css = array('container', 'row');
		$this->abreContainer($container_conteudo_principal_botoes_tags, $container_conteudo_principal_botoes_css);
		$this->getConteudoPrincipal();

		$container_botoes_tags = array('section');
		$container_botoes_css = array('col-12 col-md-5');
		$this->abreContainer($container_botoes_tags, $container_botoes_css);
		$this->getQueryBotoes($this->categoria_de_botoes);
		$this->percorreCatBotoes();
		$this->fechaContainer($container_botoes_tags);

		$this->fechaContainer($container_conteudo_principal_botoes_tags);

		$contato_todas_paginas = new ExibirContatosTodasPaginas($this->page_id);
		$contato_todas_paginas->init();

	}

	public function getConteudoPrincipal(){

		if (have_posts()) : while (have_posts()) : the_post();
			?>

			<article class="col-lg-12 col-xs-12">
				<h1 class="mb-5" id="<?= $this->page_slug ?>"><?php the_title(); ?></h1>
			</article>

			<article class="col-12 col-md-7">
				<?php echo $this->getSubtitulo($this->page_id)?>
				<?php the_content(); ?>
			</article>

		<?php
		endwhile;
		endif;
		wp_reset_query();

	}

}