<?php 

namespace NVUtility;

class NVPermission 
{

	/**
	* Check if user is allowed to perform action
	* 
	* @return boolean, true if allowed, false if not allowed
	*/
    public static function is_allowed($roles)
    {
    	$access = \Auth::has_access($roles);
    	
    	if($access)
    	{
    		return true;  
    	}
    	else
    	{
	    	return false;
    	}
    }
}
