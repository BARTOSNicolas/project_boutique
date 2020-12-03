<?php
$page_name = htmlspecialchars($_SERVER['PHP_SELF']);
$page_name = str_ireplace("/projet_boutique/", "", $page_name);
echo '
<footer class="fixed-bottom position-fixed w-100 bg-primary d-flex justify-content-center align-content-center">
    <p class="pt-3 text-white">Vous êtes sur la page : '.$page_name.'</p>
</footer> 
';