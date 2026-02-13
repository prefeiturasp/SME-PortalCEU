<?php

namespace Classes\ModelosDePaginas\PaginaCards;

use Classes\Lib\Util;
use Classes\TemplateHierarchy\ArchiveContato\ExibirContatosTodasPaginas;

class PaginaCards extends Util
{
	protected $page_id;
	protected $args_cards;
	protected $query_cards;

	public function __construct()
	{
		$this->page_id = get_the_ID();
		$util = new Util($this->page_id);
		$util->montaHtmlLoopPadrao();
		$this->montaQueryCards();
		$this->montaHtmlCards();

		$contato_todas_paginas = new ExibirContatosTodasPaginas($this->page_id);
		$contato_todas_paginas->init();


	}

	public function montaQueryCards()
	{
		$taxonomia_cards = $this->getCamposPersonalizados('escolha_a_categoria_de_cards_que_deseja_exibir')->slug;

		$this->args_cards = array(
			'post_type' => 'card',
			'tax_query' => array(
				array(
					'taxonomy' => 'categorias-card',
					'field' => 'slug',
					'terms' => $taxonomia_cards,
				),
			),
		);
		$this->query_cards = new \WP_Query($this->args_cards);

	}

	public function montaHtmlCards()
	{
		echo '<section class="container">';
		echo '<section class="row">';
		echo '<section class="col-lg-12 col-xs-12 d-flex align-content-start flex-wrap">';
		if ($this->query_cards->have_posts()) : while ($this->query_cards->have_posts()) : $this->query_cards->the_post();

			?>
            <article class="card mb-3 mr-3 border-0 shadow-sm fonte-catorze mw-20">
                <article class="card-header card-header-card text-white font-weight-bold bg-color-titulo-cards">
                    <h2 class="fonte-catorze">
                        <a class="text-white stretched-link" href="<?= get_the_permalink() ?>">
							<?= get_the_title() ?>
                        </a>
                    </h2>
                </article>
                <article class="card-body">
                    <div class="card-text">
						<?= get_the_excerpt() ?>
                    </div>
                </article>
            </article>
		<?php
		endwhile;
		endif;
		wp_reset_postdata();
		echo '</section>';
		echo '</section>';
		echo '</section>';

	}

}