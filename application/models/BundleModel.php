<?php
class BundleModel extends CI_Model {
    public function __construct() {
        parent::__construct();
        // Load the database library
        $this->load->database();
    }

    public function insert_data($data) {
        // Insert data into the database
        $this->db->insert('ex_bundle_upload', $data);
        // Return the insert ID
        return $this->db->insert_id();
    }
}
