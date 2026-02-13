<?php

namespace Classes\ModelosDePaginas\PaginaInicial;


class PaginaInicialIcones extends PaginaInicial
{
	public function __construct()
	{

		$this->criaArrayIconesTitulosIcones();
		$this->montaHtmlIcones();
		$this->montaHtmlMenuIcones();
	}

	public function criaArrayIconesTitulosIcones()
	{
		array_push($this->array_icone_titulo_icone_id_menu_icone, array("id_icone" => $this->getCamposPersonalizados('escolha_o_primeiro_icone')['ID'], "url_icone" => $this->getCamposPersonalizados('escolha_o_primeiro_icone')['url'], "titulo_icone" => $this->getCamposPersonalizados('escolha_o_titulo_do_primeiro_icone'), "menu_icone" => $this->getCamposPersonalizados('escolha_o_menu_do_primeiro_icone')));
		array_push($this->array_icone_titulo_icone_id_menu_icone, array("id_icone" => $this->getCamposPersonalizados('escolha_o_segundo_icone')['ID'], "url_icone" => $this->getCamposPersonalizados('escolha_o_segundo_icone')['url'], "titulo_icone" => $this->getCamposPersonalizados('escolha_o_titulo_do_segundo_icone'), "menu_icone" => $this->getCamposPersonalizados('escolha_o_menu_do_segundo_icone')));
		array_push($this->array_icone_titulo_icone_id_menu_icone, array("id_icone" => $this->getCamposPersonalizados('escolha_o_terceiro_icone')['ID'], "url_icone" => $this->getCamposPersonalizados('escolha_o_terceiro_icone')['url'], "titulo_icone" => $this->getCamposPersonalizados('escolha_o_titulo_do_terceiro_icone'), "menu_icone" => $this->getCamposPersonalizados('escolha_o_menu_do_terceiro_icone')));
	}

	public function montaHtmlIcones(){
		?>
		<session class="container-fluid container-fluid-botoes-persona">
			<div class="container container-botoes-persona">
				<ul class="card-group nav m-0 ul-container-icones-menu" role="tablist">
					<?php foreach ($this->array_icone_titulo_icone_id_menu_icone as $icone) {
						$image_alt = get_post_meta( $icone['id_icone'], '_wp_attachment_image_alt', true);
						?>
						<li id="tab_<?= $icone['menu_icone'] ?>" class="container-a-icones-home card rounded-0 border-0 pt-5 pb-3">
							<a id="tab_<?= $icone['menu_icone'] ?>" data-toggle="tab" href="#menu_<?= $icone['menu_icone'] ?>" role="tab" aria-selected="false" class="a-icones-home d-flex justify-content-center align-items-center">
								<img src="<?= $icone['url_icone'] ?>" class="icones-home" alt="<?= $image_alt ?>">
							</a>
							<div class="row"></div>
							<div class="card-body text-center container-titulo-icones">
								<p class="card-text titulo-icones"><?= $icone['titulo_icone'] ?></p>
							</div>
						</li>
					<?php } ?>
				</ul>
			</div>
		</session>
		<?php
	}

	public function montaHtmlMenuIcones()
	{
		echo '<section class="tab-content bg-cinza-ativo">';

		foreach ($this->array_icone_titulo_icone_id_menu_icone as $icone) {
		    ?>

           <section class="tab-pane fade container" id="menu_<?= $icone['menu_icone'] ?>" role="tabpanel" aria-labelledby="tab_<?= $icone['menu_icone'] ?>">

                <nav class="navbar navbar-expand-lg nav-icones-menu">


                    <article class="collapse navbar-collapse">
						<?php
						wp_nav_menu(array(
							'menu' => $icone['menu_icone'],
							//'theme_location' => 'primary',
							'depth' => 2,
							//'container_id' => 'bs-example-navbar-collapse-1',
							'menu_class' => 'navbar-nav mr-auto nav nav-tabs ul-icones-home',
							'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
							'walker'            => new \WP_Bootstrap_Navwalker(),
						));
						?>

                    </article>

                </nav>
            </section>

            <?php

		}

		echo '</section>';

	}

}