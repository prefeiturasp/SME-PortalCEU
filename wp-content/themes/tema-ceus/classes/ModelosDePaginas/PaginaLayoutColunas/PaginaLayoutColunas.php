<?php

namespace Classes\ModelosDePaginas\PaginaLayoutColunas;


use Classes\Lib\Util;
use Classes\TemplateHierarchy\ArchiveContato\ExibirContatosTodasPaginas;

class PaginaLayoutColunas extends Util
{
	protected $page_id;
	protected $escolha_a_quantidade_de_colunas_nesta_pagina;
	protected $insira_o_conteudo_para_uma_coluna;
	protected $insira_o_conteudo_da_primeira_coluna_duas_colunas;
	protected $insira_o_conteudo_da_segunda_coluna_duas_colunas;
	protected $insira_o_conteudo_da_primeira_coluna_tres_colunas;
	protected $insira_o_conteudo_da_segunda_coluna_tres_colunas;
	protected $insira_o_conteudo_da_terceira_coluna_tres_colunas;

	public function __construct()
	{


		$this->page_id = get_the_ID();
		$util = new Util($this->page_id);
		$util->montaHtmlLoopPadrao();

		$layout_colunas_tags = array('section', 'section');
		$layout_colunas_css = array('container', 'row');
		$this->abreContainer($layout_colunas_tags, $layout_colunas_css);

		$this->getConteudoColunas();

		$this->fechaContainer($layout_colunas_tags);

		$contato_todas_paginas = new ExibirContatosTodasPaginas($this->page_id);
		$contato_todas_paginas->init();
	}

	public function getConteudoColunas(){

		$this->escolha_a_quantidade_de_colunas_nesta_pagina = $this->getCamposPersonalizados('escolha_a_quantidade_de_colunas_nesta_pagina');
		
 		if ($this->escolha_a_quantidade_de_colunas_nesta_pagina == 'uma'){
 			$this->insira_o_conteudo_para_uma_coluna = $this->getCamposPersonalizados('insira_o_conteudo_para_uma_coluna');

 			$this->montaHtmlUmaColuna();

		}elseif ($this->escolha_a_quantidade_de_colunas_nesta_pagina == 'duas'){
 			$this->insira_o_conteudo_da_primeira_coluna_duas_colunas =  $this->getCamposPersonalizados('insira_o_conteudo_da_primeira_coluna_duas_colunas');
 			$this->insira_o_conteudo_da_segunda_coluna_duas_colunas =  $this->getCamposPersonalizados('insira_o_conteudo_da_segunda_coluna_duas_colunas');

			$this->montaHtmlDuasColunas();

		}elseif ($this->escolha_a_quantidade_de_colunas_nesta_pagina == 'tres'){
			$this->insira_o_conteudo_da_primeira_coluna_tres_colunas =  $this->getCamposPersonalizados('insira_o_conteudo_da_primeira_coluna_tres_colunas');
			$this->insira_o_conteudo_da_segunda_coluna_tres_colunas =  $this->getCamposPersonalizados('insira_o_conteudo_da_segunda_coluna_tres_colunas');
			$this->insira_o_conteudo_da_terceira_coluna_tres_colunas =  $this->getCamposPersonalizados('insira_o_conteudo_da_terceira_coluna_tres_colunas');

			$this->montaHtmlTresColunas();
		}
	}

	public function montaHtmlUmaColuna(){
		echo '<article class="col-12 col-md-12 col-lg-8 col-xl-8">';
		echo $this->insira_o_conteudo_para_uma_coluna;
		echo '</article>';

	}
	public function montaHtmlDuasColunas(){
		echo '<article class="col-12 col-md-12 col-lg-5 col-xl-5">';
		echo $this->insira_o_conteudo_da_primeira_coluna_duas_colunas;
		echo '</article>';

		echo '<article class="col-12 col-md-12 col-lg-5 col-xl-5">';
		echo $this->insira_o_conteudo_da_segunda_coluna_duas_colunas;
		echo '</article>';

	}
	public function montaHtmlTresColunas(){

		echo '<article class="col-12 col-md-12 col-lg-4 col-xl-4">';
		echo $this->insira_o_conteudo_da_primeira_coluna_tres_colunas;
		echo '</article>';

		echo '<article class="col-12 col-md-12 col-lg-4 col-xl-4">';
		echo $this->insira_o_conteudo_da_segunda_coluna_tres_colunas;
		echo '</article>';

		echo '<article class="col-12 col-md-12 col-lg-4 col-xl-4">';
		echo $this->insira_o_conteudo_da_terceira_coluna_tres_colunas;
		echo '</article>';

	}

}