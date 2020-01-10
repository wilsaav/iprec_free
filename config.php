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

/*
 * Recuerde usar las credenciales de FreePBX para loguearse.
 * Remenber use credentials FreePbx for login.
 * Si FreePBX tiene una versión antigua setee la variable "$_freePbxOld" en 1
 * 
*/
class config {
	//Database, user and password
	private $_user="root";
	private $_password="MyPasswordMySql";
	private $_host="localhost";
	private $_dabase="asteriskcdrdb";
	private $_tabla="cdr";
	//Options
	private $_useCredentials=false;#Use or not credential FrePBX 
	private $_freePbxOld=0; #For versions olders FreePBX
	private $_showCdr=0;#1=Show records of CDR with or without audio, 0= Only show records whitaudio
	//PAGINATOR
	
	private $_regPag=16; #Records for page
	private $_totPAg=10; #Pages
	private $_id_editar='calldate'; 
	private $_idAuto='si';	
	private $_camposPermitidos=array('calldate','src','dst','duration','billsec','disposition','uniqueid','recordingfile');//Cuidado con mayúsculas y minusculas
	private $_camposPermitidosRename=array('Date','From','To','Duration','Bill Seconds','Event','Key','Audio');//Aca renombro el campo como yo deseo que se vea es importante que coincida orden con $camposPermitidos
	
	public function getUser() {
		return $this->_user;
	}
	
	public function getPassword() {
		return $this->_password;
	}

	public function getDabase() {
		return $this->_dabase;
	}

	public function getHost() {
		return $this->_host;
	}
	
	public function getTabla() {
		return $this->_tabla;
	}

	public function getRegPag() {
		return $this->_regPag;
	}

	public function getTotPAg() {
		return $this->_totPAg;
	}

	public function getId_editar() {
		return $this->_id_editar;
	}

	public function getCamposPermitidos() {
		return $this->_camposPermitidos;
	}

	public function getCamposPermitidosRename() {
		return $this->_camposPermitidosRename;
	}

	public function getIdAuto() {
		return $this->_idAuto;
	}
	
	public function getFreePbxOld() {
		return $this->_freePbxOld;
	}
	
	public function getFileAudio() {
		return $this->_fileAudio;
	}
	
	public function getShowCdr() {
		return $this->_showCdr;
	}

	public function getUseCredentials() {
		return $this->_useCredentials;
	}

	

}

session_start()
?>