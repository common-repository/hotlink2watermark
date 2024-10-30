<?php
/*
 Plugin Name: Hotlink2Watermark
 Plugin URI: http://www.tranchesdunet.com/hotlink2watermark
 Description: Add a watermark to all hotlinked image from your blog, on the fly!
 Version: 0.3.2
 Author: <a href="http://www.jmbianca.net/">Jean-Marc BIANCA</a>
 Author URI: http://www.jmbianca.net

 === FEATURES ===
 * Add a watermark to all hotlinked image from your blog, on the fly!
 * All generated pictures are buffered in a directory for optimised use
 * Choice of watermark: can be a text or a picture
 * .htaccess update if needed
 * save of all the referers (website which steal your bandwidh) on a csv file
 * create/delete the buffer directory on install/uninstall of the plugin, for non-wasted disk space

 === RELEASE NOTES ===
 2012-03-26 - First Release
 2012-04-10 - v0.1.1 : default language is english, now
 2012-05-25 - v0.1.2 : bug correction (division by zero)
 2012-06-27 - v0.2 : GD Lib check, font name correction, date & time in referer.csv...
 2012-06-27 - v0.2.1 : the ucase font file name correction is not applied by SVN, must change it in the code instead!
 2013-02-25 - v0.3 : Fixes some antialiasaing issue, and the header for images already in cache+add some cool features (text color, etc.)
 2013-02-26 - v0.3.1 : Fix a little error on $h2w->hex2rgb($h2w_textcolor);
 2013-02-26 - v0.3.2 : Fix the version number
 === TODO ===
 - faire un mode debug
 - faire un log des bugs rencontrés
 - faire une limite basse taille des fichiers et ne pas créer de "copie" si en dessous
 - faire une limite haute poids de fichier et renvoyer un fichier generique si au dessus
 - faire une version payante ?
 - demander les urls des sites pour mettre sur la page du plugin
 - faire une compatibilité pour wordpress multi-site
 */

define("HOTLINK2WATERMARK_VERSION", "v0.3.2");

if (!class_exists("hotlink2watermark"))
{
  class hotlink2watermark
  {
    var $adminOptionName = 'hotlink2watermarkAdminOptions';
    var $h2w_marker = "Hotlink2Watermark";
    var $cachedir = "";
    var $htaccessContent = "";
    var $tFontFamily = array();
    
    function hotlink2watermark()
    {
      register_activation_hook(__FILE__, array(&$this, 'h2w_install'));
      register_deactivation_hook(__FILE__, array(&$this, 'h2w_uninstall'));
      load_plugin_textdomain('hotlink2watermark', null, '/hotlink2watermark/lang/');
      global $cachedir;
      $cachedir = WP_PLUGIN_DIR."/hotlink2watermark/cache";
      global $htaccessContent;
      global $tFontFamily;
      $tFontFamily = array("ARIAL","COMIC","TIMES","VERDANA");
      $current_url_pattern = get_bloginfo('url');
      $current_url_pattern = preg_replace("[http:|https:]","https?:", $current_url_pattern);
      $current_url_pattern = str_replace("//www.","//(www.)?",$current_url_pattern);
      $current_url_pattern = str_replace(".","\.",$current_url_pattern);
      $htaccessContent = "RewriteEngine On
RewriteBase /
RewriteCond %{HTTP_REFERER} !^$
RewriteCond %{HTTP_REFERER} !^".$current_url_pattern."/.*$ [NC]
RewriteRule (.*)\.(gif|jpe?g|png)$ /wp-content/plugins/hotlink2watermark/h2w_target.php?pic=$1.$2 [L,NC]";
    }
    
    function init()
    {
      $this->getAdminOptions();
    }
    
    function getAdminOptions()
    {
      $hotlink2watermarkAdminOptions = array("h2w_text" => __("Protected by Hotlink2Watermark", "hotlink2watermark"),
                                             "show_credits" => false,
                                             "h2w_pos" => 9,
                                             "h2w_use_cache" => true,
                                             "h2w_size" => 12,
                                             "h2w_angle" => 0,
                                             "h2w_opacity" => 100,
                                             "save_referer" => 0,
                                             "h2w_font" => "VERDANA",
                                             "h2w_textcolor" => "#000000",
                                             "h2w_shadowcolor" => "#ffffff", 
                                             "h2w_shadow" => true);
      
      $hotlink2watermarkOptions = get_option($this->adminOptionName);
      if(!empty($hotlink2watermarkOptions))
      {
        foreach($hotlink2watermarkOptions as $key => $option)
        {
          $hotlink2watermarkAdminOptions[$key] = $option;
        }
        update_option($this->adminOptionName, $hotlink2watermarkAdminOptions);
      }
      return $hotlink2watermarkAdminOptions;
    }
  
    function printAdminPage()
    {
      //echo get_option('plugin_error');
      $options = $this->getAdminOptions();
      global $htaccessContent;
      global $tFontFamily;
      if(isset($_POST['updatehtaccess']))//mettre a jour le .htaccess
      {
        $home_path = get_home_path();
        if(file_exists($home_path.'.htaccess'))
        {
          $rules = explode( "\n", $htaccessContent );
          insert_with_markers($home_path.'.htaccess', $this->h2w_marker, $rules);
        }
      }
      
      if(isset($_POST['update_hotlink2watermarkSettings']))
      {
        if(isset($_POST['show_credits']))
        {
          $options['show_credits'] = $_POST['show_credits'];
        }else{
          $options['show_credits'] = 0;
        }
        
        if(isset($_POST['h2w_text']))
        {
          $options['h2w_text'] = $_POST['h2w_text'];
        }
        
        if(isset($_POST['h2w_pos']))
        {
          $options['h2w_pos'] = $_POST['h2w_pos'];
        }
        
        if(isset($_POST['h2w_use_cache']))
        {
          $options['h2w_use_cache'] = $_POST['h2w_use_cache'];
        }else{
          $options['h2w_use_cache'] = 0;
        }
        
        if(isset($_POST['h2w_img']))
        {
          $options['h2w_img'] = $_POST['h2w_img'];
        }
        
        if(isset($_POST['h2w_size']))
        {
          $options['h2w_size'] = $_POST['h2w_size'];
        }
        
        if(isset($_POST['h2w_angle']))
        {
          $options['h2w_angle'] = $_POST['h2w_angle'];
        }
        
        if(isset($_POST['h2w_opacity']))
        {
          $options['h2w_opacity'] = $_POST['h2w_opacity'];
        }
        
        if(isset($_POST['save_referer']))
        {
          $options['save_referer'] = $_POST['save_referer'];
        }else{
          $options['save_referer'] = 0;
        }
        
        if(isset($_POST['h2w_font']))
        {
          $options['h2w_font'] = $_POST['h2w_font'];
        }
        
        if(isset($_POST['tcolor']))
        {
          $options['h2w_textcolor'] = $_POST['tcolor'];
        }
        
        if(isset($_POST['scolor']))
        {
          $options['h2w_shadowcolor'] = $_POST['scolor'];
        }
        
        if(isset($_POST['h2w_shadow']))
        {
          $options['h2w_shadow'] = $_POST['h2w_shadow'];
        }else{
          $options['h2w_shadow'] = 0;
        }
        
        update_option($this->adminOptionName, $options);
        print '<div class="updated"><p><strong>';
        _e("Settings updated","hotlink2watermark");
        print '</strong></p></div>';
      }
      include('admin_settings.php');
    }
    
    function calculateTextBox($text,$fontFile,$fontSize,$fontAngle) 
    { 
      /************ 
      simple function that calculates the *exact* bounding box (single pixel precision). 
      The function returns an associative array with these keys: 
      left, top:  coordinates you will pass to imagettftext 
      width, height: dimension of the image you have to create 
      *************/ 
      $rect = imagettfbbox($fontSize,$fontAngle,$fontFile,$text); 
      $minX = min(array($rect[0],$rect[2],$rect[4],$rect[6])); 
      $maxX = max(array($rect[0],$rect[2],$rect[4],$rect[6])); 
      $minY = min(array($rect[1],$rect[3],$rect[5],$rect[7])); 
      $maxY = max(array($rect[1],$rect[3],$rect[5],$rect[7])); 
      
      return array( 
       "left"   => abs($minX) - 1, 
       "top"    => abs($minY) - 1, 
       "width"  => $maxX - $minX, 
       "height" => $maxY - $minY, 
       "box"    => $rect 
      ); 
    }
  
    function getHtAccessSection()
    {
      $home_path = get_home_path();
      $htaccesscontent = __("empty","hotlink2watermark");
      if(file_exists($home_path.'.htaccess'))
      {
        $htaccesscontent = extract_from_markers($home_path.'.htaccess', $this->h2w_marker);
      }
      return $htaccesscontent;
    }
    
    function hex2rgb($hex) 
    {
      $hex = str_replace("#", "", $hex);
      
      if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
      } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
      }
      $rgb = array($r, $g, $b);
      //return implode(",", $rgb); // returns the rgb values separated by commas
      return $rgb; // returns an array with the rgb values
    }
    
    function cacheExist()
    {
      global $cachedir;
      if(!file_exists($cachedir))
      {
        return false;
      }else{
        return true;
      }
    }
    
    function cacheWritable()
    {
      global $cachedir;
      if($this->cacheExist())
      {
        if(!is_writable($cachedir))
        {
          return false;
        }else{
          return true;
        }
      }else{
        return false;
      }
    }
    
    function h2w_install()
    {
      global $cachedir;
      if(!$this->cacheExist())
      {
        mkdir($cachedir, 0777);
      }
      if($this->cacheExist())
      {
        if(!$this->cacheWritable)
        {
          chmod($cachedir, 0777);
        }
      }
    }
    
    function h2w_uninstall()
    {
      //effacer le repertoire de cache
      global $cachedir;
      if(file_exists($cachedir))
      {
        $dir = opendir($cachedir);
        while(($file = readdir($dir)) !== false)
        {
          $path = $cachedir."/".$file;
          if($file != ".." && $file != "." && !is_dir($file))
          {
            unlink($path);
          }
        }
        closedir($dir);
        rmdir($cachedir);
      }
      //effacer les options
      delete_option($this->adminOptionsName);
      
      //effacer les regles dans le .htaccess
      $home_path = get_home_path();
      if(file_exists($home_path.'.htaccess'))
      {
        insert_with_markers($home_path.'.htaccess', $this->h2w_marker, array());
      }
    }

    function isGD()
    {
      if (extension_loaded('gd') && function_exists('gd_info'))
      {
        return true;
      }else{
        return false;
      }
    }
    
  }
}

if(class_exists("hotlink2watermark"))
{
  $inst_hotlink2watermark = new hotlink2watermark();
}

if(!function_exists("hotlink2watermark_ap"))
{
  function hotlink2watermark_ap()
  {
    global $inst_hotlink2watermark;
    if(!isset($inst_hotlink2watermark))
    {
      return;
    }
    if(function_exists("add_options_page"))
    {
      add_options_page("Hotlink2Watermark", "Hotlink2Watermark", 9, basename(__FILE__), array(&$inst_hotlink2watermark, 'printAdminPage'));
    }
  }
}
add_action('admin_menu', 'hotlink2watermark_ap');

add_action('init', 'ilc_farbtastic_script');
function ilc_farbtastic_script() {
  wp_enqueue_style( 'farbtastic' );
  wp_enqueue_script( 'farbtastic' );
}