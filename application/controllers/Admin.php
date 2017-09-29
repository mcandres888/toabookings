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


   	public function index() {
           $view_data = $this->init_view_data();

           if ($this->session->userdata('username') == "") {

           	$this->load->view('admin/login', $view_data);
           	#$this->load->view('starter', $view_data);
           } else {
       	   // $this->load->view('main', $view_data);
           if  ($this->session->userdata('usertype') == "admin" ) {
             $this->load->view('admin/dashboard', $view_data);
           } else {
       	     $this->load->view('admin/merchant_dashboard', $view_data);
           }
   		}

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


         if  ($this->session->userdata('usertype') == "admin" ) {
           $temp  = site_url() . "/admin/dashboard" ;
         } else {
            $temp  = site_url() . "/admin/merchant_dashboard" ;
         }

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
  public function init_view_data() {
		$view_data['username'] = $this->session->userdata('username');
		$view_data['usertype'] = $this->session->userdata('usertype');


    $view_data['error'] = "";
    $view_data['config']['title1'] = "TOA";
    $view_data['config']['title2'] = "Bookings";

    $view_data['nav'] = array();
    $base = base_url();


    // nav bar is based on usertype
    if ($view_data['usertype'] == "admin") {

      $view_data['nav'][] = array("href" => $base  ."index.php/admin/dashboard", "class"=> "fa fa-line-chart", "text"=>"Dashboard");
      $view_data['nav'][] = array("href" => $base  ."index.php/admin/slider", "class"=> "fa fa-clone", "text"=>"Slider");
      $view_data['nav'][] = array("href" => $base  ."index.php/admin/gallery", "class"=> "fa fa-clone", "text"=>"Gallery");
      $view_data['nav'][] = array("href" => $base  ."index.php/admin/merchants_for_approval", "class"=> "fa fa-user-times", "text"=>"Merchants for Approval");
      $view_data['nav'][] = array("href" => $base  ."index.php/admin/approved_merchants", "class"=> "fa fa-check-circle-o", "text"=>"Approved Merchants");
      $view_data['nav'][] = array("href" => $base  ."index.php/admin/room_types", "class"=> "fa fa-calendar", "text"=>"Rooms Types");
      $view_data['nav'][] = array("href" => $base  ."index.php/admin/users", "class"=> "fa fa-user", "text"=>"Users");


    } else if ($view_data['usertype'] == "merchant") {

      $view_data['nav'][] = array("href" => $base  ."index.php/admin/merchant_dashboard", "class"=> "fa fa-line-chart", "text"=>"Dashboard");
      $view_data['nav'][] = array("href" => $base  ."index.php/admin/bookings", "class"=> "fa fa-ticket", "text"=>"Requested Bookings");
      $view_data['nav'][] = array("href" => $base  ."index.php/admin/rooms", "class"=> "fa fa-hotel", "text"=>"Rooms");
      //$view_data['nav'][] = array("href" => $base  ."index.php/admin/room_schedules", "class"=> "fa fa-calendar", "text"=>"Schedules");
      $view_data['nav'][] = array("href" => $base  ."index.php/admin/merchant_profile", "class"=> "fa fa-fax", "text"=>"Profile");
    }
        return $view_data;
	}


  public function merchant_dashboard() {
        $view_data = $this->init_view_data();

        if ($this->session->userdata('username') == "") {

          $this->load->view('login', $view_data);
          return;
          #$this->load->view('starter', $view_data);
        }

        $subData['titleFirst'] = "Merchants";
        $subData['titleSecond'] = "List";
        $subData['boxTitle'] = "For Approval List Table";
        $subData['headers'] = array("Username", "Hotel Name", "Email", "Actions");
        $subData['data_url'] = base_url() . "index.php/admin/merchants_list?status=0";

        $view_data['subData'] = $subData;
        $view_data['tableHtml'] = "template/table.php";
        $this->load->view('admin/dashboard', $view_data);
  }

  public function dashboard() {
        $view_data = $this->init_view_data();

        if ($this->session->userdata('username') == "") {

          $this->load->view('login', $view_data);
          return;
          #$this->load->view('starter', $view_data);
        }

        $subData['titleFirst'] = "Merchants";
        $subData['titleSecond'] = "List";
        $subData['boxTitle'] = "For Approval List Table";
        $subData['headers'] = array("Username", "Hotel Name", "Email", "Actions");
        $subData['data_url'] = base_url() . "index.php/admin/merchants_list?status=0";

        $view_data['subData'] = $subData;
        $view_data['tableHtml'] = "template/table.php";
        $this->load->view('admin/dashboard', $view_data);
  }

/*  MERCHANTS TABLE
*/
  public function bookings() {
      $view_data = $this->init_view_data();

      if ($this->session->userdata('username') == "") {

        $this->load->view('login', $view_data);
        return;
        #$this->load->view('starter', $view_data);
      }

      $subData['titleFirst'] = "Bookings";
      $subData['titleSecond'] = "List";
      $subData['boxTitle'] = "Bookings List Table";
      $subData['headers'] = array("Username", "Room", "Check In", "Check Out", "Actions");
      $subData['data_url'] = base_url() . "index.php/admin/merchants_list?status=0";

      $view_data['subData'] = $subData;
      $view_data['tableHtml'] = "template/table.php";
      $this->load->view('admin/tableTemplate', $view_data);
  }

  public function rooms() {
      $view_data = $this->init_view_data();

      if ($this->session->userdata('username') == "") {

        $this->load->view('login', $view_data);
        return;
        #$this->load->view('starter', $view_data);
      }

      $subData['titleFirst'] = "Rooms";
      $subData['titleSecond'] = "List";
      $subData['boxTitle'] = "Rooms List Table";
      $subData['headers'] = array("Room", "No. Available", "Booked", "Details", "Actions");
      $subData['data_url'] = base_url() . "index.php/admin/merchants_list?status=0";

      $view_data['subData'] = $subData;
      $view_data['tableHtml'] = "template/table.php";
      $this->load->view('admin/tableTemplate', $view_data);
  }

  public function merchant_profile() {
      $view_data = $this->init_view_data();

      if ($this->session->userdata('username') == "") {

        $this->load->view('login', $view_data);
        return;
        #$this->load->view('starter', $view_data);
      }

      $subData['titleFirst'] = "Rooms";
      $subData['titleSecond'] = "List";
      $subData['boxTitle'] = "Rooms List Table";
      $subData['headers'] = array("Room", "No. Available", "Booked", "Details", "Actions");
      $subData['data_url'] = base_url() . "index.php/admin/merchants_list?status=0";

      $view_data['subData'] = $subData;
      $view_data['tableHtml'] = "template/table.php";
      $this->load->view('admin/main', $view_data);
  }




   /* M E R C H A N T S   F O R   A P P R O V A L
   */
   public function merchants_for_approval() {
         $view_data = $this->init_view_data();

         if ($this->session->userdata('username') == "") {

           $this->load->view('login', $view_data);
           return;
           #$this->load->view('starter', $view_data);
         }

         $subData['titleFirst'] = "Merchants";
         $subData['titleSecond'] = "List";
         $subData['boxTitle'] = "For Approval List Table";
         $subData['headers'] = array("Username", "Hotel Name", "Email", "Actions");
         $subData['data_url'] = base_url() . "index.php/admin/merchants_list?status=0";

         $view_data['subData'] = $subData;
         $view_data['tableHtml'] = "template/table.php";
         $this->load->view('admin/tableTemplate', $view_data);
   }

   public function approved_merchants() {
         $view_data = $this->init_view_data();

         if ($this->session->userdata('username') == "") {

           $this->load->view('login', $view_data);
           return;
           #$this->load->view('starter', $view_data);
         }

         $subData['titleFirst'] = "Merchants";
         $subData['titleSecond'] = "List";
         $subData['boxTitle'] = "Approved Merchants List Table";
         $subData['headers'] = array("Username", "Hotel Name", "Email", "Actions");
         $subData['data_url'] = base_url() . "index.php/admin/merchants_list?status=0";

         $view_data['subData'] = $subData;
         $view_data['tableHtml'] = "template/table.php";
         $this->load->view('admin/tableTemplate', $view_data);
   }

    public function merchants_list() {
        $this->load->model('Slider');
        $slider = new Slider();
        echo json_encode($slider->getList());
    }


    /* M E R C H A N T S   F O R   A P P R O V A L
    */
    public function users() {
          $view_data = $this->init_view_data();

          if ($this->session->userdata('username') == "") {

            $this->load->view('login', $view_data);
            return;
            #$this->load->view('starter', $view_data);
          }

          $subData['titleFirst'] = "Users";
          $subData['titleSecond'] = "List";
          $subData['boxTitle'] = "Users List Table";
          $subData['headers'] = array("Username", "Name", "Email", "Actions");
          $subData['data_url'] = base_url() . "index.php/admin/users_list";

          $view_data['subData'] = $subData;
          $view_data['tableHtml'] = "template/table.php";
          $this->load->view('admin/tableTemplate', $view_data);
    }



     public function users_list() {
         $this->load->model('Slider');
         $slider = new Slider();
         echo json_encode($slider->getList());
     }

    /* R O O M  T Y P E S
    */
    public function room_types() {
          $view_data = $this->init_view_data();

          if ($this->session->userdata('username') == "") {

            $this->load->view('login', $view_data);
            return;
            #$this->load->view('starter', $view_data);
          }

            if ($this->input->server('REQUEST_METHOD') == 'POST') {
                log_message("debug", ">>>>>>>>>>>>> uploading slider Image");
                $this->upload_file();
              /*  $this->load->model('Slider');
                $slider = new Slider();
                $slider->add_thru_post();
                */
            }


          $subData['titleFirst'] = "Room Types";
          $subData['titleSecond'] = "List";
          $subData['boxTitle'] = "Room Types List Table";
          $subData['headers'] = array("Id", "Filename", "File URL", "Actions");
          $subData['data_url'] = base_url() . "index.php/admin/room_types_list";

          $header  = array('action' => '' , 'method' => 'post', 'enctype' => 'multipart/form_data');
          /* FORM DATA */
          $form_data = array(
            array("type" => "hidden", "name" => "actionType", "value" => "addSlider"),
            array("type" => "text", "name" => "filename", "label" => "Filename"),
            array("type" => "file", "name" => "fileToUpload", "label" => "Select Image to Upload"),
          );


          $view_data['form_title'] = "Create Room Types";
          $view_data['form'] = $this->createForm($header, $form_data, "Create Slider Image");
          $view_data['subData'] = $subData;
          $view_data['tableHtml'] = "template/table_withform.php";



          $this->load->view('admin/tableTemplate', $view_data);


    }


     public function room_types_list() {
         $this->load->model('Slider');
         $slider = new Slider();
         echo json_encode($slider->getList());
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

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            log_message("debug", ">>>>>>>>>>>>> uploading slider Image");
            $this->upload_file();
          /*  $this->load->model('Slider');
            $slider = new Slider();
            $slider->add_thru_post();
            */
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



 /* G A L L E R Y
 */
 public function gallery() {
       $view_data = $this->init_view_data();

       if ($this->session->userdata('username') == "") {

         $this->load->view('login', $view_data);
         return;
         #$this->load->view('starter', $view_data);
       }
          // if action is get load view else post ( add to model )
         if ($this->input->server('REQUEST_METHOD') == 'POST') {
             log_message("debug", ">>>>>>>>>>>>> uploading slider Image");
/*
             $this->upload_file();
             $this->load->model('Gallery');
             $gallery = new Gallery();
             $gallery->add_thru_post();
             */
         }


       $subData['titleFirst'] = "Gallery";
       $subData['titleSecond'] = "List";
       $subData['boxTitle'] = "Gallery List Table";
       $subData['headers'] = array("Id", "Filename", "File URL", "Actions");
       $subData['data_url'] = base_url() . "index.php/admin/gallery_list";

       $header  = array('action' => '' , 'method' => 'post', 'enctype' => 'multipart/form_data');
       /* FORM DATA */
       $form_data = array(
         array("type" => "hidden", "name" => "actionType", "value" => "addGallery"),
         array("type" => "text", "name" => "filename", "label" => "Filename"),
         array("type" => "file", "name" => "fileToUpload", "label" => "Select Image to Upload"),
       );


       $view_data['form_title'] = "Create Gallery Image";
       $view_data['form'] = $this->createForm($header, $form_data, "Create Gallery Image");
       $view_data['subData'] = $subData;
       $view_data['tableHtml'] = "template/table_withform.php";
       $this->load->view('admin/tableTemplate', $view_data);
 }


  public function gallery_list() {
      $this->load->model('Gallery');
      $gallery = new Gallery();
      echo json_encode($gallery->getList());
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



















}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
