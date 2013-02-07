<?php 

namespace NVUtility;

class NVImage 
{
	
	/**
    * Save all images in a entity table
    *
    * @access
    *   public
    * @param int_id $image
    *   <br />Id of the image
    * @param int $id
    *   <br />Resource id
    * @param array $entity
    *   <br />Array containing table name and primary key name
    * @return
    *   void
    */
    public static function save_image($image_id, $id, $entity = array())
    {
        // Find association
	    $entity_image_tot = count(
	    	\DB::select('*')
		    	->from($entity['table'])
		    	->where($entity['id'], $id)
		    	->and_where('image_id', $image_id)
		    	->execute()
    	);			
    		
    	// Create association
    	if($entity_image_tot == 0)
    	{
	    	\DB::insert($entity['table'])
		    	->columns(array($entity['id'], 'image_id'))
		    	->values(array($id, $image_id))
		    	->execute();
    	}
	}	
    	
   	/**
   	* Edit images of a entity
   	*
   	* @access
   	*   public
    * @param int_id $image
    *   <br />Id of the image
    * @param int $id
    *   <br />Resource id
    * @param array $entity
    *   <br />Array containing table name and primary key name
  	* @return
  	*   void
   	*/
	public static function edit_image($image_id, $id, $entity = array())
    {
    	// Set array of id
    	$entities_image = \DB::select('image_id')
    		->from($entity['table'])
    		->where($entity['id'], $id)
    		->execute();
    
    	
    	/*
    	// Delete all tags missing in the new tag list
    	foreach ($entities_tags as $entity_tags)
    	{
    		$tag_obj = \Model_Tag::find($entity_tags['tag_id']);
    		
    		if(!in_array($tag_obj->title, $tag_array))
    		{
    			\DB::delete($entity['table'])
    				->where($entity['id'], $id)
    				->and_where('tag_id', $tag_obj->id)
    				->execute();
    		}
    	}
    
    	self::save_tag($tag_list, $id, $entity);*/
	}	
    	
   	/**
   	* Retrieve image of a entity
   	*
   	* @access
   	*   public
    * @param int $image_id
    *   <br />Id of the image
    * @param int $id
    *   <br />Resource id
    * @param array $entity
    *   <br />Array containing table name and primary key name
  	* @return
  	*   void
   	*/
	public static function retrieve_image($image_id, $id, $entity = array())
    {
    	return \DB::select('image_id')
    		->from($entity['table'])
    		->where($entity['id'], $id)
    		->execute();
	}
    	
	/**
    * Delete all image of a entity
 	*
   	* @access
   	*   public
    * @param int $image_id
    *   <br />Id of the image
    * @param int $id
    *   <br />Resource id
    * @param array $entity
    *   <br />Array containing table name and primary key name
   	* @return
   	*   void
   	*/
   	public static function delete_image($image_id, $id, $entity = array())
   	{
    	\DB::delete($entity['table'])
    		->where($entity['id'], $id)
    		->and_where('image_id', $image_id)
	    	->execute();
   	}
    	
	/**
    * Delete all image from table
 	*
   	* @access
   	*   public
    * @param int $id
    *   <br />Resource id
    * @param array $table
    *   <br />Table to use
   	* @return
   	*   void
   	*/
   	public static function delete_all_images($id, $table)
   	{
    	\DB::delete($table)
    		->where('image_id', $id)
	    	->execute();
   	}
}
