<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class category_model extends CI_Model
{
public function create($name)
{
$data=array("name" => $name);
$query=$this->db->insert( "reniscience_category", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("reniscience_category")->row();
return $query;
}
function getsinglecategory($id){
$this->db->where("id",$id);
$query=$this->db->get("reniscience_category")->row();
return $query;
}
public function edit($id,$name)
{
$data=array("name" => $name);
$this->db->where( "id", $id );
$query=$this->db->update( "reniscience_category", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `reniscience_category` WHERE `id`='$id'");
return $query;
}	
	  public function getcategorydropdown()
	{
		$query=$this->db->query("SELECT * FROM `reniscience_category`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}

}
?>
