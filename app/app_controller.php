<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {
 
var $components = array('Auth','Session','Email','RequestHandler','Image');
var $helpers = array('Html','Ajax','Javascript','Form','Session','Csv','Time');


//function afterFilter() {
//        // if in mobile mode, check for a valid view and use it
//        if (isset($this->is_mobile) && $this->is_mobile) {
//            $view_file = new File( VIEWS . $this->name . DS . 'mobile/' . $this->action . '.ctp' );
//            $this->render($this->action, 'mobile','mobile/'.$this->action);
//        }
//     }
 
 function beforeFilter() {
 
  $this->Auth->userModel = 'Usuario';
 
  $this->Auth->fields = array('username' =>'email', 'password' => 'password');
  $this->Auth->loginAction = array('controller' => 'usuarios', 'action' => 'login');
  $this->Auth->userScope=array('Usuario.estado'=>'1');
  $this->Auth->autoRedirect = false;  
  $this->Auth->loginError = "Login o password incorrectos";
  $this->Auth->authError = "No esta autorizado para ingresar a esa direcci&oacute;n.";
  $this->Auth->flashElement = "message_error";
  $this->Auth->authorize = 'controller';
  //mobile
// if ($this->RequestHandler->isMobile() && $this->params['prefix']!='admin') {  
//        $this->is_mobile = true;
//        $this->set('is_mobile', true );
//        $this->autoRender = false;
//     }
  // llama a un layout de nombre de su prefix sino el default nomas  
  if(isset($this->params['prefix']) && ($this->params['prefix']=='admin' || $this->params['prefix']=='proveedor' ||$this->params['prefix']=='cliente'  ))
  $this->layout=$this->params['prefix'];
 
 //si esta logeado y es admin o proveedor redireccinamos a su panel
    $user_auth = $this->Auth->user();
    if(!empty($user_auth) && is_array($user_auth)){
        $rol = $user_auth['Usuario']['rol'];
        if($rol == "proveedor" || $rol == "admin"){
            if($this->params['url']['url'] == "/"){
                $this->redirect("/".$rol);
            }
        }
    }else{
        if(isset($this->params['action']) && isset($this->params['pass']) && !empty($this->params['pass']) && isset($this->params['url']) && !empty($this->params['url'])){
            $this->Session->write('request_uri', "http://".$_SERVER['HTTP_HOST'].$this->base."/".$this->params['url']['url']);
        }else{
            $this->Session->write('request_uri', "http://".$_SERVER['HTTP_HOST'].$this->base);
        }
    }
 }
 
function isAuthorized()
      {
        /*solo para admins*/
        if(isset($this->params['prefix']) && ($this->params['prefix']=='admin' || $this->params['prefix']=='proveedor' ||$this->params['prefix']=='cliente'  ))
        //si esta queriendo acceder como admin,proveedor,usuario -----------solo deja funciones de su rol
        {
            $prefix = $this->params['prefix'];
            if($prefix==$this->Auth->user("rol"))//Si la ruta es == 
             {
                return true;
             }
              else
                {
                    $this->Session->destroy();
                    return  false;
                }              
        }
        else
        {
            return false;
        }
    }
    
function salvarpedidos() // salva los pedidos a su serializado
{
    if($this->Auth->user("id"))
    {
    $this->loadModel("Usuario");
    $this->Usuario->id=$this->Auth->user("id");
    $pedidos=$_SESSION["cart"];
    
    $pedidos=serialize($pedidos);
    
    $this->Usuario->saveField('pedidos',$pedidos);
    }    
}  

function restaurarpedidos() // salva los pedidos a su serializado
{
    if($this->Auth->user("id"))
    {
    $this->loadModel("Usuario");
    $this->Usuario->id=$this->Auth->user("id");
    $pedidos=$_SESSION["cart"];
    $this->Usuario->saveField('pedidos',$pedidos);
    }    
}

  
    
}