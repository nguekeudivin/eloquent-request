J'ai cree un systeme de permission assez granulaire qui prends en compte les permissions sur les resources pour les operations de CRUD.

# Les operations de lecture

## Attribut

Le systeme des permissions prends suit les regles suivantes pour les operations de lecteurs sur les resources. Pour un model donne, on recupere tout d'abord la version snake case de son nom. Ceci permet de nous aligner sur la logique de convertion des noms de laravel de laravel.

`User => user
AdminRole => admin_role`
Pour avoir access a un attribut il faut avoir la permission model.nom_attribut. Par example: user.email, user.password
Pour avoir access a tout les attributs d'un model, il faut soit avoir model.nom_attribut pour tous les attribus soit avoir la permission `model.*`

## Les relations

Pour avoir access a une relation sur un model, il faut avoir la permission `model.relation_name`.

**Relation simple**
-Pour avoir la liste des posts d'un utilisateur : il faut avoir les permission `user.posts`.

-   Pour avoir acces a la liste des posts d'un utilisateur tout ayant acces au title de chaque post. Il faut les permissions: `user.posts`, `post.title`. Ici on comprends que la relation posts est entre le model user et post. Donc doit tout d'aboard etre en mesure de voir les posts. posts ici est un comme un attribut. Mais en plus pour chaque post il avoir acces au title. Et pour ca il faut etre autorise a voir le title d'un post. c'est ca l'idee.
-   C'est pareil si pour un post on veut avoir access au nom de l'auteur. Il faut la permission (`post.author` ou `post.*`) et (`author.name` ou `author.*`)
    **Relation imbriquee**
    Pour une relation imbrique le principe reste le meme.
    Pour avoir la liste des posts d'un user avec pour chaque post l'author avec le nom de l'author il faut les permissions `user.post`, `post.author` et `author.name`.

# Les operations de creation et modification

Pour creer un model il faut tout d'abord la permission `model:create`. Mais elle ne suffit pas. Ensuite une fois qu'on peut creer le model il faut etre autorise a attributer des valeurs au attribut de ce model. Ainsi je veut creer un utilisateur en rensignant son nom et son adresse email, je dois avoir les permission `user:create`, `user:create:email`, `user:create:name` ou juste `user:create` et `user:create:*`. C'est la meme logique pour la modification on change juste create par update.
Pour supprimer un model il faut la permission `user:delete`

# Validation au niveau des controllers.

Avec les permissions pour le controle de creation et modification des models, nous avons decide de mettre en place un systeme validation de requette qui va a la fois valider la requette tout en verifiant les permissions.
Tout d'abord voici un example de requette qui sera recu pour les operations standards de crud.
A note que dans notre cas nous prenons en compte principalement la creation et la modification.

```php
class UserController extends Controller
{
use PermissionValidator; // Le trait pour gérer la validation par permission

    public function store(Request $request)
    {
        // Validation en fonction des permissions
        $validated = $this->validateWithPermissions($request, [
            'user:create' => [
                'email' => ['required', 'email'],
                'password' => ['required', 'string', 'min:8'],
            ],

            'profile:create' => [
                'name' => ['required', 'string', 'max:255'],
            ],
              'meta' => [
                'ref_code' => ['nullable', 'string'],
                'send_email' => ['boolean'],
            ],
        ]);

        // Traitement après validation (enregistrement dans la base de données, etc.)
        // ...
    }

}
```

Alors pour que cette requette puisse passe il faudrait d'abord que les inputs name, password, name, ref_code, send_email soit valider suivant les regles de validations definition. A note que ici on considere que les inputs de la requette sont name, email, password, ref_code et send_email. Mais alors que represente user:create, profile:create en fait se sont les racines des permissions et elle permettent de cree notre requette. Donc on regroupe tout d'abord les inputs en fonction des permissions.
user:create c'est la permission racine qui autorise la requette a create un utilisateur.
profile:create c'est la permission racine qui autorise la requette a create un profile.
Donc en quelque sorte pour qu'on puisse continue il faut qu'on ait la permission create un user (user:create) et la permission de creer un profile (profile:create). Mais ca ne suffit pas. Maintenant on a les email qui sont sous user:create et le champs ref_code qui est sous meta.
email et password sont sous user:create cela signifie que nom seulement on doit avoir la permission de cree un utilisateur. Mais on doit la avoir la permission de l'attribuer un email, et un mot de passe. Autrement dit on doit avoir la permission de create un utilisateur avec son email et son mot de passe. user:create nous autorise a cree un utilisateur ( vide en quelque chose) mais pour aller plus loin il faut aussi avoir la permission l'attribute un email et un mot de passe. Et ces permission son note "user:create:email", "user:create:password". En gros ce bloc:

```php
'user:create' => [
'email' => ['required', 'email'],
'password' => ['required', 'string', 'min:8'],
],
```

Veut tout simplement dire. Verifie si on create un utilisateur avec son email et son password. Si oui validate les inputs en utilisation le systeme de validation de laravel avec les rules definies.

maintenant interessons nous au bloc meta. Nous l'avons compris tout ce qui est en dessous de model:create exige une permission pour cela. Etant donne que nous voulons verifier les permissions et valider une fois les entrees une fois. Nous nous sommes heurter a contrainte d'avoir des inputs sur les quelles on ne va pas forcement exiger des permissions ou des inputs qui sont juste des informations qui aide dans le processus metier et ne sont pas forcement liee a model ( pour qu'on puisse aller chercher la permission parce que une fois qu'une information est un attribut d'un model pour le manipuler ou l'attribuer il faut la permission).
ainsi pour ces inputs qui accompagne les autres qui ont besoin d'etre valider sans toutes fois etre soumis a la verification d'une permission on a cree le bloc meta unput pour meta donnees. Ainsi on y definis les rules de validations des inputs qui ne sont pas directement lie a un model et sur lesquelles il y'a aucune exigence de permissions.

Ainsi lorsqu'une operation de crud prends en compte la verification des permissions, c'est ainsi qu'on doit implementer la validation des inputs.
