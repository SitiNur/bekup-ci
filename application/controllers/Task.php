<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('task_model','task');
	}
	public function index()
	{
		/*$data['task'] = $this->task_model->view();
		$this->load->view('task_view', $data);*/
		$this->load->helper('url');
        $this->load->view('task_view');
	}
 
    public function ajax_list()
    {
        $list = $this->task->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $t) {
            $no++;
            $row = array();
            $row[] = $t->task;
            $row[] = $t->date;
            $row[] = $t->time;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_task('."'".$t->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_task('."'".$t->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
         
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->task->count_all(),
                        "recordsFiltered" => $this->task->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->task->get_by_id($id);
        //$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $this->_validate();
        $data = array(
                'task' => $this->input->post('task'),
                'date' => $this->input->post('date'),
				'time' => $this->input->post('time'), 
          	);
        $insert = $this->task->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $this->_validate();
       	$data = array(
                'task' => $this->input->post('task'),
                'date' => $this->input->post('date'),
				'time' => $this->input->post('time'), 
          	);
        $id=$this->input->post('id');
        $this->task->update($id, $data);

        echo json_encode(array("status" => TRUE));	
    }
 
    public function ajax_delete($id)
    {
        $this->task->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }
 	
 	private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('task') == '')
        {
            $data['inputerror'][] = 'firstName';
            $data['error_string'][] = 'First name is required';
            $data['status'] = FALSE;
        }
 
        
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

	/*public function simpan(){
		$task = $this->input->post('task');
		$data = array(
					'task' => $task,
					'date' => date('Y-m-d'),
					'time' => date('H:i:s'), 
			);
		$table = 'tbl_task';
		$this->task_model->simpan($table,$data);
	}*/
}
