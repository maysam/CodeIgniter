<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function login()
    {
        if ($this->session->userdata('user_id')) {
            redirect('admin');
        }

        $data['title'] = 'Login';

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($this->input->post('username'));
            $password = $this->input->post('password');

            $user = $this->user_model->authenticate($username, $password);

            if (!empty($user)) {
                $this->session->set_userdata(array(
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'display_name' => $user['display_name'],
                    'role' => $user['role']
                ));

                redirect('admin');
            }

            $data['error'] = 'Invalid username or password.';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('auth/login', $data);
        $this->load->view('templates/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('blog');
    }
}
