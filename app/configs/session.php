<?php

session_start();

if( !isset( $_SESSION['user_id'] ) || time() - $_SESSION['login_time'] > 28800)
{
    //expired
    echo "-1";
}
else
{
    //not expired
    echo "1";
}