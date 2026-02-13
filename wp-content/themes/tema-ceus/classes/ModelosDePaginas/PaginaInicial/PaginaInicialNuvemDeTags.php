<?php
namespace Classes\ModelosDePaginas\PaginaInicial;


class PaginaInicialNuvemDeTags
{

	public function __construct()
	{

		$this->montaHtmlNuvemTags();
	}

	public function montaHtmlNuvemTags(){

		echo '<article class="col">';

		$args = array(
			'smallest'                  => 8,
			'largest'                   => 22,
			'unit'                      => 'pt',
			'number'                    => 20,
			'format'                    => 'flat',
			'separator'                 => "\n",
			'orderby'                   => 'name',
			'order'                     => 'ASC',
			'exclude'                   => null,
			'include'                   => null,
			'topic_count_text_callback' => default_topic_count_text,
			'link'                      => 'view',
			'taxonomy'                  => 'post_tag',
			'echo'                      => true,
			'show_count'                  => 0,
			'child_of'                  => null, // see Note!
		);

		wp_tag_cloud($args);

		echo '</article>';
	}

}