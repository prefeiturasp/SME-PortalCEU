<?php
$colunas = get_sub_field('colunas');
$servicos = get_sub_field('fx_servicos_1_1');

if($servicos && !empty($servicos)):
    echo '<div class="container">';
        echo '<div class="row">';
            foreach($servicos as $servico):
            ?>
                <div class="col-6 col-md-<?= $colunas; ?> mb-3 service-item">
                    <?php if( $servico['link'] && !empty($servico['link']) ): ?>
                        <a href="<?= $servico['link']; ?>" class="service-link">
                    <?php endif; ?>
                        <div>
                            <img src="<?= $servico['fx_icone_objetivos']['url']; ?>" alt="<?= $servico['fx_icone_objetivos']['alt']; ?>">                    
                        </div>
                        <p><?= $servico['fx_descritivo_objetivos']; ?></p>
                    <?php if( $servico['link'] && !empty($servico['link']) ): ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php
            endforeach;
        echo '</div>'; // row
    echo '</div>'; // container
endif;