<?php 
    class Usuario{
        private $_id;
        private $_nombre_usuario;
        private $_contrasena;
        private $tipo_rol;
        private $_nombre_completo;
        private $fecha_nacimiento;

        public function __construct($id, $nombre_usuario, $contrasena, $tipo_rol, $nombre_completo, $fecha_nacimiento){
            $this->setId($id);
            $this->setnombre_usuario($nombre_usuario);
            $this->setcontrasena($contrasena);
            $this->setTipoRol($tipo_rol);
            $this->setNombreCompleto($nombre_completo);
            $this->setFechaNacimiento($fecha_nacimiento);
        }

        public function getId(){
            return $this->_id;
        }

        public function setId($id){
            $this->_id = $id;
        }

        public function getNombre_usuario(){
            return $this->_nombre_usuario;
        }

        public function setNombre_usuario($nombre_usuario){
            $this->_nombre_usuario = $nombre_usuario;
        }

        public function getContrasena(){
            return $this->_contrasena;
        }

        public function setContrasena($contrasena){
            $this->_contrasena = $contrasena;
        }

        public function getTipoRol(){
            return $this->_tipo_rol;
        }

        public function setTipoRol($tipo_rol){
            $this->_tipo_rol = $tipo_rol;
        }

        public function getNombreCompleto(){
            return $this->_nombre_completo;
        }

        public function setNombreCompleto($nombre_completo){
            $this->_nombre_completo = $nombre_completo;
        }

        public function getFechaNacimiento(){
            return $this->_fecha_nacimiento;
        }

        public function setFechaNacimiento($fecha_nacimiento){
            $this->_fecha_nacimiento = $fecha_nacimiento;
        }

        public function returnJSON(){
            $usuario = array();

            $usuario["id"] = $this->getId();
            $usuario["nombre_usuario"] = $this->getNombre_usuario();
            $usuario["contrasena"] = $this->getContrasena();
            $usuario["nombre_completo"] = $this->getNombreCompleto();
            $usuario["tipo_rol"] = $this->getTipoRol();
            $usuario["fecha_nacimiento"] = $this->getFechaNacimiento();

            echo json_encode($usuario);
        }
    }
?>