<?php
echo "
	<style>
	body{
		margin:0;
		padding:0;}
	
footer {
	margin:0px;
	padding:0px;
    background-color: #537FE7;
    color: rgba(188, 207, 214, 0.925);
    position:fixed;
    bottom: 0;
	width : 100%;
	height: 10%;
	padding-bottom:2%;
	padding-top:1%;}

#div-image-univsmb{
position: absolute;
	top:0;
	right:0;
}	
	
#image-univsmb{
	height:9%;	
	
}

#div_droits{
	display:flex;
	flex-direction:column;
	justify-content: center;
	text-align:center;}
	</style>
	 
<footer>
      
	  <div id=\"div_droits\">  
	  <p>@ Tout droit r&#233;serv&#233; &#224; Bob_et_Alice</p>
	  <p>Les cookies c'est pas mauvais</p>
	  </div>

      <a href=\"https://www.univ-smb.fr/\" id=\"div-image-univsmb\"><image id=\"image-univsmb\" src=\"images/Logo_USMB_web_vertical_grand_RVB.png\"></image></a>


</footer>";
?>