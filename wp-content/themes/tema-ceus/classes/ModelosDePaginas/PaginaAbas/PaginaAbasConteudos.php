<?php

namespace Classes\ModelosDePaginas\PaginaAbas;


class PaginaAbasConteudos extends PaginaAbasBotoes
{
	public function __construct()
	{
		parent::__construct();
		$this->getConteudoAbas();
	}

	public function getConteudoAbas(){
		echo '<div class="tab-content">';
		foreach ($this->getQueryAbas() as $index => $aba){
            if ($index == 0){
                $css_active = 'show active';
            }else{
                $css_active = '';
            }
			?>
			<div class="tab-pane <?= $css_active ?>" id="id_<?= $aba->ID ?>" role="tabpanel" aria-labelledby="tab_<?= $aba->ID?>">
				<div class="row">
					<div class="col-lg-12 col-sm-12 pl-0 pr-0">
						<div class="card shadow-sm rounded border-0">
							<div class="card-header border-0 bg-white">
								<h2 class="border-bottom fonte-vintequatro pb-2 font-weight-bold"><?= $aba->post_title;?></h2>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-lg-7 col-sm-12">
										<div class="fonte-dezesseis pt-0">
											<?=
                                            apply_filters('the_content', $aba->post_content);

                                            $contato = new PaginaAbasContato();
                                            $contato->getEnderecoAba($aba->ID);
                                            ?>

										</div>
									</div>
									<div class="col-lg-5 col-sm-12 fonte-doze text-center">
										<?php $this->getBotoesAba($aba->ID); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
		echo '</div>';
	}
}