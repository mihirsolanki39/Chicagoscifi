<?php

class Home extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
        redirect('news/createformURL');

        /*
        # get the entries
        $this->db->select('*,entries.id as id')
                 ->from('entries')
                 ->join('categories', 'entries.category_id = categories.id');
        $entries = $this->db->get();

        $data = array(
            'entries' => $entries
        );

		$this->load->view('header');
		$this->load->view('home',$data);
		$this->load->view('footer');
        */
	}
}
