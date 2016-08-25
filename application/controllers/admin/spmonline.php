<?php
/*
* spmonline.php
* class di gunakan untuk koneksi antara silabun dengan REST API dari SPM Online
* 
*/
class SpmOnline extends Admin_Controller {
    public function __construct()
	{
		parent::__construct();
        $this->load->model('m_spmonline');
		
	}
    public function index() {
        $this->data['spmonline'] =$this->m_spmonline->getAll();
        $this->data['subview'] = 'admin/spmonline/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
        
    }
    public function edit($id=NULL) {
        $back_link = $this->uri->segment(2);
		// check existing jabatans or create one
		if ($id) {
			$this->data['id']			= $id;
			$this->data['spmonline'] 	= $this->m_spmonline->get($id);
			$this->data['back_link'] 	= $back_link;
			count($this->data['jabatans']) || $this->data['errors'][] = 'jabatan tidak dapat ditemukan';
		}
		else {
			$this->data['id']			= null;
			$this->data['spmonline'] 	= $this->m_spmonline->get_new();
			$this->data['back_link'] 	= $back_link;
		}
        
        $rules = $this->m_spmonline->rules;
		$this->form_validation->set_rules($rules);
        if ( $this->form_validation->run() == TRUE ) {
			// populate fields
			$data = $this->m_spmonline->array_from_post(array('url'));
				
			// save data
            //$id=NULL ?	$this->m_spmonline->save($data,$id) : $this->m_spmonline->update($data,$id);
            $this->m_spmonline->save($data,$id) ;
			// redirect to 
			redirect('admin/spmonline');
		}
        
        $this->data['subview'] = 'admin/spmonline/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
        
    }
    public function delete($id)
	{
		$this->m_spmonline->delete($id);
		redirect('admin/spmonline');
	}
    
    public function data() {
        if($this->data['id_entities'] === '1')
		{
            // get id_ref_kppn
			$this->load->model('m_referensi');
			$this->data['kppn'] = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
            $url=$this->m_spmonline->getAll();
            foreach($url as $uri) {
                $link=$uri->url;
            }
            $this->data['url']=$link;
            $this->data['subview'] = 'admin/spmonline/data';
            $this->load->view('admin/template/_layout_admin', $this->data); 
        } else {
            echo "Akses di tolak";
        }
       
        
    }
    public function rest_client() {
    
     $url =$this->input->post("url");  
        $url=$url.'?'.'token='.$this->input->post("token").'&kdkppn='.$this->input->post("kdkppn").'&bulan='.$this->input->post("bulan").'&tahun='.$this->input->post("tahun");
       
    $curl_handle = curl_init($url);
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
   
     
   
     
    $buffer = curl_exec($curl_handle);
       
    curl_close($curl_handle);
     
   
        echo  $buffer;
    }
    
}
?>