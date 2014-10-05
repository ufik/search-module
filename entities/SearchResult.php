<?php

namespace WebCMS\SearchModule;

/**
 * @author Tomas Voslar <tomas.voslar at webcook.cz>
 */
class SearchResult {
    
    private $title;
    
    private $perex;
    
    private $url;
    
    private $rate;
    
    public function getUrl() {
        return $this->url;
    }

    public function getRate() {
        return $this->rate;
    }

    public function setUrl($url) {
        $this->url = $url;
    }

    public function setRate($rate) {
        $this->rate = $rate;
    }
    
    public function getTitle() {
        return $this->title;
    }

    public function getPerex() {
        return $this->perex;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setPerex($perex) {
        $this->perex = $perex;
    }

    public function toArray() {
        return array(
            'title' => $this->title,
            'perex' => $this->perex,
            'url' => $this->url,
            'rate' => $this->rate
        );
    }
}
