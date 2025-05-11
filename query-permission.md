J'ai pense a cree une permission pour le listing. au lieu de post.list on peut juste la nommer posts. Du genre on prends juste le nom du model au pluriel et deplus. Il serait interessant que si un utilisateur veut avoir une liste. Et maintenant ma reflexion s'etend a une problematique simple identifier. Supposons je veux voir la liste de mes posts. Je dois avoir la permission "posts" mais en meme cela suppose que avec cette permission je pourrais avoir aussi les "posts" des autres. Du coup cette evolution seul ne suffit pas il faut ajouter encore une couche supplementaire. Alors je peux dire j'ai la permissions posts ne suffit pour prendre en compte tout les scenarios:

-   Voir tous les posts

-   Voir mes uniquements mes posts

-   Voir les posts sous certaines conditions.

Il faut visiblement plus de paramettres a prendre en compte.
Alors je propose plutot d'utiliser la permission genre post:list et post:list:filter_method ou filter represente un filtre qui sera cree qui examinera la liste et la soumettra a des clauses en fonction de l'utilisateur.

-   post:list => tu a access a tout les post
-   post:list:filter_method => tu as access des posts suivant certaines conditions.

Voici quelques filters pour illustreer ma logique de filters.

```php
class QueryFilter {

    // generic
    static owner($item, $user) {

        if($item->user_id == $user->id){
            return true
        }else{
            return false
        }
    }
    // The generic here can be apply on many model that have relationship with user.

    // specific
    static in_your_network($profil, $user) {
        // if there is one of your follower that is following that profil
        // then return true
        // other wise return fasle
    }
    // The specific here can be apply only on the model profil.
    // So profil:list:in_you_network allow you to view the profil that below to your network.

}
```

C'est un peu ca mon idee. Ainsi on peut juste generate des permissions et implementer les filtres sur les instances des resultans ou meme directement sur les query builder.

La encore je reflechis et je me dis il serais encore mieux definir les query filter directement dans le code du model ca permet de decentralize les filters et etre plus specific. Et donc dans cette logique pour le model profil de notre example plus haut on aura un truc comme:

```php
class Profil {

    static query_in_your_network($profil, $user) {

    }
}

```

Et c'est toujours la meme intuition soit ce filter prends le query builder ou une instance pour la filtree et la valide.

## Alors le controler de permission au niveau de query va etre pris en charge comment :

-   Pour chaque model a la racine on verifie si il y'a la permission model:list. Parce que fondamentalement les requettes query retournent toujours des liste. Donc le control de permissions de liste au niveau du systeme de query etait meme primordial.
-   S'il y'a la permissions model:list on continue simplement sans ce tracasser
-   S'il y'a pas la permission model:list on verifie si dans la definition du model on a un query filter method. Si oui on verifie si l'utilisateur a la permission pour un de ces filter et donc s'il y'a `model:list:filter_name`. Si l'utilisateur n'a pas la permission alors on exclut ce model de la requettes ou on retourne un tableau vide. Et s'il a la permission pour un de ces filtres on excecute le filtre.
-   Maintenant un model peut definir plusieurs filtres pour les requettes le concernants. Ce la signifie que relativement a un model il peut avoir plusieurs permission associes a des filtres. Du coup qu'est ce qui se passe si on a plusieurs permissions de filtres a la fois. La solution mathematique c'est juste faire l'union. Avoir plusieurs permission de filtres ca peut dire je peux avoir ca et ca mais pas dans le sens de l'intercession mais plutot dans le sens de l'union. Et donc je ne pourrais voir que les profils que ces regles m'autorisent a voir.

Du coup qu'est ce que tu en penses ?
