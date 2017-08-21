<?php
class Routes extends CI_Model {
 
    function __construct() {
        parent::__construct();
    }   
 
    //grab all of the routes from the database, and cache to a file
    public function cache_routes()
    {
        $this->db->select("*");
        $query = $this->db->get("routes");
 
        foreach ($query->result() as $row)
        {
            $data[] = '$route["' . $row->slug . '"] = "' . $row->route . '";';
            $output = "load->helper('file')";
            write_file(APPPATH .  "cache/routes.php", $output);
        }
    }
}
?>