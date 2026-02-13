<?php get_header(); ?>

<div class="inicio" style="display:none;">
<?php

$GLOBALS['z'] = 0;
//config número de posts
$GLOBALS['paginacao'] = 10;
$GLOBALS['arrayVerId'] = array();
    function busca_multisite()
    {
		function tirarAcentos($string){
		$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
		$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u','u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0','U', 'U', 'U');

   		return str_replace($comAcentos, $semAcentos, $string);
}		

		
		
		
	$termo_buscado = get_search_query(); //termo da busca
		$z = 0;
		function alert($oque) {
			echo '<script>alert("'.$oque.'");</script>';
		}
	
	$arrayO = array('post','page','programa-projeto','card');  //pega todos tipos de post (inclusive indesejáveis, então precisa excluir, no array $excluidos)
	$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
	$termo_buscado = isset($_GET['s']) ? $_GET['s'] : ''; 
	$periodo = isset($_GET['periodo']) ? $_GET['periodo'] : '';
	$tipoconteudo = isset($_GET['tipoconteudo']) ? substr(($_GET['tipoconteudo']), 0, -1) : $arrayO;
	$categoria = isset($_GET['category']) ? $_GET['category'] : '';
	$ano = isset($_GET['ano']) ? $_GET['ano'] : '';
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
	$quaissites = isset($_GET['site']) ? $_GET['site'] : '';
	
		if($ano != '') {
			$quetipodedata =  array(
        'relation' => 'AND',
        array('year' => intval($ano)),
        array('year' => intval($ano)),
    );
		}
		else {
			$quetipodedata = array(
			'after'     => $periodo.' hours ago',
			'inclusive' => true,
		);
		}
		
		echo'<pre style="display:none;">';
		echo'Lista de ID';
		var_dump(get_sites());
		echo'</pre>';
		
		
	if($quaissites == '')
	$arraysites = array('1','4','5','6');
	//$arraysites = array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20'); //array dos sites disponíveis
	else 
	$arraysites = array($quaissites);
		
		//echo get_search_query();
		//echo $termo_buscado;
		if (!$tipoconteudo) 
			$tipoconteudo = $arrayO;
		
		
		

		
	$sites = array(
		's' => '',
		'post_status'    => 'publish',
		'sentence' => true,
		'site__in' => $arraysites,
		//'public' => 1,
		//'site__in' => $arraysites,
		//informa a lista de sites que deseja ter nos resultados da busca
		'paged' => $paged,
		'orderby' => ['post_type' => 'ASC','id'=>'ASC','date' => 'DESC'],
		'public' => 'true',
		'posts_per_page' => -1, //utilizado para uma função custom de paginação fora do wordpress
	    'date_query' => $quetipodedata,
	
	
		'post_type' => ($tipoconteudo),
		'category_name' => $categoria
	);
		//aqui ultimo
		//var_dump($tipoconteudo);
	
        $GLOBALS['i'] = 0;
		
		// mudar a ordem dos sites (descomentar abaixo para verificar order atual)
		//print("<pre>".print_r(get_sites($sites),true)."</pre>");
		if($quaissites == '') {
		$sitesNovaOrdem =  array();
		$arraySitee = get_sites($sites);
		
		//nova ordem relativa aos sites
		array_push(
			$sitesNovaOrdem,
			$arraySitee[0],//Portal SME
			$arraySitee[1],//Portal SME
			$arraySitee[2],//Portal SME
			$arraySitee[3],//Portal SME
			$arraySitee[4],//CAE Conselho
			$arraySitee[5],//CME Conselho
			$arraySitee[6]//CACSFUNDEB Conselho
			//$arraySitee[7]//Reservado DRE
			//$arraySitee[8]//Reservado DRE
			//$arraySitee[9]//Reservado DRE
			//$arraySitee[10]//Reservado DRE
			//$arraySitee[11]//Reservado DRE
			//$arraySitee[12]//Reservado DRE
			//$arraySitee[13]//Reservado DRE
			//$arraySitee[14]//Reservado DRE
			//$arraySitee[15]//Reservado DRE
			//$arraySitee[16]//Reservado DRE
			//$arraySitee[17]//Reservado DRE
			//$arraySitee[18]//Reservado DRE
			//$arraySitee[19]//Reservado DRE
		);
		}
		else
			$sitesNovaOrdem = get_sites($sites);
			//verifica a nova ordem
		///////print("<pre>".print_r(($sitesNovaOrdem),true)."</pre>");
		if($_GET['s'] == '' && !isset($_GET['tipoconteudo']) == 1) {
			echo "<div style='text-align:left'><p>Nenhum termo foi digitado.</p> <p>faça uma nova pesquisa ou navegue abaixo em nossas ultimas noticias.</p></div>";
		}

					//aqui
		$anosArray = array();
	
		//aqui2 inicio
        foreach (($sitesNovaOrdem) as $blog) {
		
		
if(strlen($_GET['s']) <= 2){ break; }   
			switch_to_blog($blog->blog_id);

            $busca_geral = new WP_Query($sites);

	
         /*    print("<pre>".print_r($busca_geral,true)."</pre>"); */


            if ($busca_geral->have_posts()) {
                //começo aqui
       
             
                while ($busca_geral->have_posts()) {
                    $busca_geral->the_post();
					
					
					                       /*     echo '<script>alert("'.ceil($GLOBALS['i']/$GLOBALS['paginacao']).'")</script>'; */

               if (!in_array(get_the_guid(), $GLOBALS['arrayVerId']))
{
				
$search = tirarAcentos($termo_buscado);					
$conta = false;
array_push($GLOBALS['arrayVerId'],get_the_guid());
$titulo = tirarAcentos(get_the_title());
$descricao = tirarAcentos(get_the_excerpt());
$conteudo = tirarAcentos(get_the_content());					
$post_tags = get_the_tags();
$stringTags = '';
					
if ( $post_tags ) {
    foreach( $post_tags as $tag ) {
	
		
	
		$stringTags.= $tag->name;
    }
	
}
		
if($titulo != '' && $termo_buscado != '') {
if(preg_match("/{$search}/i", $titulo) ||
preg_match("/{$search}/i", $descricao) ||
preg_match("/{$search}/i", $conteudo) ||
preg_match("/{$search}/i", $stringTags)) 
{
$GLOBALS['i']++;
}
			
			}
else {
$GLOBALS['i']++;
}
if($GLOBALS['i'] > ($GLOBALS['paginacao'] * ($pagina-1)) and ($GLOBALS['i'] <= ($GLOBALS['paginacao'] * ($pagina)) ))
{

	$post_date = get_the_date( 'Y' );
	$anoCheck = get_the_date( 'Y' ) == $ano ? null : 'dnones'; 		

	$temTermo = (strlen($termo_buscado) >= 1 ? true : false) ;
							   $a = 1;
				if($a == 1)	
				{		   
					
if($temTermo)						
$search = tirarAcentos($termo_buscado);
else
$search = '';


					
$esseTemSearch = false;

					
	if(preg_match("/{$search}/i", $titulo		) ||
	   preg_match("/{$search}/i", $descricao	) ||
	   preg_match("/{$search}/i", $conteudo		) ||
	   preg_match("/{$search}/i", $stringTags	)) 
	{
		
		/* if(preg_match("/{$search}/i", $titulo	 )  )   echo 'titulo' ;
		if(preg_match("/{$search}/i", $descricao)	)  echo 'descricao';
		if(preg_match("/{$search}/i", $conteudo	))  echo $conteudo;
		if(preg_match("/{$search}/i", $stringTags)	)  echo 'stringTags' ; */
		
		
		    $esseTemSearch = true;
			$umadiante = true;
			
	}
	else {
	/*	$GLOBALS['i']--;  */
	/*	echo 'menosmenos'; */
	}

			
					
					if($esseTemSearch == false){
					
						continue;
						echo '<div class="postagemX dnone '.$GLOBALS['i'].'" >';						
						//echo "<script>alert('$titulo')</script>";
					
						}
					else {
					
						echo '<div class="postagemX '.$GLOBALS['i'].'">';
						$umadiante = true;
			
					}
				
				}
    ?>

				<div>
                  <div class="row">
                        <div class="col-sm-4">
                            <?php
                            if (has_post_thumbnail() != '') {
                                echo '<figure class="">';
                                the_post_thumbnail('medium', array(
                                    'class' => 'img-fluid rounded float-left'
                                ));
                                echo '</figure>';
                            } else {
                            
							if($esseTemSearch == true){ ?>
							 
                                <figure>
                                    <img class="img-fluid rounded float-left" src="https://hom-educacao.sme.prefeitura.sp.gov.br/wp-content/uploads/2020/03/placeholder06.jpg" width="100%">
                                </figure>
                            <?php
							}
								else {
									?>
							 
                                <figure>
                                    <img class="img-fluid rounded float-left" srcsetX="" width="100%">
                                </figure>
                            <?php
								}
									
                            }
                            ?>
                        </div>
                        <div class="col-sm-8">
							<h2><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h2>
                            <?php /*?><p><?php the_content();?></p><?php */?>   <!--Mostra conteudo-->
							<p><?php the_excerpt();?></p>   <!--Mostra resumo-->
							<?php /*?><p><?php the_field('insira_o_subtitulo');?></p><?php */?>   <!--Subtitulo ACF-->
							
							
							<?php
							if(get_the_tags() != null){
								echo'<strong>Tag(s): </strong>';
								$posttags = get_the_tags();
								if ($posttags) {
								  foreach($posttags as $tag) {
									echo '<a href="?s='.$tag->name.'" style="color:white" class="tagcolor">' .$tag->name . '</a> '; 
								  }
								}
								echo'<br>';
							}
							?>
							
							<?php
							if(get_post_type() != ''){
								?>
							<strong>Tipo:</strong> <span class="tagcolor"><?php $tipopost = get_post_type();
								if( $tipopost == "post" ) echo  'Notícia';
								if( $tipopost == "programa-projeto" ) echo  'Página';
								if( $tipopost == "card" ) echo  'página';
								if( $tipopost == "page" ) echo  'Página'; ?>
							</span><br>
							<?php
							}
							?>
  
							<?php /*?><span><strong>Categoria(s):</strong> <?php
							  foreach (get_the_category() as $category) {
									echo  $category->name.", ";
								}
							?></span><br><?php */?>
                            
                            <span><strong>Publicado em:</strong> <?php the_time('d/m/Y G\hi'); ?> </span> -

                            <span><strong>Site:</strong>
								<a href="<?php echo get_site_url(); ?>">
									<?php echo get_bloginfo('description');?>
								</a>
							</span><br>
							<!--<span>na categoria: <?php // get_the_category(  )[0]->name; ?></span>-->

                        </div>

                    </div>
   <hr>
                  </div>
   </div>
            <?php
            
                        }
						if($esseTemSearch == false){
							
						}
					
                   
					}
                    }
            
            }
  
            //fim
            else {
                if($GLOBALS['i'] = 0)
                echo 'Não foi encontrado resultado para a pesquisa:' . '' . '"' . $termo_buscado . '"';

                break;
            }
			
            ?>
	
    <?php restore_current_blog();
        }
	
		//mescla as querys	
	function merge_querystring($url = null,$query = null,$recursive = false){ 
		if($url == null)
		return false;
		if($query == null)
		return $url;

		$url_components = parse_url($url);

		if(empty($url_components['query']))
		return $url.'?'.ltrim($query,'?');

		parse_str($url_components['query'],$original_query_string);
		parse_str(parse_url($query,PHP_URL_QUERY),$merged_query_string);
		if($recursive == true)
		$merged_result = array_merge_recursive($original_query_string,$merged_query_string);
		else
		$merged_result = array_merge($original_query_string,$merged_query_string);
		return str_replace($url_components['query'],http_build_query($merged_result),$url);
	}


?>

<?php 


?>
<div style="width:100%;text-align: center;">
	<div class="pagination <?=ceil($GLOBALS['i']/$GLOBALS['paginacao']) > 1 && $GLOBALS['i'] !== $GLOBALS['paginacao'] ? 'ok' : 'dnone';?>">
		<a href="" class="anterior <?=$pagina > 1 ? 'ok' : 'dnone';?>">Anterior</a><!--Ir para o anterior-->
		<a class="paginationA " href="#">&laquo;</a><!--Ir para o primeiro-->
		<a class="paginationB <?=$pagina >= 1 ? 'ok' : 'dnone';?>" href="<?=$pagina - 2;?>"><?=$pagina - 2;?></a>
		<a class="paginationB <?=$pagina >= 2 ? 'ok' : 'dnone';?>" href="<?=$pagina - 1;?>"><?=$pagina - 1;?></a>
		<a class="paginationA <?=ceil($GLOBALS['i']/$GLOBALS['paginacao']) > $pagina + 0 ? 'ok' : 'dnone';?>" href=""></a>
		<a class="paginationA " href="<?=$pagina;?>"></a>
		<a class="paginationA <?=ceil($GLOBALS['i']/$GLOBALS['paginacao']) > $pagina + 0 ? 'ok' : 'dnone';?>" href=""></a>
		<a class="a paginationA <?=ceil($GLOBALS['i']/$GLOBALS['paginacao']) > $pagina + 1 ? 'ok' : 'dnone';?>"  href=""></a>
		<a class="b paginationA <?=ceil($GLOBALS['i']/$GLOBALS['paginacao']) > $pagina + 2 ? 'ok' : 'dnone';?>"  href=""></a>
		<a class="c paginationA <?=ceil($GLOBALS['i']/$GLOBALS['paginacao']) > $pagina + 3 ? 'ok' : 'dnone';?>"  href=""></a>

		<a class="d paginationA" href="">»</a><!--Ir para o ultimo-->
		<a href="" class="proximo <?=$pagina != ceil($GLOBALS['i']/$GLOBALS['paginacao'])  ? 'ok' : 'dnone';?>">Próximo</a><!--Ir para o próximo-->
	</div>
</div>
<script>
function replaceQueryParam(param, newval, search) {
var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
var query = search.replace(regex, "$1").replace(/&$/, '');

return (query.length > 2 ? query + "&" : "?") + (newval ? param + "=" + newval : '');
}

jQuery('.anterior').eq(0).attr('href',replaceQueryParam('pagina', <?=$pagina-1; ?>  , window.location.search));
jQuery('.proximo').eq(0).attr('href',replaceQueryParam('pagina', <?=$pagina+1; ?>  , window.location.search));

jQuery('.paginationB').eq(0).attr('href',replaceQueryParam('pagina', <?=$pagina-2; ?>  , window.location.search)).text(<?=$pagina - 2; ?>);
jQuery('.paginationB').eq(1).attr('href',replaceQueryParam('pagina', <?=$pagina-1; ?>  , window.location.search)).text(<?=$pagina - 1; ?>);
jQuery('.paginationB').eq(2).attr('href',replaceQueryParam('pagina', <?=$pagina; ?>  , window.location.search)).text(<?=$pagina; ?>);
jQuery('.paginationA').eq(0).attr('href',replaceQueryParam('pagina', 1, window.location.search));
jQuery('.paginationA').eq(1).attr('href',replaceQueryParam('pagina', <?=$pagina; ?>  , window.location.search)).text(<?=$pagina; ?>);

jQuery('.paginationA').eq(2).attr('href',replaceQueryParam('pagina', <?=$pagina+1 <= ceil($GLOBALS['i']/$GLOBALS['paginacao']) ? $pagina+1 : $pagina; ?>, window.location.search)).text(<?=$pagina+1 <= ceil($GLOBALS['i']/$GLOBALS['paginacao']) ? $pagina+1 : $pagina; ?>);
jQuery('.paginationA').eq(3).attr('href',replaceQueryParam('pagina', <?=$pagina+2; ?>, window.location.search)).text(<?=$pagina+2; ?>);
<?php if( $GLOBALS['i']/$GLOBALS['paginacao'] >= $pagina+2) { ?>
	jQuery('.paginationA').eq(4).attr('href',replaceQueryParam('pagina', <?=$pagina+3; ?>, window.location.search)).text(<?=$pagina+3; ?>);
<?php } 
	else 
		echo "jQuery('.paginationA').eq(4).hide();";
	?>
	jQuery('.paginationA').eq(5).attr('href',replaceQueryParam('pagina', <?=ceil($GLOBALS['i']/$GLOBALS['paginacao']); ?>, window.location.search)).text(<?=ceil($GLOBALS['i']/$GLOBALS['paginacao']); ?>);

jQuery('.paginationA').eq(6).attr('href',replaceQueryParam('pagina', <?=ceil($GLOBALS['i']/$GLOBALS['paginacao']); ?>, window.location.search));

jQuery('.paginationB').eq(0).text() < 1 ? jQuery('.paginationB').eq(0).remove() : null
jQuery('.paginationB').eq(1).text() < 1 ? jQuery('.paginationB').eq(1).remove() : null
jQuery('.paginationA').eq(3).text() > <?=ceil($GLOBALS['i']/$GLOBALS['paginacao']); ?> ? jQuery('.paginationA').eq(3).remove() : null
jQuery('.paginationA').eq(6).text() == '' ? jQuery('.paginationA').eq(6).remove() : null

jQuery('.paginationA').last().attr('href',replaceQueryParam('pagina', <?=ceil($GLOBALS['i']/$GLOBALS['paginacao']); ?>, window.location.search));			

	jQuery('.paginationA').eq(1).attr('href',replaceQueryParam('pagina', <?=$pagina; ?>  , window.location.search)).text(<?=$pagina; ?>);

	jQuery('.paginationA').eq(1).attr('href',replaceQueryParam('pagina', <?=$pagina; ?>  , window.location.search)).text(<?=$pagina; ?>);

</script>

<?php


		//fim
		
			}					

    ?>


    <div  class="container ">

        <div class="row">

            <div class="col-sm-8 mb-4">
<!--Busca Manual-->

<?php $campo_de_busca = get_search_query(); ?>


<?php if( have_rows('cadastro_busca_manual', 'option') ): ?>

    <?php while( have_rows('cadastro_busca_manual', 'option') ): the_row(); ?>
			<?php
				//$palavra_chave = array('dina');


$arrayPalavrasPost = explode(",",get_sub_field('palavras_chaves_busca_manual'));
$arrayPalavrasPost = array_map('trim', $arrayPalavrasPost);

//Retornos das variáveis abaixo.
//var_dump($arrayPalavrasPost);
//var_dump($campo_de_busca);

				
				if (in_array(trim($campo_de_busca), $arrayPalavrasPost)  ){
				

?>
				
					<?php 
						if($_GET["pagina"] <= 1){//mostrar somente se for a primeira página
						?>
							<div class="row">
							<div class="col-sm-4">
								<?php
								if(get_sub_field('imagem_busca_manual') != ''){
									?>
									<figure>
										<img class="img-fluid rounded float-left" src="<?php the_sub_field('imagem_busca_manual'); ?>" width="100%">
									</figure>
									<?php
								}else{
									?>
									<figure>
										<img class="img-fluid rounded float-left" src="https://hom-educacaco.sme.prefeitura.sp.gov.br/wp-content/uploads/2020/03/placeholder06.jpg" width="100%">
									</figure>	
									<?php
								}
								?>
							</div>
							<div class="col-sm-8">
							
								<h2>
									
									<a href="<?php the_sub_field('url_busca_manual'); ?>" targetX="<?php the_sub_field('abrir_busca_manual'); ?>" rel="noopener" >
										<?php the_sub_field('titulo_busca_manual'); ?>
									</a>
									
								</h2>
								<p><?php the_sub_field('resumo_busca_manual'); ?></p>
								<p><strong>Tipo:</strong> <span class="tagcolor"><?php the_sub_field('tipo_busca_manual'); ?></span></p>
								
								
							</div>
						</div>
						<hr>
						<?php
						}
					?>
						
					
					
					<?php
				}
			?>
			
    <?php endwhile; ?>
<?php endif; ?>
<!--Busca Manual-->				
				
				
            <?php busca_multisite(); ?>

            </div>

            <div class="col-sm-4 mb-4">

                <span class="filtro-busca">
                    <form name="filtrosX" method="get" action="">

                        <div class="form-group border-filtro">
                            <label for="usr"><strong>
                                    <h2>Refine a sua busca</h2>
                                </strong></label>
                        </div>

                        <div class="form-group">
                            <label for="usr"><strong>Busque por um termo</strong></label>
                            <input class='form-control' type='text' name="s" placeholder='Buscar' value="<?=$_GET['s']?>"></input>
							
							  <input id="enviar-busca-home" name="enviar-busca-home" type="hidden" class="btn btn-outline-secondary bt-search-topo" value="Buscar"> </input>
							
                        </div>
                        <div style="display: none;" class="form-group">

                            <label for="sel2"><strong>Filtre por categorias</strong></label>

                            <select class="form-control" name="category" id="sel2">
                                <?php
                                $current = get_current_site();

                                // pega cats de todos sites
                                $blogs = get_blog_list(0, 'all');

                                echo  "<option value=''>Selecione</option>";

                                foreach ($blogs as $blog) {
                                    switch_to_blog($blog['blog_id']);
                                    $args = array(
                                        'hide_empty' => false
                                    );
                                    $categories = get_categories($args);
                                    //    var_dump($categories);
									sort($categories);
                                    foreach ($categories as $category) {

                                        $link = ($category->name);
                                        $name = $category->name;
									
									
                                        echo  "<option value='" . $link . "'>" . $name . "</option>";

                                        // printf( '<a href="%s" title="%s">%s</a> ', $link, $name, $name );
                                    }
                                }
                                switch_to_blog($current->id);
                                ?>
                            </select>

                        </div>

                        <div class="form-group">

                            <label for="sel1"><strong>Filtre por tipo de conteúdo</strong></label>



                            <select name="tipoconteudo" onchange="jQuery('#sel3sites').val(event.target.value.slice(-1))" class="form-control" id="sel1c">

                                <?php
                                $current = get_current_site();
                                echo  "<option value=''>Selecione o tipo</option>";
                                //pega todos tipos de post (inclusive indesejáveis, então precisa excluir, no array abaixo)
                               
                                $blogs = get_blog_list(0, 'all');
							
								//pega todos tipos de post (inclusive indesejáveis, então precisa excluir, no array $excluidos)
	$excluidos = array('wp_block');	
                                foreach ($blogs as $blog) {
                                    switch_to_blog($blog['blog_id']);
                                    $args = array(
                                        'hide_empty' => false
                                    );
                                    $categories = get_categories($args);
									$variavelArrayPosttipo = get_post_types();
											sort($variavelArrayPosttipo);
									($name == $categoria ? $isselected = '' : $isselected = 'selected' );
                                    foreach ($variavelArrayPosttipo as $posttipo) {
                                    if (!in_array($posttipo, $excluidos)) {
                                          $_GET['tipoconteudo'] == $posttipo."".$blog['blog_id'] ? $isselected = 'selected' : $isselected = '';
                                            echo  "<option value='" . $posttipo."".$blog['blog_id'] . "' ".$isselected.">" . $posttipo."".$blog['blog_id'] . "</option>";
                                        }
                                        // printf( '<a href="%s" title="%s">%s</a> ', $link, $name, $name );
                                    }
                                }
                                switch_to_blog($current->id);
								
                                ?>
                               


                            </select>
							<script>
								//script para mudar a ordem mas antes sanear
setTimeout(function(){ 
for (var i = jQuery('[name=tipoconteudo] option').length; i > 0; i--) { 
console.log(i)
if(jQuery('[name=tipoconteudo] option').eq(i).attr('style') == "display: none;") jQuery('[name=tipoconteudo] option').eq(i).remove()
}
}, 20);
setTimeout(function(){ 
jQuery('[name=tipoconteudo] option:eq(7)').insertBefore(jQuery('[name=tipoconteudo] option:eq(1)'));
jQuery('[name=tipoconteudo] option:eq(8)').insertBefore(jQuery('[name=tipoconteudo] option:eq(2)'));
jQuery('[name=tipoconteudo] option:eq(3)').insertBefore(jQuery('[name=tipoconteudo] option:eq(3)'));
jQuery('[name=tipoconteudo] option:eq(4)').insertBefore(jQuery('[name=tipoconteudo] option:eq(4)'));
jQuery('[name=tipoconteudo] option:eq(7)').insertBefore(jQuery('[name=tipoconteudo] option:eq(5)'));
jQuery('[name=tipoconteudo] option:eq(8)').insertBefore(jQuery('[name=tipoconteudo] option:eq(6)'));
            }, 100);
							</script>
                        </div>

                        <div class="form-group">

                            <label for="sel2"><strong>Filtre por um período</strong></label>

                            <select name="periodo" class="form-control" id="sel3">
 
                                <option value="">Todos os períodos</option>
                                <option <?=$_GET['periodo'] == '1' ? 		"selected" : 'n' ?> value="1">Última hora</option>
                                <option <?=$_GET['periodo'] == '24' ? 		"selected" : 'n' ?> value="24">Últimas 24 horas</option>
                                <option <?=$_GET['periodo'] == '168' ? 		"selected" : 'n' ?> value="168">Última semana</option>
                                <option <?=$_GET['periodo'] == '5040' ? 	"selected" : 'n' ?> value="5040">Último mês</option>
                                <option <?=$_GET['periodo'] == '1839600' ?  "selected" : 'n' ?> value="1839600">Último ano</option>

                            </select>

                        </div>

                        <div class="form-group">

                            <label for="sel2"><strong>Filtre por ano</strong></label>

                            <select name="ano" class="form-control" id="sel3">

                            </select>

                        </div>

                        <div class="form-group">

                            <label for="sel2"><strong>Filtre por site</strong></label>
                            <?php $blogs = get_blog_list(0, 'all');
                            ?>
                            <select name="site" class="form-control" id="sel3sites">

                                <option value="">Todos os sites</option>

                                <?php
                                foreach ($blogs as $blog) {
									$blog['blog_id'] == $_GET['site'] ? $isselected = 'selected' : $isselected = '';
                                    echo  '<option '.$isselected.' value="' . $blog['blog_id'] . '">' . $blog['path'] . '</option>';
                                }
                                ?>
							 </select>
<!--<script>
	//script para mudar a ordem dos sites
	jQuery('#sel3sites option:eq(4)').insertBefore(jQuery('#sel3sites option:eq(1)'));
	jQuery('#sel3sites option:eq(5)').insertBefore(jQuery('#sel3sites option:eq(2)'));
	jQuery('#sel3sites option:eq(4)').insertBefore(jQuery('#sel3sites option:eq(3)'));
</script>-->
<script>
	//coloca o id do site atual na variavel
	var pageId = <?php echo $current->id; ?>;
	//script para mudar a ordem dos sites
	jQuery('#sel3sites option[value="'+pageId+'"]').insertBefore(jQuery('#sel3sites option:eq(1)'));//recebe o valor da variavel
	jQuery('#sel3sites option[value="4"]').insertBefore(jQuery('#sel3sites option:eq(2)'));
	jQuery('#sel3sites option[value="5"]').insertBefore(jQuery('#sel3sites option:eq(3)'));
	jQuery('#sel3sites option[value="6"]').insertBefore(jQuery('#sel3sites option:eq(4)'));
	jQuery('#sel3sites option[value="7"]').insertBefore(jQuery('#sel3sites option:eq(5)'));
</script>
						
								            </div>

                        <div class="form-group">
                            <script>
                                function limpaFiltro() {
                                    setTimeout(() => {
                                        window.location = window.location.pathname + "?s=";
                                    }, 100);
                                }
                            </script>
                            <button onclick="limpaFiltro()" type="button" class="btn btn-refinar btn-sm float-left">Limpar filtros</button>
                            <button type="submit" class="btn btn-primary btn-sm float-right">Refinar busca</button>

                        </div>

                </span>

            </div>



        </div>

    </div>
    </div>
    </form>

<?php 
$ano_agora = date('Y');
$date_range = range(2013, $ano_agora);
$anosArray = $date_range;

		echo '<div class="transportX" style="display:none;"><option value="">Todos os anos</option>';
			
		(sort($anosArray));
							 foreach ((array_unique($anosArray)) as $ano) {
								 $ano == $_GET['ano'] ? $isselected = 'selected' : $isselected = '';
			echo '<option '.$isselected.' value="'.$ano.'">'.$ano.'</option>';
		
							 }
		echo '</div>';
?>
    <script>
		
function mudaNomes(nomevelho, nomenovo){
for (i = 0; i < jQuery('option').length; i++) {
	if(nomenovo !== '')
	jQuery('option').eq(i).html() == nomevelho ? jQuery('option').eq(i).html(nomenovo) : null
	else 
	jQuery('option').eq(i).html() == nomevelho ? jQuery('option').eq(i).hide() : null	
}
}
//REMOVE OU MODIFICA OS NOMES DE TODOS OS SELECTS DO FILTRO
//Troca nome filtro de conteudo
mudaNomes('page1', 'Página em SME Portal Educação');
mudaNomes('post1', 'Notícia em SME Portal Educação');
mudaNomes('page4', 'Página em CAE Conselho');
mudaNomes('post4', 'Notícia em CAE Conselho');
mudaNomes('page5', 'Página em CME Conselho');
mudaNomes('post5', 'Notícia em CME Conselho');
mudaNomes('page6', 'Página em CACSFUNDEB Conselho');
mudaNomes('post6', 'Notícia em CACSFUNDEB Conselho');
mudaNomes('page7', 'Página em CRECE Conselho');
mudaNomes('post7', 'Notícia em CRECE Conselho');
mudaNomes('post8', 'Página em DREs');
	
		

//Remove do fitro de conteúdo
mudaNomes('acf-field-group7', '');
mudaNomes('aba7', '');
mudaNomes('acf-field7', '');
mudaNomes('agenda7', '');
mudaNomes('attachment7', '');
mudaNomes('botao7', '');
mudaNomes('card7', '');
mudaNomes('contato7', '');
mudaNomes('curriculo-da-cidade7', '');
mudaNomes('custom_css7', '');
mudaNomes('customize_changeset7', '');
mudaNomes('nav_menu_item7', '');
mudaNomes('oembed_cache7', '');
mudaNomes('organograma7', '');
mudaNomes('programa-projeto7', '');
mudaNomes('revision7', '');
mudaNomes('rl_gallery7', '');
mudaNomes('user_request7', '');
mudaNomes('wpcf7_contact_form7', '');
		
mudaNomes('aba6', '');
mudaNomes('acf-field6', '');
mudaNomes('acf-field-group6', '');
mudaNomes('agenda6', '');
mudaNomes('attachment6', '');
mudaNomes('botao6', '');
mudaNomes('card6', '');
mudaNomes('contato6', '');
mudaNomes('curriculo-da-cidade6', '');
mudaNomes('custom_css6', '');
mudaNomes('customize_changeset6', '');
mudaNomes('nav_menu_item6', '');
mudaNomes('oembed_cache6', '');
mudaNomes('organograma6', '');
mudaNomes('programa-projeto6', '');
mudaNomes('revision6', '');
mudaNomes('rl_gallery6', '');
mudaNomes('user_request6', '');
mudaNomes('wpcf7_contact_form6', '');
		
mudaNomes('aba5', '');
mudaNomes('acf-field5', '');
mudaNomes('acf-field-group5', '');
mudaNomes('agenda5', '');
mudaNomes('attachment5', '');
mudaNomes('botao5', '');
mudaNomes('card5', '');
mudaNomes('contato5', '');
mudaNomes('curriculo-da-cidade5', '');
mudaNomes('custom_css5', '');
mudaNomes('customize_changeset5', '');
mudaNomes('nav_menu_item5', '');
mudaNomes('oembed_cache5', '');
mudaNomes('organograma5', '');
mudaNomes('programa-projeto5', '');
mudaNomes('revision5', '');
mudaNomes('rl_gallery5', '');
mudaNomes('user_request5', '');
mudaNomes('wpcf7_contact_form5', '');
		
mudaNomes('aba4', '');
mudaNomes('acf-field4', '');
mudaNomes('acf-field-group4', '');
mudaNomes('agenda4', '');
mudaNomes('attachment4', '');
mudaNomes('botao4', '');
mudaNomes('card4', '');
mudaNomes('contato4', '');
mudaNomes('curriculo-da-cidade4', '');
mudaNomes('custom_css4', '');
mudaNomes('customize_changeset4', '');
mudaNomes('nav_menu_item4', '');
mudaNomes('oembed_cache4', '');
mudaNomes('organograma4', '');
mudaNomes('programa-projeto4', '');
mudaNomes('revision4', '');
mudaNomes('rl_gallery4', '');
mudaNomes('user_request4', '');
mudaNomes('wpcf7_contact_form4', '');
		
mudaNomes('aba1', '');
mudaNomes('acf-field1', '');
mudaNomes('acf-field-group1', '');
mudaNomes('agenda1', '');
mudaNomes('attachment1', '');
mudaNomes('botao1', '');
mudaNomes('card1', '');
mudaNomes('contato1', '');
mudaNomes('curriculo-da-cidade1', '');
mudaNomes('custom_css1', '');
mudaNomes('customize_changeset1', '');
mudaNomes('nav_menu_item1', '');
mudaNomes('oembed_cache1', '');
mudaNomes('organograma1', '');
mudaNomes('programa-projeto1', '');
mudaNomes('revision1', '');
mudaNomes('rl_gallery1', '');
mudaNomes('user_request1', '');
mudaNomes('wpcf7_contact_form1', '');
//Troca nome filtros sites
mudaNomes('/', 'SME Portal Educação');
mudaNomes('/conselho-de-alimentacao-escolar/', 'CAE Conselho');
mudaNomes('/conselho-municipal-de-educacao/', 'CME Conselho');
mudaNomes('/conselho-de-representantes-de-conselhos-de-escola/', 'CRECE Conselho');
mudaNomes('/conselho-de-acompanhamento-e-controle-social-do-fundeb/', 'CACSFUNDEB Conselho');



		<?php 
if(strlen($_GET['s']) > 2){
?>
var i;
var o = 0;
var elll = document.querySelectorAll('.postagemX');
for (i = 0; i < elll.length ; i++) {
   (elll[i].style.display) == 'none' ? o++ : console.log('n');
}
elll.length - o > 0 ? console.log('oi') : jQuery('.inicio .container .row .col-sm-8').html('<p>Não há conteúdo disponível para o termo buscado.</p><p>Por favor informe um novo termo no campo "Buscar".</p>')
<?php }
	else
	{
		?>
		jQuery('.inicio .container .row .col-sm-8').html('<p>Digite ao menos 3 caracteres para realizar a busca.</p>');
														jQuery("#main > div.inicio").show();
	<?php	
	}
	?>
//remove duplicados da paginação
var valoresOpt = [];
	jQuery('.paginationA').each(function(){
	   if(jQuery.inArray(this.text, valoresOpt) >-1){
		if(this.text != "")
		jQuery(this).remove()
	   }else{
		valoresOpt.push(this.text);
	   }
	});

//adiciona dinamicamente o filtro de ano
jQuery('[name=ano]').html(jQuery('.transportX').html())
		
var ativaAgora = new URL(location.href).searchParams.get('pagina');
for (i = 0; i < document.querySelectorAll('.pagination.ok a').length ; i++) {
   jQuery('.pagination.ok a').eq(i).text() == ativaAgora ?  jQuery('.pagination.ok a').eq(i).addClass('active') : null
}
jQuery( "[targetx='_blank']"  ).click(function(e) {
e.preventDefault();
window.open(e.target.href, '_blank');
});
//ultimo js a ser executado deve ser o abaixo		
jQuery('.inicio').show()
    </script>             

<?php 


//var_dump($GLOBALS['z']);
get_footer(); ?>
</div>