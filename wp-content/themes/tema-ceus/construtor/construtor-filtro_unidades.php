<?php
global $wpdb;

$meta_key = 'informacoes_basicas_dre_pertencente';
$dres = $wpdb->get_col("
    SELECT DISTINCT meta_value
    FROM {$wpdb->postmeta}
    WHERE meta_key = '{$meta_key}'
    AND meta_value != ''
");

//Filtros
$dre_selecionada = isset( $_GET['dre'] ) ? sanitize_text_field( $_GET['dre'] ) : null;
$termo_busca = isset( $_GET['termo'] ) ? sanitize_text_field( $_GET['termo'] ) : null;
$formato_exbicao = isset( $_GET['formato-exibicao'] ) ? sanitize_text_field( $_GET['formato-exibicao'] ) : null;
$zona = isset( $_GET['zona'] ) ? sanitize_text_field( $_GET['zona'] ) : null;

?>
<section class="col-12 p-0 mb-5 construtor-filtro-unidades">
    <div class="container">
        <div class="row">
            <div class="col-12 titulo">
                <h4 class="mb-3 mt-3">
                    <?php echo esc_html( get_sub_field( 'titulo' ) ); ?>
                </h4>
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-lista-tab" data-toggle="tab" data-target="#nav-lista" type="button" role="tab" aria-controls="nav-lista" aria-selected="true">Ver em Lista</button>
                        <button class="nav-link" id="nav-mapa-tab" data-toggle="tab" data-target="#nav-mapa" type="button" role="tab" aria-controls="nav-mapa" aria-selected="false">Ver no mapa</button>
                    </div>
                </nav>
                <div class="tab-content tab-content px-2 mb-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-lista" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form class="row filtro-unidades mt-2" action="<?php echo esc_url( get_the_permalink() ); ?>" method="GET">
                            <?php if ( $dres ) : ?>
                                <div class="col-12 col-md-3 mb-sm-3">                    
                                    <select class="form-control input-top-search" name="dre">
                                        <option selected="" value="">Buscar por DRE </option>
                                        <option value="all" <?= $_GET['dre'] == 'all' ? 'selected' : ''?>>Todas</option>
                                        <?php foreach ( $dres as $dre ) : ?>
                                            <option
                                                value="<?php echo esc_html( $dre ); ?>"
                                                <?php selected( $dre == $dre_selecionada ); ?>
                                                >
                                                <?php echo esc_html( $dre ); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>                
                                </div>
                            <?php endif; ?>
                            <div class="col-12 col-md-6 mb-sm-3 p-md-0">
                                <input
                                    type="text"
                                    name="termo"
                                    class="form-control input-top-search"
                                    id="unidade-nome"
                                    placeholder="Buscar por Nome"
                                    value="<?php echo esc_html( $termo_busca ); ?>"
                                >
                            </div>
                            <div class="col-12 col-md-3 mb-sm-3 d-flex justify-content-around align-items-center botoes-acao">
                                <input type="hidden" name="formato-exibicao" value="lista">
                                <button type="submit" class="col btn btn-primary m-2">Buscar</button>
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="col btn btn-outline-primary m-2 btn-limpar-filtros">Limpar filtros</a>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-mapa" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row filtro-unidades mt-2">
                            <?php if ( $dres ) : ?>
                                <div class="col-12 col-md-4 mb-sm-3">                    
                                    <select class="form-control input-top-search" onchange="location = this.value;">
                                        <option selected="" value="">Buscar por Zona de Setorização</option>
                                        <option value="<?= get_the_permalink(); ?>?formato-exibicao=mapa" <?= !$_GET['zona'] ? 'selected' : ''?>>Todas</option>
                                        <option value="<?= get_the_permalink(); ?>?formato-exibicao=mapa&zona=centro" <?= $_GET['zona'] == 'centro' ? 'selected' : ''?>>Zona Central</option>
                                        <option value="<?= get_the_permalink(); ?>?formato-exibicao=mapa&zona=leste" <?= $_GET['zona'] == 'leste' ? 'selected' : ''?>>Zona Leste</option>
                                        <option value="<?= get_the_permalink(); ?>?formato-exibicao=mapa&zona=norte" <?= $_GET['zona'] == 'norte' ? 'selected' : ''?>>Zona Norte</option>
                                        <option value="<?= get_the_permalink(); ?>?formato-exibicao=mapa&zona=oeste" <?= $_GET['zona'] == 'oeste' ? 'selected' : ''?>>Zona Oeste</option>
                                        <option value="<?= get_the_permalink(); ?>?formato-exibicao=mapa&zona=sul" <?= $_GET['zona'] == 'sul' ? 'selected' : ''?>>Zona Sul</option>
                                    </select>                
                                </div>
                            <?php endif; ?>
                            <div class="input-group col-12 col-md-6 mb-sm-3 p-md-0">
                                <input
                                    type="text"
                                    class="form-control input-top-search"
                                    id="addressInput"
                                    placeholder="Buscar por Endereço"
                                    value="<?php echo esc_html( $termo_busca ); ?>"
                                >
                                <div class="input-group-append">
                                    <div class="btn btn-primary" onclick="geocodeAddress()">
                                        <i class="fa fa-search" aria-hidden="true"></i> Localizar
                                    </div>
                                </div>
                                <div id="searchResults" class="leaflet-locationiq-results d-block"></div>
                            </div>
                            <div class="col-12 col-md-2 mb-sm-3 d-flex justify-content-around align-items-center botoes-acao">
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>" class="col btn btn-outline-primary m-2 btn-limpar-filtros">Limpar filtros</a>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>			
</section>
<script>
    jQuery(function ($) {

        const storageKey = 'current_tab';
        const savedTab = localStorage.getItem(storageKey);

        if (savedTab) {
            const $savedTab = $('#' + savedTab);
            if ($savedTab.length) {
                $savedTab.tab('show');
            }
        }

        $('.nav-tabs .nav-link').on('click', function () {
            let currentTab = $(this).prop('id');

            localStorage.setItem(storageKey, currentTab);
        });

        //Remove a tab atual do localStorage
        $('.btn-limpar-filtros').on('click', function() {
            localStorage.removeItem(storageKey);
        });
    })
</script>