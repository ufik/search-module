<?php

namespace FrontendModule\SearchModule;

use Nette\Application\UI;
use Kdyby\BootstrapFormRenderer\BootstrapRenderer;

/**
 * Description of
 *
 * @author Tomas Voslar <t.voslar at webcook.cz>
 */
class SearchPresenter extends \FrontendModule\BasePresenter{
	
    /**
     * @var Array<SearchResult>
     */
    private $results;
    
    protected function startup() {
	parent::startup();
    }

    protected function beforeRender() {
	parent::beforeRender();	
    }
	
    public function actionDefault($id){

    }
	
    public function renderDefault($id){

        $this->template->results = $this->results;
	$this->template->id = $id;
    }
    
    public function createComponentSearchForm($name, $context = null, $fromPage = null){
        
	if($context != null){
	    
	    $form = new UI\Form();

	    $form->getElementPrototype()->action = $context->link('default', array(
		    'path' => $fromPage->getPath(),
		    'abbr' => $context->abbr,
		    'do' => 'searchForm-submit'
	    ));

	    $form->setTranslator($context->translator);
	    $form->setRenderer(new BootstrapRenderer);

	}else{
	    $form = $this->createForm('searchForm-submit');
	}
	
        $form->setMethod('get');
        
        $form->addText('q', 'Search phrase')->setDefaultValue($this->getParameter('q'))->setAttribute('class', array('form-control'));
        
        $form->addSubmit('send', 'Search');
        $form->onSuccess[] = callback($this, 'searchFormSubmitted');
        
        return $form;
    }
    
    public function searchFormSubmitted($form){
        $values = $form->getValues();
        
        $packages = $this->em->getRepository('WebCMS\SearchModule\Doctrine\SearchSetting')->findBySearch(true);
        
	$results = array();
	if(strlen($values->q) > 0){
	
	    // fetch pages where to search
	    foreach($packages as $p){
		$module = $this->createObject($p->getPackage());

		if($module->isSearchable()){
		    $tmp = $module->search($this->em, $values->q, $this->language);
		    $results = array_merge($results, $tmp);
		}
	    }
	
	}else{
	    $this->flashMessage('Nothing to search. Please type search phrase.', 'danger');
	}
        
        $this->results = $results;        
    }
    
    public function searchBox($context, $fromPage){
		
	$template = $context->createTemplate();
	$template->searchForm = $this->createComponentSearchForm('searchForm', $context, $fromPage);
	$template->setFile('../app/templates/search-module/Search/boxes/search.latte');

	return $template;
    }
}