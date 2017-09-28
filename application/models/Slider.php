<?php


class Slider extends CI_Model {


    var $caller ;
    var $table_name = 'sliders';

    var $id;
    var $file_url;
		var $filename;



	function __construct() {
 		// Call the Model constructor
   	parent::__construct();
		$this->caller =& get_instance();
 	}




	function get_data () {
  	$data = array(
			'file_url' => $this->file_url,
			'filename' => $this->filename,
    );
		return $data;
	}

	function add ( ) {
    // database insert
		$this->caller->db->insert($this->table_name, $this->get_data());
		// get the id from the last insert
		$this->id  = $this->caller->db->insert_id();
		return $this->id;
 	}

	function update ( ) {
		$this->caller->db->where('id', $this->id);
		// database update
		$this->caller->db->update($this->table_name, $this->get_data());
	}

	function delete ( ) {
		$query = $this->db->query("DELETE FROM $this->table_name WHERE id='$this->id'");
	}

	function get ( ) {
		$query = $this->caller->db->query("SELECT * FROM $this->table_name WHERE id='$this->id' LIMIT 1");
   	foreach ($query->result() as $row) {
			$this->id = $row->id;
			$this->file_url = $row->file_url;
			$this->filename = $row->filename;
		}
	}

	function add_thru_post ( ) {
		// get the information first and update the model
		$this->company = $this->caller->input->post('company');
		$this->bus_name = $this->caller->input->post('bus_name');
		$this->plate_number = $this->caller->input->post('plate_number');
		$this->route = $this->caller->input->post('route');
		$this->gps_id = $this->caller->input->post('gps_id');


		// then add the instance of that model
		$id = $this->add();
		return $id;
	}

	function update_thru_post () {
		// get the information first and update the model
		$this->id = $this->caller->input->get('id');
		$this->company = $this->caller->input->post('company');
		$this->bus_name = $this->caller->input->post('bus_name');
		$this->plate_number = $this->caller->input->post('plate_number');
		$this->route = $this->caller->input->post('route');
		$this->gps_id = $this->caller->input->post('gps_id');




		$this->update();
	}

	function delete_thru_post () {
		// get the information first and update the model
		$this->id = $this->caller->input->post('id');
		$this->delete();
	}

	function getAll () {
    $query = $this->caller->db->query("SELECT * FROM $this->table_name");
    $total = $this->caller->db->affected_rows();
		$data = array();
   	foreach ($query->result() as $row) {
      $data[] = $row;
    }
    return $data;
	}


   function getList() {

       $draw = $this->caller->input->get("draw");
       $start = $this->caller->input->get("start");
       $length = $this->caller->input->get("length");
       $search = $this->caller->input->get("search")['value'] ;

       $tabledata = array();

       $query = $this->caller->db->query("SELECT * FROM $this->table_name");
       $tabledata['recordsFiltered'] = $this->caller->db->affected_rows();

       $query_str = "SELECT * FROM $this->table_name WHERE filename LIKE '%$search%' LIMIT $start,$length";
       $query = $this->caller->db->query($query_str);
       log_message("debug", "query $query_str");
       $tabledata['recordsTotal'] = $this->caller->db->affected_rows();
       $tabledata['draw'] = $draw + 1;
       $tabledata['data'] = array();
       $base = base_url();

   	   foreach ($query->result() as $row) {

         $temp = array();
         $temp[] = $row->file_url;
         $temp[] = $row->filename;
         $actions = "<a href='$base/track/$row->id'><button type='button' class='btn btn-success'> Track </button></a> <a href='$base/bus_edit/$row->id'><button type='button' class='btn btn-danger'> Delete </button></a>" ;

         $temp[] = $actions;
         $tabledata['data'][] = $temp;

       }
       return $tabledata;



   }


}
?>
