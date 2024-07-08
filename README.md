## Test technique

Pour ce test, j'ai décidé d'utiliser une installation de Laravel utiisant Jetstream. Suivant la <a href="https://laravel.com/docs/11.x/authentication#laravels-api-authentication-services" target="_blank">documentation</a>, je pense que Sanctum est une bonne solution pour m'aider dans ce test et pour pouvoir gérer les tokens d'authentification simplement.

J'utilise directement le Model User généré à l'installation comme Administrateur pour le reste du test.

### Model Profile

Pour la gestion du chanp image, je réutilise le code du trait HasProfilePhoto de Jetstream qui fait ce dont j'ai besoin.
Le nom du champ étant noté en dur dans leur code, je ne peux pas simplement utiliser leur trait si je veux que mon champ s'appelle 'image' dans mon model.
Alors je reprends le code et modifie le nom du champ sans toucher au reste.

J'utilise un champ integer pour le champ status. Je pense que c'est plus facile à maintenir avec un array dans une constante que directement en dur dans la BDD.

### Middleware

Vu que les tokens d'authentification permettent d'accorder des droits aux Users, j'ajoute un middleware pour directement trier les droits au niveau du routing. ex : ('can:create')

### Commentaires

Généralement, je préfère utiliser des noms de méthode et de variable clair pour éviter de commenter et faire doublon. Dans certain cas, ça peut rendre les noms plus long que nécessaire, mais je préfère comme ça.
