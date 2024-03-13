<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BundleController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // Load the upload form view
        $this->load->view('bundle/generation');
    }

    public function do_upload() {
        // Set up upload configuration
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100; // Maximum file size in kilobytes

        // Load the upload library
        $this->load->library('upload', $config);

        // Perform the upload
        $files = $_FILES['userfiles'];
        $file_count = count($files['name']);
        $success_count = 0;
        $failed_count = 0;

        for ($i = 0; $i < $file_count; $i++) {
            $_FILES['userfile']['name'] = $files['name'][$i];
            $_FILES['userfile']['type'] = $files['type'][$i];
            $_FILES['userfile']['tmp_name'] = $files['tmp_name'][$i];
            $_FILES['userfile']['error'] = $files['error'][$i];
            $_FILES['userfile']['size'] = $files['size'][$i];

            if ($this->upload->do_upload('userfile')) {
                $success_count++;
                $uploaded_files[] = $this->upload->data('full_path');
            } else {
                $failed_count++;
            }
        }

        // Generate datetime string
        $datetime = date('Y-m-d_H-i-s');
        // Create zip archive
        $zip_file = './uploads/uploaded_files_'.$datetime.'.zip'; // Specify zip file path
        foreach ($uploaded_files as $file) {
            $this->zip->read_file($file);
        }
        $this->zip->archive($zip_file);

        // Display upload result and download link for the zip file
        echo "Uploaded $success_count files successfully.<br>";
        echo "Failed to upload $failed_count files.<br>";
        echo "<a href='" . base_url($zip_file) . "'>Download Zip</a><br>";
        echo "<a href='" . base_url('BundleController') . "'>Go Back</a><br>";

    }
}
