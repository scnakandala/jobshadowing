<?php

class Request {
   var $id;
   var $user_id;
   var $session_id;
   
   function __construct($id, $user_id, $session_id) {
       $this->id = $id;
       $this->user_id = $user_id;
       $this->session_id = $session_id;
   }

   
   public function getId() {
       return $this->id;
   }

   public function getUser_id() {
       return $this->user_id;
   }

   public function getSession_id() {
       return $this->session_id;
   }

   public function setId($id) {
       $this->id = $id;
   }

   public function setUser_id($user_id) {
       $this->user_id = $user_id;
   }

   public function setSession_id($session_id) {
       $this->session_id = $session_id;
   }
}

?>