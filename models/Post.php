<?php 
    class Post{
        private $_id;
        private $_titulo;
        private $_subtitulo;
        private $_texto;
        private $_usuario_id;
        private $_imagen;
        private $_categoria;

        public function __construct($id, $titulo, $subtitulo, $texto, $usuario_id, $imagen, $categoria){
            $this->setId($id);
            $this->setTitulo($titulo);
            $this->setSubtitulo($subtitulo);
            $this->setTexto($texto);
            $this->setUsuarioId($usuario_id);
            $this->setImagen($imagen);
            $this->setCategoria($categoria);
        }

        public function getId(){
            return $this->_id;
        }

        public function setId($id){
            $this->_id = $id;
        }

        public function getTitulo(){
            return $this->_titulo;
        }

        public function setTitulo($titulo){
            $this->_titulo = $titulo;
        }

        public function getSubtitulo(){
            return $this->_subtitulo;
        }

        public function setSubtitulo($subtitulo){
            $this->_subtitulo = $subtitulo;
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

        public function getImagen(){
            return $this->_imagen;
        }

        public function setImagen($imagen){
            $this->_imagen = base64_encode($imagen);
        }

        public function getCategoria(){
            return $this->_categoria;
        }

        public function setCategoria($_categoria){
            $this->_categoria = $_categoria;
        }

        public function returnJSON(){
            $post = array();

            $post["id"] = $this->getId();
            $post["titulo"] = $this->getTitulo();
            $post["subtitulo"] = $this->getSubtitulo();
            $post["texto"] = $this->getTexto();
            $post["categoria"] = $this->getCategoria();
            $post["usuario_id"] = $this->getUsuarioId();
            $post["imagen"] = $this->getImagen();

            echo json_encode($post);
        }
    }
?>