<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataSPPT extends CI_Controller {


    public function __construct(){

		parent :: __construct();
        if($this->session->userdata('username') == ''){
            redirect(base_url() . 'login');
		}
        $this->load->model("dataspptmodel");
	}

	public function index(){

        //pagination
        $config['base_url'] = site_url('datasppt/index');
		$config['total_rows'] = $this->db->count_all('data_pbb');
		$config['per_page'] = 10;
        $config['uri_segment'] = 3;
		$choice = $config['total_rows'] / $config['per_page'];
		$config['num_links'] = 3;

		$config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close']  = '</span></li>';
		
		$this->pagination->initialize($config);
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['datas'] = $this->dataspptmodel->fetchData($config['per_page'], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $data['content'] = 'contents/datasppt/index';

		$this->load->view('app', $data);
    }

    public function terimaPembayaran(){
        $data['datas'] = $this->dataspptmodel->fetchBelumBayar();
        $data['script'] = 'contents/datasppt/script';
        $data['content'] = 'contents/datasppt/terimapembayaran';

		$this->load->view('app', $data);
        
    }

    public function addForm(){
        
        $data['content'] = 'contents/datasppt/add';

		$this->load->view('app', $data);
    }

    public function addSave(){
        $this->form_validation->set_rules('nop', 'NOP', 'required|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('bumi', 'Luas Bumi/Tanah', 'required|numeric');
        $this->form_validation->set_rules('bangunan', 'Bangunan', 'required|numeric');
        $this->form_validation->set_rules('pajak', 'Jumlah Pajak', 'required|numeric');
        $this->form_validation->set_rules('alamat_op', 'Alamat Objek Pajak', 'required');
        $this->form_validation->set_rules('alamat_wp', 'Alamat Wajib Pajak', 'required');
        $this->form_validation->set_rules('ket', 'Keterangan', 'required');
        $this->form_validation->set_rules('nomor_hp', 'Nomor HP', 'required|numeric');
        $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required');
        
        if ($this->form_validation->run() == TRUE)
        {
            $data = array(
                'nop'=>$this->input->post('nop'),
                'nama'=>$this->input->post('nama'),
                'bumi'=>$this->input->post('bumi'),
                'bangunan'=>$this->input->post('bangunan'),
                'pajak'=>$this->input->post('pajak'),
                'alamat_op'=>$this->input->post('alamat_op'),
                'alamat_wp'=>$this->input->post('alamat_wp'),
                'nomor_hp'=>$this->input->post('nomor_hp'),
                'nama_petugas'=>$this->input->post('nama_petugas'),
                'ket'=>'Belum Bayar'

            );

            
                // print_r($data);
                $this->dataspptmodel->insertData($data);
                redirect(base_url() . 'datasppt/added');
        }else{
            $this->addForm();
        }
    }

    public function added(){
        $this->index();
    }

    public function editForm(){
        $id = $this->uri->segment(3);

        $data['data'] = $this->dataspptmodel->fetchSingle($id);
        $data['content'] = 'contents/datasppt/edit';

		$this->load->view('app', $data);

    }

    public function editSave(){
        
        $this->form_validation->set_rules('nop', 'NOP', 'required|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('bumi', 'Luas Bumi/Tanah', 'required|numeric');
        $this->form_validation->set_rules('bangunan', 'Bangunan', 'required|numeric');
        $this->form_validation->set_rules('pajak', 'Jumlah Pajak', 'required|numeric');
        $this->form_validation->set_rules('alamat_op', 'Alamat Objek Pajak', 'required');
        $this->form_validation->set_rules('alamat_wp', 'Alamat Wajib Pajak', 'required');
        $this->form_validation->set_rules('nomor_hp', 'Nomor HP', 'required|numeric');
        $this->form_validation->set_rules('ket', 'Keterangan', 'required');
        $this->form_validation->set_rules('nama_petugas', 'Nama Petugas', 'required');
        
        if ($this->form_validation->run() == TRUE)
        {
            $data = array(
                'id'=>$this->uri->segment(3),
                'nop'=>$this->input->post('nop'),
                'nama'=>$this->input->post('nama'),
                'bumi'=>$this->input->post('bumi'),
                'bangunan'=>$this->input->post('bangunan'),
                'pajak'=>$this->input->post('pajak'),
                'alamat_op'=>$this->input->post('alamat_op'),
                'alamat_wp'=>$this->input->post('alamat_wp'),
                'nomor_hp'=>$this->input->post('nomor_hp'),
                'nama_petugas'=>$this->input->post('nama_petugas'),
            );

            
                // print_r($data);
            $this->dataspptmodel->updateData($data);
            redirect(base_url() . 'datasppt/edited');
        }else{
            $this->editForm();
        }
    }
    public function edited(){
        $this->Index();
    }

    public function deleteData(){
		$id = $this->uri->segment(3);
		
		$this->dataspptmodel->deleteData($id);
        redirect(base_url() . 'datasppt/deleted');

    }

    public function deleted(){
        $this->index();
    }

    public function bayarPajak(){
        $id = $this->uri->segment(3);

        $data['data'] = $this->dataspptmodel->fetchSingle($id);
        $data['content'] = 'contents/datasppt/pajak';

		$this->load->view('app', $data);
    }

    public function bayarPajakSave(){
        
        $this->form_validation->set_rules('nop', 'NOP', 'required|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('pajak', 'Pajak', 'required|numeric');
        if ($this->form_validation->run() == TRUE)
        {
            $data = array(
                'nop'=>$this->input->post('nop'),
                'nama'=>$this->input->post('nama'),
                'pajak'=>$this->input->post('pajak'),
                'denda'=>$this->input->post('denda'),
                'total_pajak'=>$this->input->post('pajak') + $this->input->post('denda'),
                'tanggal'=>date('Y-m-d'),
                'ket'=>'Lunas',
                'id_petugas'=>$this->session->userdata('id'),
                'nm_petugas'=>$this->session->userdata('username'),
                'id_penyetor'=>0
            );

            //update datapbb
            $datapbb= array(
                'id'=>$this->uri->segment(3),
                'ket'=>'Lunas'
            );

            $this->dataspptmodel->insertDataBayar($data);
            $this->dataspptmodel->updateData($datapbb);

            redirect(base_url() . 'datasppt/bayar');
        }else{
            $this->bayarPajak();
        }
    }

    public function bayar(){
        $this->index();
    }
}