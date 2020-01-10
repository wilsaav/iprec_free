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
include_once 'config.php';
include_once 'connectDb.php';
$accion=$_GET["accion"];

$conf=new config(); 
$conDb=new connectDb(); 
$camposPermitidos=$conf->getCamposPermitidos();
$tabla=$conf->getTabla();
$id_editar=$conf->getId_editar();
$_idAuto=$conf->getIdAuto();
$credentials=$conf->getUseCredentials();
$con=$conDb->connect(); 
if($accion=="pagina")pagina();
if($accion=="buscar")buscar();
if($accion=="login")login($con);
if($accion=="salir")salir($con);

function  login($con){
$user=$_POST["user"];
$password=$_POST["password"];
$query="SELECT * FROM asterisk.ampusers WHERE username='$user' and password_sha1=SHA1('$password')";
$result=mysqli_query($con,$query);
$numReg=mysqli_affected_rows($con);
	if($numReg==1){
	echo("<script>location.href = 'pagmain.php';</script>");
	$_SESSION['login']=1;
	}
echo("<script>location.href = 'login.php';</script>");
}

function salir($con){
echo "Salir";
mysqli_close($con);
unset($_SESSION["login"]);
session_destroy();
echo("<script>location.href = 'login.php';</script>");
}

function buscar(){
$date=$_GET["date"];
$phone=$_GET["phone"];
$dateStart=substr($date, 0,19);
$dateEnd=substr($date, 21,20);
$pagina=$_GET["pag"];
$query=" calldate>='$dateStart' AND calldate<='$dateEnd' AND (src LIKE '%$phone%' OR dst LIKE '%$phone%')";
unset($_SESSION['query']);
unset($_SESSION['datestart']);
unset($_SESSION['dateend']);
unset($_SESSION['phone']);
$_SESSION['query']=$query;
$_SESSION['datestart']=$dateStart;
$_SESSION['dateend']=$dateEnd;
$_SESSION['phone']=$phone;
echo("<script>location.href = 'pagmain.php?pagina=1';</script>");
}
function pagina(){
$pagina=$_GET["pag"];
echo("<script>location.href = 'pagmain.php?pagina=$pagina';</script>");
}
