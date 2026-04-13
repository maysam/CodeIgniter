<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends CI_Model {

    public function get_approved_comments_for_post($post_id)
    {
        $this->db->where('post_id', (int) $post_id);
        $this->db->where('is_approved', 1);
        $this->db->order_by('created_at', 'ASC');
        return $this->db->get('comments')->result_array();
    }

    public function create_comment($data)
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert('comments', $data);
    }
}
