$.ajaxSetup({ cache: false });
function cargarAjax(url_argumentos){
var obXHR;
obXHR=nuevoAjax();
obXHR.open("POST",url_argumentos,true);

obXHR.onreadystatechange=function()
{
  if (obXHR.readyState==4)
  {
  }else{
  }
}
obXHR.send(null);
}

function nuevoAjax(){ 
var xmlhttp=false; 
  	try 
  	{ 
  	xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
  	}
  	catch(e)
  	{ 
  		try
  		{ 
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
  		} 
  	catch(E) { xmlhttp=false; }
  	}
  		if (!xmlhttp && typeof XMLHttpRequest!="undefined") { xmlhttp=new XMLHttpRequest(); } 
  		return xmlhttp; 
}
