# Configuration

Ouvrir un terminal dans le dossier et exécuter `composer install`
Créer un fichier .env.local dans /config, et personnaliser les infos contenues dans le fichier .env

# Idée du projet

L'idée était de partir sur une appli de création de tournoi. En renseignant le nom du tournoi, le jeu/sport, les équipes, l'application nous renverrait un tableau des matchs. Ensuite on pourrait suivre ce tournoi en renseignant les vainqueurs des matchs, et l'application nous sortirait les matchs suivants, jusqu'à obtenir un vainqueur.
Spoil : je n'ai pas fini !

Je me suis rapidement heurté à pas mal de limites sur ce projet, et j'ai du amoindrir mes envies. D'abord, pour ne pas avoir de comportement trop complexe à gérer, il a fallu choisir de faire uniquement des arbres de phases finales, pas de phases de poules. Ensuite, il faut limiter le nombre d'équipes dans le tournoi à une puissance de 2 *(4, 8, 16, 32, 64...)*, afin d'avoir un arbre propre et équilibré jusqu'à la finale.

# 1è étape : la BDD

## Conceptualisation

### Règles de gestion
- Un tournoi possède un id, un nom, un sport/jeu, un nombre d'équipes
- Une équipe possède un id, un nom
- Un match possède un id, un tournoi, une équipe A, une équipe B, une équipe vainqueure
    Plus tard avec toi, on a décidé d'ajouter un TIMESTAMP à la création d'un match pour pouvoir les classer dans l'ordre de leur création
### Dictionnaire de données
![Dictionnaire de données](assets/img/dico_donnee.png "Dictionnaire de données")
### Dépendances fonctionnelles
**__id_trn__** ? name_trn, game_trn, nb_team_trn
**__id_team__** ? name_team
**__id_m__** ? date_m
### Schéma MCD
![Schéma MCD](assets/img/schema_mcd.png "Schéma MCD")
### MLD
**Tournoi** (__id_trn__, name_trn, nb_team_trn)
**Match** (__id_m__, #id_trn, #id_team_A, #id_team_B, #id_team_win, date_m)
**Equipe** (__id_team__, name_team)
### MPD (simplifié)
![Schéma MPD](assets/img/schema_mpd.png "Schéma MPD")
