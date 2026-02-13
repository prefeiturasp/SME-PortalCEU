<?php

namespace Classes\ModelosDePaginas\PaginaMaisNoticias;


class PaginaMaisNoticiasTitulo extends PaginaMaisNoticias
{

	public function __construct()
	{
		$this->page_id = get_the_ID();
		$this->page_slug = get_queried_object()->post_name;
		$this->cabecalho();
	}

	public function cabecalho(){
		?>
		<article class="col-12">
            <h1 class="mb-5" id="<?= $this->page_slug ?>"><?php the_title(); ?></h1>
            <?php
            echo $this->getSubtitulo($this->page_id);
            ?>
		</article>
		<?php


	}

}