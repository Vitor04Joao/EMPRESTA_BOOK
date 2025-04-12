<?php

 // Código PHP para Conexão com Banco de Dados MySQL


 $host="200.131.242.42";          //Ip do servidor local ou localhost
 $port=3306;                 //porta do serviço do MySQL
 $user="ifnmg";               //usuário do banco
 $password="IFMoc@my";               //senha do usuário do banco
 $dbname="emprestaBook";     //Nome do Banco de dados

$conec = mysqli_connect($host, $user, $password, $dbname, $port) or die(mysql_error());

        // Verificando estado da conexão

        if (!$conec) {
                die("Falha na conexão: " . mysqli_connect_error()); // Correção do erro
                $conectou = 0;
        } 
        
        else{
                echo "";
                $conectou = 1;
        }
?> 