<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	
    
   // Router::connect('/micuenta', array('controller' => 'users', 'action' => 'view'));
    Router::connect('/', array('controller' => 'calsados', 'action' => 'index'));
    //Router::connect('/admin', array('controller' => 'calsados', 'action' => 'index','admin' => true));
    Router::connect('/admin', array('controller' => 'pedidos', 'action' => 'index','admin' => true));
    //Router::connect('/proveedor', array('controller' => 'calsados', 'action' => 'index','proveedor' => true));
    Router::connect('/proveedor', array('controller' => 'pedidos', 'action' => 'lista','proveedor' => true));
  //  Router::connect('/cliente/home', array('controller' => 'calsados', 'action' => 'index'));
    Router::connect('/calzados/:action/*', array('controller' => 'calsados'));
     
    Router::connect('/admin/calzados/:action/*', array('controller' => 'calsados','prefix'=>'admin'));
    Router::connect('/proveedor/calzados/:action/*', array('controller' => 'calsados','prefix'=>'proveedor'));
    
    Router::connect('/tag/*', array('controller' => 'calsados', 'action' => 'tag'));
    Router::connect('/item/*', array('controller' => 'calsados', 'action' => 'view'));
    Router::connect('/prov/*', array('controller' => 'calsados', 'action' => 'prov'));
   
   	Router::connect('/subtype/*', array('controller' => 'calsados', 'action' => 'subsubcat'));
    Router::connect('/subcat/*', array('controller' => 'calsados', 'action' => 'subcat'));
    Router::connect('/cat/*', array('controller' => 'calsados', 'action' => 'cat'));
    Router::connect('/precio/*', array('controller' => 'calsados', 'action' => 'precio'));
     Router::connect('/marca/*', array('controller' => 'calsados', 'action' => 'marca'));
     
    
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
