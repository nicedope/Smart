<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        require_once APPPATH . '/libraries/JWT.php';
    }

	public function index()
	{
		$page = $this->template_admin->meta_tags('Test');
		$data['pageInfo'] = $page;

		$page_content = $this->template_admin->admin_content('T','');

        if($this->session->userdata('logged_in') == NULL){
            $data_session = array(
                'fb_id'  => 'fqw123712rqt24',
                'name'     => 'John Doe',
                'logged_in' => TRUE
            );
            $this->session->set_userdata($data_session);
        }


        $data['content'] = $this->load->view('button',$page_content,true);
		$this->load->view('template', $data);
    }

    public function GenerateToken($data)
    {          
        $jwt = JWT::encode($data, 'Hn42KKhGVp');
        return $jwt;
    }

    public function validate_data(){
        $args = $_POST;
        $resp = array();


            $jwtToken =  $this->DecodeToken($args['token']);
            echo json_encode(array('Token'=>$jwtToken));
        // $tokenData['uniqueId'] = '55555';
        // $tokenData['role'] = 'admin';
        // $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
        // try {
        //     $jwtToken =  $this->DecodeToken($args['token']);
        //     echo json_encode(array('Token'=>$jwtToken));
        // } catch (Exception $e) { // Also tried JwtException
        //     echo 'error';
        // }


        // $resp['message'] = "Success";
        // $resp['button_number'] = $args['btn_number'];

        // echo json_encode($resp);
        // if($this->session->userdata('logged_in') == NULL){
        //     echo "";
        // }
    }

    public function DecodeToken($token)
    {          
        $decoded = JWT::decode($token, 'Hn42KKhGVp', array('HS256'));
        $decodedData = (array) $decoded;
        return $decodedData;
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

}
