<?php 
// Header view
$this->load->view('templates/layouts/'.$header_content['load_view'],$header_content);
// Main container view
$this->load->view($main_content['load_view'],$main_content);
// Footer view
$this->load->view('templates/layouts/'.$footer_content['load_view'],$footer_content);