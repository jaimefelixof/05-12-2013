<?php

require_once("dao/dao.php");
$dao = new Dao;
if(isset($_GET['uf'])){
	$resultado = $dao->obterCoordenadasUF($_GET['uf']);
	$coordenadas = $resultado->FETCH(PDO::FETCH_OBJ);
}

?>


<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<title>BR Análise</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="imagetoolbar" content="no" />
	<link rel="stylesheet" href="styles/layout.css" type="text/css" />
	<link rel="stylesheet" href="styles/style.css" type="text/css" />
	<script type="text/javascript" src="scripts/jquery-1.4.1.min.js"></script>
	<script type="text/javascript" src="scripts/jquery-ui-1.7.2.custom.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script type="text/javascript"></script>
	
    <script src="http://api.maps.ovi.com/jsl.js"></script>
    
	<script>	
	function getCoords(coords){
		window.location = 'mapa.php?uf=' + coords;
	}
	
	$(window).load(function($){ loadMap(); });
	
	function loadMap(){
    if (navigator.geolocation) {
        var map;
        var marker;
        	navigator.geolocation.getCurrentPosition(function(position) {
        	var latitude = <?php if(isset($coordenadas)){echo $coordenadas->latitude;}else{ echo 'null';}?>;
        	var longitude = <?php if(isset($coordenadas)){echo $coordenadas->longitude;}else{ echo 'null';}?>;		
        	map = new ovi.mapsapi.map.Display(
            	document.getElementById("mapa"),
                    { components: [
                     new ovi.mapsapi.map.component.Behavior(),
                     new ovi.mapsapi.map.component.Overview(),
                     new ovi.mapsapi.map.component.ZoomBar(),
                     new ovi.mapsapi.map.component.TypeSelector(),
                     new ovi.mapsapi.map.component.ScaleBar() ],
                     zoomLevel: 8,
                     center: [latitude, longitude]					 
                });
     
                var marker = new ovi.mapsapi.map.StandardMarker(
                    [latitude, longitude], {
                    text: "",
                });
                map.objects.add(marker);
     
            });
        } else {
            alert("Geolocation API nao suportado neste browser.");
        }
		document.getElementById('f').focus();
	}
    </script>    

</head>
<body>
	<div class="wrapper col0">  
	</div>
<!-- ####################################################################################################### -->

<div class="wrapper col1">
  <div id="header">
    <div id="logo">
      <a href="index.php" title="Home"><img src="images/logo.png" /></a>
    </div>    
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<!--
<div class="wrapper col2">
  <div id="topnav">   
  </div>
</div>
-->
    <div>
        <header class="mainHeader">
            
            <nav><ul>
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="mapa.php">Localização dos Estados</a></li>                
            </ul></nav>
        </header>
    </div>



<!-- ####################################################################################################### -->
<div class="wrapper col3">
  <div id="featured_slide">
    <div id="featured_wrap">    
      <ul id="featured_tabs">
        <li><a href="#fc3">Nossos Estados</a></li>      
        <li><a href="#fc1">Ministério da Justiça</a></li>
        <li><a href="#fc2">Dados Abertos</a></li>        
        <li class="last"><a href="#fc4">Policia Rodoviaria Federal</a></li>
      </ul>
      
      <div id="featured_content">
      	<div class="featured_box" id="fc3">
        	<a href="http://www.ibge.gov.br/estadosat/index.php" target="_blank">
        		<img src="images/demo/3.gif" alt="" />
        	</a>         
        </div>      
        <div class="featured_box" id="fc1">
        	<a href="http://www.justica.gov.br/portal/ministerio-da-justica/" target="_blank">
        		<img src="images/demo/1.gif" alt="" />
        	</a>          
        </div>        
        <div class="featured_box" id="fc2">
        	<a href="http://dados.gov.br/" target="_blank">
        		<img src="images/demo/2.gif" alt="" />
        	</a>         
        </div>        
        <div class="featured_box" id="fc4">
        	<a href="http://www.dprf.gov.br/PortalInternet/index.faces" target="_blank">
        		<img src="images/demo/4.gif" alt="" />
        	</a>          
        </div>           
      </div>
    </div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col4">
  <div id="container">
    <div id="hpage">
    
    	<label for="estado"> Escolha o Estado</label>
        <select name="Combo_Estados" onChange="getCoords(this.value)">
        	<option value="">Selecione</option>
            <option value="AC">Acre</option>
            <option value="AL">Alagoas</option>
            <option value="AM">Amazonas</option>
            <option value="AP">Amapá</option>
            <option value="BA">Bahia</option>
            <option value="CE">Ceará</option>            
            <option value="DF">Distrito Federal</option>
            <option value="ES">Espírito Santo</option>
            <option value="GO">Goiás</option>
            <option value="MA">Maranhão</option>
            <option value="MG">Minas Gerais</option>
            <option value="MS">Mato Grosso do Sul</option>
            <option value="MT">Mato Grosso</option>
            <option value="PA">Pará</option>
            <option value="PB">Paraíba</option>
            <option value="PE">Pernambuco</option>
            <option value="PI">Piauí</option>
            <option value="PR">Paraná</option>
            <option value="RJ">Rio de Janeiro</option>
            <option value="RN">Rio Grande do Norte</option>
            <option value="RO">Rondônia</option>
            <option value="RR">Roraima</option>
            <option value="RS">Rio Grande do Sul</option>
            <option value="SC">Santa Catarina</option>
            <option value="SE">Sergipe</option>
            <option value="SP">São Paulo</option>
            <option value="TO">Tocantins</option>
       </select>
	   <br>
       <br>
       
       <div id="mapa"></div>
       
       <div>
       		<br>
       		<a href="http://www.ibge.gov.br/estadosat/perfil.php?sigla=ce#" target="_blank"><img src="images/estados/<?php echo $coordenadas->img;?>"></a>
       </div>
       
                                     
      <br class="clear" />      			    
    </div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col5">
  <div id="footer">
    <div class="footbox">
      <h2>Descrição do Projeto</h2>
      <p align="justify">
      Realizado para o 2º Concurso de Aplicativos para Dados Abertos realizado por uma cooperação entre o Ministério da Justiça(MJ) e o Ministério do Planejamento, Orçamento e Gestão.
      </p>
    </div>
    <div class="footbox">
      <h2>Links</h2>
      <ul>
        <li class="last"><a href="http://www.justica.gov.br/portal/ministerio-da-justica/" target="_blank" >Ministério da Justiça</a></li>
        <li class="last"><a href="http://www.dprf.gov.br/PortalInternet/index.faces" target="_blank" >Polícia Rodoviária Federal</a></li>
        <li class="last"><a href="http://dados.gov.br/" target="_blank">Base de Dados Livre</a></li>
        <li class="last"><a href="http://www.ibge.gov.br/estadosat/index.php" target="_blank">IBGE</a></li>
        <li class="last"><a href="http://www.hostinger.com.br/" target="_blank">Hostinger</a></li>        
                  
      </ul>
    </div>
   
    <div class="footboxe">
    	<h2>Equipe</h2>
        <div id="equip-member">
        	Jaime Félix Oliveira Filho
        	<div class="icon-social">
            	<a href="#" title="Facebook" target="_blank"> 
        			<img src="images/facebook.png"/>
        		</a>
            </div>
            <div class="icon-social">
            	<a href="https://twitter.com/jaimefelixof" title="Twiter" target="_blank">
        			<img src="images/twitter.png"/>
        		</a>
            </div>
        </div>
        <div id="equip-member">
        	Paulo André Freire
        	<div class="icon-social">
            	<a href="#" title="Facebook" target="_blank"> 
        			<img src="images/facebook.png"/>
        		</a>
            </div>
            <div class="icon-social">
            	<a href="#" title="Twiter" target="_blank">
        			<img src="images/twitter.png"/>
        		</a>
            </div>
        </div>       
    </div>
    
	<div class="footbox">
    	<h2></h2>     
      	<ul>
        	<li class="last">
        		<p style="padding-bottom:5px; font-style:italic;">Licença:</p>
        		<a href="http://www.gnu.org/copyleft/gpl.html" target="_blank" >
        			<img src="images/gpl3.fw_2.fw.png"/>
        		</a>
        	</li>        
     	</ul>
    </div>
    
    <div class="footbox">
    	<h2></h2>
      	<ul>
        	<li class="last">
       			<p style="padding-bottom:5px; font-style:italic;">GitHub</p>
        		<a href="https://github.com/jaimefelixof" target="_blank" >
        			<img src="images/demo/GitHub.png"/>
        		</a>
        	</li>        
      	</ul>
    </div>
    
    <div class="footboxe">
      	<h2></h2>
      	<ul>
        	<li class="last">
        		<p style="padding-bottom:5px; font-style:italic;">Apoio:</p>
        		<a href="http://fametro.com.br/" target="_blank" >
        			<img src="images/fametro.fw2.png"/>
        		</a>
        	</li>        
      	</ul>
    </div>
     
    <br class="clear" />
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper col6">
  <div id="copyright">
    <p class="fl_left">Copyright &copy; 2013 - Todos os Direitos Reservados - ADS.</p>    
    <br class="clear" />
  </div>
</div>
</body>
</html>
