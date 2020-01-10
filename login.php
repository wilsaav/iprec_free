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
?>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="css/login.css">
</head>
<body>
<form class="login" action="controller_pag.php?accion=login" method="post">
    <h1 class="login-title">IPnet Call Recordings</h1>
    <input type="text" class="login-input" placeholder="User" autofocus name="user">
    <input type="password" class="login-input" placeholder="Password" name="password">
    <input type="submit" value="Enter" class="login-button">
  <!--  <p class="login-lost"><a href="">Forgot Password?</a></p>-->
</form>
</body>
</html>