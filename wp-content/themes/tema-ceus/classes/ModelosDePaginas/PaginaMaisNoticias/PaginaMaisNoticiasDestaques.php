<?php

namespace Classes\ModelosDePaginas\PaginaMaisNoticias;


class PaginaMaisNoticiasDestaques extends PaginaMaisNoticias
{

	public function __construct()
	{
		$this->montaHtmlLoopMaisDestaquePrincipal();
	}
	
	public function montaHtmlLoopMaisDestaquePrincipal(){
		?>
		
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-12">
					<?php
						$posts = get_field('primeiro_destaque','option');
							if( $posts ): ?>
								<?php foreach( $posts as $p ): ?>
									<session class="card text-white mb-3">
									
									<figure class="m-0 p-0">
										<img src="<?php echo get_the_post_thumbnail_url( $p->ID ); ?>" width="100%">
									</figure>
									<article class="overlay-noticia d-flex flex-column justify-content-end">
										<h3 class="card-title mais-noticias-destaque-principal"><a href="<?php echo get_permalink( $p->ID ); ?>">
											<?php echo get_the_title( $p->ID ); ?>
										</a></h3>
										<p class="mb-3 card-text texto-mais-noticias-destaques">
											<?php
												if(get_field('insira_o_subtitulo', $p->ID) != ''){
													the_field('insira_o_subtitulo', $p->ID);
												}else if (get_field('insira_o_subtitulo', $p->ID) == ''){
													 echo get_the_excerpt($p->ID ); 
												}
											?>
										</p>
									</article>
	
									</session>
								<?php endforeach; ?>
							<?php endif;
						wp_reset_postdata();
					?>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-6 mb-4">
					<?php
						$posts = get_field('segundo_destaque','option');
							if( $posts ): ?>
								<?php foreach( $posts as $p ): ?>
									<div class="mb-4"><img src="<?php echo get_the_post_thumbnail_url( $p->ID ); ?>" width="100%"></div>
									<div class="mb-4"><a href="<?php echo get_permalink( $p->ID ); ?>">
										<h2 class="card-title mais-noticias-titulo-destaque-secundarios"><?php echo get_the_title( $p->ID ); ?></h2>
									</a></div>
								<?php endforeach; ?>
							<?php endif;
						wp_reset_postdata();
					?>
				</div>
				<div class="col-sm-6 mb-4">
					<?php
						$posts = get_field('terceiro_destaque','option'); 
							if( $posts ): ?>
								<?php foreach( $posts as $p ): ?>
									<div class="mb-4"><img src="<?php echo get_the_post_thumbnail_url( $p->ID ); ?>" width="100%"></div>
									<div class="mb-4"><a href="<?php echo get_permalink( $p->ID ); ?>">
										<h2 class="card-title mais-noticias-titulo-destaque-secundarios"><?php echo get_the_title( $p->ID ); ?></h2>
									</a></div>
								<?php endforeach; ?>
							<?php endif;
						wp_reset_postdata();
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6 mb-4">
					<?php
						$posts = get_field('quarto_destaque','option');
							if( $posts ): ?>
								<?php foreach( $posts as $p ): ?>
									<div class="mb-4"><img src="<?php echo get_the_post_thumbnail_url( $p->ID ); ?>" width="100%"></div>
									<div class="mb-4"><a href="<?php echo get_permalink( $p->ID ); ?>">
										<h2 class="card-title mais-noticias-titulo-destaque-secundarios"><?php echo get_the_title( $p->ID ); ?></h2>
									</a></div>
								<?php endforeach; ?>
							<?php endif;
						wp_reset_postdata();
					?>
				</div>
				<div class="col-sm-6 mb-4">
					<?php
						$posts = get_field('quinto_destaque','option');
							if( $posts ): ?>
								<?php foreach( $posts as $p ): ?>
									<div class="mb-4"><img src="<?php echo get_the_post_thumbnail_url( $p->ID ); ?>" width="100%"></div>
									<div class="mb-4"><a href="<?php echo get_permalink( $p->ID ); ?>">
										<h2 class="card-title mais-noticias-titulo-destaque-secundarios"><?php echo get_the_title( $p->ID ); ?></h2>
									</a></div>
								<?php endforeach; ?>
							<?php endif;
						wp_reset_postdata();
					?>
				</div>
			</div>
		</div>
		<?php
	}

}