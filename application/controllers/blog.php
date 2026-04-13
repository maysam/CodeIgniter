<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('blog_model');
        $this->load->model('comment_model');
    }

    public function index()
    {
        $data['title'] = 'Training Weblog';
        $data['posts'] = $this->blog_model->get_published_posts();

        $this->load->view('templates/header', $data);
        $this->load->view('blog/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($slug = NULL)
    {
        $post = $this->blog_model->get_post_by_slug($slug);

        if (empty($post)) {
            show_404();
        }

        if ($post['status'] !== 'published') {
            show_404();
        }

        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->create_comment($post['id']);
            redirect('blog/'.$slug);
        }

        $data['title'] = $post['title'];
        $data['post'] = $post;
        $data['comments'] = $this->comment_model->get_approved_comments_for_post($post['id']);

        $this->load->view('templates/header', $data);
        $this->load->view('blog/view', $data);
        $this->load->view('templates/footer');
    }

    private function create_comment($post_id)
    {
        $author_name = trim($this->input->post('author_name'));
        $author_email = trim($this->input->post('author_email'));
        $body = trim($this->input->post('body'));

        if ($author_name === '' || $author_email === '' || $body === '') {
            return;
        }

        $this->comment_model->create_comment(array(
            'post_id' => (int) $post_id,
            'author_name' => $author_name,
            'author_email' => $author_email,
            'body' => $body,
            'is_approved' => 1
        ));
    }
}
