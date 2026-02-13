<?php

namespace Classes\ModelosDePaginas\PaginaInicial;


use Classes\Lib\Util;

class PaginaInicial extends Util
{
	protected $array_icone_titulo_icone_id_menu_icone = array();

	// Notícias
	protected $categoria_noticias_home;
	protected $id_noticias_home_principal;
	protected $args_noticas_home_principal;
	protected $query_noticias_home_principal;
	protected $args_noticas_home_secundarias;
	protected $query_noticias_home_secundarias;

	public function __construct()
	{
		$this->page_id = get_the_ID();
		$this->page_slug = get_queried_object()->post_name;
		$util = new Util($this->page_id);
		
		// Classe Util
		//$util->montaHtmlLoopPadrao();
		//$this->modalhome();

		$this->init();
	}

	public function init(){

		//new PaginaInicialIconesDetectMobile();

		$this->tituloNoticias();

        $noticias_home_tags = array('section','section');
        $noticias_home_css = array('container mt-5 noticias','row');
        $this->abreContainer($noticias_home_tags, $noticias_home_css);
		//new PaginaInicialNoticiasDestaquePrimaria();
		//new PaginaInicialNoticiasDestaqueSecundarias();
		$this->fechaContainer($noticias_home_tags);

		$face_news_twitter_tags = array('section', 'section');
		$face_news_twitter_css = array('container mt-5 mb-5 noticias' , 'row');
		$this->abreContainer($face_news_twitter_tags, $face_news_twitter_css);

		//new PaginaInicialFacebook();

		$news_twitter_tags = array('section');
		$news_twitter_css = array('col-12 col-md-6');
		$this->abreContainer($news_twitter_tags, $news_twitter_css);
		//new PaginaInicialNewsletter();

		//new PaginaInicialTwitter();

		$this->fechaContainer($news_twitter_tags);

		$this->fechaContainer($face_news_twitter_tags);

    }

    public function tituloNoticias(){
	    ?>
        <section class="container mt-5 mb-5 noticias">
            <article class="row mb-4">
                <article class="col-lg-12 col-xs-12">
                    <h2 class="border-bottom">Destaques</h2>
                </article>
            </article>
        </section>
        <?php
    }
	public function modalhome(){
	    ?>
		<script>
			jQuery(document).ready(function ($) {
				// Condição ACF para ativar modal
				var ativo_modal = "<?=get_field('ativar_modal_home','option'); ?>"
				
				if(ativo_modal == 'sim'){
				   		jQuery('#modal-content').modal({ show: true });
				   }else{
					 	jQuery('#modal-content').modal({ show: false });
				   }
			});
		</script>
		
        <div id="modal-content" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					
						<button type="button" class="close" data-dismiss="modal">×</button>
					
					<div class="modal-body">
					<?php
						if(get_field('titulo_modal_home' , 'option') != ''){
							?><p><h1><strong><?php the_field('titulo_modal_home' , 'option'); ?></strong></h1></p><?php
						}
					?>
					<?php
						if(get_field('imagem_modal_home' , 'option') != ''){
							?><p><img src="<?php the_field('imagem_modal_home' , 'option'); ?>" width="100%"></p><?php
						}
					?>
					<?php
						if(get_field('mensagem_modal_home' , 'option') != ''){
							?><p><?php the_field('mensagem_modal_home' , 'option'); ?></p><?php
						}
					?>
					<?php
						if(get_field('botao_modal_home' , 'option') != ''){
							?><p>
						<a href="<?php the_field('botao_modal_home' , 'option'); ?>" target="<?php the_field('link_do_botao_modal_home' , 'option'); ?>"><button type="button" class="btn btn-primary"><?php the_field('nome_botao_modal_home' , 'option'); ?></button></a>
					  		</p><?php
						}
					?> 
					</div>
				</div>
			</div>
		</div>
        <?php
    }



}