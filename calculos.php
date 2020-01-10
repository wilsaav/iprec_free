<?php
/*

This file is part of IPnet Recordings.

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
include_once 'config.php';
include_once 'connectDb.php';
$conf=new config();
$credentials=$conf->getUseCredentials();
if($credentials){
	if(!isset($_SESSION["login"]))echo("<script>location.href = 'login.php';</script>");
}else{
	$_SESSION['login']=1;	
}


 
$conDb=new connectDb(); 
$camposPermitidos=$conf->getCamposPermitidos();
$camposPermitidosRename=$conf->getCamposPermitidosRename();
$tabla=$conf->getTabla();
$id_editar=$conf->getId_editar();
$regPag=$conf->getRegPag();
$totPAg=$conf->getTotPAg();
$freePbxOld=$conf->getFreePbxOld();
$con=$conDb->connect(); 
$pagina=1;
$year= date("Y");$mes=date("m");$dia=date("d");
$dateStart="$year/$mes/$dia 00:00:00";
$dateEnd="$year/$mes/$dia 23:59:59";
$phone="";
$querywhere=" calldate>='$dateStart' and calldate<='$dateEnd'";
if(isset($_GET["pagina"])){
$pagina=$_GET["pagina"];
if(isset($_SESSION['query']))$querywhere=$_SESSION['query'];
if(isset($_SESSION['datestart']))$dateStart=$_SESSION['datestart'];
if(isset($_SESSION['dateend']))$dateEnd=$_SESSION['dateend'];
if(isset($_SESSION['phone']))$phone=$_SESSION['phone'];

}
$limitInicial=($pagina==1?0:($pagina*$regPag)-$regPag);
$resultCol=$conDb->select($con, "SHOW COLUMNS FROM $tabla");
$camposTabla=mysqli_num_rows($resultCol); 

	if($freePbxOld==1){
	$queryCount="select count(*) tot from $tabla where userfield<>'' and $querywhere";
	}else{
	$queryCount="select count(*) tot from $tabla where recordingfile<>'' and $querywhere";
	}
	
$resultCount=$conDb->select($con, $queryCount);
$rowTot=mysqli_fetch_array($resultCount);
$totReg=$rowTot['tot'];
$pag=$totReg/$regPag;

$pag=ceil($pag);
if($pag<$totPAg){
	$totPAg=$pag;
}
	if($freePbxOld==1){
	$query="select calldate,src,dst,duration,billsec,disposition,cdr.uniqueid,(CASE LOCATE('var',userfield) WHEN 0 THEN (CASE LOCATE('wav',SUBSTRING(userfield,7)) WHEN 0 THEN CONCAT(SUBSTRING(userfield,7),'.wav') ELSE SUBSTRING(userfield,7) END )  ELSE CONCAT(SUBSTRING(userfield,35),'.wav') END) as recordingfile from $tabla where userfield<>'' and $querywhere limit $limitInicial,".$regPag;
	}else{
	$query="select * from $tabla where recordingfile<>'' and $querywhere limit $limitInicial,".$regPag;
	}
$resulQuery=$conDb->select($con, $query);
?>