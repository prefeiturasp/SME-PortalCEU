<?php

namespace Classes\ModelosDePaginas\PaginaAbas;


use Classes\Lib\Util;
use Classes\TemplateHierarchy\ArchiveContato\ArchiveContato;
use Classes\TemplateHierarchy\ArchiveContato\ExibirContatosTodasPaginas;


class PaginaAbas extends ArchiveContato
{
	protected $page_id;
	protected $categoria_de_abas;
	protected $deseja_exibir_endereco;
	protected $escolha_o_endereco;
	protected $args_abas;

	public function __construct()
	{
		$this->page_id = get_the_ID();
		$this->categoria_de_abas = get_field('escolha_a_categoria_de_abas', $this->page_id);
	}

	public function init(){
		$util = new Util($this->page_id);
		$util->montaHtmlLoopPadrao();
    	$container_principal_tags= array('section');
		$container_principal_css= array('container');
		$this->abreContainer($container_principal_tags, $container_principal_css);

		new PaginaAbasTitulos();

		new PaginaAbasConteudos();

		$this->fechaContainer($container_principal_tags);

		new PaginaAbasAcoesDestaque();

		$contato_todas_paginas = new ExibirContatosTodasPaginas($this->page_id);
		$contato_todas_paginas->init();
	}

	public function getQueryAbas()
	{
		$this->args_abas = array(
			'posts_per_page' => -1,
			'post_type' => 'aba',
			'orderby' => 'date',
			'order' => 'ASC',
			'tax_query' => array(
				array(
					'taxonomy' => 'categorias-aba',
					'field' => 'term_id',
					'terms' => $this->categoria_de_abas,
				)
			)
		);
		return get_posts($this->args_abas);
	}
}