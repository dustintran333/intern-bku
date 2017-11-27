<?php
/**
 * Created by PhpStorm.
 * User: Phuc
 * Date: 25/11/2017
 * Time: 11:04 PM
 */
class Main extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->helper('url');
	}
	public function index()
	{
		$this->load->view("tpl/header.php");
		$this->load->view("pages/index.php");
		$this->load->view("tpl/footer.php");
	}
}