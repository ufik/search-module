<?php

namespace FrontendModule\SearchModule;

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
    
    public function createComponentSearchForm(){
        $form = $this->createForm('searchForm-submit');
        $form->setMethod('get');
        
        $form->addText('q', 'Search phrase')->setDefaultValue($this->getParameter('q'))->setAttribute('class', array('form-control'));
        
        $form->addSubmit('send', 'Search');
        $form->onSuccess[] = callback($this, 'searchFormSubmitted');
        
        return $form;
    }
    
    public function searchFormSubmitted($form){
        $values = $form->getValues();
        
        $packages = $this->em->getRepository('WebCMS\SearchModule\Doctrine\SearchSetting')->findBySearch(true);
        
        // fetch pages where to search
        $results = array();
        foreach($packages as $p){
            $module = $this->createObject($p->getPackage());
            
            if($module->isSearchable()){
                $tmp = $module->search($this->em, $values->q, $this->language);
                $results = array_merge($results, $tmp);
            }
        }
        
        $this->results = $results;        
    }
}