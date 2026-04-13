<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('blog_model');
    }

    public function index()
    {
        $this->require_auth();

        $data['title'] = 'Admin Dashboard';
        $data['posts'] = $this->blog_model->get_admin_posts();

        $this->load->view('templates/header', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $this->require_auth();

        $data['title'] = 'Create Post';
        $data['post'] = array(
            'title' => '',
            'slug' => '',
            'excerpt' => '',
            'body' => '',
            'status' => 'draft',
            'published_at' => ''
        );
        $data['errors'] = array();

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_data = $this->collect_post_data();
            $data['post'] = $post_data;
            $data['errors'] = $this->validate_post_data($post_data);

            if (empty($data['errors'])) {
                $post_data['user_id'] = $this->session->userdata('user_id');
                $this->blog_model->create_post($post_data);
                redirect('admin');
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/form', $data);
        $this->load->view('templates/footer');
    }

    public function edit($post_id)
    {
        $this->require_auth();

        $post = $this->blog_model->get_post_by_id($post_id);
        if (empty($post)) {
            show_404();
        }

        $data['title'] = 'Edit Post';
        $data['post'] = $post;
        $data['errors'] = array();

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $post_data = $this->collect_post_data();
            $data['post'] = array_merge($post, $post_data);
            $data['errors'] = $this->validate_post_data($post_data, $post['id']);

            if (empty($data['errors'])) {
                $this->blog_model->update_post($post['id'], $post_data);
                redirect('admin');
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('admin/form', $data);
        $this->load->view('templates/footer');
    }

    public function delete($post_id)
    {
        $this->require_auth();
        $this->blog_model->delete_post($post_id);
        redirect('admin');
    }

    private function require_auth()
    {
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
    }

    private function collect_post_data()
    {
        return array(
            'title' => trim($this->input->post('title')),
            'slug' => trim($this->input->post('slug')),
            'excerpt' => trim($this->input->post('excerpt')),
            'body' => trim($this->input->post('body')),
            'status' => $this->input->post('status') === 'published' ? 'published' : 'draft',
            'published_at' => trim($this->input->post('published_at'))
        );
    }

    private function validate_post_data($data, $exclude_post_id = NULL)
    {
        $errors = array();

        if ($data['title'] === '') {
            $errors[] = 'Title is required.';
        }

        if ($data['slug'] === '') {
            $errors[] = 'Slug is required.';
        }

        if ($data['slug'] !== '' && $this->blog_model->slug_exists($data['slug'], $exclude_post_id)) {
            $errors[] = 'Slug already exists.';
        }

        if ($data['body'] === '') {
            $errors[] = 'Body is required.';
        }

        return $errors;
    }
}
