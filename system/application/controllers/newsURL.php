<?php

class NewsURL extends Controller {

	function NewsURL()
	{
		parent::Controller();	
        //$this->output->enable_profiler(true);
	}

    function cats()
    {
            $categories  = $this->db->get('categories');
            $cats = array();
            foreach ($categories->result() as $c) 
            {
              if($c->stat == 'H')
              {
              	continue;
              }
              $cats[$c->id] = $c->name;
            }
            $cats["-"] = "-";
            asort($cats);
            return $cats;
    }

    function srcs()
    {
            $sources = $this->db->get('sources');
            $srcs = array();
            foreach ($sources->result() as $s) {
              $srcs[$s->id] = $s->name;
            }
            $srcs["-"] = "-";
            asort($srcs);
            return $srcs;
    }

    
    function nnews($where)
    {
            foreach($where as $k=>$v):
                if($v == "-")
                    unset($where[$k]);
            endforeach;
            
            $this->db->select(
                '*, news.id AS id, c.name AS cat_name, c.stat AS cat_stat'
            );

            $this->db->from('news');

            $this->db->where($where);
            
            $this->db->join(
                'news_categories nc', 
                'nc.news_id = news.id'
            );

			$this->db->join(
                'categories c', 
                'nc.category_id = c.id'
            );

            $this->db->order_by('cat_name, timestamp');

            $results = $this->db->get();
            return $results;

    }

    function index()
    {
            $news   = $this->nnews($_POST);
            $data   = array(
                'categories'     => $this->cats(),
                'news'           => $news,
                'newFlag'		=> "2"
            );

            $filtering = (count($_POST)>0);

            if(!$filtering)
            {
                $this->load->view('header');
                $this->load->view('news/indexheaderURL',$data);
            }

            $this->load->view('news/llistURL',$data);

            if(!$filtering)
            {
                $this->load->view('news/indexfooter');
                $this->load->view('footer', $data);
            }
    }


    function showURL($id="")
    {
            $news = $this->nnews(array('news.id' => $id));
            $data = array(
                'categories'     => $this->cats(),
                'news_item'      => $news
            );

            $this->load->view('header');
            $this->load->view('news/showURL',$data);
            $this->load->view('footer');
    }

    function show($id="")
    {
            $news = $this->nnews(array('news.id' => $id));
            $data = array(
                'categories'     => $this->cats(),
                'news_item'      => $news
            );

            $this->load->view('header');
            $this->load->view('news/show',$data);
            $this->load->view('footer');
    }

    function save()
    {
        $url = !preg_match('~^https?://~', $_POST['url']) ? 'http://' . $_POST['url'] : $_POST['url'];
        $this->db->set('timestamp',date('Y-m-d H:i:s'));
        $this->db->set('content',$_POST['content']);
        $this->db->set('title',$_POST['title']);
        $this->db->set('url',$url);
        $this->db->where('id',$_POST['id']);
        $this->db->update('news');

        $this->db->delete('news_categories', array('news_id' => $_POST['id']));
        if (isset($_POST['category_id'])) {
            foreach ($_POST['category_id'] as $category_id) {
                $this->db->set('news_id', $_POST['id']);
                $this->db->set('category_id', $category_id);
                $this->db->update('news_categories');
            }
        }

        redirect('news/show/'.$_POST['id']);
    }

    function create()
    {
		if (!session_id()) { session_start(); }
		$url = !preg_match('~^https?://~', $_POST['url']) ? 'http://' . $_POST['url'] : $_POST['url'];
        if (strpos($url, '&url=') !== false) {
            $urlparts = explode('&url=', $url);
            $url = end($urlparts);
        }

        $this->db->set('timestamp',date('Y-m-d H:i:s'));
        if (isset($_POST['content']))
            $this->db->set('content',$_POST['content']);
        $this->db->set('title',$_POST['title']);
        $this->db->set('url',$url);
        $this->db->insert('news');
        $news_id = $this->db->insert_id();

        if (isset($_POST['category_id'])) {
            foreach ($_POST['category_id'] as $category_id) {
                $this->db->set('news_id', $news_id);
                $this->db->set('category_id', $category_id);
                $this->db->insert('news_categories');
            }
        }

        if (isset($_POST['fb_page']) && count($_POST['fb_page']) > 0) {
			
			$data = array(
				'title' => $_POST['title'],
				'hashtag' => $_POST['hashtag'],
				'url' => $url,
				'social' => 'facebook',
				'page' => json_encode($_POST['fb_page']),
				'access_token' => $_SESSION['facebook_access_token'],
			);
			
			$this->db->insert('social_share', $data);
			
        }
		
		if(isset($_POST['enable_tweet'])) {
			
			$data = array(
				'title' => $_POST['title'],
				'hashtag' => $_POST['hashtag'],
				'url' => $url,
				'social' => 'twitter',
				'access_token' => $_SESSION['twitter_oauth_token'],
				'access_token_secret' => $_SESSION['twitter_oauth_token_secret'],
			);

			$this->db->insert('social_share', $data);
			
		}

        redirect('news/createFormURL');
    }

    function category_types()
    {
        return array(
            'tv' => 'TV',
            'movie' => 'Movie'
        );
    }

    function delete($id)
    {
        $this->db->delete('news', array('id' => $id));
        $this->db->delete('news_categories', array('news_id' => $id));

        redirect('news/showURL');
    }

    function createform()
    {
        $data   = array(
            'categories'     => $this->cats()
        );
        $this->load->view('header');
        $this->load->view('news/create',$data);
        $this->load->view('footer');
    }

    function createformURL()
    {
        $data   = array(
            'categories'     => $this->cats(),
        );
        $this->load->view('header');
        $this->load->view('news/createURL',$data);
        $this->load->view('footer');
    }
}
