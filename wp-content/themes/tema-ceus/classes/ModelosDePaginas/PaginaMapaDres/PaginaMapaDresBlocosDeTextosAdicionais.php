<?php


namespace Classes\ModelosDePaginas\PaginaMapaDres;


class PaginaMapaDresBlocosDeTextosAdicionais
{
	public function getTituloSubtituloMapa(){
		$titulo_mapa = get_field('insira_o_titulo_mapa_dres');
		$subtitulo_mapa = get_field('insira_o_subtitulo_mapa_dres');

		if (trim($titulo_mapa) !== '' || trim($subtitulo_mapa !== "")) {

			echo '<article class="col-12 mt-lg-2 mt-5">';
			echo '<p class="titulo-blocos-de-texto">' . $titulo_mapa . '</p>';
			echo '<p>' . $subtitulo_mapa . '</p>';
			echo '</article>';
		}
	}

	public function htmlMapaDresBlocoSuperior(){

		$titulo_texto_bloco_superior =  get_field('titulo_texto_superior_mapa_dres');
		$texto_bloco_superior =  get_field('texto_superior_pagina_mapa_dres');
		$imagem_texto_bloco_superior =  get_field('imagem_texto_superior_mapa_dres');

		if (trim($titulo_texto_bloco_superior) !== '' || trim($texto_bloco_superior !== "")) {

			echo '<article class="col-12 col-lg-6 mb-md-5">';
			echo '<p class="titulo-blocos-de-texto">' . $titulo_texto_bloco_superior . '</p>';
			echo $texto_bloco_superior;
			echo '</article>';
		}

		if ($imagem_texto_bloco_superior) {
			echo '<article class="col-12 col-lg-6 mb-md-5">';
			echo '<figure>';
			echo '<img src="' . $imagem_texto_bloco_superior["sizes"]["large"] . '" alt="' . $imagem_texto_bloco_superior["alt"] . '"/>';
			echo '</figure>';
			echo '</article>';
		}
	}

	public function htmlMapaDresBlocoInferior(){
		$titulo_texto_bloco_inferior =  get_field('titulo_texto_inferior_mapa_dres');
		$texto_bloco_inferior =  get_field('texto_inferior_mapa_dres');
		$imagem_texto_bloco_inferior =  get_field('imagem_texto_inferior_mapa_dres');

		if (trim($titulo_texto_bloco_inferior) !== '' || trim($texto_bloco_inferior !== "")) {
			echo '<article class="col-12 col-lg-6 mb-md-5 mt-5">';
			echo '<p class="titulo-blocos-de-texto">' . $titulo_texto_bloco_inferior . '</p>';
			echo $texto_bloco_inferior;
			echo '</article>';
		}

		if ($imagem_texto_bloco_inferior) {
			echo '<article class="col-12 col-lg-6 mb-5 mt-md-5">';
			echo '<figure>';
			echo '<img src="' . $imagem_texto_bloco_inferior["sizes"]["large"] . '" alt="' . $imagem_texto_bloco_inferior["alt"] . '"/>';
			echo '</figure>';
			echo '</article>';
		}
	}

}