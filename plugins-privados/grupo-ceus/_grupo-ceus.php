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
    if (( $pagenow == 'post-new.php' ) || ($pagenow == 'post.php')) {       
        // capability atribuida
        $to_filter = [ 'delete_post', 'edit_page', 'delete_page', 'edit_concurso', 'edit_unidade' ];
        
    } else {
        // capability atribuida
        $to_filter = [ 'edit_post','delete_post', 'edit_page', 'delete_page', 'edit_concurso', 'edit_unidade' ];
       
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
            'public'      => true,
            'has_archive' => true,
			'rewrite'     => array( 'slug' => 'unidades' ), // my custom slug
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