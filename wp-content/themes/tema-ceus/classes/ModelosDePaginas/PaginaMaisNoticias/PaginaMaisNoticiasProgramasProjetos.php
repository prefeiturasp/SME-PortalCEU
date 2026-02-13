<?php

namespace Classes\ModelosDePaginas\PaginaMaisNoticias;


class PaginaMaisNoticiasProgramasProjetos extends PaginaMaisNoticias
{
	private $programas_projetos;
	public function __construct()
	{
		$this->programas_projetos = get_field('escolha_as_paginas_de_programas_ou_projetos', get_the_ID());

		$container_geral_tags = array('section', 'section');
		$container_geral_css = array('row bg-cinza-dre programas-projetos mb-5', 'container');
		$this->abreContainer($container_geral_tags, $container_geral_css);

		$this->getTitulo();
		$this->getPaginas();

		$this->fechaContainer($container_geral_tags);
	}

	public function getTitulo(){
		?>
			<p class="border-bottom fonte-vintequatro mb-4 pb-2 pt-2 pl-3 font-weight-bold">PROGRAMAS E PROJETOS</p>
		<?php
	}

	public function getPaginas(){

		echo '<section class="row">';
		if ($this->programas_projetos){
		foreach ($this->programas_projetos as $index => $pagina) {
			$cont = $index + 1;

			if ($index <= 3) {
				?>

                <article class="col-12 col-md-3 mb-3">
                    <div
                            class="rounded-circle bg-secondary position-absolute d-flex justify-content-center align-items-center font-weight-bold text-white">
						<?= $cont ?>
                    </div>
                    <a class="text-decoration-none ml-5 pl-2 d-block cor-azul"
                       href="<?= get_the_permalink($pagina->ID) ?>">
                        <p class="mais-noticias-titulo-destaque-secundarios"><?= $pagina->post_title ?></p>
                    </a>
                </article>

				<?php
			}
		}
		}

		echo '</section>';

	}
}