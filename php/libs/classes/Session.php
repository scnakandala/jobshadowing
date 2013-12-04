<?php

class Session {
    var $id;
    var $mentor;
    var $start;
    
    function __construct($id, $mentor, $start) {
        $this->id = $id;
        $this->mentor = $mentor;
        $this->start = $start;
    }

    
    public function getId() {
        return $this->id;
    }

    public function getMentor() {
        return $this->mentor;
    }

    public function getStart() {
        return $this->start;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setMentor($mentor) {
        $this->mentor = $mentor;
    }

    public function setStart($start) {
        $this->start = $start;
    }

}
?>