<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


    public function init_view_data() {
		$view_data['username'] = $this->session->userdata('username');
		$view_data['usertype'] = $this->session->userdata('usertype');


        $view_data['error'] = "";
        $view_data['config']['title1'] = "TOA";
        $view_data['config']['title2'] = "Bookings";

        $view_data['nav'] = array();
        $base = base_url();

        $view_data['nav'][] = array("href" => $base  ."index.php/main/merchants", "class"=> "fa fa-bus", "text"=>"Merchants");
        $view_data['nav'][] = array("href" => $base  ."index.php/main/rooms", "class"=> "fa fa-calendar", "text"=>"Rooms");
        $view_data['nav'][] = array("href" => $base  ."index.php/main/users", "class"=> "fa fa-map-marker", "text"=>"Users");
 //       $view_data['nav'][] = array("href" => $base  ."index.php/main/users", "class"=> "fa fa-users", "text"=>"Users");


        return $view_data;
	}

	public function buses() {
        $view_data = $this->init_view_data();

        if ($this->session->userdata('username') == "") {

        	$this->load->view('login', $view_data);
        	#$this->load->view('starter', $view_data);
        } else {
           // if action is get load view else post ( add to model )
          if ($this->input->server('REQUEST_METHOD') == 'POST') {
              log_message("debug", "create bus");
              $this->load->model('buses');
              $bus = new buses();
              $bus->add_thru_post();
          }
          $view_data['ajaxtable'] = base_url() . "index.php/main/buses_list";
    	  $this->load->view('buses', $view_data);
		}

	}


   public function buses_list() {
       $this->load->model('buses');
       $bus = new buses();
       echo json_encode($bus->getList());
   }


	public function index() {
        $view_data = $this->init_view_data();

        if ($this->session->userdata('username') == "") {

        	$this->load->view('admin/login', $view_data);
        	#$this->load->view('starter', $view_data);
        } else {
    	   // $this->load->view('main', $view_data);

    	  $this->load->view('admin/main', $view_data);
		}

	}

  public function getsentitems () {
    $this->load->model('sentitems');
    $inc = new sentitems();
		$incident_data = $inc->getAll();

    echo json_encode($incident_data);

	}



  public function getIncidentJSON () {
    $this->load->model('incident_types');
    $inc = new incident_types();
		$incident_data = $inc->getIncidentJSON();

    echo json_encode($incident_data);

	}

  public function verify()
  {

    $this->load->model('user');
    $user = new user();

    $username = $this->input->post('username');
    $password = $this->input->post('password');

    log_message("debug", "verify");
    $view_data = $this->init_view_data();
    if ( $user->isPasswordOk($username, $password) ) {

      $userInfo = $user->getUserInfo($username, $password);
      $this->session->set_userdata('username', $username);
      $this->session->set_userdata('usertype', $userInfo->type);
      $this->session->set_userdata('userid', $userInfo->id);
      $this->session->set_userdata('login_state', TRUE);


      $temp  = site_url() . "/admin" ;
	  redirect($temp);

    } else {
      $view_data['error'] = "Incorrect Username/Password!";
      $this->session->set_userdata('page', "");
      $this->load->view('admin/login', $view_data);

    }

  }


  public function logout()
  {

    $this->session->sess_destroy();
    $this->session->set_userdata('login_state', FALSE);
    $this->session->set_userdata('username', "");
    $this->session->set_userdata('usertype', "");

		$temp  = base_url() . "" ;
		redirect($temp);
  }

















}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
