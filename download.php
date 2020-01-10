<?php

###############################################################
# File Download 1.31
###############################################################
# Visit http://www.zubrag.com/scripts/ for updates
###############################################################
# Sample call:
#    download.php?f=phptutorial.zip
#
# Sample call (browser will try to save with new file name):
#    download.php?f=phptutorial.zip&fc=php123tutorial.zip
###############################################################


define('ALLOWED_REFERRER', '');

$partes_ruta = pathinfo($_GET['f']);
$carpeta= $partes_ruta['dirname']."/";

define('BASE_DIR',$carpeta); 
define('LOG_DOWNLOADS',true);

// log file name
define('LOG_FILE','downloads.log');

// Allowed extensions list in format 'extension' => 'mime type'
// If myme type is set to empty string then script will try to detect mime type 
// itself, which would only work if you have Mimetype or Fileinfo extensions
// installed on server.
$allowed_ext = array (

  // archives
  'zip' => 'application/zip',

  // documents
  'pdf' => 'application/pdf',
  'doc' => 'application/msword',
  'xls' => 'application/vnd.ms-excel',
  'xlsx' => 'application/vnd.ms-excel 2007',	
  'ppt' => 'application/vnd.ms-powerpoint',
  
  // executables
  'exe' => 'application/octet-stream',

  // images
  'gif' => 'image/gif',
  'png' => 'image/png',
  'jpg' => 'image/jpeg',
  'jpeg' => 'image/jpeg',

  // audio
  'mp3' => 'audio/mpeg',
  'wav' => 'audio/x-wav',
  'gsm' => 'audio/x-gsm',
  'GSM' => 'audio/x-GSM',

  // video
  'mpeg' => 'video/mpeg',
  'mpg' => 'video/mpeg',
  'mpe' => 'video/mpeg',
  'mov' => 'video/quicktime',
  'avi' => 'video/x-msvideo'
);



####################################################################
###  DO NOT CHANGE BELOW
####################################################################

// If hotlinking not allowed then make hackers think there are some server problems
if (ALLOWED_REFERRER !== ''
&& (!isset($_SERVER['HTTP_REFERER']) || strpos(strtoupper($_SERVER['HTTP_REFERER']),strtoupper(ALLOWED_REFERRER)) === false)
) {
  die("Internal server error. Please contact system administrator.");
}

// Make sure program execution doesn't time out
// Set maximum script execution time in seconds (0 means no limit)
set_time_limit(0);

if (!isset($_GET['f']) || empty($_GET['f'])) {
  die("Please specify file name for download.");
}

// Nullbyte hack fix
if (strpos($_GET['f'], "\0") !== FALSE) die('');

// Get real file name.
// Remove any path info to avoid hacking by adding relative path, etc.
$fname = basename($_GET['f']);//extrae path
//echo $fname;exit;

// Check if the file exists
// Check in subfolders too
function find_file ($dirname, $fname, &$file_path) {

  $dir = opendir($dirname);

  while ($file = readdir($dir)) {
    if (empty($file_path) && $file != '.' && $file != '..') {
      if (is_dir($dirname.'/'.$file)) {
        find_file($dirname.'/'.$file, $fname, $file_path);
      }
      else {
        if (file_exists($dirname.'/'.$fname)) {
          $file_path = $dirname.'/'.$fname;
          return;
        }
      }
    }
  }

} // find_file

// get full file path (including subfolders)
$file_path = '';
find_file(BASE_DIR, $fname, $file_path);

if (!is_file($file_path)) {
  die("File does not exist. Make sure you specified correct file name."); 
}

// file size in bytes
$fsize = filesize($file_path); 

// file extension
$fext = strtolower(substr(strrchr($fname,"."),1));

// check if allowed extension
if (!array_key_exists($fext, $allowed_ext)) {
  die("Not allowed file type."); 
}

// get mime type
if ($allowed_ext[$fext] == '') {
  $mtype = '';
  // mime type is not set, get from server settings
  if (function_exists('mime_content_type')) {
    $mtype = mime_content_type($file_path);
  }
  else if (function_exists('finfo_file')) {
    $finfo = finfo_open(FILEINFO_MIME); // return mime type
    $mtype = finfo_file($finfo, $file_path);
    finfo_close($finfo);  
  }
  if ($mtype == '') {
    $mtype = "application/force-download";
  }
}
else {
  // get mime type defined by admin
  $mtype = $allowed_ext[$fext];
}

// Browser will try to save file with this filename, regardless original filename.
// You can override it if needed.

if (!isset($_GET['fc']) || empty($_GET['fc'])) {
  $asfname = $fname;
}
else {
  // remove some bad chars
  $asfname = str_replace(array('"',"'",'\\','/'), '', $_GET['fc']);
  if ($asfname === '') $asfname = 'NoName';
}

// set headers
header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: $mtype");
header("Content-Disposition: attachment; filename=\"$asfname\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . $fsize);

// download
// @readfile($file_path);
$file = @fopen($file_path,"rb");
if ($file) {
  while(!feof($file)) {
    print(fread($file, 1024*8));
    flush();
    if (connection_status()!=0) {
      @fclose($file);
      die();
    }
  }
  @fclose($file);
}

// log downloads
if (!LOG_DOWNLOADS) die();

$f = @fopen(LOG_FILE, 'a+');
if ($f) {
  @fputs($f, date("m.d.Y g:ia")."  ".$_SERVER['REMOTE_ADDR']."  ".$fname."\n");
  @fclose($f);
}
//unlink($carpeta.$fname);//borra archivo
?>