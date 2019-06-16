<?php
Class Session_Tutorial extends CI_Controller {

public function __construct() {
parent::__construct();
$this->load->helper('url');
// Load form helper library
$this->load->helper('form');

// Load session library
$this->load->library('session');

// Load validation library
$this->load->library('form_validation');
}

// Show session demo page
public function session_demo_page_show() {
$this->load->view('session_view');
}

// Set values in session
public function set_session_value() {
	$this->load->helper('security');
	// Check input validation
	$this->form_validation->set_rules('session_value', 'Session Value', 'trim|required|xss_clean');

	if ($this->form_validation->run() == FALSE) {
	$this->load->view('session_view');
	} else {

	// Create session array
	$sess_array = array(
	'set_value' => $this->input->post('session_value')
	);

	// Add user value in session
	$this->session->set_userdata('session_data', $sess_array);
	$data['message_display'] = 'Value Successfully Set in Session';
	$this->load->view('session_view', $data);
	}
}

// Read session values
public function read_session_value() {

// Read all session values
$set_data = $this->session->all_userdata();

if (isset($set_data['session_data']) && $set_data['session_data']['set_value'] != NULL) {
$data['read_set_value'] = 'Set Value : ' . $set_data['session_data']['set_value'];
} else {
$data['read_set_value'] = 'Please Set Session Value First !';
}
$this->load->view('session_view', $data);
}

// Unset set values from session
public function unset_session_value() {
$sess_array = array(
'set_value' => ''
);

// Removing values from session
$this->session->unset_userdata('session_data', $sess_array);
$data['message_display'] = 'Successfully Unset Session Set Value';
$this->load->view('session_view', $data);
}
}
?>