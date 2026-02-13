<?php

$formato_exbicao = isset( $_GET['formato-exibicao'] ) ? sanitize_text_field( $_GET['formato-exibicao'] ) : 'lista';
$tipo_unidade = get_sub_field( 'tipo_unidade' );
$texto_botao = get_sub_field( 'texto_botao' );
if(!$texto_botao){
    $texto_botao = 'Acessar Página da Unidade';
}

if ( $tipo_unidade ) {
    setcookie( 'tipo_unidade', $tipo_unidade, time() + 3600, '/' );
} else {
    setcookie("tipo_unidade", "", time() - 3600, "/");
}

$tipo_unidade = !empty( $tipo_unidade ) ? [$tipo_unidade] : [];
$todasUnidades = get_unidades( 'all',  $tipo_unidade );

?>

<?php if ( !$todasUnidades->have_posts() ) : ?>
    
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="no-results">
                    <img src="<?= get_template_directory_uri();?>/img/search-empty.png" alt="">
                    <p>Não há conteúdo disponível para o termo buscado. Por favor faça uma nova busca.</p>
                </div>							
            </div>
        </div>
    </div>
        
<?php endif; ?>

<?php if ( $todasUnidades->have_posts() && $formato_exbicao === 'lista' ) : ?>
	<div class="container mb-5 mt-5 construtor-lista-unidades">
		<div class="row">
			<?php
            while ( $todasUnidades->have_posts() ) :
                $todasUnidades->the_post();

                $idFoto = get_field('foto_principal_do_ceu') ?: 34543;
                $foto = wp_get_attachment_image($idFoto, 'recorte-eventos', '', ['class' => 'img-fluid']);
                
                $endereco    = get_group_field('informacoes_basicas', 'endereco');
                $numero      = get_group_field('informacoes_basicas', 'numero');
                $complemento = get_group_field('informacoes_basicas', 'complemento');
                $bairro      = get_group_field('informacoes_basicas', 'bairro');
                $cep         = get_group_field('informacoes_basicas', 'cep');
                $dre         = get_group_field('informacoes_basicas', 'dre_pertencente');
				?>

				<div class="col-12 col-md-6 col-lg-3 p-2">
                    <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="mb-0 unidade-card">
                        <?= $foto; ?>
                        <h2><?= get_the_title(); ?></h2>
                        <div class="linha"></div>
                        <div class="unidade-endereco p-3">
                            <p class="endereco">
                                <i class="fa fa-map-marker pr-2" aria-hidden="true"></i>
                                <span>
                                    <?php if ($endereco): ?>
                                        <?= $endereco; ?>
                                    <?php endif; ?>

                                    <?php if ($numero): ?>
                                        , <?= $numero; ?>
                                    <?php endif; ?>

                                    <?php if ($complemento): ?>
                                        - <?= $complemento; ?>
                                    <?php endif; ?>

                                    <?php if ($bairro): ?>
                                        - <?= $bairro; ?>
                                    <?php endif; ?>

                                    <?php if ($cep): ?>
                                        - CEP: <?= $cep; ?>
                                    <?php endif; ?>
                                </span>
                            </p>
                            <?php if ($dre): ?>
                                <p class="unidade-dre"><?= $dre; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="card-rodape">                            
                            <div class="btn btn-block btn-primary"><?= $texto_botao ?></div>
                        </div>
                    </a>
				</div>
			    <?php
            endwhile;
            wp_reset_postdata();
            ?>
		</div>
	</div>
<?php endif; ?>

<?php if ( $todasUnidades->have_posts() && $formato_exbicao === 'mapa' ) : ?>
    <div class="container mb-5 mt-5">
        <div class="row m-0">
            <div class="col-sm-4 p-0 p-list">

                <div class="filtro-zonas-button open-close">
                    <button id="collpaseContent" class="openbtn closeContent" onclick="openUnidades()">
                        <i class="fa fa-chevron-up" aria-hidden="true"></i>
                    </button>
                </div>

                <div class="unidades-busca d-none">
                    <div id="search-box"></div>
                    <button class="btn-unidade" data-toggle="modal" data-target="#locationModal">
                        <i class="fa fa-crosshairs" aria-hidden="true"></i>
                    </button>
                    <div id="unidades-mapa"></div>
                </div>

                <div class="filtro-zonas-button d-none">
                    <button class="openbtn" onclick="openNav()">
                        Filtrar por zona <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>
                <?php
                    echo '<ul class="lista-unidades hidemapa">';
                    
                    while ($todasUnidades->have_posts()) :
                        $todasUnidades->the_post();

                        $id        = get_the_ID();
                        $titulo    = get_the_title();
                        $permalink = get_the_permalink($id);

                        $zona      = get_group_field('informacoes_basicas', 'zona_sp', $id);
                        $latitude  = get_group_field('informacoes_basicas', 'latitude', $id);
                        $longitude = get_group_field('informacoes_basicas', 'longitude', $id);
                        $endereco  = get_group_field('informacoes_basicas', 'endereco', $id);
                        $numero    = get_group_field('informacoes_basicas', 'numero', $id);
                        $bairro    = get_group_field('informacoes_basicas', 'bairro', $id);
                        $cep       = get_group_field('informacoes_basicas', 'cep', $id);
                        $emails    = get_group_field('informacoes_basicas', 'email', $id);
                        $tels      = get_group_field('informacoes_basicas', 'telefone', $id);
                        $foto_id   = get_field('foto_principal_do_ceu', $id);
                        $foto      = $foto_id ? wp_get_attachment_image($foto_id, 'recorte-eventos', false, ['class' => 'img-fluid']) : '';

                        ?>
                        <li>
                            <a href="#map" class="story" onclick="alerta(this)" data-point="<?= esc_attr("$latitude,$longitude") ?>">
                                <?php if (!$foto_id) : ?>
                                    <p class="unidades-title"><?= esc_html($titulo) ?></p>
                                <?php else : ?>
                                    <p class="unidades-title">
                                        <?= esc_html($titulo) ?>
                                        <a href="#a" class="openPopup" data-id="<?= $count ?>">
                                            <i class="fa fa-picture-o" aria-hidden="true"></i>
                                        </a>
                                    </p>

                                    <div class="popup popup-<?= $count ?>">
                                        <?= $foto ?>
                                        <button type="button" class="closePopup">
                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </a>

                            <p>
                                <?= esc_html(nomeZona($zona)) ?> • <?= esc_html("$endereco, $numero - $bairro - CEP: $cep") ?>
                            </p>

                            <p>
                                <?php if (!empty($emails['email_principal'])) : ?>
                                    <a href="mailto:<?= esc_attr($emails['email_principal']) ?>">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i> 
                                        <?= esc_html($emails['email_principal']) ?>
                                    </a><br>
                                <?php endif; ?>

                                <div class="d-flex justify-content-between">
                                    <?php if (!empty($tels['telefone_principal'])) : ?>
                                        <a href="tel:<?= esc_attr(clearPhone($tels['telefone_principal'])) ?>">
                                            <i class="fa fa-phone" aria-hidden="true"></i> 
                                            <?= esc_html($tels['telefone_principal']) ?>
                                        </a>
                                    <?php else : ?>
                                        <span>&nbsp;</span>
                                    <?php endif; ?>

                                    <a href="<?= esc_url($permalink) ?>">
                                        <?= $texto_botao ?> <i class="fa fa-external-link" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </p>
                        </li>
                        <?php
                        $count++;
                    endwhile;

                    echo '</ul>';


                wp_reset_postdata();
                ?>
            </div>

            <div class="col-sm-8 p-0 p-map">
                <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">                            
                            <div class="modal-body">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p>Usar minha localização para encontrar os CEUs mais próximos.</p>
                                <button type="button" class="btn btn-location" data-dismiss="modal" onclick="getLocation()">
                                    <i class="fa fa-globe" aria-hidden="true"></i> Usar minha localização
                                </button>
                            </div>                            
                        </div>
                    </div>
                </div>

                <div id="map"></div>
            </div>
        </div>
    </div>
<?php endif; ?>