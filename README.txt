ENGLISH

Install
-------

1- Untar and copy directory "iprec" in "/var/www/html/"

2- Set appropriate permissions to Folder "/var/www/html/iprec/" and "/var/www/html/iprec/wav"

Configuration
-------------

1- Put credentials user and password MySQL or MariaDB in /var/www/html/iprec/config.php

2- If you do not want to use login credentials (user and password) in config.php set $_useCredentials in "false" otherwise set in "true".

3- If you use access credentials ($_useCredentials in "true"),  user  and password are the same as those used in FreePBX.

4- DataBase asteriskcdrdb, in file config.php, configure user, host and password  MySQL.

5- If the version of FreePbx is old, on file config.php, set variable "$_freePbxOld" to "1" otherwise set in "0".

6- Open web browser and write "IP_YOU_PBX/iprec"

If desired, the paid version has the following characteristics:

- The audio player does not use flash so warning messages are avoided.
- The player occupies HTML5 with advanced audio spectrum.
- Own database to create users with privileges and restrict access to audios.
- Statistics, graphics and Real Time, in the IPcenter and Callcapture version
- Convert wav to MP3
- You can delete the Wav file and be left alone with MP3 and thus do not use much disk space.

Doubts? write to soporte@ipnet.cl - www.ipnet.cl/ipcenter

SPANISH

Instalaci�n
-----------

1- Descomprima y copie carpeta "iprec" en "/var/www/html/"
cd /usr/src
tar zxvf iprec_free.tgz
mv iprec /var/www/html

2- De permisos correspondientes a carpeta "/var/www/html/iprec/" y "/var/www/html/iprec/wav"
chmod -R 757 /var/www/html/iprec/
chown asterisk /var/www/html/iprec/*

Configuraci�n
-------------

1- Coloque las credenciales de usuario y password de MySQL o MariaDB en /var/www/html/iprec/config.php

2- Base de datos, en archivo config.php, configure usuario, host y clave de MySQL.

3- Si la versi�n de FreePbx es antigua, en archivo config.php, setee la variable "$_freePbxOld" en "1" de lo contrario setee en "0".

4- Abra google chrome o similar y escriba  "IP_DE_TU_PBX/iprec"

Si lo desea la versi�n de pago tiene las siguientes caracteristicas:

- El reproductor de audio no utiliza  flash as� se evita los mensajes de advertencia.
- El reproductor ocupa HTML5 con  espectro de audio avanzado.  
- Base de datos propia para crear usuarios con privilegios y restringir acceso a audios.
- Estadisticas, gr�ficos y Real Time, en la versi�n IPcenter y Callcapture
- Convierte wav a MP3 
- Puede borrar el archivo Wav y quedar solo con MP3 y as� no utiliza mucho espacio en el disco.


�Dudas? escriba a soporte@ipnet.cl - www.ipnet.cl/ipcenter