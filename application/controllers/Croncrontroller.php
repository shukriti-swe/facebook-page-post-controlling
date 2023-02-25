<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Croncrontroller extends CI_Controller {

	public function __construct()
	{
	    // Call the CI_Model constructor
	    parent::__construct();
	    $this->load->model('Urllists');
	}

    public function getFBpost(){
     


        $getAllProject = $this->Urllists->getAllproject();
      
        foreach($getAllProject as $project){

          

            $userId = $this->getUserID($project->id);
            
          
            
            $page_access_key = $project->fb_page_access_token;
            $siteUrl = $this->Urllists->getSingleSite($project->id);
            
            if(empty($siteUrl)){
                $datas['status']=0;
                $datas['fb_id']=null;
                $this->db->where('project_id',$project->id);
                $this->db->update('urllists',$datas);
               

                $siteUrl = $this->Urllists->getSingleSite($project->id);
                
            }
            
         
            
           
            foreach( $siteUrl as $url){
            $myfbpost = $this->postToFB($url, $page_access_key,$project->id);
            $this->Urllists->project_time($project->id,$project->frequency);
            }
        

        }
      

       
    }


public function getUserID($project_id){
        $settings =  $this->Urllists->getSettigns($project_id);
        $ch = curl_init();
        $url = "https://graph.facebook.com/v12.0/me?fields=id,name&access_token=".$settings->long_fb_user_access_token;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
         $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        $data = json_decode($result, true);
        $userId =  $data['id']; 
        return $userId;  
}


// public function getAllPages($userId){

//     $settings =  $this->Urllists->getSettigns();
//     $ch = curl_init();
//     $url = "https://graph.facebook.com/".$userId."/accounts?fields=name,access_token&access_token=".$settings->fb_user_access_token;

//     curl_setopt($ch, CURLOPT_URL, $url);
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
//     $result = curl_exec($ch);
//     if (curl_errno($ch)) {
//         echo 'Error:' . curl_error($ch);
//     }
//     curl_close ($ch);
//     //echo $result;
//     $pages = json_decode($result, true);
//     return $page_access_key = $pages['data'][1]['access_token'];
// }

public function postToFB($dataurl, $page_access_key,$project_id){
    $settings =  $this->Urllists->getSettigns($project_id);
    $ch = curl_init();

    $url = "https://graph.facebook.com/v12.0/".$settings->fb_page_id."/feed";

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,
                "link=".urlencode($dataurl)."&access_token=".$page_access_key);
    
   $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close ($ch);
    $fb_id = json_decode($result);

    if($fb_id->error){
        
        $datas['error_message']=$fb_id->error->message;
        $datas['status']=4;

        $this->db->where('id',$project_id);
        $this->db->update('settings',$datas);
      
        $this->getFBpost();
    }
    
    $data = [
    'fb_id'=> $fb_id->id,
    'status'=>1
    ];
    $siteUrl = $this->Urllists->updateData('urllists',$data,'url',$dataurl,$project_id);
    
  
   
   // echo $project_id;die();
    echo $result;
}

            


}