<?php

namespace WebCMS\SearchModule;

/**
 * Description of Page
 *
 * @author Tomas Voslar <t.voslar at webcook.cz>
 */
class Search extends \WebCMS\Module {
    
    protected $name = 'Search';

    protected $author = 'Tomas Voslar';

    protected $presenters = array(
	    array(
		    'name' => 'Search',
		    'frontend' => TRUE,
		    'parameters' => FALSE
		    ),
	    array(
		    'name' => 'Settings',
		    'frontend' => FALSE
		    )
    );

    public function __construct(){
	$this->addBox('searchBox', 'Search', 'searchBox');
    }
}
