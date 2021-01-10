<?php
//Recuprer l'adresse de la page, suppression du chemin,
$page_name = str_replace("/project_boutique/", "", htmlspecialchars($_SERVER['PHP_SELF']));

//Texte pour chaque page ou presque
if($page_name == 'item.php'){
    $footer_text = 'La vue unique de chacun des articles !';
}
else if($page_name == 'catalogue.php'){
    $footer_text = 'Vous visitez la page du catalogue, choisissez vos articles !';
}
else if($page_name == 'clients.php'){
    $footer_text = 'Découvrez tous nos supers clients !';
}
else if($page_name == 'basket.php'){
    $footer_text = 'Voici la page panier, inutile d\'acheter...';
}
else{
    $footer_text = 'Vous vous êtes perdu ?';
}
//Affichage
echo '
<footer class="fixed-bottom position-fixed w-100 bg-primary d-flex justify-content-center align-content-center">
    <p class="pt-3 text-white pr-5 pl-5">'.$footer_text.'</p>
</footer> 
';