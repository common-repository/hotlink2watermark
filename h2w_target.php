<?php
$root = dirname(dirname(dirname(dirname(__FILE__))));

if (file_exists($root.'/wp-load.php'))
{
	require_once($root.'/wp-load.php');
}
$image = $_GET['pic'];
//var_dump($image);
/*if(!preg_match('/http:\/\//', $image))
{
  $image = get_bloginfo('url')."/".$image;
}*/
$image = ABSPATH.$image;

//var_dump($image);
$h2w = new hotlink2watermark();
$options = get_option($h2w->adminOptionName);
$h2w_text = $options['h2w_text'];
$h2w_img = $options['h2w_img'];
$h2w_pos = $options['h2w_pos'];
$h2w_size = $options['h2w_size'];
$h2w_angle = $options['h2w_angle'];
$h2w_opacity = $options['h2w_opacity'];
$h2w_save_referer = $options['save_referer'];
$h2w_font = "fonts/".$options['h2w_font'].".TTF";
$h2w_textcolor = $options['h2w_textcolor'];
$h2w_shadowcolor = $options['h2w_shadowcolor'];
$h2w_shadow = $options['h2w_shadow'];
//$font = "fonts/VERDANA.TTF";
//calcul du nom unique pour le cache
$md5_name = md5($image.$h2w_text.$h2w_img.$h2w_pos.$h2w_size.$h2w_angle.$h2w_opacity.$h2w_font.$h2w_textcolor.$h2w_shadowcolor.$h2w_shadow).".jpg";
//var_dump($md5_name);exit;

if($h2w_save_referer)
{
  $referer = $_SERVER['HTTP_REFERER'];
  $redirecturl = $_SERVER['REDIRECT_URL'];
  $date = date("Y-m-d,H:i:s");
  $reffile = fopen(WP_PLUGIN_DIR."/hotlink2watermark/referer.csv",'ab');
  $csvfield = array($referer, $redirecturl, $date);
  //fwrite($reffile, $referer."|".$redirecturl."|".$date."\r\n");
  fputcsv($reffile, $csvfield);
  fclose($reffile);
}

if(!file_exists("./cache/".$md5_name))
{
  //var_dump($image);
  //$image = preg_replace('/\s/',"%20",$image);
  //var_dump($image);
  $gis = getimagesize($image);
  $w = $gis[0];
  $h = $gis[1];
  $mime = $gis['mime'];
  header("Content-Type:{".$mime."}");
  header("Content-Transfer-Encoding: binary");
  
  //soit le watermark est une image
  if($h2w_img && getimagesize($h2w_img))
  {
    $wm_gis = getimagesize($h2w_img);
    $wm_w = $wm_gis[0];
    $wm_h = $wm_gis[1];
    $wm_mime = $wm_gis['mime'];
    switch($wm_mime)
    {
      case 'image/jpeg':
      case 'image/jpg':
        $watermark = imagecreatefromjpeg($h2w_img);
        break;
      case 'image/png':
        $watermark = imagecreatefrompng($h2w_img);
        break;
      case 'image/gif':
        $watermark = imagecreatefromgif($h2w_img);
        break;
    }
  }else{//soit c'est du texte
    if(function_exists("ImageTTFBBox"))
    {
      $size_wm = $h2w->calculateTextBox($h2w_text, $h2w_font, $h2w_size, $h2w_angle);
      $wm_w = $size_wm['width']+2;
      $wm_h = $size_wm['height']+2;
  		$watermark = ImageCreateTrueColor($wm_w, $wm_h);
  		$transparent = imagecolortransparent($watermark);
  		$tcolor = $h2w->hex2rgb($h2w_textcolor);
  		$scolor = $h2w->hex2rgb($h2w_shadowcolor);
  		$textcolor = imagecolorallocatealpha( $watermark, $tcolor[0], $tcolor[1], $tcolor[2], 127 * (100 - $h2w_opacity) / 100 );
      $shadowcolor = imagecolorallocatealpha( $watermark, $scolor[0], $scolor[1], $scolor[2], 127 * (100 - $h2w_opacity) / 100 );
  		imagefill($watermark, 0, 0, $transparent);
  		if($h2w_shadow)
  		{
  		  imagettftext($watermark, $h2w_size, $h2w_angle, $size_wm['left'], $size_wm['top'], $shadowcolor, $h2w_font, $h2w_text);
  		}
  		imagettftext($watermark, $h2w_size, $h2w_angle, $size_wm['left']+2, $size_wm['top']+2, $textcolor, $h2w_font, $h2w_text);//ecriture avec un ombré blanc
    }
  }
  switch($mime)//image d'origine
  {
    case 'image/jpeg':
    case 'image/jpg':
      $target = imagecreatefromjpeg($image);
      break;
    case 'image/png':
      $target = imagecreatefrompng($image);
      break;
    case 'image/gif':
      $target = imagecreatefromgif($image);
      break;
  }
    
  $decal_x = 5;
  $decal_y = 5;
  //calcul des coordonnées
  switch($h2w_pos)
  {
    case 1://haut gauche
    case 2://haut centre
    case 3://haut droite
      $dest_y = $h2w_size + $decal_y;
      break;
    case 4://centre gauche
    case 5://centre centre
    case 6://centre droite
      $dest_y = round($h/2 - $wm_h/2);
      break;
    case 7://bas gauche
    case 8://bas centre
    case 9://bas droite
      $dest_y = $h - $wm_h - $decal_y;
      break;
  }
  switch($h2w_pos)
  {
    case 1://haut gauche
    case 4://centre gauche
    case 7://bas gauche
      $dest_x = $decal_x;
      break;
    case 2://haut centre
    case 5://centre centre
    case 8://bas centre
      $dest_x = round($w/2 - $wm_w/2);
      break;
    case 3://haut droite
    case 6://centre droite
    case 9://bas droite
      $dest_x = $w - $wm_w - $decal_x;
      break;
  }
  
  //si le watermark est plus grand que l'image, il faut le redimensionner
  if($wm_w > $w || $wm_h > $h)
  {
    if($wm_w > $w && $wm_h <= $h && $w > 0)
    {
      $rapport = $wm_w / $w;
    }elseif($wm_w <= $w && $wm_h > $h && $h > 0)
    {
      $rapport = $wm_h / $h;
    }elseif($wm_w > $w && $wm_h > $h && $h > 0 && $w > 0)
    {
      $rapport = (($wm_w / $w) > ($wm_h / $h)) ? $wm_w / $w : $wm_h / $h;
    }
    $new_width = ($rapport > 0) ? floor($wm_w/$rapport) : 0;
    $new_height = ($rapport > 0) ? floor($wm_h/$rapport) : 0;
//    echo "wm_w: $wm_w - wm_h: $wm_h - w: $w - h: $h - rapport: $rapport - new_width: $new_width - new_height : $new_height";
    $temp = imagecreatetruecolor($new_width, $new_height);
    $t_transparent = imagecolortransparent($temp);
		imagefill($temp, 0, 0, $t_transparent);
		imagecopyresized($temp, $watermark, 0, 0, 0, 0, $new_width, $new_height, $wm_w, $wm_h);
    $watermark = $temp;
    $wm_w = $new_width;
    $wm_h = $new_height;
    imagedestroy($temp);
  }
  
  //fusion de l'image et du watermark
  if($h2w_img && getimagesize($h2w_img))
  {
    imagecopymerge($target, $watermark, $dest_x, $dest_y, 0, 0, $wm_w, $wm_h, $h2w_opacity);
  }else{
    imagecopy($target, $watermark, $dest_x, $dest_y, 0, 0, $wm_w, $wm_h);
  }
  
  imagejpeg($target, "./cache/".$md5_name);
  imagedestroy($watermark);
  imagedestroy($target);
}
$fp = fopen("./cache/".$md5_name, "rb");	  
if ($fp)
{
  $gis = getimagesize("./cache/".$md5_name);
  $mime = $gis['mime'];
  header("Content-Type:{".$mime."}");
  //header("Content-Transfer-Encoding: binary");
  fpassthru($fp);
} 