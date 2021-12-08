<?php 
    class Comentario{
        private $_texto;
        private $_usuario_id;
        private $_post_id;

        public function __construct($texto, $usuario_id, $post_id){
            $this->setTexto($texto);
            $this->setUsuarioId($usuario_id);
            $this->setPost_id($post_id);
        }

        public function getTexto(){
            return $this->_texto;
        }

        public function setTexto($_texto){
            $this->_texto = $_texto;
        }

        public function getUsuarioId(){
            return $this->_usuario_id;
        }

        public function setUsuarioId($usuario_id){
            $this->_usuario_id = $usuario_id;
        }

        public function getPost_id(){
            return $this->_post_id;
        }

        public function setPost_id($post_id){
            $this->_post_id = $post_id;
        }
    }
?>