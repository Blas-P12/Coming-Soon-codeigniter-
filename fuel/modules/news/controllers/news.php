<?php
    require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');
   // require_once(MODULES_PATH.'/news/libraries/News_base_controller.php');
//class News extends News_base_controller {
class News extends Fuel_base_controller {
	 public $view_location = 'news';
	function __construct()
	{
		parent::__construct('news');
		$this->load->module_model(NEWS_FOLDER, 'news_model');
      //  echo $this->fuel->auth->is_logged_in(); exit;
      // if($this->fuel->auth->has_permission('news/create',"create")==true)
     // echo $this->_validate_user('news',"news/edit");
     //echo $this->fuel->auth->is_logged_in();  exit;
       /*  if($this->fuel->auth->has_permission('news/edit',"edit")==true)
        {
            echo "right";
        }else
        {
            echo "no right";
        } 
        exit; */
	}
  
	function _remap()
	{
		
         $vars=array();
         $vars["list"]=$this->news_model->news_list();
       
      //   $vars['body'] = $this->load->module_view(NEWS_FOLDER, "index", $vars, TRUE);
      echo   $output = $this->load->view('index', $vars, TRUE);
        
         exit;
		
	}
	
	function post($slug = null)
	{  
		if (empty($slug))
		{
			redirect_404();
		}
		
		$this->load->library('session');
		$blog_config = $this->fuel->blog->config();

		// run before_posts_by_date hook
		$hook_params = array('slug' => $slug);
		$this->fuel->blog->run_hook('before_post', $hook_params);
		
		$post = $this->fuel->blog->get_post($slug);

		if (isset($post->id))
		{
			$vars = $this->_common_vars();
			$vars['post'] = $post;
			$vars['user'] = $this->fuel->blog->logged_in_user();
			$vars['page_title'] = $post->title;
			$vars['next'] = $this->fuel->blog->get_next_post($post);
			$vars['prev'] = $this->fuel->blog->get_prev_post($post);
			$vars['slug'] = $slug;
			$vars['is_home'] = $this->fuel->blog->is_home();
			
			$antispam = md5(random_string('unique'));
			
			$field_values = array();
			
			// post comment
			if (!empty($_POST))
			{
				$field_values = $_POST;
				
				// the id of "content" is a likely ID on the front end, so we use comment_content and need to remap
				$field_values['content'] = $field_values['new_comment'];
				unset($field_values['antispam']);
				
				if (!empty($_POST['new_comment']))
				{
					$vars['processed'] = $this->_process_comment($post);
				}
				else
				{
					add_error(lang('blog_error_blank_comment'));
				}
			}
			
			$cache_id = fuel_cache_id();
			$cache = $this->fuel->blog->get_cache($cache_id);
			if (!empty($cache) AND empty($_POST))
			{
				$output =& $cache;
			}
			else
			{
				$this->load->library('form');
				
				if (is_true_val($this->fuel->blog->config('use_captchas')))
				{
					$captcha = $this->_render_captcha();
					$vars['captcha'] = $captcha;
				}
				$vars['thanks'] = ($this->session->flashdata('thanks')) ? blog_block('comment_thanks', $vars, TRUE) : '';
				$vars['comment_form'] = '';
				$this->session->set_userdata('antispam', $antispam);
				
				if ($post->allow_comments)
				{
					$this->load->module_model(BLOG_FOLDER, 'blog_comments_model');
					$this->load->library('form_builder', $blog_config['comment_form']);
					
					$fields['author_name'] = array('label' => 'Name', 'required' => TRUE);
					$fields['author_email'] = array('label' => 'Email', 'required' => TRUE);
					$fields['author_website'] = array('label' => 'Website');
					$fields['new_comment'] = array('label' => 'Comment', 'type' => 'textarea', 'required' => TRUE);
					$fields['post_id'] = array('type' => 'hidden', 'value' => $post->id);
					$fields['antispam'] = array('type' => 'hidden', 'value' => $antispam);
					if (!empty($vars['captcha']))
					{
						$fields['captcha'] = array('required' => TRUE, 'label' => 'Security Text', 'value' => '', 'after_html' => ' <span class="captcha">'.$vars['captcha']['image'].'</span><br /><span class="captcha_text">'.lang('blog_captcha_text').'</span>');
					}
					
					// now merge with config... can't do array_merge_recursive'
					foreach($blog_config['comment_form']['fields'] as $key => $field)
					{
						if (isset($fields[$key])) $fields[$key] = array_merge($fields[$key], $field);
					}

					if (!isset($blog_config['comment_form']['label_layout'])) $this->form_builder->label_layout = 'left';
					if (!isset($blog_config['comment_form']['submit_value'])) $this->form_builder->submit_value = 'Submit Comment';
					if (!isset($blog_config['comment_form']['use_form_tag'])) $this->form_builder->use_form_tag = TRUE;
					if (!isset($blog_config['comment_form']['display_errors'])) $this->form_builder->display_errors = TRUE;
					$this->form_builder->form_attrs = 'method="post" action="'.site_url($this->uri->uri_string()).'#comments_form"';
					$this->form_builder->set_fields($fields);
					$this->form_builder->set_field_values($field_values);
					$this->form_builder->set_validator($this->blog_comments_model->get_validation());
					$vars['comment_form'] = $this->form_builder->render();
					$vars['fields'] = $fields;
				}
				
				$output = $this->_render('post', $vars, TRUE);
				
				// save cache only if we are not posting data
				if (!empty($_POST)) 
				{
					$this->fuel->blog->save_cache($cache_id, $output);
				}
			}
			if (!empty($output))
			{ 
				$this->output->set_output($output);
				return;
			}
		}
		else
		{
			show_404();
		}
	}
	function _process_comment($post)
	{
		if (!is_true_val($this->fuel->blog->config('allow_comments'))) return;
		
		$notified = FALSE;
		
		// check captcha
		if (!$this->_is_valid_captcha())
		{
			add_error(lang('blog_error_captcha_mismatch'));
		}
		
		// check that the site is submitted via the websit
		if (!$this->_is_site_submitted())
		{
			add_error(lang('blog_error_comment_site_submit'));
		}
		
		// check consecutive posts
		if (!$this->_is_not_consecutive_post())
		{
			add_error(lang('blog_error_consecutive_comments'));
		}
		
		$this->load->module_model(BLOG_FOLDER, 'blog_users_model');
		$user = $this->blog_users_model->find_one(array('fuel_users.email' => $this->input->post('author_email', TRUE)));
		
		// create comment
		$this->load->module_model(BLOG_FOLDER, 'blog_comments_model');
		$comment = $this->blog_comments_model->create();
		$comment->post_id = $post->id;
		
		$comment->author_id = (!empty($user->id)) ? $user->id : NULL;
		$comment->author_name = $this->input->post('author_name', TRUE);
		$comment->author_email = $this->input->post('author_email', TRUE);
		$comment->author_website = $this->input->post('author_website', TRUE);
		$comment->author_ip = $_SERVER['REMOTE_ADDR'];
		$comment->content = trim($this->input->post('new_comment', TRUE));
		$comment->date_added = NULL; // will automatically be added

		//http://googleblog.blogspot.com/2005/01/preventing-comment-spam.html
		//http://en.wikipedia.org/wiki/Spam_in_blogs

		// check double posts by IP address
		if ($comment->is_duplicate())
		{
			add_error(lang('blog_error_comment_already_submitted'));
		}
		
		// if no errors from above then proceed to submit
		if (!has_errors())
		{
			// submit to akisment for validity
			$comment = $this->_process_akismet($comment);

			// process links and add no follow attribute
			$comment = $this->_filter_comment($comment);

			// set published status
			if (is_true_val($comment->is_spam) OR $this->fuel->blog->config('monitor_comments'))
			{
				$comment->published = 'no';
			}
			
			// save comment if saveable and redirect
			if (!is_true_val($comment->is_spam) OR (is_true_val($comment->is_spam) AND $this->fuel->blog->config('save_spam')))
			{
				if ($comment->save())
				{
					$notified = $this->_notify($comment, $post);
					$this->load->library('session');
					$vars['post'] = $post;
					$vars['comment'] = $comment;
					$this->session->set_flashdata('thanks', TRUE);
					$this->session->set_userdata('last_comment_ip', $_SERVER['REMOTE_ADDR']);
					$this->session->set_userdata('last_comment_time', time());
					redirect($post->url);
				}
				else
				{
					add_errors($comment->errors());
				}
			}
			else
			{
				add_error(lang('blog_comment_is_spam'));
			}
		}
		return $notified;
	}
	
	// check captcha validity
	function _is_valid_captcha()
	{
		$valid = TRUE;
		
		// check captcha
		if (is_true_val($this->fuel->blog->config('use_captchas')))
		{
			if (!$this->input->post('captcha'))
			{
				$valid = FALSE;
			}
			else if (!is_string($this->input->post('captcha')))
			{
				$valid = FALSE;
			}
			else
			{
				
				$post_captcha_md5 = $this->_get_encryption($this->input->post('captcha'));
				$session_captcha_md5 = $this->session->userdata('comment_captcha');
				if ($post_captcha_md5 != $session_captcha_md5)
				{
					$valid = FALSE;
				}
			}
		}
		return $valid;
	}
	
	// check to make sure the site issued a session variable to check against
	function _is_site_submitted()
	{
		return ($this->session->userdata('antispam') AND $this->input->post('antispam') == $this->session->userdata('antispam'));
	}
	
	// disallow multiple successive submissions 
	function _is_not_consecutive_post()
	{
		$valid = TRUE;
		
		$time_exp_secs = $this->fuel->blog->config('multiple_comment_submission_time_limit');
		$last_comment_time = ($this->session->userdata('last_comment_time')) ? $this->session->userdata('last_comment_time') : 0;
		$last_comment_ip = ($this->session->userdata('last_comment_ip')) ? $this->session->userdata('last_comment_ip') : 0;
		if ($_SERVER['REMOTE_ADDR'] == $last_comment_ip AND !empty($time_exp_secs))
		{
			if (time() - $last_comment_time < $time_exp_secs)
			{
				$valid = FALSE;
			}
		}
		return $valid;
	}

	// process through akisment
	function _process_akismet($comment)
	{
		if ($this->fuel->blog->config('akismet_api_key'))
		{
			$this->load->module_library(BLOG_FOLDER, 'akismet');

			$akisment_comment = array(
				'author'	=> $comment->author_name,
				'email'		=> $comment->author_email,
				'body'		=> $comment->content
			);

			$config = array(
				'blog_url' => $this->fuel->blog->url(),
				'api_key' => $this->fuel->blog->config('akismet_api_key'),
				'comment' => $akisment_comment
			);

			$this->akismet->init($config);

			if ( $this->akismet->errors_exist() )
			{				
				if ( $this->akismet->is_error('AKISMET_INVALID_KEY') )
				{
					log_message('error', 'AKISMET :: Theres a problem with the api key');
				}
				elseif ( $this->akismet->is_error('AKISMET_RESPONSE_FAILED') )
				{
					log_message('error', 'AKISMET :: Looks like the servers not responding');
				}
				elseif ( $this->akismet->is_error('AKISMET_SERVER_NOT_FOUND') )
				{
					log_message('error', 'AKISMET :: Wheres the server gone?');
				}
			}
			else
			{
				$comment->is_spam = ($this->akismet->is_spam()) ? 'yes' : 'no';
			}
		}
		
		return $comment;
	}
	
	// strip out 
	function _filter_comment($comment)
	{
		$this->load->helper('security');
		$comment_attrs = array('content', 'author_name', 'author_email', 'author_website');
		foreach($comment_attrs as $filter)
		{
			$text = $comment->$filter;
			
			// first remove any nofollow attributes to clean up... not perfect but good enough
			$text = preg_replace('/<a(.+)rel=["\'](.+)["\'](.+)>/Umi', '<a$1rel="nofollow"$3>', $text);
//			$text = str_replace('<a ', '<a rel="nofollow"', $text);
			
			$text = strip_image_tags($text);
			
			$comment->$filter = $text;
		}
		return $comment;
	}
	
	function _notify($comment, $post)
	{
		// send email to post author
		if (!empty($post->author))
		{
			$config['wordwrap'] = TRUE;
			$this->load->library('email', $config);

			$this->email->from($this->fuel->config('from_email'), $this->fuel->config('site_name'));
			$this->email->to($post->author->email); 
			$this->email->subject(lang('blog_comment_monitor_subject', $this->fuel->blog->config('title')));

			$msg = lang('blog_comment_monitor_msg');
			$msg .= "\n".fuel_url('blog/comments/edit/'.$comment->id)."\n\n";

			$msg .= (is_true_val($comment->is_spam)) ? lang('blog_email_flagged_as_spam')."\n" : '';
			$msg .= lang('blog_email_published').": ".$comment->published."\n";
			$msg .= lang('blog_email_author_name').": ".$comment->author_name."\n";
			$msg .= lang('blog_email_author_email').": ".$comment->author_email."\n";
			$msg .= lang('blog_email_author_website').": ".$comment->author_website."\n";
			$msg .= lang('blog_email_author_ip').": ".gethostbyaddr($comment->author_ip)." (".$comment->author_ip.")\n";
			$msg .= lang('blog_email_content').": ".$comment->content."\n";

			$this->email->message($msg);

			return $this->email->send();
		}
		else
		{
			return FALSE;
		}
	}
	
	function _render_captcha()
	{
		$this->load->library('captcha');
		$blog_config = $this->config->item('blog');
		$assets_folders = $this->config->item('assets_folders');
		$blog_folder = MODULES_PATH.BLOG_FOLDER.'/';
		$captcha_path = $blog_folder.'assets/captchas/';
		$word = strtoupper(random_string('alnum', 5));
		
		$captcha_options = array(
						'word'		 => $word,
						'img_path'	 => $captcha_path, // system path to the image
						'img_url'	 => captcha_path('', BLOG_FOLDER), // web path to the image
						'font_path'	 => $blog_folder.'fonts/',
					);
		$captcha_options = array_merge($captcha_options, $blog_config['captcha']);
		if (!empty($_POST['captcha']) AND $this->session->userdata('comment_captcha') == $this->input->post('captcha'))
		{
			$captcha_options['word'] = $this->input->post('captcha');
		}
		$captcha = $this->captcha->get_captcha_image($captcha_options);
		$captcha_md5 = $this->_get_encryption($captcha['word']);
		$this->session->set_userdata('comment_captcha', $captcha_md5);
		
		return $captcha;
	}
	
	function _get_encryption($word)
	{
		$captcha_md5 = md5(strtoupper($word).$this->config->item('encryption_key'));
		return $captcha_md5;
	}
}