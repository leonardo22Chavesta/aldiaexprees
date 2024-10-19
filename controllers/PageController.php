<?php

    class PageController{
        
        public function home(){
            header("location: ./view/home/index.php");
        }

        public function user(){
            echo 'Estoy en el user';
        }

        public function admin(): void{
            echo 'Estoy en el data';
        }

        public function servicios(): void{
            header("location: ../view/services/index.php");
        }


        public function distritos(): void{
            header("location: ../view/distritos/index.php");
        }
        

        public function estado(): void{
            header("location: ../view/estado/index.php");
        }


        public function medida(): void{
            header("location: ../view/medida/index.php");
        }
      
    }