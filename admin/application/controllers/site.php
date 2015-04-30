<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function index()
	{	
		$access=array("1");
$this->checkaccess($access);
$data["page"]="viewstory";
$data["base_url"]=site_url("site/viewstoryjson");
$data["title"]="View story";
$this->load->view("template",$data);
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data['category']=$this->category_model->getcategorydropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
//            $category=$this->input->post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
        
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`logintype`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('templatewith2',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
//            $category=$this->input->get_post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    
    
    
    
public function viewstory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewstory";
$data["base_url"]=site_url("site/viewstoryjson");
$data["title"]="View story";
$this->load->view("template",$data);
}
function viewstoryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reniscience_story`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`reniscience_story`.`title`";
$elements[1]->sort="1";
$elements[1]->header="Title";
$elements[1]->alias="title";
$elements[2]=new stdClass();
$elements[2]->field="`reniscience_story`.`content`";
$elements[2]->sort="1";
$elements[2]->header="Content";
$elements[2]->alias="content";
$elements[3]=new stdClass();
$elements[3]->field="`reniscience_story`.`numberofimage`";
$elements[3]->sort="1";
$elements[3]->header="Number of image";
$elements[3]->alias="numberofimage";
$elements[4]=new stdClass();
$elements[4]->field="`reniscience_story`.`image1`";
$elements[4]->sort="1";
$elements[4]->header="Image1";
$elements[4]->alias="image1";
$elements[5]=new stdClass();
$elements[5]->field="`reniscience_story`.`image2`";
$elements[5]->sort="1";
$elements[5]->header="Image2";
$elements[5]->alias="image2";
$elements[6]=new stdClass();
$elements[6]->field="`reniscience_story`.`status`";
$elements[6]->sort="1";
$elements[6]->header="Status";
$elements[6]->alias="status";
$elements[7]=new stdClass();
$elements[7]->field="`reniscience_story`.`timestamp`";
$elements[7]->sort="1";
$elements[7]->header="Timestamp";
$elements[7]->alias="timestamp";
	
//$elements[8]=new stdClass();
//$elements[8]->field="`reniscience_category`.`category`";
//$elements[8]->sort="1";
//$elements[8]->header="Category";
//$elements[8]->alias="category";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reniscience_story`");
$this->load->view("json",$data);
}

public function createstory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createstory";
	$data[ 'status' ] =$this->user_model->getstatusdropdown();
	$data[ 'category' ] =$this->category_model->getcategorydropdown();
	$data[ 'numberofimage' ] =$this->story_model->getnumberofimagedropdown();
$data["title"]="Create story";
$this->load->view("template",$data);
}
public function createstorysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("title","Title","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("numberofimage","Number of image","trim");
$this->form_validation->set_rules("image1","Image1","trim");
$this->form_validation->set_rules("image2","Image2","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
	$data[ 'status' ] =$this->user_model->getstatusdropdown();
	$data[ 'numberofimage' ] =$this->story_model->getnumberofimagedropdown();
	$data[ 'category' ] =$this->category_model->getcategorydropdown();
$data["page"]="createstory";
$data["title"]="Create story";
$this->load->view("template",$data);
}
else
{
$title=$this->input->get_post("title");
$content=$this->input->get_post("content");
$numberofimage=$this->input->get_post("numberofimage");
$category=$this->input->get_post("category");
$image1=$this->input->get_post("image1");
$image2=$this->input->get_post("image2");
$status=$this->input->get_post("status");
$timestamp=$this->input->get_post("timestamp");
	$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image1";
			$image1="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image1=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image1=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
	$filename="image2";
			$image2="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image2=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image2=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
if($this->story_model->create($title,$content,$numberofimage,$image1,$image2,$status,$timestamp,$category)==0)
$data["alerterror"]="New story could not be created.";
else
$data["alertsuccess"]="story created Successfully.";
$data["redirect"]="site/viewstory";
$this->load->view("redirect",$data);
}
}
public function editstory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editstory";
	$data[ 'status' ] =$this->user_model->getstatusdropdown();
	$data[ 'numberofimage' ] =$this->story_model->getnumberofimagedropdown();
	$data[ 'category' ] =$this->category_model->getcategorydropdown();
	 $data['selectedcategory']=$this->story_model->getcategorybystory($this->input->get_post('id'));
	$selectedcategory=$data['selectedcategory'];
$data["page2"]="block/userblock";
$data["title"]="Edit story";
$data["before"]=$this->story_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editstorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("title","Title","trim");
$this->form_validation->set_rules("content","Content","trim");
$this->form_validation->set_rules("numberofimage","Number of image","trim");
$this->form_validation->set_rules("image1","Image1","trim");
$this->form_validation->set_rules("image2","Image2","trim");
$this->form_validation->set_rules("status","Status","trim");
$this->form_validation->set_rules("timestamp","Timestamp","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
	$data[ 'status' ] =$this->user_model->getstatusdropdown();
	$data[ 'category' ] =$this->category_model->getcategorydropdown();
	 $data['selectedcategory']=$this->story_model->getcategorybystory($this->input->get_post('id'));
$data["page"]="editstory";
$data["title"]="Edit story";
$data["before"]=$this->story_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$title=$this->input->get_post("title");
$content=$this->input->get_post("content");
$numberofimage=$this->input->get_post("numberofimage");
$category=$this->input->get_post("category");
$image1=$this->input->get_post("image1");
$image2=$this->input->get_post("image2");
$status=$this->input->get_post("status");
$timestamp=$this->input->get_post("timestamp");
	$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image1";
			$image1="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image1=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image1=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image1=="")
            {
            $image1=$this->story_model->getstoryimagebyid1($id);
               // print_r($image);
                $image1=$image1->image1;
            }
	
			$filename="image2";
			$image2="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image2=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image2=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image2=="")
            {
            $image2=$this->story_model->getstoryimagebyid2($id);
               // print_r($image);
                $image2=$image2->image2;
            }
if($this->story_model->edit($id,$title,$content,$numberofimage,$image1,$image2,$status,$timestamp,$category)==0)
$data["alerterror"]="New story could not be Updated.";
else
$data["alertsuccess"]="story Updated Successfully.";
$data["redirect"]="site/viewstory";
$this->load->view("redirect",$data);
}
}
public function deletestory()
{
$access=array("1");
$this->checkaccess($access);
$this->story_model->delete($this->input->get("id"));
$data["redirect"]="site/viewstory";
$this->load->view("redirect",$data);
}
public function viewstoryimage()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewstoryimage";
$data["page2"]="block/userblock";
	$data['before']=$this->story_model->beforeedit($this->input->get('id'));
$data["base_url"]=site_url("site/viewstoryimagejson");
$data["title"]="View storyimage";
$this->load->view("templatewith2",$data);
}
function viewstoryimagejson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reniscience_storyimage`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
$elements[1]=new stdClass();
$elements[1]->field="`reniscience_storyimage`.`storyid`";
$elements[1]->sort="1";
$elements[1]->header="Story id";
$elements[1]->alias="storyid";
$elements[2]=new stdClass();
$elements[2]->field="`reniscience_storyimage`.`order`";
$elements[2]->sort="1";
$elements[2]->header="Order";
$elements[2]->alias="order";
$elements[3]=new stdClass();
$elements[3]->field="`reniscience_storyimage`.`image`";
$elements[3]->sort="1";
$elements[3]->header="image";
$elements[3]->alias="image";
$elements[4]=new stdClass();
$elements[4]->field="`reniscience_storyimage`.`status`";
$elements[4]->sort="1";
$elements[4]->header="Status";
$elements[4]->alias="status";
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reniscience_storyimage`");
$this->load->view("json",$data);
}

public function createstoryimage()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createstoryimage";
$data[ 'status' ] =$this->user_model->getstatusdropdown();
$data[ 'storyid' ] =$this->story_model->getstorydropdown();
$data["title"]="Create storyimage";
$this->load->view("template",$data);
}
public function createstoryimagesubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("storyid","Story id","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("status","Status","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
	$data[ 'status' ] =$this->user_model->getstatusdropdown();
	$data[ 'storyid' ] =$this->story_model->getstorydropdown();
$data["page"]="createstoryimage";
$data["title"]="Create storyimage";
$this->load->view("template",$data);
}
else
{
$storyid=$this->input->get_post("storyid");
$order=$this->input->get_post("order");
$image=$this->input->get_post("image");
$status=$this->input->get_post("status");
	$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
if($this->storyimage_model->create($storyid,$order,$image,$status)==0)
$data["alerterror"]="New storyimage could not be created.";
else
$data["alertsuccess"]="storyimage created Successfully.";
$data["redirect"]="site/viewstoryimage";
$this->load->view("redirect",$data);
}
}
public function editstoryimage()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editstoryimage";
	$data[ 'status' ] =$this->user_model->getstatusdropdown();
	$data[ 'storyid' ] =$this->story_model->getstorydropdown();
$data["title"]="Edit storyimage";
	$data["page2"]="block/userblock";
$data["before"]=$this->storyimage_model->beforeedit($this->input->get("id"));
$this->load->view("templatewith2",$data);
}
public function editstoryimagesubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("storyid","Story id","trim");
$this->form_validation->set_rules("order","Order","trim");
$this->form_validation->set_rules("image","image","trim");
$this->form_validation->set_rules("status","Status","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
	$data[ 'status' ] =$this->user_model->getstatusdropdown();
	$data[ 'storyid' ] =$this->story_model->getstorydropdown();
$data["page"]="editstoryimage";
$data["title"]="Edit storyimage";
$data["before"]=$this->storyimage_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$storyid=$this->input->get_post("storyid");
$order=$this->input->get_post("order");
$image=$this->input->get_post("image");
$status=$this->input->get_post("status");
	$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->story_model->getstoryimagebyid1($id);
               // print_r($image);
                $image=$image->image;
            }
if($this->storyimage_model->edit($id,$storyid,$order,$image,$status)==0)
$data["alerterror"]="New storyimage could not be Updated.";
else
$data["alertsuccess"]="storyimage Updated Successfully.";
$data["redirect"]="site/viewstoryimage";
$this->load->view("redirect",$data);
}
}
public function deletestoryimage()
{
$access=array("1");
$this->checkaccess($access);
$this->storyimage_model->delete($this->input->get("id"));
$data["redirect"]="site/viewstoryimage";
$this->load->view("redirect",$data);
}
	
	
	
// category
	
	
	
	
	
public function viewcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="viewcategory";
$data["base_url"]=site_url("site/viewcategoryjson");
$data["title"]="View category";
$this->load->view("template",$data);
}
function viewcategoryjson()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reniscience_category`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";
	
$elements[1]=new stdClass();
$elements[1]->field="`reniscience_category`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";
	
$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
$maxrow=20;
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reniscience_category`");
$this->load->view("json",$data);
}

public function createcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="createcategory";
$data["title"]="Create category";
$this->load->view("template",$data);
}
public function createcategorysubmit() 
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="createcategory";
$data["title"]="Create category";
$this->load->view("template",$data);
}
else
{
$name=$this->input->get_post("name");
if($this->category_model->create($name)==0)
$data["alerterror"]="New category could not be created.";
else
$data["alertsuccess"]="category created Successfully.";
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
}
public function editcategory()
{
$access=array("1");
$this->checkaccess($access);
$data["page"]="editcategory";
$data["title"]="Edit category";
$data["before"]=$this->category_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
public function editcategorysubmit()
{
$access=array("1");
$this->checkaccess($access);
$this->form_validation->set_rules("id","ID","trim");
$this->form_validation->set_rules("name","Name","trim");
if($this->form_validation->run()==FALSE)
{
$data["alerterror"]=validation_errors();
$data["page"]="editcategory";
$data["title"]="Edit category";
$data["before"]=$this->category_model->beforeedit($this->input->get("id"));
$this->load->view("template",$data);
}
else
{
$id=$this->input->get_post("id");
$name=$this->input->get_post("name");
if($this->category_model->edit($id,$name)==0)
$data["alerterror"]="New category could not be Updated.";
else
$data["alertsuccess"]="category Updated Successfully.";
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
}
public function deletecategory()
{
$access=array("1");
$this->checkaccess($access);
$this->category_model->delete($this->input->get("id"));
$data["redirect"]="site/viewcategory";
$this->load->view("redirect",$data);
}
	
}
?>