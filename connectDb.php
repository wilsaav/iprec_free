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
class connectDb {
//Connect to MySQL
function connect(){
$conf=new config();
$user=$conf->getUser();
$password=$conf->getPassword();
$dbase=$conf->getDabase();
$host=$conf->getHost();
$con=mysqli_connect($host,$user,$password,$dbase);
 if (!$con) {
 die('Error de Conexion (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
 return ;
 }
			
return $con;
}
	
function select($con,$query){
$queryResult = mysqli_query($con,$query);
 if (!$queryResult){
 echo "Error: ".mysqli_error($con)."<br>".$query;
 exit;
 }
return $queryResult;
}
	//Disconnect to MySQL
function disconecct($con){
mysqli_close($con);
}

	
}

?>