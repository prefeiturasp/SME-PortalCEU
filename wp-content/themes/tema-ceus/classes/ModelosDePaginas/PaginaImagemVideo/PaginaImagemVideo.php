<?php

namespace Classes\ModelosDePaginas\PaginaImagemVideo;


use Classes\Lib\Util;
use Classes\TemplateHierarchy\ArchiveContato\ExibirContatosTodasPaginas;

class PaginaImagemVideo extends Util
{
	protected $page_id;
	protected $page_template_slug;
	const MODELO_DE_PAGINA = 'pagina-imagem-video.php';

	public function __construct()
	{
		$this->page_id = get_the_ID();
		$this->page_slug = get_queried_object()->post_name;
		$this->montaHtmlLoopPadrao();
		$contato_todas_paginas = new ExibirContatosTodasPaginas($this->page_id);
		$contato_todas_paginas->init();
	}

	public function getImagemOuVideo(){

		$escolha = $this->getCamposPersonalizados('deseja_exibir_imagem_ou_video');

		if ($escolha == 'imagem' && trim($escolha) != ''){
			$this->getImagem();
		}elseif($escolha == 'video' && trim($escolha) != ''){
			$this->getVideo();
		}
	}

	public function getImagem(){

		$imagem = $this->getCamposPersonalizados('insira_a_imagem_desta_pagina');

        echo '<article class="row mb-4">';
        echo '<article class="col">';
        echo '<figure>';
        echo '<img class="img-fluid" src="'.$imagem["url"].'" alt="'.$imagem["alt"].'">';
        echo '</figure>';
        echo '</article>';
        echo '</article>';
	}

	public function getVideo(){

		$video = $this->getCamposPersonalizados('insira_o_video_desta_pagina');
		echo '<section class="embed-responsive embed-responsive-16by9 mb-4">';
		echo apply_filters('the_content', $video);
		echo '</section>';
	}

	public function montaHtmlLoopPadrao()
	{
		echo '<section class="container">';
		if (have_posts()) : while (have_posts()) : the_post();
			?>
			<section class="row">
				<article class="col-lg-9 col-xs-12">
					<h1 class="mb-5" id="<?= $this->page_slug ?>"><?php the_title(); ?></h1>
					<?php echo $this->getSubtitulo($this->page_id)?>
					<?= $this->getImagemOuVideo(); ?>
					<?php the_content(); ?>
				</article>
			</section>
		<?php
		endwhile;
		endif;
		wp_reset_query();
		echo '</section>'; //container
	}
}
