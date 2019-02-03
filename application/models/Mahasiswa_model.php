<?php 

/**
 * 
 */
class Mahasiswa_model extends CI_Model
{
	
	// response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // mengambil semua data mahasiswa
  public function select_mahasiswa($nim){
	if ($nim=='') {
		$this->db->select('nim, nama, id_jurusan,alamat');
		$data = $this->db->get("tabel_mahasiswa")->result();	
	}else{
		$this->db->select('nim, nama, id_jurusan,alamat');
		$this->db->like('nim',$nim);
		$data= $this->db->get('tabel_mahasiswa')->result();
	}

    $response['status']=200;
    $response['error']=false;
    $response['mahasiswa']=$data;
    return $response;
	}

	public function add_mahasiswa($nim,$nama,$id_jurusan,$alamat)
	{
		if ( empty($nama) || empty($nim) || empty($id_jurusan) || empty($alamat) )
		{
			return $this->empty_response();
		}else{
			$data =  array(
				"nim" => $nim,
				"nama" => $nama,
				"id_jurusan" => $id_jurusan,
				"alamat" => $alamat 
				 );
			
			$insert= $this->db->insert("tabel_mahasiswa", $data);

			if($insert)
			{
        		$data = array(
        			'nim' => $nim,
        			 "nama" => $nama,
        			 "id_jurusan" => $id_jurusan,
        			 "alamat" => $alamat
        			);

        		$response['status']=200;
        		$response['error']=false;
        		$response['message']='Data person ditambahkan.';
        		$response['mahasiswa']=$data;
        		return $response;
      		}else{
        		$response['status']=502;
        		$response['error']=true;
        		$response['message']='Data person gagal ditambahkan.';
        	return $response;
      		}

		}


		
	}


	public function update_mahasiswa($nim,$nama,$id_jurusan,$alamat)
	{
		if ( empty($nama) || empty($nim) || empty($id_jurusan) || empty($alamat) )
		{
			return $this->empty_response();
		}else{
			$where = array('nim'=> $nim);

			$data =  array(
				"nim" => $nim,
				"nama" => $nama,
				"id_jurusan" => $id_jurusan,
				"alamat" => $alamat 
				 );
			$this->db->where($where);
			$update= $this->db->update("tabel_mahasiswa", $data);

			if($update)
			{
        		$response['status']=200;
        		$response['error']=false;
        		$response['message']='Data mahasiswa diubah.';
        		$response['mahasiswa']['nim']=$nim;
        		$response['mahasiswa']['nama']=$nama;
        		$response['mahasiswa']['id_jurusan']=$id_jurusan;
        		$response['mahasiswa']['alamat']=$alamat;
        		return $response;
      		}else{
        		$response['status']=502;
        		$response['error']=true;
        		$response['message']='Data mahasiswa gagal diubah.';
        	return $response;
      		}

		}

		
		
	}


	public function delete_mahasiswa($nim)
	{
		if ( empty($nim))
		{
			return $this->empty_response();
		}else{
			$where = array('nim'=> $nim);
			$this->db->where($where);
			$delete= $this->db->delete("tabel_mahasiswa");

			if($delete)
			{
        		$response['status']=200;
        		$response['error']=false;
        		$response['delete']=$delete;
        		$response['message']='Data mahasiswa dihapus.';
        		$response['mahasiswa']['nim']=$nim;
        		return $response;
      		}else{
        		$response['status']=502;
        		$response['error']=true;
        		$response['message']='Data mahasiswa gagal dihapus.';
        	return $response;
      		}

		}

		
		
	}

}

?>