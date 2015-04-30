<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{function getallstory()
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

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reniscience_story`");
$this->load->view("json",$data);
}
public function getsinglestory()
{
$id=$this->input->get_post("id");
$data["message"]=$this->story_model->getsinglestory($id);
$this->load->view("json",$data);
}
function getallstoryimage()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`reniscience_storyimage`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`reniscience_storyimage`.`storyid`";
$elements[1]->sort="1";
$elements[1]->header="Story id";
$elements[1]->alias="storyid";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`reniscience_storyimage`.`order`";
$elements[2]->sort="1";
$elements[2]->header="Order";
$elements[2]->alias="order";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`reniscience_storyimage`.`image`";
$elements[3]->sort="1";
$elements[3]->header="image";
$elements[3]->alias="image";

$elements=array();
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
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `reniscience_storyimage`");
$this->load->view("json",$data);
}
public function getsinglestoryimage()
{
$id=$this->input->get_post("id");
$data["message"]=$this->storyimage_model->getsinglestoryimage($id);
$this->load->view("json",$data);
}
 public function stories(){
 $storyid=$this->input->get_post("id");
$data["message"]=$this->restapi_model->getstories($storyid);
$this->load->view("json",$data);
 }
 public function getallstories(){
 $data["message"]=$this->restapi_model->getallstories();
$this->load->view("json",$data);
 }
} ?>