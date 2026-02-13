<?php

namespace Classes\ModelosDePaginas\PaginaInicial\Mobile;

use Classes\ModelosDePaginas\PaginaInicial\PaginaInicialIcones;

class PaginaInicialIconesMobile extends PaginaInicialIcones
{

	public function __construct()
	{
		$this->criaArrayIconesTitulosIcones();
		$this->montaHtmlIcones();
	}

	public function montaHtmlIcones()
	{
		?>
        <section class="container">
            <div class="accordion row" id="accordionExample">
				<?php
				foreach ($this->array_icone_titulo_icone_id_menu_icone as $index => $icone) {
					?>
                    <div class="card text-center col-12 col-md-4">
                        <div class="card-header" id="heading<?= $icone['menu_icone'] ?>">
                            <a class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $icone['menu_icone'] ?>" aria-expanded="true" aria-controls="collapse<?= $icone['menu_icone'] ?>">
                                <img src="<?= $icone['url_icone'] ?>" class="icones-home" alt="Ícone <?= $icone['titulo_icone'] ?>">
                            </a>
                            <div class="card-body text-center">
                                <p class="card-text"><?= $icone['titulo_icone'] ?></p>
                            </div>
                        </div>
                        <div id="collapse<?= $icone['menu_icone'] ?>" class="collapse" aria-labelledby="heading<?= $icone['menu_icone'] ?>" data-parent="#accordionExample">
                            <div class="card-body">
                                <?= $this->getMenuIcones($icone['menu_icone']) ?>
                            </div>
                        </div>
                    </div>
					<?php
				}
				?>
            </div>
        </section>
		<?php
	}

	public function getMenuIcones($id_icone_menu)
	{
        if ($id_icone_menu) {
            wp_nav_menu(array(
                'menu' => $id_icone_menu,
                'theme_location' => 'primary',
                'depth' => 2,
                'container' => false,
                'items_wrap' => '<ul class="nav nav-pills p-2 container-menu-icones-home-mobile">%3$s</ul>'
            ));
        }
	}

}