<?php
namespace Classes\ModelosDePaginas\PaginaMaisNoticias;
class PaginaMaisNoticiasOutrasNoticias extends PaginaMaisNoticias
{
	private $args_outras_noticias;
	private $query_outras_noticias;
	public function __construct()
	{
		$this->queryOutrasNoticias();
		$this->montaHtmlOutrasNoticias();
	}
	public function queryOutrasNoticias(){
		$posts_p = get_field('primeiro_destaque','option');if( $posts_p ):foreach( $posts_p as $p ): endforeach; endif;
		$posts_s = get_field('segundo_destaque','option');if( $posts_s ):foreach( $posts_s as $s ): endforeach; endif;
		$posts_t = get_field('terceiro_destaque','option');if( $posts_t ):foreach( $posts_t as $t ): endforeach; endif;
		$posts_q = get_field('quarto_destaque','option');if( $posts_q ):foreach( $posts_q as $q ): endforeach; endif;
		$posts_u = get_field('quinto_destaque','option');if( $posts_u ):foreach( $posts_u as $u ): endforeach; endif;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		//remove post iguais do destaque somente da primeira pagina e passa por post__not_in
		$pagina = get_query_var( 'paged', 1 );
		if($pagina == 0){
			$id_destaques = array( $p->ID,$s->ID,$t->ID,$q->ID,$u->ID);
		}
		
		$this->args_outras_noticias = array(
			'post_type' => 'post',
			'posts_per_page'=> 5,
			'paged'=> $paged,
			//'post__not_in' => array( $p->ID,$s->ID,$t->ID,$q->ID,$u->ID),//remove de toda a consulta
			'post__not_in' => $id_destaques,
		);
		$this->query_outras_noticias = get_posts($this->args_outras_noticias);
		
	}

	public function montaHtmlOutrasNoticias(){
		$container_mais_noticias_tags = array( 'section');
		$container_mais_noticias_css = array('col-lg-8 col-sm-12 mt-5');
		$this->abreContainer($container_mais_noticias_tags, $container_mais_noticias_css);
		echo '<p class="fonte-vintequatro mb-4 pb-2 font-weight-bold"><a class="text-dark" href="#" id="outrasNoticias">OUTRAS NOTÍCIAS</a></p>';
		foreach ($this->query_outras_noticias as $query){
			PaginaMaisNoticiasArrayIdNoticias::setArrayIdNoticias($query->ID)
			?>
            <section class="row mb-5">
                <article class="col-lg-12">
					<?php
					$thumb = get_the_post_thumbnail_url($query->ID);
					$url = get_the_permalink($query->ID);
					$post_thumbnail_id = get_post_thumbnail_id( $query->ID );
					$image_alt = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true);
			
					if ($thumb){
						echo '<figure class=" m-0">';
						echo '<img src="'.$thumb.'" class="img-fluid rounded float-left mr-4 w-25" alt="'.$image_alt.'"/>';
						echo '</figure>';
					}
					?>
					<div class="grid-noticias">
                    <h4 class="fonte-dezoito font-weight-bold mb-2">
                        <a class="text-decoration-none text-dark" href="<?= $url ?>">
							<?= $query->post_title ?>
                        </a>
                    </h4>
					<?php
					//echo $this->getSubtitulo($query->ID, 'p', 'fonte-dezesseis mb-2')
					?>
						<?php
							if(get_field('insira_o_subtitulo', $query->ID) != ''){
								the_field('insira_o_subtitulo', $query->ID);
							}else if (get_field('insira_o_subtitulo', $query->ID) == ''){
								 echo get_the_excerpt($query->ID); 
							}
						?>
					
					<?= $this->getComplementosMaisNoticias($query->ID); ?>
					</div>
                </article>
            </section>
			<?php
		}
		$this->paginacao_mais_noticias($this->query_outras_noticias);
		$this->fechaContainer($container_mais_noticias_tags);
	}
	
	public function getComplementosMaisNoticias($id_post){
		$dt_post = get_the_date('d/m/Y g\hi', $id_post);
		
		$categoria = get_the_category($id_post)[0]->name;

		return '<p class="fonte-doze font-italic mb-0">Publicado em: '.$dt_post.' - em '.$categoria.'</p>';


	}
	
	public function paginacao_mais_noticias( $wp_query = null, $echo = true ) {
		if ( null === $wp_query ) {
			global $wp_query;
		}
		$posts_para_excluir_da_lista = count(PaginaMaisNoticiasArrayIdNoticias::getArrayIdNoticias());
		$published_posts = (wp_count_posts()->publish)-$posts_para_excluir_da_lista;
		$posts_per_page = 5;
		$page_number_max = ceil($published_posts / $posts_per_page);
		$pages = paginate_links( [
				'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				'format'       => '?paged=%#%',
				'current'      => max( 1, get_query_var( 'paged' ) ),
				'total'        => $page_number_max,
				'type'         => 'array',
				'show_all'     => false,
				'end_size'     => 0,
				'mid_size'     => 2,
				'prev_next'    => true,
				'prev_text'    => __( '«' ),
				'next_text'    => __( '»' ),
				'add_args'     => false,
				'add_fragment' => '#outrasNoticias'
			]
		);
		?>

		<?php
		if ( is_array( $pages ) ) {
			$pagination = '<div class="pag-noticias"><ul class="pag-noticias-ul">';
			foreach ($pages as $page) {
				$pagination .= '<li class="pag-noticias-li page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'space-noticia page-link', $page) . '</li>';
			}
			$pagination .= '</ul></div>';
			if ( $echo ) {
				echo $pagination;
			} else {
				return $pagination;
			}
		}
		return null;
	}
}