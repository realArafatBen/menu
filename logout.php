<?php
session_start();
unset($_SESSION["user_cache"]);
session_destroy();
header("Location: .");
exit
?>