<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class story_model extends CI_Model
{
public function create($title,$content,$numberofimage,$image1,$image2,$status,$timestamp,$category)
{
$data=array(
			"title" => $title,
			"content" => $content,
			"numberofimage" => $numberofimage,
			"image1" => $image1,
			"image2" => $image2,
			"status" => $status,
			"timestamp" => NULL
);
$query=$this->db->insert( "reniscience_story", $data );
$story=$this->db->insert_id();


	  foreach($category AS $key=>$value)
        {
            $this->story_model->createcategory($story,$value);
        }
    if(!$query)
	return  0;
	else
	return  $story;
    }
	
    public function createcategory($story,$category)
	{
		$data  = array(
			'story' => $story,
			'category' => $category
		);
		$query=$this->db->insert( 'reniscience_storycategory', $data );
//		return  1;
	}
	
	
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("reniscience_story")->row();
return $query;
}
function getsinglestory($id){
$this->db->where("id",$id);
$query=$this->db->get("reniscience_story")->row();
$query["imageArr"]=$this->db->query("SELECT * FROM `reniscience_storyimage` WHERE `storyid`='$id'")->result();
return $query;
}
public function edit($id,$title,$content,$numberofimage,$image1,$image2,$status,$timestamp,$category)
{
$data=array("title" => $title,"content" => $content,"numberofimage" => $numberofimage,"image1" => $image1,"image2" => $image2,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "reniscience_story", $data );
 $querydelete=$this->db->query("DELETE FROM `reniscience_storycategory` WHERE `story`='$id'");
	$story=$id;
        foreach($category AS $key=>$value)
        {
            $this->story_model->createcategory($story,$value);
        }
return 1;
}
	
//	   public function edit($id,$name,$duration,$dateofrelease,$rating,$director,$writer,$casteandcrew,$summary,$twittertrack,$trailer,$isfeatured,$isintheator,$iscommingsoon,$genre,$image)
//    {
//        $data=array("name" => $name,"duration" => $duration,"dateofrelease" => $dateofrelease,"rating" => $rating,"director" => $director,"writer" => $writer,"casteandcrew" => $casteandcrew,"summary" => $summary,"twittertrack" => $twittertrack,"trailer" => $trailer,"isfeatured" => $isfeatured,"isintheator" => $isintheator,"iscommingsoon" => $iscommingsoon,"image" => $image);
//        $this->db->where( "id", $id );
//        $query=$this->db->update( "movie_movie", $data );
//        $querydelete=$this->db->query("DELETE FROM `moviegenre` WHERE `movie`='$id'");
//        foreach($genre AS $key=>$value)
//        {
//            $this->movie_model->createmoviegenre($value,$id);
//        }
//        return 1;
//    }
	   
	public function getstoryimagebyid1($id)
	{
		$query=$this->db->query("SELECT `image1` FROM `reniscience_story` WHERE `id`='$id'")->row();
		return $query;
	}
	public function getstoryimagebyid2($id)
	{
		$query=$this->db->query("SELECT `image2` FROM `reniscience_story` WHERE `id`='$id'")->row();
		return $query;
	}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `reniscience_story` WHERE `id`='$id'");
return $query;
}
	public function getnumberofimagedropdown(){
$query=$this->db->query("SELECT * FROM `numberofimage`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
	public function getstorydropdown(){
$query=$this->db->query("SELECT * FROM `reniscience_story`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->title;
		}
		
		return $return;
	}
	  public function getcategorybystoryold($id)
	{
         $return=array();
		$query=$this->db->query("SELECT `id`,`story`,`category` FROM `reniscience_storycategory`  WHERE `story`='$id'");
        if($query->num_rows() > 0)
        {
            $query=$query->result();
            foreach($query as $row)
            {
                $return[]=$row->category;
            }
        }
         return $return;
	}

	
     public function getcategorybystory($id)
	{
//         echo "Hello";
         $return=array();
		$query=$this->db->query("SELECT `id`,`story`,`category` FROM `reniscience_storycategory`  WHERE `story`='$id'");
        if($query->num_rows() > 0)
        {
            $query=$query->result();
            foreach($query as $row)
            {
                $return[]=$row->category;
            }
        }
         return $return;
	}
}
?>
