<?php

namespace FrontendModule\SearchModule;

/**
 * Description of
 *
 * @author Tomas Voslar <t.voslar at webcook.cz>
 */
class SearchPresenter extends \FrontendModule\BasePresenter{
	
    protected function startup() {
	parent::startup();
    }

    protected function beforeRender() {
	parent::beforeRender();	
    }
	
    public function actionDefault($id){

    }
	
    public function renderDefault($id){

	$this->template->id = $id;
    }
}