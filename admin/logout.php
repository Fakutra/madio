<?php
session_start();

unset($_SESSION['username']);
unset($_SESSION['id_admin']);

session_unset();

session_destroy();

header ('location: ../login.php?pesan=logout');
exit;