<?php

namespace Classes\ModelosDePaginas\LandingPages;


use Classes\Lib\Util;

class Modelo_2 extends Util
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
			
			<!--BANNER-->
			<?php
			if(get_field('banner_lp_2') != ''){
				?>
				<div class="row banner-lp">
					<div class="col-sm-12"><img src="<?php the_field('banner_lp_2'); ?>" width="100%" alt=""></div>
				</div>
				<?php
			}
			?>
			
			
			
			<!--TEXTO-->
			
			<?php
				if(get_field('conteudo_bloco_2_lp_2') != ''){
					?>
			<div class="row">
				<div class="container bloco-4-lp-inter">
					<div class="row">
						<div class="col-sm-12 text-center text-uppercase"><h2><?php the_field('titulo_bloco_2_lp_2'); ?></h2></div>
						<div class="col-sm-12"><?php the_field('conteudo_bloco_2_lp_2'); ?></div>
					</div>
				</div>
			</div>
					<?php
				}
			?>
			
			
			<!--BOTOES-->
			<?php
				if(get_field('botoes_bloco_3_lp_2') != ''){
					?>
			<div class="row bloco-6-lp">
				<div class="container bloco-6-lp-inter">
					<div class="row mb-4">
						<div class="col-sm-12 text-center text-uppercase"><h2 class="bloco-6-lp-titulo"><?php the_field('titulo_bloco_3_lp_2'); ?></h2></div>
						<div class="col">
						<?php
						if (have_rows('botoes_bloco_3_lp_2')): ?>
							<?php while (have_rows('botoes_bloco_3_lp_2')): the_row(); ?>
							<a href="<?php the_sub_field('url_do_arquivo_lp_2'); ?>" target="_blank"><div class="col link_btn_bloco_6"><?php the_sub_field('botoes_lp_2'); ?></div></a>
							<?php endwhile; ?>
						<?php endif;
						?>
						</div>
					</div>
				</div>
			</div>
					<?php
				}
			?>
			
			
			
			
			
			</div>
		</div>
		<?php
	}
}