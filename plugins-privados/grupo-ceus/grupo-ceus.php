<?php
/*
Plugin Name: Grupos Ceus
Description:  Plugin Criado para controlar os editores dos CEUs
Author: Felipe Viana
Version: 1.0.0
Author URI: https://amcom.com.br/
*/


// Excluir Categorias
add_action('init', 'wporg_custom_post_type');

// Controle de paginas permitidas
function wpse_user_can_edit( $user_id, $page_id ) {

    $eventos = array();

    global $pagenow;

    if($pagenow == 'post-new.php'){
        return true;
    }

    if($_GET['post_type'] == 'destaque'){
        //return true;
    }

    // Id da pagina corrente da lista
    $page = get_post( $page_id );
 	
    // pega as informacoes do usuario logado
    $user = wp_get_current_user($user_id);

    // usuarios que ficam foram da regra
	$allowed_roles = array( 'administrator' );
    
    if ( array_intersect( $allowed_roles, $user->roles ) ) {
        // se estiverem na lista todas as paginas sao permitidas para edicao
        return true;
    }

    //return true;

 
    // pega o grupo que o usuario pertence
    $variable = get_field('grupo', 'user_' . $user_id);    

    // verifica se esta liberado para editar todas paginas
	$todos = get_field('todas_as_paginas', $variable);

	if($todos && $todos != ''){
		return true;
	} else {	
        
        $permitidas = array();

        if($variable && $variable != ''){
            foreach($variable as $permitido){
                $permitidas[] = get_field('unidades', $permitido);
                $destaques = get_field('destaques_grupo', $permitido);
                if($destaques){
                    $permitidas[] = $destaques;
                }
            }
        }

        $unidades = array_flatten($permitidas);
        $unidades = array_unique($unidades);
        
        $args = array(
			'post_type' => 'post',
            'posts_per_page'    =>  -1,
            'meta_query' => array(
                'relation' => 'OR',
            ),
        );

        
        foreach ($unidades as $unidade){
            
            $args['meta_query'][] = array (
                'key' => 'localizacao',
                'value'     => $unidade,
            );

            $args['meta_query'][] = array (
                'key'		=> 'ceus_participantes_$_localizacao_serie',
                'compare'	=> '=',
                'value'		=> $unidade,
            );
            
        }

        $validPosts = array();
        $this_post = array();
        $id_pot = array();
        $i = 0;

        $my_query = new WP_Query($args);

        if($my_query->have_posts()) {
            while($i < $my_query->post_count) : 
                $post = $my_query->posts;

                if(!in_array($post[$i]->ID, $id_pot)){
                    $this_post['id'] = $post[$i]->ID;
                    $this_post['post_content'] = $post[$i]->post_content;
                    $this_post['post_title'] = $post[$i]->post_title;
                    $this_post['guid'] = $post[$i]->guid;

                    $id_pot[] = $post[$i]->ID;
                    array_push($validPosts, $this_post);

                }

                $post = '';
                $i++;

            endwhile;
        }
        

        $result = array_merge($unidades, $id_pot);

        // se a pagina corrente esta na lista de paginas do grupo libera para edicao
        if( in_array($page_id, $result)  ){
			return true;
		} else {
			return false;
		}

        
	} 
	
}


//
add_filter( 'map_meta_cap', function ( $caps, $cap, $user_id, $args ) {

    global $pagenow;

    if($pagenow == 'post-new.php'){
        return $caps;
    }

    if (( $pagenow == 'post-new.php' ) || ($pagenow == 'post.php')) {       
        // capability removida
        $to_filter = [ 'delete_post', 'edit_page', 'delete_page', 'edit_concurso', 'edit_unidade' ];
        
    } else {
        // capability removida
        $to_filter = [ 'edit_post','delete_post', 'edit_page', 'delete_page', 'edit_concurso', 'edit_unidade' ];
       
    }

    $user_meta = get_userdata($user_id); // Pega as informacoes do usuario
    $user_roles = $user_meta->roles; // Pega o tipo do usuario   

    if($user_roles != ''){
        if ( in_array( 'editor', $user_roles, true ) || in_array( 'contributor', $user_roles, true ) ) {
            // Verifica ações de upload de mídia via AJAX
            $upload_actions = array( 'query-attachments', 'upload-attachment', 'media-create-image-subsizes', 'get-attachment', 'save-attachment', 'save-attachment-compat', 'send-attachment-to-editor' );
            $is_upload_action = isset( $_REQUEST['action'] ) && in_array( $_REQUEST['action'], $upload_actions, true );
            
            // Verifica se é uma requisição relacionada a upload de mídia
            $is_media_upload = (
                $pagenow == 'upload.php' || 
                'admin-ajax.php' == $pagenow || 
                'async-upload.php' == $pagenow ||
                $pagenow == 'media-upload.php' ||
                $pagenow == 'media-new.php' ||
                $is_upload_action ||
                ( isset( $_FILES['async-upload'] ) && ! empty( $_FILES['async-upload'] ) )
            );
            
            // Para editores, permite anexar arquivos a posts durante upload de mídia
            // Remove 'edit_post' do filtro para que editores possam anexar arquivos a qualquer post
            if( $is_media_upload && $cap == 'edit_post' ) {
                // Permite que editores anexem arquivos a posts durante upload de mídia
                return $caps;
            }
            
            if( $is_media_upload ) {
                $to_filter = [ 'edit_page', 'delete_page', 'edit_concurso', 'edit_unidade' ];
            }
        }
    }
    
    //echo "<pre>";
    //print_r($cap);
    //echo "</pre>";

    // If the capability being filtered isn't of our interest, just return current value
    if ( ! in_array( $cap, $to_filter, true ) ) {
        return $caps;
    }

    //print_r($args);

    // First item in $args array should be page ID
    if ( ! $args || empty( $args[0] ) || ! wpse_user_can_edit( $user_id, $args[0] ) ) {
        // User is not allowed, let's tell that to WP
        return [ 'do_not_allow' ];
    }     
    
    $variable = get_field('grupo', 'user_' . $user_id);   
    // se não for de nenhum grupo
    if($variable == '' && !current_user_can( 'manage_options' )) {
        return [ 'do_not_allow' ];
    }
    // Otherwise just return current value
    return $caps;

}, 10, 4 );


// Post Type Grupos
function wporg_custom_post_type() {
    register_post_type('wporg_unidades',
        array(
            'labels'      => array(
                'name'          => __( 'Grupos', 'textdomain' ),
                'singular_name' => __( 'Grupo', 'textdomain' ),
            ),            
            'has_archive' => true,
			'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
            'publicly_queryable' => true,  // you should be able to query it
            'show_ui' => true,  // you should be able to edit it in wp-admin
            'exclude_from_search' => true,  // you should exclude it from search results
            'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
            'has_archive' => false,  // it shouldn't have archive page
            'rewrite' => false,  // it shouldn't have rewrite rules
			'capabilities' => array(
				'edit_post'          => 'remove_users',
				'read_post'          => 'remove_users',
				'delete_post'        => 'remove_users',
				'edit_posts'         => 'remove_users',
				'edit_others_posts'  => 'remove_users',
				'delete_posts'       => 'remove_users',
				'publish_posts'      => 'remove_users',
				'read_private_posts' => 'remove_users'
			),
        )
    );
}

add_action('init', 'wporg_custom_post_type');