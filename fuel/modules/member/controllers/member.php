<?php

//require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');
// require_once(FUEL_PATH.'/libraries/Fuel_base_library.php');

require_once(MODULES_PATH . '/member/libraries/Member_base_controller.php');
// require_once(MODULES_PATH.'/news/libraries/News_base_controller.php');
//class News extends News_base_controller {
// extends Fuel_base_controller {     CI_Controller   
session_start();

class Member extends Member_base_controller {

    public $view_location = 'member';
    function __construct() {
        parent::__construct('member');
        $this->load->module_model(MEMBER_FOLDER, 'member_model');
        $this->lang->load('fuel');
        $this->load->helper('ajax');
        $this->load->library('form_builder');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->module_model(FUEL_FOLDER, 'fuel_users_model');
        // if($this->fuel->auth->has_permission('news/create',"create")==true)
        // echo $this->_validate_user('news',"news/edit");
        //echo $this->fuel->auth->is_logged_in();  exit;
        /*   if($this->fuel->auth->is_logged_in()==true)
          {
          echo "login";
          }else
          {
          echo "Not login";
          }


          if($this->fuel->auth->has_permission('news/edit',"edit")==true)
          {
          echo "right";
          }else
          {
          echo "no right";
          }
          exit; */
    }

    function _remap() {


        $args = func_get_args();
        $method = $args[0];
        $segments = $args[1];

        if ($this->fuel->auth->is_logged_in() == true) {
            $checkvars = array();
            $checkvars["checkuser"] = $this->fuel->auth->valid_user();
            if ($checkvars["checkuser"]["super_admin"] == "yes") {
                // $_SESSION["logindetail"]="You are currently login with super admin on site, Please Logout";  
                $this->fuel->auth->logout();
                redirect('member/welcome');
            }
        }

        switch ($method) {
            case "items":
                $this->items();
                break;
            case "login":
                if ($this->fuel->auth->is_logged_in() == true) {
                    redirect('member/welcome');
                }
                $this->login();
                break;
            case "welcome":


                if ($this->fuel->auth->is_logged_in() == false) {
                    redirect('');
                }
                $this->welcome();
                break;
            case "logout":
                if ($this->fuel->auth->is_logged_in() == false) {
                    redirect('');
                }
                $this->logout();
                break;
                
            case "procedures_link":
                if ($this->fuel->auth->is_logged_in() == false) {
                    redirect('');
                }
                $this->procedures_link($segments[0]);
                break;
            case "downloadprolink":
                if ($this->fuel->auth->is_logged_in() == false) {
                    redirect('');
                }
                $this->downloadprolink($segments[0]);
                break;
            case "diagram_link":
                if ($this->fuel->auth->is_logged_in() == false) {
                    redirect('');
                }
                $this->diagram_link($segments[0]);
                break;
            case "wardens_link":
                if ($this->fuel->auth->is_logged_in() == false) {
                    redirect('');
                }
                $this->wardens_link($segments[0]);
                break;
            case "evacuations_report":
                if ($this->fuel->auth->is_logged_in() == false) {
                    redirect('');
                }
                $this->evacuations_report($segments[0]);
                break;
            case "pwd_reset" :
                if ($this->fuel->auth->is_logged_in() == true) {
                    redirect('member/welcome');
                }
                $this->pwd_reset();
                break;
            default :
                redirect('');
                break;
        }
    }

    function items() {
        $vars = array();
        //$vars["list"]=$this->news_model->news_list();
        //$vars["css"]="stylesheet";

        /*

         */
        echo $output = $this->load->view('index', $vars, TRUE);

        exit;
    }

    function login() {
        // echo "<pre>";
        //  print_r($_POST);  
        //   exit; 
        $vars = array();
        $vars["showerror"] = "";
        if (!empty($_POST)) {
            if ($this->fuel->auth->login($this->input->post('user_name', TRUE), $this->input->post('password', TRUE))) {
                $forward = $this->input->post('forward');
                //	$forward_uri = uri_safe_decode($forward);
                if ($forward != $this->fuel->config('login_redirect')) {
                    redirect($forward);
                } else {
                    redirect($this->fuel->config('login_redirect'));
                }
            } else {
                $vars["showerror"] = "Invaild username and password";
            }
        }

        //$vars["list"]=$this->news_model->news_list();
        $vars["css"] = "stylesheet";
        $vars["page_title"] = 'Member Login';
        //   $vars['body'] = $this->load->module_view(NEWS_FOLDER, "index", $vars, TRUE);
        echo $output = $this->load->view('index', $vars, TRUE);

        exit;
    }
    function pwd_reset() {
        if (!$this->fuel->config('allow_forgotten_password'))
            show_404();
        $this->js_controller_params['method'] = 'add_edit';

        if (!empty($_POST)) {
            if ($this->input->post('email')) {
                $user = $this->fuel_users_model->find_one_array(array('email' => $this->input->post('email')));

                if (!empty($user['email'])) {
                    $users = $this->fuel->users;
                    $new_pwd = $this->fuel->users->reset_password($user['email']);
                    if ($new_pwd !== FALSE) {
                        $url = 'reset/' . md5($user['email']) . '/' . md5($new_pwd);
                        $msg = lang('pwd_reset_email', fuel_url($url));

                        $params['to'] = $this->input->post('email');
                        $params['subject'] = lang('pwd_reset_subject');
                        $params['message'] = $msg;
                        $params['use_dev_mode'] = FALSE;

                        if ($this->fuel->notification->send($params)) {

                            //$this->session->set_flashdata('success', lang('pwd_reset'));
                            $this->session->set_userdata('resetpassword', lang('pwd_reset'));
                            $this->fuel->logs->write(lang('auth_log_pass_reset_request', $user['email'], $this->input->ip_address()), 'debug');
                        } else {
                            $this->session->set_flashdata('error', lang('error_pwd_reset'));
                            $this->fuel->logs->write($this->fuel->notification->last_error(), 'debug');
                        }
                        redirect();
                        //redirect(fuel_uri('login'));
                    } else {
                        $this->fuel_users_model->add_error(lang('error_invalid_email'));
                    }
                } else {
                    $this->fuel_users_model->add_error(lang('error_invalid_email'));
                }
            } else {
                $this->fuel_users_model->add_error(lang('error_empty_email'));
            }
        }
        $this->form_builder->set_validator($this->fuel_users_model->get_validation());

        // build form
        /* 	$fields['Reset Password'] = array('type' => 'section', 'label' => lang('login_reset_pwd'));
          $fields['email'] = array('required' => TRUE, 'size' => 30, 'placeholder' => 'email', 'display_label' => FALSE);
          $this->form_builder->show_required = FALSE;
          $this->form_builder->set_fields($fields);
          $vars['form'] = $this->form_builder->render();
         */
        // notifications template
        $vars['error'] = $this->fuel_users_model->get_errors();
        //	$vars['notifications'] = $this->load->view('_blocks/notifications', $vars, TRUE);
        $vars['page_title'] = "Member Password Reset";
        $this->load->view('resetpassword', $vars);
    }

    function welcome() {


        //  $userdata=$this->fuel->auth->valid_user();
        if ($this->fuel->auth->is_logged_in() == true) {
            $vars = array();
            $vars["showerror"] = "";
            $vars["css"] = "stylesheet";
            $vars["userdata"] = $this->fuel->auth->valid_user();
            $vars["showerror"] = "";
            $vars["page_title"] = 'Welcome ';
            $vars["use_back_btn"] = '0';

            $userid = $vars["userdata"]["id"];
            $vars["list"] = $this->member_model->properties_list($userid);
            $vars["welcome"] = $this->member_model->welcomecontent();


            if (!empty($vars["list"])) {
                foreach ($vars["list"] as $key => $detail) {
                    //********************** Google Map *********************

                    $address = "";
                    $this->load->library('googlemaps');
                    $address.= $detail["address"] ? $detail["address"] . "," : "";
                    $address.= $detail["city"] ? $detail["city"] . "," : "";
                    $address.= $detail["state"] ? $detail["state"] . "," : "";
                    $address.= $detail["country"] ? $detail["country"] . "," : "";

                    $config['center'] = $address; //'Adelaide, Australia'; 
                    //	$config['center'] = "21.0000° N,78.0000° E";    //  india
                    $config['zoom'] = '17';
                    $config['map_div_id'] = 'map_canvas_' . $detail["id"];
                    $this->googlemaps->initialize($config);
                    $marker = array();
                    $marker['position'] = $detail["address"];
                    //	$marker['infowindow_content'] = "$html";
                    $marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=B|C21214|FFFFFF';
                    $this->googlemaps->add_marker($marker);
                    $vars["list"][$key]['map'] = $this->googlemaps->create_map();
                    //**********************************************************
                    $images = array();
                    $images = $this->member_model->property_imageslist($detail["id"]);
                    $vars["list"][$key]["getimages"] = $images;
                }
            }
            //   $vars['body'] = $this->load->module_view(NEWS_FOLDER, "index", $vars, TRUE);
            echo $output = $this->load->view('welcome', $vars, TRUE);
        } else {
            redirect('');
        }
    }

    function logout() {
 
        $this->fuel->auth->logout();
       $this->session->unset_userdata();
        redirect(base_url());   
       // echo "cdfgvdgd";
    }

    function procedures_link($propertyid) {
        //   echo $propertyid; exit;

        if ($this->fuel->auth->has_permission('property/emergencyprolink', "emergencyprolink") == true) {
            $vars = array();

            $vars["showerror"] = "";
            $vars["css"] = "stylesheet";
            $vars["userdata"] = $this->fuel->auth->valid_user();
            $vars["showerror"] = "";
            $vars["page_title"] = 'Emergency Procedures Link';
            $vars["prolinks"] = $this->member_model->procedures_link();
            // $protrans=array();
            $vars["propertyid"] = $propertyid;
            $protrans = $this->member_model->procedures_pdflinks($propertyid);

            if (!empty($protrans)) {
                foreach ($protrans as $key => $detail) {
                    $prolinkid = $detail["emeprocedureslinkid"];
                    $protrans_arr[$prolinkid] = $detail["imagename"];
                    $protransids_arr[$prolinkid] = $prolinkid;
                }

                $vars["protrans"] = $protrans_arr;
                $vars["protransids"] = $protransids_arr;
            } else {
                $protrans_arr = array();
            }
            echo $output = $this->load->view('emergencylinks', $vars, TRUE);
        } else {
            $msg = $this->session->set_userdata('frontmsg', "You have no permission to view this link");
            redirect('member/welcome');
        }
    }

    function diagram_link($propertyid) {
        //   echo $propertyid; exit;

        if ($this->fuel->auth->has_permission('property/emergencydiagramlink', "emergencydiagramlink") == true) {
            $vars = array();

            $vars["showerror"] = "";
            $vars["css"] = "stylesheet";
            $vars["userdata"] = $this->fuel->auth->valid_user();
            $vars["showerror"] = "";
            $vars["page_title"] = 'Emergency Diagrams Link';

            // $protrans=array();
            $vars["propertyid"] = $propertyid;
            $vars["list"] = $this->member_model->emediagram_list($propertyid);
            if (!empty($vars["list"])) {
                foreach ($vars["list"] as $key => $detail) {
                    $mainid = $detail["id"];

                    $imagesdetail[$mainid] = $this->member_model->emediagram_imageslist($mainid);
                }
                $vars["imageslist"] = $imagesdetail;
            }

            echo $output = $this->load->view('diagramlink', $vars, TRUE);
        } else {
            $msg = $this->session->set_userdata('frontmsg', "You have no permission to view this link");
            redirect('member/welcome');
        }
    }

    function wardens_link($propertyid) {
        //   echo $propertyid; exit;

        if ($this->fuel->auth->has_permission('property/ecowardenlink', "ecowardenlink") == true) {
            $vars = array();

            $vars["showerror"] = "";
            $vars["css"] = "stylesheet";
            $vars["userdata"] = $this->fuel->auth->valid_user();
            $vars["showerror"] = "";
            $vars["page_title"] = 'Eco Wardens Link';

            // $protrans=array();
            $vars["propertyid"] = $propertyid;
            $vars["list"] = $this->member_model->warden_list($propertyid);

            echo $output = $this->load->view('wardenslinks', $vars, TRUE);
        } else {
            $msg = $this->session->set_userdata('frontmsg', "You have no permission to view this link");
            redirect('member/welcome');
        }
    }

    function evacuations_report($propertyid) {
        //   echo $propertyid; exit;

        if ($this->fuel->auth->has_permission('property/evacuationrpt', "evacuationrpt") == true) {
            $vars = array();

            $vars["showerror"] = "";
            $vars["css"] = "stylesheet";
            $vars["userdata"] = $this->fuel->auth->valid_user();
            $vars["showerror"] = "";
            $vars["page_title"] = 'Evacuation Reports';

            // $protrans=array();
            $vars["propertyid"] = $propertyid;
            $vars["propertydetail"] = $this->member_model->properties_detail($propertyid);
            $userid = $vars["userdata"]["id"];
            $vars["list"] = $this->member_model->evacuationrpt_list($propertyid, $userid);
            echo $output = $this->load->view('evacuationrpt', $vars, TRUE);
        } else {
            $msg = $this->session->set_userdata('frontmsg', "You have no permission to view this link");
            redirect('member/welcome');
        }
    }

    function downloadprolinkold($filename) {

        $file = UPLOAD_ROOT_PATH . "/property/pdf/" . $filename;

        if (file_exists($file)) {
            /*
              header('Content-Description: File Transfer');
              header('Content-Type: application/octet-stream');
              header("Content-Type: application/force-download");
              header('Content-Disposition: attachment; filename=' . urlencode(basename($file)));
              // header('Content-Transfer-Encoding: binary');
              header('Expires: 0');
              header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
              header('Pragma: public');
              header('Content-Length: ' . filesize($file));
              ob_clean();
              flush();
              readfile($file);
              exit;
             */
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . file . '"');
            header('Content-Length: ' . filesize($file));
            @readfile($file);
        }
    }

    function downloadprolink($filename) {

        if ($this->fuel->auth->has_permission('property/emergencyprolink', "emergencyprolink") == true) {
            $vars = array();

            $vars["showerror"] = "";
            $vars["css"] = "stylesheet";
            $vars["userdata"] = $this->fuel->auth->valid_user();
            $vars["showerror"] = "";
            $vars["page_title"] = 'Emergency Procedures Link';
            $vars["prolinks"] = $this->member_model->procedures_link();
            // $protrans=array();
            $vars["filename"] = $filename;

            echo $output = $this->load->view('emergencyshowlinks', $vars, TRUE);
        } else {
            $msg = $this->session->set_userdata('frontmsg', "You have no permission to view this link");
            redirect('member/welcome');
        }
    }

    function showprolink($filename) {
        if ($this->fuel->auth->has_permission('property/emergencyprolink', "emergencyprolink") == true) {
            $vars = array();

            $vars["showerror"] = "";
            $vars["css"] = "stylesheet";
            $vars["userdata"] = $this->fuel->auth->valid_user();
            $vars["showerror"] = "";
            $vars["page_title"] = 'Emergency Procedures Link';
            $vars["prolinks"] = $this->member_model->procedures_link();
            // $protrans=array();
            $vars["filename"] = $filename;

            echo $output = $this->load->view('emergencyshowlinks', $vars, TRUE);
        } else {
            $msg = $this->session->set_userdata('frontmsg', "You have no permission to view this link");
            redirect('member/welcome');
        }
    }
  
} 
