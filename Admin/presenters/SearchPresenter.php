<?php

namespace AdminModule\SearchModule;

/**
 * Description of
 *
 * @author Tomas Voslar <t.voslar at webcook.cz>
 */
class SearchPresenter extends BasePresenter {

    protected function startup() {
	parent::startup();
    }

    protected function beforeRender() {
	parent::beforeRender();

    }

    public function actionDefault($idPage){
    }

    public function renderDefault($idPage){
	$this->reloadContent();

	$this->template->idPage = $idPage;
    }
}