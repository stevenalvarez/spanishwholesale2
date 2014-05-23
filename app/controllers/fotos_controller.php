<?php
class FotosController extends AppController {

	var $name = 'Fotos';

//	function index() {
//		$this->Foto->recursive = 0;
//		$this->set('fotos', $this->paginate());
//	}
//
//	function view($id = null) {
//		if (!$id) {
//			$this->Session->setFlash(__('Invalid foto', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		$this->set('foto', $this->Foto->read(null, $id));
//	}
//
//	function add() {
//		if (!empty($this->data)) {
//			$this->Foto->create();
//			if ($this->Foto->save($this->data)) {
//				$this->Session->setFlash(__('The foto has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The foto could not be saved. Please, try again.', true));
//			}
//		}
//		$calsados = $this->Foto->Calsado->find('list');
//		$this->set(compact('calsados'));
//	}
//
//	function edit($id = null) {
//		if (!$id && empty($this->data)) {
//			$this->Session->setFlash(__('Invalid foto', true));
//			$this->redirect(array('action' => 'index'));
//		}
//		if (!empty($this->data)) {
//			if ($this->Foto->save($this->data)) {
//				$this->Session->setFlash(__('The foto has been saved', true));
//				$this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The foto could not be saved. Please, try again.', true));
//			}
//		}
//		if (empty($this->data)) {
//			$this->data = $this->Foto->read(null, $id);
//		}
//		$calsados = $this->Foto->Calsado->find('list');
//		$this->set(compact('calsados'));
//	}
//
//	function delete($id = null) {
//		if (!$id) {
//		//	$this->Session->setFlash(__('Invalid id for foto', true));
////			$this->redirect(array('action'=>'index'));
//         exit();
//		}
//		if ($this->Foto->delete($id)) {
//			//$this->Session->setFlash(__('Foto deleted', true));
////			$this->redirect(array('action'=>'index'))
//            echo "true";
//            exit();
//		}
//		//$this->Session->setFlash(__('Foto was not deleted', true));
////		$this->redirect(array('action' => 'index'));
//        exit();
//	}
//	function admin_index() {
//		$this->Foto->recursive = 0;
//		$this->set('fotos', $this->paginate());
//	}
//
	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid foto', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('foto', $this->Foto->read(null, $id));
	}

		function admin_add() {
	   
        App::import('Vendor','upload');// importa    
        // list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        // max file size in bytes
        $sizeLimit = 100 * 1024 * 1024;        
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload('../webroot/img/temp/');//el resultado es       
        $uid=uniqid('');        
        $result["filename"]=$this->Image->just_move($result["filename"],'img/temp/','img/'.$this->modelClass.'/orig/',$uid); // imagen original...        
        $this->Image->copy_and_optimize($result["filename"],null,'60',$this->modelClass.'/mini/');//para el slider
        $this->Image->copy_and_optimize($result["filename"],'800',null,$this->modelClass.'/max/'); // para la idea...
        $this->Image->copy_and_optimize($result["filename"],'200',null,$this->modelClass.'/mid/');//para el slider
       // $this->Image->copy_and_optimize($result["filename"],'500',null,$this->modelClass.'/646/');//para el slider index
        
        // to pass data through iframe you will need to encode all html tags
        
        $this->data["Foto"]["title"]='';
        $this->data["Foto"]["calsado_id"]=$_GET["calsado"];
        $this->data["Foto"]["url"]=$result["filename"];
       
		if (!empty($this->data)) {
			$this->Foto->create();
			if ($this->Foto->save($this->data)) {
			 $result["id"]=$this->Foto->id;
				 echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                 exit();
			} else {
				 echo 'error';
                 exit();
			}
		}
		//$galeries = $this->Photo->Galery->find('list');
//		$this->set(compact('galeries'));
	}
    
    function proveedor_add() {
	   
        App::import('Vendor','upload');// importa    
        // list of valid extensions, ex. array("jpeg", "xml", "bmp")
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');
        // max file size in bytes
        $sizeLimit = 100 * 1024 * 1024;        
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload('../webroot/img/temp/');//el resultado es       
        $uid=uniqid('');        
        $result["filename"]=$this->Image->just_move($result["filename"],'img/temp/','img/'.$this->modelClass.'/orig/',$uid); // imagen original...        
        $this->Image->copy_and_optimize($result["filename"],null,'60',$this->modelClass.'/mini/');//para el slider
        $this->Image->copy_and_optimize($result["filename"],'800',null,$this->modelClass.'/max/'); // para la idea...
        $this->Image->copy_and_optimize($result["filename"],'200',null,$this->modelClass.'/mid/');//para el slider
       // $this->Image->copy_and_optimize($result["filename"],'500',null,$this->modelClass.'/646/');//para el slider index
        
        // to pass data through iframe you will need to encode all html tags
        
        $this->data["Foto"]["title"]='';
        $this->data["Foto"]["calsado_id"]=$_GET["calsado"];
        $this->data["Foto"]["url"]=$result["filename"];
       
		if (!empty($this->data)) {
			$this->Foto->create();
			if ($this->Foto->save($this->data)) {
			 $result["id"]=$this->Foto->id;
				 echo htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                 exit();
			} else {
				 echo 'error';
                 exit();
			}
		}
		//$galeries = $this->Photo->Galery->find('list');
//		$this->set(compact('galeries'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid foto', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Foto->save($this->data)) {
				$this->Session->setFlash(__('The foto has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The foto could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Foto->read(null, $id);
		}
		$calsados = $this->Foto->Calsado->find('list');
		$this->set(compact('calsados'));
	}

	function admin_delete($id = null) {
		if (!$id) {
		//	$this->Session->setFlash(__('Invalid id for foto', true));
//			$this->redirect(array('action'=>'index'));
         exit();
		}
		if ($this->Foto->delete($id)) {
			//$this->Session->setFlash(__('Foto deleted', true));
//			$this->redirect(array('action'=>'index'))
            echo "true";
            exit();
		}
		//$this->Session->setFlash(__('Foto was not deleted', true));
//		$this->redirect(array('action' => 'index'));
        exit();
	}
    
    
    	function admin_ajaxdelete($id = null) {
		if (!$id)
        {
         exit();
		}
		if ($this->Foto->delete($id)) {		
            echo "$(this).parent('').parent('').slideUp();";
            exit();}
        else
        {
            echo utf8_encode("alert('No se puede eliminar debido a que existen datos relacionados con el registro que esta tratando de borrar')");
        }
        exit();
	}
    
    
        	function proveedor_ajaxdelete($id = null) {
		if (!$id)
        {
         exit();
		}
		if ($this->Foto->delete($id)) {		
            echo "$(this).parent('').parent('').slideUp();";
            exit();}
        else
        {
            echo  utf8_encode("alert('No se puede eliminar debido a que existen datos relacionados con el registro que esta tratando de borrar')");
        }
        exit();
	}
    
    
    
    
    	function proveedor_delete($id = null) {
		if (!$id) {
		//	$this->Session->setFlash(__('Invalid id for foto', true));
//			$this->redirect(array('action'=>'index'));
         exit();
		}
		if ($this->Foto->delete($id)) {
			//$this->Session->setFlash(__('Foto deleted', true));
//			$this->redirect(array('action'=>'index'))
            echo "true";
            exit();
		}
		//$this->Session->setFlash(__('Foto was not deleted', true));
//		$this->redirect(array('action' => 'index'));
        exit();
	}
    
    
    	function admin_update($id = null) {
		if (!$id) {		
         exit();
		}
        else{        
        $this->Foto->id=$id;
        $this->Foto->saveField('title',$_POST["color"]);
        $this->Foto->saveField('orden',$_POST["orden"]);
        echo "true";
        exit();        
        }
        exit();
	}
    
        function proveedor_update($id = null) {
		if (!$id) {		
         exit();
		}
        else{        
        $this->Foto->id=$id;
        $this->Foto->saveField('title',$_POST["color"]);
        $this->Foto->saveField('orden',$_POST["orden"]);
        echo "true";
        exit();        
        }
        exit();
	}
    
    
    
}
