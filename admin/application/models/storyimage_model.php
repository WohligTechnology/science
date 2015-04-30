<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class storyimage_model extends CI_Model
{
public function create($storyid,$order,$image,$status)
{
$data=array("storyid" => $storyid,"order" => $order,"image" => $image,"status" => $status);
$query=$this->db->insert( "reniscience_storyimage", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("reniscience_storyimage")->row();
return $query;
}
function getsinglestoryimage($id){
$this->db->where("id",$id);
$query=$this->db->get("reniscience_storyimage")->row();
return $query;
}
public function edit($id,$storyid,$order,$image,$status)
{
$data=array("storyid" => $storyid,"order" => $order,"image" => $image,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "reniscience_storyimage", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `reniscience_storyimage` WHERE `id`='$id'");
return $query;
}
}
?>
