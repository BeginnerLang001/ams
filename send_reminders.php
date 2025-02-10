<?php
$_SERVER['HTTP_HOST'] = 'localhost'; // Set host manually if needed

// Load CodeIgniter framework
require_once 'index.php';

// Load controller
$CI =& get_instance();
$CI->load->controller('Appointments'); // Replace with actual controller name

// Call function
$CI->send_appointment_reminders();
