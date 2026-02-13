<?php

namespace Classes\ModelosDePaginas\LandingPages;


use Classes\Lib\Util;

class Modelo_1 extends Util
{
	
	public function __construct()
	{

		$this->montaHtmlLandingPage();
		//contabiliza visualizações de noticias
		setPostViews(get_the_ID()); /*echo getPostViews(get_the_ID());*/

	}

	public function montaHtmlLandingPage(){
		?>

		<div class="container-fluid">
			<div class="row banner-lp">
				<div class="col-sm-12"><img src="<?php the_field('banner_lp_1'); ?>" width="100%" alt=""></div>
			</div>
			<div class="row bloco-1-lp">
				<div class="container bloco-1-lp-inter">
					<div class="row">
						<div class="col-sm-12 text-center text-uppercase"><h2 class="bloco-1-lp-titulo"><?php the_field('titulo_bloco_1_lp_1'); ?></h2></div>
						<div class="col-sm-12"><?php the_field('conteudo_bloco_1_lp_1'); ?></div>
					</div>
				</div>
			</div>
			<div class="row bloco-2-lp">
				<div class="col-sm-12 bloco-2-lp-inter">
					<?php
						if(get_field('titulo_bloco_2_lp_1') != ''){
							?>
							<div class="col-sm-12 text-center text-uppercase"><h2 class="bloco-3-lp-titulo"><?php the_field('titulo_bloco_2_lp_1'); ?></h2></div>
							<?php
						}
					?>
					
				<?php
				if (have_rows('botoes_bloco_2_lp_1')): ?>
					<?php while (have_rows('botoes_bloco_2_lp_1')): the_row(); ?>
					<a href="<?php the_sub_field('link_botao_bloco_2_lp_1'); ?>" target="_blank"><div class="col link_btn_bloco_2"><?php the_sub_field('botao_bloco_2_lp_1'); ?></div></a>
					<?php endwhile; ?>
				<?php endif;
				?>
				</div>
			</div>
			<div class="row bloco-3-lp">
				<div class="container bloco-3-lp-inter">
					<div class="row">
						<div class="col-sm-12 mb-4 text-center text-uppercase"><h2 class="bloco-3-lp-titulo"><?php the_field('titulo_bloco_3_lp_1'); ?></h2></div>
						
						<div  id="style-2" class="row overflow-auto">
						<?php query_posts(array(
							'cat' => get_field('cat_noticia_bloco_3_lp_1'),
							'post_per_page' => -1
						)); ?>
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<div class="col-sm-4 text-center">
								<img src="<?php echo get_the_post_thumbnail_url(); ?>" width="100%">
								<p><a href="<?php echo get_permalink( ); ?>"><h3><?php the_title(); ?></h3></a></p>
							</div>
						<?php endwhile; endif; ?>
						<?php wp_reset_query(); ?>
						</div>
						
						
						
					</div>
				</div>
			</div>
			<div class="row bloco-4-lp">
				<div class="container bloco-4-lp-inter">
					<div class="row">
						<div class="col-sm-12 text-center text-uppercase"><h2><?php the_field('titulo_bloco_4_lp_1'); ?></h2></div>
						<div class="col-sm-12"><?php the_field('conteudo_bloco_4_lp_1'); ?></div>
					</div>
				</div>
			</div>
			<div class="row bloco-5-lp">
				<div class="container bloco-5-lp-inter">
					<div class="row">
						<div class="col-sm-12 mb-4 text-center text-uppercase"><h2 class="bloco-5-lp-titulo"><?php the_field('titulo_bloco_5_lp_1'); ?></h2></div>
						<div class="col-sm-12">
						<?php
						if (have_rows('perguntas_e_respostas_lp_1')): ?>
							<?php while (have_rows('perguntas_e_respostas_lp_1')): the_row(); ?>
							<div class="col-sm-12"><h3><?php the_sub_field('pergunta_bloco_5_lp_1'); ?></h3></div>
							<div class="col-sm-12"><?php the_sub_field('resposta_bloco_5_lp_1'); ?></div>
							<hr>
							<?php endwhile; ?>
						<?php endif;
						?>
						</div>
					</div>
				</div>
			</div>
			<div class="row bloco-6-lp">
				<div class="container bloco-6-lp-inter">
					<div class="row mb-4">
						<div class="col-sm-12 text-center text-uppercase"><h2 class="bloco-6-lp-titulo"><?php the_field('titulo_bloco_6_lp_1'); ?></h2></div>
						<div class="col">
						<?php
						if (have_rows('botoes_bloco_6_lp_1')): ?>
							<?php while (have_rows('botoes_bloco_6_lp_1')): the_row(); ?>
							<a href="<?php the_sub_field('anexo1_bloco_6_lp_1'); ?>" target="_blank"><div class="col link_btn_bloco_6"><?php the_sub_field('botao_bloco_6_lp_1'); ?></div></a>
							<?php endwhile; ?>
						<?php endif;
						?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 text-center text-uppercase"><h2 class="bloco-6-lp-titulo"><?php the_field('titulo_2_bloco_6_lp_2'); ?></h2></div>
						<div class="col">
						<?php
						if (have_rows('botoes2_bloco_6_lp_1')): ?>
							<?php while (have_rows('botoes2_bloco_6_lp_1')): the_row(); ?>
							<a href="<?php the_sub_field('anexo_bloco_6_lp_1'); ?>" target="_blank"><div class="col link_btn_bloco_6"><?php the_sub_field('botao2_bloco_6_lp_1'); ?></div></a>
							<?php endwhile; ?>
						<?php endif;
						?>
						</div>
					</div>
				</div>
			</div>	
			<div class="row bloco-7-lp">
				<div class="container bloco-7-lp-inter">
					<div class="row">
						<div class="col-sm-12 text-center text-uppercase"><h2><?php the_field('titulo_video_lp_1'); ?></h2></div>
						<div class="col-sm-2"></div>
						<div class="col-sm-8">
						<iframe width="560" height="315" src="<?php the_field('url_video_bloco_7_lp_1'); ?>" frameborder="0"
allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
						</div>
						<div class="col-sm-2"></div>
					</div>
				</div>
			</div>
			</div>
		</div>
		<?php
	}
}