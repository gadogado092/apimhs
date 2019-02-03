<?php
use Restserver\Libraries\REST_Controller;
require APPPATH . 'libraries/REST_Controller.php';


class Mahasiswa extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model');
	}

	public function index_get()
	{
		$nim=$this->get('nim',true);
		$response=$this->Mahasiswa_model->select_mahasiswa($nim);
		$this->response($response);
	}

	public function index_post()
	{
		$response=$this->Mahasiswa_model->add_mahasiswa(
					$this->post('nim'),
					$this->post('nama'),
					$this->post('id_jurusan'),
					$this->post('alamat')
					);

			

		/*$response['status']=200;
		$response['error']=false;
		$response['mahasiswa']=$this->post('nim');
		$response['mahasiswa2']=	$this->post('nama') ;*/
		
		$this->response($response);
	}

	public function index_put()
	{
		$response=$this->Mahasiswa_model->update_mahasiswa(
					$this->put('nim'),
					$this->put('nama'),
					$this->put('id_jurusan'),
					$this->put('alamat')
					);
		$this->response($response);
	}
	
	public function index_delete()
	{
		$response=$this->Mahasiswa_model->delete_mahasiswa(
					$this->delete('nim')
					);
		$this->response($response);
	}

	/*public function user_get(){
		$response['status']=200;
		$response['error']=false;
		$response['mahasiswa']['nim']='E1E111068';
		$response['mahasiswa']['nama']='udin';
		$response['mahasiswa']['umur']=26;

		$this->response($response);
	}*/

}


?>