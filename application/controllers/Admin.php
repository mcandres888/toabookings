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

        $view_data['nav'][] = array("href" => $base  ."index.php/admin/slider", "class"=> "fa fa-clone", "text"=>"Slider");
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
    	  $this->load->view('admin/buses', $view_data);
		}

	}


   public function buses_list() {
       $this->load->model('buses');
       $bus = new buses();
       echo json_encode($bus->getList());
   }


/* S L I D E R
*/
public function slider() {
      $view_data = $this->init_view_data();

      if ($this->session->userdata('username') == "") {

        $this->load->view('login', $view_data);
        return;
        #$this->load->view('starter', $view_data);
      }
         // if action is get load view else post ( add to model )
         log_message("debug", "waaaaa");
         log_message("debug", $this->input->server('REQUEST_METHOD'));
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            log_message("debug", ">>>>>>>>>>>>> uploading slider Image");
            $this->upload_file();
            $this->load->model('Slider');
            $slider = new Slider();
            $slider->add_thru_post();
        }


      $subData['titleFirst'] = "Slider";
      $subData['titleSecond'] = "List";
      $subData['boxTitle'] = "Slider List Table";
      $subData['headers'] = array("Id", "Filename", "File URL", "Actions");
      $subData['data_url'] = base_url() . "index.php/admin/slider_list";

      $header  = array('action' => '' , 'method' => 'post', 'enctype' => 'multipart/form_data');
      /* FORM DATA */
      $form_data = array(
        array("type" => "hidden", "name" => "actionType", "value" => "addSlider"),
        array("type" => "text", "name" => "filename", "label" => "Filename"),
        array("type" => "file", "name" => "fileToUpload", "label" => "Select Image to Upload"),
      );


      $view_data['form_title'] = "Create Slider Image";
      $view_data['form'] = $this->createForm($header, $form_data, "Create Slider Image");
      $view_data['subData'] = $subData;
      $view_data['tableHtml'] = "template/table_withform.php";



      $this->load->view('admin/tableTemplate', $view_data);


}


 public function slider_list() {
     $this->load->model('Slider');
     $slider = new Slider();
     echo json_encode($slider->getList());
 }

 public function upload_file() {
    $config['upload_path']   = './uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']      = 100;
    $config['max_width']     = 1024;
    $config['max_height']    = 768;
    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('fileToUpload')) {
      $error = array('error' => $this->upload->display_errors());
      log_message("debug", ">>>>>>>>>> ERROR");
      log_message("debug", $error);
      return;
    }

    else {
      $data = array('upload_data' => $this->upload->data());
      log_message("debug", ">>>>>>>>>> UPLOAD OK");
      log_message("debug",$data);

      return;
    }
}

function createForm($header, $form_data, $btn_footer ) {
  $html_str = "<form role='form' action='" . $header['action'] ."' method='" . $header['method'].  "' enctype='". $header['enctype']."'>";
  $html_str .= "<div class='box-body'>";
  foreach ($form_data as $d) {
    $input_str = "";
    switch ($d['type']) {
      case 'text':
        $input_str = "<input type='text' class='form-control' id='".$d['name']."' name='".$d['name']."' placeholder='".$d['label']."' value='". (isset($d['value']) ? $d['value'] : '')."'>";
        break;
      case 'hidden':
        $html_str .= "<input type='hidden' id='".$d['name']."' name='".$d['name']."' value='".$d['value']."'>";
        break;
      case 'file':
        $input_str = "<input type='file' class='form-control' id='".$d['name']."' name='".$d['name']."'>";
        break;
      default:
        # code...
        break;
    }
    if ($d['type'] == "hidden") {
      continue;
    }

    $html_str .= "<div class='form-group'>";
    $html_str .= "<label for='".$d['name']."'>". $d['label']."</label>";
    $html_str .= $input_str;
    $html_str .= "</div>";

  }
  // add button
  $html_str .=  "<div class='box-footer'>";
  $html_str .= "<button type='submit' class='btn btn-primary'>". $btn_footer ."</button></div>";

  $html_str .= "</div></form>";
  return $html_str;
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
