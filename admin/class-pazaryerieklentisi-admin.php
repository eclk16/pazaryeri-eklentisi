<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link        https://emrecolak.net
 * @since      1.0.0
 *
 * @package    Pazaryerieklentisi
 * @subpackage Pazaryerieklentisi/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pazaryerieklentisi
 * @subpackage Pazaryerieklentisi/admin
 * @author     Emre Çolak <pazaryerieklentisi@emrecolak.net>
 */
class Pazaryerieklentisi_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pazaryerieklentisi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pazaryerieklentisi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$validPages = array(
			'pazaryeri-eklentisi',
			'pazaryeri-eklentisi-kategori',
			'pazaryeri-eklentisi-ozellik',
			'pazaryeri-eklentisi-oznitelik',
			'pazaryeri-eklentisi-aktarim'
		);
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
		if(in_array($page,$validPages)){
			wp_enqueue_style( $this->plugin_name.'bootstrap', MY_PLUGIN_PATH . 'admin/css/bootstrap.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name.'datatable', MY_PLUGIN_PATH . 'admin/css/jquery.dataTables.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name.'sweetalert', MY_PLUGIN_PATH . 'admin/css/sweetalert.min.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name.'custom', MY_PLUGIN_PATH . 'admin/css/pazaryerieklentisi-admin.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->plugin_name.'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), $this->version, 'all' );

		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pazaryerieklentisi_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pazaryerieklentisi_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$validPages = array(
			'pazaryeri-eklentisi',
			'pazaryeri-eklentisi-kategori',
			'pazaryeri-eklentisi-ozellik',
			'pazaryeri-eklentisi-oznitelik',
			'pazaryeri-eklentisi-aktarim'
		);
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
		if(in_array($page,$validPages)){
			wp_enqueue_script( $this->plugin_name.'bootstrap', MY_PLUGIN_PATH . 'admin/js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name.'datatable', MY_PLUGIN_PATH . 'admin/js/jquery.dataTables.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name.'sweetalert', MY_PLUGIN_PATH . 'admin/js/sweetalert.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name.'select2', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', array( 'jquery' ), $this->version, false );
			wp_enqueue_script( $this->plugin_name.'custom', MY_PLUGIN_PATH . 'admin/js/pazaryerieklentisi-admin.js', array( 'jquery' ), $this->version, false );
		}
		
	}

	public function pazaryeri_eklentisi_menu(){
		if(isset($_POST['publish'])){
			foreach($_POST as $key => $value) update_option($key,$value);
			if($_POST[OPTION_PREFİX.'username'] == get_option(OPTION_PREFİX.'username') && $_POST[OPTION_PREFİX.'password'] == get_option(OPTION_PREFİX.'password') && $_POST[OPTION_PREFİX.'lisance_key'] == get_option(OPTION_PREFİX.'lisance_key')){
				delete_option(OPTION_PREFİX.'pazaryeriEklentisiToken');
				delete_option(OPTION_PREFİX.'pazaryeriEklentisiPlatforms');
			}
		}
		add_menu_page(
			__('PazaryeriEklentisi',WCMP_LANG),
			__('PazaryeriEklentisi',WCMP_LANG),
			'manage_options',
			'pazaryeri-eklentisi',
			array($this,'anasayfa'),
			'dashicons-store',
			'58'
		);
		if($this->getToken() && $this->getWcApiKey()){
			echo '<input type="hidden" value="'.$this->getToken().'" id="pzryr_TOKEN">';
			if(isset($_GET['platform'])) $platform = $_GET['platform'];
			else $platform = '';
			echo '<input type="hidden" value="'.$platform.'" id="pzryr_PLATFORM">';
			add_submenu_page(
				'pazaryeri-eklentisi',
				__('PazaryeriEklentisi Kategori',WCMP_LANG),
				'Aktarım',
				'manage_options',
				'pazaryeri-eklentisi-aktarim',
				array($this,'aktarim') 
			);
			add_submenu_page(
				'pazaryeri-eklentisi',
				__('PazaryeriEklentisi Kategori',WCMP_LANG),
				'Kategori Eşleştir',
				'manage_options',
				'pazaryeri-eklentisi-kategori',
				array($this,'kategori') 
			);
			add_submenu_page(
				'pazaryeri-eklentisi1',
				__('PazaryeriEklentisi Özellik',WCMP_LANG),
				'Özellik Eşleştir',
				'manage_options',
				'pazaryeri-eklentisi-ozellik',
				array($this,'ozellik') 
			);
			add_submenu_page(
				'pazaryeri-eklentisi1',
				__('PazaryeriEklentisi Öznitelik',WCMP_LANG),
				'Öznitelik Eşleştir',
				'manage_options',
				'pazaryeri-eklentisi-oznitelik',
				array($this,'oznitelik') 
			);
		}
	}

	public function getWcApiKey(){
        global $wpdb;
        $key = $wpdb->get_row( $wpdb->prepare("
            SELECT consumer_key, consumer_secret, permissions
            FROM {$wpdb->prefix}woocommerce_api_keys
            WHERE user_id = %d
        ", get_current_user_id()), ARRAY_A);
        if($key){
            return $key;
        }
        else{
			if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'pazaryeri-eklentisi'){
				return $this->apiCreate();
			}
            else{
				return false;
			}
        }
    }

	function apiCreate(){
        $store_url = get_site_url();
        if(strstr($store_url,'localhost')) $store_url = str_replace('//','',str_replace('http://','',str_replace('https://','',$store_url)));
        $endpoint = '/wc-auth/v1/authorize';
        $params = [
            'app_name' => 'Pazaryeri Eklentisi',
            'scope' => 'read_write',
            'user_id' => get_current_user_id(),
            'return_url' => 'https://novembros.co',
            'callback_url' => 'https://novembros.co'
        ];
        $query_string = http_build_query( $params );
        $response =$store_url . $endpoint . '?' . $query_string;
        if(strstr($store_url,'localhost')) $prot = '//';
        else $prot = '';
		$msg = 'Woocommerce Api Anahtarı Bulunamadı.<a target="_blank" href="'. $prot.''.$response.'">Oluşturmak İçin Tıklayın</a>';
		echo '<div style="border-left-color:crimson!important;margin:0!important;    margin-right: 20px!important;" id="message" class="updated notice text-danger is-dismissible"><p>'.$msg.'</p><button type="button" class="notice-dismiss"></button></div>';
    }

	public function getToken(){
		if(get_option(OPTION_PREFİX.'pazaryeriEklentisiToken')>0 && get_option(OPTION_PREFİX.'pazaryeriEklentisiToken') != false) {
            $time = explode('_time_',get_option(OPTION_PREFİX.'pazaryeriEklentisiToken'))[1];
            $fark = time() - $time;
            if($fark<1800) return explode('_time_',get_option(OPTION_PREFİX.'pazaryeriEklentisiToken'))[0];
            else{
                return $this->tokenAl();
            }
        }
        else{
            return $this->tokenAl();
        }
	}
	
	public function tokenAl(){
		try {
			$client = new \GuzzleHttp\Client();
			$login = $client->post(
				'https://pazaryerieklentisi.com/api/login',[
					'form_params' => [
						'email' => get_option(OPTION_PREFİX.'username'),
						'password' => get_option(OPTION_PREFİX.'password'),
						'lisans_key' => get_option(OPTION_PREFİX.'lisance_key')
					]
				]
			);
			if(json_decode($login->getBody(),true)['success'] == true){
				update_option(OPTION_PREFİX.'pazaryeriEklentisiToken',json_decode($login->getBody(),true)['data']['token'].'_time_'.time());
				update_option(OPTION_PREFİX.'pazaryeriEklentisiPlatforms',json_decode($login->getBody(),true)['data']['platforms']);
				return explode('_time_',get_option(OPTION_PREFİX.'pazaryeriEklentisiToken'))[0];
			}
			else return false;
			
		} catch (\Throwable $th) { return false; }
	}

	public function getName($params){
        global $request;
        $client = new \GuzzleHttp\Client();
        $token = getToken();
        $response = $client->get(
            'https://pazaryerieklentisi.com/api/categories/'.$params['id'].'?platform='.$params['platform'].'',[
                'headers' => [
                    'Authorization'     => 'Bearer '.$token
                    ]
            ]
        );
        if($response->getStatusCode() == '200'){
            return json_decode($response->getBody(),true)['data']['mesh'] != '' ? json_decode($response->getBody(),true)['data']['mesh'] : json_decode($response->getBody(),true)['data']['name'];
        }
        return [];
    }

	public function anasayfa(){
		$durum = $this->getToken() ? 'Aktif' : 'Pasif';
		ob_start();
		include_once(MY_PLUGIN_PATHH.'admin/partials/top.php');
		include_once(MY_PLUGIN_PATHH.'admin/partials/pazaryerieklentisi-admin-display.php');
		include_once(MY_PLUGIN_PATHH.'admin/partials/bottom.php');
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}

	public function aktarim(){
		ob_start();
		include_once(MY_PLUGIN_PATHH.'admin/partials/top.php');
		include_once(MY_PLUGIN_PATHH.'admin/partials/pazaryerieklentisi-admin-aktarim.php');
		include_once(MY_PLUGIN_PATHH.'admin/partials/bottom.php');
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}

	public function get_cats_hier( $cat,$kategoriler=[],$title='') {
		if( $title != '') $title = $title.'<b> > </b>';
		$terms = get_terms( 'product_cat', array('hide_empty' => false,'parent' => $cat)); 
		if( $terms ) :    
		foreach( $terms as $cat ) :
			$kategoriler[$cat->term_id] = $title.$cat->name;
			$kategoriler = $this->get_cats_hier( $cat->term_id ,$kategoriler,  $cat->name);
		endforeach;    
		endif;
	
		return $kategoriler;
	}

	public function kategori(){
		$durum = $this->getToken() ? 'Aktif' : 'Pasif';
		$platform = $_GET['platform']; 
		if(isset($_POST['guncelle_kategori'])){
			foreach($_POST as $name => $post){
				update_option($name,$post);
				update_option(OPTION_PREFİX.$platform.'_kategori_'.$post,str_replace(OPTION_PREFİX.'kategori_'.$platform.'_','',$name));
			}
		} 
		$terms = $this->get_cats_hier(0);
		ob_start();
		include_once(MY_PLUGIN_PATHH.'admin/partials/top.php');
		include_once(MY_PLUGIN_PATHH.'admin/partials/pazaryerieklentisi-admin-kategori.php');
		include_once(MY_PLUGIN_PATHH.'admin/partials/bottom.php');
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}

	public function ozellik(){
		ob_start();
		include_once(MY_PLUGIN_PATHH.'admin/partials/top.php');
		include_once(MY_PLUGIN_PATHH.'admin/partials/pazaryerieklentisi-admin-ozellik.php');
		include_once(MY_PLUGIN_PATHH.'admin/partials/bottom.php');
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}

	public function oznitelik(){
		ob_start();
		include_once(MY_PLUGIN_PATHH.'admin/partials/top.php');
		include_once(MY_PLUGIN_PATHH.'admin/partials/pazaryerieklentisi-admin-oznitelik.php');
		include_once(MY_PLUGIN_PATHH.'admin/partials/bottom.php');
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}





	public function register_meta_boxes(){
		// add_meta_box(
		// 	'pazaryeri-eklentisi-submit',
		// 	__('Güncelle/Kaydet', WCMP_LANG),
		// 	array( $this, 'sideMetaBoxHtml'),
		// 	'product',
		// 	'side',
		// 	'high'
		// );
	}

	public function sideMetaBoxHtml(){
		echo 'sadaskldjk sajdhjks adkdjkash jkdahsjkdk jashdjk ahsjkd ajkshd kjashjkd asjkhdjkas hjkd ajksd kjasdkjajks dajksdjkashklas';
	}

}
