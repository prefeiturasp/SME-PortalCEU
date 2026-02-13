</section>
<!--main-->

<footer style="background: #363636;color: #fff;margin-left: -15px;margin-right: -15px;">
	<div class="container pt-3 pb-3" id="irrodape">
		<div class="row">
			<div class="col-sm-3 align-middle d-flex align-items-center footer-logo">
                <a href="https://www.capital.sp.gov.br/"><img src="<?php the_field('logo_prefeitura','conf-rodape'); ?>" alt="<?php bloginfo('name'); ?>"></a>
			</div>
			<div class="col-sm-3 align-middle bd-contact">
				<p class='footer-title'><?php the_field('nome_da_secretaria','conf-rodape'); ?></p>
				<?php the_field('endereco_da_secretaria','conf-rodape'); ?>
			</div>
			<div class="col-sm-3 align-middle">
				<p class='footer-title'>Contatos</p>
				<p><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php the_field('telefone','conf-rodape'); ?>"><?php the_field('telefone','conf-rodape'); ?></a></p>
				
				<?php if(get_field('email','conf-rodape')) :?>
				<p><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:<?php the_field('email','conf-rodape'); ?>"><?php the_field('email','conf-rodape'); ?></a></p>
				<?php endif; ?>

				<?php if(get_field('texto_link','conf-rodape') && get_field('link_adicional','conf-rodape')) :?>
				<p><i class="fa fa-comment" aria-hidden="true"></i> <a href="<?php the_field('link_adicional','conf-rodape'); ?>"><?php the_field('texto_link','conf-rodape'); ?></a></p>
				<?php endif; ?>				
			</div>
			<div class="col-sm-3 align-middle">				
            <p class='footer-title'>Redes sociais</p>
				<?php 
					$facebook = get_field('icone_facebook','conf-rodape');
					$instagram = get_field('icone_instagram','conf-rodape');
					$twitter = get_field('icone_twitter','conf-rodape');
					$youtube = get_field('icone_youtube','conf-rodape');
				?>
				<div class="row redes-footer">

					<?php if($facebook) : ?>
						<div class="col rede-rodape">
							<a href="<?php the_field('url_facebook','conf-rodape'); ?>">
							<img src="<?php echo $facebook; ?>" alt="Facebook"></a>
						</div>
					<?php endif; ?>

					<?php if($instagram) : ?>
						<div class="col rede-rodape">
							<a href="<?php the_field('url_instagram','conf-rodape'); ?>">
							<img src="<?php echo $instagram; ?>" alt="Instagram"></a>
						</div>
					<?php endif; ?>

					<?php if($twitter) : ?>
						<div class="col rede-rodape">
							<a href="<?php the_field('url_twitter','conf-rodape'); ?>">
							<img src="<?php echo $twitter; ?>" alt="Twitter"></a>
						</div>
					<?php endif; ?>

					<?php if($youtube) : ?>
						<div class="col rede-rodape">
							<a href="<?php the_field('url_youtube','conf-rodape'); ?>">
							<img src="<?php echo $youtube; ?>" alt="YouTube"></a>
						</div>
					<?php endif; ?>

					
				</div>
			</div>
		</div>
	</div>
</footer>
<div class="subfooter rodape-api-col" style="margin-left: -15px;margin-right: -15px;">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 text-center">
				<p>Prefeitura Municipal de São Paulo - Viaduto do Chá, 15 - Centro - CEP: 01002-020</p>
			</div>
		</div>
	</div>
</div>
<div class="voltar-topo">
	<a href="#" id="toTop" style="display: none;">
		<i class="fa fa-arrow-up" aria-hidden="true"></i>
		<p>Voltar ao topo</p>
	</a>
</div>
<?php wp_footer() ?>

<?php 
    $unidades = get_unidades();
    $tipo_unidade = isset( $_COOKIE['tipo_unidade'] ) ? [ $_COOKIE['tipo_unidade'] ] : [];
    $unidades = get_unidades( 'ID', $tipo_unidade );

    $marcadores = array();

    $p = 0;

    foreach ($unidades as $unidade){
        $zona = get_group_field( 'informacoes_basicas', 'zona_sp', $unidade );
        $endereco = get_group_field( 'informacoes_basicas', 'endereco', $unidade );
        $numero = get_group_field( 'informacoes_basicas', 'numero', $unidade );
        $bairro = get_group_field( 'informacoes_basicas', 'bairro', $unidade );
        $cep = get_group_field( 'informacoes_basicas', 'cep', $unidade );
        $emails = get_group_field( 'informacoes_basicas', 'email', $unidade );        
        $tels = get_group_field( 'informacoes_basicas', 'telefone', $unidade ); 

        //print_r($emails);

        $marcadores[$p][] = "<div class='marcador-unidade color-" . $zona . "'>
                                <p class='marcador-title'><a href='". get_the_permalink($unidade) ."'>" . get_the_title($unidade) . "</a></p>
                                <p><i class='fa fa-map-marker' aria-hidden='true'></i> " . nomeZona($zona) . " • " . $endereco . ", ". $numero ." - " . $bairro . " - CEP: " . $cep . "</p>
                                
                                <p><i class='fa fa-phone' aria-hidden='true'></i> " . $tels['telefone_principal'] ."</p>
                                <p><i class='fa fa-envelope' aria-hidden='true'></i> " . $emails['email_principal'] ."</p>
                            </div>";
        $marcadores[$p][] = get_group_field( 'informacoes_basicas', 'latitude', $unidade );
        $marcadores[$p][] = get_group_field( 'informacoes_basicas', 'longitude', $unidade );
        $marcadores[$p][] = get_group_field( 'informacoes_basicas', 'zona_sp', $unidade );

        $p++;
    }

    //print_r($unidades);
?>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.multiselect.js"></script>

    <script>
		var $s = jQuery.noConflict();

        $s(function () {
            $s('.ms-list-1').multiselect({
                columns  : 1,
                search   : false,
                selectAll: false,
                texts    : {
                    placeholder: 'Atividades de interesse',
                    selectedOptions: ' selecionados'
                },
                maxHeight : 300,
                maxWidth: 245,                
            });

            $s('.ms-list-3').multiselect({
                columns  : 1,
                search   : false,
                selectAll: false,
                texts    : {
                    placeholder: 'Selecione o(s) público(s)',
                    selectedOptions: ' selecionados'
                },
                maxHeight : 300,
                maxWidth: 245
            });

            $s('.ms-list-4').multiselect({
                columns  : 1,
                search   : false,
                selectAll: false,
                texts    : {
                    placeholder: 'Selecione a(s) faixa(s) etária(s)',
                    selectedOptions: ' selecionados'
                },
                maxHeight : 300,
                maxWidth: 245
            });

            $s('.ms-list-5').multiselect({
                columns  : 1,
                search   : false,
                selectAll: false,
                texts    : {
                    placeholder: 'Selecione o(s) CEU(s)',
                    selectedOptions: ' selecionados'
                },
                maxHeight : 300,
                maxWidth: 245
            });

            $s('.ms-list-10').multiselect({
                columns  : 1,
                search   : false,
                selectAll: false,
                texts    : {
                    placeholder: 'Selecione a(s) data(s)',
                    selectedOptions: ' selecionados'
                },
                maxHeight : 300,
                maxWidth: 245,
                maxSelect: 1
            });
            $s('.ms-list-10').multiselect( 'disable', true );

            $s('.ms-list-9').multiselect({
                columns  : 1,
                search   : false,
                selectAll: false,
                texts    : {
                    placeholder: 'Selecione o dia da semana',
                    selectedOptions: ' selecionados'
                },
                maxHeight : 300,
                maxWidth: 245
            });

            $s('.ms-list-8').multiselect({
                columns  : 1,
                search   : false,
                selectAll: false,
                texts    : {
                    placeholder: 'Selecione o período do dia',
                    selectedOptions: ' selecionados'
                },
                maxHeight : 300,
                maxWidth: 245,
                onOptionClick :function( element, option ){                    
                    var elemento = $s(option).val();
                    var selecionado = $s(".ms-list-8 option:selected").val();                    

                    $s('.ms-list-8').multiselect('reset');
                    
                    if(elemento == 'manha' && selecionado){
                        var manha = {name:"Manhã", value:"manha", checked:true};
                    } else {
                        var manha = {name:"Manhã", value:"manha", checked:false};
                    }

                    if(elemento == 'tarde' && selecionado){
                        var tarde = {name:"Tarde", value:"tarde", checked:true};
                    } else {
                        var tarde = {name:"Tarde", value:"tarde", checked:false};
                    }

                    if(elemento == 'noite' && selecionado){
                        var noite = {name:"Noite", value:"noite", checked:true};
                    } else {
                        var noite = {name:"Noite", value:"noite", checked:false};
                    }
                    
                    
                    $s('.ms-list-8').multiselect( 'loadOptions', [
                        manha,
                        tarde,
                        noite
                    ]);                    
                    
                },
            });
			
    
        });

        // Carrocel
        $s('.carousel').carousel({
            interval: 8000
        });

        $s( ".tab-mobile" ).click(function() {
            $s('#filtroBusca').modal('toggle');
        });
	</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script>
        $s('#date-range .input-daterange').datepicker({
            format: "dd/mm/yyyy",
            language: "pt-BR",
            autoclose: true
        });

        jQuery(document).ready(function($) {
            // Seleciona todos os filtros (colunas de 4 ou 8 colunas)
            const $todosFiltros = $('.form-prog .col-sm-4.mt-3, .form-prog .col-sm-8.mt-3');

            // Esconde todos a partir do quarto
            const $camposExtras = $todosFiltros.slice(3);
            const $botaoToggle = $('#toggle-filtros');

            // Oculta extras ao carregar
            $camposExtras.hide();

            // Alterna visibilidade no clique
            $botaoToggle.on('click', function() {
                const aberto = $camposExtras.is(':visible');

                if (aberto) {
                    $camposExtras.slideUp();
                    $(this).html('<i class="fa fa-plus" aria-hidden="true"></i><span>Mais filtros</span>');
                } else {
                    $camposExtras.slideDown();
                    $(this).html('<i class="fa fa-minus" aria-hidden="true"></i><span>Menos filtros</span>');
                }
            });
        });
    </script>

	<script src="//api.handtalk.me/plugin/latest/handtalk.min.js"></script>
	<script>
		var ht = new HT({
			token: "aa1f4871439ba18dabef482aae5fd934"
		});
	</script>

    <script type="text/javascript">
        var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })

        
    </script>

<?php if(is_page()) : ?>
    <script type="text/javascript">

        // Maps access token goes here
        //var key = 'pk.87f2d9fcb4fdd8da1d647b46a997c727';
        var key = 'pk.2217522833071a6e06b34ac78dfc05bc';

        // Initial map view
        <?php if($_GET['idUnidade'] && $_GET['idUnidade'] != ''): 
            $idUnidade = $_GET['idUnidade'];
            $latitude = get_group_field( 'informacoes_basicas', 'latitude', $idUnidade );
            $longitude = get_group_field( 'informacoes_basicas', 'longitude', $idUnidade );
            ?>
            var INITIAL_LNG = <?= $longitude ?>;
            var INITIAL_LAT = <?= $latitude; ?>;
            var INITIAL_ZOOM = 13;
        <?php elseif($_GET['zona'] && $_GET['zona'] != '' && $_GET['zona'] == 'norte'): ?>
            var INITIAL_LNG = -46.6457;
            var INITIAL_LAT = -23.4768;
            var INITIAL_ZOOM = 13;
        <?php elseif($_GET['zona'] && $_GET['zona'] != '' && $_GET['zona'] == 'sul'): ?>
            var INITIAL_LNG = -46.6900;
            var INITIAL_LAT = -23.6867;
            var INITIAL_ZOOM = 12;
        <?php elseif($_GET['zona'] && $_GET['zona'] != '' && $_GET['zona'] == 'leste'): ?>
            var INITIAL_LNG = -46.5046;
            var INITIAL_LAT = -23.5791;
            var INITIAL_ZOOM = 12;
        <?php elseif($_GET['zona'] && $_GET['zona'] != '' && $_GET['zona'] == 'oeste'): ?>
            var INITIAL_LNG = -46.7059;
            var INITIAL_LAT = -23.5671;
            var INITIAL_ZOOM = 13;
        <?php elseif($_GET['zona'] && $_GET['zona'] != '' && $_GET['zona'] == 'centro'): ?>
            var INITIAL_LNG = -46.6340;
            var INITIAL_LAT = -23.5425;
            var INITIAL_ZOOM = 14;
        <?php elseif($_GET['busca'] && $_GET['busca'] == 'endereco'): ?>
            var INITIAL_LNG = <?= $_GET['longitude']; ?>;
            var INITIAL_LAT = <?= $_GET['latitute']; ?>;
            var INITIAL_ZOOM = 15;
        <?php else: ?>
            var INITIAL_LNG = -46.6360999;
            var INITIAL_LAT = -23.5504533;
            var INITIAL_ZOOM = 11;
        <?php endif; ?>
        
        // Change the initial view if there is a GeoIP lookup
        if (typeof Geo === 'object') {
            INITIAL_LNG = Geo.lon;
            INITIAL_LAT = Geo.lat;
        }
        // Add layers that we need to the map
        var streets = L.tileLayer.Unwired({
            key: key,
            scheme: "streets"
        });

        var tileLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: false
        });



        var map = L.map('map', {
            scrollWheelZoom: (window.self === window.top) ? true : false,
            dragging: (window.self !== window.top && L.Browser.touch) ? false : true,
            layers: [tileLayer],
            tap: (window.self !== window.top && L.Browser.touch) ? false : true,
        }).setView({
            lng: INITIAL_LNG,
            lat: INITIAL_LAT
        }, INITIAL_ZOOM);
        var hash = new L.Hash(map);

        L.control.zoom({
            position: 'topright'
        }).addTo(map);

        // Add the 'layers' control
        L.control.layers({            
            "Completo" : tileLayer,
            "Ruas": streets,
        }, null, {
            position: "topright"
        }).addTo(map);

        // Add the 'scale' control
        L.control.scale().addTo(map);

        // Add geocoder
        var geocoder = L.control.geocoder(key, {
            fullWidth: 650,
            expanded: true,
            markers: true,
            attribution: null,
            url: 'https://api.locationiq.com/v1',
            placeholder: 'Encontre CEUs por nome ou endereço',
            textStrings: {                
                NO_RESULTS: 'Nenhum endereço encontrado.',
            },
            panToPoint: true,
            params: {
                countrycodes: 'BR'
            },
        }).addTo(map);

        // Focus to geocoder input
        geocoder.focus();

        geocoder.on('select', function(e) {
            if (typeof latlng == 'undefined') {
                // the variable is defined
                //alert('Aqui');
            }
            map.setView([e.latlng.lat, e.latlng.lng], 15);
        });


        var newParent = document.getElementById('search-box');
        var oldParent = document.getElementsByClassName("leaflet-top leaflet-left")

        while (oldParent[0].childNodes.length > 0) {
            newParent.appendChild(oldParent[0].childNodes[0]);
        }

        <?php
            
            $js_array = json_encode($marcadores);
            echo "var javascript_array = ". $js_array . ";\n";
        ?>

                
        for (var i = 0; i < javascript_array.length; i++) {

            if(javascript_array[i][3] == 'norte'){
                myIcon = L.icon({
                    iconUrl: "<?php echo get_template_directory_uri() . '/img/pin-map-norte.png'; ?>",
                });
            } else if(javascript_array[i][3] == 'sul'){
                myIcon = L.icon({
                    iconUrl: "<?php echo get_template_directory_uri() . '/img/pin-map-sul.png'; ?>",
                });
            } else if(javascript_array[i][3] == 'leste'){
                myIcon = L.icon({
                    iconUrl: "<?php echo get_template_directory_uri() . '/img/pin-map-leste.png'; ?>",
                });
            } else if(javascript_array[i][3] == 'oeste'){
                myIcon = L.icon({
                    iconUrl: "<?php echo get_template_directory_uri() . '/img/pin-map-oeste.png'; ?>",
                });
            } else {
                myIcon = L.icon({
                    iconUrl: "<?php echo get_template_directory_uri() . '/img/pin-map-padrao.png'; ?>",
                });
            }

            marker = new L.marker([javascript_array[i][1], javascript_array[i][2]], {
                    icon: myIcon
                })
                .bindPopup(javascript_array[i][0])
                .addTo(map);
        }

        // Posição no navegador

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            }
        }

        function showPosition(position) {
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            map.setView([position.coords.latitude, position.coords.longitude], 15);

            jQuery([document.documentElement, document.body]).animate({
                scrollTop: jQuery("#map").offset().top
            }, 1000);
        }
        
        <?php if($_GET['busca'] == 'endereco') : ?>
            
            var marker = L.marker([INITIAL_LAT, INITIAL_LNG]).addTo(map);
            map.setView([INITIAL_LAT, INITIAL_LNG], 15);
            jQuery([document.documentElement, document.body]).animate({
                scrollTop: jQuery("#map").offset().top
            }, 1000);
        <?php endif; ?>

        //adiciona link aos marcadores
        jQuery('.name .story').on('click', function(){
            // pega lat e lng das class ".story" por data attribute            
            var latlng = jQuery(this).data().point.split(',');
            var lat = latlng[0];
            var lng = latlng[1];
            var desc = latlng[2];
            var zoom = 17;
                            
            // adiciona marcadores
            var marker = L.marker([lat, lng] ).bindPopup(desc).addTo(map).openPopup();
            // adiciona no mapa
            map.setView([lat, lng], zoom);
            
        })

        function alerta(content){

            var latlng2 = content;
            var latlng = jQuery(latlng2).data().point.split(',');
            var lat = latlng[0];
            var lng = latlng[1];
            var desc = latlng[2];
            var zoom = 17;
        
            // adiciona no mapa
            map.setView([lat, lng], zoom);

            // Oculta a lista de Unidades
            jQuery(".lista-unidades").addClass('hidemapa');
            jQuery("#collpaseContent").addClass('closeContent');
        }       

        var $div = jQuery(".leaflet-locationiq-search-icon");
        var observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === "class") {
                var attributeValue = jQuery(mutation.target).prop(mutation.attributeName);
                fetchResults();
                }
            });
        });
        observer.observe($div[0], {
        attributes: true
        });

    </script>
    <?php  endif; ?>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".swiper", {
            slidesPerView: "auto",
            spaceBetween: 0,
            freeMode: true,
            loop: true,        
        });
    </script>
   
    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "100%";
            document.getElementById("mySidebar").classList.add("sidebar-border");
            jQuery(".lista-unidades").removeClass('hidemapa');
            jQuery("#collpaseContent").removeClass('closeContent');
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("mySidebar").classList.remove("sidebar-border");
            jQuery("input[name=zona][value='all']").prop("checked",true);
            map.setView([-23.5501, -46.6359], 11);            
        }

        function openUnidades(){
            jQuery(".lista-unidades").toggleClass('hidemapa');
            jQuery("#collpaseContent").toggleClass('closeContent');
        }

        jQuery("input[name='zona']").click(function(){
            
            var zona = jQuery('input:radio[name=zona]:checked').val();           
            
            if(zona == 'norte'){                
                map.setView([-23.4768, -46.6457], 13);
                jQuery(".lista-unidades").addClass('hidemapa');
                jQuery("#collpaseContent").addClass('closeContent');
            }

            if(zona == 'leste'){                
                map.setView([-23.5791, -46.5046], 12);
                jQuery(".lista-unidades").addClass('hidemapa');
                jQuery("#collpaseContent").addClass('closeContent');
            }

            if(zona == 'oeste'){                
                map.setView([-23.5671, -46.7059], 13);
                jQuery(".lista-unidades").addClass('hidemapa');
                jQuery("#collpaseContent").addClass('closeContent');
            }

            if(zona == 'central'){                
                map.setView([-23.5425, -46.6340], 14);
                jQuery(".lista-unidades").addClass('hidemapa');
                jQuery("#collpaseContent").addClass('closeContent');
            }

            if(zona == 'sul'){                
                map.setView([-23.6867, -46.6900], 12);
                jQuery(".lista-unidades").addClass('hidemapa');
                jQuery("#collpaseContent").addClass('closeContent');
            }

            if(zona == 'all'){                
                map.setView([-23.5501, -46.6359], 11);
                jQuery(".lista-unidades").addClass('hidemapa');
                jQuery("#collpaseContent").addClass('closeContent');
            }
            
        });
        
        var addressInput = document.getElementById('addressInput');
        var clearButton = document.getElementById('clearButton');
        var searchResults = document.getElementById('searchResults');

        addressInput.addEventListener('focus', function() {
        showResults();
        });

        addressInput.addEventListener('blur', function() {
        hideResults();
        });

        addressInput.addEventListener('input', function() {
        if (addressInput.value.trim() !== '') {
            clearButton.style.display = 'block';
        } else {
            clearButton.style.display = 'none';
        }
        });

        function showResults() {
        if (addressInput.value.trim() !== '') {
            searchResults.style.display = 'block';
        }
        }

        function hideResults() {
        searchResults.style.display = 'none';
        }

        function clearSearch() {
        addressInput.value = '';
        clearButton.style.display = 'none';
        searchResults.innerHTML = '';
        }

        function geocodeAddress() {
            var address = document.getElementById('addressInput').value;
            var busca = address;
            var country = 'BR';

            fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + address + '&countrycodes=' + country)
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                var searchResults = document.getElementById('searchResults');
                searchResults.innerHTML = '';

                if (data && data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        var result = data[i];
                        var address = result.display_name;

                        let index = address.indexOf(",");
                        let parte1 = address.substring(0, index);
                        let parte2 = address.substring(index + 1);

                        var latlng = [result.lat, result.lon];

                        var resultItem = document.createElement('div');
                        resultItem.classList.add('end-result');
                        resultItem.innerHTML = '<a href="<?= get_the_permalink(); ?>?formato-exibicao=mapa&busca=endereco&latitute=' + latlng[0] + '&longitude=' + latlng[1] + '"><div class="name">' + parte1 + '</div><div class="address">' + parte2 + '</div></a>';

                        searchResults.appendChild(resultItem);

                        jQuery.ajax({
                            url: '<?php echo admin_url( 'admin-ajax.php' ) ?>',
                            type:"post",
                            data: { action: 'data_fetch', keyword: busca  },
                            success: function(data) {
                                jQuery('#unidadesResult').remove();
                                var conteudoHTML = data;
                                var elemento = jQuery('<div id="unidadesResult"></div>').html(conteudoHTML);
                                searchResults.prepend(elemento["0"]);
                            },
                            //error : function(error){ console.log(error) }
                        });

                    }
                } else {
                    searchResults.innerHTML = 'Nenhum resultado encontrado';
                }
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    </script>

    <script>
        jQuery(document).ready(function() {
            jQuery('.openPopup').click(function() {
                jQuery('.popup').fadeOut();
                var popupId = jQuery(this).data("id");
                var classPop = 'popup-' + popupId;
                jQuery('.' + classPop).fadeIn();
            });

            jQuery('.closePopup').click(function() {
                jQuery('.popup').fadeOut();
            });
        });
    </script>

    <?php if(is_search()): ?>
        <script>
            jQuery(document).ready(function() {                
                jQuery("html").animate(
                    {
                        scrollTop: jQuery("#programacao").offset().top
                    },
                    800 //tempo da rolagem
                );
            });
        </script>
    <?php endif; ?>

</body>
</html>