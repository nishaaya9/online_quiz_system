<?php
session_start();
unset($_SESSION["email"]);
unset($_SESSION['start_time']);
unset($_SESSION['end_time']);
header("location:login");
    