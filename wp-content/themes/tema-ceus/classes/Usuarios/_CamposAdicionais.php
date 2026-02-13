<?php

namespace Classes\Usuarios;


class CamposAdicionais
{

	public function __construct()
	{
		// Add e Salvando o campo personalizado
		add_action('show_user_profile', array($this, 'fb_add_custom_user_profile_fields'));
		add_action('edit_user_profile', array($this, 'fb_add_custom_user_profile_fields'));
		add_action('personal_options_update', array($this, 'fb_save_custom_user_profile_fields'));
		add_action('edit_user_profile_update', array($this, 'fb_save_custom_user_profile_fields'));

		add_filter('manage_users_columns', array($this, 'exibe_cols'));
		add_filter('manage_users_custom_column', array($this, 'cols_content'), 10, 3);
		add_filter('manage_users_sortable_columns', array($this, 'cols_sort'));
		//add_filter('request', array($this, 'orderby'));

		//add_action('restrict_manage_users', array($this, 'my_restrict_manage_posts'));

		//$this->exibeTodosUsuarios();

		add_action( 'restrict_manage_users', array($this,'add_setor_filter' ));

		add_filter( 'pre_get_users', array($this,'filter_users_by_setor' ));


	}

	public function exibeTodosUsuarios(){
		global $wpdb;
		$wp_user_search = $wpdb->get_results("SELECT ID, display_name FROM $wpdb->users ORDER BY ID");
		$todos_usuarios_id = [];

		foreach ( $wp_user_search as $userid ) {
			$user_id       = (int) $userid->ID;
			$user_login    = stripslashes($userid->user_login);
			$display_name  = stripslashes($userid->display_name);
			$todos_usuarios_id[] = $user_id;
		}
		return $todos_usuarios_id;

	}

	public function getUsersSetorUnique($users){

		$setor_unico = [];
		foreach ($users as $user_id){
			$setor_unico[] = get_user_meta($user_id, 'setor', true);
		}

		return array_unique($setor_unico, SORT_REGULAR);


	}

	function add_setor_filter() {

		if ( isset( $_GET[ 'setor' ]) && $_GET[ 'setor' ][0] !== '0') {
			$section = $_GET[ 'setor' ];
			$section = !empty( $section[ 0 ] ) ? $section[ 0 ] : $section[ 1 ];
		} else {
			$section = -1;
		}

		$users = $this->exibeTodosUsuarios();

		$setores_unicos = $this->getUsersSetorUnique($users);

		echo ' <select name="setor[]" style="float:none;">';
		echo'<option value="0" selected="selected">Todos os setores</option>';

		foreach ($setores_unicos as $setor){

			$selected = $setor == $section ? ' selected="selected"' : '';

			if ($setor) {
				echo '<option value="' . $setor . '"' . $selected . '>' . $setor . '</option>';
			}
		}
		echo '</select>';
		echo '<input type="submit" class="button" value="Filtrar">';
	}


	function filter_users_by_setor( $query ) {
		global $pagenow;

		if ( is_admin() &&
			'users.php' == $pagenow &&
			isset( $_GET[ 'setor' ] ) &&
			is_array( $_GET[ 'setor' ] )
		) {
			$section = $_GET[ 'setor' ];

			if ($section[ 0 ] !== "0") {

				$section = !empty($section[0]) ? $section[0] : $section[1];
				$meta_query = array(
					array(
						'key' => 'setor',
						'value' => $section
					)
				);
				$query->set('meta_key', 'setor');
				$query->set('meta_query', $meta_query);
			}
		}
	}


	// Funções necessária para exibir o filtro de categorias nos produtos no Dashboard
	public function my_restrict_manage_posts(){

		global $typenow;
		$taxonomy = $this->taxonomy; // taxonomia personalizada = categorias
		//if ($typenow == $this->cptSlug) { // custom post type = link
		$filters = array($taxonomy);

		foreach ($filters as $tax_slug) {
			//$tax_obj = get_taxonomy($tax_slug);
			//$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Ver todas as categorias</option>";
			foreach ($terms as $term) {
				echo '<option value=' . $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '', '>' . $term->name . ' (' . $term->count . ')</option>';
			}
			echo "</select>";
		}
		//}
	}

	function orderby($vars)
	{
		if (is_admin()) {
			if (isset($vars['orderby']) && $vars['orderby'] == 'setor') {
				$vars['orderby'] = 'setor';
			}


		}
		return $vars;
	}

	public function cols_sort($cols)
	{
		$cols['setor'] = 'setor';
		return $cols;
	}


	public function fb_add_custom_user_profile_fields($user)
	{
		?>
        <h3><?php _e('Informações adicionais dos usuários', 'your_textdomain'); ?></h3>

        <table class="form-table">
            <tr>
                <th>
                    <label for="setor"><?php _e('Setor', 'your_textdomain'); ?>
                    </label></th>
                <td>
                    <input type="text" name="setor" id="setor"
                           value="<?php echo esc_attr(get_the_author_meta('setor', $user->ID)); ?>"
                           class="regular-text"/><br/>
                    <span class="description"><?php _e('Por favor entre com o setor do usuário.', 'your_textdomain'); ?></span>
                </td>
            </tr>
        </table>
	<?php }

	public function fb_save_custom_user_profile_fields($user_id)
	{

		if (!current_user_can('edit_user', $user_id))
			return FALSE;

		update_user_meta($user_id, 'setor', $_POST['setor']);
	}

	//Exibindo as colunas no Dashboard
	public function exibe_cols($cols)
	{
		$cols['setor'] = 'Setor';
		return $cols;
	}

	//Exibindo as informações correspondentes de cada coluna
	public function cols_content($val, $column_name, $user_id)
	{
		$user_setor = get_user_meta($user_id, 'setor', true);

		switch ($column_name) {
			case 'setor' :
				if ($user_setor){
					return "<p><strong>$user_setor</strong></p>";
				}else{
					return "<p>Nenhum Setor Cadastrado</p>";
				}
			default:
		}

	}

}

new CamposAdicionais();