<?php

namespace Classes\ModelosDePaginas\PaginaInicial;


class PaginaInicialNewsletter
{
	public function __construct()
	{
		$this->montaHtmlNewsletter();
	}

	public function montaHtmlNewsletter(){
		?>

			<article class="bg-white shadow-sm text-center p-3 mb-3 mb-xs-4">
				<p>
					Receba nossas novidades e fique por dentro de tudo o que acontece na Secretaria Municipal de Educação.
                </p>
				<?= do_shortcode('[contact-form-7 id="18931" title="Newsletter"]'); ?>
			</article>



		<?php
	}

}