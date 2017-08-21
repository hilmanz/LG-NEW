<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Navigasi extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('all_model');
    }
	
	public function channel()
	{
		$menuaktif			= ('home','style');

		$this->load->view('global/header',$data);
	}
}

/* End of file navigasi.php */
/* Location: ./modules/controllers/navigasi.php */
