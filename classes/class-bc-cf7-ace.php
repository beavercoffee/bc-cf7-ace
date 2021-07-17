<?php

if(!class_exists('BC_CF7_ACE')){
    final class BC_CF7_ACE {

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    	//
    	// private static
    	//
    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        private static $instance = null;

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    	//
    	// public static
    	//
    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        public static function get_instance($file = ''){
            if(null !== self::$instance){
                return self::$instance;
            }
            if('' === $file){
                wp_die(__('File doesn&#8217;t exist?'));
            }
            if(!is_file($file)){
                wp_die(sprintf(__('File &#8220;%s&#8221; doesn&#8217;t exist?'), $file));
            }
            self::$instance = new self($file);
            return self::$instance;
    	}

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    	//
    	// private
    	//
    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        private $file = '';

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    	private function __clone(){}

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    	private function __construct($file = ''){
            $this->file = $file;
            add_action('bc_cf7_loaded', [$this, 'bc_cf7_loaded']);
        }

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    	//
    	// public
    	//
    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        public function admin_enqueue_scripts($hook_suffix){
            if(false === strpos($hook_suffix, 'wpcf7')){
                return;
            }
            wp_enqueue_script('ace', 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ace.min.js', ['wpcf7-admin'], '1.4.12', true);
            wp_enqueue_script('ace-language-tools', 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.12/ext-language_tools.min.js', ['ace'], '1.4.12', true);
            $src = plugin_dir_url($this->file) . 'assets/bc-cf7-ace.css';
            $ver = filemtime(plugin_dir_path($this->file) . 'assets/bc-cf7-ace.css');
            wp_enqueue_style('bc-cf7-ace', $src, ['contact-form-7-admin'], $ver);
            $src = plugin_dir_url($this->file) . 'assets/bc-cf7-ace.js';
            $ver = filemtime(plugin_dir_path($this->file) . 'assets/bc-cf7-ace.js');
            wp_enqueue_script('bc-cf7-ace', $src, ['ace-language-tools'], $ver, true);
            wp_add_inline_script('bc-cf7-ace', 'bc_cf7_ace.init();');
        }

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

        public function bc_cf7_loaded(){
            add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
            bc_build_update_checker('https://github.com/beavercoffee/bc-cf7-ace', $this->file, 'bc-cf7-ace');
            do_action('bc_cf7_ace_loaded');
        }

    	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    }
}
