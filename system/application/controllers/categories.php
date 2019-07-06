<?php

class Categories extends Controller {

    function index()
    {
			$this->db->order_by("category_type,name");
            $categories  = $this->db->get('categories');
 /*           $cats = array();
            foreach ($categories->result() as $c) {
              $cats[$c->id] = array($c->name,$c->category_type);
            }

            $this->db->select('*,entries.id as id');
            $this->db->from('entries');
            $this->db->join('categories', 
                'entries.category_id = categories.id');
            $entries = $this->db->get();
*/

            $data = array(
                'categories'        => $categories,
 //               'entries'           => $entries,
                'category_types'    => $this->category_types()
            );
            $this->load->view('header');
            $this->load->view('categories/index',$data);
            $this->load->view('footer');

    }
    function category_types()
    {
        return array(
            'tv' => 'TV',
            'movie' => 'Movie'
        );
    }
    function add_category()
    {
        $this->db->set('name',$_POST['name']);
        $this->db->set('category_type',$_POST['category_type']);
        $this->db->insert('categories');
        redirect('categories');
    }
    function delete_category($id)
    {
        $this->db
            ->delete(
                'categories',
                array(
                    'id' => $id
                )
            );
        redirect('categories');
    }
    function modify_category()
    {
    	if(isset($_POST["id"]) && strlen($_POST['id']) > 0)
    	{
	    	$id = $_POST['id'];
	    	$newstat = 'V';
	    	if(isset($_POST["visibility"]) && strlen($_POST['visibility']) > 0)
	    	{
	    		$newstat = 'H';
	    	}
			$this->db->set('stat',$newstat);
			if(isset($_POST["name"]) && strlen($_POST['name']) > 0)
			{
	        	$this->db->set('name',$_POST['name']);
			}
			$this->db->where('id',$id);
			$this->db->update('categories');
    	}
        redirect('categories');
    }
}
