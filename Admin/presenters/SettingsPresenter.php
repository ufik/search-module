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

    public function actionDefault($idPage) {
        
    }

    public function createComponentSearchSettingForm() {

        $form = $this->createForm();

        $packages = \WebCMS\SystemHelper::getPackages();

        foreach ($packages as $key => $package) {

            if ($package['vendor'] === 'webcms2' && $package['package'] !== 'webcms2' && $package['package'] !== 'search-module') {
                $object = $this->createObject($package['package']);

                if ($object->isSearchable()) {
                    $setting = $this->em->getRepository('WebCMS\SearchModule\Doctrine\SearchSetting')->findOneByPackage($package['package']);
                    
                    $active = is_object($setting) ? $setting->getSearch() : false;
                    
                    $form->addCheckbox(str_replace('-', '_', $package['package']), $package['package'])->setValue($active);
                } else {
                    $form->addCheckbox(str_replace('-', '_', $package['package']), $package['package'] . ' not searchable.')->setDisabled(true);
                }
            }
        }
        
        $form->addSubmit('send', 'Save')->setAttribute('class', array('btn btn-success'));
        $form->onSuccess[] = callback($this, 'searchSettingFormSubmitted');
        
        return $form;
    }

    public function searchSettingFormSubmitted(\Nette\Forms\Form $form){
        $values = $form->getValues();
        
        foreach($values as $key => $v){
            
            $key = str_replace('_', '-', $key);
            
            $setting = $this->em->getRepository('WebCMS\SearchModule\Doctrine\SearchSetting')->findOneBy(array(
                'package' => $key
            ));
            
            if(!is_object($setting)){
                $setting = new \WebCMS\SearchModule\Doctrine\SearchSetting;                
                $setting->setPackage($key);
            }
            
            $setting->setSearch($v);
            
            if(!$setting->getId()){
                $this->em->persist($setting);
            }
        }
        
        $this->em->flush();
        
        $this->flashMessage('Search settings has been saved.', 'success');
        $this->redirect('this');
    }
    
    public function renderDefault($idPage) {
        $this->reloadContent();

        $this->template->idPage = $idPage;
    }

}
