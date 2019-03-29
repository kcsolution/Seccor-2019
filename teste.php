<?php

	function cnpj_calc1 ($cnpj) {
  
      $digito = "";  
        
        if(strlen($cnpj) != 12) {
    	  return "xx.xxx.xxx/xxxx-xx";
        }
        
  	    for($vez = 0; $vez < 2; $vez++) {
          $mult = 5 + $vez;
		  $soma = 0;
    
            for($indice = 0; $indice < 12; $indice++) {
              $soma += $mult * intval(substr($cnpj,$indice,1));
              $mult--;
      
                if($mult == 1) {
               	  $mult = 9;
                }

            }
            
            if($vez) {
		      $soma += $digito[0] * 2;
            }
    
          $valint = intval($soma/11) * 11;
	      $res    = $soma - $valint;
    
            if($res <= 1) {
	      	  $digito[$vez] = 0;
            }
            else {
		      $digito[$vez] = 11 - $res;
            }
            
  	    }
  
      return substr($cnpj,0,2).".".substr($cnpj,2,3).".".substr($cnpj,5,3)."/".substr($cnpj,8,4)."-".$digito[0].$digito[1]; 
	}

if($_GET{'v'} == false) {
?><html><head><title>Calculo de CNPJ</title>
<style type="text/css">
div.src {
 border: 1px solid #777777; margin: 0px; padding: 12px;
 background-color: #ffffee; color: #555555; font-size: 70%; }
</style>
</head><body>
<form action="valida_cnpj.php" method="get">
Preencha o <b>CNPJ</b> (sem os dois &uacute;ltimos digitos)<br><input type="text" name="v" value=""><br>
<input type="submit" name="submit" value="Calcular Digito Verificador"></form>

<?
$v = preg_replace ('/[^0-9]/', '', $_GET{'v'});
$ok = false;

if (strlen($v) == 12) {
  print "CNPJ: ".cnpj_calc1($v);
  $ok = true;
}
if ($ok == false) {
  print "erro: valor preenchido deve ter  12 (CNPJ) números!";
}


     exit (0);
}

?>
</font>
</body></html>
