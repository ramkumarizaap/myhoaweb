<?php
//print base_url();
//
// Layout config for the site admin 
//
                                        

$config['layout']['default']['template'] = 'layouts/frontend';
$config['layout']['default']['title']    = 'myHOA';
$config['layout']['default']['js_dir']    = "assets/js";
$config['layout']['default']['css_dir']   = "assets/css";
$config['layout']['default']['img_dir']   = "assets/images";
$config['layout']['default']['fonts_dir']   = "assets/fonts";

$config['layout']['default']['javascripts'] = array('jquery.min','bootstrap.min');
 
$config['layout']['default']['stylesheets'] = array('bootstrap', 'style');

$config['layout']['default']['description'] = 'myHOA';
$config['layout']['default']['keywords']    = 'myHOA';

$config['layout']['default']['http_metas'] = array(
	'X-UA-Compatible' => 'IE=edge',
    'Content-Type' => 'text/html; charset=utf-8',
	'viewport'     => 'width=device-width, initial-scale=1.0',
    'author' => 'myHOA',
);

                                     

$config['layout']['frontend']['template'] = 'layouts/frontend';
$config['layout']['frontend']['title']    = 'myHOA - frontend';
$config['layout']['frontend']['js_dir']    = "assets/js";
$config['layout']['frontend']['css_dir']   = "assets/css";
$config['layout']['frontend']['img_dir']   = "assets/images";

$config['layout']['default']['javascripts'] = array('jquery.min','bootstrap.min');
 
$config['layout']['default']['stylesheets'] = array('bootstrap', 'style');

 
   

?>
