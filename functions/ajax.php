<?php
// =========================================================
// REQUIRE
// =========================================================
require($_SERVER["DOCUMENT_ROOT"].'/wp-blog-header.php');

header("HTTP/1.1 200 OK");


class AJAX{                                            
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct($action)
	{			
		if(method_exists($this, $action))
		{
			$this->$action();
		}		
	}

	/**
	 * Get more items to social hub
	 */
	public function more()
	{
		$off            = intval($_POST['count']) * intval($_POST['more_count']);
		$items          = $GLOBALS['social_hub']->getItems();
		$items          = array_slice($items, $off, intval($_POST['count']));
		$JSON['html']   = $GLOBALS['social_hub']->wrapItems($items);
		$JSON['result'] = true;

		echo json_encode($JSON);
	}
}

// =========================================================
// LAUNCH
// =========================================================
$GLOBALS['AJAX'] = new AJAX($_GET['action']);