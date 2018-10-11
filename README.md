##Problèmes :

Il manque des ombres et les cards ne sont pas assez arrondies.<br/>
Le css pourrait être intégré directement dans les pages css.<br/>
Les proportions ne respectent pas exactement le mockup.<br/>
Afin d’avoir le nom de domaine désiré, j’aurais dû créer un virtual host.<br/>
Je pense que la configuration actuelle fonctionnera uniquement en dev.<br/>

Dans le backend , il me manque une gestion des erreurs.
J’ai également une répétions de variable qui devrait pouvoir être remplacé par une constante.<br/>

Il doit y avoir un moyen plus propre de créer les réponses.<br/>

Je dois avoir un problème de syntaxe dans mon code car lorsque que je fais un ng serve
le code ne compile pas mais cela fonctionne une fois une modification (n’importe laquelle) effectuée et sauvegardée dans le service link.<br/>
Il est possible que cela vient du fichier link manquant mais quand je le rajoute cela plante également.<br/>

J’ai des problèmes dès que j’utilise des customs headers, cela doit venir du CORS.<br/>
En théorie, je devrais pouvoir régler cela côté serveur soir en modifiant « Access-Control-Allow-Headers » ou en ajoutant une option me permettant de gérer les « options » venant avec le «poste ».<br/>
Je pense que pour cette raison mon get links/ :id ne fonctionne pas ainsi que mon post.<br/>
Pour le get links/ :id j’ai essayé de rediriger le client directement depuis le serveur.<br/>

Lorsque qu’on récupère le fichier depuis git, après avoir un composer update , il y a des soucis de path.<br/>

##Amélioration :
Il faut rajouter un service message afin de communiquer à l’utilisateur la réussite ou l’échec d’une tache ( et donc pouvoir capter et traiter les différents code d’erreur).<br/>
On devrait pouvoir supprimer un lien.<br/>
Je pense qu’il est inutile de montrer tous les liens , personnellement je laisserais juste le convertisseur et je renverrais le nouveau lien. <br/>
Si on choisit de garder tous les liens, je créerais des filtres ou un moyen de naviguer au travers  plus facilement (typeahead, sort, etc).<br/>
De plus la page sera vide débordée par liens , il faudra rajouter une navbar nous permettant , par exemple, de nous rendre au dix prochains liens.<br/>




##Documentations :
J’ai principalement utilisé : [angular](https://angular.io/) et [symfony](https://symfony.com/)
Je me suis bien entendu aidé de google pour essayer de résoudre une partie des problèmes rencontrés.

##Configuration :
```Angular-cli 6.2```
```Symfony 4.1```

##Dépendances :
```PHP 7.1 ou supérieur```
```Composer installé```
```Apache```
```NodeJS```

##How to :
Créer une base de données (mysql) puis importer le fichier table contenu dans database.<br/>
Se rendre dans ```UrlShortener-backend/env.``` puis configurer l’accès à la base de données
(j’ai laissé ma configuration sur git)
```DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"```

Revenir dans UrlShortener-backend
php composer.phar update
 et lancé le serveur backend avec 

```php -S 127.0.0.1:8000 -t public```

Puis aller dans UrlShortener-ng et lancé ng serve –open
Il est possible que vous deviez rajouter un module :
```npm install --save-dev @angular-devkit/build-angular```




