<?php
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
require 'calculos.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>IPnet Recordings</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/tabla_simple.css">
<link rel="stylesheet" href="bootstrap3/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap3/css/bootstrap-theme.min.css">
<script src="bootstrap3/js/bootstrap.min.js"></script>
<link href="css/popup.css" rel="stylesheet">
<!-- DateRangePicker -->
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="daterangepicker/moment.js"></script>
<script type="text/javascript" src="daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="css/footer.css" />
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="js/reproductor.js"></script>
</head>

<body>
<!-- POPUP HTML -->
<div id="grayOverlay"></div>

<div id="popupBox">
 <div id="closePopupBox1">
 <a href="#" onclick="closePop(2)">X</a>
 </div>
<div id="wavplayer_content" align="center" style="align-content: center;"></div>
</div>

<!-- end div #popupBox -->

<script>
function botNuevo(pagina){
	location.href = 'pagnew.php?pag='+pagina;
}
</script>

</br>

	<!-- FECHA/HORA START-->
	<div style="position: absolute; margin-left: 0.5cm; width: 170px;">
	<input type="text" id="demo" class="form-control" title="Start Date"></input> 
	<i id="idemo" class="glyphicon glyphicon-calendar fa fa-calendar" style="position: absolute; left: 90%; top: 25%; cursor: pointer" title="Start Date"></i>
	</div>

	<!-- FECHA/HORA END-->
	<div style="position: absolute; margin-left: 5.2cm; width: 170px;">
	<input type="text" id="demo2" class="form-control" title="End Date"></input> 
	<i id="idemo2" class="glyphicon glyphicon-calendar fa fa-calendar"	style="position: absolute; left: 90%; top: 25%; cursor: pointer" title="End Date"></i>
	</div>

	<!-- Telefono -->
	<div style="position: absolute; margin-left: 9.9cm">
	<input type="text" id="telefono" class="form-control" placeholder="Phone Search" value="<?php echo $phone?>" title="Enter phone number"></input>
	</div>

	<!-- Boton Buscar -->
	<div style="position: absolute; margin-left: 15.3cm">
	<button type="button" class="btn btn-info" onclick="buscar()" title="Search Records">
	<span class="glyphicon glyphicon-search">&nbsp;</span>&nbsp;Search
	</button>
	</div>

	<?php if($credentials==true){?>
	<!-- Boton Salir -->
	<div style="position: fixed; right: 0; margin-right: 0.5cm; top: 1px">
	<a href='controller_pag.php?accion=salir' style="text-decoration: none;"><span class="label label-warning"><font style="margin-left: 0.2cm; margin-right: 0.2cm">Logout</font></span></a>
	</div>
	<?php }?>

<?php echo "</br>"; ?>
<div class="tablasimple"
		style="width: auto; margin-left: 0.5cm; margin-right: 0.5cm; margin-top: 0.5cm">
		<table>

			<tr>
<?php
$op = 0;
while ( $op < count ( $camposPermitidosRename ) ) {
?>
<td><?php echo $camposPermitidosRename[$op] ?></td>
<?php
	$op ++;
}
?>
<td>Options</td>
</tr>

<?php while ($rowQ=mysqli_fetch_array($resulQuery)){ ?>
<tr>
	<?php $op=0;while($op<count($camposPermitidos)){?>
	<td><?php echo $rowQ[$camposPermitidos[$op]] ?></td>
	<?php
		
$op ++;
	}
	?>
<td>
<!-- LINK PLAY AUDIO --> 
<img onclick="openPopLocal('<?php echo $rowQ[$camposPermitidos[0]] ?>','<?php echo basename($rowQ[$camposPermitidos[7]]) ?>')"	title="Reproducir" src="icons/play.png"> &nbsp; 

<!-- LINK DONWLOAD -->
<a href="javascript:download(
	'<?php
		echo basename($rowQ [$camposPermitidos [7]]);
	?>','<?php echo $rowQ[$camposPermitidos[0]]?>')" title="<?php echo $rowQ[$camposPermitidos[7]]?>">Donwload
</a>
</td>
</tr>

<?php }?>
</table>
	</div>

	<ul class="pagination" style="margin-left: 0.5cm;">
	<li><a href="controller_pag.php?accion=pagina&pag=<?php echo ($pagina>1?$pagina-1:1)?>">&laquo;</a></li>
  <?php		
    $op = 1;
	while ( $op <= $totPAg ) {
	if ($pagina <= $pag) {
  ?>
  <li><a href="controller_pag.php?accion=pagina&pag=<?php echo $pagina?>"><?php echo $pagina?></a></li>
  <?php } ?> 
  <?php
	$op ++;
	$pagina ++;
	}
  ?>
  <li><a href="controller_pag.php?accion=pagina&pag=<?php echo ($pagina<$pag?($pagina-1)+1:$pag)?>">&raquo;</a></li>
  </ul>
<?php
$conDb->disconecct ( $con );
?>
<div id='footer'>&copy; Copyright 2016 by IPnet Software - <a href='http://www.ipnet.cl/ipcenter'>IPnet Comunications and Software</a> Licensed under <a href='http://www.opensource.org/licenses/gpl-3.0.html'>GPL3</a>
</div>
</body>
<script>
function openPopLocal(fecha,audio){
var year=fecha.substring(0,4);
var mes=fecha.substring(5,7);
var dia=fecha.substring(8,10);
var freePbxOld=<?php echo $freePbxOld?>;
var repro=2;
asternic=0;
var audioFin="wav/"+audio;
var cp="";
            audioFin="wav/"+audio;
			if(freePbxOld==1){
			cp="cp /var/spool/asterisk/monitor/"+audio+" /var/www/html/iprec/wav";
			}else{
	        cp="cp /var/spool/asterisk/monitor/"+year+"/"+mes+"/"+dia+"/"+audio+" /var/www/html/iprec/wav";
			}
    	cargarAjax("file_actions.php?copia="+cp);
    	openPop(audioFin,repro);
	
}
  
function download(audio,fecha){
var year=fecha.substring(0,4);
var mes=fecha.substring(5,7);
var dia=fecha.substring(8,10);
var freePbxOld=<?php echo $freePbxOld;?>;
		if(freePbxOld==1){
		var path="/var/spool/asterisk/monitor/";	
		}else{
     	var path="/var/spool/asterisk/monitor/"+year+"/"+mes+"/"+dia+"/";
		}
  	 window.location.href = "download.php?f="+path+audio;
}

function buscar(){
var dateStart=document.getElementById("demo").value;
var dateEnd=document.getElementById("demo2").value;
var phone=document.getElementById("telefono").value;
window.location.href = "controller_pag.php?accion=buscar&date="+dateStart+" - "+dateEnd+"&phone="+phone;
}
   
$('#demo').daterangepicker({
singleDatePicker: true,
pick12HourFormat: false,
timePicker: true,
  timePickerIncrement: 1,
  
locale: {
format: 'YYYY-MM-DD HH:mm:ss'
	    },
"startDate": "<?php echo $dateStart?>"/*,
"endDate": "<?php //echo $dateEnd?>"*/

	}, function(start, end, label) {
	  console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
	});

$('#idemo').click(function() {
  $(this).parent().find('input').click();
  
});

$('#idemo2').click(function() {
  $(this).parent().find('input').click();
  
});

$('#demo2').daterangepicker({
//timePicker24Hour: true,
singleDatePicker: true,
pick12HourFormat: false,
timePicker: true,
timePickerIncrement: 1,
  
locale: {
format: 'YYYY-MM-DD HH:mm:ss'
	    },
"startDate": "<?php echo $dateEnd?>"

	}, function(start, end, label) {
	  console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
	});

$('#idemo').click(function() {
  $(this).parent().find('input').click();
});


</script>

</html>
