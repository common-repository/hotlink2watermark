<?php 
//error_reporting(E_ALL);
$show_credits = $options['show_credits'];
$h2w_text = $options['h2w_text'];
$h2w_pos = $options['h2w_pos'];
$h2w_use_cache = $options['h2w_use_cache'];
$h2w_img = $options['h2w_img'];
$h2w_size = $options['h2w_size'];
$h2w_angle = $options['h2w_angle'];
$h2w_opacity = $options['h2w_opacity'];
$save_referer = $options['save_referer'];
$h2w_font = $options['h2w_font'];
$h2w_textcolor = $options['h2w_textcolor'];
$h2w_shadowcolor = $options['h2w_shadowcolor'];
$h2w_shadow = $options['h2w_shadow'];
?>
<div class=wrap>
  <div class="icon32" id="icon-edit">
    <br />
  </div>
  <h2>Hotlink2Watermark <?php echo HOTLINK2WATERMARK_VERSION ?></h2>
  
  <?php 
  echo "<h3>".__("Tranform your hotlinked photos to ads!","hotlink2watermark")."</h3>";
  _e("<b>Hotlink2Watermark</b> is a plugin which allow you to display a watermark within each images being 'hotlinked' from your website.<br />", "hotlink2watermark");
  _e("An hotlinked image is an image hosted on your website but displayed on another website by an unscrupulous webmaster<br />", "hotlink2watermark");
  _e("This overload the bandwith of your website without bringing any visitor.<br />", "hotlink2watermark");
  _e("This plugin transform this inconvenience into advantage by allowing you to display a link to your image on these image.<br /><br />", "hotlink2watermark");
  _e("This plugin does not prevent the steal of your images.", "hotlink2watermark");
  echo "<br />";
  _e("To know if you have any hotlinked image on other websites, click the link below:","hotlink2watermark");
  echo "<br />";
  $blog_url = get_bloginfo('url');
  $blog_url = str_replace("http://","",$blog_url);
  $blog_url = str_replace("https://","",$blog_url);
  $linkGoogleImage = "https://www.google.fr/search?tbm=isch&q=inurl%3A".$blog_url."+-site%3A".$blog_url."&oq=inurl%3A".$blog_url."+-site%3A".$blog_url;
  echo "<br /><a href='".$linkGoogleImage."' target='_blank'>".$linkGoogleImage."</a>";
  ?>
  <br /> <br />
  
    <div class="metabox-holder has-right-sidebar">
      <div class="inner-sidebar">
        <div class="meta-box-sortables ui-sortable">
          <div class="postbox">
            <h3 class="hndle">
              <?php _e('Info & Support', 'hotlink2watermark') ?>
            </h3>
              <div class="inside">
                <?php 
                _e("<b>Hotlink2Watermark</b> is a plugin developped by <a href='http://www.jmbianca.net/'>Jean-Marc BIANCA</a>", "hotlink2watermark");
                ?>
                <br />
                <a href="http://www.tranchesdunet.com/hotlink2watermark"><?php _e("Support", "hotlink2watermark")?></a>
                <br /><br />
                <?php 
                _e("This plugin has been developped for free. If, by chance, you find it useful, you can thanks me with the Paypal button below ;)","hotlink2watermark");
                ?>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="RZRLGED6KXV9W">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>

                <?php /*echo "<p><label><input type='checkbox' value='1' name='show_credits'";
                      if($show_credits)
                      {
                        echo " checked='checked'";
                      }
                      echo " /> ".__("Afficher un lien ...", "hotlink2watermark");*/?>
              
              </div>
          </div>
        </div>
      </div>
      
      <div class="inner-sidebar">
        <div class="meta-box-sortables ui-sortable">
          <div class="postbox">
            <h3 class="hndle">
              <?php _e('Others plugins', 'hotlink2watermark') ?>
            </h3>
            <div class="inside">
              <?php 
              _e("<strong>Discover my others Wordpress Plugins:</strong><br /><br />
                - <a href='http://wordpress.org/extend/plugins/sidenails/'><strong>SideNail:</strong></a> SideNails allow you to display a list of the last posts with a thumbnail, in a widget. For this, SideNails use the images linked to your post (thumbnail, featured image, NextGen Gallery, etc.)<br /><br />
                - <a href='http://wordpress.org/extend/plugins/my-trending-post/'><strong>My Trending Post:</strong></a> Allow you to search for trending topics on Twitter, and add a tweet with a content-related link to your blog<br />", 'hotlink2watermark');
              ?>
            </div>
          </div>
        </div>
      </div>
      
      <div class="inner-sidebar">
        <div class="meta-box-sortables ui-sortable">
          <div class="postbox">
            <h3 class="hndle">
              <?php _e('About Me', 'hotlink2watermark') ?>
            </h3>
            <div class="inside">
              <a href="https://twitter.com/tranchesdunet" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @tranchesdunet</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
              <br />
              <iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.facebook.com%2Ftranchesdunet&amp;send=false&amp;layout=standard&amp;width=200&amp;show_faces=true&amp;font=verdana&amp;colorscheme=light&amp;action=like&amp;height=100" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:100px;" allowTransparency="true"></iframe>
              <br />
              <a data-pin-do="buttonFollow" href="http://pinterest.com/tranchesdunet/">Follow me on Pinterest</a>
              <br /><br />
              <div class="g-plus" data-width="200" data-height="69" data-href="https://plus.google.com/115022082539464278423" data-rel="author"></div>

            </div>
          </div>
        </div>
      </div>
      <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
      <div id="post-body-content">
        <div id="normal-sortables"
          class="meta-box-sortables ui-sortables">
          <div class="postbox">
            <h3 class="hndle">
            <?php _e('Settings', 'hotlink2watermark') ?>
            </h3>
            <div class="inside">
            <?php 
              _e("If a watermark image is defined, it will be used, else the watermark text will be used","hotlink2watermark");
              //choix du watermark
              if(function_exists("ImageTTFBBox"))//on affiche cette possibilité seulement si la librairie Freetype est accessible
              {
                echo "<h2>".__("Watermark text settings:","hotlink2watermark")."</h2>";
                echo __("Text: ","hotlink2watermark")."<input type='text' value='".$h2w_text."' name='h2w_text' size=30 />";
                echo "<br /><br />";
                //font family
                echo __("Font family: ","hotlink2watermark");
                echo "<select name='h2w_font'>";
                foreach($tFontFamily as $font)
                {
                  echo "<option value='".$font."'".selected($font, $h2w_font, false).">".$font."</option>";
                }
                echo "</select>";
                echo "<br /><br />";
                //size
                echo __("Font size: ","hotlink2watermark");
                echo "<select name='h2w_size'>";
                for($i=10;$i<41;$i+=2)
                {
                  echo "<option value='".$i."'".selected($i, $h2w_size, false).">".$i."</option>";
                }
                echo "</select>".__(" in pixel","hotlink2watermark");
                echo "<br />";
                _e("<b>Be careful:</b> the watermark must be smaller than your image to appears on it.","hotlink2watermark");
                echo "<br /><br />";
                
                //text color
                echo '<label for="color">'.__("Text color: ","hotlink2watermark").'<input type="text" id="tcolor" name="tcolor" value="'.$h2w_textcolor.'" /></label>';
                echo '<div id="textcolorpicker"></div>';
                echo "<br /><br />";
                //shadow
                _e("Shadow: ", "hotlink2watermark");
                //show shadow
                _e("Show ", "hotlink2watermark");
                echo " <input type='checkbox' name='h2w_shadow' id='h2w_shadow' value='1' ".checked(1, $h2w_shadow, false)." />";
                
                //shadow color
                echo '<label for="color">'.__(" Color: ","hotlink2watermark").'<input type="text" id="scolor" name="scolor" value="'.$h2w_shadowcolor.'" /></label>';
                echo '<div id="shadowcolorpicker"></div>';
                
                echo "<br /><br />";
                //angle
                echo __("Text angle: ","hotlink2watermark");
                echo "<select name='h2w_angle'>";
                for($i=00;$i<91;$i+=5)
                {
                  echo "<option value='".$i."'".selected($i, $h2w_angle, false).">".$i."</option>";
                }
                echo "</select>".__(" in degrees","hotlink2watermark");
                echo "<br /><br />";
              }
              echo "<h2>".__("Watermark image settings:","hotlink2watermark")."</h2>";
              echo __("Image url (absolute Url, with 'http://' before):","hotlink2watermark")."<input type='text' value='".$h2w_img."' name='h2w_img' size=100 />";
              echo "<br />";
              _e("<b>Be careful:</b> the watermark must be smaller than your image to appears on it.","hotlink2watermark");
              echo "<br /><br />";
              
              echo "<h2>".__("General settings:","hotlink2watermark")."</h2>";
              //opacité
              echo __("Watermark opacity: ","hotlink2watermark");
              echo "<select name='h2w_opacity'>";
              for($i=00;$i<101;$i+=10)
              {
                echo "<option value='".$i."'".selected($i, $h2w_opacity, false).">".$i."</option>";
              }
              echo "</select>".__(" in percent (0 = invisible)","hotlink2watermark");
              echo "<br /><br />";
              
              //position du watermark
              _e("Watermark position: ","hotlink2watermark");
              echo "<br />";
              echo "<input type='radio' name='h2w_pos' value=1 ".checked(1, $h2w_pos, false)."/>";
              echo "<input type='radio' name='h2w_pos' value=2 ".checked(2, $h2w_pos, false)."/>";
              echo "<input type='radio' name='h2w_pos' value=3 ".checked(3, $h2w_pos, false)."/>";
              echo "<br />";
              echo "<input type='radio' name='h2w_pos' value=4 ".checked(4, $h2w_pos, false)."/>";
              echo "<input type='radio' name='h2w_pos' value=5 ".checked(5, $h2w_pos, false)."/>";
              echo "<input type='radio' name='h2w_pos' value=6 ".checked(6, $h2w_pos, false)."/>";
              echo "<br />";
              echo "<input type='radio' name='h2w_pos' value=7 ".checked(7, $h2w_pos, false)."/>";
              echo "<input type='radio' name='h2w_pos' value=8 ".checked(8, $h2w_pos, false)."/>";
              echo "<input type='radio' name='h2w_pos' value=9 ".checked(9, $h2w_pos, false)."/>";
              echo "<br /><br />";
              
              if(!$this->cacheExist() || !$this->cacheWritable())
              {
                echo "<div class='error'>";
                if(!$this->cacheExist())
                {
                  _e("<b>Attention</b> : the cache directory cannot be created. You must manually create a directory called 'cache' in this plugin directory, with all read and write permissions.<br />","hotlink2watermark");
                }
                if($this->cacheExist() && !$this->cacheWritable())
                {
                  _e("<b>Attention</b> : the cache directory can't be written. You must change the 'cache' directory permission, in order to allow the plugin to work.","hotlink2watermark");
                }
                echo "</div>";
              }
              
              //verification de la presence de la GD Lib
              if(!$this->isGD())
              {
                echo "<div class='error'>";
                _e("<b>Attention</b> : the GD Lib is not enable on your server. You MUST enable it in order to use this plugin. Contact your administrator is needed.","hotlink2watermark");
                echo "</div>";
              }
              
              //utilisation du cache
              /*_e("Le cache permet de ne pas générer l'image à chaque appel. Cela soulage le serveur. Les images sont générées uniquement si elles n'existent pas deja dans le cache (pour une image & un watermark donné)", "hotlink2watermark");
              echo "<br />";
              echo "<p><label><input type='checkbox' value='1' name='h2w_use_cache' /> ".__("Utiliser le cache (recommandé)", "hotlink2watermark");
              */
              echo "<h2>".__("Referer's save:","hotlink2watermark")."</h2>";
              _e("The referer's save allow you to know from which website your hotlinked images are called. This can be useful to, e.g., add a rules in the .htaccess file to avoid the watermarking of your image for specific website (e.g. Facebook). The referer's save is done in a CSV file, which can be opened in Excel.","hotlink2watermark");
              echo "<br /><br />";
              echo "<input type='checkbox' name='save_referer' value='1' ".checked(1, $save_referer, false)." /> ".__("Save the referers","hotlink2watermark");
              echo "<br /><br />";
              if($f = fopen(WP_PLUGIN_DIR."/hotlink2watermark/referer.csv",'a+b'))
              {
                echo __("Open file: ","hotlink2watermark")."<a href='".WP_PLUGIN_URL."/hotlink2watermark/referer.csv' target='_blank'>referer.csv</a>";
              }else{
                echo __("The file cannot be found!","hotlink2watermark");
                if($save_referer)
                {
                  echo "<div class='error'>".__("<b>Attention</b> : the 'referer.csv' cannot be created. <br />You must modify this plugin's directory writing permissions or create an empty file called 'referer.csv' in this plugin's directory, with all writing permissions sets.","hotlink2watermark")."</div>";
                }
              }
              if($f)
              {
                fclose($f);
              }
              //modification du .htaccess
              echo "<h2>".__(".htaccess settings:","hotlink2watermark")."</h2>";
              $htaccesscontent = $this->getHtAccessSection();
              if($htaccesscontent && is_array($htaccesscontent) && count($htaccesscontent) > 0)
              {
                echo "<div style='width:500px; max-height:400px; overflow: auto; background: #fff; padding: 5px; line-height: 12px;'>";
                echo "<pre>";
                foreach($htaccesscontent as $line)
                {
                  echo $line."<br />";
                }
                echo "</pre>";
                echo "</div>";
              }else{
                _e("Settings not found in your .htaccess","hotlink2watermark");
                echo "<div class='error'>".__("<b>Attention</b> : the plugin's settings cannot be found in your .htaccess file. You must update it by clicking on the 'Update the .htaccess' button","hotlink2watermark")."</div>";
                echo "<br /><br /><div class='submit' style='float:none;'><input type='submit' value='".__("Update the .htaccess","hotlink2watermark")."' name='updatehtaccess' /></div>";
                echo "<br />";
              }
              
              _e("To add another rule (e.g. display normally your images on Google Image)","hotlink2watermark");
              echo "<br />";
              _e("Add this line between the last and the penultimate line of the section below, in your .htaccess file","hotlink2watermark");
              echo "<br />";
              echo "<pre>RewriteCond %{HTTP_REFERER} !^http://images.google..*(/)?.*$ [NC]</pre>";
              
            ?>

            </div>
          </div>

          <div class="submit">
            <input class="button-primary action" type="submit" name="update_hotlink2watermarkSettings"
              value="<?php _e('Update', 'hotlink2watermark') ?>" />
          </div>
        </div>
      </div>
      </form>
    </div>
  
</div>
<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();

  
  jQuery(document).ready(function() {
    jQuery('#textcolorpicker').hide();
    jQuery('#textcolorpicker').farbtastic("#tcolor");
    jQuery("#tcolor").click(function(){jQuery('#textcolorpicker').slideToggle();});
    jQuery('#shadowcolorpicker').hide();
    jQuery('#shadowcolorpicker').farbtastic("#scolor");
    jQuery("#scolor").click(function(){jQuery('#shadowcolorpicker').slideToggle();});
  });
 

</script>