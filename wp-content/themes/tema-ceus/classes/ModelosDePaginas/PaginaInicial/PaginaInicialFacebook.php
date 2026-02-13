<?php

namespace Classes\ModelosDePaginas\PaginaInicial;


class PaginaInicialFacebook
{

	public function __construct()
	{
		$this->montaHtmlFacebook();
	}

	public function montaHtmlFacebook(){
		?>
		<section class="col-12 col-md-6">
		<article class="col-12 container-facebook">
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v4.0&appId=1629372850659932&autoLogAppEvents=1"></script>
            <div class="fb-page" data-href="https://www.facebook.com/EducaPrefSP/" data-tabs="timeline" data-width="500" data-height="580" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/chacarasparatemporadasp/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/EducaPrefSP/">Secretaria Municipal de Educação de São Paulo</a></blockquote></div>
		</article>
		</section>
		<?php
	}

}