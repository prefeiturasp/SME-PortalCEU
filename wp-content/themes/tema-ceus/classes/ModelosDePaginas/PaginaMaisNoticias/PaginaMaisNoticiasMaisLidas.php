<?php

namespace Classes\ModelosDePaginas\PaginaMaisNoticias;


class PaginaMaisNoticiasMaisLidas extends PaginaMaisNoticias
{
	private $args_mais_lidas;
	private $query_mais_lidas;

	public function __construct()
	{
		$this->queryMaisLidas();
		$this->getMaisLidas();
	}

	public function queryMaisLidas(){
		$this->args_mais_lidas = array(
			'posts_per_page'=> 9,
			// Meta Key criada no functions.php
			'meta_key'=>'popular_posts',
			'orderby'=>'meta_value_num',
			'order'=>'DESC',
			'exclude' => PaginaMaisNoticiasArrayIdNoticias::getArrayIdNoticias(),
		);
		$this->query_mais_lidas = get_posts($this->args_mais_lidas);
	}



	public function getMaisLidas(){
		echo '<section class="col-lg-4 col-sm-12 card align-self-start container-titulos-mais-recente">';
		echo '<p class="titulo-cabecalho-mais-recentes">Mais Lidas</p>';

		foreach ($this->query_mais_lidas as $mais_lida):
			PaginaMaisNoticiasArrayIdNoticias::setArrayIdNoticias($mais_lida->ID);
			echo '<article>';
			echo '<p class="titulo-categoria">'.$this->getCategory($mais_lida->ID).'</p>';
			echo '<h3 class="titulo-noticias-mais-recentes"><a href="' . get_permalink($mais_lida->ID) . '">' .   get_the_title($mais_lida->ID).'</a> </h3> ';
			echo '</article>';

		endforeach;


		wp_reset_postdata();
		echo '</section>';
	}

	public function getCategory($id_post){
		$categoria = get_the_category($id_post);
		return $categoria[0]->name;
	}

}