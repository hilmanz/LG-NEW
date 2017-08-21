<?php
class Pages extends CI_Controller {

        public function view($page = 'home')
        {
			if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
			{
					// Whoops, we don't have a page for that!
					show_404();
			}
			if($page=='login'){	
			$data['title'] = ucfirst($page); // Capitalize the first letter
			$this->load->view('pages/'.$page, $data);
			}
			else{
	
			$data['title'] = ucfirst($page); // Capitalize the first letter
	
			$this->load->view('global/header', $data);
			$this->load->view('pages/'.$page, $data);
			$this->load->view('global/footer', $data);
			}
        }
}