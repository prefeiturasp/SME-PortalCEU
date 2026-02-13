<?php

namespace Classes\TemplateHierarchy\LoopUnidades;

class LoopUnidadesCabecalho extends LoopUnidades{

	public function __construct()
	{
		$this->cabecalhoUnidade();
	}

	public function cabecalhoUnidade(){
        $infoBasicas = get_field('informacoes_basicas');
        //echo "<pre>";
        //print_r($infoBasicas['horario']);
        //echo "</pre>";
    ?>

        <?php
			$imagem_banner = get_field('banner_unidades', 'option');
            $pagina_unidades = get_field('pagina_unidades', 'option');
            $pagina_escola = get_field('pagina_escola', 'option');
            $tipo = '';
            $tipos = get_the_terms(get_the_ID(), 'tipo-unidade');
            if (!empty($tipos) && !is_wp_error($tipos)) {
                $termo = array_shift($tipos);
                $tipo = $termo->slug;
            }

            $caminho_titulo = '';
            $caminho_link = '';

            if ($tipo == 'ceu') {
                $caminho_titulo = get_the_title($pagina_unidades);
                $caminho_link = get_the_permalink($pagina_unidades);
            } elseif ($tipo == 'escola-aberta') {
                $caminho_titulo = get_the_title($pagina_escola);
                $caminho_link = get_the_permalink($pagina_escola);
            } else {
                $home_id = get_option('page_on_front');
                $caminho_titulo = get_the_title($home_id);
                $caminho_link = get_home_url();
            }

			echo '<div class="bn_fx_banner"><img src="'.$imagem_banner['url'].'" width="100%" alt="'.$imagem_banner['alt'].'">';
				if(!is_front_page()){
					echo '<div class="breadcrumb-banner breadcrumb-unidades text color-' . $infoBasicas['zona_sp'] . '">';
						echo '<div class="container">';
								echo '<div class="col-12">';
									echo '<h1 class="breadcrumb-banner-title">';
										echo get_the_title();
									echo '</h1>';
								echo '</div>';
                                echo '<ol id="breadcrumb" class="breadcrumb bg-transparent pl-1">';
                                    echo '<li class="breadcrumb-item"><a href="' . $caminho_link . '">' . $caminho_titulo . '</a></li>';
                                    echo '<li class="separator"> / </li>';
                                    echo '<li class="breadcrumb-item">' . $infoBasicas['dre_pertencente'] . '</li>';
                                    echo '<li class="separator"> / </li>';
                                    echo '<li class="breadcrumb-item">' . get_the_title() . '</li>';
                                echo '</ol>';

                                echo '<div class="col-12">';
                                    echo '<p class="endereco-banner">';
                                        if($infoBasicas['endereco'] && $infoBasicas['endereco'] != ''){
                                            echo $infoBasicas['endereco'];
                                        }

                                        if($infoBasicas['numero'] && $infoBasicas['numero'] != ''){
                                            echo ', ' . $infoBasicas['numero'];
                                        }

                                        if($infoBasicas['complemento'] && $infoBasicas['complemento'] != ''){
                                            echo ' - ' . $infoBasicas['complemento'];
                                        }

                                        if($infoBasicas['bairro'] && $infoBasicas['bairro'] != ''){
                                            echo ' - ' . $infoBasicas['bairro'];
                                        }

                                        if($infoBasicas['cep'] && $infoBasicas['cep'] != ''){
                                            echo ' - CEP: ' . $infoBasicas['cep'];
                                        }
                                    echo '</p>';

                                echo '</div>';

						echo '</div>';						
					echo '</div>';
				}
			echo '</div>';
		?>

        <div class="container color-<?php echo $infoBasicas['zona_sp']; ?>" id="Noticias">

            <?php /*
            <div class="row info-title border-bottom mb-3">
                <div class="col-md-9 col-sm-12">
                    <h1><?php echo get_the_title(); ?></h1>
                    <p><?php echo $infoBasicas['dre_pertencente']; ?></p>                    
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="form-group">
                        <select class="form-control" name="forma" onchange="location = this.value;">
                            <option disabled selected value> Selecione outra unidade </option>
                            <?php
                                $argsUnidades = array(
                                    'post_type' => 'unidade',
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                    'post__not_in' => array(31244),
                                    'post_status' => array('publish', 'pending'),
                                );

                                $todasUnidades = new \WP_Query( $argsUnidades );
        
                                // The Loop
                                if ( $todasUnidades->have_posts() ) {
                                    
                                    while ( $todasUnidades->have_posts() ) {
                                        $todasUnidades->the_post();
                                        echo '<option value="' . get_the_permalink() .'">' . get_the_title() .'</option>';
                                    }
                                
                                }
                                wp_reset_postdata();
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row info-contacts">            
                <div class="col-sm-12">                    
                    <p class='endereco'>
                        <?php 
                            if($infoBasicas['endereco'] && $infoBasicas['endereco'] != ''){
                                echo $infoBasicas['endereco'];
                            }

                            if($infoBasicas['numero'] && $infoBasicas['numero'] != ''){
                                echo ', ' . $infoBasicas['numero'];
                            }

                            if($infoBasicas['complemento'] && $infoBasicas['complemento'] != ''){
                                echo ' - ' . $infoBasicas['complemento'];
                            }

                            if($infoBasicas['bairro'] && $infoBasicas['bairro'] != ''){
                                echo ' - ' . $infoBasicas['bairro'];
                            }

                            if($infoBasicas['cep'] && $infoBasicas['cep'] != ''){
                                echo ' - CEP: ' . $infoBasicas['cep'];
                            }
                        ?>
                    </p>

                    <p class='contatos'>
                        <span>Contatos: </span>
                        <?php 
                            $contatos = array();
                            $tel_primary = $infoBasicas['telefone']['telefone_principal'];
                            $tel_second = $infoBasicas['telefone']['tel_second'];
                            $email_primary = $infoBasicas['email']['email_principal'];
                            $email_second = $infoBasicas['email']['email_second'];
                            $i = 0;

                            if($tel_primary && $tel_primary != ''){
                                $contatos[] = $tel_primary;
                            }
                        
                            if($tel_second && $tel_second != ''){
                                foreach($tel_second as $tel){
                                    $contatos[] = $tel['telefone_sec'];
                                }
                            }

                            if($email_primary && $email_primary != ''){
                                $contatos[] = $email_primary;
                            }
                        
                            if($email_second && $email_second != ''){
                                foreach($email_second as $email){
                                    $contatos[] = $email['email'];
                                }
                            }
                            
                            foreach($contatos as $contato){
                                if($i == 0){
                                    echo $contato;
                                } else {
                                    echo ' / '. $contato;
                                }

                                $i++;
                            }
                        ?>
                    </p>

                    <p class="horarios">
                        <span>Horário de Funcionamento: </span>
                        <?php
                            $horario = $infoBasicas['horario'];
                            
                            if($horario['dia_abertura'] && $horario['dia_abertura'] != ''){
                                echo $horario['dia_abertura'];
                            }

                            if($horario['dia_fechamento'] && $horario['dia_fechamento'] != ''){
                                echo ' a ' . $horario['dia_fechamento'];
                            }

                            if($horario['horario_abertura'] && $horario['horario_abertura'] != ''){
                                $hora_abert = convertHour($horario['horario_abertura']);                       
                                echo ' das ' . $hora_abert;
                            }

                            if($horario['horario_fechamento'] && $horario['horario_fechamento'] != ''){
                                $hora_fech = convertHour($horario['horario_fechamento']); 
                                echo ' às ' . $hora_fech;
                            }
                        ?>

                        <?php if($horario['horario_de_funcionamento'] && $horario['horario_de_funcionamento'] != '') : ?>
                        
                            <?php 
                                foreach($horario['horario_de_funcionamento'] as $horario){
                                    if($horario['data_inicial'] && $horario['data_inicial'] != ''){
                                        echo ' / ' . $horario['data_inicial'];
                                    }
        
                                    if($horario['data_final'] && $horario['data_final'] != '' && $horario['data_final'] != 'Feriados'){
                                        echo ' e ' . $horario['data_final'];
                                    }
        
                                    if($horario['hora_abertura'] && $horario['hora_abertura'] != ''){
                                        $hora_a = convertHour($horario['hora_abertura']);      
                                        echo ' das ' . $hora_a;
                                    }
        
                                    if($horario['hora_fechamento'] && $horario['hora_fechamento'] != ''){
                                        $hora_f = convertHour($horario['hora_fechamento']);
                                        echo ' às ' . $hora_f;
                                    }
                                }
                            ?>
                        
                        <?php endif; ?>
                    </p>
                </div> 
            </div>
            */ ?>
        </div>

    <?php
        
    }

}