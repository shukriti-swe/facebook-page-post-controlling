<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Urllists extends CI_Model
{
    // var $table = 'recommendations';
    // var $column_order = array(null, 'id','fb_request_date'); //set column field database for datatable orderable
    // var $column_search = array('fb_request_full_name','tags','source'); //set column field database for datatable searchable 
    // var $order = array('id' => 'asc'); // default order 

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function insertData($table,$data){
        
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }
    public function getSingleSite($id){
        $this->db->select('url');
        $this->db->from('urllists');
        $this->db->where('fb_id',null);
        $this->db->where('project_id',$id);
        $this->db->where('status',0);
        $this->db->limit(1);
        $query_result = $this->db->get();
       
        $result = $query_result->result();
        $newArray = array_map(function($o) {
            return is_object($o) ? $o->url : $o['url'];
        }, $result);
        return $newArray;
       }
    public function getSettigns($id){
        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('id',$id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
       }
    public function selectAllData($id = 1){
        $this->db->select('*');
        $this->db->from('settings');
       // $this->db->where('id',$id);
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
       }
    public function getAllproject(){
        $ntime =  time();

        $this->db->select('*');
        $this->db->from('settings');
        $this->db->where('renew_time <',$ntime);
        $this->db->where('status',1);
       // $this->db->limit(10);
        $query_result = $this->db->get();

        $result = $query_result->result();
        return $result;
       }



   public function countProcessData($id){
        $this->db->where('fb_id !=','');
        $this->db->where('project_id',$id);
         return $this->db->get('urllists')->num_rows();
    }
    public function updateData2($table,$data,$selector,$select){
        $this->db->where($selector,$select);
        return $this->db->update($table,$data);
    }
    public function updateData($table,$data,$selector,$select,$project_id){
        $this->db->where($selector,$select);
        $this->db->where('project_id',$project_id);
        $result= $this->db->update($table,$data);

        //$date = date('Y-m-d H:i:s');
        //$data2['renew_time'] =  date("Y-m-d H:i:s", strtotime('-2 hours'));
    //     $data2['renew_time'] =  time();
    //     $this->db->where('id',$project_id);
    //     $result= $this->db->update('settings',$data2);

    //     $this->db->select('*');
    //     $this->db->from('settings');
    //    // $this->db->where('id',$id);
    //     $query_result = $this->db->get();
    //     $result = $query_result->result();

        return $result;
    } 
    
    public function countAllData($id){
               $this->db->where('project_id',$id);
        return $this->db->get('urllists')->num_rows();
    }


    public function deleteData($table,$selector,$select){
        $this->db->where($selector,$select);
        return $this -> db -> delete($table);
    }

    public function againXmlUpload($file_name,$project_id){
        $handle = FCPATH . 'uploads/xmlfile/'.$file_name;
				//$handle = FCPATH . 'uploads/xmlfile/new.xml';
				$allurl = @simplexml_load_file($handle);
				
					
				$j = 0;
				$data = [];
				foreach($allurl as $url){
					$urllist = []; 
					$single_url = (array) $url->loc[0];
					$urllist['url'] = $single_url[0];
					$urllist['status'] = 0;
					$urllist['project_id'] = $project_id;
					$this->Urllists->insertData('urllists',$urllist);
					$j++;
				}
        $data2['xml_file_name']= $file_name;
           $getinfo = $this ->db
           -> select('frequency')
           -> where('id',$project_id)
           -> limit(1)
           -> get('settings')-> row();

        $data2['renew_time']=  date("Y-m-d H:i:s", strtotime('+'. $getinfo->frequency.' hours'));
				$this->db->where('id',$project_id);
				$result= $this->db->update('settings',$data2);
                return $result;
    }
		public function project_time($pid,$frequency){
		   
		    $new_time= time()+$frequency*3600;
		    
            $data2['renew_time']= $new_time;
            $this->db->where('id',$pid);
            $result= $this->db->update('settings',$data2);

		}	

        public function removeData($id){
		   
		$this->db->where('project_id',$id);
        $this->db->delete('urllists');

        $data['renew_time'] = time();
        $this->db->where('id',$id);
        $result= $this->db->update('settings',$data);


		}	 
}