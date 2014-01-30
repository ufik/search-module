<?php

namespace AdminModule\SearchModule;

/**
 * Description of
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class SettingsPresenter extends BasePresenter {
	
    protected function startup() {
	parent::startup();
    }

    protected function beforeRender() {
	parent::beforeRender();	
    }
	
    public function actionDefault($idPage){

    }
	
    public function createComponentSettingsForm(){

	$settings = array();
	
	$entities = array();
	
	$meta = $this->em->getMetadataFactory()->getAllMetadata();
	foreach ($meta as $m) {
	    $entities[] = $m->getName();
	}
	
	dump($entities);
	
	return $this->createSettingsForm($settings);
    }
	
    public function renderDefault($idPage){
	$this->reloadContent();

	$this->template->idPage = $idPage;
    }
}