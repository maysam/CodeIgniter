<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Blog_model extends CI_Model {

    public function get_published_posts()
    {
        $this->db->select('posts.*, users.display_name AS author_name');
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->where('posts.status', 'published');
        $this->db->order_by('posts.published_at', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_admin_posts()
    {
        $this->db->select('posts.*, users.display_name AS author_name');
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->order_by('posts.created_at', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_post_by_slug($slug)
    {
        $this->db->select('posts.*, users.display_name AS author_name');
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->where('posts.slug', $slug);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_post_by_id($post_id)
    {
        $this->db->where('id', (int) $post_id);
        $query = $this->db->get('posts');
        return $query->row_array();
    }

    public function create_post($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        return $this->db->insert('posts', $data);
    }

    public function update_post($post_id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = date('Y-m-d H:i:s');
        }

        $this->db->where('id', (int) $post_id);
        return $this->db->update('posts', $data);
    }

    public function delete_post($post_id)
    {
        $this->db->where('id', (int) $post_id);
        return $this->db->delete('posts');
    }

    public function slug_exists($slug, $exclude_post_id = NULL)
    {
        $this->db->where('slug', $slug);
        if (!empty($exclude_post_id)) {
            $this->db->where('id !=', (int) $exclude_post_id);
        }
        return $this->db->count_all_results('posts') > 0;
    }
}
