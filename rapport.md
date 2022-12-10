

<h1  align="center">Rapport SAE-2.02-JUSTINEY-NEVEJANS-DAVEIGAS</h1>

    
<h2 align="center"> Informations </h2>
  
Les fonctionnalités manquantes pour chaque page sont dues à un manque de temps ou car elles ont été jugées non indispensable pour ce projet. En effet toutes les fonctionnalités obligatoires ont été implémenté. 

Pour les sessions, si vous vous connectez sur un site d'un autre élève et que vous retournez sur notre site, il a de forte chance pour que vous soyez déjà connecté sur un compte aléatoire ou qui n'existe pas (ce qui crée des erreurs) car les cookies des sessions sont utilisés pour tous les sites par défaut. En ce qui nous concerne si vous vous connectez sur notre site, vous ne serez pas déjà connecté sur les sites des autres élèves car nous avons précisé où le cookie pouvait être utilisé.

## Introduction 

Ce projet a pour but de créer le site web dynamique d'une entreprise.
Il s'agit de mettre en oeuvre un site web qui permet à un client de suivre ses interactions avec l'entreprise.

Ainsi, le client peut suivre la cagnotte qu'il possède en fonction du nombre et du reconditionnement des objets usagers qu'il a confié à l'entreprise. Cette cagnotte représente un avoir sur ses achats futurs via l'entreprise que ce soit pour des objets neufs (par exemple, un fairphone) ou reconditionnés.  

Le client peut ainsi vendre des objets ou en acheter.  

Le site permet d'afficher des critères le prix de l'objet à acheter, ou son prix de vente.

## Sommaire

1. [Connexion/Inscription](#page-connexion-inscription)  
2. [Profil](#page-profil)
3. [Accueil](#page-accueil)
4. [Achat/Vente](#page-vente-achat)
5. [Panier](#panier)
6. [Wireflow](#wireflow)
7. [Conclusion générale](#conclusion-générale)
8. [Conclusions Personnelles](#conclusions-personnelles)

## Point commun entre les pages

Toutes les pages incluent la même barre de navigation comportant dans l'ordre :
1. Le bouton de la page d'[accueil](#page-accueil)
2. Le bouton de la page [achat](#page-vente-achat)
3. Le bouton de la page [vente](#page-vente-achat)
4. Le bouton du [panier](#panier)
5. L'image de profil permettant de se connecter/se déconnecter/accéder au [profil](#page-profil)

## Page connexion/inscription

Cette partie a été réalisée par [_**Justine Yannis**_](https://dwarves.iut-fbleau.fr/gitiut/justiney).


Dans cette première partie nous allons voir les formulaires de connexion et d'inscription.

### Formulaire de connexion :

#### Fonctionnalités :

* Erreurs login/mdp affichées
* Reconnexion automatique grâce à [un cookie](#cookie-de-reconnexion)
* Bouton pour s'inscrire
* Prévention injections SQL

#### Fonctionnalités manquantes :

* Mot de passe oublié

### Formulaire d'inscription :

#### Fonctionnalités :

* Toutes les erreurs possibles affichées (ex : Chiffre dans Prénom)
* Bouton pour se connecter si l'utilisateur a déjà un compte
* Prévention injections SQL

#### Fonctionnalités manquantes :

* Vérification adresse mail


### Cookie de reconnexion


Dans la base de données une table Customers_tokens contient les informations pour la reconnexion automatique des utilisateurs (id, token, date limite, ...)

Le cookie pour la reconnexion contient une clé de 48 octets constitué de 2 parties :

* Un sélecteur (16 octets)
* Un token (32 octets)

Le sélecteur permet (selon une information trouvée sur internet) d'éviter les attaques par timing.  
On sélectionne le hash du token dans la base grâce au sélecteur.  
Le hash du token doit être identique à celui contenu dans la base de données.  
 
A chaque déconnexion le cookie (client) et le tuple (BdD) correspondant sont supprimés.  
A chaque nouvelle connexion avec reconnexion automatique l'éventuel tuple (BdD) correspondant est supprimé.  

## Page profil  
Cette partie a été réalisée par [_**Justine Yannis**_](https://dwarves.iut-fbleau.fr/gitiut/justiney).

Dans la page de profil, le client voit en premier lieu : 
- Sa cagnotte
- Les éléments qu'il a permit de recycler grâce à la vente de ses appareils 

#### Fonctionnalités :

* Changer son mot de passe
* Visualisation de ses achats/ventes de produits
* Visualisation des quantités d'éléments extraits pour chaque vente
* Changer sa photo de profil
* Prévention injections SQL

## Page Accueil
Cette partie a été réalisée par [_**Nevejans Baptiste**_](https://dwarves.iut-fbleau.fr/gitiut/nevejans).

Dans la page accueil, le  client peut trouver une petite explication :
1. Du but de notre site
2. Des avantages pour le client 
3. Des bénéfices pour les entreprises

Le client peut aussi trouver le nombre d'entreprise partenaire et le nombre de client qui ont créé un profil.

## Page Vente/Achat
Cette partie a été réalisée par [_**Nevejans Baptiste**_](https://dwarves.iut-fbleau.fr/gitiut/justiney).

### 1. Vue générale

Les pages de vente et d'achat étant quasiment identique j'ai décidé de rassemblé le code dans un fichier qui sera inclut dans les deux pages. Il adaptera l'affichage en fonction de la variable de titre de la page.
#### Fonctionnalités :

* Pagination
* Filtres (Pays, Entreprise, Prix)
* Nombre d'éléments par page
* Prévention injections SQL

Tout ces éléments utilise le méthode GET, c'est le moyen le plus simple que j'ai trouvé pour garder les filtres avec la pagination.  

#### Fonctionnalités manquantes :
* Nettoyage de l'URL (URL trop grande)
* Pagination pas adaptée si trop grand nombre de page

### 2. Vue sur un produit précis

Comme pour la partie précédente j'ai décidé de rassembler le code dans un fichier qui sera inclus dans les deux pages. Il adaptera l'affichage en fonction de la variable de titre de la page.  
Lorsque l'on clique sur un produit dans la vue générale, le contenu de la page change (GET) et affiche des précisions sur l'article ainsi qu'un bouton pour acheter/vendre le produit.  

#### Fonctionnalités :
* Prévention injections SQL
#### Fonctionnalités manquantes :
* Redirection satisfaisante 
* Lors d'une vente qui fait passer la cagnotte à plus de 65000€, l'utilisateur n'a pas la possibilité de choisir si il veut quand même vendre et perdre une partie de l'argent de la vente.

## Panier
Cette partie a été réalisée par [_**Justine Yannis**_](https://dwarves.iut-fbleau.fr/gitiut/justiney).

Tous les éléments du panier sont passés par une variable de session. Seule l'identifiant du l'entreprise, du produit et la quantité sont utilisés pour décrire le produit.  
Une requête est ensuite effectué pour afficher le prix. Le prix ainsi que la quantité restante d'un produit sont sélectionné par requêtes à chaque modification ou validation du panier.  
Cela fait beaucoup de requêtes et le code aurait sûrement pu être simplifié mais j'ai préféré faire cela afin d'éviter les failles (changement du prix ou quantité par exemple), même s'il y en a toujours.  

#### Fonctionnalités :

* Ajout/Suppression d'un élément du panier
* Changement de la quantité d'un produit
* Vider le panier
* Aperçu des éléments du panier
* Indication lors du changement des quantités disponible pour un produit lors de la confirmation du panier

#### Fonctionnalités manquantes :

* Meilleure gestion du panier et des requêtes


## Wireflow

Les pages du site web diffèrent légèrement du wireflow original car nous avons ajouté certaines fonctionnalités comme l'historique des commandes dans le profil.
Les méthodes des formulaires peuvent aussi avoir changé comme pour la connexion, on n'utilise plus le GET pour transmettre les erreurs, le fichier traitement_connexion est directement inclus dans le fichiers connexion et les erreurs sont transmisent par variable interne.

## Conclusion générale

Tout au long de la préparation de notre projet, nous avons essayé de mettre en pratique les connaissances acquises durant les différents cours. Nous avons donc essayé d'utiliser les bonnes pratiques de développement d'un site web  
comme la protection contre les injections de SQL et le cross-site scripting. Cependant nous n'avons pas utilsé de fonctions pour factoriser le code ce qui le rend moins lisible et redondant. Pour autant nous avons essayé de séparer le code dans plusieurs fichiers  
afin de ne pas avoir des fichiers de 400 lignes, ce qui diminue la lisibilité du code.

## Conclusions Personnelles

####  Jany :
> Pour ma part, ayant peu de notion en PHP, j’ai eu ce pressentiment de ne pas avoir été efficace en cours de projet. 
> En revanche, c’est toujours enrichissant de travailler avec des camarades qui ont sus répondre présent en cas d’aide ou d’incompréhension pour la tâche que je devais accomplir, et j’aurais aimé faire de même.
> Bien que nous ayons eu des problèmes avec nos groupes respectifs, on a su travailler ensemble afin que ce projet puisse aboutir.

#### Yannis :
> J'ai trouvé ce projet très interressant, je trouve que l'idéee de la SAE était très bonne pour appliqué l'utilisation du php et de la base de donnée vue en cour.
>J'aurais souhaité faire d'avantage de page pour mieux comprendre l'utilisation du php
>Je pense que j'aurais pus rajouter de nouveaux produit qui fournisse plus de lien entre les marques, les entreprises et les pays pour effectuer de nouveau test.J'aurais aussis pu cree des identifiant client qui corresponde seulement au entreprise.
>De plus j'aurais pu faire des pages pour les entreprises ce qui a conduit à la création de la page administration
>De plus j'aurais voulu finir la page administration pour pouvoir ajouter ddes produits depuis le site, ajouter des quantités de produit vendu et de produit acheté
> Cependant je pense qu'il y a suffisament de produit différend pour réaliser des tests

#### Baptiste :
> J'ai trouvé ce projet très passionnant, en effet j'adore l'utilisation des bases de données que je trouve très intuitif et cette application de celle-ci permet de mieux apercevoir les différentes utilisations qu'elles peuvent avoir.  
> Pour ce qui est du développement, j'aurais voulu rendre le code plus lisible et constant, ce que je veux dire c'est que pour certaines parties j'utilise des fonctions et pour le reste non.    
> Utiliser des fonctions m'aurait permis de factoriser du code le rendant plus lisible. Je suis quand même content du résultat qu'on a pu obtenir mais je suis sûr de pouvoir faire encore mieux.  
> Par manque de temps par exemple pour l'historique j'ai créé plusieurs tables dans la base de données pour mes besoins, elles auraient pu être plus réfléchi et ne permettent pas forcément une évolution de la base si le projet n'avait pas été un exercice.  
> Cependant pour le travail demandé elles suffisent largement selon moi.
> De plus j'aurais voulu terminer la page d'administration du site, qui est bien plus longue que les autres et demande plus de réflexion.
> Je ne peux pas plus m'exprimer sur tous les problèmes rencontrés mais voilà l'essentiel.