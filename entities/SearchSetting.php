<?php

namespace WebCMS\SearchModule\Doctrine;

use Doctrine\ORM\Mapping as orm;

/**
 * @orm\Entity
 * @orm\Table(name="SearchSettings")
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class SearchSetting extends \AdminModule\Doctrine\Entity {
    /**
     * @orm\Column
     */
    private $package;
    
    /**
     * @orm\Column(type="boolean")
     */
    private $search;
    
    public function getPackage() {
        return $this->package;
    }

    public function setPackage($package) {
        $this->package = $package;
    }
    
    public function getSearch() {
        return $this->search;
    }

    public function setSearch($search) {
        $this->search = $search;
    }        
}