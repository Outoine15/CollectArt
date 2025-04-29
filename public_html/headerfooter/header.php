<?php
session_is_registered()

session_start();
$_SESSION["ID"]=0;
if($_SESSION["ID"]>0){
    $deconnectHref ="deconnUser";
    $connecte="Deconnection";
}

else{$deconnectHref="connUser";$connecte="Connexion au compte";}
echo "

<header>
<nav>

<div class=\"nav-title\">
    <h1><a href=\"../index.php\">CollectArt</a></h1>
</div>

<div class=\"nav-header-buttons\">
<a href=\"../vote.php\">les votes?</a>
<a href=\"~/toile_edit/toile_edit.php\">editer la toile</a>
<a href=\"~/cree_toile.php\">créer une toile</a>
</div>

<div class=\"connection\">
<a href=\"../user/$deconnectHref.php\">$connecte</a>
</div> 

</nav>
</header>
";

?>
</script>