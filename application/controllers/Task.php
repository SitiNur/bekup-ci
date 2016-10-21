<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('task_model');
	}
	public function index()
	{
		$data['task'] = $this->task_model->view();
		$this->load->view('task_view', $data);
	}

	public function simpan(){
		$task = $this->input->post('task');
		$data = array(
					'task' => $task,
					'date' => date('Y-m-d'),
					'time' => date('H:i:s'), 
			);
		$table = 'tbl_task';
		$this->task_model->simpan($table,$data);
	}
}
