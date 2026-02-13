<?php
$objetivos = get_sub_field('fx_objetivos_1_1');
$modelo = get_sub_field('modelo');
$colunas = get_sub_field('colunas');

echo '<div class="container">';
    echo '<div class="row">';

        foreach($objetivos as $objetivo):
            $objimg = wp_get_attachment_url($objetivo['fx_icone_objetivos']);
            $objalt = get_post_meta($objetivo['fx_icone_objetivos'], '_wp_attachment_image_alt', TRUE);
        ?>

        <?php if($modelo == 'horizon'): ?>

            <div class="col-sm-12 col-md-6 col-lg-<?= esc_attr($colunas); ?> mb-3 d-flex">
                <div class="card mb-3 flex-fill horizontal-card">
                    <div class="row g-0 align-items-center h-100">
                        <div class="col-3 pr-0 py-2 d-flex align-items-center">
                            <img src="<?= esc_url($objimg); ?>" class="img-fluid rounded-start" alt="<?= esc_attr($objalt); ?>">
                        </div>
                        <div class="col-9 pl-2">
                            <div class="card-body pl-0 h-100 d-flex align-items-center">
                                <p class="card-text mb-0"><?= esc_html($objetivo['fx_descritivo_objetivos']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <div class="col-sm-12 col-md-6 col-lg-<?= esc_attr($colunas); ?> mb-3">
                <div class="card obj-card h-100">
                    <img src="<?= esc_url($objimg); ?>" alt="<?= esc_attr($objalt); ?>">
                    <div class="card-body">
                        <p class="card-title"><?= esc_html($objetivo['fx_descritivo_objetivos']); ?></p>                                                        
                    </div>
                </div>                                                
            </div>

        <?php endif; ?>

    <?php
        endforeach;                                            
    echo '</div>'; // row
echo '</div>'; // container