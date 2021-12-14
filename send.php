<?php
session_start();

!isset($_SESSION['count']) ? $_SESSION['count'] = 0 : $_SESSION['count']++;

header('Location: /index.php');

