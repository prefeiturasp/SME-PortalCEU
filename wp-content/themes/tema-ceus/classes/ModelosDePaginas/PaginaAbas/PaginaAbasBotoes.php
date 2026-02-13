<?php

namespace Classes\ModelosDePaginas\PaginaAbas;


class PaginaAbasBotoes extends PaginaAbasContato
{
	protected $deseja_exibir_botoes_com_links;
	protected $escolha_a_categoria_de_botoes;
	protected $deseja_link_para_esse_botao;
	protected $insira_o_link_deste_botao;
	protected $deseja_abrir_em_uma_nova_aba;
	protected $args_botoes;
	protected $query_botoes;

	public function __construct()
	{
		parent::__construct();
		$this->deseja_exibir_botoes_com_links = get_field('deseja_exibir_botoes_com_links', $this->page_id);
		$this->escolha_a_categoria_de_botoes = get_field('escolha_a_categoria_de_botoes', $this->page_id);
	}

	public function getBotoesAba($id_aba){
		$this->deseja_exibir_botoes_com_links = get_field('deseja_exibir_botoes_com_links', $id_aba);
		if ($this->deseja_exibir_botoes_com_links === 'sim'){
			$this->escolha_a_categoria_de_botoes = get_field('escolha_a_categoria_de_botoes', $id_aba);
			$this->getQueryBotoes($this->escolha_a_categoria_de_botoes);
			$this->percorreCatBotoes();
		}
	}

	public function getQueryBotoes($cat_botoes){
		$this->args_botoes = array(
			'posts_per_page' => -1,
			'post_type' => 'botao',
			'tax_query' => array(
				array(
					'taxonomy' => 'categorias-botao',
					'field' => 'term_id',
					'terms' => $cat_botoes,
				)
			)
		);

		$this->query_botoes = get_posts($this->args_botoes);
	}

	public function percorreCatBotoes(){

		foreach ($this->query_botoes as $botao){
			$botoes_tags = array('section', 'article');
			$botoes_css = array('card rounded bg-cinza-ativo mb-2 text-center w-75 ml-auto mr-auto', 'card-header py-2 border-0 font-weight-bold');
			$this->abreContainer($botoes_tags, $botoes_css);
			echo $this->getItensBotoesAba($botao);
			$this->fechaContainer($botoes_tags);
		}
	}

	public function getItensBotoesAba($botao){
		$this->deseja_link_para_esse_botao = get_field('deseja_link_para_esse_botao', $botao->ID);
		$this->insira_o_link_deste_botao = get_field('insira_o_link_deste_botao', $botao->ID);
		$this->deseja_abrir_em_uma_nova_aba = get_field('deseja_abrir_em_uma_nova_aba', $botao->ID);

		if ($this->deseja_link_para_esse_botao === 'sim'){

			if ($this->deseja_abrir_em_uma_nova_aba === 'sim'){
				$html_botao = '<a class="text-dark" href="'.$this->insira_o_link_deste_botao.'" target="_blank">'.$botao->post_title.'</a>';
			}else{
				$html_botao = '<a class="text-dark" href="'.$this->insira_o_link_deste_botao.'">'.$botao->post_title.'</a>';
			}
		}else{
			$html_botao = $botao->post_title;
		}
		return $html_botao;
	}

}