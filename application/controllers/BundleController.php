<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BundleController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('BundleModel');
    }

    public function index() {
        // Load the upload form view
        $this->load->view('bundle/generation');
    }

    public function upload_zip_view(){

        // Fetch options for select menus from the database

        $data['schid_options'] = array(
            array("id" => 1, "name" => "asd"),
            array("id" => 2, "name" => "xyz"),
            // Add more options as needed
        );
         // Replace with your actual table name
        $data['programid_options'] =  array(
            array("id" => 1, "name" => "asd"),
            array("id" => 2, "name" => "xyz"),
            // Add more options as needed
        ); // Replace with your actual table name
        $data['sectionid_options'] =  array(
            array("id" => 1, "name" => "asd"),
            array("id" => 2, "name" => "xyz"),
            // Add more options as needed
        ); // Replace with your actual table name
        $data['examid_options'] =  array(
            array("id" => 1, "name" => "asd"),
            array("id" => 2, "name" => "xyz"),
            // Add more options as needed
        ); // Replace with your actual table name
        $data['subjectid_options'] =  array(
            array("id" => 1, "name" => "asd"),
            array("id" => 2, "name" => "xyz"),
            // Add more options as needed
        ); // Replace with your actual table name

        $data['status'] =  array(
            array("id" => 1, "name" => "Active"),
            array("id" => 2, "name" => "Inactive"),
            // Add more options as needed
        ); // Replace with your actual table name


        // print_r($data);
        $this->load->view('bundle/upload_zip_view', $data);
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

    public function bundle_upload(){
        $this->load->view('bundle/bundle_upload');
    }


    public function bundle_insert_data() {
        // Get the data from the request
        $data = array(
            'id' => $this->input->post('id'),
            'schid' => $this->input->post('schid'),
            'programid' => $this->input->post('programid'),
            'sectionid' => $this->input->post('sectionid'),
            'examid' => $this->input->post('examid'),
            'subjectid' => $this->input->post('subjectid'),
            'bundlepath' => $this->input->post('bundlepath'),
            'status' => $this->input->post('status'),
            'createdby' => $this->input->post('createdby'),
            'createddatetime' => $this->input->post('createddatetime')
        );

        // Insert data into the database
        $insert_id = $this->your_model->insert_data($data);

        // Check if the insertion was successful
        if ($insert_id) {
            // Data inserted successfully
            echo "Data inserted successfully. Insert ID: " . $insert_id."<br>";
        echo "<a href='" . base_url('BundleController') . "'>Go Back</a><br>";

        } else {
            // Error occurred while inserting data
            echo "Error occurred while inserting data.<br>";
        echo "<a href='" . base_url('BundleController') . "'>Go Back</a><br>";

        }
    }


    public function upload_zip() {
        // Configuration for file upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'zip';
        $config['max_size'] = 1024 * 10; // 10 MB

        // Load the upload library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('zip_file')) {
            // Upload failed
            $error = $this->upload->display_errors();
            echo $error;
        } else {
            // Upload successful, extract zip file
            $zip_path = './uploads/' . $_FILES['zip_file']['name'];
            $extract_path = './uploads/extracted/';
// ------------------------------------------------------------------------------
// Get form data
$data = array(
    'schid' => $this->input->post('schid'),
    'programid' => $this->input->post('programid'),
    'sectionid' => $this->input->post('sectionid'),
    'examid' => $this->input->post('examid'),
    'subjectid' => $this->input->post('subjectid'),
    'bundlepath' => '/uploads/' . $_FILES['zip_file']['name'],
    'status' => $this->input->post('status'),
    'createdby' =>  "createdby",// $this->input->post('createdby'),
    // 'createddatetime' => // $this->input->post('createddatetime')
);

// Insert data into the database
$insert_id = $this->BundleModel->insert_data($data);

// Check if insertion was successful
if ($insert_id) {
    // Insertion successful, do something with the insert ID
    echo "Data inserted successfully. Insert ID: " . $insert_id;
} else {
    // Insertion failed
    echo "Failed to insert data.";
}
// --------------------------------------------------------------------------------
            $zip = new ZipArchive;
            if ($zip->open($zip_path) === TRUE) {
                $zip->extractTo($extract_path);
                $zip->close();

                // Get list of extracted files
                $files = scandir($extract_path);

                // Insert file names into database table
                foreach ($files as $file) {
                    if ($file !== '.' && $file !== '..') {
                        $data = array(
                            'booklet_path' => $extract_path.$file,
                            'schid' => $this->input->post('schid'),
                            'bundleid' => $insert_id,
                            'status' => $this->input->post('status'),
                            'createdby' =>  "createdby",

                        );
                        // print_r($data);
                        $this->db->insert('ex_bundle_upload_details', $data); // Adjust table name
                    }
                }

                echo "Zip file uploaded and extracted successfully.";
            } else {
                echo "Failed to extract zip file.";
            }
        }
    }

}
