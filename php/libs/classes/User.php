<?php
class User {
    var $id;
    var $name;
    var $url;
    var $role;
    var $org;
    var $orgUrl;
    var $start;
    var $sessionId;
    
    function __construct($id, $name, $url, $role, $org, $orgUrl, $start, $sessionId) {
        $this->id = $id;
        $this->name = $name;
        $this->url = $url;
        $this->role = $role;
        $this->org = $org;
        $this->orgUrl = $orgUrl;
        $this->start = $start;
        $this->sessionId = $sessionId;
    }
    
    public function getSessionId() {
        return $this->sessionId;
    }

    public function setSessionId($sessionId) {
        $this->sessionId = $sessionId;
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

    public function getRole() {
        return $this->role;
    }

    public function getOrg() {
        return $this->org;
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

    public function setRole($role) {
        $this->role = $role;
    }

    public function setOrg($org) {
        $this->org = $org;
    }

    public function getOrgUrl() {
        return $this->orgUrl;
    }

    public function setOrgUrl($orgUrl) {
        $this->orgUrl = $orgUrl;
    }
    
    public function getStart() {
        return $this->start;
    }

    public function setStart($start) {
        $this->start = $start;
    }
}
?>