<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template_admin
{
	function checklogin($user_login, $user_type, $second_segment){
		if($user_login == "online"){
			if($user_type == 1 && $second_segment != "super-admin"){
				$url = base_url("admin/super-admin/user");
			}else if($user_type == 2 && $second_segment != "approver"){
				$url = base_url("admin/approver/pending");
			}else if($user_type == 3 && $second_segment != "content-admin"){
				$url = base_url("admin/content-admin/pending");
			}else if($user_type == 4 && $second_segment != "last-approver"){
				$url = base_url("admin/last-approver/pending");
			}else{
				$url = "none";
			}
		}else{
			$url = base_url("admin/login");
		}
		return $url;
	}

	function check_user_project($user_session){
        $args = array('user_session'=>$user_session);
        $userdetails = api(API_LOGIN_URL.'users/checkuserbysession', json_encode($args));
        return $userdetails;
	}

	function meta_tags($title = NULL){
		$page = array();
		$page['title'] = $title;
        return $page;
	}

	function admin_content($title = NULL, $toggle = NULL){
		$page_content = array();
		$page_content['title'] = $title;
        $page_content['toggle'] = $toggle;
        return $page_content;
	}

	function meta_args($args){
		$meta_args = array();
		$meta_args['meta_keywords'] = $args['meta_keywords'];
		$meta_args['meta_description']  = $args['meta_description'];
		$meta_args['og_title']  = $args['og_title'];
		$meta_args['og_sitename']  = $args['og_sitename'];
		$meta_args['og_description']  = $args['og_description'];
		$meta_args['og_type']  = $args['og_type'];
		$meta_args['og_url']  = $args['og_url'];
		$meta_args['meta_robots']  = $args['meta_robots'];
		$meta_args['meta_coverage']  = $args['meta_coverage'];
		$meta_args['meta_distribution']  = $args['meta_distribution'];
        return $meta_args;
	}

	function token_gen(){
   		$token = openssl_random_pseudo_bytes(6);
        $token = bin2hex($token);
        $token = strtoupper(wordwrap($token , 4 , '-' , true ));
        return $token;
    }

	function session_token_gen(){
   		$token = openssl_random_pseudo_bytes(12);
        $token = bin2hex($token);
        return $token;
    }

	function all_url_segment(){
		$url = "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$path = parse_url($url);
		// $newpath = substr($path['path'], 1);
		$newpath = substr($path['path'], 5);
        return $newpath;
    }

	function unset_meta_args($args){
		unset(	
			$args['meta_keywords'], 
			$args['meta_description'],
			$args['og_title'], 
			$args['og_url'],
			$args['og_sitename'], 
			$args['og_description'],
			$args['og_image'], 
			$args['exis_og_image'], 
			$args['og_type'], 
			$args['meta_robots'], 
			$args['meta_coverage'], 
			$args['meta_distribution']
		);
        return $args;
	}

	// function CheckTypeId($type_id = NULL){
	// 	switch($type_id){
	// 		case 1: $url = '';
	// 	}
	// }

}

?>