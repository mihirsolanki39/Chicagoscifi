<?php

class Sources extends Controller {

    function index()
    {
            $db = $this->db;
            $db = $db->select('*');
            $db = $db->from('sources');
            $db = $db->order_by('name');
            $db = $db->get();
            $sources = $db->result();

            $data = array(
                'sources' => $sources
            );

            $this->load->view('header');
            $this->load->view('sources/index',$data);
            $this->load->view('footer');

    }

    function add()
    {
        $this->db->set('name',$_POST['name']);
        $this->db->insert('sources');
        redirect('sources');
    }
    function delete($id)
    {
        $this->db
            ->delete(
                'sources',
                array(
                    'id' => $id
                )
            );
        redirect('sources');
    }
}
