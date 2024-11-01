<?php
/*
Plugin Name: Wordpress Pan0
Plugin URI: 
Description: pan0.net integration. enter [pan0 http://path.to.yourimg/name_of_image] into post/page to add the image as panorama 
Version: 0.0.4
Author: Libor Sigmund
Author URI: http://liborsigmund.com/
License: GPL2
*/
/*  Copyright 2010  Libor Sigmund  (email : ja@liborsigmund.cz)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
$wp_PanZero; 
if(!class_exists('PanZeroPlugin')){
class PanZeroPlugin {
	function PanZeroPlugin(){
		if(function_exists('add_shortcode')){
			add_shortcode('pan0', array($this, 'short_code'));
		}
	}
	function short_code($atts, $content = null){
		$h='';
		$imgurl = '';
		$width = '100%';
		$height = '100%';
		$title='';
		$panurl=get_option('siteurl');
		if(strlen($panurl)> 2 && $panurl[strlen($panurl)-1]!='/')$panurl.='/';
		$panurl.='wp-content/plugins/wp-pan0/pan0.swf';
//		return $panurl;
		$imgurl='';
		switch(count($atts)){
			case 1:
			$imgurl = $atts[0];
			break;
			case 2:
			if(preg_match ('/[0-9]+x[0-9]+/',$atts[0])){
				$s = split('x',$atts[0]);
				$width = 0+$s[0];
				$height = 0+$s[1];	
			}
			$imgurl = $atts[1];
			break;
		}
		if(''!=$imgurl){
			
			$imgurl=urlencode($imgurl);
			$h.='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 
    codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" 
    width="'.$width.'" height="'.$height.'" title="'.$title.'">
    <param name="allowFullScreen" value="true" />
    <param name="movie" value="'.$panurl.'?panoSrc='.$imgurl.'" />
    <param name="quality" value="high" />
    <param name="BGCOLOR" value="#AAAAAA" />
    <embed src="'.$panurl.'?panoSrc='.$imgurl.'" allowFullScreen="true" 
        width="'.$width.'" height="'.$height.'" quality="high" 
        pluginspage="http://www.macromedia.com/go/getflashplayer" 
        type="application/x-shockwave-flash" bgcolor="#DDDDDD">
    </embed>
</object>';
		}
		return $h;
	}	
}
$wp_PanZero = new PanZeroPlugin();
}
?>
