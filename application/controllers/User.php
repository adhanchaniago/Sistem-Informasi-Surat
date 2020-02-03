<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('keluar_model');
        $this->load->model('masuk_model'); 

    }

    public function asd($id)
    {
        $data['title']='View Surat';
        $imuk=$this->masuk_model->get($id)->surat;
        redirect(base_url("assets/pdf/").$imuk);
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
        
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']      = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user');
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profil anda berhasil diubah</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Passowrd baru tidak boleh sama dengan password lama</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function disposisi()
    {
        $data['title'] = 'Disposisi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Disposisi_model', 'menu');
    
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('disposisi')->result_array();
    
        $this->form_validation->set_rules('surat_dari', 'surat_dari', 'required');
        $this->form_validation->set_rules('no_surat', 'no_surat', 'required');
        $this->form_validation->set_rules('tgl_surat', 'tgl_surat', 'required');
        $this->form_validation->set_rules('tgl_terima', 'tgl_terima', 'required');
        $this->form_validation->set_rules('sifat', 'sifat', 'required');
        $this->form_validation->set_rules('perihal', 'perihal', 'required');
        $this->form_validation->set_rules('teruskan', 'teruskan', 'required');
    
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/disposisi', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'surat_dari' => $this->input->post('surat_dari'),
                'no_surat' => $this->input->post('no_surat'),
                'tgl_surat' => $this->input->post('tgl_surat'),
                'tgl_terima' => $this->input->post('tgl_terima'),
                'sifat' => $this->input->post('sifat'),
                'perihal' => $this->input->post('perihal'),
                'teruskan' => $this->input->post('teruskan'),
            ];
                
            $this->db->insert('disposisi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data baru berhasil ditambahkan</div>');
            redirect('user/disposisi');
        }
    }

    public function updatedisposisi()
    {
        $data['title'] = 'Disposisi';
        $data['menu'] = $this->db->get('disposisi')->result_array();
        $id=$this->input->post('id');

        $this->form_validation->set_rules('surat_dari', 'surat_dari', 'required');
        $this->form_validation->set_rules('no_surat', 'no_surat', 'required');
        $this->form_validation->set_rules('tgl_surat', 'tgl_surat', 'required');
        $this->form_validation->set_rules('tgl_terima', 'tgl_terima', 'required');
        $this->form_validation->set_rules('sifat', 'sifat', 'required');
        $this->form_validation->set_rules('perihal', 'perihal', 'required');
        $this->form_validation->set_rules('teruskan', 'teruskan', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/updatedisposisi', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'surat_dari' => $this->input->post('surat_dari'),
                'no_surat' => $this->input->post('no_surat'),
                'tgl_surat' => $this->input->post('tgl_surat'),
                'tgl_terima' => $this->input->post('tgl_terima'),
                'sifat' => $this->input->post('sifat'),
                'perihal' => $this->input->post('perihal'),
                'teruskan' => $this->input->post('teruskan'),
            ];
            $this->db->set('surat_dari', $data);
            $this->db->set('no_surat', $data);
            $this->db->set('tgl_surat', $data);
            $this->db->set('tgl_terima', $data);
            $this->db->set('sifat', $data);
            $this->db->set('perihal', $data);
            $this->db->set('teruskan', $data);
            $this->db->where('id', $id);
            $this->db->update('disposisi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Disposisi berhasil diupdate</div>');
            redirect('user/disposisi');
        }
    }

    public function deleteDisposisi($idsurat)
    {           
        $result = $this->disposisi_model->deleteDisposisi($idsurat);
        redirect('user/suratkeluar');
    }

    public function suratkeluar()
    {
        $data['title'] = 'Surat Keluar';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Keluar_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('surat_keluar')->result_array();

        $this->form_validation->set_rules('no_surat', 'no_surat', 'required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('tujuan', 'tujuan', 'required');
        $this->form_validation->set_rules('perihal', 'perihal', 'required');
        $this->form_validation->set_rules('lokasi', 'lokasi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/suratkeluar', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'no_surat' => $this->input->post('no_surat'),
                'tanggal' => $this->input->post('tanggal'),
                'tujuan' => $this->input->post('tujuan'),
                'perihal' => $this->input->post('perihal'),
                'lokasi' => $this->input->post('lokasi')
            ];
            $this->db->insert('surat_keluar', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Surat berhasil ditambahkan</div>');
            redirect('user/suratkeluar');
        }
    }

    public function updatesuratkeluar()
    {
        $data['title'] = 'Surat Keluar';
        $data['menu'] = $this->db->get('surat_keluar')->result_array();
        $id=$this->input->post('id');

        $this->form_validation->set_rules('no_surat', 'no_surat', 'required|trim');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required|trim');
        $this->form_validation->set_rules('tujuan', 'tujuan', 'required|trim');
        $this->form_validation->set_rules('perihal', 'perihal', 'required|trim');
        $this->form_validation->set_rules('lokasi', 'lokasi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/updatesuratkeluar', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'no_surat' => $this->input->post('no_surat'),
                'tanggal' => $this->input->post('tanggal'),
                'tujuan' => $this->input->post('tujuan'),
                'perihal' => $this->input->post('perihal'),
                'lokasi' => $this->input->post('lokasi')
            ];
            $this->db->set('no_surat', $data);
            $this->db->set('tanggal', $data);
            $this->db->set('tujuan', $data);
            $this->db->set('perihal', $data);
            $this->db->set('lokasi', $data);
            $this->db->where('id', $id);
            $this->db->update('surat_keluar', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Surat berhasil diupdate</div>');
            redirect('user/suratkeluar');
        }
    }

    public function deleteSurat($idsurat)
    {           
        $result = $this->keluar_model->deleteSurat($idsurat);
        redirect('user/suratkeluar');
    }

public function suratmasuk()
    {
        $data['title'] = 'Surat Masuk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Masuk_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('surat_masuk')->result_array();

        $this->form_validation->set_rules('no_surat', 'no_surat', 'required');
        $this->form_validation->set_rules('tgl_surat', 'tgl_surat', 'required');
        $this->form_validation->set_rules('tgl_terima', 'tgl_terima', 'required');
        $this->form_validation->set_rules('asal', 'asal', 'required');
        $this->form_validation->set_rules('sifat', 'sifat', 'required');
        $this->form_validation->set_rules('perihal', 'perihal', 'required');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/suratmasuk', $data);
            $this->load->view('templates/footer');
        } else {
            $nama_surat = $data['user']->id."_".$data['user']->name."_".date('D-H-M-S').".pdf";

            $config['allowed_types'] = 'pdf';
            $config['max_size']      = '20480';
            $config['upload_path'] = './assets/pdf/';
            $config['file_name'] = $nama_surat;

            $this->load->library('upload', $config);
            print_r($this->input->post('surat2'));
            print_r($_FILES['surat2']);
            if ($this->upload->do_upload('surat2')) {
            } else {
                die($this->upload->display_errors());
            }


            $data = [
                'no_surat'      => $this->input->post('no_surat'),
                'tgl_surat'     => $this->input->post('tgl_surat'),
                'tgl_terima'    => $this->input->post('tgl_terima'),
                'asal'          => $this->input->post('asal'),
                'sifat'         => $this->input->post('sifat'),
                'perihal'       => $this->input->post('perihal'),
                'surat'         => $nama_surat
            ];

            $this->db->insert('surat_masuk', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Surat berhasil ditambahkan</div>');
            redirect('user/suratmasuk');
        }
    }

    public function updatesuratmasuk()
    {    
        $data['title'] = 'Update Surat Masuk';
        $data['menu'] = $this->db->get('surat_masuk')->result_array();
        $id=$this->input->post('id');
        $this->form_validation->set_rules('no_surat', 'no_surat', 'required');
        $this->form_validation->set_rules('tgl_surat', 'tgl_surat', 'required');
        $this->form_validation->set_rules('tgl_terima', 'tgl_terima', 'required');
        $this->form_validation->set_rules('asal', 'asal', 'required');
        $this->form_validation->set_rules('sifat', 'sifat', 'required');
        $this->form_validation->set_rules('perihal', 'perihal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/suratmasuk', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'no_surat' => $this->input->post('no_surat'),
                'tgl_surat' => $this->input->post('tgl_surat'),
                'tgl_terima' => $this->input->post('tgl_terima'),
                'asal' => $this->input->post('asal'),
                'sifat' => $this->input->post('sifat'),
                'perihal' => $this->input->post('perihal'),
            ];
            $this->db->set('no_surat', $data);
            $this->db->set('tgl_surat', $data);
            $this->db->set('tgl_terima', $data);
            $this->db->set('asal', $data);
            $this->db->set('sifat', $data);
            $this->db->set('perihal', $data);
            $this->db->where('id', $id);
            $this->db->update('surat_masuk', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Surat berhasil diupdate</div>');
            redirect('user/suratmasuk');
        }
    }

    public function deleteSuratMasuk($idsurat)
    {           
        $result = $this->masuk_model->deleteSuratMasuk($idsurat);
        redirect('user/suratmasuk');
    }
    
}
?>