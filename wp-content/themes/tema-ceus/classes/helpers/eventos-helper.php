<?php
namespace Classes\Helpers;

class EventosHelper {
    
    private $today;
    
    public function __construct() {
        $this->today = date('Ymd');
    }
    
    /**
     * Renderiza eventos automáticos (próximos, encerrados, permanentes)
     */
    public function renderEventosAutomaticos($evento, $tipo, $today) {
        $args = $this->getQueryArgs($tipo, $today);
        $the_query = new \WP_Query($args);
        
        if (!$the_query->have_posts()) {
            wp_reset_postdata();
            return '';
        }
        
        $output = '<div class="container">';
        
        // Header section
        $output .= $this->getHeaderSection($tipo);
        
        // Posts loop
        $output .= $this->getPostsLoop($the_query, $tipo);
        
        $output .= '</div>';
        
        wp_reset_postdata();
        return $output;
    }
    
    /**
     * Renderiza eventos manuais
     */
    public function renderEventosManuais($evento) {
        $eventosLista = $evento['eventos'];
        $titulo = $evento['titulo'];
        
        ob_start();
        ?>
        <div class="tema-eventos my-4">
            <!-- Desktop -->
            <div class="container d-none d-md-block">
                <div class="row">
                    <div class="col-sm-12 tema-eventos-title mb-3">
                        <h3><?php echo $titulo; ?></h3>
                    </div>
                    <?php foreach($eventosLista as $eventoInterno) : ?>
                        <div class="col-sm-3">
                            <?php echo $this->renderCardEvento($eventoInterno); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Mobile -->
            <div class="swiper d-block d-md-none">
                <div class="col-sm-12 tema-eventos-title mb-3">
                    <h3><?php echo $titulo; ?></h3>
                </div>
                
                <div class="swiper-wrapper">
                    <?php foreach($eventosLista as $eventoInterno) : ?>
                        <div class="swiper-slide">
                            <?php echo $this->renderCardEventoMobile($eventoInterno); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Retorna os argumentos da query baseado no tipo
     */
    private function getQueryArgs($tipo, $today) {
        $baseArgs = [
            'posts_per_page' => $tipo == 'proxima' ? 5 : 8,
            'orderby' => 'meta_value_num',
            'order' => $tipo == 'encerrada' ? 'DESC' : 'ASC',
        ];
        
        switch($tipo) {
            case 'proxima':
                $baseArgs['meta_query'] = $this->getMetaQueryProximas($today);
                break;
                
            case 'encerrada':
                $baseArgs['meta_query'] = $this->getMetaQueryEncerradas($today);
                break;
                
            case 'perma':
                $baseArgs['meta_query'] = $this->getMetaQueryPermanentes();
                break;
        }
        
        return $baseArgs;
    }
    
    /**
     * Meta query para atividades próximas
     */
    private function getMetaQueryProximas($today) {
        return [
            'relation' => 'AND',
            [
                'relation' => 'OR',
                [
                    'key' => 'data_data',
                    'compare' => '>=',
                    'value' => $today,
                ],
                [
                    'key' => 'data_data_final',
                    'compare' => '>=',
                    'value' => $today,
                ],
                [
                    'key' => 'ceus_participantes_$_data_serie_data',
                    'compare' => '>=',
                    'value' => $today,
                ],
            ], 
        ];
    }
    
    /**
     * Meta query para atividades encerradas
     */
    private function getMetaQueryEncerradas($today) {
        return [
            'relation' => 'AND',
            [
                'key' => 'data_data',
                'compare' => '<',
                'value' => $today,
            ],
            [
                'key' => 'data_data_final',
                'compare' => '<',
                'value' => $today,
            ],
            [
                'key' => 'tipo_de_evento_tipo',
                'value' => 'serie',
                'compare' => '!='
            ],
            [
                'key' => 'data_tipo_de_data',
                'value' => 'semana',
                'compare' => '!='
            ],                            
        ];
    }
    
    /**
     * Meta query para atividades permanentes
     */
    private function getMetaQueryPermanentes() {
        return [
            'relation' => 'AND',                            
            [
                'key' => 'data_tipo_de_data',
                'value' => 'semana',
            ],                            
        ];
    }
    
    /**
     * Retorna o header section baseado no tipo
     */
    private function getHeaderSection($tipo) {
        $titles = [
            'proxima' => ['title' => 'Próximas Atividades', 'link' => 'proxima'],
            'encerrada' => ['title' => 'Atividades Encerradas', 'link' => 'encerrada'],
            'perma' => ['title' => 'Atividades Permanentes', 'link' => 'permanente']
        ];
        
        $data = $titles[$tipo];
        
        return '
        <div class="title-ativi">
            <h2>' . $data['title'] . '</h2><hr>                                    
            <a href="' . get_home_url() . '/?s=&tipo_atividade=' . $data['link'] . '">Ver todas</a>
        </div>';
    }
    
    /**
     * Loop de posts com layout específico
     */
    private function getPostsLoop($the_query, $tipo) {
        $isSlider = in_array($tipo, ['proxima', 'encerrada']);
        $isGrid = $tipo == 'perma';
        
        $output = '';
        
        if ($isSlider) {
            $output .= '<div class="row-slide mb-5" style="margin-left: -15px; margin-right: -15px;">';
            $output .= '<section class="regular slider">';
        } elseif ($isGrid) {
            $output .= '<div class="row mb-4">';
        }
        
        while ($the_query->have_posts()) {
            $the_query->the_post();
            
            if ($isSlider) {
                $output .= $this->renderCardEvento(get_post());
            } elseif ($isGrid) {
                $output .= '
                <div class="col-sm-12 col-md-6 col-lg-3 mb-4">                                    
                    ' . $this->renderCardEvento(get_post()) . '
                </div>';
            }
        }
        
        if ($isSlider) {
            $output .= '</section>';
            $output .= '</div>';
        } elseif ($isGrid) {
            $output .= '</div>';
        }
        
        return $output;
    }
    
    /**
     * Renderiza card de evento para desktop
     */
    public function renderCardEvento($post) {
        if (is_int($post)) {
            $post = get_post($post);
        } elseif (is_array($post) && isset($post['ID'])) {
            $post = get_post($post['ID']);
        }
        
        $post_id = $post->ID;
        $imgData = $this->getEventImage($post_id);
        $categorias = $this->getEventCategories($post_id);
        $dataInfo = $this->getEventDateInfo($post_id);
        $horario = $this->getEventTime($post_id);
        $local = $this->getEventLocation($post_id);
        
        ob_start();
        ?>
        <div class="card-eventos">
            <div class="card-eventos-img">
                <a href="<?php echo get_the_permalink($post_id); ?>">
                    <img src="<?php echo $imgData['url']; ?>" class="img-fluid d-block" alt="<?php echo $imgData['alt']; ?>">
                </a>
                <?php echo $this->getEventBadges($post_id); ?>
            </div>
            <div class="card-eventos-content p-2">
                <div class="info-top">
                    <div class="evento-categ border-bottom pb-1">
                        <?php echo $categorias; ?>
                    </div>
                    <h3><a href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h3>
                </div>
                <div class="info-bottom">
                    <?php echo $this->getEventInfoTable($dataInfo, $horario, $local, $post_id); ?>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Renderiza card de evento para mobile
     */
    public function renderCardEventoMobile($post) {
        $post_id = is_object($post) ? $post->ID : $post;
        $imgData = $this->getEventImage($post_id);
        $categorias = $this->getEventCategories($post_id);
        $dataInfo = $this->getEventDateInfo($post_id);
        $horario = $this->getEventTime($post_id);
        $local = $this->getEventLocation($post_id);
        $tipoEvento = get_field('tipo_de_evento_tipo', $post_id);
        
        ob_start();
        ?>
        <div class="card-eventos">
            <div class="card-eventos-img">
                <a href="<?php echo get_the_permalink($post_id); ?>">
                    <img src="<?php echo $imgData['url']; ?>" class="img-fluid d-block" alt="<?php echo $imgData['alt']; ?>">
                </a>
                <?php echo $this->getEventBadges($post_id); ?>
            </div>
            <div class="card-eventos-content p-2">
                <div class="evento-categ border-bottom pb-1">
                    <?php echo $categorias; ?>
                </div>
                <h3><a href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h3>
                <p class="mb-0">
                    <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $dataInfo; ?>
                    <br>
                    <?php if($horario) : ?>                                           
                        <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo convertHour($horario); ?>
                    <?php endif; ?>
                    <?php if($tipoEvento == 'serie'): ?>
                        <i class="fa fa-clock-o" aria-hidden="true"><span>icone horario</span></i> Múltiplos Horários
                    <?php endif; ?>
                </p>
                <?php echo $this->getEventLocationMobile($local, $tipoEvento, $post_id); ?>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Obtém dados da imagem do evento
     */
    private function getEventImage($post_id) {
        $imgSelect = get_field('capa_do_evento', $post_id);
        $featured_img_url = wp_get_attachment_image_src($imgSelect, 'recorte-eventos');
        
        if($featured_img_url) {
            return [
                'url' => $featured_img_url[0],
                'alt' => get_post_meta($imgSelect, '_wp_attachment_image_alt', true)
            ];
        }
        
        return [
            'url' => get_template_directory_uri().'/img/placeholder_portal_ceus.jpg',
            'alt' => get_the_title($post_id)
        ];
    }
    
    /**
     * Obtém as categorias do evento formatadas
     */
    private function getEventCategories($post_id) {
        $atividades = get_the_terms($post_id, 'atividades_categories');
        if (!$atividades) return '';
        
        $listaAtividades = [];
        
        foreach($atividades as $atividade) {
            if(count($atividades) > 1 && $atividade->parent == 0) continue;
            $listaAtividades[] = $atividade->term_id;
        }
        
        $links = [];
        foreach($listaAtividades as $atividade_id) {
            $term = get_term($atividade_id);
            $links[] = '<a href="' . get_home_url() . '?s=&atividades[]=' . $term->slug . '">' . $term->name . '</a>';
        }
        
        return implode(' ,', $links);
    }
    
    /**
     * Obtém as badges do evento (tipo e online)
     */
    private function getEventBadges($post_id) {
        $tipo = get_field('tipo_de_evento_selecione_o_evento', $post_id);
        $online = get_field('tipo_de_evento_online', $post_id);
        $output = '';
        
        if($tipo) {
            $output .= '<span class="flag-pdf-full">' . get_the_title($tipo) . '</span>';
        }
        
        if($online) {
            $customClass = $tipo ? 'mt-tags' : '';
            $output .= '<span class="flag-pdf-full ' . $customClass . '">Evento on-line</span>';
        }
        
        return $output;
    }
    
    /**
     * Obtém informações de data formatadas
     */
    private function getEventDateInfo($post_id) {
        $campos = get_field('data', $post_id);
        $tipoEvento = get_field('tipo_de_evento_tipo', $post_id);
        
        if(!$campos) return '';
        
        $tipoData = $campos['tipo_de_data'];
        
        switch($tipoData) {
            case 'data':
                return $this->formatSingleDate($campos['data']);
                
            case 'semana':
                return $this->formatWeekDays($campos['dia_da_semana']);
                
            case 'periodo':
                return $this->formatDateRange($campos['data'], $campos['data_final']);
                
            default:
                return $this->getDefaultDate();
        }
    }
    
    /**
     * Formata data única
     */
    private function formatSingleDate($data) {
        if(!$data) return $this->getDefaultDate();
        
        $dataEvento = explode("-", $data);
        $mes = date('M', mktime(0, 0, 0, $dataEvento[1], 10));
        $mes = translateMonth($mes);
        
        return $dataEvento[2] . " " . $mes . " " . $dataEvento[0];
    }
    
    /**
     * Formata dias da semana
     */
    private function formatWeekDays($semana) {
        $show = [];
        
        foreach($semana as $dias) {
            $diasArray = $dias['selecione_os_dias'];
            $total = count($diasArray);
            $diasShow = '';
            
            foreach($diasArray as $i => $diaS) {
                if($i == $total - 1 && $total > 1) {
                    $diasShow .= "e " . $diaS;
                } elseif($i == $total - 1) {
                    $diasShow .= $diaS;
                } else {
                    $diasShow .= $diaS . ", ";
                }
            }
            
            $show[] = $diasShow;
        }
        
        return implode(" / ", $show) ?: $this->getDefaultDate();
    }
    
    /**
     * Formata range de datas
     */
    private function formatDateRange($dataInicial, $dataFinal) {
        if(!$dataInicial) return $this->getDefaultDate();
        
        if(!$dataFinal) {
            return $this->formatSingleDate($dataInicial);
        }
        
        $dataInicial = explode("-", $dataInicial);
        $dataFinal = explode("-", $dataFinal);
        
        if($dataInicial[1] != $dataFinal[1]) {
            $mesIni = translateMonth(date('M', mktime(0, 0, 0, $dataInicial[1], 10)));
            $mesFinal = translateMonth(date('M', mktime(0, 0, 0, $dataFinal[1], 10)));
            
            return $dataInicial[2] . ' '. $mesIni . " a " . $dataFinal[2] . " " . $mesFinal . " " . $dataFinal[0];
        }
        
        $mes = translateMonth(date('M', mktime(0, 0, 0, $dataFinal[1], 10)));
        return $dataInicial[2] . " a " . $dataFinal[2] . " " . $mes . " " . $dataFinal[0];
    }
    
    /**
     * Data padrão fallback
     */
    private function getDefaultDate() {
        $dataEvento = get_the_date('Y-m-d');
        $dataEvento = explode("-", $dataEvento);
        $mes = date('M', mktime(0, 0, 0, $dataEvento[1], 10));
        return translateMonth($mes);
    }
    
    /**
     * Obtém horário do evento
     */
    private function getEventTime($post_id) {
        $horario = get_field('horario', $post_id);
        if(!$horario) return '';
        
        $tipoHorario = $horario['selecione_o_horario'];
        
        if($tipoHorario == 'horario') {
            return $horario['hora'];
        }
        
        if($tipoHorario == 'periodo') {
            $periodos = [];
            foreach($horario['hora_periodo'] as $periodo) {
                $texto = $periodo['periodo_hora_inicio'];
                if($periodo['periodo_hora_final']) {
                    $texto .= ' às ' . $periodo['periodo_hora_final'];
                }
                $periodos[] = $texto;
            }
            return implode(' / ', $periodos);
        }
        
        return '';
    }
    
    /**
     * Obtém localização do evento
     */
    private function getEventLocation($post_id) {
        return get_field('localizacao', $post_id);
    }
    
    /**
     * Gera tabela de informações do evento
     */
    private function getEventInfoTable($dataInfo, $horario, $local, $post_id) {
        $tipoEvento = get_field('tipo_de_evento_tipo', $post_id);
        $isSpecialLocation = in_array($local, ['31675', '31244']);
        
        ob_start();
        ?>
        <table class="info-linha">
            <tr>
                <td class="icon"><i class="fa fa-calendar" aria-hidden="true"></i></td>
                <td><?php echo $dataInfo; ?></td>
            </tr>

            <?php if ($horario) : ?>
            <tr>
                <td class="icon"><i class="fa fa-clock-o" aria-hidden="true"></i></td>
                <td><?php echo convertHour($horario); ?></td>
            </tr>
            <?php endif; ?>

            <?php if ($tipoEvento == 'serie'): ?>
            <tr>
                <td class="icon"><i class="fa fa-clock-o" aria-hidden="true"><span>icone horario</span></i></td>
                <td>Múltiplos Horários</td>
            </tr>
            <?php endif; ?>

            <?php if ($isSpecialLocation): ?>
                <tr>
                    <td class="icon"><i class="fa fa-map-marker" aria-hidden="true"><span>icone unidade</span></i></td>
                    <td><?php echo get_the_title($local); ?></td>
                </tr>
            <?php elseif ($tipoEvento == 'serie') : ?>
                <tr>
                    <td class="icon"><i class="fa fa-map-marker" aria-hidden="true"><span>icone unidade</span></i></td>
                    <td>Múltiplas Unidades</td>
                </tr>
            <?php else: ?>
                <tr>
                    <td class="icon"><a href="<?php echo get_the_permalink($local); ?>"><i class="fa fa-map-marker" aria-hidden="true"><span>icone unidade</span></i></a></td>
                    <td><a href="<?php echo get_the_permalink($local); ?>"><?php echo get_the_title($local); ?></a></td>
                </tr>
            <?php endif; ?>
        </table>
        <?php
        return ob_get_clean();
    }
    
    /**
     * Gera localização para mobile
     */
    private function getEventLocationMobile($local, $tipoEvento, $post_id) {
        $isSpecialLocation = in_array($local, ['31675', '31244']);
        
        if($isSpecialLocation) {
            return '<p class="mb-0 mt-1 evento-unidade no-link"><i class="fa fa-map-marker" aria-hidden="true"><span>icone unidade</span></i> ' . get_the_title($local) . '</p>';
        } elseif($tipoEvento == 'serie') {
            return '<p class="mb-0 mt-1 evento-unidade no-link"><i class="fa fa-map-marker" aria-hidden="true"><span>icone unidade</span></i> Múltiplas Unidades</p>';
        } else {
            return '<p class="mb-0 mt-1 evento-unidade"><a href="' . get_the_permalink($local) . '"><i class="fa fa-map-marker" aria-hidden="true"><span>icone unidade</span></i> ' . get_the_title($local) . '</a></p>';
        }
    }
}