<?php
class CalsadosController extends AppController {

	var $name = 'Calsados';
    
   function beforeFilter() {    
    $this->Auth->allow('index','cat','subcat','subsubcat','view','precio','marca','tag','prov','contacto','enspain','buscar');
    parent::beforeFilter();
    }
    
        function enspain()
    {
        if(isset($_SESSION["hechoen"]))
        {
            unset($_SESSION["hechoen"]);
           
        }
        else
         {
            $_SESSION["hechoen"]='28';
   
         }
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
    }
    function contacto()
    {
        
        
    }
    function ___returncalsados()
    {   

      $sql="select * from `calsados` as Calsado, `surtidos` as Surtido, fotos as Foto, `usuarios` as Usuario
where Calsado.`dele`<>1 and Calsado.`activado`=1 and Calsado.id = Surtido.`calsado_id` and 
Calsado.id = Foto.`calsado_id` and Calsado.`usuario_id`=Usuario.id and Usuario.`estado`=1";
        
        if(isset($_GET["brand"]) && $_GET["brand"])// marcars
        {
            $marca=mysql_escape_string($_GET["brand"]);            
            $sql.=" and Calsado.marca='$marca'";
        }       
        if(isset($_GET["material"]) && $_GET["material"])// matetiales
        {
            $material=mysql_escape_string($_GET["material"]);            
            $sql.=" and Calsado.material='$material'";
        }
        
        /** proveedor*/
         if(isset($_GET['provider']) && $_GET['provider'])
        {
           
           $provider=($_GET["provider"]);          
           $sql.=" and Usuario.title='$provider'";
        }
        /** categoria*/        
        if(isset($_GET['categoria_id']) && $_GET['categoria_id'])
        {
             $categoria_id=mysql_escape_string($_GET["categoria_id"]);     
             $sql.=" and Calsado.categoria_id='$categoria_id'";  
        }        
        if(isset($_GET['tipo_id']) && $_GET['tipo_id'])
        {
             $tipo_id=mysql_escape_string($_GET["tipo_id"]);     
             $sql.=" and Calsado.tipo_id='$tipo_id'";                   
        }
        if(isset($_GET['subtipo_id']) && $_GET['subtipo_id'])
        {            
             $subtipo_id=mysql_escape_string($_GET["subtipo_id"]);     
             $sql.=" and Calsado.subtipo_id='$subtipo_id='";                  
        }  
                   
        if(isset($_SESSION["hechoen"]))
        {
            $sql.=" and Calsado.country_id='28'";   
        }
        if(isset($_GET["f"]) && $_GET["f"]=='price')// filtro de proveedores
       {
         $from=intval($_GET["from"]);
         $to=intval($_GET["to"]);
         
         $sql.=" and (Surtido.precio_sur + Surtido.precio_sur*Usuario.comision/100)>='$from' and  (Surtido.precio_sur + Surtido.precio_sur*Usuario.comision/100) <=$to"; 
       }
       
       
         if(isset($_GET["sizema"]) &&  ctype_digit($_GET["sizema"]))
       {
         $sizema=intval($_GET["sizema"]);
         $sql.=" and Surtido.talla_sup >='$sizema'"; 
       }
         if(isset($_GET["sizeme"]) &&  ctype_digit($_GET["sizeme"]))
       {
         $sizeme=intval($_GET["sizeme"]);
         $sql.=" and Surtido.talla_inf <='$sizeme'"; 
       }
       
       $sql.=" group by Foto.id order by Surtido.id desc";
       $calsados= $this->Calsado->query($sql);

       
      if(isset($_GET["tag"]))// filtro de tags 
       {
        foreach($calsados as $k=>$v)
        {
            $tags="select tags.* from tags, calsados_tags where  calsados_tags.tag_id =tags.id and  calsados_tags.calsado_id='{$v["Calsado"]["id"]}'";
            $tags = mysql_query($tags);
            
            $borrar=1;
            while($tag = mysql_fetch_assoc($tags)) 
            {
                if(($tag["title"]) == $_GET["tag"] )
                {
                    $borrar=0;
                }
            }
            if($borrar==1)
            unset($calsados[$k]);
        }
       }
      return $calsados;
    }
    
	function index() {
	   
		$this->set('title_for_layout','Home');
        $this->set('calsados',$this->___returncalsados());
        $this->set('index','1');
	}
    function buscar() {
                
		$this->set('title_for_layout','Home');
        $this->Calsado->recursive = 1;
       
        $buscar=mysql_escape_string($_POST['buscar']);
        $sql="select * from `calsados` as Calsado, `surtidos` as Surtido, fotos as Foto, `usuarios` as Usuario
        where Calsado.`dele`<>1 and Calsado.`activado`=1 and Calsado.id = Surtido.`calsado_id` and 
        Calsado.id = Foto.`calsado_id` and Calsado.`usuario_id`=Usuario.id and Usuario.`estado`=1 and (";
        $sql.="Calsado.marca like '%$buscar%'";
        //$sql.=" or Calsado.material like '%$buscar%'";
        $sql.=" or Calsado.code like '%$buscar%')";
        $sql.=" GROUP BY Calsado.id";
                                                 
        $this->set('calsados',$this->Calsado->query($sql));
        $this->render('index');
        
	}
    function cat() {
        
		$this->set('title_for_layout',$this->params["pass"]['1']);
        $this->Calsado->recursive = 1;
        $_GET["categoria_id"]=$this->params["pass"]['0'];                
        $this->set('calsados',$this->___returncalsados());
        $this->render('index');
	}
    
    function subcat() {
		 $this->set('title_for_layout',$this->params["pass"]['2']."-".$this->params["pass"]['3']);
        $this->Calsado->recursive = 1;
        //$categorias = $this->Calsado->Categoria->find('list');        
        
        $_GET["categoria_id"]=$this->params["pass"]['0'];
        $_GET["tipo_id"]=$this->params["pass"]['1'];
        
        $this->set('calsados',$this->___returncalsados());
        $this->render('index');            
	}
    
   function subsubcat() {
    
        $this->set('title_for_layout',$this->params["pass"]['2']."-".$this->params["pass"]['3']);
        $this->Calsado->recursive = 1;
        //$categorias = $this->Calsado->Categoria->find('list');        
        
        $_GET["categoria_id"]=$this->params["pass"]['0'];
        $_GET["tipo_id"]=$this->params["pass"]['1'];
        $_GET["subtipo_id"]=$this->params["pass"]['2'];
       
        $this->set('calsados',$this->___returncalsados());
        $this->render('index');            
	}
    
    
       function marca() {
        
		$this->set('title_for_layout',___("Marca",1)."-".$this->params["pass"]['0']);
        $this->Calsado->recursive = 1;
        //$categorias = $this->Calsado->Categoria->find('list');
        if(isset($_SESSION["hechoen"]))  
        $this->set('calsados', $this->Calsado->find('all',array('conditions'=>array('Calsado.country_id'=>'28','Calsado.activado'=>'1','Calsado.marca'=>$this->params["pass"]['0']  ))));
        else        
        $this->set('calsados', $this->Calsado->find('all',array('conditions'=>array('Calsado.activado'=>'1','Calsado.marca'=>$this->params["pass"]['0']  ))));        
     //   $this->set('calsados_random', $this->Calsado->find('all',array('conditions'=>array('Calsado.activado'=>'1','Calsado.categoria_id'=>$this->params["pass"]['0'],'Calsado.tipo_id'=>$this->params["pass"]['1'],'Calsado.subtipo_id'=>$this->params["pass"]['2']),'order'=>array('rand()')   )));
         $this->render('index');            
	}
    
       function prov() {
        
		$this->set('title_for_layout',___("Proveedor",1)."-".$this->params["pass"]['0']);
        $this->Calsado->recursive = 1;
        //$categorias = $this->Calsado->Categoria->find('list');   
        if(isset($_SESSION["hechoen"]))
        $this->set('calsados', $this->Calsado->find('all',array('conditions'=>array('Calsado.country_id'=>'28','Calsado.activado'=>'1','Usuario.title'=>$this->params["pass"]['0']  ))));
        else     
        $this->set('calsados', $this->Calsado->find('all',array('conditions'=>array('Calsado.activado'=>'1','Usuario.title'=>$this->params["pass"]['0']  ))));        
     //   $this->set('calsados_random', $this->Calsado->find('all',array('conditions'=>array('Calsado.activado'=>'1','Calsado.categoria_id'=>$this->params["pass"]['0'],'Calsado.tipo_id'=>$this->params["pass"]['1'],'Calsado.subtipo_id'=>$this->params["pass"]['2']),'order'=>array('rand()')   )));
         $this->render('index');            
	}


    
    function tag() {
        
		 $this->set('title_for_layout',$this->params["pass"]['0']);
        
        //$categorias = $this->Calsado->Categoria->find('list'); 
        $this->loadModel("Tag");  
        $this->Tag->recursive = 2;      
        $tags=$this->Tag->find('all',array('conditions'=>array('Tag.title'=>$this->params["pass"]['0'])));
               
        $this->set('calsados', $tags["0"]["Calsado"]);
        $this->set('tipo', "tag");           
         //$this->set('calsados_random', $this->Calsado->find('all',array('conditions'=>array('Calsado.activado'=>'1','Calsado.tag_id'=>$this->params["pass"]['1']),'order'=>array('rand()')   )));
         $this->render('index');            
	}
         
    
       function precio() {
        
		$this->set('title_for_layout',___("Precios",1)." ".$this->params["pass"]['0']."&euro;-".$this->params["pass"]['1'].'&euro;');
       // $this->Calsado->recursive = 1;
        $this->Calsado->Surtido->recursive=0;
        $surtidos=$this->Calsado->Surtido->find('all',array('conditions'=>array('Surtido.precio_sur BETWEEN '.$this->params["pass"]['0'].' and '.$this->params["pass"]['1'].''),
        ));
       // print_r($surtidos);
//        exit();
        $this->set('calsados', $surtidos );
        $this->set('tipo', "precio" );          
       // $this->set('calsados_random', $this->Calsado->find('all',array('conditions'=>array('Calsado.activado'=>'1'),'order'=>array('rand()')   )));
        $this->render('index');            
	}
    

	function view($id = null) {
	   
        if(!$this->Auth->user("id"))
        {
          	$this->Session->setFlash(___(utf8_encode('Debe estar registrado para acceder a la información de los productos. Gracias.'), true));
            $this->redirect($this->referer());
            exit();
        }
       
       
		if (!$id) {
			$this->Session->setFlash(__('Invalid calsado', true));
			$this->redirect(array('action' => 'index'));
		}
        $calsado=$this->Calsado->read(null, $id);
       // $this->set('calsados', $this->Calsado->find('all',array('conditions'=>array('calsado.activado'=>'1','calsado.categoria_id'=>$calsado["Calsado"]['categoria_id']
//        ))));  

      //  print_r($calsado);  
		$this->set('calsado', $calsado);
	}
//
//	function add() {
//		if (!empty($this->data)) {
//			$this->Calsado->create();
//			if ($this->Calsado->save($this->data)) {
//				$this->Session->setFlash(__('The calsado has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The calsado could not be saved. Please, try again.', true));
//			}
//		}
//		$categorias = $this->Calsado->Categorium->find('list');
//		$tipos = $this->Calsado->Tipo->find('list');
//		$usuarios = $this->Calsado->Usuario->find('list');
//		$materials = $this->Calsado->Material->find('list');
//		$countries = $this->Calsado->Country->find('list');
//		$colors = $this->Calsado->Color->find('list');
//		$tags = $this->Calsado->Tag->find('list');
//		$this->set(compact('categorias', 'tipos', 'usuarios', 'materials', 'countries', 'colors', 'tags'));
//	}
//
//	function edit($id = null) {
//		if (!$id && empty($this->data)) {
//			$this->Session->setFlash(__('Invalid calsado', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		if (!empty($this->data)) {
//			if ($this->Calsado->save($this->data)) {
//				$this->Session->setFlash(__('The calsado has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The calsado could not be saved. Please, try again.', true));
//			}
//		}
//		if (empty($this->data)) {
//			$this->data = $this->Calsado->read(null, $id);
//		}
//		$categorias = $this->Calsado->Categorium->find('list');
//		$tipos = $this->Calsado->Tipo->find('list');
//		$usuarios = $this->Calsado->Usuario->find('list');
//		$materials = $this->Calsado->Material->find('list');
//		$countries = $this->Calsado->Country->find('list');
//		$colors = $this->Calsado->Color->find('list');
//		$tags = $this->Calsado->Tag->find('list');
//		$this->set(compact('categorias', 'tipos', 'usuarios', 'materials', 'countries', 'colors', 'tags'));
//	}
//
//	function delete($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid id for calsado', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		if ($this->Calsado->delete($id)) {
//			$this->Session->setFlash(__('Calsado deleted', true));
//			$this->redirect(array('action'=>'index'));
//		}
//		$this->Session->setFlash(__('Calsado was not deleted', true));
//		$this->redirect(array('action' => 'index'));
//	}
	function admin_index()
    { 
      if(isset($_GET["aprove"]))
        {
            foreach($_POST["aprove"] as $aprove)
            {
                $this->Calsado->id=$aprove;
                $this->Calsado->saveField('activado','1');
            }            
        }
   
	    $categorias = $this->Calsado->Categoria->find('list');
        $tipos = $this->Calsado->Tipo->find('list');
        $subtipos = $this->Calsado->Subtipo->find('list');
        $proveedores = $this->Calsado->Usuario->find('list',array('conditions'=>array('Usuario.rol'=>'proveedor')));
        
        
        
        $countries = $this->Calsado->Country->find('list',array('order'=>'Country.title desc'));        
        $this->set(compact('categorias', 'countries'));         
        $this->set('categorias',$categorias);
        $this->set('tipos',$tipos);
        $this->set('subtipos',$subtipos);
        $this->set('proveedores',$proveedores);
        
        
		$this->Calsado->recursive = 1;
        $this->paginate = array('order' => 'Calsado.id DESC');        
        if(isset($_GET["search"]))
        {
            if($_SESSION["rpos"])
            {
                $_POST=$_SESSION["pos"];                
            }
             $_SESSION["rpos"]=0;
            $_SESSION["pos"]=$_POST;
            
            if($_POST["tipo"]=='termino')
            {
             $this->set('calsados',$this->paginate(null,array("dele <> 1 and {$_POST["criterio"]} like '%{$_POST["like"]}%'")));   
            }
            else if($_POST["tipo"]=='filtro')
            {
                $search=array();
                
                $search['dele <>']='1';
                
                if($_POST["estado_id"])
                {
                    if($_POST["estado_id"]=='p')
                    $_POST["estado_id"]=0;
                    
                    $search["Calsado.activado"]=$_POST["estado_id"];
                }                
                if($_POST["categoria_id"])
                {
                    $search["Calsado.categoria_id"]=$_POST["categoria_id"];
                }
                if($_POST["tipo_id"])
                {
                    $search["Calsado.tipo_id"]=$_POST["tipo_id"];
                } 
                if($_POST["subtipo_id"])
                {
                    $search["Calsado.subtipo_id"]=$_POST["subtipo_id"];
                } 
                
                if($_POST["usuario_id"])
                {
                    $search["Calsado.usuario_id"]=$_POST["usuario_id"];
                } 
                
                              
             $this->set('calsados',$this->paginate(null,$search));
            }
            else
            {
                 $this->set('calsados',$this->paginate(null,array("dele <> 1 and code like '%{$_POST["referencia"]}%'")));   
            }
        }
        else
		{
		  //$search['del <>']='1';		  
		  $this->set('calsados', $this->paginate(null,array('Calsado.dele <>'=>1)));
        }       
	}
    
	function proveedor_index()
    { 
      if(isset($_GET["aprove"]))
        {
            foreach($_POST["aprove"] as $aprove)
            {
                $this->Calsado->id=$aprove;
                $this->Calsado->saveField('activado','1');
            }            
        }
   
	    $categorias = $this->Calsado->Categoria->find('list');
        $tipos = $this->Calsado->Tipo->find('list');
        $subtipos = $this->Calsado->Subtipo->find('list');
       // $proveedores = $this->Calsado->Usuario->find('list',array('conditions'=>array('Usuario.rol'=>'proveedor')));
        
        
        
        $countries = $this->Calsado->Country->find('list',array('order'=>'Country.title desc'));        
        $this->set(compact('categorias', 'countries'));         
        $this->set('categorias',$categorias);
        $this->set('tipos',$tipos);
        $this->set('subtipos',$subtipos);
        //$this->set('proveedores',$proveedores);
        
        
		$this->Calsado->recursive = 1;
        $this->paginate = array('order' => 'Calsado.id DESC');        
        if(isset($_GET["search"]))
        {
            if($_POST["tipo"]=='termino')
            {
             $this->set('calsados',$this->paginate(null,array("dele <> 1 and {$_POST["criterio"]} like '%{$_POST["like"]}%'")));   
            }
            else if($_POST["tipo"]=='filtro')
            {
                $search=array();
                
                $search['dele <>']='1';
                
                if($_POST["estado_id"])
                {
                    if($_POST["estado_id"]=='p')
                    $_POST["estado_id"]=0;
                    
                    $search["Calsado.activado"]=$_POST["estado_id"];
                }                
                if($_POST["categoria_id"])
                {
                    $search["Calsado.categoria_id"]=$_POST["categoria_id"];
                }
                if($_POST["tipo_id"])
                {
                    $search["Calsado.tipo_id"]=$_POST["tipo_id"];
                } 
                if($_POST["subtipo_id"])
                {
                    $search["Calsado.subtipo_id"]=$_POST["subtipo_id"];
                } 
                
                
                    $search["Calsado.usuario_id"]=$this->Auth->user("id");
                
                
                              
             $this->set('calsados',$this->paginate(null,$search));
            }
            else
            {
                 $this->set('calsados',$this->paginate(null,array("dele <> 1 and code like '%{$_POST["referencia"]}%'")));   
            }
        }
        else
		{
		  //$search['del <>']='1';		  
		  $this->set('calsados', $this->paginate(null,array('Calsado.dele <>'=>1,'Calsado.usuario_id'=>$this->Auth->user("id"))));
        }       
	}


	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid calsado', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('calsado', $this->Calsado->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Calsado->create();
            $this->data['Calsado']['tim'] = date("Y-m-d H:i:s");
        //    $this->data["Calsado"]["usuario_id"]=$this->Auth->user("id");           
			if ($this->Calsado->save($this->data)) {
			//	$this->Session->setFlash(__('The calsado has been saved', true));
				$this->redirect(array('action' => 'edit',$this->Calsado->id,'#nuevo'));
			} else {
				$this->Session->setFlash(__('The calsado could not be saved. Please, try again.', true));
			}
		}
		$categorias = $this->Calsado->Categoria->find('list');             
		$tipos = $this->Calsado->Tipo->find('list');       
        $subtipos = $this->Calsado->Subtipo->find('list');
		$usuarios = $this->Calsado->Usuario->find('list',array('conditions'=>array('Usuario.rol'=>'proveedor')));
        $materials = $this->Calsado->Material->find('list');
		$countries = $this->Calsado->Country->find('list',array('order'=>'Country.title asc'));
        
         foreach ($countries as $k=>$v)
        {
            $countries[$k]= utf8_encode(html_entity_decode($countries[$k]));
        }
		$tags = $this->Calsado->Tag->find('list');
		$this->set(compact('categorias', 'tipos', 'usuarios', 'materials', 'countries', 'colors', 'tags','subtipos'));
	}
    
    	function proveedor_add()
        {        
   		if (!empty($this->data)) {
			$this->Calsado->create();
            $this->data['Calsado']['tim'] = date("Y-m-d H:i:s");
            /* pertenencia del calzado*/
            $this->data["Calsado"]["usuario_id"]=$this->Auth->user("id");
            /**/           
			if ($this->Calsado->save($this->data)) {
		
				$this->redirect(array('action' => 'edit',	$this->Calsado->id));
			} else {
				$this->Session->setFlash(__('No se pudo guardar por favor intentelo de nuevo.', true));
			}
		}
		$categorias = $this->Calsado->Categoria->find('list');
		$tipos = $this->Calsado->Tipo->find('list');
        $subtipos = $this->Calsado->Subtipo->find('list');
		$usuarios = $this->Calsado->Usuario->find('list');
        $materials = $this->Calsado->Material->find('list');
        $countries = $this->Calsado->Country->find('list');
      
         foreach ($countries as $k=>$v)
        {
            $countries[$k]= utf8_encode(html_entity_decode($countries[$k]));
        }
		$tags = $this->Calsado->Tag->find('list');
		$this->set(compact('categorias', 'tipos', 'usuarios', 'materials', 'countries', 'colors', 'tags','subtipos'));
        }


	function admin_edit($id = null) {
	   
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid calsado', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
		  
		  //$this->data["Calsado"]["usuario_id"]=$this->Auth->user("id");
          
//          print_r($this->data);
//          exit();
//

          $step_new = isset($this->data["Calsado"]["step_new"]) ? true : false;
          unset($this->data["Calsado"]["step_new"]);
                    
			if ($this->Calsado->save($this->data)) {
				$this->Session->setFlash(__('Se guardaron los datos', true));
                if($step_new){
                    $this->redirect(array('action' => 'add'));
                }else{
                    $this->redirect(array('action' => 'index'));
                }
			} else {
				$this->Session->setFlash(__('The calsado could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Calsado->read(null, $id);
		}
		$categorias = $this->Calsado->Categoria->find('list');
		$tipos = $this->Calsado->Tipo->find('list');
        $subtipos = $this->Calsado->Subtipo->find('list');
		$usuarios = $this->Calsado->Usuario->find('list',array('conditions'=>array('Usuario.rol'=>'proveedor')));
        $materials = $this->Calsado->Material->find('list');
		$countries = $this->Calsado->Country->find('list',array('order'=>'Country.title desc'));
        
         foreach ($countries as $k=>$v)
        {
            $countries[$k]= utf8_encode(html_entity_decode($countries[$k]));
        }
        foreach($this->data["Surtido"] as $key => $surtido){
            $this->data["Surtido"][$key]['categoria_nombre'] = isset($categorias[$surtido['categoria_id']]) ? $categorias[$surtido['categoria_id']] : "";
            $this->data["Surtido"][$key]['tipo_nombre'] = isset($tipos[$surtido['tipo_id']]) ? $tipos[$surtido['tipo_id']] : "";
            $this->data["Surtido"][$key]['subtipo_nombre'] = isset($subtipos[$surtido['subtipo_id']]) ? $subtipos[$surtido['subtipo_id']] : "";
        }
//		$colors = $this->Calsado->Color->find('list');
		$tags = $this->Calsado->Tag->find('list');
		$this->set(compact('categorias', 'tipos','subtipos', 'usuarios', 'materials', 'countries', 'colors', 'tags'));
	}
    
    	function proveedor_edit($id = null) {

		if (!empty($this->data)) {
		  
		  $this->data["Calsado"]["usuario_id"]=$this->Auth->user("id");
          $step_new = isset($this->data["Calsado"]["step_new"]) ? true : false;
          unset($this->data["Calsado"]["step_new"]);
			if ($this->Calsado->save($this->data)) {
				$this->Session->setFlash(__('Se guardaron los cambios', true));
                if($step_new){
                    $this->redirect(array('action' => 'add'));
                }else{
                    $this->redirect(array('action' => 'index'));
                }
			} else {
				$this->Session->setFlash(__('The calsado could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Calsado->read(null, $id);
		}
		$categorias = $this->Calsado->Categoria->find('list');
		$tipos = $this->Calsado->Tipo->find('list');
        $subtipos = $this->Calsado->Subtipo->find('list');
		$usuarios = $this->Calsado->Usuario->find('list');
        $materials = $this->Calsado->Material->find('list');
		$countries = $this->Calsado->Country->find('list',array('order'=>'Country.title desc'));
        
         foreach ($countries as $k=>$v)
        {
            $countries[$k]= utf8_encode(html_entity_decode($countries[$k]));
        }
        foreach($this->data["Surtido"] as $key => $surtido){
            $this->data["Surtido"][$key]['categoria_nombre'] = isset($categorias[$surtido['categoria_id']]) ? $categorias[$surtido['categoria_id']] : "";
            $this->data["Surtido"][$key]['tipo_nombre'] = isset($tipos[$surtido['tipo_id']]) ? $tipos[$surtido['tipo_id']] : "";
            $this->data["Surtido"][$key]['subtipo_nombre'] = isset($subtipos[$surtido['subtipo_id']]) ? $subtipos[$surtido['subtipo_id']] : "";
        }
//		$colors = $this->Calsado->Color->find('list');
		$tags = $this->Calsado->Tag->find('list');
		$this->set(compact('categorias', 'tipos','subtipos', 'usuarios', 'materials', 'countries', 'colors', 'tags'));
	}
    

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for calsado', true));
			$this->redirect(array('action'=>'index'));
		}
		
        $this->Calsado->id=$id;
        $this->Calsado->saveField('dele',1);
		$this->Session->setFlash(__('Calsado eliminado', true));
		$this->redirect(array('action'=>'index'));
		
	
	}
    
    	function admin_ajaxdelete($id = null) {
		if (!$id) {
		exit();
		}
	    
        $this->Calsado->id=$id;
        $this->Calsado->saveField('dele',1);
		    echo "$(this).parents('div.articulo').slideUp();";
            exit();			
		
	}
        function proveedor_ajaxdelete($id = null) {
		if (!$id) {
		exit();
		}
	    
        $this->Calsado->id=$id;
        $this->Calsado->saveField('dele',1);
		    echo "$(this).parents('div.articulo').slideUp();";
            exit();		
	}
    
	
    function proveedor_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for calsado', true));
			$this->redirect(array('action'=>'index'));
		}
		
        $this->Calsado->id=$id;
        $this->Calsado->field('del',1);
		$this->Session->setFlash(__('Calsado eliminado', true));
		$this->redirect(array('action'=>'index'));
	}
    
    function admin_ajaxedit($id = null)
    {
       
      $controller=$_POST["controller"];
      $this->loadModel($controller);
      $this->$controller->id=$id;
      $this->$controller->saveField($_POST["name"],$_POST["val"]);      
      exit();
    }
    
        function proveedor_ajaxedit($id = null)
    {
       
      $controller=$_POST["controller"];
      $this->loadModel($controller);
      $this->$controller->id=$id;
      $this->$controller->saveField($_POST["name"],$_POST["val"]);      
      exit();
    }
    
    
    function admin_activar($id)
    {
        $this->Calsado->id=$id;
        $this->Calsado->saveField('activado',1);
        $_SESSION["rpos"]=1;
        $this->redirect($this->referer());
    }
    
    function admin_desactivar($id)
    {
        $this->Calsado->id=$id;
        $this->Calsado->saveField('activado',0);
        $_SESSION["rpos"]=1;
        $this->redirect($this->referer());
    }
    
    function proveedor_activar($id)
    {
        $this->Calsado->id=$id;
        $this->Calsado->saveField('activado',1);
        $_SESSION["rpos"]=1;
        $this->redirect($this->referer());
    }
    
    function proveedor_desactivar($id)
    {
        $this->Calsado->id=$id;
        $this->Calsado->saveField('activado',0);
        $_SESSION["rpos"]=1;
        $this->redirect($this->referer());
    }    
    
}
