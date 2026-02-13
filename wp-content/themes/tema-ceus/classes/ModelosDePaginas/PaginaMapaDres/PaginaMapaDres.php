<?php


namespace Classes\ModelosDePaginas\PaginaMapaDres;

use Classes\TemplateHierarchy\ArchiveContato\ArchiveContato;

class PaginaMapaDres extends ArchiveContato
{
    private $blocos_de_textos_adicionais;

	public function __construct()
	{
		$this->blocos_de_textos_adicionais = new PaginaMapaDresBlocosDeTextosAdicionais();
		$this->init();
	}

	public function init(){
		$container_geral_tags = array('section', 'section');
		$container_geral_css = array('container', 'row');
		$this->abreContainer($container_geral_tags, $container_geral_css);

		$this->getTituloPagina();
        $this->blocos_de_textos_adicionais->htmlMapaDresBlocoSuperior();
        $this->blocos_de_textos_adicionais->getTituloSubtituloMapa();
		$this->htmlMapaDresMapa();
		$this->htmlMapaDresBotoes();
		$this->blocos_de_textos_adicionais->htmlMapaDresBlocoInferior();
		$this->fechaContainer($container_geral_tags);
	}

	public function getTituloPagina(){
		echo '<article class="col-12">';
	        echo '<h1 class="mb-4" id="'.get_queried_object()->post_name.'">'.get_the_title().'</h1>';
		echo '</article>';
    }

	public function htmlMapaDresBotoes(){
		?>
		<section class="col-12 col-md-4 todas-dres">
			<?php new PaginaMapaDresBotoes() ?>

		</section>
		<?php
	}

	public function htmlMapaDresMapa(){
		?>

		<section class="col-12 col-md-8 d-none d-sm-block">
			<?php new PaginaMapaDresMapa()?>
		</section>

		<?php
	}

}