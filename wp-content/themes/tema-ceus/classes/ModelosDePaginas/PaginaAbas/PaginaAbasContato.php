<?php

namespace Classes\ModelosDePaginas\PaginaAbas;


class PaginaAbasContato extends PaginaAbas
{
	private $aba_id;
	public function __construct()
	{
		parent::__construct();

	}

	public function getEnderecoAba($id_aba){
		$this->deseja_exibir_endereco = get_field('deseja_exibir_endereco', $id_aba);
		if ($this->deseja_exibir_endereco === 'sim'){
			$this->escolha_o_endereco = get_field('escolha_o_endereco',$id_aba);
			return $this->exibeCamposCadastrados($this->escolha_o_endereco);
		}
	}
}