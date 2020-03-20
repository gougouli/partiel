- Les deux méthodes utilisées dans un formulaire HTTP sont POST et GET
- Les différences sont:
    - require_once: include le contenu d'un fichier appelé mais ne le fait qu'une seule fois en tout et pour tout dans le même document, si require a déjà été appelé auparavant avec le même nom de fichier
    - require:  inclut le contenu d'un autre fichier appelé, et il déclare une erreur bloquante s'il y a un problème
    - include_once: inclut le contenu d'un autre fichier appelé mais ne le fait qu'une seule fois en tout et pour tout dans le même documentsi require a déjà été appelé auparavant avec le même nom de fichier
    - include: nclut le contenu d'un autre fichier appelé, mais il ne déclare pas d'erreur bloquante s'il y a un problème
    
- La fonction pour utiliser les session est session_start()
- Un DNS: Data Source Name est l'adresse source de la base de donnée
- Une requete préparée permet d'éviter les injection SQL
- La méthode GET permet de récupérer les paramètres dans l'url tandis que la méthode POST permet de récupérer des paramètres non-visibles


#-----------------------------------------------

Dans la table users la colonne de rang est:
rank(tinyint) PARDEFAUT: 0
- 0 -> utilisateur normal
- 1 -> administateur


Ne pas oublier de modifier le fichier /functions/db.php
- dbconnect: correspond a la base de données contenant les tables users et newsletter
- dbconnectPanier: a la base de données avec voiture (vu avec le prof)
