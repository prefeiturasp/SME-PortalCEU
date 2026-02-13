<?php
namespace Classes\ModelosDePaginas\PaginaInicial;

class PaginaInicialNoticiasDestaquePrimaria extends PaginaInicial
{

	public function __construct()
	{
		$this->montaHtmlLoopDestaquePrincipal();
	}
	
	public function montaHtmlLoopDestaquePrincipal()	{

			$posts = get_field('primeiro_destaque','option');

			if( $posts ): ?>
					<?php foreach( $posts as $p ): ?>
                    <section class="col-lg-6 col-xs-12 mb-xs-4 rounded">
					        <article class="card h-100 rounded border-0">
                                <img class="rounded" src="<?php echo get_the_post_thumbnail_url( $p->ID ); ?>" width="100%">
								<article class="overlay-noticia-home d-flex flex-column justify-content-end">
										<h3 class="fonte-catorze text-white font-weight-bold"><a href="<?php echo get_permalink( $p->ID ); ?>">
											<?php echo get_the_title( $p->ID ); ?>
										</a></h3>
									<section class="card-text text-white fonte-doze">
										<p class="mb-3 card-text texto-mais-noticias-destaques">
											<?php
												if(get_field('insira_o_subtitulo', $p->ID) != ''){
													the_field('insira_o_subtitulo', $p->ID);
												}else if (get_field('insira_o_subtitulo', $p->ID) == ''){
													 echo get_the_excerpt($p->ID ); 
												}
											?>
										</p>
									</section>
									</article>
                                <?php /*?><article class="card-img-overlay bg-home-desc h-auto rounded-bottom container-img-noticias-destaques-primaria">
                                    <h3 class="fonte-catorze font-weight-bold">
                                        <a class="text-white" href="<?php echo get_permalink( $p->ID ); ?>">
											<?php echo get_the_title( $p->ID ); ?>
                                        </a>
                                    </h3>
                                    <section class="card-text text-white fonte-doze">
										<p class="mb-3 ">
											<?php
												if(get_field('insira_o_subtitulo', $p->ID) != ''){
													the_field('insira_o_subtitulo', $p->ID);
												}else if (get_field('insira_o_subtitulo', $p->ID) == ''){
													 echo get_the_excerpt($p->ID ); 
												}
											?>
										</p>
									</section>
                                </article><?php */?>
                            </article>
                    </section>
					<?php endforeach; ?>
			
			<?php endif;
		
		wp_reset_postdata();
		
	}
}