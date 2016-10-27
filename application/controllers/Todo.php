<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/Libraries/REST_Controller.php';

class Todo extends REST_Controller {
	function __construct($config='rest')
	{
		parent::__construct($config);
	}

	function index_get()
	{
		$id = $this->get('id_task');
		if($id == '')
		{
			$todos = $this->db->get('tbl_task')->result();
		} else{
			$this->db->where('id_task', $id);
			$todos = $this->db->get('tbl_task')->result();
		}
		$this->response($todos,200);
	}

	function index_post(){
		$data = array (
			'task' => $this ->post('task'),
			'date' => $this ->post('date')
		);

		$insert = $this ->db ->insert('tbl_task',$data);
		if($insert)
		{
			$this->response($data, 200);
		} else{
			$this->response(array('status' => 'fail', 502));
		}
	}

	/**
	* @api{PUT} / todo PUT List Todo
	* @apiName PutTodo
	* @apiGroup Todo
	*
	* @apiParam {Number} id Todo unique ID.
	*
	*/

	function index_put(){
		$id = $this -> get('id_task');
		$data = array(
			'task' => $this ->post('task'),
			'date' => $this ->post('task')
			);
		$this->db->where('id_task',$id);
		$update = $this->db->update('tbl_task',$data);
		if($update){
			$this->response($data, 200);
		} else{
			$this->response(array('status' => 'fail', 502));
		}
	}

	function index_delete(){
		$id = $this -> get('id_task');
		$this->db->where('id_task', $id);
		$delete = $this->db->delete('tbl_task');
		if($delete){
			$this->response(array($data, 200));
		} else{
			$this->response(array('status' => 'fail', 502));
		}
	}
}
