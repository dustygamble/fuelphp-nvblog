<?php 

namespace NVUtility;

class NVString
{

	/**
	* Prints all the values in the input array
	*  
	* @access 
	*   public 
	* @param array $array 
	*   <br />Array of Model. Each model must have a "title" property
	* @param boolean $link 
	*   <br />Generate a link or not
	* @param string $url 
	*   <br />Url to use to generate link
	* @param string $prepend 
	*   <br />String to prepend to the link
	* @param string $append 
	*   <br />String to append to the link
	* @return 
	*   string
	*/
	public static function print_array($array, $link = false, $url = '', $field = 'id', $prepend = '', $append = '')
    {
    	$array_string = '';
    	$array_count = count($array);
    	$i = 1;
    	
		foreach ($array as $key => $model) 
		{ 
			// Create value string
			if($link == true)
			{
				$array_string .= "<a href='".\Uri::create($url.'/'.$model->$field)."'>".$prepend.$model->title.$append."</a>";
			}
			else 
			{
				$array_string .= $model->title;
			}
			
			
			// Add string terminator
			if($i<$array_count && $prepend == '' && $append == '')
			{
				$array_string .= ', ';
			}
			
			$i++;
		}
		
		return $array_string;
    }
    
    
    public static function published_status_to_text($status)
    {
        $value = '';
        
        if($status == 0)        $value = \Lang::get('nvblog.shared.publish_status.draft');
        else if($status == 1)   $value = \Lang::get('nvblog.shared.publish_status.published');
        
        return $value;
    }
    
    public static function text_to_published_status($status)
    {
        $value = 0;
        
        if($status == \Lang::get('nvblog.shared.publish_status.draft'))             $value = 0;
        else if($status == \Lang::get('nvblog.shared.publish_status.published'))    $value = 1;
        
        return $value;
    }
}
