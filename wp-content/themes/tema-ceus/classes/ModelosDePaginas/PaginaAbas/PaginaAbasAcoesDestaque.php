<?php

namespace Classes\ModelosDePaginas\PaginaAbas;


class PaginaAbasAcoesDestaque extends PaginaAbas
{
	protected $deseja_exibir_paginas_acoes_em_destaque;
	protected $escolha_as_paginas_acoes_em_destaque;
	protected $array_id_paginas_acoes_em_destaque = array();
	protected $args_paginas_acoes_em_destaque;
	protected $query_paginas_acoes_em_destaque;

	public function __construct()
	{
		parent::__construct();
		$this->deseja_exibir_paginas_acoes_em_destaque = get_field('deseja_exibir_paginas_acoes_em_destaque', $this->page_id);
		$this->escolha_as_paginas_acoes_em_destaque = get_field('escolha_as_paginas_acoes_em_destaque', $this->page_id);
		$this->init();
	}

	public function init(){
		if ($this->deseja_exibir_paginas_acoes_em_destaque === 'sim') {
			$this->montaArrayIdsPaginas();
			if ($this->array_id_paginas_acoes_em_destaque) {
				$this->getQueryPaginasAcoesDestaque();
				$this->montaHtmlPaginasAcoesDestaque();
			}
		}else{
			return;
		}
	}

	public function montaArrayIdsPaginas(){

		if ($this->escolha_as_paginas_acoes_em_destaque) {

			foreach ($this->escolha_as_paginas_acoes_em_destaque as $id_page) {
				$array_paginas[] = $id_page->ID;
			}
			$this->array_id_paginas_acoes_em_destaque = $array_paginas;
		}
	}

	public function getQueryPaginasAcoesDestaque(){
		$this->args_paginas_acoes_em_destaque = array(
			'post_type' => 'page',
			'post__in' => $this->array_id_paginas_acoes_em_destaque
		);

		$this->query_paginas_acoes_em_destaque = new \WP_Query($this->args_paginas_acoes_em_destaque);
	}

	public function montaHtmlPaginasAcoesDestaque(){

		$container_paginas_tags = array('section', 'section', 'section');
		$container_paginas_css = array('container mb-5', 'row mt-5', 'col-lg-12 col-sm-12');
		$this->abreContainer($container_paginas_tags, $container_paginas_css );
		if ($this->query_paginas_acoes_em_destaque->have_posts()) {
			echo '<h2 class="border-bottom fonte-vintequatro pb-2 font-weight-bold mb-4">AÇÕES EM DESTAQUE</h2>';
		}

		if ($this->query_paginas_acoes_em_destaque->have_posts()):
			while ($this->query_paginas_acoes_em_destaque->have_posts()): $this->query_paginas_acoes_em_destaque->the_post();

				$thumb = get_the_post_thumbnail_url($this->query_paginas_acoes_em_destaque->ID);
				$url = get_the_permalink($this->query_paginas_acoes_em_destaque->ID);
				$post_thumbnail_id = get_post_thumbnail_id( $this->query_paginas_acoes_em_destaque->ID );
				$image_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true);

				$container_interno_paginas_tags = array('section', 'article');
				$container_interno_paginas_css = array('row mb-5', 'col-lg-9 col-sm-12');
				$this->abreContainer($container_interno_paginas_tags, $container_interno_paginas_css);
				if (has_post_thumbnail()){
					echo '<figure>';
					//echo the_post_thumbnail('thumbnail', array('class' => 'img-fluid rounded float-left mr-4'));
					echo '<img src="'.$thumb.'" class="img-fluid rounded float-left mr-4 w-25" alt="'.$image_alt.'"/>';


					echo '</figure>';
				}
				echo '<h3 class="fonte-dezoito font-weight-bold mb-4"><a class="text-decoration-none text-dark" href="'.get_the_permalink().'">'.get_the_title().'</a></h3>';
				if (get_the_excerpt()) {
					echo '<p class="fonte-dezesseis mb-4">' . get_the_excerpt() . '</p>';
				}
				//echo '<a class="font-weight-bold" href="'.get_the_permalink().'">Ir para '.get_the_title().'</a>';
				$this->fechaContainer($container_interno_paginas_tags);
			endwhile;
		endif;

		if ($this->query_paginas_acoes_em_destaque->have_posts()) {
			/*$container_bt_tags = array('section', 'article');
			$container_bt_css = array('row', 'col-lg-9 col-sm-12');
			$this->abreContainer($container_bt_tags, $container_bt_css);
			echo '<a role="button" href="javascript:;"
				   class="btn btn-primary btn-sm btn-block bg-azul-escuro font-weight-bold text-white">
					Mais ações
				</a>';

			$this->fechaContainer($container_bt_tags);*/

			$this->fechaContainer($container_paginas_tags);
		}
	}
}