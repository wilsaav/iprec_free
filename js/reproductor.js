/*

This file is part of IPnet CRecordings.

IPnet CRecordings is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

var fileAudioP;
function openPop(audio,tiporeproductor){
		fileAudioP="/var/www/html/iprec/"+audio;
if(tiporeproductor==1){
		var wp='<object data="dewplayer/dewplayer-playlist.swf" width="250" height="20" name="dewplayer2" id="dewplayer2" type="application/x-shockwave-flash">'+
						  '<param name="movie" value="dewplayer.swf" />'+
						  '<param name="flashvars" value="mp3='+audio+'&javascript=on&autostart=1" id="toca" />'+
						  '<param name="wmode" value="transparent" />'+
				'</object>';
						  document.getElementById("dewplayer_content").innerHTML=wp;
			
}else{
var wp='<object  classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000'+
		'id="audio3" '+
	'<param name="allowScriptAccess" value="always" />'+
	'<param name="quality" value="high" />'+
	'<param name="scale" value="noscale" />'+
	'<param name="salign" value="lt" />'+
	'<param name="bgcolor" value="#dddddd"/>'+
	'<embed src="wavplayer_autoplay_popup.swf?gui=full&h=20&w=250&autostart=true&sound='+audio+'&"'+
		   'bgcolor="#dddddd" '+
		   'width="250" '+
		   'height="20" '+
		   'name="audio3" '+
		   'quality="high" '+
		  'align="middle" '+
		   'scale="noscale" '+
		   'allowScriptAccess="always" '+
		   'type="application/x-shockwave-flash" '+
		   'pluginspage="http://www.macromedia.com/go/getflashplayer" '+
	'/></object>';
document.getElementById("wavplayer_content").innerHTML=wp;
}
var ventana = document.getElementById('popupBox');
ventana.style.marginTop = "100px";
ventana.style.marginLeft = ((document.body.clientWidth-350) / 2) +  "px"; 
document.getElementById('popupBox').style.display="block";
document.getElementById('popupBox').style.position="absolute";
document.getElementById('grayOverlay').style.display="block";
document.getElementById('closePopupBox1').style.display="block";
}

function closePop(tiporeprod){
	cargarBorrar(fileAudioP);
	document.getElementById('popupBox').style.display="none";
	document.getElementById('grayOverlay').style.display="none";
	if(tiporeprod==2)document.getElementById("wavplayer_content").innerHTML="";
	else document.getElementById("dewplayer_content").innerHTML="";
}

$.ajaxSetup({ cache: false });
function cargarBorrar(fileAudioP){
var obXHR;
var obXHR;
obXHR=nuevoAjax();
obXHR.open("POST","file_actions.php?del="+fileAudioP,true);

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