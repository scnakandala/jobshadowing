<?php
class Organisation {
    var $id;
    var $name;
    var $url;
    var $isUni;
    
    function __construct($id, $name, $url, $isUni) {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->isUni = $isUni;
    }

    public function getIsUni() {
        return $this->isUni;
    }

    public function setIsUni($isUni) {
        $this->isUni = $isUni;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getUrl() {
        return $this->url;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setUrl($url) {
        $this->url = $url;
    }
}
?>