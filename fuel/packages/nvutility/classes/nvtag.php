<?php 

namespace NVUtility;

class NVTag 
{    
    
    /**
    * Save all tags and eventually creates new one
    *
    * @access
    *   public
    * @param array $tag_list
    *   <br />String of tag
    * @param int $id
    *   <br />Resource id
    * @return
    *   void
    */
    public static function save_tag($tag_list, $id, $entity = array())
    {
	    $tag_array = explode(", ", $tag_list);
	    		
	    foreach ($tag_array as $tag_title)
	    {
		    // Find tag
		    $tag_obj = $entity['model']::find()
			    ->where('title', $tag_title)
			    ->get_one();
	    			
		    // Create a new tag
		    if($tag_obj === null)
		    {
		    	$tag_obj = $entity['model']::forge(array(
		    		'title' => $tag_title
		    	));
		    	
			    if(!($tag_obj && $tag_obj->save()))
			    {
			    	break;
			    }
		    }
    	
		    // Find association
		    $entity_tags_tot = count(
		    	\DB::select('*')
			    	->from($entity['table'])
			    	->where($entity['id'], $id)
			    	->and_where('tag_id', $tag_obj->id)
			    	->execute()
	    	);			
	    		
	    	// Create association
	    	if($entity_tags_tot == 0)
	    	{
		    	\DB::insert($entity['table'])
			    	->columns(array($entity['id'], 'tag_id'))
			    	->values(array($id, $tag_obj->id))
			    	->execute();
	    	}
	    }
	}
    	
   	/**
   	* Edit album's tag
   	*
   	* @access
   	*   public
   	* @param array $tag_list
   	*   <br />String of tag
   	* @param int $id
   	*   <br />Album id
  	* @return
  	*   void
   	*/
	public static function edit_tag($tag_list, $id, $entity = array())
    {
    	// Set array of string
    	$tag_array = explode(", ", $tag_list);
    
    	// Set array of id
    	$entities_tags = \DB::select('tag_id')
    		->from($entity['table'])
    		->where($entity['id'], $id)
    		->execute();
    
    	// Delete all tags missing in the new tag list
    	foreach ($entities_tags as $entity_tags)
    	{
    		$tag_obj = $entity['model']::find($entity_tags['tag_id']);
    		
    		if(!in_array($tag_obj->title, $tag_array))
    		{
    			\DB::delete($entity['table'])
    				->where($entity['id'], $id)
    				->and_where('tag_id', $tag_obj->id)
    				->execute();
    		}
    	}
    
    	self::save_tag($tag_list, $id, $entity);
	}
    	
	/**
    * Delete all tag of an album
 	*
   	* @access
   	*   public
   	* @param int $id
   	*   <br />Album id
   	* @return
   	*   void
   	*/
   	public static function delete_tag($id, $entity = array())
   	{
    	\DB::delete($entity['table'])
    		->where($entity['id'], $id)
	    	->execute();
   	}
}
