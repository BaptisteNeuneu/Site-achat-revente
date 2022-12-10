<?php
session_start();
if($_SESSION["id"] !== 0) {
    header("Location:../index.php");
    exit();
}
    
include("../includes/bd.php");

$requete = mysqli_query($db,"SELECT id,name FROM Brand ORDER BY name");
$tableauMarque= mysqli_fetch_all($requete,MYSQLI_ASSOC);

$requete = mysqli_query($db,"SELECT id,name FROM Business ORDER BY name");
$tableauEntreprise = mysqli_fetch_all($requete,MYSQLI_ASSOC);

$requete = mysqli_query($db,"SELECT id,name FROM TypeItem ORDER BY name");
$tableauProduit = mysqli_fetch_all($requete,MYSQLI_ASSOC);

$requete = mysqli_query($db,"SELECT id,BusinessSell.business,BusinessSell.quantity, BusinessSell.price FROM TypeItem LEFT OUTER JOIN BusinessSell ON (TypeItem.id = BusinessSell.typeItem) ORDER BY id");
$tableauProduitEntrepriseSell = mysqli_fetch_all($requete,MYSQLI_ASSOC);

$requete = mysqli_query($db,"SELECT id,BusinessBuy.business,BusinessBuy.quantity, BusinessBuy.price FROM TypeItem LEFT OUTER JOIN BusinessBuy ON (TypeItem.id = BusinessBuy.typeItem) ORDER BY id");
$tableauProduitEntrepriseBuy = mysqli_fetch_all($requete,MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <link href="../CSS/default.css" rel="stylesheet">
    </head>
    <body>
        <div class="w3-container">
            <h2>Ajouter un produit</h2>
            <form action="" method="POST" class="w3-form">
                <label for="">Nom du produit</label>
                <input type="text" name="nom" id="nom" required>
                <label for="">Marque</label>
                <select name="marque" id="marque">
                <?php foreach($tableauMarque as $marque) : ?>
                    <option value="<?=$marque["id"]?>"><?=$marque["name"]?></option>
                <?php endforeach ?>
                </select>
                <label for="picture">Image</label>
                <input type="file" accept=".png, .jpg, .jpeg" name="photo" id="photo" required>
            </form>
        </div>

        <div class="w3-container">
            <h2>Achat</h2>
            <form action="" method="POST" class="w3-form">
                <label for="">Produit</label>
                <select name="produit" id="produit" onchange="changeEntreprise(this)">
                <?php foreach($tableauProduit as $produit) : ?>
                    <option value="<?=$produit["id"]?>"><?=$produit["name"]?></option>
                <?php endforeach ?>
                </select>
                <label for="">Entreprise</label>
                <select name="entreprise" id="entreprise" onchange="changeQuantite(this)">
                </select>
                <label for="">Quantité</label>
                <input type="number" name="quantite" id="quantite">
                <label for="">Prix</label>
                <input type="number" name="prix" id="prix">
            </form>
        </div>
    </body>
</html>


<script type='text/javascript'>
<?php
echo "var tabProduit = ". json_encode($tableauProduit) . ";\n";
echo "var tabEntreprise = ". json_encode($tableauEntreprise) . ";\n";
echo "var tabProduitEntrepriseSell = ". json_encode($tableauProduitEntrepriseSell) . ";\n";
echo "var tabProduitEntrepriseBuy= ". json_encode($tableauProduitEntrepriseBuy) . ";\n";
?>

window.addEventListener("load", function(event) {
   let changeEvent = new Event('change');
   document.getElementById("produit").dispatchEvent(changeEvent);
});


/* fonctions */
function changeEntreprise(selected){
    var value = selected.value;
    console.log(value);
    supprimerOptions(document.getElementById('entreprise'));
    ajouterEntreprise(value);
}

function supprimerOptions(selectElement) {
   var i, L = selectElement.options.length - 1;
   for(i = L; i >= 0; i--) {
      selectElement.remove(i);
   }
}

function ajouterEntreprise(produit) {
    var select = document.getElementById("entreprise");
    tabProduitEntrepriseSell.forEach((tuple) => {
        if(tuple.id == produit){
            var entreprise = tabEntreprise.filter(obj => obj.id === tuple.business);
            newOption = new Option(entreprise[0].name,tuple["business"]);
            select.add(newOption);
        }    
    });
    changeQuantite();
}

function changeQuantite(){
    var produit = document.getElementById("produit").value;
    var entreprise = document.getElementById("entreprise").value;
    tabProduitEntrepriseSell.forEach((tuple) => {
        if(tuple.id == produit && tuple.business == entreprise){
            document.getElementById("quantite").value = tuple["quantity"];
            document.getElementById("prix").value = tuple["price"];
        }    
    });
}


</script>