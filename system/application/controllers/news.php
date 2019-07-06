<?php

class News extends Controller {

	function News()
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
	function showPopup($id)
	{
            $news = $this->nnews(array('news.id' => $id));
            $data = array(
                'news_item'      => $news
            );

            $this->load->view('news/showPopup',$data);
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

    function newsByDate($cat_id)
    {
            $this->db->select(
                '*,news.id AS id,categories.name AS cat_name'
            );

            $this->db->from('news');
			if ($cat_id != "")
				$this->db->where('c.id',$cat_id);

            $this->db->join(
                'news_categories nc', 
                'nc.news_id = news.id'
            );

            $this->db->join(
                'categories c', 
                'nc.category_id = c.id'
            );

            $this->db->order_by('timestamp', 'desc');

            return $this->db->get();
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

            return $this->db->get();

    }

	function search()
	{
            if (isset($_POST['dateFrom']))
			{
				  $this->db->select(
                        '*, news.id AS id, c.name AS cat_name, c.stat AS cat_stat'
					);

					$this->db->from('news');
					if (isset($_POST['dateFrom'])) {
						if ($_POST['dateFrom'] <> "") {
                            list ($month, $day, $year) = explode('/', $_POST['dateFrom']);
							$this->db->where('news.timestamp >=', "$year-$month-$day");
                        }
                    }
					if (isset($_POST['dateTo'])) {
						if ($_POST['dateTo'] <> "") {
                            list ($month, $day, $year) = explode('/', $_POST['dateTo']);
							$this->db->where('news.timestamp <=', "$year-$month-$day");
                        }
                    }

                    $this->db->join(
                        'news_categories nc', 
                        'nc.news_id = news.id'
                    );

                    $this->db->join(
                        'categories c', 
                        'nc.category_id = c.id'
                    );

					$this->db->order_by('cat_name','asc');
					$this->db->order_by('timestamp','desc');
					$data   = array(
						'news'					=> $this->db->get(),
						'hideCreate'			=> true
					);
			}
			else
			{
					$data   = array(
						'hideCreate'			=> true
					);
			}			
            $this->load->view('header');
            $this->load->view('news/indexheader',$data);
			$this->load->view('news/search', $data);
            $this->load->view('news/indexfooter');
            $this->load->view('footer');
	}
	
	function filterNews() {
		
		if (isset($_POST['delete-news']) && isset($_POST['ids'])) {
			$ids = $_POST['ids'];
			$this->db->where('id in (' . implode(', ', $ids) . ')');
            $this->db->delete('news');
		}
		
		if (isset($_POST['dateFrom']))
			{
				  $this->db->select(
                        '*, news.id AS id, c.name AS cat_name, c.stat AS cat_stat'
					);

					$this->db->from('news');
					if (isset($_POST['dateFrom'])) {
						if ($_POST['dateFrom'] <> "") {
                            list ($month, $day, $year) = explode('/', $_POST['dateFrom']);
							$this->db->where('news.timestamp >=', "$year-$month-$day");
                        }
                    }
					if (isset($_POST['dateTo'])) {
						if ($_POST['dateTo'] <> "") {
                            list ($month, $day, $year) = explode('/', $_POST['dateTo']);
							$this->db->where('news.timestamp <=', "$year-$month-$day");
                        }
                    }
					


                    $this->db->join(
                        'news_categories nc', 
                        'nc.news_id = news.id'
                    );

                    $this->db->join(
                        'categories c', 
                        'nc.category_id = c.id'
                    );
					if (isset($_POST['category_id']) && $_POST['category_id'] != '-') {
						$this->db->where('nc.category_id', $_POST['category_id']);
					} else {
						$this->db->order_by('cat_name','asc');
					}

					
					$this->db->order_by('timestamp','desc');
					$data   = array(
						'news'					=> $this->db->get(),
						'hideCreate'			=> true,
						'categories'     => $this->cats()
					);
			}
			else
			{
					$data   = array(
						'hideCreate'			=> true,
						'categories'     => $this->cats()
					);
			}
		$this->load->view('header');
		$this->load->view('news/listnews', $data);
		$this->load->view('news/indexfooter');
		$this->load->view('footer');
	}
	
	function category_switcher() {
		
		if (isset($_POST['switch-category']) && isset($_POST['ids'])) {
			$ids = $_POST['ids'];
			$selected_id = $_POST['category_id'];
			
			$this->db->where('news_id in (' . implode(', ', $ids) . ')'); 
			$this->db->set('category_id',$selected_id);
			$this->db->update('news_categories');
		}
		
		if (isset($_POST['dateFrom']))
			{
				  $this->db->select(
                        '*, news.id AS id, c.name AS cat_name, c.stat AS cat_stat'
					);

					$this->db->from('news');
					if (isset($_POST['dateFrom'])) {
						if ($_POST['dateFrom'] <> "") {
                            list ($month, $day, $year) = explode('/', $_POST['dateFrom']);
							$this->db->where('news.timestamp >=', "$year-$month-$day");
                        }
                    }
					if (isset($_POST['dateTo'])) {
						if ($_POST['dateTo'] <> "") {
                            list ($month, $day, $year) = explode('/', $_POST['dateTo']);
							$this->db->where('news.timestamp <=', "$year-$month-$day");
                        }
                    }
					


                    $this->db->join(
                        'news_categories nc', 
                        'nc.news_id = news.id'
                    );

                    $this->db->join(
                        'categories c', 
                        'nc.category_id = c.id'
                    );
					if (isset($_POST['category_id']) && $_POST['category_id'] != '-') {
						$this->db->where('nc.category_id', $_POST['category_id']);
					} else {
						$this->db->order_by('cat_name','asc');
					}

					
					$this->db->order_by('timestamp','desc');
					$data   = array(
						'news'					=> $this->db->get(),
						'hideCreate'			=> true,
						'categories'     => $this->cats()
					);
			}
			else
			{
					$data   = array(
						'hideCreate'			=> true,
						'categories'     => $this->cats()
					);
			}
		$this->load->view('header');
		$this->load->view('news/category_switcher', $data);
		$this->load->view('news/indexfooter');
		$this->load->view('footer');
	}

	function deleteNews()
	{
            if (isset($_POST['dateFrom']) || isset($_POST['dateTo'])) {
                if (!empty($_POST['dateFrom'])) {
                    list ($month, $day, $year) = explode('/', $_POST['dateFrom']);
                    $this->db->where('news.timestamp >', "$year-$month-$day");
                }
                if (!empty($_POST['dateTo'])) {
                    list ($month, $day, $year) = explode('/', $_POST['dateTo']);
                    $this->db->where('news.timestamp <', "$year-$month-$day");
                }
                if (isset($_POST['category_id']) && $_POST['category_id'] != '-') {
                    $this->db->join(
                        'news_categories nc', 
                        'nc.news_id = news.id'
                    );
                    $this->db->where('nc.category_id', $_POST['category_id']);
                }

                $this->db->select(
                    'news.id'
                );
                $this->db->from('news');

                $rows = $this->db->get()->result();
                $ids = array();
                foreach ($rows as $row) {
                    $ids[] = $row->id;
                }

                if (count($ids) > 0) {
                    $this->db->where('id in (' . implode(', ', $ids) . ')');
                    $this->db->delete('news');

                    $this->db->where('news_id in (' . implode(', ', $ids) . ')');
                    $this->db->delete('news_categories');
                }
			}
            $data   = array(
                'categories' => $this->cats()
            );
            $this->load->view('header');
			$this->load->view('news/delete', $data);
            $this->load->view('footer');
	}
	
	
    function index()
    {
            $news   = $this->nnews($_POST);
            $data   = array(
                'categories'     => $this->cats(),
                'news'           => $news,
                'newFlag'		=> "3"
            );

            $filtering = (count($_POST)>0);

            if(!$filtering)
            {
                $this->load->view('header');
                $this->load->view('news/indexheader',$data);
            }

            $this->load->view('news/llist',$data);

            if(!$filtering)
            {
                $this->load->view('news/indexfooter');
                $this->load->view('footer', $data);
            }
    }

    function dateEditorList()
    {		
			$hideCreate = true;
            $news   = $this->nnews($_POST);
            $data   = array(
                'categories'     => $this->cats(),
                'hideCreate'			=> $hideCreate,
                'news'           => $news
            );

            $filtering = (count($_POST)>0);

            if(!$filtering)
            {
                $this->load->view('header');
                $this->load->view('news/indexheader',$data);
            }

            $this->load->view('news/dateEditorList',$data);

            if(!$filtering)
            {
                $this->load->view('news/indexfooter');
                $this->load->view('footer');
            }
    }

    function dateEditor($id="")
    {
            $news = $this->nnews(array('news.id' => $id));
            $data = array(
                'categories'     => $this->cats(),
                'news_item'      => $news
            );

            $this->load->view('header');
            $this->load->view('news/dateEditor',$data);
            $this->load->view('footer');
    }

    function showURL($id="")
    {
            $news = $this->nnews(array('news.id' => $id));
            $results = $news->result();
            $selected_categories = array();
            foreach ($results as $row) {
                $selected_categories[] = $row->category_id;
            }
            $data = array(
                'categories'          => $this->cats(),
                'news'                => $results[0],
                'selected_categories' => $selected_categories
            );

            $this->load->view('header');
            $this->load->view('news/showURL',$data);
            $this->load->view('footer');
    }
    
    /*lists News title and date opoups open from this list*/
    
    function newsList($cat="")
    {
            $news   = $this->newsByDate($cat);
            $data   = array(
                'news'           => $news,
                'cat'			=> $cat
            );
            $this->load->view('news/list',$data);
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
		if (isset($_POST['dateEdit']))
		{
			$this->db->set('timestamp',date('Y-m-d',strtotime($_POST['date'])));
			$this->db->where('id',$_POST['id']);
			$this->db->update('news');
			redirect('news/dateEditorList');
		}
		else
		{
            $url = !preg_match('~^https?://~', $_POST['url']) ? 'http://' . $_POST['url'] : $_POST['url'];
            if (strpos($url, '&url=') !== false) {
                $urlparts = explode('&url=', $url);
                $url = end($urlparts);
            }

            $this->db->delete('news_categories', array('news_id' => $_POST['id']));
            if (isset($_POST['category_id'])) {
                foreach ($_POST['category_id'] as $category_id) {
                    $this->db->set('news_id', $_POST['id']);
                    $this->db->set('category_id', $category_id);
                    $this->db->insert('news_categories');
                }
            }

			if (isset($_POST['ndate'])) {
				$this->db->set('timestamp',date('Y-m-d',strtotime($_POST['ndate'])));
			}
			if (isset($_POST['content']))
				$this->db->set('content',$_POST['content']);
			$this->db->set('title',$_POST['title']);
			$this->db->where('id',$_POST['id']);
			$this->db->update('news');
			if(($pos=strpos($_SERVER['HTTP_REFERER'],'/showURL/'))===FALSE) 
				redirect('news');
			else
				redirect('newsURL');
		}
    }

    function create()
    {
        $this->db->set('category_id',$_POST['category_id']);
        $this->db->set('timestamp',date('Y-m-d H:i:s'));
        if (isset($_POST['content']))
	        $this->db->set('content',$_POST['content']);
        $this->db->set('title',$_POST['title']);
        $this->db->set('url',$_POST['url']);
        $this->db->insert('news');
        redirect('news');
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

        redirect('news');
    }
    function deleteURL($id)
    {
        $this->db->delete('news', array('id' => $id));
        $this->db->delete('news_categories', array('news_id' => $id));

        redirect('newsURL');
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
		if (!session_id()) { session_start(); }
		parse_str($_SERVER['QUERY_STRING'], $_GET);
        $this->config->load('facebookv5', true);
		$config = $this->config->item('facebookv5');
		$this->load->library('Facebookv5', true);
        
		$facebook_pages   = array();
		$fb = new Facebook\Facebook($config);
		$helper = $fb->getRedirectLoginHelper();
		$permissions = ['manage_pages', 'publish_pages'];
		$callback = 'https://chicagoscifi.com/new_site/news/createformURL';
		
		if (isset($_GET['state'])) { $helper->getPersistentDataHandler()->set('state', $_GET['state']); }

		try {
			if (isset($_SESSION['facebook_access_token'])) {
				$accessToken = $_SESSION['facebook_access_token'];
			} else {
				$accessToken = $helper->getAccessToken($callback);
			}
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			echo 'Graph returned an error: ' . $e->getMessage();
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		 }
		 
		if (isset($accessToken)) {
			if (isset($_SESSION['facebook_access_token'])) {
				$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			} else {
				// getting short-lived access token
				$_SESSION['facebook_access_token'] = (string) $accessToken;
				// OAuth 2.0 client handler
				$oAuth2Client = $fb->getOAuth2Client();
				// Exchanges a short-lived access token for a long-lived one
				$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
				$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
				// setting default access token to be used in script
				$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			}
			// redirect the user back to the same page if it has "code" GET variable
			if (isset($_GET['code'])) {
				header('Location: ./createformURL');
			}
			// getting basic info about user
			try {
				// post on behalf of page
				$pages = $fb->get('/me/accounts');
				$facebook_pages = $pages->getGraphEdge()->asArray();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				// When Graph returns an error
				echo 'Graph returned an error: ' . $e->getMessage();
				session_destroy();
				// redirecting user back to app login page
				header("Location: ./");
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				// When validation fails or other local issues
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}	
		}
		
		
		$loginUrl = $helper->getLoginUrl($callback, $permissions);
		
		$this->config->load('facebook', true);
        $config = $this->config->item('facebook');
        $this->load->library('facebook', $config);
	
        $data = array(
            'categories'		=> $this->cats(),
            'facebook_pages'	=> $facebook_pages,
            'loginUrl'			=> $loginUrl,
			'accessToken'		=> $accessToken,
        );

        $this->load->view('header');
        $this->load->view('news/createURL',$data);
        $this->load->view('footer');
    }
 
	function twitterAuth() {
        if (!session_id()) { session_start(); }
		$this->config->load('twitter', true);
		$config = $this->config->item('twitter');
		$this->load->library('twitter/Twitteroauth', true);
		
		$twitteroauth = $this->twitteroauth->create($config['consumer_key'], $config['consumer_secret']);
		
		$request_token = $twitteroauth->getRequestToken('http://chicagoscifi.com/new_site/news/twitterCallback');
		//print_r($request_token);
		// save token of application to session
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		
		// generate the URL to make request to authorize our application
		$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
		//print_r($url);
		header('Location: '. $url);
		
	}
	
	function twitterCallback() {
		if (!session_id()) { session_start(); }
		$this->config->load('twitter', true);
		$config = $this->config->item('twitter');
		$this->load->library('twitter/Twitteroauth', true);
		
		$oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');
		$connection = $this->twitteroauth->create( $config['consumer_key'], $config['consumer_secret'], $_SESSION['oauth_token'], $_SESSION['oauth_token_secret'] );
		
		// request user token
		$token = $connection->getAccessToken($oauth_verifier);
		
		$_SESSION['twitter_oauth_token'] = $token['oauth_token'];
		$_SESSION['twitter_oauth_token_secret'] = $token['oauth_token_secret'];
		header('Location: ./createformURL');
		//$twitter = $this->twitteroauth->create( $config['consumer_key'], $config['consumer_secret'], $_SESSION['oauth_token'], $_SESSION['oauth_token_secret'] );
		//$statues = $twitter->post("statuses/update", ["status" => "Good Morning"]);
	}
	
	function social_share() {
		
		$this->db->select('*')->from('social_share');
        $entries = $this->db->get();
		
		$row = $entries->row();
		
		if(!empty($row)) {
			if($row->social == "twitter" && isset($row->access_token_secret)) {
    			
    			$this->config->load('twitter', true);
    			$config = $this->config->item('twitter');
    			$this->load->library('twitter/Twitteroauth', true);
    			
    			$twitter = $this->twitteroauth->create( $config['consumer_key'], $config['consumer_secret'], $row->access_token, $row->access_token_secret );
    			$statues = $twitter->post("statuses/update", ["status" => $row->title . " " . $row->hashtag . " " . $row->url]);
    			$this->db->delete('social_share', array('id' => $row->id));
				
			} elseif($row->social == "facebook" && isset($row->access_token)) {
				
				$this->config->load('facebookv5', true);
				$config = $this->config->item('facebookv5');
				$this->load->library('Facebookv5', true);
				
				$fb = new Facebook\Facebook($config);
				$fb->setDefaultAccessToken($row->access_token);
				
				$facebook_pages = array();
				try {
					$facebook_pages = $fb->get('/me/accounts');
					$facebook_pages = $facebook_pages->getGraphEdge()->asArray();
				} catch (Exception $e) {
					$this->db->delete('social_share', array('id' => $row->id));
					error_log($e);
					$user = null;
				}
				$pages = json_decode($row->page);
				foreach ($facebook_pages as $page) {
					if (isset($page["perms"]) && in_array("CREATE_CONTENT", $page["perms"]) && in_array($page['id'], $pages)) {
						try {
							$post = $fb->post('/' . $page["id"] . '/feed', array('message' => $row->title  . " " .  $row->hashtag, "link" => $row->url), $page["access_token"]);
							$post = $post->getGraphNode()->asArray();
							$this->db->delete('social_share', array('id' => $row->id));
						} catch (Exception $e) {
							$this->db->delete('social_share', array('id' => $row->id));
							echo $e . " for: " .$page["id"] . '<br>';
						}
					}
				}
				
			}
		}
		
	}

    function sort_by_name($a, $b) {
        $a = trim($a['name']);
        $b = trim($b['name']);
        return strcmp($a,$b);
    }

}
