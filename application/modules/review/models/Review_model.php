<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Review_model extends CI_Model {
    
    function getReview() {
        $query = $this->db->get('site_review')->result();
        return $query;
    }
    
    function insertReview($data) {
        $this->db->insert('site_review',$data);
    }
    
    function updateReview($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('site_review',$data);
    }
    
    function getReviewById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('site_review')->row();
        return $query;
    }
    
    function deleteReview($id) {
        $this->db->where('id', $id);
        $this->db->delete('site_review');
    }
    
    function getActiveReview() {
        $this->db->where('status','Active');
        $query = $this->db->get('site_review')->result();
        return $query;
    }
}