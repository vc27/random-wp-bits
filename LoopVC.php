<?php
/**
 * File Name:   LoopVC.php
 * @subpackage: MetaCake
 * @license:    MetaCake LLC
 * @version:    0.1
 * @updated:    10.08.12
 **/
#################################################################################################### */




/**
 * LoopVC
 **/
class LoopVC {
    
    
    
    var $current_item = -1;
	var $in_the_loop = false;
    
    
    
    /**
     * __construct
     *
     * @version 0.1
     * @updated 09.12.12
     **/
    function __construct( $array ) {
	    
	    $this->items = $array;
	    $this->item_count = count( $this->items );
        
	} // end function __construct
	
	
	
	
	
	
	/**
	 * Have items
     *
     * @version 0.1
     * @updated 09.12.12
	 **/
	function have_items() {
		
		if ( $this->has_items() ) { 
			
			if ( $this->current_item + 1 < $this->item_count ) {
				
				$this->in_the_loop = true;
				return true;
				
			} else if ( $this->current_item + 1 == $this->item_count AND $this->item_count > 0 ) {
				
				return false;
				
			}
			
			$this->in_the_loop = false;
			return false;
			
		} else {
			return false;
		}
		
	} // end function have_items
	
	
	
	
	
	
	/**
	 * has items
     *
     * @version 0.1
     * @updated 09.12.12
	 **/
	function has_items() {
	    
	    if ( is_array( $this->items ) AND ! empty( $this->items ) )
	        return true;
	    else
	        return false;
	    
	} // end function has_items
	
	
	
	
	
	
	/**
	 * The Item
	 * 
	 * @version 0.1
	 * @updated 09.12.12
	 **/
	function the_item() {
		global $item;
		$item = $this->next_item();
		return $item;
		
	} // end function the_item
	
	
	
	
	
	
	/**
	 * Next Item
	 * 
	 * @version 0.1
	 * @updated 09.12.12
	 **/
	function next_item() {
		
		$this->current_item++;
		
		$this->item = $this->items[$this->current_item];
		
		return $this->item;
		
	} // end function next_item
    
    
    
} // end class LoopVC
