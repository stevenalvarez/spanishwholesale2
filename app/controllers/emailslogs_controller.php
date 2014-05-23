<?php
class EmailslogsController extends AppController {

	var $name = 'Emailslogs';


	function admin_index() {
		$this->Emailslog->recursive = 0;
		$this->set('emailslogs', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid emailslog', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('emailslog', $this->Emailslog->read(null, $id));
	}

}
