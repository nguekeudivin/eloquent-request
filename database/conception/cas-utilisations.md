## Les acteurs

Le système de gestion de la mutuelle est conçu pour répondre aux besoins de différents types d'utilisateurs qui interagissent avec ses fonctionnalités. Ces utilisateurs peuvent être classés en plusieurs catégories principales, chacune ayant un rôle et des objectifs distincts :

1.  **Le Mutualiste (ou Adhérent) :**

    -   C'est la raison d'être de la mutuelle et l'utilisateur final du système du côté "public".
    -   Son rôle principal est d'accéder aux services et aux informations qui le concernent.
    -   Il utilisera l'application via un espace personnel sécurisé pour consulter son profil, le statut de son adhésion, ses contributions financières, ses avantages (prêts, aides, prises en charge), suivre ses demandes, et communiquer avec la mutuelle.

2.  **L'admin :**

    -   C'est l'utilisateur interne de la mutuelle qui gère les opérations quotidiennes et interagit directement avec les dossiers des mutualistes.
    -   Son rôle est de s'assurer que les informations des adhérents sont à jour, de traiter les demandes de services (prêts, aides, prises en charge), de suivre les aspects financiers, de gérer les communications et les réclamations, et d'assurer le bon fonctionnement opérationnel de la mutuelle via l'outil.

3.  **Le Super admin (ou admin Système) :**
    -   C'est un utilisateur interne avec des droits très élevés, responsable de la gestion et de la maintenance de l'application elle-même.
    -   Son rôle est d'administrer les comptes des autres utilisateurs (notamment les admins), de définir les règles d'accès et de sécurité (rôles, permissions, politiques de mot de passe), de configurer les paramètres généraux du système, et de superviser son bon fonctionnement et son audit.

Ces trois acteurs principaux représentent les catégories d'utilisateurs qui interagiront le plus activement avec l'interface de l'application. D'autres entités (comme les ayants droit, les bénéficiaires, ou des tiers payeurs) seront gérées **par** ces acteurs **dans** le système, mais ne sont pas nécessairement des utilisateurs directs avec un accès propre à l'interface de l'application dans ce contexte.

---

Cette introduction pose le cadre des différents types d'utilisateurs avant de détailler les actions spécifiques qu'ils peuvent effectuer (les cas d'utilisation). Est-ce que cela correspond à ce que vous souhaitiez comme présentation des acteurs ?

## **Liste Globale des Cas d'Utilisation (Numérotation Unique par Module)**

**Module 1 : Authentification & Accès**

-   UC 1 : Se connecter à son espace personnel (Mutualiste)

**Module 2 : Gestion des Adhérents & Profils Adhérents**

-   UC 2 : Créer un nouveau mutualiste (Admin)
-   UC 3 : Mettre à jour un mutualiste (Admin)
-   UC 4 : Supprimer un mutualiste (Admin)
-   UC 5 : Valider les données d'un mutualiste (Admin)
-   UC 6 : Suspendre un mutualiste (Admin)
-   UC 7 : Réactiver un mutualiste (Admin)
-   UC 8 : Visualiser la liste des mutualistes suspendus (Admin)
-   UC 9 : Mettre à jour son profil (pseudo, mot de passe, téléphone) (Mutualiste)

**Module 3 : Gestion des Ayants Droit**

-   UC 10 : Gérer ses ayants droit (Ajout/Modif/Suppression) (Mutualiste)
-   UC 11 : Visualiser la liste de ses ayants droit (Mutualiste)

**Module 4 : Gestion de la Carte Dématérialisée Adhérent**

-   UC 12 : Afficher sa carte dématérialisée (Mutualiste)
-   UC 13 : Afficher la carte dématérialisée d'un ayant droit (Mutualiste)

**Module 5 : Gestion des Cotisations & Paiements**

-   UC 14 : Payer ses cotisations (par CB, Orange Money, Mobile Money) (Mutualiste)
-   UC 15 : Visualiser l'historique de ses cotisations (Mutualiste)

**Module 6 : Gestion et Consultation des Prêts**

-   UC 16 : Créer un prêt pour un mutualiste (Admin)
-   UC 17 : Visualiser l'encours d'un prêt (Admin)
-   UC 18 : Relancer un mutualiste (mail interne / SMS) (Admin)
-   UC 19 : Visualiser l'encours de son prêt (Mutualiste)
-   UC 20 : Consulter son échéancier / tableau d'amortissement (Mutualiste)

**Module 7 : Gestion et Consultation des Rachats de Prêts**

-   UC 21 : Créer un rachat de prêt (Admin)
-   UC 22 : Visualiser l'encours d'un rachat de prêt (Admin)
-   UC 23 : Visualiser ses rachats de prêt (Mutualiste)
-   UC 24 : Visualiser l'encours d'un rachat de prêt (Mutualiste)

**Module 8 : Gestion et Consultation des Aides**

-   UC 25 : Créer une aide (numéraire ou matériel) (Admin)
-   UC 26 : Visualiser l'ensemble des aides accordées (Admin)
-   UC 27 : Visualiser les aides reçues (Mutualiste)

**Module 9 : Gestion et Consultation des Prises en Charge**

-   UC 28 : Créer une prise en charge (Admin)
-   UC 29 : Visualiser les prises en charge (Admin)
-   UC 30 : Identifier les prises en charge fréquentes (Reporting) (Admin)
-   UC 31 : Visualiser l'historique de ses prises en charge (Mutualiste)

**Module 10 : Gestion et Suivi des Liquidations**

-   UC 32 : Lancer la procédure de liquidation des droits (Admin)
-   UC 33 : Suivre le processus de liquidation (Admin)
-   UC 34 : Visualiser les documents de liquidation (Admin)
-   UC 35 : Suivre l'évolution de sa liquidation de droits (Mutualiste)

**Module 11 : Gestion des Prestations & Contrats**

-   UC 36 : Gérer les types de prestations/contrats (Admin)
-   UC 37 : Associer prestations/contrat à un mutualiste (Admin)
-   UC 38 : Consulter la liste des prestations incluses dans son contrat (Mutualiste)

**Module 12 : Gestion des Prêts de Matériels**

-   UC 39 : Enregistrer un prêt de matériel (Admin)
-   UC 40 : Visualiser l'état des prêts de matériels (Admin)

**Module 13: Gestion des reclamations & litiges**

-   UC 42: Soumettre une reclamation
-   UC 43: Trainder une reclamation
-   UC 44: Visualiser l'historique de ses reclamations
-   UC 45: Visualiser les donnees liees a une reclamation

**Module 14: Gestion de la message Interne**

-   UC 46: Envoyer une message a l'administration
-   UC 47: Repondre a un message
-   UC 48: Visualiser les messages (Admin)
-   UC 49: Renvoyer un message a un mutualiste
-   UC 50: Visualiser ses message (Mutualiste)

**Module 15 : Tableaux de Bord**

-   UC 51 : Visualiser le tableau de bord admin (Admin)
-   UC 52 : Visualiser le tableau de bord Mutualiste (Mutualiste)

**Module 16 : Gestion des Utilisateurs de l'Application** [OK]
**[Implementer]**

-   UC 53 : Gérer les comptes admins (Super Admin)
-   UC 55 : Gérer les rôles et permissions (Super Admin)
-   UC 57 : Consulter les notifications (Admin/Mutualiste)
-   UC 58 : Gérer les notifications (Admin)

**[No implementer]**

-   UC 54 : Consulter les logs d'activité (Super Admin)
-   UC 56 : Gérer la politique de mot de passe (Super Admin)
-   UC 59 : Gérer la configuration systeme (Admin)
-   UC 60 : Visualiser les rapports (Admin)
-   UC 61 : Exporter des données (Admin)
-   UC 62 : Importer des données (Admin)
-   UC 63 : Archiver des données (Admin)
-   UC 64 : Sauvegarder la base de données (Admin)
-   UC 65 : Restaurer la base de données (Admin)

**Module 17 : Gestion Financière & Trésorerie Interne**

-   UC 66 : Enregistrer une dépense de fonctionnement (Admin)
-   UC 67 : Visualiser les dépenses de fonctionnement (Admin)
-   UC 68 : Visualiser la répartition des dépenses (Admin)
-   UC 69 : Enregistrer une entrée en caisse (Admin)
-   UC 70 : Enregistrer une sortie de caisse (Admin)
-   UC 71 : Consulter l'état de caisse (balance) (Admin)
-   UC 72 : Visualiser les états récapitulatifs de caisse (Admin)
-   UC 73 : Visualiser les projections et tendances de caisse (Admin)
-   UC 74 : Visualiser la santé financière à J-1 (Admin)

## Description des cas d'utilisations.

### Module 1 : Authentification & Accès

**UC 1 - Se connecter à son espace personnel**

-   **Module :** 1 - Authentification & Accès
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste d'accéder de manière sécurisée à son espace personnel en fournissant ses identifiants (login et mot de passe).

-   **Préconditions :**

    -   Le mutualiste dispose d'un compte utilisateur créé dans le système.
    -   Le compte utilisateur a été activé (validé) par l'admin.
    -   Le mutualiste connaît son identifiant (login) et son mot de passe.
    -   Le système est opérationnel et accessible via l'interface (web ou mobile).

-   **Postconditions :**

    -   Si la connexion réussit : Le mutualiste est authentifié, une session utilisateur sécurisée est établie, et il est redirigé vers son tableau de bord personnel. La date et l'heure de la connexion sont enregistrées.
    -   Si la connexion échoue : Le mutualiste reste sur la page de connexion et un message d'erreur approprié est affiché.

-   **Scénario principal :**

    1.  Le Mutualiste accède à l'interface de connexion du système (application web ou mobile).
    2.  Le système affiche le formulaire de connexion (champs pour identifiant et mot de passe, bouton de connexion).
    3.  Le Mutualiste saisit son identifiant dans le champ "Identifiant".
    4.  Le Mutualiste saisit son mot de passe dans le champ "Mot de passe".
    5.  Le Mutualiste clique sur le bouton "Se connecter".
    6.  Le système reçoit et valide les identifiants fournis.
    7.  Le système vérifie que le compte associé aux identifiants est actif et non suspendu.
    8.  Le système établit une session utilisateur sécurisée pour le Mutualiste.
    9.  Le système enregistre la date et l'heure de la connexion réussie pour le compte du Mutualiste.
    10. Le système redirige le Mutualiste vers son tableau de bord personnel (UC 52).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Identifiants invalides**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. Le système vérifie les identifiants, mais la combinaison identifiant/mot de passe est incorrecte ou l'identifiant n'existe pas.
        -   7.a. Le système affiche un message d'erreur indiquant "Identifiant ou mot de passe incorrect."
        -   8.a. Le système maintient le Mutualiste sur la page de connexion.

    -   **Scénario Alternatif A2 : Compte inactif (non validé)**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système vérifie le statut du compte, mais constate qu'il n'a pas encore été validé par un admin.
        -   8.a. Le système affiche un message informant le Mutualiste que son compte n'est pas encore actif et qu'il doit attendre la validation de l'administration, éventuellement avec une indication sur comment contacter l'administration.
        -   9.a. Le système maintient le Mutualiste sur la page de connexion.

    -   **Scénario Alternatif A3 : Compte suspendu**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système vérifie le statut du compte, mais constate qu'il est suspendu.
        -   8.a. Le système affiche un message informant le Mutualiste que son compte est suspendu et l'invite à contacter l'administration pour plus d'informations.
        -   9.a. Le système maintient le Mutualiste sur la page de connexion.

    -   **Scénario d'Exception E1 : Erreur système lors de la connexion**
        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.e. Une erreur technique imprévue se produit lors de la validation des identifiants ou de la création de la session.
        -   7.e. Le système enregistre l'erreur (pour l'analyse technique).
        -   8.e. Le système affiche un message d'erreur générique à l'utilisateur l'informant qu'une erreur s'est produite et qu'il doit réessayer ou contacter le support.
        -   9.e. Le système maintient le Mutualiste sur la page de connexion.

-   **Points à considérer pour la suite :**
    -   Gestion des mots de passe oubliés (nécessite un UC séparé comme "Réinitialiser son mot de passe").
    -   Gestion des tentatives de connexion infructueuses (verrouillage temporaire ou permanent du compte après X tentatives).

---

### Module 2: Gestion des Adhérents & Profils Adhérents

**UC 2 - Créer un nouveau mutualiste**

-   **Module :** 2 - Gestion des Adhérents & Profils Adhérents
-   **Acteur principal :** admin

-   **Description :** Permet à l'admin d'enregistrer les informations d'un nouvel adhérent potentiel dans le système de la mutuelle et de lui créer un compte utilisateur initial.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour gérer les adhérents.
    -   L'admin dispose de toutes les informations requises concernant le nouvel adhérent (état civil, coordonnées, etc.).
    -   Les règles de validation et les champs obligatoires pour la création d'un adhérent sont définis dans le système.

-   **Postconditions :**

    -   Un nouvel enregistrement pour le mutualiste est créé dans la base de données avec un statut initial (par exemple, "Enregistré", "En attente de validation").
    -   Un compte utilisateur initial est généré et associé à ce mutualiste.
    -   Le mutualiste reçoit ses informations de connexion initiales (par email, SMS ou autre moyen configuré).
    -   Le système enregistre un historique de cette action (qui a créé, quand).

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des adhérents.
    2.  L'admin clique sur l'option ou le bouton "Créer un nouvel adhérent".
    3.  Le système affiche un formulaire vide de saisie des informations de l'adhérent (champs pour nom, prénom, date de naissance, adresse, contacts, etc.).
    4.  L'admin saisit les informations requises et optionnelles du nouvel adhérent dans les champs appropriés.
    5.  L'admin définit (ou le système génère automatiquement) l'identifiant (login) et le mot de passe initial/temporaire pour le compte utilisateur associé.
    6.  L'admin vérifie les informations saisies.
    7.  L'admin clique sur le bouton "Enregistrer" ou "Créer".
    8.  Le système valide les données saisies selon les règles métier configurées (format des champs, présence des champs obligatoires, unicité de certaines données comme le login, etc.).
    9.  Le système crée un nouvel enregistrement pour le mutualiste dans la base de données.
    10. Le système crée le compte utilisateur associé et le lie à l'enregistrement du mutualiste.
    11. Le système définit le statut initial du mutualiste (ex: "Enregistré", "En attente de validation par l'admin", etc.).
    12. Le système génère et envoie une notification (email, SMS, ou autre) au nouvel adhérent contenant son identifiant, son mot de passe temporaire, et un lien ou des instructions pour se connecter.
    13. Le système affiche un message de succès à l'admin confirmant la création et l'envoi de la notification.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation par l'admin**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. L'admin décide d'annuler l'opération avant de sauvegarder.
        -   8.a. L'admin clique sur un bouton "Annuler".
        -   9.a. Le système abandonne le processus de création et redirige l'admin vers la page précédente (ex: liste des adhérents). Aucune donnée n'est enregistrée.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. Le système effectue la validation des données et détecte que des champs obligatoires sont vides ou que les données saisies ne respectent pas les formats attendus (ex: numéro de téléphone invalide, date de naissance future).
        -   9.a. Le système affiche des messages d'erreur clairs et spécifiques à côté de chaque champ concerné.
        -   10.a. Le système maintient l'admin sur le formulaire pré-rempli avec les données saisies, lui permettant de corriger les erreurs.

    -   **Scénario Alternatif A3 : Login utilisateur déjà utilisé**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système tente de créer le compte utilisateur et détecte que l'identifiant (login) choisi existe déjà dans la base de données.
        -   10.a. Le système affiche un message d'erreur indiquant que le login est déjà pris.
        -   11.a. Le système maintient l'admin sur le formulaire, lui demandant de choisir un autre login.

    -   **Scénario d'Exception E1 : Erreur technique lors de l'enregistrement**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.e. Une erreur technique (ex: problème de base de données, timeout) se produit lors de la tentative de création de l'enregistrement du mutualiste ou du compte utilisateur.
        -   10.e. Le système enregistre l'erreur technique dans ses logs.
        -   11.e. Le système affiche un message d'erreur générique à l'admin l'informant que la création a échoué en raison d'une erreur interne et de réessayer plus tard ou contacter le support.
        -   12.e. L'opération n'est pas complétée, le mutualiste n'est pas créé dans le système.

    -   **Scénario d'Exception E2 : Échec de l'envoi de la notification**
        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Le système tente d'envoyer la notification (email/SMS), mais l'envoi échoue (ex: adresse email invalide, problème de service d'envoi).
        -   13.e. Le système enregistre que l'envoi de la notification a échoué.
        -   14.e. Le système _crée quand même_ le mutualiste et le compte utilisateur (selon les règles, la création est prioritaire sur la notification), affiche un message de succès _avec un avertissement_ à l'admin indiquant que le mutualiste a été créé mais que l'envoi de la notification a échoué. L'admin devra potentiellement notifier le mutualiste manuellement ou corriger les informations de contact et retenter l'envoi.

---

**UC 3 - Mettre à jour un mutualiste**

-   **Module :** 2 - Gestion des Adhérents & Profils Adhérents
-   **Acteur principal :** admin

-   **Description :** Permet à un admin autorisé de modifier les informations enregistrées d'un mutualiste existant dans le système.

-   **Préconditions :**

    -   L'admin est authentifié et possède les droits nécessaires pour modifier les informations des adhérents.
    -   Le mutualiste dont les informations doivent être modifiées existe dans la base de données.
    -   L'admin a identifié le mutualiste via la fonctionnalité de recherche ou de liste.

-   **Postconditions :**

    -   Les informations du mutualiste sélectionné sont mises à jour avec succès dans le système.
    -   Un enregistrement d'audit est créé, détaillant les modifications apportées (qui, quoi, quand, anciennes/nouvelles valeurs si applicable).
    -   (Optionnel) Si des informations clés (ex: contact, statut) sont modifiées, une notification peut être envoyée au mutualiste.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et accède à la section de gestion des adhérents.
    2.  L'admin recherche ou sélectionne le mutualiste dont il souhaite modifier les informations.
    3.  Le système affiche les informations actuelles du mutualiste dans un formulaire éditable.
    4.  L'admin modifie les champs contenant les informations à mettre à jour (ex: numéro de téléphone, adresse, email, statut, etc.).
    5.  L'admin vérifie les modifications apportées.
    6.  L'admin clique sur le bouton "Enregistrer les modifications".
    7.  Le système valide les données saisies dans les champs modifiés (champs obligatoires, formats, cohérence).
    8.  Si les validations réussissent, le système met à jour l'enregistrement du mutualiste dans la base de données avec les nouvelles informations.
    9.  Le système enregistre un historique de la modification effectuée (date, heure, admin, type de modification, champs affectés).
    10. Le système affiche un message de confirmation à l'admin indiquant que les informations ont été mises à jour avec succès.
    11. (Optionnel) Le système déclenche l'envoi d'une notification au mutualiste si la nature des modifications le requiert (ex: changement de statut).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de la modification**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. L'admin décide de ne pas sauvegarder les modifications.
        -   7.a. L'admin clique sur un bouton "Annuler".
        -   8.a. Le système abandonne le processus de modification et redirige l'admin vers la page précédente ou la vue du mutualiste sans appliquer les changements.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées après modification**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système valide les données modifiées et détecte que des informations sont invalides ou que des champs obligatoires sont maintenant vides.
        -   8.a. Le système affiche des messages d'erreur clairs à côté des champs concernés.
        -   9.a. Le système maintient l'admin sur le formulaire avec les modifications pour qu'il puisse corriger.

    -   **Scénario d'Exception E1 : Mutualiste introuvable**

        -   ... (Étapes 1 à 2 du scénario principal)
        -   3.e. Le mutualiste recherché ou sélectionné n'est pas trouvé ou n'existe plus dans le système (ex: supprimé par un autre admin).
        -   4.e. Le système affiche un message informant l'admin que le mutualiste n'a pas été trouvé.
        -   5.e. Le processus de modification ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur système lors de la sauvegarde des modifications**
        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.e. Une erreur technique se produit lors de la tentative de mise à jour des données du mutualiste dans la base de données.
        -   9.e. Le système enregistre l'erreur technique.
        -   10.e. Le système affiche un message d'erreur générique à l'admin indiquant que la modification a échoué.
        -   11.e. Les informations du mutualiste ne sont pas mises à jour.

---

**UC 4 - Supprimer un mutualiste**

-   **Module :** 2 - Gestion des Adhérents & Profils Adhérents
-   **Acteur principal :** admin

-   **Description :** Permet à un admin autorisé de retirer un mutualiste du système, soit en le supprimant définitivement, soit en l'archivant ou en le marquant comme inactif, selon la politique de gestion de la mutuelle.

-   **Préconditions :**

    -   L'admin est authentifié et possède les droits nécessaires pour supprimer des adhérents.
    -   Le mutualiste à supprimer existe dans la base de données.
    -   L'admin a identifié le mutualiste concerné.
    -   Le mutualiste ne possède pas d'opérations actives ou de dépendances bloquantes qui empêcheraient la suppression (ex: prêt en cours, liquidation non finalisée, ayants droit rattachés nécessitant une action préalable, solde négatif critique).

-   **Postconditions :**

    -   L'enregistrement du mutualiste est supprimé, archivé ou marqué comme inactif selon la règle métier définie.
    -   Le compte utilisateur associé est désactivé ou supprimé.
    -   L'accès du mutualiste et de ses ayants droit (via son compte) au système est révoqué.
    -   Les données historiques liées au mutualiste (cotisations, prêts, aides, etc.) sont préservées et associées à l'enregistrement archivé/inactif, conformément aux politiques de rétention et de conformité.
    -   Un enregistrement d'audit est créé, détaillant l'action de suppression (qui, quand, quel mutualiste, type d'opération effectuée).

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des adhérents.
    2.  L'admin recherche ou sélectionne le mutualiste qu'il souhaite supprimer.
    3.  Le système affiche les informations du mutualiste.
    4.  L'admin clique sur l'option ou le bouton "Supprimer".
    5.  Le système affiche un message de confirmation demandant à l'admin de valider son choix, et peut présenter un avertissement sur les conséquences (ex: irréversible, archivage).
    6.  L'admin confirme la suppression.
    7.  Le système vérifie automatiquement les préconditions : y a-t-il des prêts en cours ? Des liquidations en attente ? D'autres éléments bloquants ?
    8.  Si aucune opération bloquante n'est détectée, le système exécute l'opération de suppression/archivage définie (ex: met à jour le statut de l'enregistrement mutualiste à "Archivé", désactive le compte utilisateur, supprime les liens actifs si nécessaire).
    9.  Le système enregistre l'action de suppression dans les logs d'audit.
    10. Le système affiche un message de confirmation à l'admin indiquant que le mutualiste a été traité avec succès (ex: "Mutualiste archivé avec succès").

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'opération**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. L'admin décide de ne pas poursuivre la suppression.
        -   7.a. L'admin clique sur un bouton "Annuler" ou ferme la boîte de confirmation.
        -   8.a. Le système abandonne l'opération et l'enregistrement du mutualiste reste inchangé.

    -   **Scénario Alternatif A2 : Suppression bloquée par des dépendances ou opérations actives**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système vérifie les préconditions et détecte qu'il existe des éléments qui empêchent la suppression (ex: un prêt non soldé).
        -   8.a. Le système affiche un message d'erreur clair à l'admin expliquant pourquoi la suppression est impossible et listant les éléments bloquants (ex: "Suppression impossible : prêt n° [X] en cours").
        -   9.a. Le système ne procède pas à la suppression. L'admin doit d'abord gérer les éléments bloquants.

    -   **Scénario d'Exception E1 : Mutualiste introuvable**

        -   ... (Étapes 1 à 2 du scénario principal)
        -   3.e. Le mutualiste recherché ou sélectionné n'est pas trouvé dans le système (ex: déjà supprimé ou erreur de recherche).
        -   4.e. Le système affiche un message d'erreur à l'admin indiquant que le mutualiste n'a pas été trouvé.
        -   5.e. L'opération de suppression ne peut pas se poursuivre.

    -   **Scénario d'Exception E2 : Erreur système lors de l'opération de suppression/archivage**
        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.e. Une erreur technique imprévue se produit pendant que le système tente de modifier ou supprimer l'enregistrement du mutualiste ou son compte utilisateur.
        -   9.e. Le système enregistre l'erreur technique.
        -   10.e. Le système affiche un message d'erreur générique à l'admin indiquant que l'opération a échoué.
        -   11.e. L'état du mutualiste dans le système n'est pas modifié ou est dans un état incohérent (nécessitant une intervention technique).

-   **Points à considérer pour la suite :**
    -   Définir précisément la liste exhaustive des "opérations actives bloquantes".
    -   Clarifier la politique exacte d'archivage/suppression et son impact sur les données liées.
    -   Y a-t-il des niveaux de droits différents pour la suppression (ex: seul un super-admin peut faire une suppression physique) ?

---

**UC 5 - Valider les données d'un mutualiste**

-   **Module :** 2 - Gestion des Adhérents & Profils Adhérents
-   **Acteur principal :** admin

-   **Description :** Permet à un admin de vérifier, confirmer et finaliser l'enregistrement d'un nouveau mutualiste après la saisie initiale des données, faisant passer son statut à "Actif" ou "Validé".

-   **Préconditions :**

    -   L'admin est authentifié et dispose des droits nécessaires pour valider les adhérents.
    -   Le mutualiste à valider existe dans le système et est dans un statut indiquant qu'il est en attente de validation ou d'examen.
    -   L'admin a accès aux informations complètes de l'adhérent et aux éventuels documents justificatifs nécessaires.

-   **Postconditions :**

    -   Le statut du mutualiste est mis à jour vers "Validé", "Actif" ou un statut équivalent permettant l'accès complet aux services.
    -   Le compte utilisateur associé est activé, si ce n'était pas déjà fait, et permet la connexion (UC 1).
    -   Un enregistrement d'audit est créé pour l'action de validation (qui a validé, quand).
    -   Une notification est envoyée au mutualiste l'informant de la validation de son compte.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des adhérents.
    2.  L'admin accède à la liste ou utilise des filtres pour afficher les mutualistes dont les données sont en attente de validation.
    3.  L'admin sélectionne le mutualiste à valider pour examiner ses informations.
    4.  Le système affiche les informations complètes du mutualiste et permet de visualiser les documents justificatifs associés (s'ils existent et sont gérés par le système).
    5.  L'admin examine attentivement les informations et les documents fournis.
    6.  L'admin détermine que les informations sont exactes, complètes et conformes.
    7.  L'admin clique sur l'option ou le bouton "Valider".
    8.  Le système met à jour le statut du mutualiste à "Validé" ou "Actif".
    9.  Le système active le compte utilisateur associé s'il était précédemment en état d'attente.
    10. Le système enregistre l'historique de cette validation (date, heure, admin ayant validé).
    11. Le système affiche un message de confirmation à l'admin indiquant que le mutualiste a été validé avec succès.
    12. Le système génère et envoie une notification (email/SMS) au mutualiste pour l'informer que son compte est validé et qu'il peut utiliser l'espace personnel.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Validation refusée / Informations incorrectes ou incomplètes**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. L'admin examine les informations et/ou documents et constate qu'ils sont incorrects, incomplets, ou non conformes aux exigences.
        -   7.a. L'admin clique sur l'option ou le bouton "Refuser la validation" ou "Marquer comme incomplet".
        -   8.a. Le système met à jour le statut du mutualiste à un état comme "Validation Refusée" ou "Informations Incomplètes".
        -   9.a. Le système peut inviter l'admin à saisir un motif ou un commentaire expliquant le refus/l'état incomplet.
        -   10.a. Le système enregistre l'historique du refus de validation, incluant le motif si renseigné.
        -   11.a. Le système affiche un message de confirmation à l'admin.
        -   12.a. Le système peut envoyer une notification au mutualiste l'informant du refus/état incomplet et des raisons, l'invitant à mettre à jour ses informations (ce qui pourrait renvoyer le dossier en attente de validation, bouclant le processus).

    -   **Scénario Alternatif A2 : Annulation de l'opération de validation**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. L'admin décide de ne pas valider ni refuser pour l'instant.
        -   7.a. L'admin quitte l'écran de visualisation/validation du mutualiste sans cliquer sur "Valider" ou "Refuser".
        -   8.a. Le système abandonne le processus sans modifier le statut du mutualiste.

    -   **Scénario d'Exception E1 : Mutualiste introuvable ou statut non valide**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Le mutualiste sélectionné n'est pas trouvé, n'existe plus, ou n'est pas dans un statut éligible à la validation.
        -   5.e. Le système affiche un message d'erreur à l'admin.
        -   6.e. L'opération de validation ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement de la validation**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.e. Une erreur technique se produit lors de la tentative de mise à jour du statut du mutualiste, de l'activation du compte utilisateur, ou de l'enregistrement de l'historique.
        -   9.e. Le système enregistre l'erreur technique dans ses logs.
        -   10.e. Le système affiche un message d'erreur générique à l'admin indiquant que la validation a échoué.
        -   11.e. Le statut du mutualiste n'est pas modifié ou est dans un état incohérent.

    -   **Scénario d'Exception E3 : Échec de l'envoi de la notification au mutualiste**
        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Le système tente d'envoyer la notification de validation au mutualiste, mais l'envoi échoue.
        -   13.e. Le système enregistre l'échec de l'envoi.
        -   14.e. Le système affiche un message de succès à l'admin pour la validation, mais _avec un avertissement_ indiquant que la notification n'a pas pu être envoyée.

---

**UC 6 - Suspendre un mutualiste**

-   **Module :** 2 - Gestion des Adhérents & Profils Adhérents
-   **Acteur principal :** admin

-   **Description :** Permet à un admin de changer le statut d'un mutualiste en "Suspendu" suite à l'application des règles de la mutuelle (ex: impayés de cotisations, non-respect des engagements). Cette action limite généralement l'accès du mutualiste aux services et fonctionnalités.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits requis pour modifier le statut des adhérents.
    -   Le mutualiste à suspendre existe dans le système et n'est pas déjà dans un statut final (ex: Archivé, Supprimé).
    -   L'admin a identifié le mutualiste concerné.
    -   Les conditions métier pour la suspension de l'adhérent sont remplies (ex: validation automatique ou manuelle des impayés).

-   **Postconditions :**

    -   Le statut du mutualiste est mis à jour à "Suspendu".
    -   L'accès du mutualiste à son espace personnel et/à certaines fonctionnalités est restreint selon les règles configurées.
    -   Les droits et bénéfices de l'adhérent (ex: éligibilité prêts/aides) sont gelés ou modifiés.
    -   Un enregistrement d'audit est créé pour l'action de suspension (qui a suspendu, quand, motif si renseigné).
    -   Une notification est envoyée au mutualiste pour l'informer de sa suspension et de ses conséquences.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des adhérents.
    2.  L'admin recherche ou sélectionne le mutualiste qu'il souhaite suspendre.
    3.  Le système affiche les informations du mutualiste, y compris son statut actuel.
    4.  L'admin clique sur l'option ou le bouton "Suspendre".
    5.  Le système peut afficher une boîte de dialogue demandant confirmation et/ou permettant de saisir un motif de suspension (ex: "Impayé Cotisations T3 2024").
    6.  L'admin confirme l'action et saisit le motif si demandé.
    7.  Le système vérifie que le statut actuel du mutualiste permet la suspension et que l'admin a les droits.
    8.  Le système met à jour le statut du mutualiste dans la base de données à "Suspendu".
    9.  Le système ajuste automatiquement les permissions d'accès et les règles d'éligibilité pour ce mutualiste en fonction de son nouveau statut.
    10. Le système enregistre l'historique de la suspension (date, heure, admin, mutualiste, motif).
    11. Le système affiche un message de confirmation à l'admin indiquant que le mutualiste a été suspendu avec succès.
    12. Le système génère et envoie une notification (email, SMS, ou via messagerie interne) au mutualiste pour l'informer de sa suspension, du motif (si applicable), et des actions requises pour lever la suspension (ex: payer les cotisations dues).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'opération de suspension**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. L'admin décide de ne pas suspendre le mutualiste.
        -   7.a. L'admin clique sur un bouton "Annuler" ou ferme la boîte de dialogue.
        -   8.a. Le système abandonne l'opération et le statut du mutualiste reste inchangé.

    -   **Scénario Alternatif A2 : Motif de suspension obligatoire non fourni**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système est configuré pour rendre le motif de suspension obligatoire, mais l'admin soumet la confirmation sans le remplir.
        -   8.a. Le système affiche un message d'erreur demandant la saisie du motif.
        -   9.a. L'admin doit fournir le motif pour valider l'action (retour à l'étape 6).

    -   **Scénario Alternatif A3 : Mutualiste déjà dans un statut final ou non suspensible**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. Le système vérifie le statut du mutualiste et constate qu'il est déjà suspendu, archivé, supprimé, ou dans un statut (ex: En attente de validation) qui ne permet pas une suspension.
        -   9.a. Le système affiche un message d'erreur à l'admin indiquant que l'action de suspension n'est pas possible pour ce mutualiste dans son état actuel.
        -   10.a. Le système ne procède pas à la suspension.

    -   **Scénario d'Exception E1 : Mutualiste introuvable**

        -   ... (Étapes 1 à 2 du scénario principal)
        -   3.e. Le mutualiste recherché ou sélectionné n'est pas trouvé dans le système.
        -   4.e. Le système affiche un message d'erreur à l'admin.
        -   5.e. L'opération de suspension ne peut pas se poursuivre.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement de la suspension**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.e. Une erreur technique se produit lors de la tentative de mise à jour du statut ou de l'enregistrement de l'historique.
        -   10.e. Le système enregistre l'erreur technique dans ses logs.
        -   11.e. Le système affiche un message d'erreur générique à l'admin et l'opération de suspension échoue.

    -   **Scénario d'Exception E3 : Échec de l'envoi de la notification au mutualiste**
        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Le système tente d'envoyer la notification de suspension au mutualiste, mais l'envoi échoue (ex: problème technique avec le service d'envoi).
        -   13.e. Le système enregistre l'échec de l'envoi et peut alerter l'admin.
        -   14.e. La suspension est marquée comme réussie, mais l'admin est informé que la notification n'a pas pu être envoyée et pourrait devoir contacter le mutualiste manuellement.

-   **Points à considérer pour la suite :**
    -   Définir précisément les différentes raisons ou types de suspension si applicable.
    -   Préciser comment les droits et l'accès sont _spécifiquement_ restreints pour un mutualiste suspendu (ex: blocage total de l'espace personnel vs blocage de certaines fonctionnalités).
    -   Y a-t-il des actions automatiques déclenchées par la suspension (ex: annulation des prélèvements automatiques si applicable) ?

---

**UC 7 - Réactiver un mutualiste**

-   **Module :** 2 - Gestion des Adhérents & Profils Adhérents
-   **Acteur principal :** admin

-   **Description :** Permet à un admin de rétablir le statut actif d'un mutualiste qui avait été précédemment suspendu. Cette action redonne au mutualiste l'accès à son espace personnel et à l'intégralité de ses droits et avantages d'adhésion.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour modifier le statut des adhérents.
    -   Le mutualiste à réactiver existe dans le système et son statut actuel est "Suspendu".
    -   L'admin a identifié le mutualiste et les conditions requises pour la levée de sa suspension ont été remplies (ex: apurement des cotisations impayées, résolution du problème initial).

-   **Postconditions :**

    -   Le statut du mutualiste est mis à jour vers un statut actif approprié (ex: "Actif", "Validé").
    -   L'accès complet du mutualiste à son espace personnel et à toutes les fonctionnalités est rétabli.
    -   Les droits et avantages liés à son adhésion sont réactivés selon les règles de la mutuelle.
    -   Un enregistrement d'audit est créé pour l'action de réactivation (qui a réactivé, quand, motif si renseigné).
    -   Une notification est envoyée au mutualiste pour l'informer que son compte est réactivé.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des adhérents.
    2.  L'admin recherche ou sélectionne le mutualiste qu'il souhaite réactiver (potentiellement en filtrant sur les mutualistes suspendus - voir UC 8).
    3.  Le système affiche les informations du mutualiste, confirmant son statut actuel "Suspendu".
    4.  L'admin vérifie que les raisons ayant entraîné la suspension ont été résolues (ex: consulte l'historique des paiements, vérifie les notes du dossier).
    5.  L'admin clique sur l'option ou le bouton "Réactiver".
    6.  Le système peut afficher une boîte de dialogue demandant confirmation et/ou permettant à l'admin de saisir un motif pour la réactivation (ex: "Situation d'impayés régularisée").
    7.  L'admin confirme l'action de réactivation et saisit le motif si nécessaire.
    8.  Le système vérifie que le statut actuel du mutualiste est bien "Suspendu" et que l'admin a les droits d'effectuer cette action.
    9.  Le système met à jour le statut du mutualiste dans la base de données vers "Actif" ou tout autre statut post-suspension défini.
    10. Le système rétablit les permissions d'accès et les règles d'éligibilité associées au nouveau statut du mutualiste.
    11. Le système enregistre l'historique de la réactivation (date, heure, admin, mutualiste, motif de réactivation).
    12. Le système affiche un message de confirmation à l'admin indiquant que le mutualiste a été réactivé avec succès.
    13. Le système génère et envoie une notification (par email, SMS, ou via la messagerie interne si l'accès est rétabli) au mutualiste pour l'informer que son compte est réactivé et qu'il peut à nouveau profiter pleinement de ses droits.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'opération de réactivation**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. L'admin décide d'annuler l'opération.
        -   8.a. L'admin clique sur un bouton "Annuler" ou ferme la boîte de dialogue de confirmation.
        -   9.a. Le système abandonne l'opération et le statut du mutualiste reste inchangé ("Suspendu").

    -   **Scénario Alternatif A2 : Motif de réactivation obligatoire non fourni**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système exige la saisie d'un motif de réactivation, mais l'admin ne le fournit pas avant de confirmer.
        -   8.a. Le système affiche un message d'erreur demandant de saisir le motif.
        -   9.a. L'admin doit fournir le motif pour pouvoir continuer (retour à l'étape 7).

    -   **Scénario Alternatif A3 : Mutualiste n'est pas en statut "Suspendu"**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système vérifie le statut du mutualiste et constate qu'il n'est pas en statut "Suspendu" (ex: il est déjà Actif, ou dans un statut final comme Archivé).
        -   10.a. Le système affiche un message d'erreur à l'admin indiquant que cette action n'est pas applicable au mutualiste dans son état actuel.
        -   11.a. Le système ne procède pas à la réactivation.

    -   **Scénario d'Exception E1 : Mutualiste introuvable**

        -   ... (Étapes 1 à 2 du scénario principal)
        -   3.e. Le mutualiste recherché ou sélectionné n'est pas trouvé dans le système.
        -   4.e. Le système affiche un message d'erreur à l'admin.
        -   5.e. L'opération de réactivation ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement de la réactivation**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.e. Une erreur technique imprévue se produit lors de la tentative de mise à jour du statut, du rétablissement des droits ou de l'enregistrement de l'historique.
        -   11.e. Le système enregistre l'erreur technique dans ses logs.
        -   12.e. Le système affiche un message d'erreur générique à l'admin et l'opération de réactivation échoue.

    -   **Scénario d'Exception E3 : Échec de l'envoi de la notification au mutualiste**
        -   ... (Étapes 1 à 12 du scénario principal)
        -   13.e. Le système tente d'envoyer la notification de réactivation au mutualiste, mais l'envoi échoue (ex: problème de connexion, adresse invalide si email/sms, ou messagerie interne inaccessible si l'accès n'est pas immédiatement rétabli).
        -   14.e. Le système enregistre l'échec de l'envoi et peut alerter l'admin (ex: "Réactivation réussie, mais notification non envoyée").
        -   15.e. La réactivation est complète du point de vue système, mais l'admin pourrait devoir contacter le mutualiste par un autre moyen.

-   **Points à considérer pour la suite :**
    -   Existe-t-il différents statuts actifs vers lesquels un mutualiste peut être réactivé, ou seulement un statut "Actif" principal ?
    -   Certains droits ou avantages sont-ils réactivés avec un délai ou des conditions supplémentaires après la levée de suspension ?

---

**UC 8 - Visualiser la liste des mutualistes suspendus**

-   **Module :** 2 - Gestion des Adhérents & Profils Adhérents
-   **Acteur principal :** admin

-   **Description :** Permet à l'admin de consulter la liste de tous les mutualistes dont l'accès ou les droits ont été temporairement retirés (statut "Suspendu"). Cette fonctionnalité est essentielle pour le suivi des adhérents nécessitant une attention particulière.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits de consultation des informations des adhérents.
    -   L'interface de gestion des adhérents est accessible.

-   **Postconditions :**

    -   L'admin a consulté la liste des mutualistes actuellement suspendus. Aucune modification de données n'est effectuée par ce cas d'utilisation.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des adhérents.
    2.  L'admin accède à la vue dédiée aux listes filtrées d'adhérents (par exemple, en cliquant sur un lien "Mutualistes suspendus" sur le tableau de bord ou en appliquant un filtre dans la liste générale des adhérents).
    3.  Le système interroge la base de données pour identifier et récupérer les informations des mutualistes ayant le statut "Suspendu".
    4.  Le système affiche la liste des mutualistes suspendus à l'écran. La liste inclut généralement les informations d'identification de base (Nom, Prénom, Numéro d'adhérent) ainsi que des informations pertinentes sur la suspension (Date de suspension, Motif de suspension si renseigné lors de l'UC 6).
    5.  L'admin consulte la liste affichée.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucun mutualiste suspendu**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucun enregistrement de mutualiste avec le statut "Suspendu".
        -   5.a. Le système affiche un message informant l'admin qu'"Aucun mutualiste n'est actuellement suspendu" ou présente une liste vide avec cette indication.
        -   6.a. L'admin prend connaissance de cette information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique se produit lors de l'accès à la base de données ou du chargement de la liste des mutualistes.
        -   5.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. Le système affiche un message d'erreur à l'admin indiquant que la liste des mutualistes suspendus n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles colonnes d'informations exactes doivent figurer dans cette liste ?
    -   Des options de tri ou de filtrage supplémentaires sont-elles nécessaires (ex: tri par date de suspension, filtrage par motif) ?
    -   Y a-t-il une pagination si le nombre de mutualistes suspendus est important ?
    -   Est-il possible d'exporter cette liste (ce serait un autre cas d'utilisation) ?
    -   En cliquant sur un élément de la liste, cela devrait permettre d'accéder aux informations détaillées du mutualiste, potentiellement pour le réactiver (via l'UC 7) ou mettre à jour d'autres informations (via l'UC 3).

---

**UC 9 - Mettre à jour son profil**

-   **Module :** 2 - Gestion des Adhérents & Profils Adhérents
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de consulter ses informations personnelles et de modifier certaines d'entre elles ainsi que les paramètres de son compte (tels que le pseudo, le mot de passe ou le numéro de téléphone de contact) via son espace personnel sécurisé.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   L'interface de gestion du profil est accessible.
    -   Le système permet la modification des champs spécifiés (pseudo, mot de passe, téléphone) par le mutualiste lui-même.

-   **Postconditions :**

    -   Les informations du profil du mutualiste sélectionnées (pseudo, numéro de téléphone) sont mises à jour dans la base de données.
    -   Si le mot de passe a été modifié, le nouveau mot de passe est enregistré et l'ancien devient invalide.
    -   Un enregistrement d'audit est créé pour l'action de modification du profil (qui a modifié, quand, quels champs).

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue vers la section "Mon Profil", "Paramètres du compte" ou une zone similaire dans son tableau de bord.
    3.  Le système affiche la page de gestion du profil, présentant les informations actuelles du Mutualiste dans des champs éditables (pseudo, numéro de téléphone). Pour le mot de passe, des champs permettent de saisir un nouveau mot de passe et sa confirmation, et éventuellement l'ancien mot de passe.
    4.  Le Mutualiste modifie les champs qu'il souhaite mettre à jour (ex: change son pseudo, saisit un nouveau numéro de téléphone).
    5.  Si le Mutualiste souhaite changer son mot de passe, il saisit l'ancien mot de passe dans le champ dédié (si requis par la configuration), puis le nouveau mot de passe dans le champ "Nouveau mot de passe" et le ressaisit dans le champ "Confirmer mot de passe".
    6.  Le Mutualiste clique sur le bouton "Enregistrer" ou "Mettre à jour mon profil".
    7.  Le système valide les données saisies : vérifie les formats (ex: numéro de téléphone), la conformité aux règles métier (ex: force du mot de passe), et si applicable, vérifie que le nouveau mot de passe et sa confirmation correspondent, et que l'ancien mot de passe est correct.
    8.  Si les validations réussissent, le système met à jour les informations correspondantes (pseudo, téléphone) dans la base de données du mutualiste.
    9.  Si le mot de passe a été changé, le système met à jour le mot de passe associé au compte utilisateur (généralement en stockant son hachage).
    10. Le système enregistre l'action dans les logs d'audit du profil de l'utilisateur.
    11. Le système affiche un message de confirmation au Mutualiste indiquant que son profil a été mis à jour avec succès.
    12. (Optionnel) Le système peut envoyer une alerte (email/SMS) au Mutualiste l'informant que son profil (ou mot de passe) a été modifié pour des raisons de sécurité.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation des modifications**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. Le Mutualiste décide de ne pas enregistrer les changements.
        -   7.a. Le Mutualiste clique sur un bouton "Annuler" ou quitte la page sans sauvegarder.
        -   8.a. Le système abandonne les modifications et aucune donnée n'est mise à jour.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système valide les données et détecte des erreurs (ex: format de numéro de téléphone incorrect, pseudo vide si obligatoire).
        -   8.a. Le système affiche des messages d'erreur clairs à côté des champs concernés.
        -   9.a. Le système maintient le Mutualiste sur le formulaire avec les données saisies, lui permettant de corriger.

    -   **Scénario Alternatif A3 : Le nouveau mot de passe et sa confirmation ne correspondent pas**

        -   ... (Étapes 1 à 5 incluant la saisie du nouveau mot de passe et confirmation)
        -   6.a. Le Mutualiste clique sur "Enregistrer".
        -   7.a. Le système valide et constate que le nouveau mot de passe et sa confirmation ne sont pas identiques.
        -   8.a. Le système affiche un message d'erreur spécifique.
        -   9.a. Le système invite le Mutualiste à ressaisir le nouveau mot de passe et sa confirmation correctement.

    -   **Scénario Alternatif A4 : Ancien mot de passe incorrect (si requis pour changer le mot de passe)**

        -   ... (Étapes 1 à 5 incluant la saisie de l'ancien mot de passe)
        -   6.a. Le Mutualiste clique sur "Enregistrer".
        -   7.a. Le système valide les données et vérifie l'ancien mot de passe fourni. L'ancien mot de passe est incorrect.
        -   8.a. Le système affiche un message d'erreur spécifique indiquant que l'ancien mot de passe est invalide.
        -   9.a. Le système invite le Mutualiste à corriger l'ancien mot de passe ou à utiliser la fonction de réinitialisation de mot de passe s'il l'a oublié.

    -   **Scénario d'Exception E1 : Erreur système lors de l'enregistrement des modifications**
        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.e. Une erreur technique imprévue se produit lors de la tentative de mise à jour des données du profil ou du mot de passe dans la base de données.
        -   9.e. Le système enregistre l'erreur technique dans ses logs.
        -   10.e. Le système affiche un message d'erreur générique au Mutualiste indiquant que la mise à jour a échoué.
        -   11.e. Les informations du profil ne sont pas mises à jour.

-   **Points à considérer pour la suite :**
    -   Quels autres champs les mutualistes devraient-ils pouvoir modifier (ex: adresse email, adresse postale, informations bancaires) ?
    -   Certaines modifications (ex: adresse, email) nécessitent-elles une re-validation par l'admin ?
    -   Quelles sont les règles précises de force du mot de passe ?
    -   Faut-il un lien vers la fonction "Mot de passe oublié" sur la page de modification du mot de passe ?

---

### Module 3: Gestion des Ayants Droit

**UC 10 - Gérer ses ayants droit (Ajout/Modif/Suppression)**

-   **Module :** 3 - Gestion des Ayants Droit
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste, via son espace personnel, de gérer la liste des personnes (ayants droit) qui lui sont rattachées et qui peuvent potentiellement bénéficier des prestations de la mutuelle dans le cadre de son adhésion. Cette gestion inclut l'ajout, la modification et la suppression des informations des ayants droit.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   L'interface de gestion des ayants droit est accessible depuis son tableau de bord.
    -   Le contrat d'adhésion du mutualiste principal permet l'ajout d'ayants droit.

-   **Postconditions :**

    -   La liste des ayants droit associée au mutualiste principal est mise à jour dans le système selon l'opération effectuée (ajout, modification, suppression).
    -   Les informations des ayants droit sont enregistrées/modifiées/supprimées (logiquement) dans la base de données.
    -   Un enregistrement d'audit est créé pour l'action de gestion des ayants droit (qui a modifié, quand, quelle opération sur quel ayant droit).
    -   (Optionnel) Les ayants droit ajoutés ou modifiés peuvent nécessiter une validation par l'admin pour être éligibles aux prestations.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue vers la section "Mes Ayants Droit" ou similaire dans son tableau de bord.
    3.  Le système affiche la page de gestion des ayants droit, présentant la liste actuelle des ayants droit rattachés au Mutualiste principal (UC 11 - Visualiser la liste des ayants droit - est implicitement appelée ici). Pour chaque ayant droit, des options pour "Modifier" ou "Supprimer" sont disponibles, et un bouton "Ajouter un ayant droit" est présent.

    -   **Sous-Scénario Principal A : Ajouter un nouvel ayant droit**
        4a. Le Mutualiste clique sur le bouton "Ajouter un ayant droit".
        5a. Le système affiche un formulaire de saisie pour les informations du nouvel ayant droit (ex: Nom, Prénom, Date de naissance, Lien de parenté, Sexe, etc.).
        6a. Le Mutualiste saisit les informations requises pour le nouvel ayant droit.
        7a. Le Mutualiste clique sur un bouton de validation (ex: "Enregistrer", "Ajouter").
        8a. Le système valide les données saisies (champs obligatoires, formats, cohérence).
        9a. Le système vérifie si l'ajout est possible selon les règles métier (ex: limite du nombre d'ayants droit par contrat).
        10a. Si les validations réussissent et l'ajout est permis, le système crée un nouvel enregistrement pour l'ayant droit et l'associe au mutualiste principal.
        11a. Le système enregistre l'historique de l'ajout.
        12a. Le système affiche un message de confirmation (ex: "Ayant droit ajouté avec succès") et met à jour l'affichage de la liste des ayants droit.
        13a. (Optionnel) Le système marque l'ayant droit comme "En attente de validation" par l'admin.

    -   **Sous-Scénario Principal M : Modifier un ayant droit existant**
        4m. Le Mutualiste clique sur l'option "Modifier" à côté de l'ayant droit qu'il souhaite mettre à jour dans la liste affichée.
        5m. Le système affiche un formulaire pré-rempli avec les informations actuelles de l'ayant droit sélectionné.
        6m. Le Mutualiste modifie les informations nécessaires dans les champs autorisés.
        7m. Le Mutualiste clique sur un bouton de validation (ex: "Enregistrer les modifications").
        8m. Le système valide les données modifiées (formats, cohérence).
        9m. Si les validations réussissent, le système met à jour l'enregistrement de l'ayant droit dans la base de données.
        10m. Le système enregistre l'historique de la modification.
        11m. Le système affiche un message de confirmation (ex: "Informations de l'ayant droit mises à jour") et met à jour l'affichage de la liste.
        12m. (Optionnel) Le système peut marquer l'ayant droit comme "À re-valider" par l'admin si des informations sensibles ont été modifiées.

    -   **Sous-Scénario Principal S : Supprimer un ayant droit**
        4s. Le Mutualiste clique sur l'option "Supprimer" à côté de l'ayant droit qu'il souhaite retirer de sa liste.
        5s. Le système affiche un message de confirmation (ex: "Êtes-vous sûr de vouloir supprimer cet ayant droit ?").
        6s. Le Mutualiste confirme la suppression.
        7s. Le système vérifie les préconditions de suppression pour cet ayant droit (ex: aucune prestation en cours ou récente ne s'y rattache selon les règles).
        8s. Si la suppression est autorisée, le système marque l'ayant droit comme supprimé ou inactif (suppression logique).
        9s. Le système enregistre l'historique de la suppression.
        10s. Le système affiche un message de confirmation (ex: "Ayant droit supprimé") et met à jour l'affichage de la liste.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'opération (Ajout, Modif ou Suppression)**

        -   Applicable aux sous-scénarios A, M, S. L'utilisateur annule avant de valider l'action.
        -   ... (Jusqu'à l'étape de validation ou confirmation dans chaque sous-scénario)
        -   X.a. Le Mutualiste clique sur un bouton "Annuler" ou équivalent.
        -   Y.a. Le système abandonne l'opération en cours. L'affichage revient à l'état précédent (ex: liste des ayants droit).

    -   **Scénario Alternatif A2 : Données manquantes ou invalides (Ajout ou Modif)**

        -   Applicable aux sous-scénarios A et M (étapes 8a, 8m). Les données saisies ne passent pas la validation.
        -   ... (Jusqu'à l'étape de validation)
        -   X.a. Le système détecte des erreurs de validation.
        -   Y.a. Le système affiche des messages d'erreur près des champs concernés. Le Mutualiste reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A3 : Suppression bloquée (Suppression)**

        -   Applicable au sous-scénario S (étape 7s). La suppression n'est pas autorisée selon les règles métier.
        -   ... (Jusqu'à l'étape de vérification des préconditions)
        -   8.a. Le système détecte des éléments qui bloquent la suppression (ex: historique d'utilisation récent, demande en cours).
        -   9.a. Le système affiche un message d'erreur indiquant pourquoi la suppression est impossible (ex: "Impossible de supprimer cet ayant droit car il bénéficie actuellement d'une prestation").

    -   **Scénario Alternatif A4 : Limite d'ayants droit atteinte (Ajout)**

        -   Applicable au sous-scénario A (étape 9a). Le nombre total d'ayants droit dépasse la limite du contrat.
        -   ... (Jusqu'à l'étape de vérification des règles métier)
        -   10.a. Le système constate que l'ajout dépasserait la limite.
        -   11.a. Le système affiche un message d'erreur indiquant que l'ajout n'est pas possible car la limite est atteinte. Le nouvel ayant droit n'est pas créé.

    -   **Scénario d'Exception E1 : Erreur système lors de l'opération (Ajout, Modif ou Suppression)**
        -   Applicable aux sous-scénarios A, M, S. Une erreur technique se produit lors de l'enregistrement/modification/suppression.
        -   ... (Jusqu'à l'étape de communication avec la base de données)
        -   X.e. Une erreur technique imprévue se produit.
        -   Y.e. Le système enregistre l'erreur. Affiche un message d'erreur générique au Mutualiste. L'opération n'est pas finalisée.

-   **Points à considérer pour la suite :**
    -   Quelles informations spécifiques sont requises pour chaque type d'ayant droit (enfants, conjoint, etc.) ?
    -   Le lien de parenté a-t-il un impact sur les informations demandées ou l'éligibilité ?
    -   Y a-t-il des documents justificatifs à joindre (ex: acte de naissance, certificat de mariage) ? Si oui, comment sont-ils gérés (autre(s) UC(s) de gestion de documents) ?
    -   Faut-il une validation par l'admin après qu'un mutualiste a géré ses ayants droit ? (Cela impliquerait un autre UC côté Admin "Valider les ayants droit d'un mutualiste" et un workflow de notification).

---

**UC 11 - Visualiser la liste de ses ayants droit**

-   **Module :** 3 - Gestion des Ayants Droit
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de consulter la liste des personnes rattachées à son adhésion en tant qu'ayants droit, afin de vérifier les informations les concernant et de connaître qui est couvert.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le mutualiste a accès à la section de son espace personnel où cette liste est affichée (ex: sur le tableau de bord ou une page dédiée).

-   **Postconditions :**

    -   Le mutualiste a pu visualiser les informations de ses ayants droit. Aucune modification des données du système n'est effectuée par ce cas d'utilisation.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue vers la zone ou la section où la liste de ses ayants droit est affichée (cela peut être directement sur le tableau de bord (UC 52) ou dans un sous-menu "Mes Ayants Droit").
    3.  Le système interroge la base de données pour récupérer tous les ayants droit associés au compte du Mutualiste authentifié.
    4.  Le système affiche la liste des ayants droit sous forme tabulaire ou listée. Chaque élément de la liste inclut les informations clés pour l'identification (ex: Nom, Prénom, Date de naissance, Lien de parenté, et potentiellement le statut d'éligibilité ou de validation).
    5.  Le Mutualiste consulte la liste affichée à l'écran.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucun ayant droit enregistré pour ce mutualiste**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucun ayant droit rattaché au Mutualiste principal.
        -   5.a. Le système affiche un message indiquant "Vous n'avez pas encore d'ayants droit enregistrés" ou présente une liste vide avec cette indication.
        -   6.a. Le Mutualiste prend connaissance de cette information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique se produit lors de la tentative de récupération des informations des ayants droit depuis la base de données.
        -   5.e. Le système enregistre l'erreur technique dans ses logs.
        -   6.e. Le système affiche un message d'erreur au Mutualiste indiquant que la liste de ses ayants droit n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles informations exactes (colonnes) sont présentées pour chaque ayant droit dans cette vue ?
    -   Est-ce une simple liste ou est-il possible de cliquer sur un ayant droit pour voir plus de détails (ce qui impliquerait un cas d'utilisation de consultation détaillée, peut-être une partie du cas de gestion UC 10 ou un nouveau UC de lecture seule) ?
    -   Le statut de validation ou d'éligibilité de chaque ayant droit est-il clairement indiqué dans la liste ?

---

### Module 4: Gestion de la Carte Dématématérialisée Adhérent

**UC 12 - Afficher sa carte dématérialisée**

-   **Module :** 4 - Gestion de la Carte Dématématérialisée Adhérent
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de visualiser une version numérique de sa carte d'adhérent directement sur l'interface de son espace personnel (application mobile ou site web). Cette carte sert de preuve d'adhésion et peut être utilisée pour accéder à certains services.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le système dispose des informations nécessaires et a généré la carte dématérialisée pour ce mutualiste.
    -   Le statut actuel du mutualiste lui donne droit à l'accès à sa carte dématérialisée (ex: statut "Actif").

-   **Postconditions :**

    -   Le mutualiste a consulté visuellement sa carte dématérialisée à l'écran.
    -   Aucune donnée du système n'est modifiée par cette consultation.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue dans le menu ou sur le tableau de bord vers la section dédiée à la carte (ex: "Ma Carte", "Carte Adhérent Dématérialisée").
    3.  Le système vérifie que le statut du Mutualiste lui permet d'accéder à sa carte dématérialisée.
    4.  Le système récupère les informations nécessaires associées au Mutualiste (Nom, Prénom, Numéro Adhérent, Date de validité, etc.) et potentiellement un code QR ou code-barres unique.
    5.  Le système génère et affiche l'image ou la représentation graphique de la carte dématérialisée à l'écran du Mutualiste.
    6.  Le Mutualiste consulte les informations affichées sur sa carte dématérialisée.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Mutualiste non éligible à la carte dématérialisée**

        -   ... (Étapes 1 à 2 du scénario principal)
        -   3.a. Le système vérifie le statut du Mutualiste et constate qu'il n'a pas droit à la carte dématérialisée (ex: statut "En attente de validation", "Suspendu", "Archivé").
        -   4.a. Le système affiche un message informant le Mutualiste que sa carte n'est pas disponible pour le moment et en explique la raison si possible (ex: "Votre adhésion n'est pas encore validée", "Votre compte est suspendu").
        -   5.a. Le système ne procède pas à l'affichage de la carte.

    -   **Scénario Alternatif A2 : Carte dématérialisée non générée dans le système**

        -   ... (Étapes 1 à 3 du scénario principal, en supposant que le statut est éligible)
        -   4.a. Le système constate que la carte dématérialisée pour ce Mutualiste n'a pas encore été créée dans le système.
        -   5.a. Le système affiche un message informant le Mutualiste que sa carte est en cours de préparation ou qu'elle sera disponible prochainement.
        -   6.a. Le système ne procède pas à l'affichage.

    -   **Scénario d'Exception E1 : Erreur système lors de l'affichage de la carte**
        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Une erreur technique imprévue se produit lors de la récupération des données ou de la génération de l'affichage de la carte.
        -   6.e. Le système enregistre l'erreur technique dans ses logs.
        -   7.e. Le système affiche un message d'erreur générique au Mutualiste indiquant que la carte n'a pas pu être affichée pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles informations essentielles (Nom, Prénom, Numéro Adhérent, Date de validité, etc.) doivent obligatoirement figurer sur la carte ?
    -   La carte doit-elle inclure une photo ?
    -   Un code QR ou code-barres est-il nécessaire pour la scanner lors d'un accès ou d'une vérification ?
    -   Le Mutualiste doit-il pouvoir télécharger la carte au format PDF ou image ? (Ce serait un cas d'utilisation distinct).
    -   Comment la carte est-elle générée initialement ? Est-ce manuel par l'admin ou automatique lors de la validation (UC 5) ?

---

**UC 13 - Afficher la carte dématérialisée d'un ayant droit**

-   **Module :** 4 - Gestion de la Carte Dématérialisée Adhérent
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste principal de visualiser la version numérique de la carte d'adhérent pour l'un des ayants droit qui lui sont rattachés, afin de faciliter l'accès de ses ayants droit aux services nécessitant une preuve d'adhésion.

-   **Préconditions :**

    -   Le mutualiste principal est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le mutualiste principal dispose d'au moins un ayant droit enregistré et actif dans le système.
    -   Le système a généré la carte dématérialisée pour l'ayant droit sélectionné.
    -   Le statut du mutualiste principal et de l'ayant droit sélectionné permettent l'accès et la visualisation de la carte.

-   **Postconditions :**

    -   Le mutualiste principal a pu visualiser la carte dématérialisée de l'ayant droit sélectionné à l'écran.
    -   Aucune donnée du système n'est modifiée par cette action de consultation.

-   **Scénario principal :**

    1.  Le Mutualiste principal se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue vers la section de gestion des ayants droit (UC 10 / UC 11) ou une section dédiée à la visualisation des cartes des ayants droit.
    3.  Le système affiche la liste des ayants droit rattachés au Mutualiste principal (UC 11 implicite).
    4.  Le Mutualiste sélectionne l'ayant droit dont il souhaite afficher la carte dématérialisée (ex: clique sur le nom de l'ayant droit, ou sur une icône "Carte" associée).
    5.  Le système vérifie le statut du Mutualiste principal et le statut de l'ayant droit sélectionné pour confirmer leur éligibilité à cette visualisation.
    6.  Le système récupère les informations nécessaires pour générer ou afficher la carte dématérialisée de l'ayant droit sélectionné (ex: Nom/Prénom de l'ayant droit, lien vers l'adhérent principal, numéro d'adhérent principal, date de validité de l'adhésion principale, Code QR/Barres spécifique à l'ayant droit si applicable).
    7.  Le système génère et affiche l'image ou la représentation graphique de la carte dématérialisée de l'ayant droit à l'écran du Mutualiste principal.
    8.  Le Mutualiste principal consulte la carte de l'ayant droit.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Mutualiste principal n'a pas d'ayants droit enregistrés**

        -   ... (Étapes 1 à 2 du scénario principal)
        -   3.a. Le système affiche une liste vide des ayants droit (comme dans UC 11, Alt A1). Le Mutualiste ne peut pas sélectionner d'ayant droit. L'opération s'arrête.

    -   **Scénario Alternatif A2 : Ayant droit sélectionné introuvable ou non rattaché**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.a. Le système ne trouve pas l'ayant droit sélectionné ou constate qu'il n'est plus rattaché à ce mutualiste principal.
        -   6.a. Le système affiche un message d'erreur indiquant que l'ayant droit n'a pas été trouvé ou que l'accès n'est pas possible. L'opération s'arrête.

    -   **Scénario Alternatif A3 : Mutualiste principal ou Ayant droit non éligible à la carte**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. Le système vérifie les statuts du Mutualiste principal ou de l'ayant droit et constate qu'ils ne sont pas éligibles à l'affichage de la carte (ex: Adhésion principale suspendue, Ayant droit pas encore validé).
        -   7.a. Le système affiche un message expliquant pourquoi la carte de cet ayant droit n'est pas accessible (ex: "Votre adhésion principale n'est pas active", "Cet ayant droit n'est pas encore validé").
        -   8.a. Le système ne procède pas à l'affichage de la carte.

    -   **Scénario Alternatif A4 : Carte dématérialisée de l'ayant droit non générée**

        -   ... (Étapes 1 à 6 du scénario principal, en supposant l'éligibilité)
        -   7.a. Le système constate que la carte dématérialisée pour cet ayant droit spécifique n'a pas encore été générée.
        -   8.a. Le système affiche un message informant que la carte de l'ayant droit est en cours de préparation.
        -   9.a. Le système ne procède pas à l'affichage.

    -   **Scénario d'Exception E1 : Erreur système lors de l'affichage de la carte de l'ayant droit**
        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.e. Une erreur technique imprévue se produit lors de la récupération des données ou de la génération de l'affichage de la carte de l'ayant droit.
        -   8.e. Le système enregistre l'erreur technique dans ses logs.
        -   9.e. Le système affiche un message d'erreur générique au Mutualiste principal.

-   **Points à considérer pour la suite :**
    -   Quelles informations spécifiques (Nom/Prénom ayant droit, lien avec le principal, etc.) doivent apparaître sur la carte de l'ayant droit ?
    -   Le lien avec l'adhésion principale doit-il être très visible sur la carte de l'ayant droit ?
    -   Un code QR/barres unique est-il nécessaire pour chaque ayant droit ?
    -   Le Mutualiste principal peut-il télécharger la carte de l'ayant droit ? (Ce serait un cas d'utilisation distinct).
    -   Comment et quand les cartes des ayants droit sont-elles générées (ex: automatiquement après validation de l'ayant droit par l'admin ?).

---

### Module 5: Gestion des Cotisations & Paiements

**UC 14 - Payer ses cotisations**

-   **Module :** 5 - Gestion des Cotisations & Paiements
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de s'acquitter de ses obligations de paiement de cotisations (périodiques ou anticipées) directement depuis son espace personnel, en utilisant l'une des méthodes de paiement électronique proposées (Carte Bancaire, Orange Money, Mobile Money).

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le mutualiste a accès à la section de paiement des cotisations.
    -   Le mutualiste dispose d'un moyen de paiement valide (Carte Bancaire, compte Orange Money, compte Mobile Money) avec des fonds suffisants.
    -   Les passerelles de paiement configurées (CB, Orange Money, Mobile Money) sont opérationnelles et accessibles par le système.

-   **Postconditions :**

    -   Une tentative de transaction de paiement est initiée.
    -   Une transaction de paiement est enregistrée dans le système avec un statut initial (ex: En attente, Initiée).
    -   Si le paiement réussit : Le statut de la/des cotisation(s) concernée(s) est mis à jour à "Payée", le statut général du mutualiste lié aux impayés est ajusté, la transaction de paiement est marquée "Succès", et le mutualiste reçoit une confirmation.
    -   Si le paiement échoue/est annulé : La transaction de paiement est marquée "Échec" ou "Annulé", et le mutualiste est informé de l'échec.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue vers la section "Mes Cotisations", "Paiements", ou une zone dédiée aux cotisations impayées/dues.
    3.  Le système affiche les informations sur les cotisations dues (montant, période(s)) et les options de paiement disponibles (CB, Orange Money, Mobile Money). Le Mutualiste peut potentiellement sélectionner le montant à payer (ex: cotisation du mois en cours, plusieurs mois, montant libre).
    4.  Le Mutualiste choisit le montant à payer et sélectionne la méthode de paiement désirée parmi les options affichées.
    5.  Le système enregistre une transaction de paiement interne avec le statut "Initiée" ou "En attente".
    6.  Le système communique avec la passerelle de paiement correspondante pour initier la transaction :
        -   **Si Méthode = Carte Bancaire (CB) :**
            7a. Le système redirige le Mutualiste vers la page sécurisée de la passerelle CB ou intègre un formulaire sécurisé.
            8a. Le Mutualiste saisit les informations de sa carte (numéro, date d'expiration, cryptogramme).
            9a. Le Mutualiste confirme le paiement sur l'interface de la passerelle.
            10a. La passerelle de paiement communique avec la banque émettrice pour autorisation (incluant 3D Secure si applicable).
            11a. La passerelle notifie le système du résultat de l'autorisation (Succès ou Échec/Refus).
        -   **Si Méthode = Orange Money ou Mobile Money (MOMO) :**
            7b. Le système invite le Mutualiste à confirmer son numéro de téléphone lié au compte OM/MOMO ou à en saisir un autre si le système le permet.
            8b. Le Mutualiste confirme/saisit le numéro de téléphone.
            9b. Le système envoie une requête à la passerelle OM/MOMO pour initier la transaction sur le compte mobile lié.
            10b. Le Mutualiste reçoit une notification (USSD, SMS, pop-up sur son téléphone) lui demandant de confirmer le paiement en saisissant son code PIN Mobile Money.
            11b. Le Mutualiste saisit son code PIN sur son téléphone pour confirmer.
            12b. La passerelle OM/MOMO traite la transaction sur le compte mobile et notifie le système du résultat (Succès ou Échec/Refus, et éventuellement un motif).
    7.  (Après réception de la notification de la passerelle) Le système traite le résultat de la transaction :
        -   **Si Résultat = Succès :**
            8s. Le système met à jour le statut de la transaction de paiement à "Succès".
            9s. Le système marque la/les cotisation(s) correspondante(s) comme "Payée(s)".
            10s. Le système ajuste le statut du Mutualiste si ce paiement résout une situation d'impayés bloquante.
            11s. Le système génère et affiche un reçu ou une confirmation de paiement dans l'espace du Mutualiste.
            12s. Le système envoie une confirmation de paiement (email, SMS) au Mutualiste.
            13s. Le système enregistre l'historique complet de la transaction et des mises à jour des cotisations.
            14s. Le système redirige le Mutualiste vers la page de ses cotisations ou son tableau de bord.
        -   **Si Résultat = Échec/Refus :**
            8e. Le système met à jour le statut de la transaction de paiement à "Échec" ou "Refusé".
            9e. Le système affiche un message d'erreur au Mutualiste, en précisant le motif si fourni par la passerelle (ex: "Paiement refusé : fonds insuffisants", "Transaction annulée", "Carte expirée").
            10e. Le Mutualiste reste sur la page de paiement ou est redirigé vers une page d'échec, l'invitant à réessayer ou à utiliser une autre méthode.
            11e. Le système enregistre l'historique de la transaction échouée.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de la transaction par le Mutualiste (avant validation finale ou côté passerelle)**

        -   Applicable aux sous-scénarios CB et OM/MOMO.
        -   ... (Jusqu'à l'étape de confirmation finale ou interaction passerelle)
        -   X.a. Le Mutualiste quitte l'interface ou clique sur "Annuler" sur la page de la mutuelle ou de la passerelle.
        -   Y.a. La passerelle (si l'interaction l'a atteinte) notifie le système de l'annulation.
        -   Z.a. Le système marque la transaction comme "Annulée" et informe le Mutualiste que le paiement a été annulé.

    -   **Scénario Alternatif A2 : Échec de la transaction (hors refus bancaire/opérateur) - Erreur de format, délai dépassé...**

        -   Applicable aux sous-scénarios CB et OM/MOMO.
        -   ... (Interaction avec passerelle)
        -   X.a. La passerelle retourne un code d'erreur qui n'est pas un refus direct (ex: données invalides envoyées par le système, timeout, problème technique temporaire de la passerelle).
        -   Y.a. Le système marque la transaction comme "Échec" ou "Erreur Passerelle" et affiche un message générique au Mutualiste l'invitant à réessayer.

    -   **Scénario d'Exception E1 : Problème de communication ou indisponibilité de la passerelle**

        -   Applicable aux étapes 6 et 7 du scénario principal.
        -   ... (Jusqu'à l'étape d'interaction avec la passerelle)
        -   X.e. Le système ne parvient pas à établir la communication avec la passerelle ou la requête échoue en raison d'une indisponibilité.
        -   Y.e. Le système enregistre l'erreur technique.
        -   Z.e. Le système affiche un message d'erreur au Mutualiste indiquant qu'un problème technique empêche le paiement et de réessayer plus tard. La transaction reste en statut "Initiée" ou "Erreur Communication".

    -   **Scénario d'Exception E2 : Erreur système _après_ confirmation de succès de la passerelle**

        -   Applicable après l'étape 7 du scénario principal, si le résultat est "Succès".
        -   ... (Jusqu'à l'étape 8s)
        -   9.e. Une erreur technique interne se produit pendant la mise à jour du statut de la cotisation ou du mutualiste.
        -   10.e. Le système enregistre l'erreur technique et la transaction est marquée comme "Succès", mais la cotisation n'est pas marquée comme payée. Nécessite une réconciliation manuelle ou automatique ultérieure. Le Mutualiste pourrait voir un message de succès suivi d'un état des cotisations incorrect.

    -   **Points à considérer pour la suite :**
        -   Comment le montant à payer est-il déterminé (fixe, calculé, choisi par l'utilisateur) ? Peut-on payer pour des périodes antérieures ?
        -   Comment les frais de transaction (potentiellement appliqués par les passerelles) sont-ils gérés et affichés au Mutualiste ?
        -   Le système gère-t-il les paiements partiels ?
        -   Un système de rappels automatiques pour les cotisations dues est-il prévu (se lie à ce module et potentiellement à la messagerie interne) ?
        -   Comment sont gérés les remboursements (ex: trop perçu, annulation)? (Nécessiterait un ou plusieurs autres UC(s)).

---

**UC 15 - Visualiser l'historique de ses cotisations**

-   **Module :** 5 - Gestion des Cotisations & Paiements
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de consulter un récapitulatif de ses cotisations passées et de leur statut de paiement. Cela lui permet de suivre sa conformité avec ses obligations d'adhérent.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le mutualiste a accès à la section de l'historique des cotisations.
    -   Le système a enregistré au moins une cotisation pour ce mutualiste (historique).

-   **Postconditions :**

    -   Le mutualiste a consulté les informations relatives à ses cotisations passées. Aucune modification de données n'est effectuée.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue vers la section "Mes Cotisations", "Historique des Paiements", ou toute autre zone affichant l'historique financier lié aux cotisations.
    3.  Le système interroge la base de données pour récupérer l'ensemble des enregistrements de cotisations et des paiements associés pour le Mutualiste authentifié.
    4.  Le système affiche la liste des cotisations. Pour chaque cotisation, des informations clés sont présentées, potentiellement sous forme de tableau (ex: Période concernée (Mois/Année), Montant dû, Montant payé, Date d'échéance, Date(s) de paiement(s) effectif(s), Méthode de paiement utilisée (si applicable), Statut de la cotisation (Payée, Impayée, Partielle, Annulée, etc.)). La liste est généralement triée chronologiquement.
    5.  Le Mutualiste consulte l'historique affiché.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucun historique de cotisations disponible**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucune cotisation enregistrée ou associée à ce Mutualiste (cas d'un nouvel adhérent sans historique de facturation/paiement).
        -   5.a. Le système affiche un message indiquant "Aucun historique de cotisations disponible pour le moment" ou présente une liste vide avec cette indication.
        -   6.a. Le Mutualiste prend connaissance de cette information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération de l'historique**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données de l'historique des cotisations depuis la base de données.
        -   5.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. Le système affiche un message d'erreur générique au Mutualiste l'informant que l'historique n'a pas pu être chargé pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles sont les colonnes exactes affichées dans cet historique ?
    -   Existe-t-il des options de filtrage (par année, par statut de paiement, etc.) ?
    -   Le Mutualiste peut-il cliquer sur une ligne pour voir les détails d'une transaction de paiement spécifique (potentiellement lié à UC 14) ?
    -   Le Mutualiste peut-il télécharger un reçu ou un relevé de compte depuis cet historique (ce serait un cas d'utilisation distinct) ?
    -   Y a-t-il une pagination si l'historique est très long ?

---

### Module 6: Gestion et Consultation des Prêts

**UC 16 - Créer un prêt pour un mutualiste**

-   **Module :** 6 - Gestion et Consultation des Prêts
-   **Acteur principal :** admin

-   **Description :** Permet à un admin autorisé d'enregistrer un nouveau prêt accordé à un mutualiste, en définissant les conditions financières et les modalités de remboursement.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour créer et gérer les prêts.
    -   Le mutualiste bénéficiaire du prêt existe dans le système et a un statut éligible pour contracter un prêt selon les règles de la mutuelle.
    -   L'admin dispose de toutes les informations et conditions du prêt à enregistrer (montant, taux, durée, accord formel du prêt si un processus d'approbation existe en amont).
    -   Les règles et paramètres de calcul des prêts (taux d'intérêt, périodicité, méthode d'amortissement) sont configurés dans le système.

-   **Postconditions :**

    -   Un nouvel enregistrement de prêt est créé dans la base de données, associé au mutualiste bénéficiaire, avec les conditions définies.
    -   L'échéancier de remboursement complet du prêt est généré et lié au prêt.
    -   Le statut initial du prêt (ex: "Accordé", "Actif", "En cours de déblocage") est enregistré.
    -   L'encours initial du prêt est enregistré (égal au montant principal).
    -   Un enregistrement d'audit est créé pour la création du prêt (qui, quand, quel prêt, pour qui).
    -   (Optionnel) Une notification est envoyée au mutualiste l'informant de la création de son prêt.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des prêts.
    2.  L'admin clique sur l'option ou le bouton "Créer un nouveau prêt".
    3.  Le système affiche un formulaire de saisie pour les informations du nouveau prêt.
    4.  L'admin utilise la fonction de recherche ou de sélection pour trouver et associer le mutualiste bénéficiaire du prêt.
    5.  Le système peut afficher un résumé de l'éligibilité du mutualiste ou de son historique de prêts pour aider l'admin.
    6.  L'admin saisit les détails du prêt :
        -   Montant principal du prêt accordé.
        -   Type de prêt (si applicable : ex: prêt personnel, prêt immobilier, prêt d'urgence).
        -   Date de début du prêt (date de déblocage ou début de l'amortissement).
        -   Durée du prêt (en nombre d'échéances ou en mois/années).
        -   Périodicité des remboursements (ex: mensuelle, trimestrielle).
        -   Taux d'intérêt appliqué (fixe ou potentiellement variable).
        -   (Éventuellement) Frais de dossier, assurance, ou autres coûts initiaux.
        -   (Éventuellement) Informations supplémentaires (objectif du prêt, garants, documents associés).
    7.  L'admin vérifie les informations saisies.
    8.  L'admin clique sur le bouton "Enregistrer" ou "Créer le prêt".
    9.  Le système valide les données saisies par rapport aux règles métier et formats attendus (ex: montant positif, taux dans la fourchette autorisée, mutualiste existant et éligible).
    10. Si les validations réussissent, le système utilise le montant principal, le taux, la durée et la périodicité pour calculer et générer automatiquement le tableau d'amortissement (échéancier) du prêt.
    11. Le système crée un nouvel enregistrement dans la base de données pour le prêt, le lie au mutualiste, y associe l'échéancier généré, et définit son statut initial.
    12. Le système enregistre l'historique de la création du prêt.
    13. Le système affiche un message de confirmation à l'admin (ex: "Prêt créé avec succès. Échéancier généré.").
    14. (Optionnel) Le système génère et envoie une notification au mutualiste (via email, SMS, ou messagerie interne) pour l'informer de l'enregistrement de son prêt et lui fournir un accès à l'échéancier (UC 20).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation par l'admin**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. L'admin décide d'annuler la création.
        -   9.a. L'admin clique sur le bouton "Annuler".
        -   10.a. Le système abandonne l'opération. Aucune donnée n'est enregistrée.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées lors de la validation**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système valide les données saisies et détecte des erreurs (ex: champ obligatoire vide, date invalide, montant négatif).
        -   10.a. Le système affiche des messages d'erreur à côté des champs concernés. L'admin reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A3 : Mutualiste sélectionné n'est pas éligible (vérification métier)**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système effectue une vérification d'éligibilité plus approfondie et constate que le mutualiste ne peut pas contracter ce prêt malgré son statut général (ex: dépassement d'un plafond d'endettement global, antécédents récents).
        -   10.a. Le système affiche un message d'erreur à l'admin expliquant la raison du refus métier. Le processus de création est arrêté pour ce mutualiste.

    -   **Scénario Alternatif A4 : Paramètres du prêt non conformes aux règles métier (taux, durée, etc.)**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système valide les paramètres du prêt (montant, taux, durée) et constate qu'ils dépassent les limites configurées ou contreviennent à une règle métier.
        -   10.a. Le système affiche un message d'erreur indiquant la violation (ex: "Le taux d'intérêt appliqué est supérieur au maximum autorisé"). L'admin doit corriger les paramètres.

    -   **Scénario d'Exception E1 : Mutualiste introuvable lors de la sélection**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Le mutualiste recherché ou sélectionné n'est pas trouvé dans le système.
        -   6.e. Le système affiche un message d'erreur à l'admin. L'opération de création ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement du prêt ou de l'échéancier**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde du prêt ou du calcul/enregistrement de l'échéancier.
        -   12.e. Le système enregistre l'erreur technique.
        -   13.e. Le système affiche un message d'erreur générique à l'admin indiquant que la création a échoué. L'opération n'est pas finalisée.

    -   **Scénario d'Exception E3 : Échec de l'envoi de la notification au mutualiste**
        -   ... (Étapes 1 à 13 du scénario principal)
        -   14.e. Le système tente d'envoyer la notification au mutualiste mais l'envoi échoue.
        -   15.e. Le système enregistre l'échec et peut alerter l'admin (ex: "Prêt créé, mais notification non envoyée").

-   **Points à considérer pour la suite :**
    -   Comment les remboursements sont-ils enregistrés et suivis par rapport à l'échéancier (UC spécifique de gestion des paiements de prêt) ?
    -   Y a-t-il des pénalités ou des frais en cas de retard de paiement, et comment sont-ils calculés et appliqués ?
    -   Le système gère-t-il les remboursements anticipés (partiels ou totaux) ?
    -   L'échéancier généré peut-il être visualisé et/ou modifié par l'Admin après création ?
    -   Y a-t-il un processus de déblocage des fonds lié à la création du prêt ?

---

**UC 17 - Visualiser l'encours d'un prêt**

-   **Module :** 6 - Gestion et Consultation des Prêts
-   **Acteur principal :** admin

-   **Description :** Permet à un admin de consulter le solde restant dû (l'encours) d'un prêt spécifique accordé à un mutualiste, ainsi que des informations clés sur l'état d'avancement de son remboursement.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour consulter les informations des prêts.
    -   Le prêt concerné existe dans le système et est associé à un mutualiste.
    -   L'admin a identifié le prêt dont il souhaite consulter l'encours via une liste ou une recherche.

-   **Postconditions :**

    -   L'admin a pu consulter les informations de l'encours et le résumé de l'état du prêt. Aucune modification de données n'est effectuée par ce cas d'utilisation.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des prêts.
    2.  L'admin recherche ou sélectionne le prêt spécifique dont il souhaite visualiser l'encours (par exemple, en filtrant les prêts par mutualiste, par statut, ou en cherchant une référence de prêt).
    3.  Le système récupère les informations détaillées du prêt sélectionné (montant initial, conditions, historique des paiements enregistrés, échéancier).
    4.  Le système calcule l'encours restant dû (généralement le capital restant à rembourser).
    5.  Le système affiche à l'écran une vue résumée du prêt, incluant au minimum :
        -   L'encours restant dû.
        -   Le montant initial du prêt.
        -   Le capital déjà remboursé.
        -   Le total des intérêts et frais payés.
        -   Le montant total déjà remboursé (capital + intérêts + frais).
        -   Le statut actuel du prêt (En cours, Soldé, En retard, Suspendu...).
        -   La date de la prochaine échéance et son montant (capital, intérêts, frais).
        -   Le nom du mutualiste bénéficiaire.
    6.  L'admin consulte les informations affichées pour le prêt.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Prêt introuvable ou non accessible**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système ne trouve pas le prêt sélectionné/recherché, ou l'admin n'a pas les droits d'accès à ce prêt spécifique.
        -   5.a. Le système affiche un message d'erreur à l'admin indiquant que le prêt n'a pas été trouvé ou n'est pas accessible.
        -   6.a. L'opération de visualisation ne peut pas se poursuivre.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération ou du calcul des données**
        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données du prêt, du calcul de l'encours, ou de la préparation de l'affichage.
        -   6.e. Le système enregistre l'erreur technique dans ses journaux.
        -   7.e. Le système affiche un message d'erreur générique à l'admin l'informant que les informations du prêt n'ont pas pu être chargées pour le moment.

-   **Points à considérer pour la suite :**
    -   L'encours inclut-il seulement le capital, ou aussi les intérêts courus non encore échus ou les pénalités ?
    -   La vue de l'encours permet-elle d'accéder directement à l'échéancier détaillé (UC spécifique de consultation d'échéancier pour Admin) ou à l'historique des paiements du prêt ?
    -   La liste des prêts (étape 2) permet-elle des tris, filtres (ex: prêts en retard, prêts soldés) ou recherches avancées ?

---

**UC 18 - Relancer un mutualiste**

-   **Module :** 6 - Gestion et Consultation des Prêts
-   **Acteur principal :** admin

-   **Description :** Permet à un admin d'envoyer manuellement un message de rappel ou d'avertissement à un mutualiste, généralement en cas de retard dans le remboursement d'une échéance de prêt. La communication peut se faire via la messagerie interne du système ou par SMS.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour envoyer des communications et des relances.
    -   Le mutualiste à relancer existe dans le système et est identifiable.
    -   Il existe une raison justifiant la relance (ex: une ou plusieurs échéances de prêt en retard identifiées).
    -   Les coordonnées du mutualiste pour la méthode de communication choisie (numéro de téléphone valide pour SMS, compte actif pour messagerie interne) sont disponibles.
    -   Les services d'envoi de messages (passerelle SMS, système de messagerie interne) sont fonctionnels.

-   **Postconditions :**

    -   Un message de relance est envoyé au mutualiste via la méthode sélectionnée (ou mis en file d'attente pour envoi).
    -   Un enregistrement de la relance envoyée est créé et lié au dossier du mutualiste et au prêt concerné.
    -   Le système enregistre l'historique de l'envoi de la relance.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des prêts, une liste des échéances en retard, ou le dossier d'un mutualiste spécifique.
    2.  L'admin identifie le mutualiste ou le prêt nécessitant une relance (potentiellement en consultant une liste de retards générée par le système).
    3.  L'admin sélectionne le mutualiste/prêt et choisit l'action "Envoyer une relance" ou similaire.
    4.  Le système affiche une interface permettant de composer la relance, proposant les méthodes d'envoi disponibles (Messagerie Interne, SMS) et potentiellement une liste de modèles de messages prédéfinis pour les relances.
    5.  L'admin choisit la méthode de communication (Messagerie Interne ou SMS).
    6.  L'admin sélectionne un modèle de message ou rédige le contenu du message. Le système peut permettre l'insertion de variables (ex: nom du mutualiste, montant de l'échéance en retard, date).
    7.  L'admin vérifie le contenu et le destinataire(s).
    8.  L'admin clique sur le bouton "Envoyer".
    9.  Le système vérifie la validité des coordonnées de contact pour la méthode choisie et que le service d'envoi est disponible.
    10. Le système envoie le message via le service d'envoi (API de la passerelle SMS, fonction d'envoi de message interne).
    11. Le système enregistre un historique de cette relance envoyée (qui a envoyé, quand, à qui, contenu du message, méthode d'envoi, statut de l'envoi si disponible).
    12. Le système affiche un message de confirmation à l'admin indiquant que la relance a été envoyée ou soumise pour envoi.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'envoi par l'admin**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. L'admin décide d'annuler l'envoi de la relance.
        -   9.a. L'admin clique sur "Annuler" ou quitte l'interface d'envoi.
        -   10.a. Le système abandonne l'opération.

    -   **Scénario Alternatif A2 : Absence de situation justifiant une relance (règle métier)**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. L'admin sélectionne l'option de relance pour un mutualiste qui n'a pas de retards selon les critères du système (ex: toutes les échéances sont à jour).
        -   5.a. Le système affiche un message d'avertissement ou bloque l'envoi, indiquant que ce mutualiste n'a pas de retards justifiant une relance automatique (mais peut permettre une relance manuelle générique si les droits le permettent). Si l'UC est strictement pour impayés, l'opération s'arrête.

    -   **Scénario Alternatif A3 : Coordonnées de contact manquantes ou invalides pour la méthode choisie**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système vérifie les coordonnées et constate qu'elles sont absentes ou invalides pour la méthode sélectionnée (ex: pas de numéro de téléphone valide pour un envoi par SMS).
        -   10.a. Le système affiche un message d'erreur à l'admin informant de l'échec de la vérification des coordonnées et que la relance ne peut être envoyée par ce canal. L'admin peut être invité à mettre à jour le profil ou à choisir une autre méthode.

    -   **Scénario d'Exception E1 : Mutualiste ou Prêt introuvable**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Le mutualiste ou le prêt identifié n'est pas trouvé ou n'existe plus dans le système.
        -   5.e. Le système affiche un message d'erreur. L'opération de relance ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur technique ou indisponibilité du service d'envoi (SMS ou Messagerie Interne)**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.e. Le système tente d'envoyer le message via la passerelle SMS ou le système de messagerie interne, mais une erreur technique se produit (ex: API hors service, erreur interne du service).
        -   11.e. Le système enregistre l'échec technique de l'envoi.
        -   12.e. Le système affiche un message d'erreur à l'admin indiquant que l'envoi a échoué techniquement et de réessayer ou contacter le support. La relance n'est pas reçue par le mutualiste.

    -   **Scénario d'Exception E3 : Erreur système lors de l'enregistrement de l'historique de relance**
        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique se produit lors de la tentative d'enregistrement de l'historique de la relance.
        -   13.e. Le système enregistre l'erreur technique.
        -   14.e. La relance a potentiellement été envoyée avec succès, mais l'historique dans le système n'est pas enregistré correctement. Le système affiche un message d'erreur. Nécessite une vérification manuelle.

-   **Points à considérer pour la suite :**
    -   Les relances sont-elles uniquement manuelles (via cet UC) ou existe-t-il un système de relances automatiques basé sur des règles (ex: X jours de retard) ?
    -   Existe-t-il différents modèles de messages personnalisables par l'Admin ?
    -   L'historique des relances envoyées est-il visible sur le dossier du mutualiste ou sur la vue du prêt ? (Ce serait un UC de consultation, potentiellement intégré à UC 3 ou UC 19).
    -   La communication par messagerie interne permet-elle au mutualiste de répondre ? (Liaison avec UC 40).

---

**UC 19 - Visualiser l'encours de son prêt**

-   **Module :** 6 - Gestion et Consultation des Prêts
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste d'accéder et de consulter le solde restant à rembourser (l'encours) pour chacun de ses prêts en cours via son espace personnel sécurisé. Cela lui permet de suivre sa situation financière et l'avancement de ses remboursements.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le mutualiste dispose d'au moins un prêt en cours ou en cours de remboursement enregistré dans le système.
    -   Le mutualiste a accès à la section dédiée à la consultation de ses prêts.

-   **Postconditions :**

    -   Le mutualiste a consulté l'encours et les informations clés de son ou ses prêts. Aucune modification de données n'est effectuée par ce cas d'utilisation.
    -   Les informations de l'encours et les résumés des prêts sont affichés à l'écran du mutualiste.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue dans le menu de son espace personnel vers la section "Mes Prêts", "Mon Financement", ou similaire.
    3.  Le système interroge la base de données pour récupérer la liste des prêts enregistrés pour ce Mutualiste qui ne sont pas encore complètement soldés ou archivés.
    4.  Le système affiche la liste des prêts en cours ou récents du Mutualiste. Pour chaque prêt de la liste, des informations de résumé sont généralement présentées (ex: Référence du prêt, Montant initial, Date de début, Statut).
    5.  Le Mutualiste sélectionne un prêt spécifique dans la liste pour en voir les détails complets (ex: clique sur la référence du prêt, ou un bouton "Détails").
    6.  Le système récupère les informations détaillées du prêt sélectionné, y compris l'historique des paiements enregistrés et l'échéancier associé.
    7.  Le système calcule l'encours restant dû (le capital qui reste à rembourser).
    8.  Le système affiche les informations détaillées du prêt sélectionné, incluant au minimum :
        -   L'encours restant dû (solde du capital).
        -   Le montant initial du prêt.
        -   Le capital déjà remboursé.
        -   Le total des intérêts et frais payés à ce jour.
        -   Le montant total déjà remboursé.
        -   Le statut actuel du prêt (En cours, En retard, Soldé...).
        -   La date et le montant de la prochaine échéance.
        -   La date de fin prévue du prêt selon l'échéancier initial.
        -   Le taux d'intérêt.
    9.  Le Mutualiste consulte les informations détaillées de son prêt affichées à l'écran.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucun prêt en cours trouvé pour ce mutualiste**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucun prêt en cours ou non soldé associé à ce Mutualiste.
        -   5.a. Le système affiche un message indiquant "Vous n'avez aucun prêt en cours actuellement" ou présente une liste vide avec cette indication.
        -   6.a. Le Mutualiste prend connaissance de cette information.

    -   **Scénario Alternatif A2 : Prêt sélectionné introuvable ou non accessible après l'affichage de la liste**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. Le système ne parvient pas à trouver ou à charger les détails du prêt spécifique sélectionné (ex: le prêt a été clôturé juste avant, ou il y a une erreur temporaire).
        -   7.a. Le système affiche un message d'erreur indiquant que les détails du prêt n'ont pas pu être chargés. L'affichage peut rester sur la liste des prêts ou revenir à une page générale.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données des prêts**
        -   ... (Étapes 1 à 3 ou Étapes 1 à 6 du scénario principal)
        -   4.e. / 7.e. Une erreur technique imprévue se produit lors de la tentative de récupération de la liste des prêts ou des détails du prêt sélectionné.
        -   5.e. / 8.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. / 9.e. Le système affiche un message d'erreur générique au Mutualiste indiquant que les informations de ses prêts n'ont pas pu être chargées pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles informations sont affichées dans la liste sommaire (étape 4) vs les détails (étape 8) ?
    -   Y a-t-il un lien direct vers l'échéancier détaillé du prêt depuis cette vue (UC 20) ?
    -   Le Mutualiste peut-il voir l'historique des paiements _pour ce prêt spécifique_ (potentiellement un sous-ensemble de l'historique général des paiements)?
    -   Comment les éventuels frais de retard ou pénalités sont-ils affichés et intégrés dans l'encours ?
    -   Le Mutualiste peut-il initier un remboursement anticipé depuis cette vue (ce serait un autre cas d'utilisation) ?

---

**UC 20 - Consulter son échéancier / tableau d'amortissement**

-   **Module :** 6 - Gestion et Consultation des Prêts
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste d'accéder et de visualiser le tableau détaillé des remboursements prévus pour un prêt spécifique, indiquant pour chaque échéance la date prévue, le montant, la répartition entre capital et intérêts, et le capital restant dû.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le mutualiste dispose d'au moins un prêt en cours ou en cours de remboursement avec un échéancier généré dans le système.
    -   Le mutualiste a accès à la section de consultation de ses prêts (UC 19).

-   **Postconditions :**

    -   Le mutualiste a pu consulter le tableau d'amortissement de son prêt. Aucune modification de données n'est effectuée.
    -   L'échéancier est affiché à l'écran du mutualiste.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue vers la section "Mes Prêts" (UC 19) pour voir la liste de ses prêts.
    3.  Le système affiche la liste des prêts en cours ou récents du Mutualiste.
    4.  Le Mutualiste sélectionne le prêt spécifique dont il souhaite consulter l'échéancier (ex: clique sur un bouton "Voir échéancier" associé au prêt, ou accède aux détails du prêt (UC 19, étape 8) et trouve un lien vers l'échéancier).
    5.  Le système récupère les données de l'échéancier calculé et enregistré pour le prêt sélectionné.
    6.  Le système affiche le tableau d'amortissement complet du prêt. Ce tableau présente généralement, ligne par ligne pour chaque échéance :
        -   Le numéro de l'échéance.
        -   La date d'échéance prévue.
        -   Le montant total de l'échéance (incluant capital, intérêts, assurances/frais si applicable).
        -   La part du capital remboursé par cette échéance.
        -   La part des intérêts payée par cette échéance.
        -   Le capital restant dû _après_ paiement de cette échéance.
        -   (Optionnel) Une indication du statut de l'échéance (Payée, Impayée, Prochaine, Future).
        -   (Optionnel) La date de paiement effective si l'échéance a déjà été réglée.
    7.  Le Mutualiste consulte le tableau d'amortissement affiché à l'écran.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucun prêt avec échéancier disponible**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système affiche la liste des prêts (qui peut être vide, ou contenir des prêts sans échéancier actif). Le Mutualiste ne trouve pas de prêt avec un échéancier consultable, ou l'option "Voir échéancier" n'est pas disponible pour ses prêts.
        -   5.a. Le système peut afficher un message indiquant qu'aucun échéancier n'est disponible pour le moment. L'opération s'arrête.

    -   **Scénario Alternatif A2 : Prêt sélectionné introuvable ou échéancier manquant**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.a. Le système ne parvient pas à trouver le prêt spécifique sélectionné, ou l'échéancier associé à ce prêt n'est pas trouvé ou n'est pas accessible.
        -   6.a. Le système affiche un message d'erreur indiquant que l'échéancier n'a pas pu être chargé pour ce prêt. L'affichage peut revenir à la liste des prêts.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données de l'échéancier**
        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données de l'échéancier depuis la base de données.
        -   7.e. Le système enregistre l'erreur technique dans ses journaux.
        -   8.e. Le système affiche un message d'erreur générique au Mutualiste l'informant que le tableau d'amortissement n'a pas pu être chargé pour le moment.

-   **Points à considérer pour la suite :**
    -   L'échéancier est-il affiché sous forme de tableau interactif ou d'une simple image/PDF intégré ?
    -   Le Mutualiste peut-il télécharger l'échéancier au format PDF ou tableur ? (Ce serait un cas d'utilisation distinct).
    -   Comment le tableau d'amortissement gère-t-il les remboursements anticipés qui modifient le capital restant dû et potentiellement les échéances futures ? L'échéancier affiché est-il toujours à jour ?
    -   Y a-t-il une pagination ou des options de navigation si l'échéancier est très long (pour les prêts de longue durée) ?
    -   Le statut de paiement de chaque échéance est-il clairement indiqué ?

---

### Module 7: Gestion et Consultation des Rachats de Prêts

**UC 21 - Créer un rachat de prêt**

-   **Module :** 7 - Gestion et Consultation des Rachats de Prêts
-   **Acteur principal :** admin

-   **Description :** Permet à un admin autorisé d'enregistrer un nouveau rachat de prêt accordé à un mutualiste. Cette opération consiste à créer un prêt émis par la mutuelle dont le montant est destiné à couvrir une dette préexistante du mutualiste envers un tiers (ou parfois la mutuelle elle-même). Le rachat de prêt est ensuite remboursé à la mutuelle selon un échéancier défini.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour créer des rachats de prêts.
    -   Le mutualiste bénéficiaire du rachat de prêt existe dans le système et a un statut éligible pour ce type spécifique de financement.
    -   Les règles d'éligibilité, les types et les paramètres de calcul des rachats de prêts sont configurés dans le système.
    -   L'admin dispose de toutes les informations et conditions du rachat de prêt à enregistrer (montant racheté, taux, durée, etc.).
    -   (Optionnel) L'admin dispose des documents ou preuves liés à la dette rachetée si la procédure l'exige.

-   **Postconditions :**

    -   Un nouvel enregistrement de rachat de prêt est créé dans la base de données, associé au mutualiste bénéficiaire, avec les conditions spécifiées.
    -   Un échéancier de remboursement spécifique à ce rachat de prêt est généré et lié à l'enregistrement.
    -   Le statut initial du rachat de prêt (ex: "Accordé", "Actif", "En cours de déblocage") est enregistré.
    -   L'encours initial du rachat de prêt est enregistré (égal au montant principal).
    -   Un enregistrement d'audit est créé pour la création du rachat de prêt (qui, quand, quel rachat, pour qui).
    -   (Optionnel) Une notification est envoyée au mutualiste l'informant de l'enregistrement du rachat de prêt.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des rachats de prêts (ou la sous-section dédiée dans la gestion des prêts).
    2.  L'admin clique sur l'option ou le bouton "Créer un nouveau rachat de prêt".
    3.  Le système affiche un formulaire de saisie spécifique aux rachats de prêts.
    4.  L'admin utilise la fonction de recherche ou de sélection pour trouver et associer le mutualiste bénéficiaire du rachat de prêt.
    5.  Le système peut afficher des informations d'éligibilité spécifiques aux rachats ou l'historique des rachats précédents de ce mutualiste.
    6.  L'admin saisit les détails du rachat de prêt accordé :
        -   Montant principal du rachat (le montant de la dette externe couverte).
        -   (Optionnel) Référence(s) ou description(s) de la/des dette(s) rachetée(s).
        -   Date de début du rachat (date de déblocage des fonds vers le tiers, ou début de l'amortissement).
        -   Durée du rachat.
        -   Périodicité des remboursements.
        -   Taux d'intérêt appliqué au rachat par la mutuelle.
        -   (Optionnel) Frais de dossier ou autres coûts associés à l'opération de rachat par la mutuelle.
        -   (Optionnel) Possibilité de télécharger la preuve de la dette rachetée ou d'autres documents pertinents.
    7.  L'admin vérifie les informations saisies.
    8.  L'admin clique sur le bouton "Enregistrer" ou "Créer Rachat de Prêt".
    9.  Le système valide les données saisies selon les règles métier spécifiques aux rachats de prêts (ex: montant maximum de rachat, taux/durée conformes, mutualiste éligible).
    10. Si les validations réussissent, le système utilise le montant principal, le taux, la durée et la périodicité pour calculer et générer automatiquement l'échéancier de remboursement pour ce rachat de prêt.
    11. Le système crée un nouvel enregistrement dans la base de données pour le rachat de prêt, le lie au mutualiste, y associe l'échéancier généré, et définit son statut initial.
    12. Le système enregistre l'historique de la création du rachat de prêt.
    13. Le système affiche un message de confirmation à l'admin (ex: "Rachat de prêt créé avec succès. Échéancier généré.").
    14. (Optionnel) Le système génère et envoie une notification au mutualiste pour l'informer de l'enregistrement du rachat de prêt et lui fournir un accès à l'échéancier spécifique (potentiellement via UC 24).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation par l'admin**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. L'admin décide d'annuler la création.
        -   9.a. L'admin clique sur le bouton "Annuler".
        -   10.a. Le système abandonne l'opération. Aucune donnée n'est enregistrée.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées lors de la validation**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système valide les données saisies et détecte des erreurs (ex: champ obligatoire vide, montant négatif, format de date invalide).
        -   10.a. Le système affiche des messages d'erreur à côté des champs concernés. L'admin reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A3 : Mutualiste sélectionné n'est pas éligible au rachat (vérification métier)**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système effectue une vérification d'éligibilité spécifique aux rachats de prêts et constate que le mutualiste ne remplit pas les conditions (ex: trop de rachats actifs, ratio d'endettement global trop élevé incluant ce rachat).
        -   10.a. Le système affiche un message d'erreur à l'admin expliquant la raison. Le processus de création est arrêté.

    -   **Scénario Alternatif A4 : Paramètres du rachat non conformes aux règles métier**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système valide les paramètres du rachat (montant, taux, durée) et constate qu'ils dépassent les limites configurées ou contreviennent à une règle spécifique aux rachats de prêts (ex: durée maximale d'un rachat dépassée).
        -   10.a. Le système affiche un message d'erreur indiquant la violation. L'admin doit corriger les paramètres.

    -   **Scénario d'Exception E1 : Mutualiste introuvable lors de la sélection**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Le mutualiste recherché ou sélectionné n'est pas trouvé dans le système.
        -   6.e. Le système affiche un message d'erreur à l'admin. L'opération de création ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement du rachat ou de l'échéancier**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde du rachat de prêt ou du calcul/enregistrement de son échéancier.
        -   11.e. Le système enregistre l'erreur technique.
        -   12.e. Le système affiche un message d'erreur générique à l'admin indiquant que la création a échoué. L'opération n'est pas finalisée.

    -   **Scénario d'Exception E3 : Échec de l'envoi de la notification au mutualiste**
        -   ... (Étapes 1 à 13 du scénario principal)
        -   14.e. Le système tente d'envoyer la notification au mutualiste mais l'envoi échoue.
        -   15.e. Le système enregistre l'échec et peut alerter l'admin (ex: "Rachat de prêt créé, mais notification non envoyée").

-   **Points à considérer pour la suite :**
    -   Comment la "preuve de rachat" est-elle gérée si elle est requise (téléchargement de document, visualisation - potentiellement lié aux modules de gestion de documents) ?
    -   Comment les remboursements spécifiques à ce rachat de prêt sont-ils enregistrés et suivis (UC spécifique de gestion des paiements de rachat de prêt) ?
    -   Existe-t-il un processus de déblocage des fonds vers l'institution/personne dont la dette est rachetée ? (Potentiellement un autre UC).
    -   Cet UC implique la création directe du rachat. Y a-t-il un processus de _demande_ et d'_approbation_ de rachat de prêt avant que l'Admin puisse le "créer" dans le système ?

---

**UC 22 - Visualiser l'encours d'un rachat de prêt**

-   **Module :** 7 - Gestion et Consultation des Rachats de Prêts
-   **Acteur principal :** admin

-   **Description :** Permet à un admin de consulter le solde restant dû (l'encours) d'un rachat de prêt spécifique accordé à un mutualiste, afin de suivre son état financier et l'avancement de son remboursement.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour consulter les informations des rachats de prêts.
    -   Le rachat de prêt concerné existe dans le système et est associé à un mutualiste.
    -   L'admin a identifié le rachat de prêt dont il souhaite visualiser l'encours (via une liste, une recherche, ou le dossier du mutualiste).

-   **Postconditions :**

    -   L'admin a pu consulter l'encours et les informations de résumé du rachat de prêt sélectionné. Aucune modification de données n'est effectuée par ce cas d'utilisation.
    -   Les informations de l'encours et du résumé du rachat sont affichées à l'écran.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des rachats de prêts (ou la section des prêts avec un filtre "Rachat").
    2.  L'admin recherche ou sélectionne le rachat de prêt spécifique dont il souhaite visualiser l'encours (par exemple, en parcourant une liste, en cherchant par mutualiste ou par référence de rachat).
    3.  Le système récupère les informations détaillées du rachat de prêt sélectionné (montant initial, historique des paiements enregistrés spécifiques à ce rachat, échéancier rachat).
    4.  Le système calcule l'encours restant dû spécifiquement pour ce rachat de prêt (le capital qui reste à rembourser sur ce rachat).
    5.  Le système affiche à l'écran une vue résumée du rachat de prêt, incluant au minimum :
        -   L'encours restant dû spécifique à ce rachat.
        -   Le montant initial du rachat de prêt.
        -   Le capital déjà remboursé pour ce rachat.
        -   Le total des intérêts et frais payés pour ce rachat.
        -   Le montant total déjà remboursé pour ce rachat.
        -   Le statut actuel du rachat de prêt (En cours, Soldé, En retard, etc.).
        -   La date et le montant de la prochaine échéance spécifique à ce rachat.
        -   Le mutualiste bénéficiaire.
        -   (Optionnel) Des références à la/aux dette(s) initialement rachetée(s).
    6.  L'admin consulte les informations affichées pour le rachat de prêt.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Rachat de prêt introuvable ou non accessible**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système ne trouve pas le rachat de prêt sélectionné/recherché, ou l'admin n'a pas les droits d'accès à ce rachat spécifique.
        -   5.a. Le système affiche un message d'erreur à l'admin indiquant que le rachat de prêt n'a pas été trouvé ou n'est pas accessible.
        -   6.a. L'opération de visualisation ne peut pas se poursuivre.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération ou du calcul des données**
        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données du rachat de prêt ou du calcul de son encours.
        -   6.e. Le système enregistre l'erreur technique dans ses journaux.
        -   7.e. Le système affiche un message d'erreur générique à l'admin l'informant que les informations du rachat de prêt n'ont pas pu être chargées pour le moment.

-   **Points à considérer pour la suite :**
    -   Le calcul de l'encours pour un rachat de prêt suit-il exactement les mêmes règles que pour un prêt classique, ou existe-t-il des spécificités ?
    -   La vue de l'encours du rachat de prêt permet-elle d'accéder à son échéancier spécifique ou à l'historique de ses paiements ? (Nécessiterait des UC similaires à UC 20 mais pour les rachats, ou intégration à des UC existants).
    -   Comment sont affichées les éventuelles pénalités ou frais de retard spécifiquement pour ce rachat ?
    -   La liste des rachats de prêts (étape 2) permet-elle des options de tri/filtre spécifiques (ex: par dette rachetée, par état d'avancement) ?

---

**UC 23 - Visualiser ses rachats de prêt**

-   **Module :** 7 - Gestion et Consultation des Rachats de Prêts
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de consulter la liste récapitulative des rachats de prêts qui lui ont été accordés par la mutuelle et qui sont actuellement en cours de remboursement, via son espace personnel.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le mutualiste dispose d'au moins un rachat de prêt enregistré et actif ou en cours de remboursement dans le système.
    -   Le mutualiste a accès à la section dédiée à la consultation de ses rachats de prêts.

-   **Postconditions :**

    -   Le mutualiste a consulté la liste de ses rachats de prêts. Aucune modification de données n'est effectuée par ce cas d'utilisation.
    -   La liste des rachats de prêts est affichée à l'écran du mutualiste.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue dans le menu de son espace personnel vers la section "Mes Rachats de Prêts", "Mon Financement", ou une section où sont listés les rachats.
    3.  Le système interroge la base de données pour récupérer la liste des rachats de prêts enregistrés pour ce Mutualiste qui ne sont pas encore complètement soldés ou archivés.
    4.  Le système affiche la liste des rachats de prêts en cours ou récents du Mutualiste. Pour chaque rachat de prêt de la liste, des informations de résumé sont présentées (ex: Référence du rachat, Montant initial racheté, Date de début, Statut actuel du rachat).
    5.  Le Mutualiste consulte la liste affichée.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucun rachat de prêt en cours trouvé pour ce mutualiste**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucun rachat de prêt en cours ou non soldé associé à ce Mutualiste.
        -   5.a. Le système affiche un message indiquant "Vous n'avez aucun rachat de prêt en cours actuellement" ou présente une liste vide avec cette indication.
        -   6.a. Le Mutualiste prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération de la liste des rachats de prêts**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique imprévue se produit lors de la tentative de récupération de la liste des rachats de prêts depuis la base de données.
        -   5.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. Le système affiche un message d'erreur générique au Mutualiste l'informant que la liste de ses rachats de prêts n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles informations de résumé exactes (colonnes) sont présentées pour chaque rachat de prêt dans cette liste ?
    -   La liste permet-elle de distinguer clairement les rachats de prêts des prêts classiques si le Mutualiste en a des deux types ?
    -   Le Mutualiste peut-il cliquer sur un élément de la liste pour voir les détails complets de ce rachat de prêt spécifique, y compris son encours et son échéancier ? (Ce serait un lien vers l'UC 24 et potentiellement un UC de consultation d'échéancier rachat).
    -   Y a-t-il des options de tri ou de filtrage pour cette liste (ex: par date, par statut) ?

---

**UC 24 - Visualiser l'encours d'un rachat de prêt**

-   **Module :** 7 - Gestion et Consultation des Rachats de Prêts
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de consulter le solde restant dû (l'encours) ainsi que des informations détaillées pour l'un de ses rachats de prêts spécifiques via son espace personnel.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le mutualiste dispose d'au moins un rachat de prêt actif ou en cours de remboursement enregistré dans le système.
    -   Le mutualiste a accès à la section de consultation de ses rachats de prêts (UC 23).
    -   Le rachat de prêt spécifique que le mutualiste souhaite consulter existe et est accessible via la liste affichée.

-   **Postconditions :**

    -   Le mutualiste a consulté l'encours et les informations clés de son rachat de prêt spécifique. Aucune modification de données n'est effectuée par ce cas d'utilisation.
    -   Les informations détaillées du rachat de prêt, incluant l'encours, sont affichées à l'écran du mutualiste.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue vers la section "Mes Rachats de Prêts" (UC 23) pour voir la liste de ses rachats de prêts.
    3.  Le système affiche la liste des rachats de prêts en cours ou récents du Mutualiste (comme décrit dans UC 23).
    4.  Le Mutualiste sélectionne le rachat de prêt spécifique dont il souhaite consulter les détails et l'encours (ex: clique sur la référence du rachat ou un bouton "Détails").
    5.  Le système récupère les informations détaillées de ce rachat de prêt depuis la base de données, incluant l'historique des paiements enregistrés et l'échéancier spécifique à ce rachat.
    6.  Le système calcule l'encours restant dû spécifiquement pour ce rachat de prêt (le capital qui reste à rembourser sur ce rachat).
    7.  Le système affiche les informations détaillées du rachat de prêt sélectionné, incluant au minimum :
        -   L'encours restant dû (solde du capital) de ce rachat.
        -   Le montant initial du rachat de prêt.
        -   Le capital déjà remboursé pour ce rachat.
        -   Le total des intérêts et frais payés à ce jour pour ce rachat.
        -   Le montant total déjà remboursé pour ce rachat.
        -   Le statut actuel du rachat de prêt (En cours, En retard, Soldé, etc.).
        -   La date et le montant de la prochaine échéance spécifique à ce rachat.
        -   La date de fin prévue du rachat selon l'échéancier.
        -   Le taux d'intérêt appliqué au rachat.
        -   (Optionnel) Des références à la dette rachetée initialement.
    8.  Le Mutualiste consulte les informations détaillées de son rachat de prêt affichées à l'écran.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucun rachat de prêt en cours (liste vide)**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système affiche la liste des rachats de prêts (qui est vide, comme dans UC 23, Alt A1). Le Mutualiste ne peut pas sélectionner de rachat pour voir l'encours. L'opération s'arrête ici. (Liaison avec UC 23 Alt A1).

    -   **Scénario Alternatif A2 : Rachat de prêt sélectionné introuvable ou non accessible après l'affichage de la liste**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.a. Le système ne parvient pas à trouver le rachat de prêt spécifique sélectionné par le Mutualiste (ex: son statut a changé récemment, ou il y a une erreur temporaire de données).
        -   6.a. Le système affiche un message d'erreur indiquant que les détails du rachat de prêt n'ont pas pu être chargés. L'affichage peut rester sur la liste des rachats ou revenir à une page générale.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données du rachat de prêt**
        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données ou du calcul de l'encours du rachat de prêt depuis la base de données.
        -   7.e. Le système enregistre l'erreur technique dans ses journaux.
        -   8.e. Le système affiche un message d'erreur générique au Mutualiste indiquant que les informations de son rachat de prêt n'ont pas pu être chargées pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles informations spécifiques (colonnes) sont affichées dans cette vue détaillée par rapport à la liste (UC 23) ?
    -   Y a-t-il un lien direct depuis cette vue vers l'échéancier spécifique de ce rachat de prêt (nécessiterait un UC "Consulter son échéancier de rachat de prêt") ?
    -   Le Mutualiste peut-il voir l'historique des paiements enregistrés spécifiquement pour ce rachat de prêt ?
    -   Comment les éventuels frais de retard ou pénalités spécifiquement liées à ce rachat sont-ils affichés ?
    -   Le Mutualiste peut-il télécharger des documents liés à ce rachat (ex: contrat, échéancier - via d'autres UC) ?

---

### Module 8: Gestion et consultation des aides

**UC 25 - Créer une aide (numéraire ou matériel)**

-   **Module :** 8 - Gestion et Consultation des Aides
-   **Acteur principal :** admin

-   **Description :** Permet à un admin autorisé d'enregistrer formellement dans le système l'attribution d'une aide, qu'elle soit financière (numéraire) ou en nature (matérielle), à un mutualiste.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour enregistrer les aides.
    -   Le mutualiste bénéficiaire de l'aide existe dans le système et est identifiable.
    -   La décision d'accorder l'aide a été prise conformément aux règles de la mutuelle (potentiellement suite à un processus d'éligibilité ou d'approbation externe au système, ou géré par d'autres UC d'approbation).
    -   Les types d'aides gérés par le système (numéraire, matériel, etc.) sont configurés.

-   **Postconditions :**

    -   Un nouvel enregistrement pour l'aide attribuée est créé dans la base de données et associé au mutualiste bénéficiaire.
    -   Les détails de l'aide (type, montant ou valeur, date d'attribution, description) sont enregistrés.
    -   Un enregistrement d'audit est créé pour l'attribution de l'aide (qui, quand, à qui, quelle aide).
    -   (Optionnel) Une notification est envoyée au mutualiste pour l'informer de l'aide qui lui a été accordée.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des aides (ou accède au dossier du mutualiste bénéficiaire et initie l'action depuis là).
    2.  L'admin clique sur l'option ou le bouton "Enregistrer une nouvelle aide", "Attribuer une aide", ou similaire.
    3.  Le système affiche un formulaire de saisie pour les informations relatives à l'aide.
    4.  L'admin recherche et sélectionne le mutualiste bénéficiaire de l'aide.
    5.  L'admin choisit le type d'aide parmi une liste prédéfinie (ex: Aide Numéraire, Aide Matérielle, Aide Décès, etc.).
    6.  Selon le type d'aide choisi, le système ajuste le formulaire pour demander les informations spécifiques :
        -   **Si Type = Aide Numéraire :** L'admin saisit le montant exact de l'aide financière accordée.
        -   **Si Type = Aide Matérielle :** L'admin saisit une description du bien matériel (ex: fauteuil roulant, béquilles, kit scolaire), sa valeur estimée, et potentiellement des informations supplémentaires comme une référence d'inventaire si la mutuelle gère ses biens.
    7.  L'admin renseigne la date à laquelle l'aide a été attribuée ou décidée.
    8.  (Optionnel) L'admin ajoute une description ou un motif pour l'aide (ex: "Suite à accident de la route", "Soutien rentrée scolaire").
    9.  L'admin vérifie les informations saisies.
    10. L'admin clique sur le bouton "Enregistrer" ou "Attribuer l'aide".
    11. Le système valide les données saisies (champs obligatoires remplis, formats corrects, mutualiste existant et éligible à recevoir des aides si des règles strictes s'appliquent).
    12. Si les validations réussissent, le système crée un nouvel enregistrement d'aide dans la base de données, l'associe au mutualiste, et enregistre tous les détails fournis.
    13. Le système enregistre l'historique de l'attribution de cette aide.
    14. Le système affiche un message de confirmation à l'admin indiquant que l'aide a été enregistrée avec succès.
    15. (Optionnel) Le système génère et envoie une notification (email, SMS, messagerie interne) au mutualiste pour l'informer que l'aide [Type d'aide] lui a été attribuée (avec le montant ou une description si pertinent).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation par l'admin**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.a. L'admin décide d'annuler l'opération.
        -   12.a. L'admin clique sur "Annuler".
        -   13.a. Le système abandonne le processus d'enregistrement de l'aide. Aucune donnée n'est sauvegardée.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.a. Le système valide les données et détecte que des champs obligatoires sont vides ou que les données ne sont pas au bon format (ex: montant négatif pour une aide numéraire, type d'aide non sélectionné).
        -   13.a. Le système affiche des messages d'erreur clairs à côté des champs concernés. L'admin reste sur le formulaire pour corriger.

    -   **Scénario d'Exception E1 : Mutualiste introuvable lors de la sélection**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Le mutualiste recherché ou sélectionné n'est pas trouvé ou n'existe plus dans le système.
        -   6.e. Le système affiche un message d'erreur à l'admin. L'opération ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement de l'aide**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde de l'enregistrement de l'aide dans la base de données.
        -   13.e. Le système enregistre l'erreur technique dans ses logs.
        -   14.e. Le système affiche un message d'erreur générique à l'admin indiquant que l'enregistrement de l'aide a échoué. L'aide n'est pas enregistrée.

    -   **Scénario d'Exception E3 : Échec de l'envoi de la notification au mutualiste**
        -   ... (Étapes 1 à 15 du scénario principal)
        -   16.e. Le système tente d'envoyer la notification au mutualiste mais l'envoi échoue (ex: problème de service d'envoi, coordonnées invalides).
        -   17.e. Le système enregistre l'échec de l'envoi et peut alerter l'admin (ex: "Aide enregistrée, mais notification non envoyée").

-   **Points à considérer pour la suite :**
    -   Existe-t-il un processus de _demande_ et d'_approbation_ des aides (par le mutualiste, puis validation Admin) avant que l'Admin n'enregistre l'aide ici ? (Similaire aux prêts/rachats).
    -   Comment les aides matérielles sont-elles suivies après attribution (ex: suivi d'inventaire si la mutuelle prête du matériel qui doit être retourné, suivi de l'état du matériel) ? Potentiellement lié au Module 12 (Gestion des Prêts de Matériels) si c'est la même logique.
    -   Peut-on lier des documents (ex: décision d'attribution, facture) à l'enregistrement de l'aide ? (Nécessiterait des UC de gestion de documents).
    -   Y a-t-il des règles d'éligibilité complexes pour les aides que le système doit vérifier (ex: ancienneté, paiement des cotisations, conditions spécifiques liées au type d'aide) ?

---

**UC 26 - Visualiser l'ensemble des aides accordées**

-   **Module :** 8 - Gestion et Consultation des Aides
-   **Acteur principal :** admin

-   **Description :** Permet à un admin de consulter une liste récapitulative de toutes les aides (qu'elles soient numéraires ou matérielles) qui ont été attribuées à l'ensemble des mutualistes sur une période donnée ou depuis le début, afin d'avoir une vue d'ensemble et de pouvoir effectuer un suivi global.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour consulter l'ensemble des informations relatives aux aides.
    -   Le système contient des enregistrements d'aides accordées.

-   **Postconditions :**

    -   L'admin a consulté la liste de toutes les aides enregistrées dans le système. Aucune modification des données n'est effectuée.
    -   La liste des aides est affichée à l'écran de l'admin.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion ou de consultation des aides.
    2.  L'admin sélectionne l'option pour afficher la liste complète de toutes les aides accordées (ex: un onglet "Liste de toutes les aides").
    3.  Le système interroge la base de données pour récupérer l'ensemble des enregistrements d'aides, quelles que soient leur type, date ou bénéficiaire.
    4.  Le système affiche la liste de toutes les aides enregistrées. La liste est généralement présentée sous forme de tableau et inclut des informations clés pour chaque aide, comme :
        -   La date d'attribution.
        -   Le type d'aide (Numéraire, Matériel, etc.).
        -   Le montant (pour les aides numéraires) ou une description/valeur (pour les aides matérielles).
        -   Le nom du mutualiste bénéficiaire (avec un lien vers son dossier si possible).
        -   Le statut de l'aide (ex: Attribuée, Payée, Livrée, Clôturée).
        -   (Optionnel) Un court motif ou une référence.
    5.  L'admin consulte la liste affichée.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune aide enregistrée dans le système**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucun enregistrement d'aide.
        -   5.a. Le système affiche un message indiquant "Aucune aide n'a été enregistrée dans le système pour le moment" ou présente une liste vide avec cette indication.
        -   6.a. L'admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération de la liste des aides**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données des aides depuis la base de données.
        -   5.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. Le système affiche un message d'erreur générique à l'admin l'informant que la liste des aides n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles colonnes exactes doivent figurer dans cette liste récapitulative ?
    -   Des options de filtrage sont-elles nécessaires (par type d'aide, par date d'attribution, par mutualiste, par statut) ? (Basé sur le besoin initial de filtrer/rechercher).
    -   Des options de tri sont-elles nécessaires (par date, par montant, par bénéficiaire) ?
    -   Y a-t-il une pagination ou des options de recherche rapide si le nombre d'aides est très important ?
    -   En cliquant sur une ligne de la liste, l'admin peut-il accéder aux détails complets de l'aide ou au dossier du mutualiste bénéficiaire ? (Nécessiterait un ou plusieurs autres UC(s) de consultation détaillée/modification des aides).
    -   L'admin doit-il pouvoir exporter cette liste (ce serait un cas d'utilisation distinct) ?

---

**UC 27 - Visualiser les aides reçues**

-   **Module :** 8 - Gestion et Consultation des Aides
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de consulter une liste récapitulative de toutes les aides (qu'elles soient numéraires ou matérielles) qui lui ont été officiellement attribuées par la mutuelle, via son espace personnel.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le système a enregistré au moins une aide comme ayant été attribuée à ce mutualiste.
    -   Le mutualiste a accès à la section de son espace personnel où cette liste est affichée.

-   **Postconditions :**

    -   Le mutualiste a consulté les informations relatives aux aides qui lui ont été attribuées. Aucune modification de données n'est effectuée.
    -   La liste des aides est affichée à l'écran du mutualiste.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue dans le menu de son espace personnel vers la section "Mes Aides", "Aides Reçues", ou similaire.
    3.  Le système interroge la base de données pour récupérer toutes les aides enregistrées et associées au Mutualiste authentifié.
    4.  Le système affiche la liste des aides qui lui ont été attribuées. La liste est généralement présentée et inclut des informations clés pour chaque aide, comme :
        -   La date d'attribution.
        -   Le type d'aide (Numéraire, Matériel, etc.).
        -   Le montant (pour les aides numéraires) ou une description/valeur (pour les aides matérielles).
        -   Le statut de l'aide (ex: Attribuée, En cours de versement, Payée/Livrée, Clôturée).
        -   (Optionnel) Un court motif ou une référence si pertinent.
    5.  Le Mutualiste consulte la liste affichée.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune aide enregistrée pour ce mutualiste**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucune aide enregistrée et associée à ce Mutualiste.
        -   5.a. Le système affiche un message indiquant "Vous n'avez pas encore reçu d'aide enregistrée" ou présente une liste vide avec cette indication.
        -   6.a. Le Mutualiste prend connaissance de cette information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération de la liste des aides**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données des aides pour ce Mutualiste.
        -   5.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. Le système affiche un message d'erreur générique au Mutualiste l'informant que la liste de ses aides n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles informations spécifiques (colonnes) sont affichées dans cette liste pour le Mutualiste ?
    -   Existe-t-il des options de filtrage ou de tri pour cette liste (par type, par date, par statut) ?
    -   En cliquant sur une ligne de la liste, le Mutualiste peut-il accéder à une vue détaillée de l'aide spécifique (avec plus de description, le motif complet, ou des documents associés si applicable) ? (Ce serait un cas d'utilisation distinct "Visualiser détails d'une aide reçue").
    -   Le statut de l'aide (ex: si l'aide numéraire a été _versée_) est-il clairement affiché et mis à jour ?

---

### Module 9: Gestion et Consultation des Prises en Charge

**UC 28 - Créer une prise en charge**

-   **Module :** 9 - Gestion et Consultation des Prises en Charge
-   **Acteur principal :** admin

-   **Description :** Permet à un admin d'enregistrer et de formaliser une prise en charge pour un mutualiste ou un de ses ayants droit. Cela implique de documenter la dépense concernée, le montant validé par la mutuelle, et de définir le statut de cette prise en charge.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour gérer les prises en charge.
    -   Le mutualiste (et potentiellement l'ayant droit concerné) existe dans le système et est identifiable.
    -   Une demande ou un dossier de prise en charge (potentiellement soumis hors système ou via un autre UC) a été reçu et validé ou est en cours de traitement par l'administration.
    -   Les catégories de prestations ou de dépenses gérées par le système (ex: consultation médicale, frais funéraires) sont configurées.

-   **Postconditions :**

    -   Un nouvel enregistrement de prise en charge est créé dans la base de données, associé au mutualiste (et à l'ayant droit si applicable).
    -   Les détails de la prise en charge (nature, montant total de la dépense, montant pris en charge par la mutuelle, statut, date) sont enregistrés.
    -   Un enregistrement d'audit est créé pour la création de la prise en charge (qui, quand, pour qui, quelle prise en charge).
    -   (Optionnel) Si la prise en charge implique un décaissement par la mutuelle, un processus de paiement peut être déclenché ou planifié.
    -   (Optionnel) Une notification est envoyée au mutualiste concernant le traitement ou le statut de sa prise en charge.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des prises en charge.
    2.  L'admin clique sur l'option "Créer une nouvelle prise en charge" ou sélectionne un dossier de demande de prise en charge à traiter/enregistrer.
    3.  Le système affiche un formulaire de saisie pour les informations de la prise en charge.
    4.  L'admin recherche et sélectionne le mutualiste principal concerné.
    5.  L'admin sélectionne potentiellement l'ayant droit si la prise en charge concerne un ayant droit du mutualiste.
    6.  L'admin choisit la catégorie de la prise en charge (ex: Soins Médicaux, Optique, Frais Funéraires) parmi une liste prédéfinie, potentiellement liée aux prestations souscrites par le mutualiste (Module 11).
    7.  L'admin saisit les détails de la dépense :
        -   Date de la dépense (ex: date de la consultation, date du décès).
        -   Montant total de la dépense (montant de la facture originale).
        -   Le montant qui sera pris en charge / remboursé par la mutuelle. (Ce montant peut être calculé automatiquement par le système basé sur la prestation, le contrat et le montant total, mais l'Admin peut devoir confirmer ou ajuster).
        -   (Optionnel) Description détaillée ou motif (ex: type de soin, événement).
        -   (Optionnel) Références externes (ex: N° de facture, N° de dossier patient).
    8.  L'admin définit le statut de la prise en charge (ex: "Enregistrée", "Validée pour paiement", "Payée", "Refusée").
    9.  L'admin vérifie les informations saisies et le statut.
    10. L'admin clique sur le bouton "Enregistrer", "Valider", ou "Enregistrer et Payer" (si le processus de paiement est intégré).
    11. Le système valide les données saisies (champs obligatoires, formats, montants cohérents, mutualiste/ayant droit valide, cohérence avec la catégorie de prise en charge).
    12. Si les validations réussissent, le système crée un nouvel enregistrement de prise en charge dans la base de données, l'associe au mutualiste (et à l'ayant droit), et enregistre tous les détails, y compris le statut.
    13. Le système enregistre l'historique de la création/validation de la prise en charge.
    14. Si le statut défini (ex: "Validée pour paiement", "Payée") déclenche une action, le système initie le processus de paiement ou marque la prise en charge pour le prochain cycle de décaissements (ce qui est potentiellement un autre UC ou processus interne).
    15. Le système affiche un message de confirmation à l'admin.
    16. (Optionnel) Le système génère et envoie une notification au mutualiste (email, SMS, messagerie interne) pour l'informer que sa prise en charge a été enregistrée et quel est son statut (ex: "Votre prise en charge pour [Catégorie] d'un montant de [Montant] a été enregistrée avec le statut [Statut]").

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation par l'admin**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.a. L'admin décide d'annuler l'opération.
        -   12.a. L'admin clique sur "Annuler".
        -   13.a. Le système abandonne le processus.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.a. Le système valide les données et détecte des erreurs (ex: champ obligatoire vide, montant négatif, date future).
        -   13.a. Le système affiche des messages d'erreur à côté des champs concernés. L'admin reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A3 : Montant pris en charge dépasse les règles métier (ex: plafond de prestation)**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.a. Le système valide le montant pris en charge par rapport aux règles de la prestation associée et constate qu'il dépasse un plafond défini pour le mutualiste ou l'ayant droit.
        -   13.a. Le système affiche un avertissement ou un message d'erreur. L'admin doit ajuster le montant pour être conforme ou enregistrer une dérogation si possible.

    -   **Scénario Alternatif A4 : Enregistrement avec statut "Refusée"**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.a. L'admin définit délibérément le statut à "Refusée" car le dossier n'est pas éligible.
        -   12.a. Le système valide et enregistre la prise en charge avec le statut "Refusée". Le processus de paiement n'est pas déclenché. L'Admin peut être invité à saisir un motif de refus. La notification informera le mutualiste du refus.

    -   **Scénario d'Exception E1 : Mutualiste ou Ayant Droit introuvable lors de la sélection**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.e. Le mutualiste ou l'ayant droit recherché/sélectionné n'est pas trouvé ou n'existe plus.
        -   7.e. Le système affiche un message d'erreur. L'opération ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement de la prise en charge**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde de l'enregistrement de la prise en charge.
        -   13.e. Le système enregistre l'erreur technique dans ses logs.
        -   14.e. Le système affiche un message d'erreur générique à l'admin indiquant que l'enregistrement a échoué.

    -   **Scénario d'Exception E3 : Échec du déclenchement du paiement ou de l'envoi de notification/paiement**
        -   ... (Étapes 1 à 15 du scénario principal)
        -   16.e. Le système tente de déclencher l'envoi de notification au mutualiste, ou de marquer la prise en charge pour paiement, mais une erreur technique se produit dans ce sous-processus.
        -   17.e. Le système enregistre l'échec. La prise en charge est enregistrée dans le système avec le statut choisi, mais l'admin est averti d'un problème avec le suivi (notification non partie, paiement non initié).

-   **Points à considérer pour la suite :**
    -   Y a-t-il un processus de soumission de _demande_ de prise en charge par le mutualiste (UC Mutualiste) ou par un tiers (ex: hôpital) ?
    -   Comment sont gérés les documents justificatifs (factures, rapports) liés à une prise en charge ? (Nécessiterait un module de gestion de documents et des UC liés).
    -   Comment se fait le lien précis avec les prestations souscrites par le mutualiste (Module 11) pour déterminer le montant pris en charge ?
    -   Le paiement des prises en charge est-il un processus automatique déclenché ici, ou y a-t-il un UC séparé pour la "Gestion des décaissements/remboursements" ? (Ce dernier est plus courant).

---

**UC 29 - Visualiser les prises en charge**

-   **Module :** 9 - Gestion et Consultation des Prises en Charge
-   **Acteur principal :** admin

-   **Description :** Permet à un admin de consulter une liste globale de toutes les prises en charge enregistrées dans le système, quel que soit leur statut ou le mutualiste concerné. Cette vue offre un aperçu complet des demandes et des dépenses liées aux prestations de la mutuelle.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour visualiser les informations relatives aux prises en charge.
    -   Le système contient des enregistrements de prises en charge (potentiellement aucun, le cas est géré).

-   **Postconditions :**

    -   L'admin a consulté la liste de toutes les prises en charge enregistrées dans le système. Aucune modification des données n'est effectuée par ce cas d'utilisation.
    -   La liste des prises en charge est affichée à l'écran de l'admin.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion ou de consultation des prises en charge.
    2.  L'admin sélectionne l'option permettant d'afficher la liste de toutes les prises en charge (ex: un menu, un onglet, un bouton "Voir toutes les prises en charge").
    3.  Le système interroge la base de données pour récupérer l'ensemble des enregistrements de prises en charge disponibles.
    4.  Le système affiche la liste des prises en charge sous forme structurée, généralement un tableau. Chaque ligne représente une prise en charge et présente des informations clés telles que :
        -   La référence unique de la prise en charge.
        -   La date de la dépense ou de la demande.
        -   La catégorie ou le type de prestation concerné (ex: Consultation, Pharmacie, Optique).
        -   Le mutualiste principal bénéficiaire (avec son numéro d'adhérent et un lien vers son dossier).
        -   L'ayant droit bénéficiaire si applicable (avec son lien de parenté et un lien).
        -   Le montant total de la dépense initiale.
        -   Le montant pris en charge/remboursé par la mutuelle.
        -   Le statut actuel de la prise en charge (Enregistrée, Validée, En cours de paiement, Payée, Refusée, Annulée...).
        -   La date du dernier changement de statut.
        -   (Optionnel) Un bref résumé ou motif.
    5.  L'admin consulte la liste affichée, pouvant potentiellement utiliser des options de tri, de filtrage ou de recherche rapide si disponibles.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune prise en charge enregistrée dans le système**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucun enregistrement de prise en charge correspondant aux critères (ou aucun du tout).
        -   5.a. Le système affiche un message indiquant "Aucune prise en charge n'a été enregistrée dans le système pour le moment" ou "Aucune prise en charge ne correspond à votre recherche/filtre".
        -   6.a. L'admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données des prises en charge depuis la base de données.
        -   5.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. Le système affiche un message d'erreur générique à l'admin l'informant que la liste des prises en charge n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles informations (colonnes) sont les plus importantes pour que l'admin puisse effectuer un suivi efficace depuis cette liste ?
    -   Des fonctionnalités de filtrage (par statut, par mutualiste, par période de date, par catégorie de prestation) et de tri sont-elles essentielles ?
    -   Y a-t-il une pagination si le nombre de prises en charge est très important ?
    -   L'admin doit-il pouvoir cliquer sur une ligne du tableau pour accéder à une vue détaillée de la prise en charge, potentiellement pour la modifier ou voir les documents associés ? (Nécessiterait un UC distinct comme "Visualiser/Modifier une prise en charge (Admin)").
    -   L'admin doit-il pouvoir exporter cette liste pour des analyses externes (ce serait un cas d'utilisation distinct) ?

---

**UC 30 - Identifier les prises en charge fréquentes**

-   **Module :** 9 - Gestion et Consultation des Prises en Charge
-   **Acteur principal :** admin

-   **Description :** Permet à l'admin de consulter une synthèse statistique, généralement sous forme de rapport ou graphique, identifiant les catégories de prises en charge (ex: types de soins, événements) les plus courantes ou les plus coûteuses sur une période donnée. Cela aide à analyser les besoins des adhérents et à orienter la stratégie de la mutuelle.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour accéder aux rapports sur les prises en charge.
    -   Le système contient un volume suffisant d'enregistrements de prises en charge pour permettre une analyse pertinente.
    -   Les données des prises en charge sont correctement catégorisées dans le système (UC 28).

-   **Postconditions :**

    -   L'admin a consulté le rapport ou la liste des catégories de prises en charge les plus fréquentes. Aucune modification de données n'est effectuée par ce cas d'utilisation.
    -   Les résultats du rapport sont affichés à l'écran de l'admin.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de reporting ou de statistiques, ou accède directement au tableau de bord admin (UC 51) qui inclut ce rapport.
    2.  L'admin accède à la fonctionnalité d'analyse des prises en charge fréquentes ou consulte le widget correspondant sur le tableau de bord.
    3.  Le système peut proposer des options de configuration du rapport, telles que :
        -   La période d'analyse (ex: Année en cours, Mois précédent, Derniers 12 mois, Personnalisée).
        -   Le critère de classement (ex: Par nombre d'occurrences/fréquence, Par montant total pris en charge).
        -   Le nombre d'éléments à afficher dans le classement (ex: Top 10, Top 15, Toutes les catégories).
    4.  L'admin configure le rapport si nécessaire et déclenche sa génération (si ce n'est pas un widget automatique).
    5.  Le système interroge la base de données pour récupérer les prises en charge enregistrées sur la période sélectionnée.
    6.  Le système agrège les données par catégorie de prise en charge et calcule la métrique choisie (nombre d'occurrences ou somme des montants pris en charge).
    7.  Le système classe les catégories selon la métrique calculée.
    8.  Le système affiche le rapport à l'écran. Il peut s'agir :
        -   D'une liste classée (ex: "Top 15 Prises en Charge par Fréquence : 1. Consultation Générale (X fois), 2. Frais Pharmaceutiques (Y fois)...").
        -   D'un graphique (ex: un diagramme à barres montrant le nombre d'occurrences ou le coût par catégorie).
    9.  L'admin consulte le rapport pour analyser les tendances.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Données insuffisantes ou période sans prises en charge**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système tente d'agréger les données, mais constate qu'il n'y a pas assez de prises en charge enregistrées pour générer un classement pertinent sur la période ou que la période sélectionnée ne contient aucune prise en charge.
        -   8.a. Le système affiche un message indiquant que le rapport ne peut pas être généré en raison de données insuffisantes ou d'absence de prises en charge sur la période.
        -   9.a. L'admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors de la génération du rapport**
        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.e. Une erreur technique imprévue se produit lors de l'interrogation, de l'agrégation, du calcul ou de la préparation de l'affichage du rapport.
        -   9.e. Le système enregistre l'erreur technique dans ses journaux.
        -   10.e. Le système affiche un message d'erreur générique à l'admin indiquant que le rapport n'a pas pu être généré pour le moment.

-   **Points à considérer pour la suite :**
    -   Les "prises en charge les plus enlevées" se réfèrent-elles à la fréquence (nombre de fois où la catégorie est apparue) ou au coût total cumulé pour cette catégorie ? (Le scénario principal couvre les deux options).
    -   L'admin peut-il cliquer sur une catégorie dans le rapport pour voir la liste des prises en charge individuelles qui la composent (potentiellement en utilisant l'UC 29 avec un filtre appliqué) ?
    -   Ce rapport est-il uniquement visuel ou l'admin peut-il exporter les données brutes ou le rapport final ?
    -   Des rapports similaires sont-ils nécessaires basés sur d'autres critères (ex: par âge des bénéficiaires, par zone géographique, par mutualiste le plus consommateur) ?

---

**UC 31 - Visualiser l'historique de ses prises en charge**

-   **Module :** 9 - Gestion et Consultation des Prises en Charge
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de consulter, via son espace personnel, la liste des prises en charge qui ont été enregistrées ou traitées en sa faveur ou en faveur des ayants droit qui lui sont rattachés. Cela lui permet de suivre l'état et le détail des remboursements ou des couvertures accordées par la mutuelle.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le système a enregistré au moins une prise en charge associée à ce mutualiste (soit en tant que bénéficiaire principal, soit via un ayant droit rattaché).
    -   Le mutualiste a accès à la section de son espace personnel où cet historique est affiché (potentiellement sur le tableau de bord UC 52 pour les plus récentes, ou sur une page dédiée pour l'historique complet).

-   **Postconditions :**

    -   Le mutualiste a consulté les informations relatives à ses prises en charge et celles de ses ayants droit. Aucune modification de données n'est effectuée.
    -   La liste des prises en charge est affichée à l'écran du mutualiste.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue dans le menu de son espace personnel vers la section "Mes Prises en Charge", "Mes Remboursements", "Historique Prestations", ou similaire.
    3.  Le système interroge la base de données pour récupérer toutes les prises en charge enregistrées qui sont associées au Mutualiste authentifié (soit directement, soit via ses ayants droit).
    4.  Le système affiche la liste des prises en charge. La liste est généralement présentée sous forme de tableau ou liste et inclut des informations clés pour chaque prise en charge, comme :
        -   La référence de la prise en charge (si applicable).
        -   La date de la dépense initiale ou la date d'enregistrement/validation.
        -   La catégorie de la prise en charge (ex: Consultation, Pharmacie, Funéraire).
        -   Le montant total de la dépense.
        -   Le montant qui a été/sera pris en charge par la mutuelle.
        -   Le Bénéficiaire de la prise en charge (indiquer si c'est le Mutualiste lui-même ou un Ayant Droit, avec le nom de l'ayant droit si applicable).
        -   Le statut actuel de la prise en charge (Enregistrée, Validée, Payée, Remboursée, Refusée, etc.).
        -   La date du dernier changement de statut (ex: date de paiement effectif).
        -   (Optionnel) Un bref résumé ou motif.
    5.  Le Mutualiste consulte la liste affichée, pouvant potentiellement faire défiler, trier ou filtrer si les options sont disponibles.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune prise en charge enregistrée pour ce mutualiste**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucune prise en charge associée à ce Mutualiste ou à ses ayants droit.
        -   5.a. Le système affiche un message indiquant "Aucun historique de prises en charge disponible pour le moment" ou présente une liste vide avec cette indication.
        -   6.a. Le Mutualiste prend connaissance de cette information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération de l'historique des prises en charge**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données de l'historique des prises en charge depuis la base de données.
        -   5.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. Le système affiche un message d'erreur générique au Mutualiste l'informant que l'historique de ses prises en charge n'a pas pu être chargé pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles colonnes d'informations exactes sont les plus pertinentes pour le Mutualiste dans cette vue historique ?
    -   Des fonctionnalités de filtrage (par période de date - comme les 12 derniers mois sur le tableau de bord, par statut, par bénéficiaire - lui-même ou un ayant droit) et de tri sont-elles nécessaires ?
    -   Y a-t-il une pagination si l'historique est très long ?
    -   Le Mutualiste peut-il cliquer sur une ligne de la liste pour voir les détails complets d'une prise en charge spécifique (potentiellement avec accès aux documents associés, motif complet, etc.) ? (Ce serait un cas d'utilisation distinct "Visualiser détails d'une prise en charge (Mutualiste)").
    -   Le Mutualiste peut-il télécharger un justificatif ou un récapitulatif de remboursement depuis cette vue (ce serait un cas d'utilisation distinct) ?
    -   Comment les montants sont-ils affichés s'il y a des co-paiements ou des franchises ?

---

### Module 10: Gestion et Suivi des Liquidations

**UC 32 - Lancer la procédure de liquidation des droits**

-   **Module :** 10 - Gestion et Suivi des Liquidations
-   **Acteur principal :** admin

-   **Description :** Permet à un admin autorisé d'initier formellement le processus de liquidation des droits acquis par un mutualiste ou ses bénéficiaires. Ce processus inclut le calcul des sommes dues selon les règles de la mutuelle et la préparation du versement final.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour gérer les liquidations.
    -   Le mutualiste (ou les bénéficiaires désignés) concerné par la liquidation existe dans le système et est identifiable.
    -   L'événement déclencheur de la liquidation (ex: décès, départ de la mutuelle, fin de contrat) s'est produit et a été enregistré ou validé dans le système (potentiellement via un autre UC).
    -   Toutes les données nécessaires au calcul des droits acquis (historique de cotisations, parts sociales, etc.) sont disponibles dans le système.
    -   Les règles de calcul et de détermination des droits à liquider sont configurées dans le système.

-   **Postconditions :**

    -   Un nouvel enregistrement de procédure de liquidation est créé dans le système, associé au mutualiste et/ou aux bénéficiaires.
    -   Le statut de la procédure de liquidation est défini à un état initial (ex: "Initiée", "En cours de calcul", "En attente de documents").
    -   Le système déclenche (automatiquement ou en marquant pour traitement) le processus de calcul des droits acquis.
    -   Un enregistrement d'audit est créé pour l'initiation de la procédure (qui, quand, pour qui, événement déclencheur).

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des liquidations ou accède au dossier du mutualiste concerné.
    2.  L'admin identifie le mutualiste ou les bénéficiaires pour lesquels une liquidation doit être lancée, potentiellement sur la base d'un événement enregistré (ex: notification de décès).
    3.  L'admin sélectionne le mutualiste/bénéficiaire et choisit l'option ou le bouton "Lancer procédure de liquidation".
    4.  Le système peut afficher un formulaire ou une boîte de dialogue demandant confirmation et/ou de spécifier l'événement déclencheur de la liquidation (ex: Décès, Départ, Retraite).
    5.  L'admin confirme le lancement de la procédure et spécifie l'événement si nécessaire.
    6.  Le système vérifie les préconditions : existence du mutualiste/bénéficiaire, éligibilité à une liquidation basée sur l'événement et le statut, présence des données de base.
    7.  Si les préconditions sont remplies, le système crée un nouvel enregistrement dans la base de données pour suivre cette procédure de liquidation spécifique, l'associant au mutualiste principal et potentiellement aux bénéficiaires.
    8.  Le système définit le statut initial de la procédure (ex: "Initiée").
    9.  Le système déclenche (automatiquement ou en préparant pour un processus batch/manuel) le calcul des droits financiers à liquider basés sur l'historique des cotisations, contributions, parts sociales, l'événement déclencheur, et les règles configurées dans le système.
    10. Le système enregistre l'historique de l'initiation de cette procédure de liquidation.
    11. Le système affiche un message de confirmation à l'admin indiquant que la procédure de liquidation a été lancée avec succès et qu'un calcul des droits est en cours ou prêt à être effectué.
    12. (Optionnel) Le système peut générer et envoyer une notification (email, courrier si les bénéficiaires n'ont pas d'accès numérique) aux bénéficiaires désignés ou au mutualiste (s'il s'agit d'un départ/retraite) pour les informer que la procédure est lancée.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation par l'admin**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. L'admin décide de ne pas lancer la procédure.
        -   7.a. L'admin clique sur "Annuler".
        -   8.a. Le système abandonne l'opération.

    -   **Scénario Alternatif A2 : Mutualiste/Bénéficiaire non éligible ou événement non pertinent pour la liquidation**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système vérifie l'éligibilité ou la pertinence de l'événement pour la liquidation et constate que le mutualiste/bénéficiaire n'a pas de droits à liquider ou que l'événement ne déclenche pas cette procédure.
        -   8.a. Le système affiche un message d'erreur à l'admin expliquant la raison. L'opération est stoppée.

    -   **Scénario Alternatif A3 : Données historiques manquantes ou incohérentes pour le calcul**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système détecte que des données essentielles pour le calcul des droits acquis sont manquantes ou incohérentes dans le dossier du mutualiste (ex: historique de cotisations incomplet).
        -   8.a. Le système affiche un avertissement ou bloque le lancement, indiquant à l'admin que les données doivent être corrigées/complétées avant de lancer la liquidation.

    -   **Scénario d'Exception E1 : Mutualiste ou Bénéficiaire introuvable**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Le mutualiste/bénéficiaire recherché ou sélectionné n'est pas trouvé.
        -   5.e. Le système affiche un message d'erreur. L'opération ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur système lors de la création de la procédure ou du déclenchement du calcul**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.e. Une erreur technique imprévue se produit lors de la création de l'enregistrement de la procédure de liquidation ou du déclenchement du sous-processus de calcul.
        -   11.e. Le système enregistre l'erreur technique dans ses journaux.
        -   12.e. Le système affiche un message d'erreur générique à l'admin indiquant que le lancement de la procédure a échoué.

    -   **Scénario d'Exception E3 : Échec de l'envoi de la notification (si automatique)**
        -   ... (Étapes 1 à 12 du scénario principal)
        -   13.e. Le système tente d'envoyer la notification aux bénéficiaires mais échoue.
        -   14.e. Le système enregistre l'échec. La procédure est lancée, mais l'Admin est averti que la notification n'a pas été envoyée.

-   **Points à considérer pour la suite :**
    -   Quels sont les différents événements déclencheurs possibles pour une liquidation (retraite, démission, exclusion, décès, fin de contrat à terme) ?
    -   Comment sont gérés les bénéficiaires désignés pour une liquidation (sont-ils déjà enregistrés dans le système, potentiellement via UC 10 ou un UC Admin dédié "Gérer les bénéficiaires de liquidation") ?
    -   Le processus de calcul des droits est-il immédiat et automatique après le lancement, ou est-ce un processus qui prend du temps et potentiellement nécessite des étapes manuelles de validation (UC 33, 34) ?
    -   Quels documents justificatifs sont requis pour chaque type d'événement déclencheur (certificat de décès, lettre de démission) et comment sont-ils gérés ? (Nécessiterait des UC de gestion de documents).

---

**UC 33 - Suivre le processus de liquidation**

-   **Module :** 10 - Gestion et Suivi des Liquidations
-   **Acteur principal :** admin

-   **Description :** Permet à un admin de visualiser l'état actuel et l'historique des différentes étapes d'une procédure de liquidation des droits (initiée via UC 32) pour un mutualiste ou ses bénéficiaires.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour consulter et suivre les procédures de liquidation.
    -   Une procédure de liquidation a été lancée pour le mutualiste/bénéficiaire concerné (UC 32 réussi) et existe dans le système.
    -   L'admin a identifié la procédure de liquidation spécifique qu'il souhaite suivre.

-   **Postconditions :**

    -   L'admin a pu consulter toutes les informations disponibles sur l'état d'avancement de la procédure de liquidation sélectionnée. Aucune modification de données n'est effectuée par cette consultation.
    -   L'état et les informations de la procédure de liquidation sont affichés à l'écran.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion et de suivi des liquidations.
    2.  L'admin accède à la liste des procédures de liquidation (en cours, terminées, en attente, etc.).
    3.  L'admin utilise une fonction de recherche ou des filtres, ou sélectionne directement dans la liste, la procédure de liquidation spécifique qu'il souhaite suivre.
    4.  Le système récupère toutes les informations enregistrées pour la procédure de liquidation sélectionnée.
    5.  Le système affiche une vue détaillée du suivi de la liquidation, incluant au minimum :
        -   Le statut actuel de la procédure (ex: Initiée, Calcul en cours, Calcul terminé, En attente de documents, En attente de validation par l'Admin, Validée, En cours de paiement, Payée, Suspendue, Annulée).
        -   L'événement déclencheur de la liquidation (ex: Décès, Départ).
        -   Le mutualiste principal et le(s) bénéficiaire(s) concerné(s).
        -   La date de lancement de la procédure.
        -   La date du dernier changement de statut.
        -   Le résultat du calcul des droits acquis (montant brut, déductions appliquées, montant net à payer), si le calcul est terminé.
        -   Une liste chronologique des étapes clés franchies dans le processus (ex: Lancée le [Date], Calcul des droits terminé le [Date], Documents [X] reçus le [Date]).
        -   (Optionnel) Des liens ou références vers les documents liés à la liquidation (ex: acte de décès, demande de liquidation - UC 34).
        -   (Optionnel) Des alertes ou actions requises pour cette procédure (ex: "Validation du calcul par le responsable requise", "Attente de la confirmation bancaire du versement").
    6.  L'admin consulte les informations affichées pour prendre connaissance de l'état d'avancement et des prochaines étapes éventuelles.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune procédure de liquidation trouvée**

        -   ... (Étapes 1 à 2 du scénario principal)
        -   3.a. Le système affiche la liste des procédures de liquidation (qui peut être vide si aucune n'a été lancée ou ne correspond aux filtres).
        -   4.a. Le système affiche un message indiquant "Aucune procédure de liquidation trouvée" ou "Aucune procédure en cours".
        -   5.a. L'admin prend connaissance de l'information.

    -   **Scénario Alternatif A2 : Procédure de liquidation sélectionnée introuvable**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système ne trouve pas la procédure de liquidation sélectionnée ou recherchée (ex: elle a été archivée, ou il y a une erreur de référence).
        -   5.a. Le système affiche un message d'erreur indiquant que la procédure n'a pas été trouvée.
        -   6.a. L'opération de visualisation s'arrête.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données de la procédure**
        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Une erreur technique imprévue se produit lors de la tentative de récupération des informations de la procédure de liquidation depuis la base de données.
        -   6.e. Le système enregistre l'erreur technique dans ses journaux.
        -   7.e. Le système affiche un message d'erreur générique à l'admin l'informant que les informations de la procédure n'ont pas pu être chargées pour le moment.

-   **Points à considérer pour la suite :**
    -   Quels sont les statuts précis que peut prendre une procédure de liquidation ?
    -   Est-il possible pour l'admin de _modifier_ le statut d'une procédure depuis cette vue (si le processus le permet) ? (Ce serait un UC distinct comme "Mettre à jour le statut d'une liquidation").
    -   Comment les résultats du calcul des droits (étape 5) sont-ils validés et enregistrés formellement avant le paiement ? (Potentiellement un UC de validation du calcul).
    -   Le suivi des paiements effectifs (versement final aux bénéficiaires) est-il lié à cette procédure de liquidation ? (Nécessiterait un lien avec un module financier ou de paiement).
    -   Y a-t-il des documents spécifiques à télécharger et associer à cette procédure (ex: pièces d'identité des bénéficiaires, RIB) ? (Liaison avec UC 34 et un module de gestion de documents).

---

**UC 34 - Visualiser les documents de liquidation**

-   **Module :** 10 - Gestion et Suivi des Liquidations
-   **Acteur principal :** admin

-   **Description :** Permet à un admin de consulter la liste des documents numériques (fichiers scannés, PDF, images, etc.) qui ont été associés à une procédure de liquidation spécifique. Ces documents servent de pièces justificatives pour l'événement déclencheur, l'identification des bénéficiaires, le calcul des droits, etc.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour accéder et visualiser les documents de liquidation.
    -   Une procédure de liquidation a été lancée (UC 32 réussi) et existe dans le système.
    -   Au moins un document a été téléchargé et associé à cette procédure de liquidation (potentiellement via un autre UC de gestion de documents).
    -   L'admin a identifié la procédure de liquidation dont il souhaite consulter les documents.

-   **Postconditions :**

    -   L'admin a pu consulter la liste des documents associés à la liquidation sélectionnée.
    -   L'admin a pu ouvrir et visualiser le contenu des documents sélectionnés (ou les télécharger).
    -   Aucune modification des données ou des documents n'est effectuée par ce cas d'utilisation.
    -   La liste des documents est affichée à l'écran.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des liquidations.
    2.  L'admin recherche ou sélectionne la procédure de liquidation spécifique (potentiellement depuis la vue de suivi UC 33) pour laquelle il souhaite consulter les documents.
    3.  L'admin accède à la section ou à l'onglet "Documents", "Pièces Jointes", ou "Justificatifs" lié à cette procédure de liquidation spécifique.
    4.  Le système interroge la base de données et le système de gestion des fichiers pour récupérer la liste des documents associés à cette procédure de liquidation.
    5.  Le système affiche la liste des documents associés. Pour chaque document de la liste, des informations descriptives sont présentées, comme :
        -   Le nom du fichier.
        -   Le type de document (ex: Acte de décès, Pièce d'identité, RIB, Demande écrite, Décision interne).
        -   La date de téléchargement/association.
        -   L'utilisateur qui a téléchargé le document.
        -   La taille du fichier.
    6.  L'admin consulte la liste des documents disponibles.
    7.  L'admin sélectionne un document spécifique dans la liste (ex: clique sur le nom du fichier ou une icône "Visualiser").
    8.  Le système récupère le fichier du document sélectionné.
    9.  Le système permet à l'admin de visualiser le contenu du document (par exemple, en ouvrant une visionneuse intégrée, ou en initiant un téléchargement pour l'ouvrir localement).
    10. L'admin examine le contenu du document.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune procédure de liquidation trouvée**

        -   ... (Étapes 1 à 2 du scénario principal)
        -   3.a. Le système ne trouve pas la procédure de liquidation recherchée/sélectionnée.
        -   4.a. Le système affiche un message d'erreur. L'opération ne peut pas se poursuivre.

    -   **Scénario Alternatif A2 : Aucun document associé à la liquidation sélectionnée**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.a. Le système interroge la base de données/le système de fichiers et ne trouve aucun document associé à cette procédure de liquidation spécifique.
        -   6.a. Le système affiche un message indiquant "Aucun document associé à cette liquidation".
        -   7.a. L'admin prend connaissance de l'information. La visualisation des documents pour cette procédure est terminée.

    -   **Scénario Alternatif A3 : Document sélectionné introuvable ou fichier corrompu**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système tente de récupérer le fichier du document sélectionné, mais le fichier n'est pas trouvé à l'emplacement attendu, est corrompu, ou l'admin n'a pas les droits d'accès suffisants pour ce fichier spécifique.
        -   8.a. Le système affiche un message d'erreur indiquant que le document n'a pas pu être chargé ou est inaccessible.
        -   9.a. L'admin ne peut pas consulter le document.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération de la liste des documents**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Une erreur technique imprévue se produit lors de la tentative de récupération de la liste des documents associés depuis la base de données ou le système de fichiers.
        -   6.e. Le système enregistre l'erreur technique dans ses journaux.
        -   7.e. Le système affiche un message d'erreur générique à l'admin l'informant que la liste des documents n'a pas pu être chargée.

    -   **Scénario d'Exception E2 : Erreur système lors de la tentative d'accès au fichier d'un document**
        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.e. Une erreur technique se produit lors de la tentative d'accéder au fichier physique du document sélectionné.
        -   8.e. Le système enregistre l'erreur technique.
        -   9.e. Le système affiche un message d'erreur générique au Mutualiste, l'informant qu'une erreur s'est produite lors de l'ouverture du document.

-   **Points à considérer pour la suite :**
    -   Comment les documents sont-ils initialement associés à une liquidation ? Existe-t-il un UC "Uploader/Associer un document de liquidation (Admin)" ? (Probablement). Le mutualiste ou les bénéficiaires peuvent-ils uploader des documents (UC Mutualiste) ?
    -   Le système gère-t-il différents _types_ de documents avec des règles spécifiques ?
    -   Comment la sécurité et la confidentialité des documents sont-elles assurées ?
    -   L'admin peut-il ajouter des notes ou des commentaires aux documents ?
    -   Les documents sont-ils horodatés et liés à l'utilisateur qui les a ajoutés ?

---

**UC 35 - Suivre l'évolution de sa liquidation de droits**

-   **Module :** 10 - Gestion et Suivi des Liquidations
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste d'accéder, via son espace personnel, aux informations relatives à l'état d'avancement d'une procédure de liquidation de ses droits ou des droits de ses bénéficiaires (initiée via UC 32). Cela lui permet de rester informé du processus.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Une procédure de liquidation le concernant (ou concernant ses bénéficiaires rattachés) a été lancée par l'administration (UC 32 réussi) et existe dans le système.
    -   Le mutualiste a accès à la section de son espace personnel où les informations de suivi des liquidations sont affichées.
    -   Le statut du mutualiste principal permet la consultation de ces informations (ex: compte actif, non archivé).

-   **Postconditions :**

    -   Le mutualiste a consulté les informations et l'état d'avancement de la procédure de liquidation le concernant. Aucune modification de données n'est effectuée.
    -   L'état et les informations clés de la procédure de liquidation sont affichés à l'écran du mutualiste.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue dans le menu de son espace personnel vers la section "Mes Liquidations", "Suivi de mes droits", ou une zone similaire. Il peut également y accéder via un lien sur son tableau de bord (UC 52) si une liquidation est en cours.
    3.  Le système interroge la base de données pour trouver les procédures de liquidation qui lui sont associées (ou associées à ses ayants droit rattachés).
    4.  Si plusieurs liquidations sont en cours ou récentes, le système affiche une liste sommaire des procédures. Le Mutualiste sélectionne celle dont il veut voir le détail.
    5.  Le système récupère les informations détaillées de la procédure de liquidation sélectionnée.
    6.  Le système affiche les informations de suivi de la procédure pour le Mutualiste. Ces informations sont présentées de manière simplifiée par rapport à la vue admin (UC 33) et incluent au minimum :
        -   Le statut actuel de la procédure (utilisant une terminologie compréhensible pour le mutualiste, ex: "En cours de traitement", "Calcul terminé", "En attente de votre part", "Validation par la mutuelle", "Paiement en cours", "Clôturée").
        -   La date de début de la procédure.
        -   La date du dernier changement de statut.
        -   Un résumé des étapes clés franchies (ex: "Dossier ouvert le [Date]", "Calcul des droits effectué le [Date]").
        -   Le montant calculé des droits à liquider (si le calcul est finalisé et validé, et si ce montant est communicable au mutualiste à ce stade du processus).
        -   (Optionnel) Une liste des documents que le mutualiste doit fournir ou qu'il peut consulter (si un module de gestion de documents mutualiste existe).
        -   (Optionnel) Un contact ou un lien vers la messagerie interne (UC 40) pour poser des questions.
    7.  Le Mutualiste consulte les informations affichées pour suivre l'avancement de sa procédure.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune procédure de liquidation trouvée pour ce mutualiste**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucune procédure de liquidation active ou récente associée à ce Mutualiste ou à ses ayants droit rattachés.
        -   5.a. Le système affiche un message indiquant "Aucune procédure de liquidation en cours ou récente vous concernant n'a été enregistrée".
        -   6.a. Le Mutualiste prend connaissance de l'information.

    -   **Scénario Alternatif A2 : Procédure de liquidation sélectionnée introuvable**

        -   ... (Étapes 1 à 4 du scénario principal, si liste affichée)
        -   5.a. Le système ne parvient pas à trouver la procédure de liquidation sélectionnée par le Mutualiste (ex: elle a été clôturée/archivée très récemment, ou il y a une erreur de données).
        -   6.a. Le système affiche un message d'erreur indiquant que la procédure n'a pas été trouvée ou n'est plus accessible. L'affichage peut revenir à la liste si elle existait.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données de la liquidation**
        -   ... (Étapes 1 à 3 ou Étapes 1 à 5 du scénario principal)
        -   4.e. / 6.e. Une erreur technique imprévue se produit lors de la tentative de récupération des informations de la/des procédure(s) de liquidation depuis la base de données.
        -   5.e. / 7.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. / 8.e. Le système affiche un message d'erreur générique au Mutualiste indiquant que les informations de ses liquidations n'ont pas pu être chargées pour le moment.

-   **Points à considérer pour la suite :**
    -   Quel est le niveau de détail des informations affichées au Mutualiste (comparé à l'Admin dans UC 33) ? Certaines informations internes ou techniques sont-elles masquées ?
    -   Est-il possible pour le Mutualiste de télécharger des documents liés à la liquidation (ex: le calcul final des droits, une confirmation de versement) ? (Nécessiterait des UC spécifiques de gestion de documents Mutualiste).
    -   Le Mutualiste peut-il uploader des documents demandés par la mutuelle via cette interface (ex: RIB, justificatifs) ? (Nécessiterait un UC "Uploader documents de liquidation (Mutualiste)").
    -   Y a-t-il une messagerie dédiée ou un moyen de communication direct avec l'admin gérant la liquidation depuis cette interface ? (Liaison potentielle avec UC 40 - Messagerie Interne).

---

### Module 11:Gestion des Prestations & Contrats

**UC 36 - Gérer les types de prestations/contrats**

-   **Module :** 11 - Gestion des Prestations & Contrats
-   **Acteur principal :** admin (ayant les droits de configuration)

-   **Description :** Permet à un admin de créer, consulter, modifier, activer ou désactiver les définitions des différents types de prestations (les services couverts par la mutuelle) et les modèles de contrats d'adhésion, ainsi que les règles financières et d'éligibilité qui y sont associées (ex: taux de remboursement, plafonds, conditions d'accès).

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits de configuration nécessaires pour gérer les prestations et les contrats.
    -   L'interface d'administration pour la gestion des prestations/contrats est accessible.
    -   (Pour modification/visualisation) Les types de prestations ou modèles de contrats existent déjà dans le système.

-   **Postconditions :**

    -   Un nouveau type de prestation ou modèle de contrat est créé, ou un type/modèle existant est mis à jour, activé ou désactivé dans le système.
    -   Les règles et paramètres associés aux prestations ou contrats sont enregistrés ou modifiés.
    -   Un enregistrement d'audit est créé pour les actions de configuration (qui, quand, quoi - création/modification/statut, sur quelle prestation/quel contrat).
    -   Les modifications de règles prennent effet pour les nouvelles opérations (prises en charge, adhésions) ou selon la politique de mise à jour des contrats existants.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de configuration ou de gestion des prestations et contrats.
    2.  Le système affiche une interface listant les types de prestations définis et/ou les modèles de contrats existants. Pour chaque élément, des informations de résumé sont présentées (Nom, Statut, Description courte, etc.). Des options "Créer", "Visualiser", "Modifier", "Activer/Désactiver" sont disponibles.

    -   **Sous-Scénario Principal A : Créer un nouveau type de prestation ou modèle de contrat**

        -   3a. L'admin clique sur l'option "Créer un type de prestation" ou "Créer un modèle de contrat".
        -   4a. Le système affiche un formulaire de saisie spécifique pour le type d'élément choisi (prestation ou contrat).
        -   5a. L'admin saisit les informations de base de l'élément (ex: Nom/Libellé unique, Description détaillée, Type de prestation si applicable (ex: Soin médical, Funéraire, Éducation)).
        -   6a. L'admin définit les règles et paramètres associés à cet élément :
            _ **Pour un type de Prestation :** Règles de couverture (taux de remboursement (%), montants fixes), plafonds (annuel, par acte, par bénéficiaire), conditions d'éligibilité (statut adhérent, ancienneté, âge bénéficiaire), documents requis pour une prise en charge liée, etc.
            _ **Pour un Modèle de Contrat :** Liste des prestations incluses dans ce contrat, montant de la cotisation associée, règles spécifiques au contrat, éligibilité du mutualiste principal à ce type de contrat, éligibilité des ayants droit sous ce contrat.
        -   7a. L'admin définit un statut initial (ex: "Actif", "Inactif", "Brouillon").
        -   8a. L'admin vérifie les informations et règles configurées.
        -   9a. L'admin clique sur le bouton "Enregistrer" ou "Créer".
        -   10a. Le système valide les données saisies (unicité du nom/libellé, formats des valeurs, cohérence des règles).
        -   11a. Si les validations réussissent, le système crée le nouvel enregistrement de prestation ou de modèle de contrat avec toutes ses règles et paramètres associés.
        -   12a. Le système enregistre l'historique de cette création de configuration.
        -   13a. Le système affiche un message de confirmation à l'admin et met à jour la liste affichée.

    -   **Sous-Scénario Principal M : Visualiser / Modifier un type de prestation ou modèle de contrat existant**

        -   3m. L'admin sélectionne un type de prestation ou modèle de contrat dans la liste (clique sur son nom ou un bouton "Visualiser/Modifier").
        -   4m. Le système affiche les informations et règles configurées pour l'élément sélectionné dans un formulaire éditable (similaire à 4a-6a mais pré-rempli).
        -   5m. L'admin visualise les informations et peut modifier les champs autorisés (certains champs clés comme le Libellé ou Type pourraient être non modifiables une fois créés).
        -   6m. L'admin peut mettre à jour les règles et paramètres associés.
        -   7m. L'admin peut changer le statut (ex: passer de Actif à Inactif, ou Inactif à Actif).
        -   8m. L'admin vérifie les modifications apportées.
        -   9m. L'admin clique sur le bouton "Enregistrer les modifications".
        -   10m. Le système valide les données et règles modifiées.
        -   11m. Si les validations réussissent, le système met à jour l'enregistrement de la prestation/du contrat et ses règles.
        -   12m. Le système enregistre l'historique de cette modification de configuration.
        -   13m. Le système affiche un message de confirmation et met à jour la liste affichée.

    -   **Sous-Scénario Principal S : Activer / Désactiver rapidement depuis la liste**
        -   3s. Dans la liste, l'admin clique sur une action rapide "Activer" ou "Désactiver" associée à un élément.
        -   4s. Le système peut demander une confirmation de l'action.
        -   5s. L'admin confirme.
        -   6s. Le système change le statut de l'élément (de Actif à Inactif ou inversement).
        -   7s. Le système vérifie si ce changement de statut a des implications critiques (ex: désactiver un contrat modèle auquel sont liés de nombreux adhérents). Il - peut bloquer l'action ou afficher un avertissement (voir Alternatif A3).
        -   8s. Si l'action est permise, le système met à jour le statut.
        -   9s. Le système enregistre l'historique du changement de statut rapide.
        -   10s. Le système affiche un message de confirmation et met à jour la liste affichée.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'opération**

        -   Applicable aux sous-scénarios A et M (avant validation) ou S (avant confirmation).
        -   L'admin annule l'action. Le système abandonne l'opération en cours.

    -   **Scénario Alternatif A2 : Données ou règles invalides (Créer ou Modifier)**

        -   Applicable aux sous-scénarios A (étape 10a) et M (étape 10m).
        -   La validation des données ou des règles échoue. Le système affiche des messages d'erreur spécifiques à côté des champs ou règles concernés. L'admin reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A3 : Tentative de désactiver un élément lié ou en usage critique**

        -   Applicable aux sous-scénarios M (étape 11m) ou S (étape 7s).
        -   Le système détecte que l'élément que l'on tente de désactiver est essentiel pour le bon fonctionnement d'autres parties du système ou est activement utilisé par des adhérents/processus (ex: désactiver un contrat modèle avec des adhérents actifs, désactiver une prestation utilisée dans des règles de prise en charge automatiques).
        -   Le système bloque la désactivation ou affiche un avertissement sévère, expliquant la dépendance et demandant une confirmation explicite ou une action préalable (ex: "Veuillez transférer les adhérents de ce contrat modèle avant de le désactiver").

    -   **Scénario Alternatif A4 : Création d'un élément avec un identifiant (Nom/Code) existant**

        -   Applicable au sous-scénario A (étape 10a).
        -   Le système valide le nouvel élément et constate qu'un élément du même type avec le même Nom ou un code unique similaire existe déjà.
        -   Le système affiche un message d'erreur indiquant que l'identifiant est déjà utilisé et demande à l'admin d'en choisir un autre.

    -   **Scénario d'Exception E1 : Élément (Prestation/Contrat) introuvable (Visualiser/Modifier/Activer/Désactiver)**

        -   Applicable aux sous-scénarios M (étape 4m) et S (étape 6s).
        -   Le système ne trouve pas l'élément sélectionné (potentiellement supprimé par un autre admin juste avant, ou erreur de référence). Le système affiche un message d'erreur. L'opération ne peut pas se poursuivre pour cet élément.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement ou la mise à jour**
        -   Applicable aux sous-scénarios A (étape 11a), M (étape 11m) et S (étape 8s).
        -   Une erreur technique imprévue se produit lors de la tentative de sauvegarde ou de mise à jour de l'enregistrement de configuration dans la base de données.
        -   Le système enregistre l'erreur technique. Le système affiche un message générique d'échec à l'admin. La configuration n'est pas enregistrée ou mise à jour.

-   **Points à considérer pour la suite :**
    -   Comment les règles complexes (conditions multiples, calculs) sont-elles définies dans l'interface ?
    -   Y a-t-il une gestion des versions de contrats ? (Ex: Un contrat évolue au 01/01/2025, les anciens adhérents gardent l'ancienne version ou sont-ils migrés ?).
    -   Comment ce module s'intègre-t-il avec l'UC 28 (Créer une prise en charge) pour le calcul automatique du montant pris en charge en fonction de la prestation et du contrat de l'adhérent ?
    -   Les modifications de règles ont-elles un impact immédiat ou différé sur les adhérents ou les prises en charge ?
    -   Faut-il une gestion des périodes de validité pour les prestations ou les règles ?

---

**UC 37 - Associer prestations/contrat à un mutualiste**

-   **Module :** 11 - Gestion des Prestations & Contrats
-   **Acteur principal :** admin

-   **Description :** Permet à un admin d'associer un modèle de contrat (préalablement défini via UC 36) à un mutualiste spécifique. Cette association détermine l'ensemble des prestations, garanties et règles (ex: taux de couverture, plafonds) dont bénéficie le mutualiste et ses ayants droit, ainsi que ses obligations (cotisations).

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour gérer les contrats des adhérents.
    -   Le mutualiste concerné existe dans le système et est identifiable.
    -   Le modèle de contrat à associer a été créé et est actif dans le système (UC 36 réussi avec statut Actif).
    -   (Optionnel) Le mutualiste remplit les critères d'éligibilité pour le modèle de contrat sélectionné.

-   **Postconditions :**

    -   Le modèle de contrat sélectionné est associé au mutualiste dans la base de données.
    -   Le mutualiste (et potentiellement ses ayants droit rattachés) devient éligible aux prestations définies dans ce contrat, selon les conditions associées.
    -   Un enregistrement d'audit est créé pour l'association du contrat (qui, quand, à qui, quel contrat, date de début).
    -   (Optionnel) Le système met à jour ou enregistre le montant de la cotisation due par ce mutualiste en fonction du contrat.
    -   (Optionnel) Une notification est envoyée au mutualiste pour l'informer de son contrat et des prestations.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des adhérents (Module 2) ou une section spécifique pour la gestion des contrats adhérents.
    2.  L'admin recherche ou sélectionne le mutualiste auquel il souhaite associer un contrat.
    3.  Le système affiche le dossier du mutualiste et une interface pour gérer son contrat ou ses prestations.
    4.  Le système peut afficher le contrat actuellement associé au mutualiste (si applicable et s'il est configuré pour gérer un historique ou une transition).
    5.  L'admin sélectionne l'option pour associer un nouveau contrat (ou modifier le contrat existant/précédent).
    6.  Le système affiche une liste des modèles de contrats disponibles et actifs (gérés via UC 36).
    7.  L'admin choisit le modèle de contrat à associer au mutualiste.
    8.  L'admin spécifie potentiellement la date de début de validité de ce contrat pour ce mutualiste (si différente de la date du jour).
    9.  L'admin vérifie l'association et clique sur un bouton "Enregistrer" ou "Associer le contrat".
    10. Le système valide l'association : vérifie que le modèle de contrat existe et est actif, et si applicable, vérifie l'éligibilité du mutualiste à ce contrat selon les règles (UC 36). Il peut aussi vérifier la cohérence si le mutualiste a déjà un contrat (ex: ne permet qu'un contrat actif à la fois).
    11. Si les validations réussissent, le système enregistre dans la base de données le lien entre le mutualiste et le modèle de contrat, avec la date de début de validité.
    12. Le système met à jour le statut du mutualiste si l'association d'un contrat actif le requiert.
    13. Le système enregistre l'historique de cette association de contrat.
    14. Le système affiche un message de confirmation à l'admin.
    15. (Optionnel) Le système déclenche la mise à jour du calcul des cotisations futures dues par le mutualiste, basées sur ce nouveau contrat (Module 5).
    16. (Optionnel) Le système génère et envoie une notification au mutualiste pour l'informer que le contrat [Nom du Contrat] lui est désormais associé et lui donner accès (lien vers UC 38) à la liste des prestations incluses.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation par l'admin**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.a. L'admin décide d'annuler l'opération.
        -   11.a. L'admin clique sur "Annuler".
        -   12.a. Le système abandonne le processus.

    -   **Scénario Alternatif A2 : Modèle de contrat sélectionné introuvable ou inactif**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. Le système vérifie le modèle sélectionné et constate qu'il n'existe pas, est inactif, ou n'est pas un modèle valide pour l'association.
        -   9.a. Le système affiche un message d'erreur à l'admin. L'association échoue.

    -   **Scénario Alternatif A3 : Mutualiste non éligible au modèle de contrat sélectionné**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.a. Le système effectue la vérification d'éligibilité spécifique au contrat et constate que le mutualiste ne remplit pas les critères (ex: âge, statut actuel, ancienneté).
        -   12.a. Le système affiche un message d'erreur expliquant pourquoi le mutualiste n'est pas éligible à ce contrat. L'association n'est pas permise.

    -   **Scénario Alternatif A4 : Le mutualiste a déjà un contrat actif (si les règles l'interdisent ou nécessitent un workflow)**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.a. Le système détecte un conflit avec un contrat déjà actif pour ce mutualiste (si les règles métier interdisent plusieurs contrats ou nécessitent une procédure spécifique de résiliation de l'ancien).
        -   12.a. Le système affiche un message d'avertissement ou d'erreur (ex: "Le mutualiste a déjà un contrat actif. Voulez-vous résilier l'ancien à partir du [Date] ?"). L'association peut être bloquée ou nécessiter une action supplémentaire de l'admin.

    -   **Scénario d'Exception E1 : Mutualiste introuvable lors de la sélection**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Le mutualiste recherché ou sélectionné n'est pas trouvé.
        -   5.e. Le système affiche un message d'erreur. L'opération ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement de l'association**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde du lien mutualiste-contrat.
        -   13.e. Le système enregistre l'erreur technique dans ses logs.
        -   14.e. Le système affiche un message d'erreur générique à l'admin indiquant que l'association a échoué.

    -   **Scénario d'Exception E3 : Échec de la mise à jour des cotisations ou de l'envoi notification**
        -   ... (Étapes 1 à 16 du scénario principal)
        -   17.e. Le système rencontre une erreur lors de la mise à jour automatique des cotisations ou de l'envoi de la notification.
        -   18.e. Le système enregistre l'échec. L'association du contrat est faite, mais l'admin est averti du problème dans les étapes post-enregistrement, nécessitant potentiellement une action manuelle (ex: recalculer les cotisations, envoyer la notification manuellement).

-   **Points à considérer pour la suite :**
    -   Comment le système gère-t-il l'historique des contrats d'un mutualiste s'ils changent de modèle au fil du temps ?
    -   Les règles d'éligibilité pour les contrats (étape 10) sont-elles complexes et automatisées, ou s'agit-il d'une vérification manuelle par l'Admin ?
    -   Est-il possible d'ajouter ou retirer des prestations individuelles à un mutualiste en dehors de son contrat modèle principal ? (Si oui, cela nécessiterait des UC spécifiques pour "Gérer prestations individuelles Adhérent").
    -   Comment les dates de début et de fin de couverture pour un contrat sont-elles gérées ?
    -   Le système gère-t-il les avenants ou les modifications spécifiques à un contrat individuel d'adhérent ?

---

**UC 38 - Consulter la liste des prestations incluses dans son contrat**

-   **Module :** 11 - Gestion des Prestations & Contrats
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de visualiser l'ensemble des services et bénéfices (prestations) auxquels lui et ses ayants droit sont éligibles. Cette liste est déterminée par le modèle de contrat qui lui a été associé par la mutuelle.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Un modèle de contrat valide et actif est associé au mutualiste dans le système (UC 37 réussi).
    -   Le modèle de contrat associé inclut des prestations définies (UC 36 réussi).
    -   Le mutualiste a accès à la section de son espace personnel où sont affichées les informations relatives à son contrat et ses prestations.

-   **Postconditions :**

    -   Le mutualiste a consulté la liste des prestations couvertes par son contrat. Aucune modification de données n'est effectuée.
    -   La liste des prestations est affichée à l'écran du mutualiste.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue dans le menu de son espace personnel vers la section "Mon Contrat", "Mes Prestations", "Mes Garanties", ou une zone affichant les détails de son contrat.
    3.  Le système identifie le Mutualiste authentifié et récupère le modèle de contrat qui lui est actuellement associé.
    4.  Le système récupère la liste des prestations qui sont configurées pour être incluses dans ce modèle de contrat spécifique (informations issues de la configuration UC 36).
    5.  Le système affiche la liste des prestations incluses dans le contrat du Mutualiste. Pour chaque prestation listée, des informations pertinentes pour l'adhérent sont présentées, comme :
        -   Le nom/libellé de la prestation (ex: Consultation médicale, Frais pharmaceutiques, Prise en charge obsèques).
        -   Une description sommaire de la prestation.
        -   Les conditions principales de couverture (ex: Taux de remboursement (%), Plafond annuel, Franchise applicable).
        -   Qui est éligible (le Mutualiste principal uniquement, les ayants droit, certaines catégories d'ayants droit).
        -   (Optionnel) Les documents typiquement requis pour une demande de prise en charge liée à cette prestation.
    6.  Le Mutualiste consulte la liste des prestations affichée à l'écran.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucun contrat actif associé au mutualiste**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système vérifie le contrat associé au Mutualiste et constate qu'aucun contrat actif n'est trouvé.
        -   5.a. Le système affiche un message indiquant "Aucun contrat actif n'est associé à votre compte. Veuillez contacter la mutuelle pour régulariser votre situation." ou "Vos prestations ne sont pas disponibles car votre contrat n'est pas actif."
        -   6.a. Le Mutualiste prend connaissance de l'information. L'opération s'arrête.

    -   **Scénario Alternatif A2 : Le contrat associé n'inclut aucune prestation définie**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.a. Le système récupère le contrat associé mais constate que ce modèle de contrat ne contient aucune prestation définie comme incluse (cela peut être une erreur de configuration administrative, ou un contrat spécifique sans prestations directes).
        -   6.a. Le système affiche un message indiquant "Aucune prestation n'est définie pour votre contrat actuel" ou présente une liste vide de prestations avec cette indication.
        -   7.a. Le Mutualiste prend connaissance de l'information. L'opération s'arrête.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données**
        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Une erreur technique imprévue se produit lors de la tentative de récupérer les informations du contrat ou la liste des prestations associées depuis la base de données.
        -   6.e. Le système enregistre l'erreur technique dans ses journaux.
        -   7.e. Le système affiche un message d'erreur générique au Mutualiste indiquant que la liste de ses prestations n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Quel est le niveau de détail précis affiché pour chaque prestation ? Faut-il afficher toutes les règles (plafonds, conditions spécifiques) ou seulement un résumé ?
    -   Est-il possible pour le Mutualiste de cliquer sur une prestation de la liste pour voir une description encore plus détaillée ou les conditions d'éligibilité et de remboursement spécifiques à cette prestation ? (Ce serait un cas d'utilisation distinct "Consulter détails d'une prestation").
    -   Comment sont affichées les prestations dont l'éligibilité dépend du Mutualiste _et_ de l'ayant droit (ex: maternité uniquement pour l'épouse) ?
    -   Est-il possible de filtrer ou rechercher des prestations dans la liste si elle est longue ?
    -   Cette vue inclut-elle des informations sur les exclusions ou les délais de carence ?

---

### Module 12: Gestion des Prêts de Matériels

**UC 39 - Enregistrer un prêt de matériel**

-   **Module :** 12 - Gestion des Prêts de Matériels
-   **Acteur principal :** admin

-   **Description :** Permet à un admin d'officialiser et d'enregistrer dans le système le prêt d'un matériel spécifique (ex: équipement médical, autre bien) de l'inventaire de la mutuelle à un mutualiste, en documentant les termes du prêt (qui, quoi, quand, retour prévu).

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour gérer les prêts et l'inventaire du matériel.
    -   Le mutualiste bénéficiaire du prêt existe dans le système et est identifiable.
    -   Le matériel spécifique à prêter existe dans l'inventaire géré par le système (potentiellement via un module d'inventaire distinct) et a un statut indiquant qu'il est disponible pour le prêt.
    -   (Optionnel) Le mutualiste remplit les conditions d'éligibilité pour emprunter ce type de matériel.

-   **Postconditions :**

    -   Un nouvel enregistrement de prêt de matériel est créé dans la base de données, associant le mutualiste au matériel prêté.
    -   Les informations du prêt (matériel, mutualiste, date de prêt, date de retour prévue) sont enregistrées.
    -   Le statut du matériel prêté est mis à jour dans le système d'inventaire (si intégré) pour refléter sa disponibilité (ex: "Prêté").
    -   Un enregistrement d'audit est créé pour ce prêt de matériel (qui, quand, quel matériel, à qui, pour quelle durée).
    -   (Optionnel) Une notification est envoyée au mutualiste confirmant les détails du prêt.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des prêts de matériel (ou la gestion de l'inventaire matériel avec option de prêt).
    2.  L'admin clique sur l'option "Enregistrer un prêt de matériel".
    3.  Le système affiche un formulaire de saisie pour les informations du prêt de matériel.
    4.  L'admin recherche et sélectionne le mutualiste qui emprunte le matériel.
    5.  L'admin recherche et sélectionne le matériel spécifique à prêter dans l'inventaire (ex: en scannant un code-barres, en cherchant par nom ou référence).
    6.  Le système affiche les informations du matériel sélectionné et vérifie son statut (doit être "Disponible"). Il peut aussi vérifier l'éligibilité du mutualiste à ce prêt.
    7.  L'admin saisit les dates clés du prêt :
        -   La date effective du prêt (date de remise du matériel, par défaut la date du jour).
        -   La date de retour prévue du matériel.
    8.  (Optionnel) L'admin saisit des informations supplémentaires (ex: motif du prêt, état visuel du matériel au départ, montant d'une éventuelle caution).
    9.  L'admin vérifie les informations saisies.
    10. L'admin clique sur un bouton "Enregistrer le prêt".
    11. Le système valide les données (champs obligatoires remplis, dates cohérentes, mutualiste et matériel valides et disponibles).
    12. Si les validations réussissent, le système crée un nouvel enregistrement de prêt de matériel, le lie au mutualiste et au matériel spécifique.
    13. Le système met à jour le statut du matériel prêté dans le module d'inventaire intégré (ex: passe de "Disponible" à "Prêté au mutualiste [Nom]").
    14. Le système enregistre l'historique de ce prêt de matériel.
    15. Le système affiche un message de confirmation à l'admin (ex: "Prêt de matériel enregistré avec succès. Le statut de [Nom Matériel] a été mis à jour.").
    16. (Optionnel) Le système génère et envoie une notification (email, SMS) au mutualiste pour confirmer le prêt, le matériel emprunté et la date de retour prévue.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation par l'admin**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.a. L'admin décide d'annuler l'opération.
        -   12.a. L'admin clique sur "Annuler".
        -   13.a. Le système abandonne le processus.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.a. Le système valide les données et détecte des erreurs (ex: champ obligatoire vide, date de retour prévue antérieure à la date de prêt).
        -   13.a. Le système affiche des messages d'erreur. L'admin reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A3 : Matériel sélectionné introuvable ou indisponible pour le prêt**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système vérifie le matériel sélectionné et constate qu'il n'existe pas ou que son statut actuel n'est pas "Disponible" (ex: "Prêté", "En réparation", "Perdu").
        -   8.a. Le système affiche un message d'erreur à l'admin expliquant la raison (ex: "Ce matériel est déjà prêté jusqu'au [Date de retour prévue]"). L'opération est stoppée.

    -   **Scénario Alternatif A4 : Mutualiste non éligible à emprunter ce matériel**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système effectue une vérification d'éligibilité du mutualiste pour ce type de matériel (basée sur son statut, son historique de prêts, son contrat) et constate qu'il ne remplit pas les conditions.
        -   8.a. Le système affiche un message d'erreur à l'admin expliquant la raison. L'opération est stoppée.

    -   **Scénario d'Exception E1 : Mutualiste introuvable lors de la sélection**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Le mutualiste recherché ou sélectionné n'est pas trouvé.
        -   6.e. Le système affiche un message d'erreur. L'opération ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement du prêt ou de la mise à jour du statut matériel**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde de l'enregistrement du prêt ou de la mise à jour du statut du matériel associé dans la base de données/inventaire.
        -   13.e. Le système enregistre l'erreur technique dans ses logs.
        -   14.e. Le système affiche un message d'erreur générique à l'admin indiquant que l'enregistrement du prêt a échoué.

    -   **Scénario d'Exception E3 : Échec de l'envoi de la notification au mutualiste**
        -   ... (Étapes 1 à 16 du scénario principal)
        -   17.e. Le système rencontre une erreur lors de la tentative d'envoi de la notification au mutualiste.
        -   18.e. Le système enregistre l'échec. Le prêt est enregistré, mais l'admin est averti que la notification n'a pas pu être envoyée.

-   **Points à considérer pour la suite :**
    -   Comment le système d'inventaire du matériel est-il géré (Ajout/Modification/Consultation matériel) ? (Nécessiterait des UC spécifiques dans ce module ou un autre).
    -   Comment le retour du matériel est-il enregistré ? (Nécessiterait un UC "Enregistrer retour matériel (Admin)").
    -   Comment les retards de retour sont-ils suivis et gérés (rappels, pénalités) ?
    -   Comment l'état du matériel (bon état, endommagé) est-il documenté au départ et au retour ?
    -   Le mutualiste peut-il voir le matériel qu'il a emprunté et la date de retour prévue (UC Mutualiste) ?

---

**UC 40 - Visualiser l'état des prêts de matériels**

-   **Module :** 12 - Gestion des Prêts de Matériels
-   **Acteur principal :** admin

-   **Description :** Permet à un admin de consulter une liste récapitulative de tous les matériels appartenant à la mutuelle qui sont actuellement prêtés à des mutualistes. Cette liste affiche les informations essentielles de chaque prêt en cours pour faciliter le suivi de l'inventaire et des retours attendus.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour consulter les informations relatives aux prêts de matériel.
    -   Le système contient des enregistrements de prêts de matériel ayant un statut "Prêté" ou équivalent.

-   **Postconditions :**

    -   L'admin a consulté la liste des matériels actuellement prêtés. Aucune modification de données n'est effectuée par ce cas d'utilisation.
    -   La liste des prêts de matériel actifs est affichée à l'écran de l'admin.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des prêts de matériel ou d'inventaire.
    2.  L'admin accède à la vue ou au rapport affichant la liste des matériels actuellement prêtés (ex: un onglet "Matériels prêtés", un rapport sur le tableau de bord (UC 51), ou un filtre appliqué à la liste générale de l'inventaire).
    3.  Le système interroge la base de données pour récupérer tous les enregistrements de prêts de matériel dont la date de retour effective est encore vide ou dont le statut est "Prêté".
    4.  Le système affiche la liste des prêts de matériel actifs. Chaque ligne de la liste représente un matériel prêté et présente des informations clés, telles que :
        -   Le nom ou la référence du matériel spécifique (potentiellement son numéro de série).
        -   Le nom du mutualiste emprunteur (avec un lien vers son dossier si possible).
        -   La date à laquelle le matériel a été prêté (date de début du prêt).
        -   La date de retour prévue.
        -   Le nombre de jours/semaines/mois de prêt écoulés.
        -   Un indicateur visuel clair si la date de retour prévue est dépassée (matériel en retard).
        -   (Optionnel) Le motif du prêt.
    5.  L'admin consulte la liste affichée pour visualiser l'état des prêts en cours.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucun matériel actuellement prêté**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucun enregistrement de prêt de matériel actif.
        -   5.a. Le système affiche un message indiquant "Aucun matériel n'est actuellement prêté à des mutualistes" ou présente une liste vide avec cette indication.
        -   6.a. L'admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération de la liste des prêts actifs**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données des prêts de matériel actifs depuis la base de données.
        -   5.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. Le système affiche un message d'erreur générique à l'admin l'informant que la liste des prêts actifs n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles informations exactes sont les plus pertinentes pour le suivi quotidien du matériel prêté ?
    -   Des options de filtrage (par type de matériel, par mutualiste, par date de retour prévue - notamment pour voir les retards) et de tri sont-elles nécessaires pour cette liste ?
    -   Y a-t-il une pagination si le volume de matériel prêté est important ?
    -   En cliquant sur un élément de la liste, l'admin peut-il accéder directement à l'enregistrement de prêt spécifique (potentiellement pour marquer son retour - UC "Enregistrer retour matériel") ou au dossier du mutualiste emprunteur ?
    -   Existe-t-il des indicateurs visuels ou des alertes pour les prêts de matériel en retard ?

---

**UC 41 - Visualiser les matériels qu'il a empruntés**

-   **Module :** 12 - Gestion des Prêts de Matériels
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de consulter, via son espace personnel, la liste des matériels appartenant à la mutuelle qui lui ont été prêtés et dont le retour n'a pas encore été enregistré. Il peut ainsi suivre ses emprunts en cours et connaître les dates de retour prévues.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le système a enregistré au moins un prêt de matériel actif (non retourné) associé à ce mutualiste (UC 39 réussi et retour non enregistré).
    -   Le mutualiste a accès à la section de son espace personnel où sont affichées les informations relatives à ses prêts de matériel.
    -   Le statut du mutualiste permet la consultation de ces informations.

-   **Postconditions :**

    -   Le mutualiste a consulté la liste des matériels qu'il a actuellement empruntés. Aucune modification de données n'est effectuée.
    -   La liste des prêts de matériel actifs le concernant est affichée à l'écran du mutualiste.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue dans le menu de son espace personnel vers la section "Mes Emprunts de Matériel", "Matériels Prêtés", ou similaire. Il peut également y accéder via un lien sur son tableau de bord (UC 52) si des emprunts sont en cours.
    3.  Le système interroge la base de données pour récupérer tous les enregistrements de prêts de matériel qui sont associés au Mutualiste authentifié et dont le retour n'a pas été enregistré.
    4.  Le système affiche la liste des matériels actuellement empruntés par le Mutualiste. Chaque élément de la liste inclut des informations clés, telles que :
        -   Le nom ou la référence du matériel emprunté (ex: "Fauteuil Roulant #123").
        -   La date à laquelle le matériel a été emprunté.
        -   La date de retour prévue.
        -   (Optionnel) Une indication visuelle si la date de retour prévue est dépassée.
        -   (Optionnel) L'état visuel du matériel au moment du prêt (si documenté).
        -   (Optionnel) Des instructions ou un contact pour organiser le retour du matériel.
    5.  Le Mutualiste consulte la liste affichée à l'écran pour suivre ses emprunts.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucun matériel actuellement emprunté par ce mutualiste**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucun enregistrement de prêt de matériel actif associé à ce Mutualiste.
        -   5.a. Le système affiche un message indiquant "Vous n'avez actuellement aucun matériel emprunté auprès de la mutuelle" ou présente une liste vide avec cette indication.
        -   6.a. Le Mutualiste prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération de la liste des prêts de matériel**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données des prêts de matériel actifs pour ce Mutualiste.
        -   5.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. Le système affiche un message d'erreur générique au Mutualiste l'informant que la liste de ses emprunts n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles informations spécifiques sur le matériel (au-delà du nom) sont pertinentes pour le Mutualiste dans cette vue ?
    -   Le Mutualiste peut-il voir l'historique de _tous_ ses prêts de matériel passés (y compris ceux déjà retournés) ? (Nécessiterait un UC distinct "Visualiser historique prêts matériel passés (Mutualiste)").
    -   Le Mutualiste peut-il initier une demande de prêt de matériel via son espace (ce serait un autre UC "Demander un prêt de matériel (Mutualiste)") ?
    -   Y a-t-il une fonctionnalité pour demander une prolongation de la date de retour prévue depuis cette vue ? (Nécessiterait un UC dédié avec validation Admin).

---

### Module 13: Gestion des Réclamations & Litiges

**UC 42 - Soumettre une réclamation**

-   **Module :** 13 - Gestion des Réclamations & Litiges
-   **Acteur principal :** Mutualiste

-   **Description :** Permet à un mutualiste d'ouvrir un nouveau dossier de réclamation ou de litige auprès de la mutuelle via son espace personnel. Il décrit le sujet de sa réclamation, fournit les détails pertinents et peut joindre des documents justificatifs.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le mutualiste a accès à la section de son espace personnel dédiée aux réclamations ou à l'assistance.
    -   Le mutualiste a un sujet précis pour sa réclamation et dispose des informations nécessaires pour la décrire.

-   **Postconditions :**

    -   Un nouvel enregistrement de réclamation est créé dans le système et associé au mutualiste.
    -   Les détails de la réclamation (sujet/motif, description, date, éventuels documents joints) sont enregistrés.
    -   Un statut initial (ex: "Soumise", "En attente de prise en charge") est attribué à la réclamation.
    -   Un numéro de référence unique est attribué à la réclamation.
    -   Un enregistrement d'audit est créé pour la soumission (qui, quand, type de réclamation).
    -   Une notification de réception est envoyée automatiquement au mutualiste.
    -   La réclamation est signalée aux admins concernés pour traitement (ex: ajout à une liste de tâches, notification interne).

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue vers la section "Mes Réclamations", "Support", "Assistance", "Soumettre un Litige", ou une zone similaire dans son espace personnel.
    3.  Le système affiche une page avec une option pour soumettre une nouvelle réclamation et/ou la liste des réclamations déjà soumises (UC 44 implicite). Le Mutualiste choisit de soumettre une nouvelle réclamation.
    4.  Le système affiche un formulaire de soumission de réclamation.
    5.  Le Mutualiste sélectionne la catégorie ou le motif de sa réclamation (ex: Problème Cotisation, Problème Prise en Charge, Erreur administrative, Suggestion/Satisfaction, Autre) dans une liste déroulante si elle est proposée.
    6.  Le Mutualiste rédige une description détaillée du problème ou de sa demande dans un champ texte.
    7.  Le Mutualiste fournit toute information complémentaire requise ou pertinente (ex: références de dossier, dates, montants, noms de personnes concernées).
    8.  (Optionnel) Le Mutualiste clique sur une option pour joindre des documents (ex: facture scannée, capture d'écran, email). Le système permet le téléchargement d'un ou plusieurs fichiers.
    9.  Le Mutualiste vérifie l'ensemble des informations saisies dans le formulaire.
    10. Le Mutualiste clique sur un bouton "Soumettre", "Envoyer ma réclamation", ou similaire.
    11. Le système valide les données saisies (champs obligatoires non vides, formats valides).
    12. Si les validations réussissent, le système crée un nouvel enregistrement pour la réclamation dans la base de données.
    13. Le système génère et attribue un numéro de référence unique à la réclamation.
    14. Le système associe les documents téléchargés (si applicable) à l'enregistrement de la réclamation.
    15. Le système attribue le statut initial "Soumise" ou "En attente" à la réclamation.
    16. Le système enregistre l'historique de cette soumission de réclamation (date, heure, mutualiste, type, numéro de référence).
    17. Le système affiche un message de confirmation à l'écran du Mutualiste, indiquant que sa réclamation a bien été reçue et mentionnant le numéro de référence pour le suivi (ex: "Votre réclamation #[Référence] a bien été enregistrée. Nous vous répondrons dans les plus brefs délais.").
    18. Le système envoie une notification automatique (email ou message interne) au Mutualiste confirmant la soumission et rappelant la référence.
    19. Le système notifie les admins responsables des réclamations qu'une nouvelle réclamation a été soumise, potentiellement en l'ajoutant à une liste de tâches ou à un rapport sur le tableau de bord Admin (UC 51).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de la soumission par le Mutualiste**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.a. Le Mutualiste décide de ne pas soumettre la réclamation.
        -   11.a. Le Mutualiste clique sur "Annuler" ou quitte le formulaire.
        -   12.a. Le système abandonne l'opération.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.a. Le système valide les données et détecte que des champs obligatoires sont vides ou que les données ne respectent pas le format attendu.
        -   13.a. Le système affiche des messages d'erreur clairs à côté des champs concernés. Le Mutualiste reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A3 : Échec du téléchargement d'un ou plusieurs documents (si applicable)**

        -   ... (Étapes 1 à 8, puis tentative de téléchargement dans étape 11)
        -   12.a. Une erreur technique se produit pendant le téléchargement d'un document ou l'association du fichier à la réclamation (ex: fichier trop gros, format non autorisé, problème de connexion).
        -   13.a. Le système affiche un message d'erreur spécifique au téléchargement. Le système peut soit permettre la soumission de la réclamation sans le document échoué (avec un avertissement), soit bloquer la soumission jusqu'à ce que le problème de téléchargement soit résolu. Le scénario principal suppose le succès. Si l'échec bloque la soumission, revenir à l'étape 4 pour correction ou annulation.

    -   **Scénario d'Exception E1 : Erreur système lors de l'enregistrement de la réclamation**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde de l'enregistrement de la réclamation et des documents associés.
        -   13.e. Le système enregistre l'erreur technique dans ses logs.
        -   14.e. Le système affiche un message d'erreur générique au Mutualiste l'informant que sa réclamation n'a pas pu être soumise pour le moment. L'opération échoue.

    -   **Scénario d'Exception E2 : Échec de l'envoi de la notification automatique au Mutualiste**
        -   ... (Étapes 1 à 17 du scénario principal)
        -   18.e. Le système tente d'envoyer la notification de confirmation au Mutualiste, mais l'envoi échoue.
        -   19.e. Le système enregistre l'échec de la notification.
        -   20.e. La réclamation est bien enregistrée et soumise, mais le Mutualiste ne reçoit pas la confirmation automatique. Le système affiche quand même le message de succès à l'écran (étape 17).

-   **Points à considérer pour la suite :**
    -   Comment le système gère-t-il le _workflow_ de traitement de la réclamation par les admins après la soumission ? (Nécessiterait des UC Admin comme "Traiter une réclamation", "Mettre à jour statut réclamation", "Répondre à une réclamation").
    -   Les types/catégories de réclamations sont-ils configurables par les Admins ?
    -   Quelles sont les règles précises de gestion des documents joints (formats autorisés, taille limite, sécurité) ?
    -   Le mutualiste peut-il ajouter des informations ou des documents à une réclamation _après_ l'avoir soumise ? (Nécessiterait un UC "Modifier une réclamation soumise" ou "Ajouter document à réclamation").
    -   Le mutualiste peut-il suivre l'état de sa réclamation et lire les réponses de l'administration ? (UC 44).

---

**UC 43 - Traiter une réclamation**

-   **Module :** 13 - Gestion des Réclamations & Litiges
-   **Acteur principal :** admin (Gestionnaire Réclamations ou tout Admin désigné)

-   **Description :** Permet à un admin de prendre en charge, d'analyser, de mettre à jour le statut, d'ajouter des commentaires internes et de gérer globalement le processus de résolution d'une réclamation soumise par un mutualiste (UC 42).

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour accéder et traiter les réclamations.
    -   Une ou plusieurs réclamations ont été soumises par des mutualistes (UC 42 réussi) et sont enregistrées dans le système avec un statut nécessitant un traitement (ex: "Soumise", "En attente").
    -   L'admin a accès à l'interface listant les réclamations à traiter.

-   **Postconditions :**

    -   Le statut de la réclamation est mis à jour pour refléter l'avancement de son traitement.
    -   Des notes internes sont ajoutées à la réclamation par l'admin.
    -   La réclamation peut être assignée à un admin spécifique.
    -   Un historique détaillé du traitement (actions, dates, utilisateurs) est enregistré pour la réclamation.
    -   (Optionnel) Une notification est envoyée au mutualiste concernant le changement de statut.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section de gestion des réclamations (ou accède à la liste des réclamations sur son tableau de bord UC 51).
    2.  Le système affiche la liste des réclamations nécessitant une action (ex: statut "Soumise", "En cours", "Requiert attention"). La liste inclut des informations clés (référence, mutualiste, sujet, date de soumission).
    3.  L'admin sélectionne une réclamation spécifique dans la liste pour commencer son traitement (clique sur la référence, le mutualiste, ou un bouton "Traiter").
    4.  Le système affiche la vue détaillée de la réclamation, présentant toutes les informations saisies par le mutualiste (UC 42) : numéro de référence, mutualiste (avec lien vers son dossier UC 3), date de soumission, catégorie/motif, description complète, informations complémentaires. La liste des documents joints est également affichée avec des options de visualisation/téléchargement (UC 45 implicite).
    5.  L'admin examine attentivement les informations fournies par le mutualiste et visualise les documents joints.
    6.  L'admin effectue les actions nécessaires pour traiter la réclamation :
        -   **Consultation :** Analyse le problème, vérifie les informations dans d'autres modules (dossier mutualiste, cotisations, prêts, prises en charge...).
        -   **Mise à jour du statut :** Sélectionne un nouveau statut approprié dans une liste déroulante (ex: "En cours", "En attente d'informations du mutualiste", "Escaladée", "Résolue", "Refusée", "Clôturée").
        -   **Assignation :** S'assigne la réclamation ou la réassigne à un autre admin ou service si nécessaire.
        -   **Ajout de notes internes :** Saisit des commentaires, résumés d'investigation, décisions internes, ou actions effectuées (visibles uniquement par les admins).
        -   **Interaction :** (Potentiellement via d'autres UC) préparer une réponse au mutualiste, demander des informations complémentaires, lier la réclamation à un autre dossier (ex: une prise en charge spécifique).
    7.  L'admin enregistre les modifications et actions effectuées (clique sur un bouton "Enregistrer", "Mettre à jour le statut et ajouter note").
    8.  Le système valide les données soumises (nouveau statut valide, notes non vides si obligatoires, assignation valide).
    9.  Si les validations réussissent, le système met à jour l'enregistrement de la réclamation avec le nouveau statut, l'assignation et les notes internes. 10. Le système enregistre un événement dans l'historique de traitement de la réclamation (qui, quand, quel changement de statut, notes ajoutées, réassignation). 11. Le système affiche un message de confirmation à l'admin indiquant que la réclamation a été mise à jour. 12. (Optionnel) Si le changement de statut est configuré pour notifier le mutualiste (ex: passage à "En cours", "Résolue", "Refusée"), le système déclenche l'envoi d'une notification (via messagerie interne UC 40 / UC 50 ou email).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation des modifications par l'admin**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. L'admin décide de ne pas enregistrer les modifications en cours.
        -   9.a. L'admin clique sur un bouton "Annuler" ou quitte la page sans sauvegarder.
        -   10.a. Le système abandonne les modifications.

    -   **Scénario Alternatif A2 : Réclamation sélectionnée déjà traitée/mise à jour par un autre admin**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. L'admin sélectionne une réclamation, mais le système détecte qu'elle a été modifiée (statut, notes, assignation) par un autre admin depuis l'affichage de la liste.
        -   5.a. Le système peut afficher un message d'avertissement (ex: "Cette réclamation a été mise à jour récemment. Ses informations actuelles sont affichées.") et permettre de continuer, ou bloquer la modification pour éviter les conflits et demander à l'Admin de recharger la page.

    -   **Scénario Alternatif A3 : Transition de statut non autorisée ou données de mise à jour invalides**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système valide le nouveau statut ou les données soumises et constate une erreur (ex: statut non permis après le statut actuel, champ obligatoire pour un statut particulier non rempli, note interne vide si requise pour un statut comme "Refusée").
        -   10.a. Le système affiche un message d'erreur expliquant l'invalidité. Les modifications ne sont pas enregistrées. L'Admin reste sur la page pour corriger.

    -   **Scénario d'Exception E1 : Réclamation introuvable ou non accessible**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Le système ne trouve pas la réclamation sélectionnée (ex: référence invalide, la réclamation a été supprimée par erreur, ou l'Admin n'a pas les droits de la voir).
        -   5.e. Le système affiche un message d'erreur. Le traitement ne peut pas commencer.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement des modifications ou de l'historique**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde des mises à jour (statut, notes, assignation) ou de l'enregistrement de l'historique de traitement.
        -   12.e. Le système enregistre l'erreur technique dans ses logs.
        -   13.e. Le système affiche un message d'erreur générique à l'admin. Les modifications peuvent ne pas être enregistrées.

    -   **Scénario d'Exception E3 : Échec de l'envoi de la notification automatique au mutualiste (si déclenchée)**
        -   ... (Étapes 1 à 12 du scénario principal)
        -   13.e. Le système tente d'envoyer une notification au mutualiste suite au changement de statut (si configuré), mais l'envoi échoue.
        -   14.e. Le système enregistre l'échec de la notification. Le statut de la réclamation est bien mis à jour, mais l'admin est averti que la notification n'a pas pu être envoyée.

-   **Points à considérer pour la suite :**
    -   Quels sont les différents statuts possibles dans le workflow de traitement des réclamations ?
    -   Comment les réclamations sont-elles assignées (manuellement par un responsable, automatiquement par type/règles, auto-assignation par le premier Admin qui la prend) ?
    -   Comment les admins peuvent-ils communiquer _avec le mutualiste_ dans le cadre de cette réclamation (réponse formelle, demande d'infos) ? Est-ce via un système de messagerie intégré (lien avec UC 40/50) ou un autre moyen ?
    -   Le système permet-il de lier une réclamation à un autre dossier (mutualiste, prêt, prise en charge spécifique) pour un suivi plus efficace ?
    -   Y a-t-il des délais de traitement standards à suivre, et des indicateurs pour les réclamations en retard ? (Liaison potentielle avec UC 51 - Tableau de bord Admin).

---

**UC 44 - Visualiser l'historique de ses réclamations**

-   **Module :** 13 - Gestion des Réclamations & Litiges
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste d'accéder à la liste de toutes les réclamations qu'il a soumises via son espace personnel (UC 42), de consulter leur statut actuel et de visualiser l'historique des actions de traitement effectuées par l'administration.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le mutualiste a soumis au moins une réclamation via le système (UC 42 réussi).
    -   Le mutualiste a accès à la section de son espace personnel où cet historique est affiché (potentiellement sur le tableau de bord UC 52 ou une page dédiée).

-   **Postconditions :**

    -   Le mutualiste a consulté la liste et/ou les détails de ses réclamations soumises. Aucune modification de données n'est effectuée.
    -   La liste des réclamations soumises par le mutualiste est affichée à l'écran, avec leur statut et potentiellement un historique de suivi.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue dans le menu de son espace personnel vers la section "Mes Réclamations", "Suivi Réclamations", ou une zone similaire. Il peut également y accéder via un lien sur son tableau de bord (UC 52) si une réclamation récente ou en cours est signalée.
    3.  Le système interroge la base de données pour récupérer toutes les réclamations qui ont été soumises par le Mutualiste authentifié.
    4.  Le système affiche la liste des réclamations soumises. Chaque élément de la liste inclut des informations clés, généralement sous forme de tableau ou liste :
        -   Le numéro de référence unique de la réclamation.
        -   La date et l'heure de soumission.
        -   La catégorie ou le motif de la réclamation.
        -   Le statut actuel de la réclamation (utilisant une terminologie compréhensible pour le mutualiste, ex: "Soumise", "En cours de traitement", "En attente de votre réponse", "Résolue", "Clôturée", "Refusée").
        -   (Optionnel) Un court extrait de la description initiale.
        -   (Optionnel) Un indicateur visuel si la réclamation a été mise à jour ou nécessite une action du Mutualiste.
    5.  Le Mutualiste consulte la liste pour avoir un aperçu de ses réclamations.
    6.  Le Mutualiste sélectionne une réclamation spécifique dans la liste (clique sur la référence ou un bouton "Détails") pour en voir le détail et le suivi.
    7.  Le système affiche la vue détaillée de la réclamation. Cela inclut les informations saisies lors de la soumission (UC 42) ainsi que l'historique des changements de statut et des actions clés effectuées par l'administration (ex: "Soumise le [Date] - Statut Initial", "Prise en charge par l'administration le [Date] - Statut En cours", "Résolue le [Date]").
    8.  (Optionnel) Le système affiche les messages échangés avec l'administration concernant cette réclamation spécifique (s'il existe un système de messagerie lié - UC 50). 9. Le Mutualiste consulte les informations détaillées et l'historique de suivi de sa réclamation.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune réclamation soumise par ce mutualiste**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucune réclamation enregistrée et associée à ce Mutualiste.
        -   5.a. Le système affiche un message indiquant "Vous n'avez pas encore soumis de réclamation via cet espace" ou présente une liste vide avec cette indication.
        -   6.a. Le Mutualiste prend connaissance de l'information.

    -   **Scénario Alternatif A2 : Réclamation sélectionnée introuvable**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système ne parvient pas à trouver ou à charger les détails de la réclamation spécifique sélectionnée (ex: erreur interne, la réclamation a été archivée si non visible par défaut).
        -   8.a. Le système affiche un message d'erreur indiquant que la réclamation n'a pas été trouvée ou n'est pas accessible. L'affichage peut revenir à la liste des réclamations.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données (liste ou détails)**
        -   ... (Étapes 1 à 3 ou Étapes 1 à 6 du scénario principal)
        -   4.e. / 7.e. Une erreur technique imprévue se produit lors de la tentative de récupération de la liste des réclamations ou des détails de la réclamation sélectionnée depuis la base de données.
        -   5.e. / 8.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. / 9.e. Le système affiche un message d'erreur générique au Mutualiste indiquant que l'historique de ses réclamations ou les détails n'ont pas pu être chargés pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles informations (statuts, actions administratives) sont rendues visibles au mutualiste dans l'historique de traitement (étape 7) ? Faut-il masquer certaines notes internes de l'admin ?
    -   Comment le mutualiste peut-il consulter les documents qu'il a joints lors de la soumission (UC 45) ? Et les documents ajoutés par l'administration ?
    -   Le mutualiste peut-il répondre à l'administration via cette interface, ou ajouter des documents à une réclamation existante ? (Ce serait un cas d'utilisation distinct "Répondre à réclamation / Ajouter document (Mutualiste)").
    -   Si la réclamation est résolue, le mutualiste peut-il la marquer comme satisfaisante ou la rouvrir si nécessaire ?

---

**UC 45 - Visualiser les documents liés à une réclamation**

-   **Module :** 13 - Gestion des Réclamations & Litiges
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste de consulter la liste des documents (qu'il a joints lors de la soumission ou que l'administration a ajoutés et rendus visibles) associés à une réclamation spécifique qu'il a soumise. Le mutualiste peut également visualiser ou télécharger le contenu de ces documents.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le mutualiste a soumis au moins une réclamation (UC 42 réussi).
    -   La réclamation spécifique que le mutualiste souhaite consulter existe et a au moins un document qui lui est associé et qui est consultable par le mutualiste.
    -   Le mutualiste a accès à la vue détaillée de la réclamation concernée (via UC 44).

-   **Postconditions :**

    -   Le mutualiste a pu consulter la liste des documents associés à la réclamation sélectionnée.
    -   Le mutualiste a pu visualiser ou télécharger le contenu des documents sélectionnés.
    -   Aucune modification des données ou des documents n'est effectuée par ce cas d'utilisation.
    -   La liste des documents associés à la réclamation est affichée à l'écran.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue vers la section "Mes Réclamations" (UC 44) pour voir la liste de ses réclamations.
    3.  Le Mutualiste sélectionne la réclamation spécifique dont il souhaite visualiser les documents (en cliquant dessus pour accéder à sa vue détaillée, comme dans UC 44, étape 6).
    4.  Dans la vue détaillée de la réclamation, le Mutualiste accède à la section, l'onglet ou la zone affichant les "Documents", "Pièces Jointes", ou "Justificatifs" liés à cette réclamation.
    5.  Le système interroge la base de données et le système de gestion des fichiers pour récupérer la liste des documents qui sont associés à cette réclamation et qui sont configurés pour être visibles par le Mutualiste.
    6.  Le système affiche la liste des documents consultables. Pour chaque document, des informations clés sont présentées, comme :
        -   Le nom du fichier.
        -   Le type de document (ex: Facture, Pièce d'identité, Courrier de la mutuelle).
        -   La date d'ajout du document.
        -   L'origine du document (ex: "Ajouté par vous", "Ajouté par l'Administration").
    7.  Le Mutualiste consulte la liste des documents disponibles.
    8.  Le Mutualiste sélectionne un document spécifique dans la liste (ex: clique sur le nom du fichier ou une icône "Consulter/Télécharger").
    9.  Le système récupère le fichier du document sélectionné et vérifie que le Mutualiste a les droits de le consulter. 10. Le système permet au Mutualiste de visualiser le contenu du document (par exemple, en ouvrant une visionneuse intégrée dans le navigateur, ou en initiant un téléchargement du fichier). 11. Le Mutualiste examine le contenu du document.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune réclamation soumise ou réclamation sélectionnée introuvable (abordé par UC 44)** - Ces cas sont gérés avant d'atteindre la vue des documents.
    -   **Scénario Alternatif A2 : Aucun document associé à la réclamation ou aucun document consultable**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. Le système interroge la base de données/le système de fichiers mais ne trouve aucun document associé à cette réclamation, ou aucun des documents associés n'est configuré pour être visible par le Mutualiste.
        -   7.a. Le système affiche un message indiquant "Aucun document associé à cette réclamation" ou "Aucun document consultable pour le moment".
        -   8.a. Le Mutualiste prend connaissance de l'information. La visualisation des documents pour cette réclamation est terminée.

    -   **Scénario Alternatif A3 : Document sélectionné introuvable ou non accessible**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système tente de récupérer le fichier du document sélectionné, mais le fichier n'est pas trouvé à l'emplacement attendu, est corrompu, ou le document n'est plus accessible pour le Mutualiste (ex: permission retirée par l'Admin).
        -   10.a. Le système affiche un message d'erreur indiquant que le document n'a pas pu être chargé ou n'est pas accessible.
        -   11.a. Le Mutualiste ne peut pas consulter le document.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération de la liste des documents**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.e. Une erreur technique imprévue se produit lors de la tentative de récupérer la liste des documents associés depuis la base de données ou le système de fichiers.
        -   7.e. Le système enregistre l'erreur technique dans ses journaux.
        -   8.e. Le système affiche un message d'erreur générique au Mutualiste l'informant que la liste des documents n'a pas pu être chargée pour le moment.

    -   **Scénario d'Exception E2 : Erreur système lors de la tentative d'accès au fichier d'un document**
        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.e. Une erreur technique se produit lors de la tentative d'accéder au fichier physique du document sélectionné.
        -   10.e. Le système enregistre l'erreur technique dans ses journaux.
        -   11.e. Le système affiche un message d'erreur générique au Mutualiste, l'informant qu'une erreur s'est produite lors de l'ouverture du document.

-   **Points à considérer pour la suite :**
    -   Quels types de documents ajoutés par l'admin sont visibles par le Mutualiste ? (ex: uniquement les courriers officiels de réponse, pas les notes internes).
    -   Y a-t-il une gestion des versions de documents ?
    -   Le Mutualiste peut-il télécharger un reçu de soumission de réclamation ou un résumé du dossier depuis cette vue ?
    -   Le Mutualiste peut-il ajouter de nouveaux documents à une réclamation déjà soumise via cette interface ? (Nécessiterait un cas d'utilisation distinct "Ajouter document à réclamation (Mutualiste)").

---

### Module 14:Gestion de la Messagerie Interne

**UC 46 - Envoyer un message à l'administration**

-   **Module :** 14 - Gestion de la Messagerie Interne
-   **Acteur principal :** Mutualiste

-   **Description :** Permet à un mutualiste d'initier une nouvelle conversation ou d'envoyer un message électronique à l'administration de la mutuelle via le système de messagerie sécurisé intégré à son espace personnel.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le système de messagerie interne est activé et accessible pour les mutualistes et les admins.
    -   Le mutualiste a un sujet ou une question qu'il souhaite communiquer à l'administration.

-   **Postconditions :**

    -   Un nouveau message (ou une nouvelle conversation initiée par ce message) est créé dans le système de messagerie et associé au mutualiste expéditeur.
    -   Le message est acheminé vers la ou les boîtes de réception appropriées côté administration.
    -   Un enregistrement d'audit est créé pour l'envoi du message.
    -   Une notification est envoyée aux admins concernés par le nouveau message.
    -   (Optionnel) Une confirmation d'envoi est affichée ou envoyée au mutualiste.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue dans le menu de son espace personnel vers la section "Messagerie", "Mes Messages", "Contact", ou similaire.
    3.  Le système affiche l'interface de messagerie du Mutualiste, potentiellement avec la liste de ses conversations existantes (UC 50 implicite) et une option claire pour "Nouveau Message" ou "Écrire à l'administration". Le Mutualiste choisit cette option.
    4.  Le système affiche un formulaire de composition de message, similaire à un client de messagerie basique (champs pour Objet, Corps du message).
    5.  Le Mutualiste saisit un objet clair et concis pour son message.
    6.  Le Mutualiste rédige le corps de son message, expliquant sa question, sa demande, ou son commentaire.
    7.  (Optionnel) Le système peut proposer au Mutualiste de sélectionner le service ou le destinataire concerné (ex: Service Adhésions, Service Prêts, Service Cotisations) si la configuration le permet, pour un meilleur acheminement.
    8.  (Optionnel) Si la fonctionnalité est disponible, le Mutualiste peut joindre des documents pertinents à son message (ex: une capture d'écran, un document scanné) en utilisant une fonction de téléchargement de fichier.
    9.  Le Mutualiste relit l'objet et le corps de son message ainsi que les éventuelles pièces jointes.
    10. Le Mutualiste clique sur un bouton "Envoyer".
    11. Le système valide le message (vérifie que l'objet et le corps ne sont pas vides, formats de fichiers joints corrects si applicable).
    12. Si les validations réussissent, le système crée un nouvel enregistrement de message dans la base de données.
    13. Le message est associé au Mutualiste expéditeur et est marqué comme envoyé.
    14. Le système achemine le message vers la ou les boîtes de réception appropriées du côté administration (selon le destinataire sélectionné ou la configuration par défaut).
    15. Le système enregistre l'historique de l'envoi de ce message (expéditeur, destinataire, date, heure, sujet).
    16. Le système affiche un message de confirmation à l'écran du Mutualiste (ex: "Votre message a été envoyé avec succès à l'administration.").
    17. Le système déclenche une notification automatique pour les admins concernés les informant qu'un nouveau message a été reçu dans leur boîte de réception (UC 48 implicite).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'envoi par le Mutualiste**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.a. Le Mutualiste décide finalement de ne pas envoyer le message.
        -   12.a. Le Mutualiste clique sur un bouton "Annuler", "Fermer", ou quitte la page de composition sans sauvegarder.
        -   13.a. Le système abandonne le message en cours de composition.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées lors de la validation**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.a. Le système valide le message et constate que des informations essentielles sont manquantes (ex: l'objet ou le corps du message est vide).
        -   13.a. Le système affiche des messages d'erreur (ex: "Veuillez saisir un objet et un contenu pour votre message"). Le Mutualiste reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A3 : Échec du téléchargement ou validation d'un document joint (si applicable)**

        -   ... (Étapes 1 à 8, puis tentative de téléchargement dans étape 11)
        -   12.a. Une erreur technique se produit lors du téléchargement d'un fichier joint, ou le fichier ne respecte pas les règles (ex: trop volumineux, format non autorisé).
        -   13.a. Le système affiche un message d'erreur spécifique au téléchargement (ex: "Impossible de joindre le fichier [Nom]. Taille maximale dépassée."). Le système peut soit empêcher l'envoi du message tant que le problème n'est pas résolu, soit permettre l'envoi sans la pièce jointe échouée.

    -   **Scénario d'Exception E1 : Erreur système lors de l'enregistrement ou de l'acheminement du message**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde du message dans la base de données ou de son acheminement vers la boîte de réception de l'administration.
        -   13.e. Le système enregistre l'erreur technique dans ses logs.
        -   14.e. Le système affiche un message d'erreur générique au Mutualiste (ex: "Une erreur s'est produite lors de l'envoi de votre message. Veuillez réessayer plus tard."). L'opération échoue, le message n'est pas envoyé.

    -   **Scénario d'Exception E2 : Échec de la notification automatique des admins**
        -   ... (Étapes 1 à 17 du scénario principal)
        -   18.e. Le système tente d'envoyer une notification aux admins (via alerte interne, email) signalant la réception d'un nouveau message, mais l'envoi de cette notification échoue.
        -   19.e. Le système enregistre l'échec de la notification. Le message est bien enregistré et acheminé dans la messagerie interne, mais les admins ne sont pas alertés automatiquement.

-   **Points à considérer pour la suite :**
    -   Comment l'acheminement du message vers les bons admins ou services est-il géré (règles basées sur le destinataire choisi, le type de message, le mutualiste) ?
    -   L'administration peut-elle _répondre_ à ce message, créant ainsi un fil de conversation (UC 47) ?
    -   Le mutualiste peut-il consulter l'historique de ses messages envoyés et reçus (UC 50) ?
    -   Des règles de sécurité et de confidentialité s'appliquent-elles au contenu des messages ?
    -   Y a-t-il des limites de stockage ou de durée de conservation des messages ?

---

**UC 47 - Répondre à un message (Admin)**

-   **Module :** 14 - Gestion de la Messagerie Interne
-   **Acteur principal :** admin (ayant accès à la messagerie interne)

-   **Description :** Permet à un admin de rédiger et d'envoyer une réponse à un message reçu d'un mutualiste via le système de messagerie interne. Cette réponse est intégrée au fil de conversation existant, permettant un suivi chronologique des échanges.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et possède les droits nécessaires pour accéder à la messagerie interne et y répondre.
    -   Un message ou une conversation avec un mutualiste existe dans la messagerie interne (initié par UC 46 ou un échange antérieur).
    -   L'admin a accédé à l'interface de messagerie (UC 48 implicite) et a sélectionné la conversation ou le message auquel il souhaite répondre.

-   **Postconditions :**

    -   Un nouveau message de réponse est créé, contenant le texte rédigé par l'admin.
    -   Ce message est ajouté au fil de conversation existant avec le mutualiste et enregistré dans la base de données.
    -   Le message est marqué comme envoyé par l'admin et destiné au mutualiste.
    -   Un enregistrement d'audit est créé pour l'envoi de la réponse.
    -   Une notification automatique est envoyée au mutualiste destinataire pour l'informer de la nouvelle réponse reçue (UC 50 implicite).
    -   Le statut du message ou de la conversation peut être mis à jour côté administration (ex: marqué comme "Répondu", "Traité").

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section "Messagerie Interne".
    2.  Le système affiche la liste des conversations ou messages (reçus, envoyés, en cours) auxquels l'admin a accès (UC 48 implicite).
    3.  L'admin sélectionne une conversation avec un mutualiste (clique sur la conversation) pour visualiser le fil des échanges.
    4.  Le système affiche le fil de conversation complet. Une zone de saisie pour rédiger une réponse est disponible en bas de la conversation ou via un bouton "Répondre".
    5.  L'admin clique sur l'option "Répondre" (si non affichée par défaut) et rédige le corps de sa réponse dans la zone de saisie prévue.
    6.  (Optionnel) L'admin peut joindre un document pertinent à sa réponse (ex: une lettre officielle, un justificatif, un document informatif) si la fonctionnalité est activée.
    7.  L'admin vérifie le contenu de sa réponse et les éventuelles pièces jointes.
    8.  L'admin clique sur un bouton "Envoyer" ou "Envoyer la réponse".
    9.  Le système valide le message de réponse (vérifie que le corps du message n'est pas vide, format des pièces jointes si applicable).
    10. Si les validations réussissent, le système crée un nouvel enregistrement de message.
    11. Ce nouveau message est associé au fil de conversation sélectionné et marqué comme envoyé par l'admin actuel et destiné au mutualiste participant à la conversation.
    12. Le message est enregistré dans la base de données avec son contenu, l'expéditeur, le destinataire, et la date/heure d'envoi.
    13. Le système enregistre l'historique de l'envoi de cette réponse dans les logs d'audit.
    14. Le système déclenche une notification automatique pour le mutualiste destinataire afin de l'informer qu'il a reçu une nouvelle réponse dans la messagerie interne (via notification push, email, ou alerte dans son espace personnel - UC 50).
    15. Le système affiche un message de confirmation à l'admin (ex: "Réponse envoyée avec succès.").
    16. Le statut de la conversation ou du dernier message peut être mis à jour côté administration (ex: la marquer comme "Traitée" si c'est la réponse finale, ou "Répondu").

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'envoi de la réponse**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. L'admin décide de ne pas envoyer la réponse.
        -   10.a. L'admin clique sur "Annuler" ou quitte la zone de saisie.
        -   11.a. Le système abandonne le message de réponse en cours de composition.

    -   **Scénario Alternatif A2 : Corps du message de réponse vide**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.a. Le système valide le message et constate que le corps est vide.
        -   11.a. Le système affiche un message d'erreur (ex: "Vous ne pouvez pas envoyer un message vide"). L'admin reste sur la zone de saisie pour ajouter du contenu.

    -   **Scénario Alternatif A3 : Échec du téléchargement ou validation d'un document joint (si applicable)**

        -   ... (Étapes 1 à 6, puis tentative de téléchargement dans étape 10)
        -   11.a. Une erreur technique se produit lors du téléchargement d'un fichier joint, ou le fichier ne respecte pas les règles (ex: trop volumineux, format non autorisé).
        -   12.a. Le système affiche un message d'erreur spécifique (ex: "Échec de l'ajout de la pièce jointe."). Le système peut soit permettre l'envoi de la réponse sans la pièce jointe échouée, soit bloquer l'envoi tant que le problème de pièce jointe n'est pas résolu.

    -   **Scénario d'Exception E1 : Conversation/Message introuvable ou non accessible**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Le système ne trouve pas la conversation ou le message spécifique auquel l'admin tente de répondre (ex: la conversation a été archivée ou supprimée par un autre admin juste avant, ou il y a une erreur technique).
        -   5.e. Le système affiche un message d'erreur. L'opération de réponse ne peut pas démarrer.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement ou de l'association au fil de conversation**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde du nouveau message de réponse ou de son association au fil de conversation existant.
        -   13.e. Le système enregistre l'erreur technique dans ses logs.
        -   14.e. Le système affiche un message d'erreur générique à l'admin (ex: "Une erreur s'est produite lors de l'envoi de votre réponse. Veuillez réessayer."). La réponse n'est pas envoyée.

    -   **Scénario d'Exception E3 : Échec de l'envoi de la notification automatique au Mutualiste**
        -   ... (Étapes 1 à 14 du scénario principal)
        -   15.e. Le système tente d'envoyer la notification au Mutualiste pour l'informer de la nouvelle réponse, mais l'envoi échoue (ex: problème technique du système de notification, compte Mutualiste inactif).
        -   16.e. Le système enregistre l'échec de la notification. La réponse est bien envoyée et enregistrée dans la conversation, mais le Mutualiste n'est pas alerté automatiquement. L'admin est généralement informé de cet échec.

-   **Points à considérer pour la suite :**
    -   Comment le fil de conversation est-il visualisé (affichage imbriqué, simple liste chronologique) ?
    -   Comment l'admin distingue-t-il les messages "lus" des messages "non lus" (UC 48) ?
    -   Le système permet-il aux admins d'initier une nouvelle conversation avec un mutualiste, sans attendre que le mutualiste envoie le premier message (nécessiterait un UC "Envoyer un message à un mutualiste (Admin)") ?
    -   Des règles de sécurité et de confidentialité s'appliquent-elles (ex: certains admins ne peuvent voir/répondre qu'à certains types de messages ou de mutualistes) ?

---

**UC 48 - Visualiser les messages**

-   **Module :** 14 - Gestion de la Messagerie Interne
-   **Acteur principal :** admin (ayant accès à la messagerie interne)

-   **Description :** Permet à un admin de consulter l'interface de la messagerie interne pour voir la liste des conversations ou messages qu'il a reçus des mutualistes (ou potentiellement d'autres admins) et d'ouvrir des conversations spécifiques pour lire l'intégralité des échanges.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour accéder à la section de messagerie interne.
    -   Le système de messagerie interne contient des messages ou des conversations enregistrés et accessibles à cet admin.

-   **Postconditions :**

    -   L'admin a pu consulter la liste des conversations/messages.
    -   L'admin a pu ouvrir et lire les messages contenus dans un fil de conversation spécifique.
    -   (Optionnel) Les messages non lus dans une conversation ouverte sont marqués comme "lus".
    -   Aucune modification des données des messages n'est effectuée par cette consultation seule.
    -   L'interface de messagerie, listant les conversations et affichant potentiellement une conversation ouverte, est affichée à l'écran.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section "Messagerie Interne".
    2.  Le système affiche l'interface principale de la messagerie pour l'admin. Cette interface présente une liste des conversations ou messages récents, généralement dans un panneau latéral ou une zone dédiée.
    3.  Pour chaque conversation/message dans la liste, le système affiche des informations clés (ex: Le nom du mutualiste participant ou l'expéditeur, l'objet/sujet de la conversation, la date/heure du dernier message, potentiellement un indicateur visuel si la conversation contient des messages non lus).
    4.  L'admin consulte la liste des conversations ou messages. Des options de tri ou de filtrage (ex: messages non lus, par mutualiste, par sujet) peuvent être disponibles.
    5.  L'admin sélectionne une conversation spécifique dans la liste (clique sur la conversation ou le message).
    6.  Le système récupère tous les messages qui composent le fil de conversation sélectionné.
    7.  Le système affiche le fil de conversation complet. Chaque message est affiché avec son contenu, l'expéditeur (le mutualiste ou l'admin qui a envoyé le message), et la date/heure d'envoi. Le fil est généralement affiché dans l'ordre chronologique.
    8.  (Optionnel) Le système marque automatiquement comme "lus" les messages de cette conversation qui étaient précédemment non lus pour cet admin.
    9.  L'admin lit les messages contenus dans le fil de conversation. Il peut ensuite décider d'y répondre (UC 47).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune conversation ou message accessible à l'admin**

        -   ... (Étapes 1 à 2 du scénario principal)
        -   3.a. Le système interroge la base de données mais ne trouve aucune conversation ou message que cet admin a le droit de voir (basé sur les règles d'accès ou d'assignation).
        -   4.a. Le système affiche un message indiquant "Aucun message dans votre boîte de réception" ou "Aucune conversation disponible pour le moment".
        -   5.a. L'admin prend connaissance de l'information.

    -   **Scénario Alternatif A2 : Conversation ou message sélectionné introuvable ou non accessible**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.a. L'admin sélectionne une conversation, mais le système ne la trouve pas (ex: elle a été supprimée ou archivée par un autre admin juste avant) ou l'admin n'a pas les droits d'y accéder.
        -   6.a. Le système affiche un message d'erreur (ex: "Conversation introuvable" ou "Vous n'avez pas accès à cette conversation"). L'affichage peut revenir à la liste des conversations (si elle existe).

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération de la liste des conversations ou des messages d'une conversation**
        -   ... (Étapes 1 à 3 ou Étapes 1 à 6 du scénario principal)
        -   4.e. / 7.e. Une erreur technique imprévue se produit lors de la tentative de récupérer la liste des conversations ou tous les messages d'une conversation spécifique depuis la base de données.
        -   5.e. / 8.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. / 9.e. Le système affiche un message d'erreur générique à l'admin l'informant que la messagerie n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Comment les messages sont-ils organisés (par fil de conversation, par date, par mutualiste) ?
    -   Le système gère-t-il les statuts de lecture (lu/non lu) ?
    -   L'admin peut-il rechercher dans le contenu des messages ou dans les objets ?
    -   Des options d'archivage ou de suppression de conversations sont-elles disponibles pour les admins ?
    -   Comment les règles d'accès et d'acheminement des messages sont-elles définies pour s'assurer que les bons admins voient les bons messages ? (Liaison avec les droits des utilisateurs et potentiellement la configuration des services).
    -   L'admin peut-il filtrer par mutualiste pour voir tous les messages échangés avec cet adhérent spécifique ?

---

**UC 49 - Envoyer un message à un mutualiste**

-   **Module :** 14 - Gestion de la Messagerie Interne
-   **Acteur principal :** admin

-   **Description :** Permet à un admin d'initier une nouvelle conversation ou d'envoyer un message non sollicité à un mutualiste spécifique via le système de messagerie interne sécurisé, par exemple pour lui communiquer une information importante, lui demander des précisions, ou l'informer d'une mise à jour le concernant.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour envoyer des messages aux mutualistes.
    -   Le mutualiste destinataire existe dans le système, est identifiable et dispose d'un compte actif permettant de recevoir des messages internes.
    -   Le système de messagerie interne est activé.
    -   L'admin a une information ou une communication qu'il souhaite envoyer au mutualiste.

-   **Postconditions :**

    -   Une nouvelle conversation est initiée dans le système de messagerie ou un nouveau message est ajouté à un fil existant si la conversation a déjà eu lieu.
    -   Le message est créé et enregistré dans le système, associé à l'admin expéditeur et au mutualiste destinataire.
    -   Un enregistrement d'audit est créé pour l'envoi du message par l'admin.
    -   Une notification automatique est envoyée au mutualiste destinataire pour l'informer d'un nouveau message (UC 50 implicite).
    -   (Optionnel) Une confirmation d'envoi est affichée à l'admin.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration et navigue vers la section "Messagerie Interne" (UC 48 implicite).
    2.  L'admin clique sur l'option "Nouveau Message", "Envoyer un message à un mutualiste", ou similaire.
    3.  Le système affiche un formulaire de composition de message.
    4.  L'admin recherche et sélectionne le mutualiste destinataire du message. Le système peut afficher une confirmation de l'éligibilité du mutualiste à recevoir des messages internes.
    5.  L'admin saisit l'objet de son message.
    6.  L'admin rédige le corps du message qu'il souhaite envoyer au mutualiste.
    7.  (Optionnel) L'admin peut joindre des documents pertinents si la fonctionnalité est disponible et configurée (ex: document informatif, accusé de réception).
    8.  L'admin vérifie le contenu, l'objet et le destinataire de son message.
    9.  L'admin clique sur un bouton "Envoyer".
    10. Le système valide le message (vérifie que l'objet et le corps ne sont pas vides, que le destinataire est valide et peut recevoir des messages, formats de pièces jointes si applicable).
    11. Si les validations réussissent, le système crée un nouvel enregistrement de message dans la base de données.
    12. Le message est associé à l'admin expéditeur et au Mutualiste destinataire. Si une conversation existe déjà avec ce mutualiste sur ce sujet ou un sujet similaire, le message peut être ajouté à ce fil ; sinon, une nouvelle conversation est initiée.
    13. Le message est enregistré avec son contenu, son objet, et la date/heure d'envoi.
    14. Le système enregistre l'historique de l'envoi de ce message dans les logs d'audit.
    15. Le système déclenche une notification automatique pour le mutualiste destinataire afin de l'informer qu'il a reçu un nouveau message dans la messagerie interne (via notification push, email, ou alerte dans son espace personnel - UC 50).
    16. Le système affiche un message de confirmation à l'admin (ex: "Message envoyé à [Nom du Mutualiste] avec succès.").

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'envoi par l'admin**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.a. L'admin décide de ne pas envoyer le message.
        -   11.a. L'admin clique sur "Annuler", "Fermer", ou quitte le formulaire sans sauvegarder.
        -   12.a. Le système abandonne le message en cours de composition.

    -   **Scénario Alternatif A2 : Mutualiste destinataire introuvable ou incapable de recevoir des messages**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. L'admin recherche ou sélectionne un mutualiste, mais le système ne le trouve pas, ou vérifie que son statut actuel (ex: compte fermé, messagerie désactivée) ne permet pas de recevoir des messages internes.
        -   7.a. Le système affiche un message d'erreur à l'admin (ex: "Mutualiste introuvable" ou "Ce mutualiste ne peut pas recevoir de messages internes pour le moment"). L'envoi n'est pas possible.

    -   **Scénario Alternatif A3 : Données manquantes ou invalides détectées**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.a. Le système valide le message et constate que des informations essentielles sont manquantes (ex: l'objet ou le corps du message est vide).
        -   12.a. Le système affiche des messages d'erreur. L'admin reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A4 : Échec du téléchargement ou validation d'un document joint (si applicable)**

        -   ... (Étapes 1 à 8, puis tentative de téléchargement dans étape 10)
        -   11.a. Une erreur technique se produit lors du téléchargement d'un fichier joint, ou le fichier ne respecte pas les règles (ex: trop volumineux, format non autorisé).
        -   12.a. Le système affiche un message d'erreur spécifique (ex: "Impossible de joindre ce fichier."). Le système peut soit empêcher l'envoi du message tant que le problème n'est pas résolu, soit permettre l'envoi sans la pièce jointe échouée.

    -   **Scénario d'Exception E1 : Erreur système lors de l'enregistrement ou de l'envoi du message**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde ou d'envoi du message dans la base de données ou le système de messagerie.
        -   13.e. Le système enregistre l'erreur technique dans ses logs.
        -   14.e. Le système affiche un message d'erreur générique à l'admin (ex: "Une erreur s'est produite lors de l'envoi du message."). L'opération échoue.

    -   **Scénario d'Exception E2 : Échec de l'envoi de la notification automatique au Mutualiste**
        -   ... (Étapes 1 à 15 du scénario principal)
        -   16.e. Le système tente d'envoyer la notification au Mutualiste signalant le nouveau message, mais l'envoi échoue (ex: problème technique du système de notification, compte Mutualiste inactif).
        -   17.e. Le système enregistre l'échec de la notification. Le message est bien enregistré et envoyé, mais le Mutualiste n'est pas alerté automatiquement. L'admin est généralement informé de cet échec.

-   **Points à considérer pour la suite :**
    -   Les admins peuvent-ils envoyer des messages à plusieurs mutualistes à la fois (ex: pour des communications générales, des alertes) ? (Ce serait un UC distinct comme "Envoyer un message groupé aux mutualistes").
    -   Les admins peuvent-ils utiliser des modèles de messages prédéfinis pour les communications fréquentes ?
    -   Comment les messages initiés par l'Admin sont-ils classés ou affichés dans la messagerie du Mutualiste (UC 50) ?
    -   Existe-t-il une politique de conservation des messages envoyés/reçus par les admins ?

---

**UC 50 - Visualiser ses messages**

-   **Module :** 14 - Gestion de la Messagerie Interne
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste d'accéder à son interface de messagerie interne, de consulter la liste des conversations ou messages qu'il a échangés avec l'administration de la mutuelle, et d'ouvrir un fil de conversation spécifique pour lire l'historique des messages.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   Le système de messagerie interne est activé et accessible pour le mutualiste.
    -   La messagerie interne contient au moins un message ou une conversation associé à ce mutualiste.
    -   Le mutualiste a accès à la section de son espace personnel où la messagerie est affichée (potentiellement via le tableau de bord UC 52).

-   **Postconditions :**

    -   Le mutualiste a pu consulter la liste de ses messages/conversations et/ou lire les messages contenus dans un fil spécifique. Aucune modification de données n'est effectuée.
    -   L'interface de messagerie, listant les conversations et affichant potentiellement une conversation ouverte, est affichée à l'écran du mutualiste.
    -   (Optionnel) Les messages non lus dans une conversation ouverte sont marqués comme "lus" pour le mutualiste.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Le Mutualiste navigue dans le menu de son espace personnel vers la section "Messagerie", "Mes Messages", "Boîte de réception", ou similaire. Il peut également y accéder via un indicateur de nouveaux messages sur son tableau de bord (UC 52).
    3.  Le système affiche l'interface de messagerie du Mutualiste. Cette interface présente une liste des conversations ou messages échangés avec l'administration.
    4.  Pour chaque conversation/message dans la liste, le système affiche des informations clés (ex: L'objet/sujet de la conversation, le nom du service administratif contacté ou l'expéditeur générique "Administration", la date/heure du dernier message, un indicateur visuel si la conversation contient des messages non lus pour le mutualiste).
    5.  Le Mutualiste consulte la liste des conversations/messages. Des options de tri ou de filtrage (ex: messages non lus, par date, par sujet) peuvent être disponibles.
    6.  Le Mutualiste sélectionne une conversation spécifique dans la liste (clique sur la conversation ou le message).
    7.  Le système récupère tous les messages qui composent le fil de conversation sélectionné et qui sont accessibles au mutualiste.
    8.  Le système affiche le fil de conversation complet dans l'ordre chronologique. Chaque message est affiché avec son contenu, l'expéditeur (indiqué comme "Moi" pour les messages envoyés par le Mutualiste, "Administration" ou le nom du service/admin pour les messages reçus), et la date/heure d'envoi.
    9.  (Optionnel) Le système marque automatiquement comme "lus" les messages de cette conversation qui étaient précédemment non lus pour le Mutualiste.
    10. Le Mutualiste lit les messages contenus dans le fil de conversation. Il peut ensuite décider de répondre (UC 46).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune conversation ou message associé au mutualiste**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucune conversation ou message associé à ce Mutualiste dans la messagerie interne.
        -   5.a. Le système affiche un message indiquant "Vous n'avez aucun message" ou "Aucune conversation enregistrée pour le moment".
        -   6.a. Le Mutualiste prend connaissance de l'information.

    -   **Scénario Alternatif A2 : Conversation ou message sélectionné introuvable ou non accessible**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. Le système ne trouve pas la conversation ou le message spécifique sélectionné par le Mutualiste (ex: erreur technique, ou la conversation a été archivée/supprimée côté Administration et n'est plus visible pour l'adhérent).
        -   7.a. Le système affiche un message d'erreur (ex: "Conversation introuvable" ou "Impossible d'afficher ce message"). L'affichage peut revenir à la liste des conversations (si elle existe).

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données (liste ou messages)**
        -   ... (Étapes 1 à 3 ou Étapes 1 à 6 du scénario principal)
        -   4.e. / 7.e. Une erreur technique imprévue se produit lors de la tentative de récupérer la liste des conversations ou les messages d'une conversation spécifique pour le Mutualiste.
        -   5.e. / 8.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. / 9.e. Le système affiche un message d'erreur générique au Mutualiste indiquant que la messagerie n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Comment les fils de conversation sont-ils visuellement structurés pour faciliter la lecture des échanges (imbrication, distinction claire expéditeur/destinataire) ?
    -   Les indicateurs de messages non lus sont-ils clairs et visibles dès le tableau de bord et la liste des conversations ?
    -   Le mutualiste peut-il archiver ou supprimer des conversations ?
    -   Le mutualiste peut-il rechercher dans le contenu de ses messages ?
    -   Comment les éventuels documents joints par l'administration (UC 47, UC 49) sont-ils affichés ou rendus téléchargeables dans le fil de conversation ?

---

### Module 15: Tableaux de Bord et Rapports (Admin/Mutualiste)

**UC 51 - Consulter le tableau de bord (Admin)**

-   **Module :** 15 - Tableaux de Bord et Rapports (Admin/Mutualiste)
-   **Acteur principal :** admin

-   **Description :** Permet à un admin d'accéder à un écran de synthèse présentant les principaux indicateurs de performance (KPI), des statistiques clés, des résumés d'activité et des alertes du système, pour offrir une vue d'ensemble rapide et faciliter le monitoring et la gestion quotidienne de la mutuelle.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits d'accès au tableau de bord administratif.
    -   Le système contient des données d'activité pertinentes à afficher.
    -   Les différents composants (widgets, graphiques) du tableau de bord sont configurés et fonctionnels.

-   **Postconditions :**

    -   L'admin a consulté les informations présentées sur le tableau de bord. Aucune modification des données sous-jacentes n'est effectuée par cette consultation.
    -   Le tableau de bord administratif est affiché à l'écran de l'admin.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration (authentification gérée par UC 1).
    2.  Immédiatement après l'authentification ou en naviguant vers la page d'accueil ou une section dédiée, l'admin accède au tableau de bord.
    3.  Le système identifie l'admin et ses droits pour déterminer les informations et les widgets qu'il peut voir.
    4.  Le système récupère les données nécessaires pour alimenter les différents indicateurs, statistiques et listes de synthèse présentées sur le tableau de bord (interroge les données des mutualistes (Module 2), des cotisations (Module 5), des prêts (Module 6), des rachats (Module 7), des aides (Module 8), des prises en charge (Module 9), des liquidations (Module 10), des prêts de matériels (Module 12), des réclamations (Module 13), de la messagerie (Module 14), etc.).
    5.  Le système organise et affiche les informations sous forme de différents widgets sur la page du tableau de bord. Ces widgets peuvent inclure (basé sur les exigences et les modules détaillés) :
        -   Statistiques sur les adhérents (ex: total adhérents actifs, nouveaux adhérents ce mois-ci, adhérents par catégorie/statut).
        -   Suivi des cotisations (ex: total perçu ce mois-ci, taux de recouvrement, liste des impayés récents).
        -   Vue d'ensemble des prêts (ex: total encours, prêts accordés ce mois-ci, prêts en retard).
        -   Vue d'ensemble des rachats de prêts (ex: total encours rachats, rachats en cours).
        -   Suivi des prises en charge (ex: total pris en charge ce mois-ci, nombre de demandes en attente, Top 15 des prestations les plus fréquentes ou coûteuses).
        -   Suivi des réclamations (ex: nombre de réclamations ouvertes/en attente, réclamations récentes).
        -   Suivi des prêts de matériels (ex: nombre de matériels prêtés actuellement, liste des matériels en retard de retour).
        -   Messagerie Interne (ex: nombre de nouveaux messages non lus reçus des mutualistes).
        -   Alertes système importantes.
        -   Tâches en attente assignées à l'admin.
    6.  L'admin consulte les différents indicateurs et résumés pour avoir une vue d'ensemble de l'état de la mutuelle.
    7.  (Optionnel) L'admin peut cliquer sur certains éléments (ex: une ligne dans une liste de réclamations, une barre dans un graphique de prestations) pour accéder à la page de gestion détaillée correspondante dans un autre module (ex: accéder à UC 43 pour traiter une réclamation).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune donnée disponible pour certains indicateurs**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.a. Pour certains indicateurs ou listes de synthèse (widgets), le système ne trouve pas de données pertinentes (ex: aucun prêt de matériel en retard, aucune nouvelle adhésion sur la période).
        -   6.a. Le système affiche le widget concerné en indiquant clairement l'absence de données (ex: "0 réclamation en attente", "Aucun prêt de matériel en retard").
        -   7.a. L'admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors du chargement du tableau de bord**
        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Une erreur technique imprévue se produit lors de la tentative de récupération des données globales ou lors de l'affichage des widgets du tableau de bord.
        -   6.e. Le système enregistre l'erreur technique dans ses journaux.
        -   7.e. Le système affiche un message d'erreur générique au Mutualiste indiquant que le tableau de bord n'a pas pu être chargé pour le moment. Certains widgets peuvent afficher des messages d'erreur individuels si l'échec est partiel.

-   **Points à considérer pour la suite :**
    -   Quels sont les indicateurs spécifiques qui doivent absolument figurer sur ce tableau de bord ? (Nous en avons listé plusieurs basés sur les modules et exigences précédentes).
    -   Le tableau de bord est-il personnalisable par l'admin (choix des widgets, de la disposition) ?
    -   Les données sont-elles affichées en temps réel ou avec un léger décalage (ex: mises à jour toutes les heures) ?
    -   Des filtres globaux s'appliquent-ils au tableau de bord (ex: voir les indicateurs pour une branche spécifique) ?
    -   Comment les alertes (ex: réclamations non traitées depuis X jours, prêt en retard) sont-elles gérées et affichées ?

---

**UC 52 - Visualiser le tableau de bord**

-   **Module :** 15 - Tableaux de Bord
-   **Acteur principal :** Mutualiste

-   **Description :** Permet au mutualiste d'accéder à une page de résumé personnalisée (tableau de bord) dès sa connexion à son espace personnel. Ce tableau de bord présente une vue d'ensemble rapide des informations clés le concernant, des actions récentes, et des alertes importantes, ainsi que des liens d'accès rapide vers d'autres sections de son espace.

-   **Préconditions :**

    -   Le mutualiste est authentifié et connecté à son espace personnel (UC 1 réussi).
    -   L'interface du tableau de bord est configurée et accessible pour les mutualistes.
    -   Le système contient des informations relatives au mutualiste (dossier, cotisations, prestations, messages, etc.) à afficher sur le tableau de bord.

-   **Postconditions :**

    -   Le tableau de bord personnalisé du mutualiste est affiché à l'écran.
    -   Le mutualiste a un aperçu rapide de son statut, de ses informations clés et des alertes.
    -   Aucune modification des données n'est effectuée par ce cas d'utilisation, qui est purement consultatif.

-   **Scénario principal :**

    1.  Le Mutualiste se connecte à son espace personnel (UC 1).
    2.  Par défaut (ou en naviguant explicitement vers "Tableau de Bord" / "Accueil"), le système affiche le tableau de bord personnel du mutualiste.
    3.  Le système identifie le Mutualiste authentifié et interroge les différentes sections pertinentes du système pour récupérer les informations de résumé à afficher sur le tableau de bord. Ces informations peuvent inclure :
        -   Statut de l'adhésion et informations de profil clés (Nom, N° Adhérent, Contrat actuel).
        -   Résumé des cotisations (prochaine échéance, statut des dernières cotisations, solde global).
        -   Résumé des prises en charge (nombre de prises en charge récentes/en cours, statut des dernières).
        -   Résumé des prêts (prêts en cours, montant restant dû, prochaine échéance).
        -   Indicateur de messages non lus dans la messagerie interne (lien vers UC 50).
        -   Résumé des notifications récentes (lien vers UC 57).
        -   Alertes spécifiques (ex: document manquant, cotisation en retard, rappel de retour matériel).
        -   Liens d'accès rapide vers les sections clés (Mes Cotisations, Mes Prises en Charge, Messagerie, Mon Profil, etc.).
    4.  Le système affiche le tableau de bord, structuré en différents widgets ou panneaux, chacun présentant un résumé des informations récupérées.
    5.  Le Mutualiste consulte le tableau de bord pour obtenir un aperçu rapide et utilise les liens d'accès rapide pour naviguer vers d'autres sections s'il le souhaite.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune donnée spécifique pour un widget**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système ne trouve aucune donnée pertinente pour un ou plusieurs widgets spécifiques du tableau de bord (ex: pas de prêts en cours, pas de messages non lus).
        -   5.a. Le système affiche le widget concerné avec un message indiquant "Aucun prêt en cours", "Aucun nouveau message", ou le widget peut ne pas être affiché du tout selon la configuration.
        -   6.a. Le Mutualiste consulte le tableau de bord avec les informations disponibles.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données pour le tableau de bord**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique imprévue se produit lors de la tentative de récupérer les informations de résumé depuis les différentes sections du système.
        -   5.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. Le système affiche un message d'erreur générique au Mutualiste indiquant que le tableau de bord n'a pas pu être chargé pour le moment, ou affiche un tableau de bord vide/partiel avec des messages d'erreur dans les widgets affectés.

-   **Points à considérer pour la suite :**
    -   Quels widgets spécifiques sont les plus utiles et pertinents pour les mutualistes ?
    -   Le contenu des widgets est-il personnalisable par l'administration ou par le mutualiste ?
    -   Comment la performance du chargement du tableau de bord est-elle gérée, car il agrège des données provenant potentiellement de plusieurs modules ?
    -   Les liens sur les widgets mènent-ils directement aux sections pertinentes (ex: cliquer sur le résumé des prêts mène à la liste des prêts UC 41) ?
    -   Le tableau de bord affiche-t-il des notifications système ou des messages de l'administration (liaison avec UC 57 et UC 50) ?

---

### Module 16: Gestion des Utilisateurs de l'Application

**UC 53 - Gérer les comptes admins**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** Super admin (ou admin système ayant les droits de gestion des utilisateurs Admin)

-   **Description :** Permet à un Super admin de superviser et de gérer les comptes d'accès des autres admins du système. Cela inclut la création de nouveaux comptes, la modification des informations et des permissions, l'activation ou la désactivation des accès.

-   **Préconditions :**

    -   Le Super admin est authentifié dans le système avec un compte disposant des droits nécessaires pour gérer les comptes admins.
    -   L'interface d'administration pour la gestion des utilisateurs est accessible.
    -   (Pour modification/visualisation) Le compte admin spécifique à gérer existe déjà dans le système.

-   **Postconditions :**

    -   Un compte admin est créé, mis à jour, activé, désactivé ou supprimé dans le système.
    -   Les informations (identifiant, rôles, statut) du compte géré sont enregistrées ou modifiées.
    -   Un enregistrement d'audit détaillé est créé pour l'action de gestion effectuée sur le compte admin (qui a fait quoi, sur quel compte, quand).
    -   (Optionnel) Le nouvel admin est notifié de la création de son compte, ou l'admin concerné est notifié d'un changement majeur (ex: désactivation).

-   **Scénario principal (Combinant Création, Consultation, Modification, Gestion du statut) :**

    1.  Le Super admin se connecte à l'interface d'administration (UC 1 implicite).
    2.  Le Super admin navigue vers la section de gestion des utilisateurs ou des comptes admins (souvent via un menu "Administration" ou "Paramètres Système").
    3.  Le système affiche la liste de tous les comptes admins existants. Pour chaque compte, des informations clés sont présentées (ex: Nom/Prénom, Identifiant de connexion, Rôle(s) assigné(s), Statut (Actif/Inactif/Bloqué), Date de création, Dernière connexion). Des options pour agir sur chaque compte (Visualiser, Modifier, Activer/Désactiver, Réinitialiser mot de passe, Supprimer si applicable) et une option pour créer un nouveau compte sont disponibles.

    -   **Sous-Scénario Principal A : Créer un nouveau compte admin**

        -   4a. Le Super admin clique sur l'option "Créer un compte admin".
        -   5a. Le système affiche un formulaire de création de compte.
        -   6a. Le Super admin saisit les informations obligatoires du nouvel admin (ex: Nom, Prénom, Adresse Email, Identifiant de connexion unique, Numéro de téléphone).
        -   7a. Le Super admin attribue les rôles et permissions nécessaires au nouvel admin en sélectionnant un ou plusieurs rôles prédéfinis (ex: "Gestionnaire Cotisations", "Superviseur Prêts", "Gestionnaire Réclamations") ou en définissant des permissions spécifiques si le système le permet.
        -   8a. Le système peut automatiquement générer un mot de passe temporaire sécurisé ou permettre au Super admin de le définir initialement. Le système peut aussi exiger que le nouvel admin change son mot de passe à la première connexion.
        -   9a. Le Super admin définit le statut initial du compte (généralement "Actif").
        -   10a. Le Super admin vérifie les informations et rôles attribués.
        -   11a. Le Super admin clique sur le bouton "Enregistrer", "Créer le compte", ou similaire.
        -   12a. Le système valide les données saisies (champs obligatoires remplis, identifiant unique, email format valide, rôles existants).
        -   13a. Si les validations réussissent, le système crée le nouvel enregistrement de compte admin avec les informations fournies, les rôles/permissions, le mot de passe initial et le statut.
        -   14a. Le système enregistre l'historique de la création de ce compte d'utilisateur.
        -   15a. Le système affiche un message de confirmation (ex: "Compte admin créé pour [Identifiant]. Un mot de passe temporaire a été envoyé par email."). La liste des comptes est mise à jour.
        -   16a. (Optionnel) Le système envoie une notification (par email ou SMS) au nouvel admin avec ses informations de connexion initiales et les instructions pour sa première connexion.

    -   **Sous-Scénario Principal M : Visualiser / Modifier / Gérer un compte admin existant**

        -   4m. Le Super admin sélectionne un compte admin dans la liste (clique sur le nom, un bouton "Modifier" ou "Gérer").
        -   5m. Le système affiche les informations détaillées du compte sélectionné dans un formulaire pré-rempli, potentiellement modifiable. Les informations incluent les données personnelles, l'identifiant, les rôles/permissions actuels, et le statut.
        -   6m. Le Super admin visualise les informations. Il peut modifier les champs autorisés (ex: Nom, Prénom, Email, Numéro de téléphone).
        -   7m. Le Super admin peut modifier les rôles et permissions associés au compte, ou changer son statut (Actif/Inactif/Bloqué).
        -   8m. Le Super admin peut également effectuer des actions spécifiques sur le compte via des options dédiées (ex: cliquer sur "Réinitialiser le mot de passe" pour générer un nouveau mot de passe temporaire, "Déverrouiller le compte" si le compte a été bloqué suite à trop de tentatives de connexion infructueuses).
        -   9m. Le Super admin vérifie les modifications ou l'action sélectionnée.
        -   10m. Le Super admin clique sur le bouton "Enregistrer les modifications" ou confirme l'action spécifique (ex: "Confirmer Réinitialisation Mot de Passe").
        -   11m. Le système valide les données modifiées ou l'action demandée. Il peut y avoir des validations métier spécifiques (ex: empêcher un Admin de modifier son propre rôle critique).
        -   12m. Si les validations réussissent, le système met à jour l'enregistrement du compte dans la base de données ou exécute l'action spécifique demandée (ex: met à jour le mot de passe chiffré).
        -   13m. Le système enregistre l'historique de la modification ou de l'action effectuée sur le compte d'utilisateur.
        -   14m. Le système affiche un message de confirmation (ex: "Compte mis à jour avec succès.", "Mot de passe réinitialisé. Un email a été envoyé à l'utilisateur."). La liste des comptes est mise à jour si nécessaire.
        -   15m. (Optionnel) Si l'action est sensible (ex: réinitialisation de mot de passe, désactivation), le système peut notifier l'admin dont le compte a été modifié.

    -   **Sous-Scénario Principal S : Activer / Désactiver rapidement depuis la liste**
        -   4s. Dans la liste des comptes admins (étape 3), le Super admin clique sur l'action rapide "Activer" ou "Désactiver" associée à un compte spécifique.
        -   5s. Le système peut demander une confirmation de l'action ("Êtes-vous sûr de vouloir désactiver ce compte ?").
        -   6s. Le Super admin confirme l'action.
        -   7s. Le système valide si cette action est permise (ex: empêcher la désactivation du compte actuellement connecté, ou du dernier Super Admin).
        -   8s. Si l'action est permise, le système met à jour le statut du compte admin dans la base de données (passe de Actif à Inactif, ou inversement).
        -   9s. Le système enregistre l'historique du changement de statut rapide.
        -   10s. Le système affiche un message de confirmation (ex: "Compte [Nom] désactivé avec succès."). La liste est mise à jour.
        -   11s. (Optionnel) Le système peut envoyer une notification à l'admin concerné pour l'informer que son compte a été désactivé.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'opération**

        -   Applicable à chaque sous-scénario avant la validation finale. Le Super admin annule l'action en cours. Le système abandonne le processus.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides (Créer ou Modifier)**

        -   Applicable aux sous-scénarios A (étape 12a) et M (étape 11m).
        -   La validation des données saisies échoue (ex: un champ obligatoire est vide, l'identifiant de connexion existe déjà pour un autre compte, le format de l'email est incorrect).
        -   Le système affiche des messages d'erreur précis à côté des champs concernés. Le Super admin reste sur le formulaire pour apporter les corrections nécessaires.

    -   **Scénario Alternatif A3 : Tentative d'action non permise sur un compte critique ou sur son propre compte**

        -   Applicable aux sous-scénarios M (étape 11m) et S (étape 7s).
        -   Le système détecte que l'action demandée par le Super admin n'est pas autorisée pour des raisons de sécurité ou de cohérence du système (ex: tenter de désactiver le compte du Super admin actuellement connecté, tenter de supprimer le dernier compte Super Admin actif, tenter de modifier ses propres permissions critiques).
        -   Le système bloque l'action et affiche un message d'erreur expliquant pourquoi l'opération n'est pas permise.

    -   **Scénario d'Exception E1 : Compte admin introuvable (Visualiser, Modifier, Gérer, Statut rapide)**

        -   Applicable aux sous-scénarios M (étape 4m) et S (étape 4s).
        -   Le compte admin sélectionné ou recherché n'est pas trouvé dans le système (ex: a été supprimé par un autre Super Admin juste avant).
        -   Le système affiche un message d'erreur indiquant que le compte n'a pas été trouvé. L'opération sur ce compte spécifique s'arrête.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement, la mise à jour ou l'action sur le compte**

        -   Applicable aux sous-scénarios A (étape 13a), M (étape 12m) et S (étape 8s).
        -   Une erreur technique imprévue se produit lors de la tentative de sauvegarder les informations du compte admin, de le mettre à jour, ou d'exécuter une action (ex: réinitialisation de mot de passe en base de données).
        -   Le système enregistre l'erreur technique dans ses logs.
        -   Le système affiche un message d'erreur générique à l'admin (ex: "Une erreur système s'est produite lors de l'enregistrement du compte."). L'opération échoue.

    -   **Scénario d'Exception E3 : Échec de l'envoi de la notification automatique (création, reset mdp, désactivation)**
        -   Applicable aux sous-scénarios A (étape 16a) et M (étape 15m si action déclenchant notification) et S (étape 11s).
        -   Le système tente d'envoyer une notification par email ou un autre canal de communication à l'admin concerné, mais l'envoi échoue (ex: problème de configuration email, adresse invalide).
        -   Le système enregistre l'échec de la notification. L'action sur le compte (création, modification, réinitialisation, statut) est bien effectuée, mais le Super admin est averti que la notification n'a pas été envoyée.

-   **Points à considérer pour la suite :**
    -   Comment les rôles et les permissions spécifiques sont-ils définis et gérés dans le système ? (Cela nécessiterait un ou plusieurs autres UC dans ce module ou un module dédié "Gestion des Rôles et Permissions").
    -   Existe-t-il des politiques de mot de passe (longueur minimale, complexité, renouvellement) gérées par le système ?
    -   Le système gère-t-il l'authentification à plusieurs facteurs (MFA) pour les comptes admins ?
    -   L'historique des connexions et des actions effectuées par chaque admin est-il tracé et consultable ? (UC 54).
    -   Un processus de "suppression logique" (désactivation permanente) vs "suppression physique" est-il nécessaire pour les comptes admins ?

---

**UC 54 - Consulter les logs d'activité**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** Super admin (ou admin de l'audit)

-   **Description :** Permet à un super admin d'accéder et de consulter les enregistrements détaillés de toutes les actions significatives effectuées par les utilisateurs (admins et potentiellement mutualistes pour certaines actions sensibles) dans le système. Cet historique est essentiel pour l'audit, la détection d d'activités suspectes et le suivi précis des opérations.

-   **Préconditions :**

    -   Le Super admin est authentifié dans le système avec un compte disposant des droits nécessaires pour consulter les logs d'activité système.
    -   Le mécanisme d'enregistrement des logs d'activité est activé dans le système.
    -   Le système contient des enregistrements de logs d'activité à consulter.

-   **Postconditions :**

    -   Le Super admin a pu consulter la liste des logs d'activité, potentiellement en utilisant des filtres ou une recherche. Aucune modification des logs n'est effectuée par cette consultation.
    -   L'historique des actions (logs d'activité) est affiché à l'écran du Super admin.

-   **Scénario principal :**

    1.  Le Super admin se connecte à l'interface d'administration (UC 1 implicite).
    2.  Le Super admin navigue vers la section dédiée à l'audit, aux journaux système, ou aux logs d'activité.
    3.  Le système affiche une interface conçue pour la consultation des logs. Par défaut, une liste chronologique des logs les plus récents peut être présentée. Chaque entrée de log inclut des informations clés :
        -   La date et l'heure précises de l'événement.
        -   L'utilisateur (son identifiant de connexion ou nom/prénom) qui a effectué l'action.
        -   Le type d'action effectuée (ex: Connexion réussie, Connexion échouée, Création de mutualiste, Modification du profil d'un adhérent, Suppression d'un ayant droit, Création d'un prêt, Mise à jour d'un statut de cotisation, Consultation d'informations sensibles, Envoi de message interne).
        -   L'objet ou l'entité concernée par l'action (ex: Le Mutualiste n° [Numéro], Le prêt n° [Référence], Le compte Admin [Identifiant], Le système).
        -   Le résultat de l'action (Succès ou Échec).
        -   (Optionnel) Des détails supplémentaires sur l'action (ex: l'adresse IP source de la connexion, les champs spécifiques modifiés et leurs anciennes/nouvelles valeurs pour une modification, le motif d'un échec).
    4.  Le Super admin utilise les options de filtrage et de recherche disponibles pour affiner les logs affichés (ex: filtrer par date/période, par utilisateur spécifique, par type d'action, par succès/échec, rechercher une référence spécifique de mutualiste ou de prêt).
    5.  Le système actualise la liste des logs affichés en fonction des filtres et de la recherche appliqués.
    6.  Le Super admin consulte la liste filtrée et/ou recherchée des logs d'activité. La liste peut être paginée pour gérer un grand volume de données.
    7.  (Optionnel) Le Super admin peut cliquer sur une entrée de log spécifique pour afficher tous les détails enregistrés pour cet événement dans une vue dédiée.
    8.  (Optionnel) Le Super admin peut trier la liste des logs par différentes colonnes.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune log enregistrée (ou correspondant aux filtres/recherche)**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. Le système exécute la requête (par défaut ou avec filtres/recherche) et constate qu'il n'y a aucune log enregistrée du tout, ou aucune correspondant aux critères spécifiés.
        -   7.a. Le système affiche un message indiquant "Aucune log d'activité trouvée" ou "Aucune log ne correspond à vos critères de recherche/filtrage".
        -   8.a. Le Super admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération ou de l'affichage des logs**
        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.e. Une erreur technique imprévue se produit lors de la tentative de récupérer les logs depuis la base de données d'audit ou de les afficher correctement dans l'interface.
        -   8.e. Le système enregistre l'erreur technique dans ses journaux d'erreurs internes.
        -   9.e. Le système affiche un message d'erreur générique au Super admin indiquant que les logs d'activité n'ont pas pu être chargés pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles actions précises du système et des utilisateurs (Admin et/ou Mutualiste) sont enregistrées dans les logs ? Faut-il une granularité fine ?
    -   Quelle est la politique de conservation des logs (combien de temps sont-ils stockés) ? Existe-t-il un mécanisme d'archivage ?
    -   Comment la sécurité des logs eux-mêmes est-elle garantie (empêcher la modification ou la suppression des logs par un admin, même Super Admin) ?
    -   Existe-t-il une fonctionnalité d'exportation des logs pour des analyses externes ou pour archivage hors système ? (Ce serait un cas d'utilisation distinct "Exporter logs d'activité (Super Admin)").
    -   Des alertes automatisées peuvent-elles être configurées sur certains événements (ex: nombre excessif de tentatives de connexion échouées, suppression d'un mutualiste critique, accès à des données sensibles) ?

---

**UC 55 - Gérer les rôles et permissions**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** Super admin

-   **Description :** Permet à un Super admin de définir la structure des droits d'accès dans le système en créant, modifiant et supprimant des rôles. Pour chaque rôle, le Super admin associe l'ensemble précis des permissions (actions autorisées) que les admins ayant ce rôle posséderont.

-   **Préconditions :**

    -   Le Super admin est authentifié dans le système avec un compte disposant des droits complets pour gérer les rôles et les permissions.
    -   L'interface d'administration pour la gestion des rôles et permissions est accessible.
    -   La liste exhaustive des permissions granulaires disponibles dans l'application (définies au niveau technique/fonctionnel) est accessible dans l'interface de gestion.
    -   (Pour modification/visualisation/suppression) Le rôle spécifique à gérer existe déjà.

-   **Postconditions :**

    -   Un nouveau rôle est créé dans le système, avec un nom, une description et un ensemble de permissions associées.
    -   Un rôle existant est mis à jour (son nom, sa description, ou les permissions qui lui sont associées sont modifiés).
    -   Un rôle existant est supprimé (sous réserve qu'il ne soit plus utilisé).
    -   La structure des droits d'accès et des permissions dans l'application est mise à jour.
    -   Un enregistrement d'audit détaillé est créé pour l'action de gestion effectuée sur les rôles/permissions (qui a fait quoi, sur quel rôle, quelle modification, quand).

-   **Scénario principal (Combinant Création, Consultation, Modification, Suppression de Rôles) :**

    1.  Le Super admin se connecte à l'interface d'administration (UC 1 implicite).
    2.  Le Super admin navigue vers la section de gestion des utilisateurs, puis vers la sous-section "Rôles et Permissions".
    3.  Le système affiche la liste de tous les rôles actuellement configurés dans le système. Pour chaque rôle, des informations comme le Nom du rôle, une courte Description, et potentiellement le nombre d'admins actuellement assignés à ce rôle (pour aider à la gestion des dépendances) sont présentées. Des options pour "Créer un nouveau rôle", "Visualiser/Modifier", et "Supprimer" sont disponibles pour chaque rôle (selon qu'il est modifiable/supprimable).

    -   **Sous-Scénario Principal A : Créer un nouveau rôle**

        -   4a. Le Super admin clique sur le bouton "Créer un nouveau rôle".
        -   5a. Le système affiche un formulaire de création de rôle, incluant des champs pour le Nom du rôle, la Description, et une interface pour sélectionner les permissions.
        -   6a. Le Super admin saisit un Nom unique pour le rôle (ex: "Gestionnaire Adhérents Senior", "Support Niveaux 1", "Comptable Principal").
        -   7a. Le Super admin saisit une Description expliquant le but ou les responsabilités de ce rôle.
        -   8a. Le système affiche une liste structurée de toutes les permissions granulaires disponibles dans l'application (ex: par module, par type d'action - Créer, Lire, Modifier, Supprimer).
        -   9a. Le Super admin associe les permissions souhaitées à ce rôle en les sélectionnant dans la liste (ex: en cochant des cases). Par exemple, pour un rôle "Gestionnaire Adhérents Senior", il pourrait cocher des permissions comme `mutualiste.creer`, `mutualiste.visualiser.tout`, `mutualiste.modifier.tout`, `ayantdroit.gerer.tout`, `document.mutualiste.gerer`, mais pas `parametres.systeme.gerer` ou `utilisateur.admin.gerer`.
        -   10a. Le Super admin vérifie le nom, la description et l'ensemble des permissions sélectionnées pour le nouveau rôle.
        -   11a. Le Super admin clique sur le bouton "Enregistrer le rôle".
        -   12a. Le système valide les données saisies (Nom unique, Description non vide, permissions sélectionnées valides).
        -   13a. Si les validations réussissent, le système crée le nouvel enregistrement de rôle dans la base de données et établit les liens avec les permissions sélectionnées.
        -   14a. Le système enregistre l'historique de la création de ce rôle et des permissions associées.
        -   15a. Le système affiche un message de confirmation (ex: "Rôle '[Nom du rôle]' créé avec succès."). La liste des rôles est mise à jour.

    -   **Sous-Scénario Principal M : Visualiser / Modifier un rôle existant**

        -   4m. Le Super admin sélectionne un rôle dans la liste (clique sur son nom ou un bouton "Visualiser/Modifier").
        -   5m. Le système affiche les informations du rôle sélectionné (Nom, Description) dans un formulaire éditable, ainsi que la liste complète des permissions disponibles, indiquant clairement lesquelles sont actuellement associées à ce rôle.
        -   6m. Le Super admin peut modifier le Nom (si autorisé) et la Description du rôle.
        -   7m. Le Super admin peut ajouter ou retirer des permissions associées à ce rôle en modifiant la sélection dans la liste des permissions disponibles (ex: cocher de nouvelles permissions, décocher celles qui ne doivent plus être associées).
        -   8m. Le Super admin vérifie les modifications apportées (nom, description, ensemble des permissions).
        -   9m. Le Super admin clique sur le bouton "Enregistrer les modifications".
        -   10m. Le système valide les données modifiées et les nouvelles associations de permissions. Il peut y avoir des validations (ex: ne pas pouvoir retirer certaines permissions critiques du rôle "Super Admin").
        -   11m. Si les validations réussissent, le système met à jour l'enregistrement du rôle et ses associations de permissions dans la base de données. Les admins ayant ce rôle auront leurs permissions effectives mises à jour (potentiellement à leur prochaine connexion ou immédiatement selon l'implémentation technique des droits).
        -   12m. Le système enregistre l'historique de cette modification de rôle (incluant les changements de permissions).
        -   13m. Le système affiche un message de confirmation (ex: "Rôle '[Nom du rôle]' mis à jour avec succès."). La liste des rôles est mise à jour si nécessaire.

    -   **Sous-Scénario Principal D : Supprimer un rôle (si applicable)**
        -   4d. Le Super admin sélectionne un rôle dans la liste (étape 3) et clique sur l'option "Supprimer". L'option "Supprimer" peut être grisée ou absente si le rôle n'est pas supprimable (ex: rôle système, rôle assigné à des utilisateurs).
        -   5d. Si l'option "Supprimer" est disponible, le système vérifie à nouveau qu'aucun admin n'est actuellement assigné à ce rôle.
        -   6d. Si aucune dépendance (admins assignés) n'est trouvée et si le rôle n'est pas un rôle système non supprimable, le système demande une confirmation explicite de l'action ("Êtes-vous sûr de vouloir supprimer le rôle '[Nom du rôle]' ? Cette action est irréversible et affectera les utilisateurs qui pourraient y être assignés à l'avenir.").
        -   7d. Le Super admin confirme la suppression.
        -   8d. Le système supprime l'enregistrement du rôle et toutes ses associations aux permissions granulaires.
        -   9d. Le système enregistre l'historique de la suppression de ce rôle.
        -   10d. Le système affiche un message de confirmation (ex: "Rôle '[Nom du rôle]' supprimé avec succès."). La liste des rôles est mise à jour.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'opération**

        -   Applicable à chaque sous-scénario avant la validation finale (étapes 11a, 9m, 7d). Le Super admin annule l'action en cours. Le système abandonne le processus de création, modification ou suppression.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides (Créer ou Modifier)**

        -   Applicable aux sous-scénarios A (étape 12a) et M (étape 10m). La validation des données saisies échoue (ex: Nom du rôle vide, Nom de rôle déjà utilisé pour un autre rôle).
        -   Le système affiche un message d'erreur précis (ex: "Le nom du rôle est obligatoire", "Ce nom de rôle existe déjà"). L'admin reste sur le formulaire pour corriger les informations.

    -   **Scénario Alternatif A3 : Tentative de supprimer un rôle assigné à des admins (Supprimer)**

        -   Applicable au sous-scénario D (étape 5d). Le système détecte que le rôle que le Super admin tente de supprimer est actuellement assigné à un ou plusieurs comptes admins.
        -   Le système bloque la suppression et affiche un message d'erreur (ex: "Ce rôle ne peut pas être supprimé car [X] admins y sont encore assignés. Veuillez d'abord désassigner ce rôle des comptes utilisateurs."). L'admin doit gérer les utilisateurs concernés (UC 53) avant de pouvoir supprimer le rôle.

    -   **Scénario Alternatif A4 : Tentative de modifier ou supprimer un rôle système critique ou le rôle du Super Admin connecté**

        -   Applicable aux sous-scénarios M et D. Le système détecte que le rôle est un rôle essentiel au fonctionnement du système (ex: le rôle "Super Admin" lui-même) ou est le rôle du compte Super admin actuellement connecté.
        -   Le système bloque certaines modifications (ex: retrait de permissions critiques du rôle Super Admin) ou la suppression totale de ces rôles pour des raisons de sécurité et de stabilité. Un message d'erreur approprié est affiché.

    -   **Scénario d'Exception E1 : Rôle introuvable (Visualiser, Modifier, Supprimer)**

        -   Applicable aux sous-scénarios M (étape 4m) et D (étape 4d). Le rôle sélectionné par le Super admin n'est pas trouvé dans le système (ex: a été supprimé par un autre Super Admin juste avant l'action, ou il y a une erreur interne).
        -   Le système affiche un message d'erreur indiquant que le rôle n'a pas été trouvé. L'opération sur ce rôle spécifique ne peut pas se poursuivre.

    -   **Scénario d'Exception E2 : Erreur système lors de l'enregistrement, la mise à jour ou la suppression du rôle/permissions**
        -   Applicable aux sous-scénarios A (étape 13a), M (étape 11m) et D (étape 8d). Une erreur technique imprévue se produit lors de la tentative de sauvegarder la création, de mettre à jour, ou de supprimer l'enregistrement du rôle ou ses associations de permissions dans la base de données.
        -   Le système enregistre l'erreur technique dans ses logs internes.
        -   Le système affiche un message d'erreur générique au Super admin (ex: "Une erreur système s'est produite lors de la gestion du rôle."). L'opération échoue.

-   **Points à considérer pour la suite :**
    -   La liste des permissions disponibles (étape 8a, 5m) doit être exhaustive et claire. Comment est-elle générée et maintenue en phase avec le développement des fonctionnalités de l'application ?
    -   Comment la complexité des règles de permission est-elle gérée (par exemple, des permissions qui s'excluent mutuellement, des permissions conditionnelles) ?
    -   Quand les changements de permissions prennent-ils effet pour les admins connectés (immédiatement ou à la prochaine connexion) ?
    -   L'interface permet-elle de visualiser facilement l'ensemble des permissions associées à un rôle ?
    -   Existe-t-il un historique des modifications apportées à un rôle spécifique (qui a changé quelles permissions, quand) ?

---

**UC 56 - Gérer la politique de mot de passe**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** Super admin

-   **Description :** Permet à un Super admin de configurer les paramètres de sécurité relatifs aux mots de passe utilisés dans l'application (complexité, longueur, durée de vie) et les règles de verrouillage des comptes en cas de tentatives de connexion échouées.

-   **Préconditions :**

    -   Le Super admin est authentifié dans le système avec un compte disposant des droits nécessaires pour accéder et modifier les paramètres de sécurité système, y compris la politique de mot de passe.
    -   L'interface d'administration dédiée à la configuration de la politique de mot de passe est accessible.
    -   Les exigences de sécurité concernant les mots de passe sont connues (définies par les politiques de la mutuelle).

-   **Postconditions :**

    -   Les règles de la politique de mot de passe et les paramètres de verrouillage de compte sont mis à jour dans la configuration du système.
    -   Ces nouvelles règles s'appliquent désormais aux changements de mot de passe, aux créations de compte, et aux tentatives de connexion futures.
    -   Un enregistrement d'audit détaillé est créé pour la modification de la politique de sécurité (qui, quand, quelles modifications).

-   **Scénario principal :**

    1.  Le Super admin se connecte à l'interface d'administration (UC 1 implicite).
    2.  Le Super admin navigue dans le menu vers la section "Administration Système", "Sécurité", ou "Gestion des Utilisateurs", puis accède à la sous-section "Politique de mot de passe" ou "Paramètres de sécurité".
    3.  Le système affiche l'interface de configuration de la politique de mot de passe. Cette interface présente les paramètres actuellement configurés, sous forme de champs modifiables. Ces paramètres peuvent inclure (mais ne sont pas limités à) :
        -   **Règles de complexité du mot de passe :**
            -   Longueur minimale requise (ex: 8, 10, 12 caractères).
            -   Exiger une combinaison de caractères (ex: Majuscules, minuscules, chiffres, caractères spéciaux).
            -   Interdire la réutilisation des N derniers mots de passe.
            -   Interdire l'utilisation d'informations personnelles (ex: nom, identifiant).
        -   **Règles de durée de vie du mot de passe :**
            -   Exiger le changement de mot de passe tous les X jours/mois.
            -   Notification d'expiration imminente (ex: N jours avant l'expiration).
        -   **Règles de verrouillage de compte :**
            -   Nombre maximum de tentatives de connexion échouées avant de verrouiller le compte.
            -   Durée du verrouillage (ex: 30 minutes, 24 heures, jusqu'à déverrouillage manuel par un Admin).
        -   **Portée de la politique :**
            -   Appliquer aux comptes admins uniquement.
            -   Appliquer aux comptes mutualistes uniquement.
            -   Appliquer aux deux types de comptes (si la même politique est utilisée).
    4.  Le Super admin visualise les paramètres actuels de la politique de mot de passe et de verrouillage.
    5.  Le Super admin modifie les valeurs des paramètres selon les exigences de sécurité de la mutuelle.
    6.  Le Super admin vérifie les modifications apportées aux règles.
    7.  Le Super admin clique sur un bouton "Enregistrer", "Appliquer", "Mettre à jour la politique", ou similaire.
    8.  Le système valide les valeurs saisies pour chaque paramètre (ex: vérifie que la longueur minimale est un nombre positif, que la durée d'expiration est valide).
    9.  Si les validations réussissent, le système met à jour les paramètres de la politique de mot de passe et de verrouillage de compte dans sa configuration interne.
    10. Le système enregistre un événement détaillé dans les logs d'audit (UC 54) indiquant que la politique de mot de passe a été modifiée, par qui, quand, et potentiellement listant les modifications apportées.
    11. Le système affiche un message de confirmation à l'Super admin (ex: "Politique de mot de passe mise à jour avec succès. Les nouvelles règles sont maintenant appliquées.").
    12. Les nouvelles règles de mot de passe s'appliquent aux prochaines créations/modifications de mot de passe, et les nouvelles règles de verrouillage s'appliquent aux tentatives de connexion futures.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation des modifications**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. Le Super admin décide de ne pas enregistrer les modifications apportées à la politique.
        -   9.a. Le Super admin clique sur un bouton "Annuler" ou quitte la page sans sauvegarder.
        -   10.a. Le système abandonne les modifications en cours.

    -   **Scénario Alternatif A2 : Paramètres invalides détectés lors de la validation**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système valide les valeurs des paramètres saisis et détecte des erreurs (ex: valeur en dehors des plages acceptées, incohérence entre les règles).
        -   10.a. Le système affiche des messages d'erreur clairs à côté des champs concernés, indiquant pourquoi les valeurs sont invalides. Le Super admin reste sur la page pour corriger les paramètres.

    -   **Scénario d'Exception E1 : Erreur système lors de l'enregistrement de la politique de mot de passe**
        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarder les nouveaux paramètres de la politique de mot de passe dans la configuration système (ex: problème de base de données, erreur d'écriture dans un fichier de configuration).
        -   11.e. Le système enregistre l'erreur technique dans ses logs d'erreurs internes.
        -   12.e. Le système affiche un message d'erreur générique à l'Super admin (ex: "Une erreur système s'est produite lors de la sauvegarde des paramètres de sécurité. La politique n'a pas été mise à jour."). L'opération échoue.

-   **Points à considérer pour la suite :**
    -   La politique de mot de passe est-elle la même pour les admins et les mutualistes, ou peuvent-elles être différentes ? (Le scénario principal prévoit une option pour la portée).
    -   Comment le système gère-t-il l'authentification multi-facteurs (MFA) si cette option est configurée (est-ce via ce même UC ou un UC distinct) ?
    -   Comment les utilisateurs sont-ils informés des règles de la politique de mot de passe (notamment à la création de compte, lors d'un changement de mot de passe, ou lorsque la politique est modifiée) ?
    -   Les actions liées aux mots de passe (changements, réinitialisations, tentatives échouées) sont-elles enregistrées dans les logs d'activité (UC 54) ?
    -   Le système permet-il aux utilisateurs (admins et mutualistes) de changer leur propre mot de passe en respectant la politique ? (UC 1 pour le changement de mot de passe après connexion).

---

**UC 57 - Consulter les notifications**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** Mutualiste / admin (tout utilisateur du système)

-   **Description :** Permet à un utilisateur authentifié (Mutualiste ou admin) de consulter la liste des notifications personnalisées générées par le système qui lui sont adressées. Ces notifications l'informent d'événements importants le concernant (messages reçus, échéances, changements de statut, alertes système pour les Admins, etc.).

-   **Préconditions :**

    -   L'utilisateur (Mutualiste ou admin) est authentifié et connecté à son espace (UC 1 pour Mutualiste, authentification pour Admin).
    -   Le système a généré au moins une notification destinée spécifiquement à cet utilisateur.
    -   L'interface de consultation des notifications est accessible à l'utilisateur (potentiellement via un indicateur visuel sur le tableau de bord ou dans l'en-tête de l'application).

-   **Postconditions :**

    -   L'utilisateur a pu consulter la liste de ses notifications.
    -   L'utilisateur a pu ouvrir et lire le contenu d'une notification spécifique.
    -   Aucune modification des notifications n'est effectuée par cette consultation seule (sauf potentiellement marquer comme lue).
    -   La liste des notifications est affichée à l'écran de l'utilisateur.

-   **Scénario principal :**

    1.  L'Utilisateur (Mutualiste ou admin) se connecte au système via son interface respective.
    2.  L'Utilisateur remarque un indicateur visuel (ex: une icône de cloche avec un chiffre) signalant de nouvelles notifications non lues (souvent sur le tableau de bord UC 51/52 ou dans l'en-tête global).
    3.  L'Utilisateur clique sur cet indicateur ou navigue vers la section "Notifications" dans le menu de son espace.
    4.  Le système identifie l'utilisateur authentifié.
    5.  Le système interroge la base de données pour récupérer toutes les notifications qui ont été enregistrées comme étant destinées spécifiquement à cet utilisateur.
    6.  Le système affiche la liste des notifications de l'utilisateur. Pour chaque notification, des informations clés sont présentées, généralement sous forme de liste ou de résumé :
        -   La date et l'heure de génération/réception de la notification.
        -   Un titre ou un objet concis (ex: "Nouveau message", "Prochaine cotisation", "Réclamation n°XYZ mise à jour", "Prêt n°ABC en retard", "Alerte système - faible espace disque" pour un Admin).
        -   Un court aperçu du contenu de la notification si elle en a un.
        -   Un indicateur visuel clair si la notification est non lue.
        -   (Optionnel) Un lien direct qui permet à l'utilisateur de naviguer vers l'élément du système auquel la notification fait référence (ex: cliquer sur "Nouveau message" mène à la conversation dans la messagerie UC 50/48, cliquer sur "Réclamation mise à jour" mène à la vue détaillée de la réclamation UC 44/43).
    7.  L'Utilisateur consulte la liste des notifications. Des options pour trier (par date) ou filtrer (lues/non lues, par type) peuvent être disponibles.
    8.  (Optionnel) L'Utilisateur clique sur une notification spécifique pour afficher son contenu complet (si non entièrement visible dans l'aperçu) ou pour accéder directement à l'élément lié.
    9.  (Optionnel) Lorsque l'Utilisateur ouvre une notification (en cliquant dessus ou en la lisant), le système la marque automatiquement comme "lue" pour cet utilisateur spécifique.
    10. L'Utilisateur prend connaissance des informations contenues dans les notifications.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune notification pour cet utilisateur**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.a. Le système interroge la base de données mais ne trouve aucune notification enregistrée et destinée à cet utilisateur.
        -   6.a. Le système affiche un message indiquant "Vous n'avez aucune notification pour le moment" ou présente une liste vide de notifications.
        -   7.a. L'Utilisateur prend connaissance de l'information.

    -   **Scénario Alternatif A2 : Notification sélectionnée introuvable ou contenu non accessible**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. L'Utilisateur clique sur une notification, mais le système ne parvient pas à trouver cette notification spécifique ou son contenu, ou l'élément lié n'existe plus ou n'est plus accessible.
        -   10.a. Le système affiche un message d'erreur (ex: "Notification introuvable" ou "Impossible d'afficher le contenu de cette notification"). L'affichage peut rester sur la liste des notifications.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération de la liste des notifications**
        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.e. Une erreur technique imprévue se produit lors de la tentative de récupérer la liste des notifications destinées à cet utilisateur depuis la base de données.
        -   6.e. Le système enregistre l'erreur technique dans ses logs internes.
        -   7.e. Le système affiche un message d'erreur générique à l'Utilisateur (ex: "Une erreur s'est produite lors du chargement de vos notifications. Veuillez réessayer."). La liste des notifications n'est pas affichée.

-   **Points à considérer pour la suite :**
    -   Comment les notifications sont-elles _générées_ ? Sont-elles toutes automatiques (déclenchées par des événements système comme une nouvelle cotisation due) ou les admins peuvent-ils en créer et en envoyer manuellement (UC 58) ?
    -   Comment les notifications sont-elles _gérées_ côté administration (visualisation de toutes les notifications envoyées, suppression des anciennes, gestion des types de notifications) ? (UC 58).
    -   Existe-t-il différents _types_ de notifications (simples alertes, rappels, informations, demandes d'action) ?
    -   L'utilisateur peut-il configurer les types de notifications qu'il souhaite recevoir ou le canal (système, email, SMS) ?
    -   Quelle est la politique de conservation des notifications pour les utilisateurs ? Sont-elles archivées ou supprimées après un certain temps ?
    -   La lecture d'une notification marque-t-elle l'événement sous-jacent comme "vu" (ex: lire une notification de message non lu marque aussi le message comme lu) ?

---

**UC 58 - Gérer les notifications**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** admin (ayant les droits de gestion des notifications)

-   **Description :** Permet à un admin de configurer les règles d'envoi des notifications générées par le système, de visualiser l'historique des notifications envoyées, et potentiellement d'envoyer des notifications manuellement à des utilisateurs ou groupes d'utilisateurs.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour accéder et gérer la section des notifications.
    -   Le système de notification est fonctionnel et a des types de notifications prédéfinis.
    -   Le système contient des enregistrements de notifications envoyées (pour la consultation de l'historique).

-   **Postconditions :**

    -   Les règles de configuration des notifications automatiques sont mises à jour.
    -   L'admin a consulté l'historique des notifications envoyées.
    -   (Optionnel) Une ou plusieurs notifications manuelles ont été créées et envoyées aux destinataires sélectionnés.
    -   Un enregistrement d'audit détaillé est créé pour les actions de gestion effectuées sur les notifications.

-   **Scénario principal (Combinant Configuration, Historique, Envoi Manuel) :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Administration Système", "Paramètres de communication", ou "Gestion des notifications".
    3.  Le système affiche l'interface de gestion des notifications. Cette interface peut être organisée en différentes sections :

        -   **Section Configuration des notifications automatiques :**

            -   Liste des types de notifications automatiques disponibles dans le système (ex: "Nouvel Adhérent", "Cotisation Impayée", "Prêt Accordé", "Réclamation Soumise", "Réponse Réclamation", "Nouveau Message Interne", "Retour Matériel Dû").
            -   Pour chaque type, options pour activer/désactiver cette notification.
            -   Pour chaque type, options pour choisir le ou les canaux d'envoi (ex: Notification système (visible dans UC 57), Email, SMS).
            -   Pour chaque type, options pour définir les destinataires (ex: Mutualiste concerné, admin(s) du service X, Super admin).

        -   **Section Historique des notifications envoyées :**

            -   Liste des notifications qui ont été envoyées, avec des détails comme le type, le destinataire(s), la date/heure d'envoi, le canal utilisé, et le statut de l'envoi (Succès/Échec).
            -   Options de filtrage (par date, par type, par canal, par destinataire - Adhérent/Admin/spécifique, par statut d'envoi).
            -   Options de tri.

        -   **Section Envoi de notifications manuelles/groupées (Optionnel) :**
            -   Formulaire pour composer une nouvelle notification.
            -   Champs : Destinataire(s) (ex: sélectionner un mutualiste spécifique, un groupe de mutualistes par filtre, un admin, un rôle), Sujet/Titre, Contenu du message, Choix du canal.

    4.  L'admin choisit l'action qu'il souhaite effectuer :

        -   **Sous-Scénario Principal A : Configurer les notifications automatiques**

            -   5a. L'admin accède à la section de Configuration.
            -   6a. Le système affiche les paramètres actuels.
            -   7a. L'admin modifie les paramètres selon les besoins (ex: active une nouvelle notification, change le canal pour les rappels de cotisation, définit quels Admins sont notifiés des nouvelles réclamations).
            -   8a. L'admin enregistre les modifications de configuration.
            -   9a. Le système valide les paramètres (ex: vérifie la validité des canaux sélectionnés).
            -   10a. Si les validations réussissent, le système met à jour la configuration des notifications automatiques. Les nouvelles règles s'appliqueront aux événements futurs.
            -   11a. Le système enregistre l'historique de cette modification de configuration.
            -   12a. Le système affiche un message de confirmation (ex: "Configuration des notifications automatiques mise à jour.").

        -   **Sous-Scénario Principal H : Consulter l'historique des notifications envoyées**

            -   5h. L'admin accède à la section Historique.
            -   6h. Le système affiche la liste des notifications envoyées. L'admin utilise les filtres (par date, type, destinataire...) et le tri pour rechercher et analyser l'activité des notifications (ex: vérifier si les rappels de paiement ont bien été envoyés, identifier des échecs d'envoi pour un canal spécifique).
            -   7h. (Optionnel) L'admin peut cliquer sur une notification dans l'historique pour voir son contenu exact (potentiellement avec le contenu personnalisé s'il y a des variables) et les détails de l'envoi (heure exacte, statut final).

        -   **Sous-Scénario Principal M : Envoyer une notification manuelle (si la fonctionnalité existe)**
            -   5m. L'admin accède à la section d'Envoi manuel.
            -   6m. Le système affiche le formulaire de composition.
            -   7m. L'admin sélectionne le(s) destinataire(s) (ex: recherche et sélectionne un mutualiste, choisit un groupe ou un filtre, sélectionne un admin ou un rôle).
            -   8m. L'admin saisit le Sujet/Titre et le Contenu de la notification.
            -   9m. L'admin choisit le ou les canaux d'envoi (système, email, SMS) parmi ceux disponibles.
            -   10m. L'admin vérifie la notification et les destinataires.
            -   11m. L'admin clique sur "Envoyer".
            -   12m. Le système valide le message (sujet/contenu non vide), les destinataires et les canaux sélectionnés.
            -   13m. Si les validations réussissent, le système crée un enregistrement pour cette notification manuelle et initie son envoi vers le(s) destinataire(s) via le(s) canal(aux) choisi(s).
            -   14m. Le système enregistre l'historique de cet envoi manuel, incluant le message envoyé, les destinataires et le statut d'envoi.
            -   15m. Le système affiche un message de confirmation (ex: "Notification manuelle envoyée.").

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de l'opération**

        -   Applicable aux sous-scénarios A et M avant l'enregistrement/l'envoi. L'admin annule l'action. Le système abandonne le processus.

    -   **Scénario Alternatif A2 : Paramètres/Données invalides détectés**

        -   Applicable aux sous-scénarios A (étape 9a) et M (étape 12m). La validation des données (configuration ou contenu/destinataires) échoue. Le système affiche des messages d'erreur spécifiques. L'admin reste sur l'interface pour corriger.

    -   **Scénario Alternatif A3 : Aucune notification dans l'historique (pour consultation)**

        -   Applicable au sous-scénario H (étape 6h). Le système interroge l'historique mais ne trouve aucune notification envoyée (ou aucune correspondant aux filtres).
        -   Le système affiche un message indiquant "Aucune notification enregistrée dans l'historique."

    -   **Scénario d'Exception E1 : Erreur système lors de la sauvegarde de la configuration ou de l'historique**

        -   Applicable aux sous-scénarios A (étape 10a), H, M (étape 13m si l'enregistrement de l'historique échoue). Une erreur technique imprévue se produit lors de la tentative de sauvegarder la configuration ou de récupérer/enregistrer des données dans l'historique des notifications.
        -   Le système enregistre l'erreur technique. Le système affiche un message d'erreur générique à l'admin. L'opération (sauvegarde ou consultation) échoue.

    -   **Scénario d'Exception E2 : Erreur système lors de l'envoi de notifications manuelles**

        -   Applicable au sous-scénario M (étape 13m). Une erreur technique se produit lors de l'initiation de l'envoi des notifications (ex: problème de connexion au service d'envoi d'emails/SMS).
        -   Le système enregistre l'erreur technique. L'admin est informé qu'une erreur est survenue lors de l'envoi. L'historique peut enregistrer l'échec.

    -   **Points à considérer pour la suite :**
        -   Comment les différents types de notifications automatiques sont-ils définis et liés aux événements du système ?
        -   La personnalisation du contenu des notifications (utiliser des variables comme le nom du mutualiste, le montant, la date) est-elle possible ? (Liaison avec la gestion des modèles).
        -   La gestion des canaux d'envoi (configuration des serveurs email, des passerelles SMS) est-elle gérée dans ce module ou un module technique distinct ?
        -   La politique de conservation des notifications (combien de temps l'historique est-il gardé) est-elle configurable ?
        -   Les utilisateurs peuvent-ils configurer leurs préférences de réception de notification (quels types, quels canaux) ? (UC côté utilisateur, potentiellement dans Module 4).

---

**UC 59 - Gérer la configuration système**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** Super admin

-   **Description :** Permet à un Super admin de consulter et de modifier les paramètres de configuration globaux de l'application de la mutuelle. Ces paramètres affectent le comportement général du système et peuvent inclure des informations organisationnelles, des paramètres techniques, des options d'intégration, etc.

-   **Préconditions :**

    -   Le Super admin est authentifié dans le système avec un compte disposant des droits de configuration système nécessaires.
    -   L'interface d'administration dédiée à la configuration système est accessible.
    -   Le système a des paramètres de configuration globaux définis (par défaut ou configurés précédemment).

-   **Postconditions :**

    -   Les paramètres de configuration globaux du système sont mis à jour selon les modifications effectuées par le Super admin.
    -   Les nouvelles valeurs des paramètres sont enregistrées.
    -   Un enregistrement d'audit détaillé est créé pour la modification de la configuration système (qui, quand, quels paramètres modifiés).
    -   Les modifications apportées aux paramètres de configuration prennent effet (immédiatement ou après un redémarrage de service si nécessaire).

-   **Scénario principal :**

    1.  Le Super admin se connecte à l'interface d'administration (UC 1 implicite).
    2.  Le Super admin navigue dans le menu vers la section "Administration Système", "Configuration", "Paramètres Globaux", ou similaire.
    3.  Le système affiche l'interface de configuration système. Cette interface présente les différents groupes ou catégories de paramètres globaux sous forme de champs modifiables, potentiellement organisés en onglets ou sections (ex: Informations générales mutuelle - Nom, Adresse, Contact ; Paramètres Email - Serveur SMTP ; Paramètres techniques - Timeout sessions, Log level ; Intégrations - Clés API pour services tiers ; Paramètres par défaut - Devise par défaut, fuseau horaire).
    4.  Le Super admin visualise les paramètres actuels de la configuration système.
    5.  Le Super admin modifie les valeurs d'un ou plusieurs paramètres de configuration selon les besoins.
    6.  Le Super admin vérifie les modifications apportées.
    7.  Le Super admin clique sur un bouton "Enregistrer", "Sauvegarder la configuration", "Appliquer les paramètres", ou similaire.
    8.  Le système valide les valeurs saisies pour chaque paramètre modifié (ex: format d'email valide, URL correcte, valeur numérique dans une plage acceptable).
    9.  Si les validations réussissent, le système met à jour les paramètres de configuration globaux dans sa source de configuration interne (base de données, fichiers de configuration).
    10. Le système enregistre un événement détaillé dans les logs d'audit (UC 54) indiquant que la configuration système a été modifiée, par qui, quand, et potentiellement en listant les paramètres spécifiques qui ont été changés.
    11. Le système affiche un message de confirmation à l'Super admin (ex: "Configuration système mise à jour avec succès.").
    12. Les modifications prennent effet (immédiatement ou après le prochain chargement de la configuration par les services, potentiellement nécessitant un redémarrage de service pour les changements critiques).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation des modifications**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. Le Super admin décide de ne pas enregistrer les modifications apportées à la configuration.
        -   9.a. Le Super admin clique sur un bouton "Annuler" ou quitte la page sans sauvegarder.
        -   10.a. Le système abandonne les modifications en cours.

    -   **Scénario Alternatif A2 : Paramètres invalides détectés lors de la validation**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système valide les valeurs des paramètres saisis et détecte des erreurs (ex: format incorrect pour une adresse email du support, valeur de timeout négative).
        -   10.a. Le système affiche des messages d'erreur clairs à côté des champs concernés, indiquant pourquoi les valeurs sont invalides. Le Super admin reste sur la page pour corriger les paramètres.

    -   **Scénario d'Exception E1 : Erreur système lors de l'enregistrement de la configuration**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarder les nouveaux paramètres dans la source de configuration (ex: problème de base de données, erreur d'écriture dans un fichier).
        -   11.e. Le système enregistre l'erreur technique dans ses logs d'erreurs internes.
        -   12.e. Le système affiche un message d'erreur générique à l'Super admin (ex: "Une erreur système s'est produite lors de la sauvegarde de la configuration. Les changements n'ont pas été enregistrés."). L'opération échoue.

    -   **Scénario d'Exception E2 : Les modifications nécessitent un redémarrage de service qui échoue**
        -   ... (Après l'étape 11 du scénario principal, si la modification nécessite un redémarrage)
        -   12.e. Le système tente de redémarrer un service ou de recharger la configuration, mais cette opération échoue.
        -   13.e. Le système enregistre l'échec technique. L'admin est informé que les modifications ont été enregistrées, mais qu'elles ne sont peut-être pas encore effectives en raison d'un problème technique nécessitant une intervention manuelle (ex: "Configuration enregistrée, mais une erreur est survenue lors du redémarrage des services. Les changements pourraient ne pas être appliqués.").

-   **Points à considérer pour la suite :**
    -   Quels sont les paramètres de configuration spécifiques qui sont gérables via cette interface ?
    -   La modification de certains paramètres peut-elle avoir des conséquences importantes sur le fonctionnement du système ? Y a-t-il des avertissements supplémentaires pour ces cas ?
    -   L'interface est-elle bien organisée pour naviguer facilement entre les différents types de paramètres ?
    -   L'accès à certains groupes de paramètres est-il encore plus restreint (même parmi les Super Admins) ?
    -   L'historique des modifications de configuration est-il détaillé dans les logs d'audit (UC 54) ?

---

**UC 60 - Visualiser les rapports**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** admin (avec les droits de consultation des rapports)

-   **Description :** Permet à un admin d'accéder à la bibliothèque des rapports prédéfinis disponibles dans le système, de sélectionner un rapport et d'en afficher le contenu. Ces rapports fournissent des analyses structurées et des indicateurs détaillés basés sur les données du système.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour accéder à la section "Rapports" et visualiser certains rapports.
    -   Des rapports sont configurés, générés (ou générables) et disponibles dans le système.
    -   Le système contient des données pertinentes pour les rapports.

-   **Postconditions :**

    -   L'admin a consulté la liste des rapports disponibles et/ou le contenu d'un rapport spécifique. Aucune modification des données sous-jacentes n'est effectuée.
    -   La liste des rapports et/ou le contenu du rapport sélectionné est affiché à l'écran de l'admin.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Rapports", "Statistiques", "Analyse", ou similaire.
    3.  Le système affiche une liste des rapports disponibles auxquels l'admin a accès, potentiellement organisée par catégories (ex: Adhérents, Finance, Services, Actes de Gestion). Pour chaque rapport, le système affiche son titre (ex: "Rapport Mensuel des Cotisations Perçues"), une brève description et potentiellement sa date de dernière mise à jour ou génération.
    4.  L'admin consulte la liste des rapports disponibles.
    5.  L'admin sélectionne le rapport qu'il souhaite visualiser en cliquant sur son titre ou un bouton "Visualiser".
    6.  (Optionnel) Si le rapport est un rapport dynamique ou paramétrable, le système peut présenter un formulaire demandant à l'admin de spécifier des critères ou des paramètres pour générer le rapport (ex: sélectionner une période de date de début/fin, choisir un type de prestation, filtrer par statut de prêt).
    7.  L'admin saisit les paramètres du rapport si nécessaire et valide (clique sur "Générer Rapport" ou "Appliquer").
    8.  Le système récupère les données nécessaires depuis la base de données, effectue les calculs ou agrégations requis, et génère le contenu du rapport en fonction des paramètres spécifiés (s'il y en a).
    9.  Le système affiche le contenu du rapport à l'écran. Le rapport peut être présenté sous forme de tableau, de graphique, de texte structuré, ou une combinaison.
    10. L'admin consulte les informations, les statistiques et les analyses présentées dans le rapport pour obtenir des insights.
    11. (Optionnel) Depuis la vue du rapport, l'admin peut avoir des options supplémentaires (ex: revenir à la liste des rapports, modifier les paramètres de génération, imprimer le rapport, ou exporter le rapport - ce dernier étant géré par l'UC 61).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucun rapport disponible ou accessible pour cet admin**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système interroge la base de données mais ne trouve aucun rapport configuré ou accessible spécifiquement à cet admin, ou la section Rapports est vide.
        -   5.a. Le système affiche un message indiquant "Aucun rapport disponible pour le moment" ou "Vous n'avez accès à aucun rapport.".
        -   6.a. L'admin prend connaissance de l'information.

    -   **Scénario Alternatif A2 : Rapport sélectionné introuvable ou non accessible après sélection dans la liste**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. Le système ne trouve pas le rapport sélectionné par l'admin (ex: il a été supprimé juste avant) ou l'admin n'a plus les droits d'y accéder.
        -   7.a. Le système affiche un message d'erreur (ex: "Rapport introuvable" ou "Vous n'avez pas accès à ce rapport."). L'affichage peut revenir à la liste des rapports (si elle existe).

    -   **Scénario Alternatif A3 : Paramètres de rapport requis manquants ou invalides**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. L'admin ne fournit pas les paramètres requis pour générer le rapport, ou les valeurs saisies sont invalides (ex: date de fin antérieure à la date de début, valeur numérique invalide).
        -   9.a. Le système affiche des messages d'erreur indiquant les paramètres manquants ou invalides. L'admin est invité à corriger les paramètres dans le formulaire.

    -   **Scénario Alternatif A4 : Aucune donnée pour générer le rapport avec les paramètres donnés**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système exécute la requête pour le rapport avec les paramètres donnés, mais constate qu'aucune donnée ne correspond aux critères (ex: aucun paiement enregistré sur la période demandée).
        -   10.a. Le système affiche le rapport généré, mais les tableaux ou graphiques correspondants sont vides, avec un message indiquant "Aucune donnée trouvée pour cette période/ces critères".
        -   11.a. L'admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors du chargement de la liste des rapports ou de la visualisation d'un rapport**
        -   ... (Étapes 1 à 6 ou Étapes 1 à 8 du scénario principal)
        -   7.e. / 9.e. Une erreur technique imprévue se produit lors de la tentative de récupérer la liste des rapports disponibles, de récupérer les données nécessaires pour un rapport spécifique, de générer le rapport lui-même, ou de l'afficher dans l'interface.
        -   8.e. / 10.e. Le système enregistre l'erreur technique dans ses logs internes.
        -   9.e. / 11.e. Le système affiche un message d'erreur générique à l'admin (ex: "Une erreur s'est produite lors du chargement des rapports. Veuillez réessayer."). Les rapports ne peuvent pas être consultés.

-   **Points à considérer pour la suite :**
    -   Quels sont les types de rapports nécessaires pour chaque module métier (finance, adhérents, services, etc.) ?
    -   Comment les rapports sont-ils définis et configurés dans le système (est-ce un UC dédié, ou une partie du développement) ?
    -   L'accès à des rapports spécifiques est-il contrôlé par les rôles et permissions des admins (UC 55) ?
    -   Les rapports peuvent-ils être planifiés pour une génération automatique et envoyés par email (reporting planifié) ?
    -   L'admin peut-il exporter le contenu des rapports dans différents formats (Excel, PDF) ? (UC 61).
    -   Comment la performance de la génération de rapports complexes sur de grandes quantités de données est-elle gérée ?

---

**UC 61 - Exporter des données**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** admin (avec les droits d'exportation appropriés)

-   **Description :** Permet à un admin disposant des droits nécessaires d'extraire une sélection de données depuis le système (listes d'adhérents, détails de prêts, résultats de rapports, historique de transactions, etc.) et de les enregistrer dans un fichier téléchargeable, dans différents formats couramment utilisés.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et possède les droits d'exportation pour les types de données ou les rapports qu'il souhaite extraire.
    -   Le système contient les données à exporter.
    -   L'admin a identifié la source des données à exporter (une liste, un rapport, un filtre spécifique).
    -   Le système supporte les formats d'exportation souhaités par l'admin.

-   **Postconditions :**

    -   Un fichier contenant les données exportées est généré par le système.
    -   Le système propose le fichier généré au téléchargement par l'admin.
    -   Un enregistrement d'audit détaillé est créé pour l'action d'exportation (qui, quand, quel type de données, filtres appliqués, format).

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue vers la section du système contenant les données qu'il souhaite exporter. Cela peut être :
        -   Une liste générale d'entités (ex: liste des mutualistes (UC 3), liste des prêts (UC 17), liste des prises en charge (UC 29)).
        -   Les résultats d'une recherche ou d'un filtre appliqué sur une liste.
        -   La vue détaillée d'un rapport spécifique (UC 60).
        -   Une section dédiée à l'exportation par type de données.
    3.  L'admin sélectionne l'option ou le bouton "Exporter", "Télécharger", "Exporter au format...", ou similaire, qui est disponible dans la vue des données ou du rapport.
    4.  Le système peut présenter une interface ou une boîte de dialogue permettant de configurer l'exportation. Les options de configuration peuvent inclure :
        -   **Format du fichier :** Choisir le format souhaité (ex: CSV, XLSX (Excel), PDF, XML).
        -   **Données à inclure :** Pour les listes, sélectionner les colonnes à exporter. Pour les rapports, l'ensemble du contenu formaté ou les données brutes du rapport.
        -   **Période / Filtres :** Confirmer ou ajuster la période ou les filtres à appliquer à l'exportation (si l'exportation est lancée depuis une liste filtrée ou un rapport paramétré).
        -   **(Optionnel) Options avancées :** Délimiteur pour CSV, inclusion d'en-têtes, etc.
    5.  L'admin configure les options d'exportation selon ses besoins et valide (clique sur "Générer et télécharger", "Exporter").
    6.  Le système récupère les données pertinentes depuis la base de données, en appliquant les filtres ou critères spécifiés.
    7.  Le système génère le fichier d'exportation dans le format choisi, en structurant les données conformément aux options sélectionnées.
    8.  Une fois le fichier généré, le système initie le téléchargement du fichier via le navigateur web de l'admin.
    9.  L'admin télécharge le fichier sur son poste ou un emplacement réseau.
    10. Le système enregistre un événement détaillé dans les logs d'audit (UC 54) indiquant que l'exportation a eu lieu, par quel admin, à quelle date/heure, quel type de données a été exporté, le format, et potentiellement les filtres appliqués.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation par l'admin**

        -   ... (Étapes 1 à 6 ou 1 à 9 du scénario principal)
        -   7.a. / 10.a. L'admin décide d'annuler l'exportation (avant la génération ou pendant le téléchargement).
        -   8.a. / 11.a. Le système abandonne le processus en cours.

    -   **Scénario Alternatif A2 : Données à exporter introuvables (suite à des filtres ou sélection)**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système récupère les données selon les critères, mais constate qu'aucune donnée ne correspond (ex: export d'une liste filtrée qui ne contient aucun élément).
        -   8.a. Le système affiche un message (ex: "Aucune donnée à exporter pour les critères sélectionnés") et ne génère généralement pas de fichier, ou génère un fichier vide avec un message à l'intérieur.

    -   **Scénario Alternatif A3 : Format d'exportation non supporté pour ce type de données**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. L'admin sélectionne un format (ex: PDF) qui n'est pas supporté pour l'exportation des données spécifiques sélectionnées (ex: seule l'exportation en CSV est disponible pour cette liste).
        -   8.a. Le système affiche un message d'erreur (ex: "Format d'exportation non supporté. Veuillez choisir un autre format.").

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération des données ou de la génération du fichier**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.e. Une erreur technique imprévue se produit lors de la lecture des données depuis la base de données, lors du traitement des données, ou lors de la génération du fichier d'exportation (ex: erreur de formatage, problème de mémoire, disque plein sur le serveur).
        -   10.e. Le système enregistre l'erreur technique dans ses logs internes.
        -   11.e. Le système affiche un message d'erreur générique à l'admin (ex: "Une erreur s'est produite lors de l'exportation des données. Veuillez réessayer plus tard."). Le fichier n'est pas généré ou n'est pas téléchargeable.

    -   **Scénario d'Exception E2 : L'exportation prend trop de temps et expire**
        -   ... (Étapes 1 à 8 du scénario principal, pour un très grand volume de données)
        -   9.e. Le processus de génération du fichier d'exportation prend un temps excessivement long et dépasse la limite de temps configurée par le système (timeout).
        -   10.e. Le système annule le processus. L'admin reçoit un message d'erreur indiquant que l'exportation a échoué en raison d'un délai d'attente. Le système pourrait suggérer de filtrer les données pour réduire le volume.

-   **Points à considérer pour la suite :**
    -   Quels sont les types de données qui peuvent être exportés (toutes les listes, tous les rapports, des vues spécifiques) ?
    -   Quels formats d'exportation sont nécessaires (CSV, XLSX, PDF sont les plus courants) ?
    -   Comment les données sensibles sont-elles gérées lors de l'exportation (masquage de certaines colonnes, chiffrement du fichier) ?
    -   Des limites de volume de données exportables en une seule opération sont-elles nécessaires pour éviter de surcharger le système ?
    -   Existe-t-il une fonction pour planifier des exportations récurrentes (ex: un rapport hebdomadaire envoyé par email) ?
    -   Les exportations sont-elles enregistrées en détail dans les logs d'audit (UC 54) pour la conformité ?

---

**UC 62 - Importer des données**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** admin (avec les droits d'importation appropriés)

-   **Description :** Permet à un admin disposant des droits nécessaires d'uploader un fichier contenant des données structurées (ex: liste de nouveaux adhérents, mises à jour de cotisations, historique de prêts d'un ancien système) et de déclencher un processus d'importation pour créer ou mettre à jour des enregistrements dans le système.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et possède les droits pour importer les types de données souhaitées.
    -   Les données à importer sont prêtes dans un fichier externe (ex: CSV, XLSX).
    -   Le fichier respecte le format et la structure attendus pour le type d'importation choisi.
    -   Le système d'importation est configuré pour gérer le type spécifique de données.

-   **Postconditions :**

    -   Les données valides du fichier sont importées, créant de nouveaux enregistrements ou mettant à jour des enregistrements existants.
    -   Un rapport détaillé des résultats de l'importation (succès, échecs, erreurs par ligne) est généré.
    -   Un enregistrement d'audit détaillé est créé pour l'action d'importation (qui, quand, quel fichier, quel type de données, résultat).
    -   Les données importées sont disponibles dans le système.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue vers la section "Administration Système", "Outils", "Importation de données", ou vers une section spécifique du module métier où l'importation est pertinente (ex: Module Adhérents > Fonctionnalités d'import).
    3.  Le système affiche l'interface d'importation. L'admin sélectionne le type de données qu'il souhaite importer (ex: "Importer des Mutualistes", "Importer des Cotisations Historiques").
    4.  Le système peut fournir des instructions spécifiques pour ce type d'importation (ex: format de fichier attendu, modèle de fichier téléchargeable, description des colonnes).
    5.  L'admin clique sur un bouton "Sélectionner un fichier", "Uploader le fichier d'import", ou similaire.
    6.  L'admin sélectionne le fichier de données (CSV, Excel, etc.) sur son poste de travail via l'explorateur de fichiers du système d'exploitation.
    7.  L'admin valide la sélection du fichier. Le système télécharge le fichier.
    8.  Le système analyse le fichier uploaddé pour vérifier son format de base et sa structure (ex: nombre de colonnes, présence d'en-têtes). Une étape de mappage des colonnes du fichier aux champs du système peut être nécessaire et présentée à l'admin si le fichier n'a pas un format standard attendu.
    9.  Le système affiche un aperçu des premières lignes du fichier et signale les problèmes de format ou de structure initiaux. L'admin vérifie que le fichier est correctement interprété. 10. L'admin clique sur un bouton "Lancer l'importation", "Valider et importer", ou similaire. 11. Le système démarre le processus de traitement du fichier ligne par ligne. Pour chaque ligne, il :
        _ Effectue les validations de données (ex: format des champs, plages de valeurs, existence d'enregistrements liés, unicité des identifiants pour les créations).
        _ Détermine s'il faut créer un nouvel enregistrement ou mettre à jour un enregistrement existant (basé sur des identifiants uniques comme numéro d'adhérent, référence de prêt, etc., selon la configuration de l'importation).
        _ Applique les règles métier lors de la création/mise à jour.
        _ Gère les erreurs de validation spécifiques à cette ligne (ex: ligne ignorée, enregistrement non mis à jour). 12. Le système traite toutes les lignes du fichier. Pendant ou après le traitement, il compile un rapport détaillé des résultats de l'importation, incluant :
        _ Nombre total de lignes traitées.
        _ Nombre d'enregistrements créés avec succès.
        _ Nombre d'enregistrements mis à jour avec succès.
        _ Nombre de lignes ignorées ou ayant échoué. \* Pour les lignes ayant échoué, la ligne concernée et la raison spécifique de l'échec (ex: "Mutualiste n° [Numéro] introuvable pour mise à jour", "Date de naissance invalide", "Identifiant mutualiste déjà existant"). 13. Le système affiche le rapport de résultat de l'importation à l'admin. 14. Le système enregistre un événement détaillé dans les logs d'audit (UC 54) indiquant que l'importation a eu lieu, par qui, à quelle date/heure, quel type de données a été importé, le nom du fichier source, et un résumé du rapport de résultat (succès/échecs).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation par l'admin**

        -   Applicable pendant l'upload (étape 7), le mappage/pré-validation (étape 9), ou potentiellement pendant le traitement réel si l'importation est un long processus visible (étape 11). L'admin annule l'opération. Le système arrête le processus ; si le traitement était en cours, il peut indiquer qu'il est partiellement terminé.

    -   **Scénario Alternatif A2 : Fichier invalide (format, structure, contenu initial)**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système analyse le fichier et détecte un problème majeur (ex: le fichier n'est pas du tout un CSV/Excel valide, format de fichier non supporté, structure de colonnes incohérente pour ce type d'importation).
        -   10.a. Le système affiche un message d'erreur à l'admin (ex: "Le fichier n'est pas valide ou le format n'est pas correct.") et l'importation ne peut pas démarrer.

    -   **Scénario Alternatif A3 : Erreurs de validation de données métier ou de cohérence**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.a. Pendant le traitement, de nombreuses lignes ou des lignes spécifiques contiennent des données qui ne passent pas les validations métier (ex: date illogique, référence inexistante, valeur hors plage autorisée pour un montant).
        -   13.a. Le système gère ces erreurs ligne par ligne, les signale dans le rapport de résultat (étape 13), et continue le traitement des lignes valides si possible.

    -   **Scénario Alternatif A4 : Mappage de colonnes incorrect (si étape de mappage existe)**

        -   ... (Après étape 8 du scénario principal si un mappage est nécessaire)
        -   Le Super admin ne mappe pas correctement une colonne du fichier source vers le champ de destination dans le système. Le système de pré-validation (étape 9) ou de traitement (étape 11) détecte que les données ne peuvent pas être correctement interprétées ou enregistrées pour ces champs. Des erreurs sont signalées dans l'aperçu ou dans le rapport de résultat, potentiellement bloquant l'importation si des champs obligatoires sont mal mappés.

    -   **Scénario d'Exception E1 : Erreur système critique pendant le traitement de l'importation**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue et non gérée ligne par ligne se produit pendant le traitement (ex: problème majeur de base de données, erreur d'allocation mémoire pour un très gros fichier).
        -   13.e. Le processus d'importation s'arrête anormalement. Le système enregistre l'erreur technique. Le rapport de résultat peut être incomplet ou non généré, indiquant un échec général. L'admin reçoit un message d'erreur générique.

    -   **Scénario d'Exception E2 : Le rapport de résultat ne peut pas être généré ou affiché**
        -   ... (Après l'étape 12 du scénario principal)
        -   13.e. Le système rencontre une erreur lors de la tentative de compiler ou d'afficher le rapport de résultat de l'importation à l'admin.
        -   14.e. Le système enregistre l'erreur. L'admin est informé qu'une erreur s'est produite lors de la génération du rapport final, même si l'importation elle-même a pu réussir ou échouer partiellement.

-   **Points à considérer pour la suite :**
    -   Quels types de données sont importables et quels sont les formats de fichiers supportés ?
    -   Comment les identifiants uniques sont-ils gérés pour distinguer les créations des mises à jour d'enregistrements existants ?
    -   Le système propose-t-il des modèles de fichiers (templates) à télécharger pour chaque type d'importation ?
    -   Comment la validation des données est-elle configurée (règles métier) ?
    -   Les importations de gros fichiers peuvent-elles s'exécuter en arrière-plan pour ne pas bloquer l'interface utilisateur ? Comment l'admin est-il informé de la fin d'une importation en arrière-plan ?
    -   Comment l'historique des importations (qui a importé quoi, quand, avec quel résultat) est-il suivi et consultable ? (Liaison avec UC 54 et potentiellement un UC dédié à l'historique des imports).
    -   Est-il possible de "revenir en arrière" (rollback) sur une importation en cas d'erreur majeure ?

---

**UC 63 - Archiver des données**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** admin (avec les droits d'archivage des données)

-   **Description :** Permet à un admin disposant des droits nécessaires d'exécuter un processus pour marquer comme archivées ou déplacer vers un stockage secondaire les données du système qui ne sont plus activement utilisées (selon des critères prédéfinis, ex: ancienneté, statut clôturé), afin d'optimiser la performance du système principal et de respecter les politiques de conservation des données.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et possède les droits d'administration pour l'archivage des données.
    -   Des règles d'archivage sont définies dans le système pour les différents types de données (ex: Mutualistes, Prêts, Prises en Charge).
    -   Le système contient des données éligibles à l'archivage selon ces règles.
    -   La fonctionnalité d'archivage est configurée et opérationnelle.

-   **Postconditions :**

    -   Les données identifiées comme éligibles sont archivées (marquées comme archivées, déplacées vers un autre emplacement de stockage, ou rendues inactives dans les vues principales).
    -   Le volume de données dans la base de données principale (ou les tables actives) est potentiellement réduit, ce qui peut améliorer les performances.
    -   Un rapport ou un journal du processus d'archivage (éléments traités, succès, échecs) est généré.
    -   Un enregistrement d'audit détaillé est créé pour l'action d'archivage (qui, quand, quel type de données, critères appliqués, résultat).

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Administration Système", "Maintenance", "Gestion des données", ou "Archivage".
    3.  Le système affiche l'interface d'archivage des données. Cette interface présente les différents types d'entités ou de données qui peuvent être archivées (ex: Dossiers Mutualistes, Prêts, Rachats, Aides, Prises en Charge, Messages, Logs).
    4.  Pour chaque type de données archivable, le système affiche les règles d'éligibilité configurées (ex: "Archiver les dossiers Mutualistes dont le statut est 'Radié' depuis plus de 5 ans", "Archiver les Prêts entièrement remboursés depuis plus de 10 ans", "Archiver les Prises en Charge clôturées datant d'avant 2020"). Le système peut également estimer le nombre d'éléments actuellement éligibles à l'archivage pour chaque type.
    5.  L'admin sélectionne le type de données qu'il souhaite archiver (ou peut potentiellement sélectionner plusieurs types).
    6.  (Optionnel) L'admin peut ajuster les critères d'archivage (si les règles le permettent) pour cette exécution spécifique (ex: choisir une période de date différente, exclure certains sous-types).
    7.  L'admin lance le processus d'archivage (clique sur "Démarrer l'archivage", "Exécuter l'archivage pour [Type de données]").
    8.  Le système initie le processus d'archivage en arrière-plan si le volume de données est important, ou l'exécute en temps réel si rapide. Pendant le processus, le système :
        -   Identifie les données qui correspondent aux critères d'éligibilité.
        -   Exécute l'action d'archivage définie pour ce type de données (ex: met à jour un champ `statut_archivage`, déplace les enregistrements vers une autre table, copie/déplace les données vers un système de stockage d'archives séparé).
        -   Gère les dépendances (ex: s'assurer qu'archiver un mutualiste n'impacte pas des données actives liées, ou archiver également les données liées (prêts, prises en charge) si elles sont aussi éligibles).
        -   Journalise les éléments archivés avec succès et ceux qui ont échoué (et pourquoi).
    9.  Si le processus est en arrière-plan, l'interface peut afficher son statut (En cours, Terminé, Échoué). L'admin peut être notifié de la fin du processus.
    10. Une fois le processus terminé (succès partiel ou total, échec), le système génère un rapport de résumé de l'opération d'archivage. Ce rapport indique le type de données archivées, les critères utilisés, le nombre total d'éléments éligibles, le nombre d'éléments archivés avec succès, et le nombre d'échecs avec les raisons.
    11. Le système affiche le rapport de résumé à l'admin dans l'interface d'archivage ou l'envoie par un autre canal.
    12. Le système enregistre un événement détaillé dans les logs d'audit (UC 54) indiquant que l'archivage a été exécuté, par qui, quand, quel type de données, avec quels critères, et un résumé du résultat (nombre d'éléments archivés).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation du processus d'archivage par l'admin**

        -   Applicable si le processus est long et offre une option d'interruption. L'admin annule l'exécution en cours. Le système tente d'arrêter le processus proprement, indiquant que l'archivage est incomplet ou annulé dans le rapport final.

    -   **Scénario Alternatif A2 : Aucune donnée éligible à l'archivage selon les règles**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. Le système exécute la recherche des données éligibles mais n'en trouve aucune correspondant aux règles configurées ou aux critères spécifiés pour cette exécution.
        -   9.a. Le système affiche un message informant l'admin qu'il n'y a aucune donnée à archiver pour le moment avec ces critères. Le processus se termine sans archiver d'éléments.

    -   **Scénario Alternatif A3 : Erreurs de validation de données ou de dépendance empêchant l'archivage de certains éléments**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Pendant le traitement, le système rencontre des incohérences de données ou des dépendances qui empêchent l'archivage de certains éléments spécifiques (ex: un dossier Mutualiste éligible selon l'ancienneté mais toujours lié à un prêt actif par erreur, une prise en charge marquée comme réglée mais avec un statut invalide).
        -   10.a. Le système journalise ces erreurs pour les éléments concernés, les exclut de l'archivage pour éviter les problèmes, et continue le processus pour les éléments valides. Le rapport de résumé (étape 11) liste ces échecs spécifiques.

    -   **Scénario d'Exception E1 : Erreur système critique pendant l'exécution de l'archivage**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.e. Une erreur technique imprévue et majeure se produit pendant le traitement (ex: erreur de connexion ou d'écriture vers le stockage d'archives, erreur SQL fatale, problème d'infrastructure).
        -   10.e. Le processus d'archivage s'arrête anormalement. Le système enregistre l'erreur technique dans ses logs internes. L'admin est informé d'un échec global ou partiel avec une erreur système. L'état des données (certaines peut-être partiellement archivées) peut nécessiter une intervention technique.

    -   **Scénario d'Exception E2 : Le rapport de résumé de l'archivage ne peut pas être généré**
        -   ... (Après l'étape 10 du scénario principal)
        -   11.e. Le système rencontre une erreur lors de la compilation ou de l'affichage du rapport de résumé du processus d'archivage.
        -   12.e. Le système enregistre l'erreur. L'admin est informé qu'il y a eu un problème lors de la génération du rapport, même si le processus d'archivage a pu se terminer.

-   **Points à considérer pour la suite :**
    -   Comment les règles d'éligibilité à l'archivage sont-elles définies et configurées dans le système ?
    -   Comment les données archivées sont-elles consultables si nécessaire ? (Nécessiterait un ou plusieurs UCs dédiés "Consulter les archives (Admin)").
    -   Est-il possible de restaurer des données archivées vers leur état actif ? (Nécessiterait un UC "Restaurer des données archivées (Admin)").
    -   Quelle est la politique de conservation des données (durée pendant laquelle les données archivées doivent être conservées) ?
    -   Comment la sécurité et la confidentialité des données archivées sont-elles garanties ?
    -   Le processus d'archivage peut-il être planifié pour s'exécuter automatiquement à intervalles réguliers ?

---

**UC 64 - Sauvegarder la base de données**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** admin (avec les droits d'administration système/sauvegarde)

-   **Description :** Permet à un admin disposant des droits nécessaires de déclencher manuellement l'exécution d'un processus de sauvegarde de la base de données de l'application. Cette opération crée une copie à un instant T de l'intégralité (ou d'une partie) des données stockées, à des fins de sécurité et de récupération.

-   **Préconditions :**

    -   L'admin est authentifié dans le système avec un compte disposant des droits suffisants pour initier des opérations de sauvegarde de la base de données.
    -   Le mécanisme technique sous-jacent de sauvegarde de la base de données est configuré et opérationnel (scripts de sauvegarde, outils de base de données accessibles, emplacement de stockage de destination valide et accessible).
    -   La base de données de l'application est en ligne et accessible.

-   **Postconditions :**

    -   Un fichier de sauvegarde de la base de données est créé et stocké à l'emplacement défini dans la configuration du système de sauvegarde.
    -   Les informations relatives à cette opération de sauvegarde (date/heure de début et de fin, statut de succès/échec, taille du fichier généré, emplacement) sont enregistrées dans le système.
    -   Un enregistrement d'audit détaillé est créé pour l'action de déclenchement manuel de la sauvegarde (qui, quand).
    -   Le système continue de fonctionner normalement pendant ou après la sauvegarde (celle-ci étant généralement conçue pour minimiser l'impact).

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Administration Système", "Maintenance", "Sauvegarde et Restauration", ou similaire.
    3.  Le système affiche l'interface de gestion des sauvegardes. Cette interface peut présenter l'historique des sauvegardes récentes (automatiques et manuelles) et des informations sur la planification des sauvegardes automatiques.
    4.  L'admin localise et clique sur l'option ou le bouton "Lancer une sauvegarde maintenant", "Exécuter sauvegarde manuelle", ou similaire.
    5.  Le système peut présenter une boîte de dialogue demandant une confirmation explicite avant de lancer l'opération, informant potentiellement de son impact (temps d'exécution, légère baisse de performance).
    6.  L'admin confirme le lancement de la sauvegarde manuelle.
    7.  Le système initie le processus de sauvegarde de la base de données en appelant les scripts ou les outils de sauvegarde configurés côté serveur.
    8.  Le système peut afficher le statut de l sauvegarde en cours (ex: "Sauvegarde en cours...", "Progression : XX%"). Pour les bases de données volumineuses, ce processus peut prendre plusieurs minutes, voire heures.
    9.  Une fois le processus de sauvegarde technique terminé, le système reçoit le résultat (succès ou échec) et les informations associées (taille du fichier, emplacement, durée).
    10. Le système enregistre les détails de cette opération de sauvegarde dans un journal interne des sauvegardes (date/heure, statut, détails techniques du résultat).
    11. Le système enregistre un événement détaillé dans les logs d'audit (UC 54) indiquant que cet admin a déclenché une sauvegarde manuelle, à quel moment, et quel a été son résultat (succès ou échec).
    12. Le système affiche un message de confirmation ou de rapport final à l'admin dans l'interface (ex: "Sauvegarde manuelle de la base de données terminée avec succès à [Heure]. Fichier : [Nom du fichier], Taille : [Taille].", ou "Échec de la sauvegarde de la base de données. Voir les détails dans le journal des sauvegardes.").

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation du processus par l'admin**

        -   Applicable si l'opération de sauvegarde peut être interrompue. L'admin annule l'exécution en cours. Le système tente d'arrêter le processus proprement et l'enregistre comme Annulé dans le journal des sauvegardes.

    -   **Scénario Alternatif A2 : Mécanisme de sauvegarde non configuré ou non opérationnel**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.a. Lorsque l'admin clique pour lancer la sauvegarde, le système détecte que le mécanisme technique de sauvegarde n'est pas configuré, qu'il y a une erreur dans la configuration, ou que les outils nécessaires ne sont pas accessibles/opérationnels.
        -   6.a. Le système affiche un message d'erreur à l'admin (ex: "Le mécanisme de sauvegarde n'est pas correctement configuré. Impossible de lancer la sauvegarde."). L'opération ne peut pas démarrer.

    -   **Scénario d'Exception E1 : Erreur système pendant l'exécution de la sauvegarde**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.e. Une erreur technique imprévue se produit pendant l'exécution du processus de sauvegarde (ex: espace disque insuffisant sur le lieu de stockage, problème réseau vers le stockage distant, erreur rapportée par l'outil de base de données pendant la copie).
        -   10.e. Le processus de sauvegarde échoue. Le système enregistre l'erreur technique dans ses logs internes.
        -   11.e. Le statut de la sauvegarde est enregistré comme Échec dans le journal des sauvegardes. Le système affiche un message d'échec détaillé ou générique à l'admin.

    -   **Scénario d'Exception E2 : La base de données est inaccessible ou instable au moment de la sauvegarde**
        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.e. Le système ou l'outil de sauvegarde ne parvient pas à se connecter à la base de données ou détecte qu'elle est dans un état instable incompatible avec une sauvegarde fiable.
        -   9.e. Le processus échoue immédiatement ou rapidement. Le système enregistre l'erreur. L'admin est informé que la sauvegarde n'a pas pu être effectuée en raison d'un problème avec la base de données.

-   **Points à considérer pour la suite :**
    -   Ce cas d'utilisation gère-t-il uniquement les sauvegardes _manuelles_, ou permet-il également de visualiser le statut et l'historique des sauvegardes _automatiques_ planifiées ? (Le scénario principal le suggère).
    -   Quels détails techniques de la sauvegarde sont visibles par l'admin dans le journal des sauvegardes (date, heure, taille, statut, message d'erreur si échec, type de sauvegarde - complète/incrémentale si applicable) ?
    -   Comment l'accès aux fichiers de sauvegarde eux-mêmes est-il sécurisé ? (Généralement hors du périmètre de l'application web, mais important à considérer).
    -   Des alertes automatiques sont-elles envoyées en cas d'échec des sauvegardes (automatiques ou manuelles) ?
    -   Ce cas d'utilisation est-il lié à la fonction de restauration (UC 65) ?

---

**UC 65 - Restaurer la base de données**

-   **Module :** 16 - Gestion des Utilisateurs de l'Application
-   **Acteur principal :** admin (avec les droits critiques de restauration de la base de données)

-   **Description :** Permet à un admin disposant des droits appropriés d'utiliser un fichier de sauvegarde valide pour remplacer le contenu actuel de la base de données de l'application. Cette opération ramène le système à l'état dans lequel il se trouvait au moment de la sauvegarde et est utilisée en cas de corruption majeure des données ou de perte d'informations irréversible.

-   **Préconditions :**

    -   L'admin est authentifié dans le système avec un compte disposant des droits très élevés pour effectuer une restauration de la base de données.
    -   Un ou plusieurs fichiers de sauvegarde valides de la base de données sont disponibles et accessibles à l'emplacement configuré (créés par UC 64 ou automatiquement).
    -   Le mécanisme technique sous-jacent de restauration de la base de données est configuré et opérationnel (accès aux outils de la base de données, accès en lecture aux fichiers de sauvegarde).
    -   La base de données cible est accessible et dans un état permettant la restauration (potentiellement arrêtée ou en mode de maintenance).
    -   **Attention :** Une décision de gestion a été prise pour effectuer cette restauration, compte tenu de la perte de données récentes qu'elle implique.

-   **Postconditions :**

    -   La base de données est remplacée par le contenu du fichier de sauvegarde sélectionné.
    -   Toutes les données créées, modifiées ou supprimées dans le système _après_ l'heure exacte de la sauvegarde utilisée sont perdues.
    -   Les données existent désormais dans l'état où elles étaient au moment de la sauvegarde.
    -   Un enregistrement de l'opération de restauration (date, heure, statut, fichier source, résultat) est créé.
    -   Un enregistrement d'audit détaillé est créé pour l'action de déclenchement de la restauration (qui, quand, quel fichier).
    -   L'application est généralement remise en ligne et accessible aux utilisateurs (si elle avait été arrêtée).

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration (si l'interface est toujours accessible malgré l'incident) ou accède à une interface de maintenance système séparée.
    2.  L'admin navigue vers la section "Administration Système", "Maintenance", "Sauvegarde et Restauration".
    3.  Le système affiche l'interface de gestion des sauvegardes et restaurations. Une liste des fichiers de sauvegarde disponibles est présentée, généralement avec leur date, heure, taille, et type (complète, incrémentale, si applicable).
    4.  L'admin consulte la liste et sélectionne le fichier de sauvegarde à utiliser pour la restauration (en se basant sur la date/heure souhaitée).
    5.  L'admin clique sur l'option ou le bouton "Restaurer", "Restaurer à partir de ce fichier", ou similaire.
    6.  **Étape Critique :** Le système affiche un avertissement TRÈS CLAIR et IMMANQUABLE expliquant les conséquences de la restauration : les données actuelles seront écrasées, et toutes les données ajoutées ou modifiées depuis la date de la sauvegarde choisie seront PERDUES DÉFINITIVEMENT. Le système demande une confirmation explicite et intentionnelle, potentiellement en demandant de saisir un mot de confirmation ("RESTAURER") ou de cocher plusieurs cases.
    7.  L'admin, comprenant pleinement les risques, confirme le lancement de l'opération de restauration.
    8.  Le système initie le processus de restauration. Cela inclut généralement des étapes préparatoires (ex: notifier les autres utilisateurs que le système va être mis hors ligne, arrêter les services de l'application, s'assurer que la base de données peut accepter la restauration).
    9.  Le système exécute la commande de restauration de la base de données en utilisant l'outil de base de données sous-jacent et le fichier de sauvegarde sélectionné. Cette opération écrase le contenu actuel de la base de données.
    10. Le système affiche le statut de l'opération de restauration (En cours, Réussite, Échec). Ce processus peut prendre un temps significatif en fonction de la taille de la base de données.
    11. Une fois la restauration technique terminée, le système reçoit le résultat (succès ou échec) et les informations associées.
    12. Le système enregistre les détails de cette opération de restauration dans un journal interne des restaurations (date/heure, statut, fichier source utilisé, détails techniques du résultat).
    13. Le système enregistre un événement détaillé dans les logs d'audit (UC 54) indiquant que cet admin a déclenché une restauration, quand, quel fichier a été utilisé, et quel a été le résultat (succès ou échec).
    14. Le système initie les étapes post-restauration (ex: redémarrer les services de l'application, remettre l'application en ligne).
    15. Le système affiche un message de confirmation ou de rapport final à l'admin (ex: "Restauration de la base de données terminée avec succès. Le système est maintenant en ligne.", ou "La restauration a échoué. Une intervention technique est nécessaire."). L'application redevient accessible aux utilisateurs avec les données restaurées (si la restauration a réussi et que le redémarrage a fonctionné).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation par l'admin (avant confirmation critique)**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. L'admin lit l'avertissement et décide de ne pas procéder à la restauration.
        -   8.a. L'admin annule l'opération (ferme la boîte de dialogue, clique sur Annuler). Le système abandonne le processus.

    -   **Scénario Alternatif A2 : Fichier de sauvegarde sélectionné introuvable, invalide ou corrompu**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. Le système ou l'outil de restauration ne parvient pas à localiser, lire ou valider le fichier de sauvegarde sélectionné.
        -   7.a. Le système affiche un message d'erreur à l'admin (ex: "Fichier de sauvegarde introuvable ou corrompu. Veuillez en sélectionner un autre."). La restauration ne démarre pas.

    -   **Scénario d'Exception E1 : Erreur système critique pendant l'exécution de la restauration**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.e. Une erreur technique majeure se produit pendant l'exécution de la restauration par le système (ex: erreur de base de données pendant l'importation des données du fichier, espace disque insuffisant sur le serveur pour la base de données restaurée).
        -   11.e. Le processus de restauration échoue. Le système enregistre l'erreur technique dans ses logs internes.
        -   12.e. Le statut de la restauration est enregistré comme Échec. L'admin reçoit un message d'échec (potentiellement technique). **Attention :** Après un échec de restauration, la base de données peut être dans un état instable ou corrompu, nécessitant souvent une intervention technique manuelle d'urgence.

    -   **Scénario d'Exception E2 : La base de données ou le système est dans un état empêchant la restauration**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.e. Le système ou l'outil de restauration ne parvient pas à arrêter les services nécessaires, à obtenir l'accès exclusif à la base de données, ou détecte un problème majeur qui empêche de lancer la restauration.
        -   10.e. Le processus échoue immédiatement ou rapidement. Le système enregistre l'erreur. L'admin est informé que la restauration n'a pas pu être lancée en raison de l'état actuel du système ou de la base de données.

    -   **Scénario d'Exception E3 : L'application ne redémarre pas ou ne fonctionne pas correctement après une restauration réussie (techniquement parlant)**
        -   ... (Après l'étape 14 du scénario principal, si la restauration _technique_ a réussi)
        -   15.e. Bien que le processus de base de données soit terminé, l'application elle-même ne parvient pas à se relancer correctement (ex: erreurs de configuration, problèmes de connexion aux services externes, incompatibilité logicielle post-restauration).
        -   16.e. L'admin voit que le système n'est pas pleinement opérationnel malgré le rapport de succès de la restauration de la base de données. Cela nécessite une investigation et des actions correctives au niveau de l'application et de l'infrastructure.

-   **Points à considérer pour la suite :**
    -   La sélection du fichier de sauvegarde est-elle intuitive ? La liste des sauvegardes inclut-elle toutes les sauvegardes disponibles (automatiques et manuelles) ?
    -   L'avertissement de perte de données est-il suffisant et non contournable accidentellement ?
    -   Le système gère-t-il la mise hors ligne automatique de l'application pendant la restauration ? Comment les utilisateurs finaux (Mutualistes, Admins) sont-ils notifiés de cette maintenance ?
    -   Existe-t-il différents types de restauration (ex: restauration complète, restauration d'une seule table, restauration "point-in-time" si les logs de transactions sont disponibles) ? (Le scénario principal décrit la restauration complète standard).
    -   Comment l'historique des opérations de restauration est-il stocké, consulté et sécurisé ? (Journal distinct et logs d'audit).
    -   La restauration nécessite-t-elle une double authentification ou des droits exceptionnellement élevés ?

---

### **Module 17 : Gestion Financière & Trésorerie Interne**

**UC 66 - Enregistrer une dépense de fonctionnement**

-   **Module :** 17 - Gestion Financière & Trésorerie Interne
-   **Acteur principal :** admin (ayant les droits financiers)

-   **Description :** Permet à un admin d'enregistrer formellement une dépense opérationnelle ou administrative (ne concernant pas les prestations aux mutualistes) engagée par la mutuelle. Cela inclut la saisie des détails de la dépense (montant, date, bénéficiaire, catégorie, justification).

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour enregistrer les dépenses de fonctionnement.
    -   Le système dispose d'un référentiel des catégories de dépenses de fonctionnement.
    -   La dépense a été engagée et les informations nécessaires pour son enregistrement sont disponibles.

-   **Postconditions :**

    -   Un nouvel enregistrement de dépense de fonctionnement est créé dans le système.
    -   Les détails de la dépense (montant, date, bénéficiaire, catégorie, description) sont enregistrés.
    -   L'enregistrement est associé à l'admin qui l'a saisi et à la date de saisie.
    -   Le montant de la dépense est pris en compte dans les rapports financiers (UC 67, UC 68, UC 74).
    -   Un enregistrement d'audit est créé pour l'enregistrement de la dépense (qui, quand, quoi).

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Gestion Financière", "Trésorerie", ou "Dépenses de fonctionnement".
    3.  Le système affiche l'interface de gestion des dépenses de fonctionnement, potentiellement avec la liste des dépenses récentes (UC 67 implicite) et une option pour enregistrer une nouvelle dépense. L'admin clique sur "Enregistrer une nouvelle dépense".
    4.  Le système affiche un formulaire de saisie pour la dépense de fonctionnement.
    5.  L'admin saisit les informations requises :
        -   Le montant de la dépense.
        -   La date de la dépense effective.
        -   Le bénéficiaire ou fournisseur de la dépense (champ texte libre ou sélection).
        -   La catégorie de dépense dans une liste prédéfinie (ex: Loyer, Salaires, Fournitures Bureau, Électricité, Télécom, Frais Bancaires, Marketing).
        -   Une description ou justification détaillée de la dépense.
    6.  (Optionnel) L'admin peut indiquer le mode de paiement (ex: Virement Bancaire, Chèque, Caisse - si la dépense a été payée directement en liquide depuis une caisse gérée dans le système).
    7.  (Optionnel) L'admin peut joindre un justificatif numérique (facture scannée, reçu).
    8.  L'admin vérifie les informations saisies.
    9.  L'admin clique sur un bouton "Enregistrer la dépense".
    10. Le système valide les données saisies (champs obligatoires non vides, montant format numérique valide, date valide, catégorie sélectionnée).
    11. Si les validations réussissent, le système crée un nouvel enregistrement de dépense de fonctionnement dans la base de données avec toutes les informations fournies.
    12. Le système associe l'enregistrement à l'admin qui a effectué la saisie et à la date/heure de la saisie.
    13. (Optionnel) Si un justificatif a été joint, le système le traite et l'associe à l'enregistrement de dépense.
    14. Le système enregistre l'historique de cette opération dans les logs d'audit.
    15. Le système affiche un message de confirmation à l'admin (ex: "Dépense enregistrée avec succès.").

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de la saisie par l'admin**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.a. L'admin décide de ne pas enregistrer la dépense.
        -   11.a. L'admin clique sur "Annuler" ou quitte le formulaire.
        -   12.a. Le système abandonne le processus de saisie.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées lors de la validation**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.a. Le système valide les données et constate que des champs obligatoires sont vides ou que les données ne respectent pas le format attendu (ex: montant non numérique, date invalide).
        -   12.a. Le système affiche des messages d'erreur clairs à côté des champs concernés. L'admin reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A3 : Catégorie de dépense introuvable ou inactive**

        -   ... (Étapes 1 à 10 du scénario principal, si sélection par liste déroulante)
        -   11.a. Le système vérifie la catégorie sélectionnée et constate qu'elle n'existe pas ou n'est pas active.
        -   12.a. Le système affiche un message d'erreur et demande à l'admin de sélectionner une catégorie valide.

    -   **Scénario Alternatif A4 : Échec du téléchargement d'un justificatif (si applicable)**

        -   ... (Étapes 1 à 7, puis tentative de téléchargement dans étape 11)
        -   12.a. Une erreur technique se produit pendant le téléchargement ou l'association du fichier justificatif.
        -   13.a. Le système affiche un message d'erreur spécifique au téléchargement. Le système peut soit permettre l'enregistrement de la dépense sans le document échoué (avec un avertissement), soit bloquer l'enregistrement jusqu'à ce que le problème soit résolu.

    -   **Scénario d'Exception E1 : Erreur système lors de l'enregistrement de la dépense**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde de l'enregistrement de la dépense dans la base de données.
        -   13.e. Le système enregistre l'erreur technique dans ses logs.
        -   14.e. Le système affiche un message d'erreur générique à l'admin indiquant que la dépense n'a pas pu être enregistrée pour le moment. L'opération échoue.

-   **Points à considérer pour la suite :**
    -   Comment les catégories de dépenses de fonctionnement sont-elles gérées (ajout, modification, suppression) ? (Nécessiterait un UC de configuration dédié).
    -   L'admin peut-il modifier ou supprimer une dépense enregistrée ? (Nécessiterait des UCs spécifiques).
    -   Comment les dépenses enregistrées via cet UC sont-elles intégrées dans les rapports financiers globaux (UC 74) ?
    -   Y a-t-il une validation des droits de l'admin pour enregistrer des dépenses au-delà d'un certain montant ?
    -   Comment le système gère-t-il les dépenses récurrentes (loyers, abonnements) ?

---

**UC 67 - Visualiser les dépenses de fonctionnement**

-   **Module :** 17 - Gestion Financière & Trésorerie Interne
-   **Acteur principal :** admin (ayant les droits financiers/comptables)

-   **Description :** Permet à un admin de consulter une liste ou un tableau des dépenses de fonctionnement enregistrées dans le système (via UC 66). L'admin peut utiliser des filtres et des options de tri pour affiner la liste affichée.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour visualiser les dépenses de fonctionnement.
    -   Le système contient des enregistrements de dépenses de fonctionnement (UC 66 réussi).
    -   L'interface de visualisation des dépenses de fonctionnement est accessible.

-   **Postconditions :**

    -   L'admin a consulté la liste des dépenses de fonctionnement enregistrées. Aucune modification des données n'est effectuée par cette consultation.
    -   La liste des dépenses de fonctionnement (potentiellement filtrée et triée) est affichée à l'écran de l'admin.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Gestion Financière", "Trésorerie", "Dépenses de fonctionnement", ou accède à un rapport/une vue de liste dédié.
    3.  Le système affiche l'interface de visualisation des dépenses de fonctionnement. Par défaut, une liste chronologique des dépenses (ex: celles du mois en cours ou des dépenses les plus récentes) est présentée. Chaque élément de la liste inclut des informations clés (ex: Date dépense, Montant, Bénéficiaire, Catégorie, Description courte).
    4.  L'admin visualise la liste par défaut des dépenses.
    5.  L'admin utilise les options de filtrage et de recherche disponibles pour affiner la liste (ex: filtrer par période de date, par catégorie de dépense, rechercher un bénéficiaire ou un mot clé dans la description, filtrer par montant).
    6.  L'admin utilise les options de tri disponibles (ex: trier par date, par montant, par catégorie).
    7.  Le système actualise la liste des dépenses affichées en temps réel ou après validation des filtres/tri, en interrogeant la base de données avec les critères spécifiés.
    8.  L'admin consulte la liste filtrée, triée et paginée (si nécessaire) des dépenses de fonctionnement pour trouver les informations recherchées, vérifier des enregistrements spécifiques ou obtenir un aperçu d'une période donnée.
    9.  (Optionnel) L'admin peut cliquer sur une dépense spécifique dans la liste pour afficher ses détails complets (y compris les justificatifs si présents, lien vers UC 66 ou une vue détaillée).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune dépense enregistrée (ou correspondant aux filtres/recherche)**

        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.a. Le système exécute la requête (par défaut ou avec filtres/recherche) et constate qu'il n'y a aucune dépense enregistrée du tout, ou aucune correspondant aux critères spécifiés.
        -   9.a. Le système affiche un message indiquant "Aucune dépense de fonctionnement trouvée" ou "Aucune dépense ne correspond à vos critères de recherche/filtrage".
        -   10.a. L'admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération ou de l'affichage des dépenses**
        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.e. Une erreur technique imprévue se produit lors de la tentative de récupérer les données des dépenses depuis la base de données ou de les afficher correctement dans l'interface.
        -   9.e. Le système enregistre l'erreur technique dans ses journaux d'erreurs internes.
        -   10.e. Le système affiche un message d'erreur générique à l'admin l'informant que la liste des dépenses n'a pas pu être chargée pour le moment.

-   **Points à considérer pour la suite :**
    -   Les options de filtrage et de tri sont-elles suffisamment flexibles pour couvrir les besoins d'analyse courants ?
    -   Est-il possible d'exporter la liste affichée ? (Lien avec UC 61).
    -   La vue liste permet-elle de voir rapidement les dépenses pour une période donnée (total par mois, par catégorie) sans passer par un rapport agrégé (UC 68) ?
    -   L'accès aux justificatifs numériques (si enregistrés) est-il possible depuis cette vue ? (Lien potentiel avec un UC de visualisation de document).

---

**UC 68 - Visualiser la répartition des dépenses**

-   **Module :** 17 - Gestion Financière & Trésorerie Interne
-   **Acteur principal :** admin (ayant les droits financiers/comptables)

-   **Description :** Permet à un admin de consulter des graphiques ou des tableaux de synthèse qui présentent la répartition des dépenses de fonctionnement (enregistrées via UC 66) sur une période donnée, généralement par catégorie de dépense. Cela aide à l'analyse et au contrôle budgétaire.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour visualiser les rapports de répartition des dépenses.
    -   Le système contient des enregistrements de dépenses de fonctionnement pour la période concernée.
    -   Le système dispose de la capacité à agréger et présenter les données de dépenses sous forme de rapport (graphique ou tableau synthétique).

-   **Postconditions :**

    -   Un rapport (graphique, tableau croisé dynamique, etc.) présentant la répartition des dépenses de fonctionnement sur une période et selon une catégorie donnée est affiché à l'écran de l'admin.
    -   L'admin a une vue synthétique de la structure des dépenses.
    -   Aucune modification des données n'est effectuée.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Gestion Financière", "Rapports", "Analyse des dépenses", ou accède directement à ce rapport spécifique depuis la liste des rapports (UC 60).
    3.  Le système affiche l'interface de ce rapport. Si le rapport est paramétrable (ce qui est typique pour une répartition sur période), le système présente un formulaire demandant à l'admin de spécifier les critères.
    4.  L'admin spécifie la période pour laquelle il souhaite visualiser la répartition des dépenses (ex: mois, trimestre, année fiscale, période personnalisée). Il peut aussi spécifier le critère de répartition (généralement par catégorie de dépense, mais potentiellement par bénéficiaire si pertinent).
    5.  L'admin valide les paramètres (clique sur "Générer Rapport", "Appliquer les filtres").
    6.  Le système interroge la base de données pour récupérer toutes les dépenses de fonctionnement enregistrées qui correspondent à la période et aux critères spécifiés.
    7.  Le système agrège les montants des dépenses selon le critère de répartition choisi (ex: somme des dépenses par catégorie).
    8.  Le système génère la visualisation du rapport, qui peut être :
        -   Un graphique (ex: camembert pour la répartition par catégorie sur une période, histogramme pour l'évolution par catégorie dans le temps).
        -   Un tableau synthétique (tableau croisé dynamique montrant les totaux par catégorie pour chaque mois/trimestre de la période).
    9.  Le système affiche le rapport visuel ou tabulaire à l'écran de l'admin.
    10. L'admin consulte le rapport pour comprendre où vont les dépenses de fonctionnement et identifier les postes de coûts importants ou les évolutions notables.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Paramètres de rapport requis manquants ou invalides (géré par UC 60 si accessible via liste rapports)**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. L'admin ne fournit pas les paramètres requis (ex: période) ou les valeurs saisies sont invalides.
        -   7.a. Le système affiche des messages d'erreur. L'admin doit corriger les paramètres.

    -   **Scénario Alternatif A2 : Aucune dépense enregistrée pour la période/critères spécifiés**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système récupère les données mais constate qu'il n'y a aucune dépense enregistrée pour la période ou les critères spécifiés.
        -   8.a. Le système affiche le rapport, mais il est vide de données ou indique clairement "Aucune dépense enregistrée pour cette période/ces critères".
        -   9.a. L'admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération/agrégation des données ou de la génération du rapport**
        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.e. Une erreur technique imprévue se produit lors de l'interrogation de la base de données, de l'agrégation des données, ou de la génération de la visualisation du rapport.
        -   9.e. Le système enregistre l'erreur technique dans ses journaux.
        -   10.e. Le système affiche un message d'erreur générique à l'admin l'informant que le rapport n'a pas pu être généré ou affiché pour le moment.

-   **Points à considérer pour la suite :**
    -   Quels sont les critères de répartition possibles (catégorie, bénéficiaire, période spécifique, par projet si applicable) ?
    -   Le rapport offre-t-il différentes visualisations (camembert, barres, lignes, tableau) ?
    -   Est-il possible de "creuser" (drill-down) dans le rapport (ex: cliquer sur une catégorie pour voir la liste des dépenses individuelles de cette catégorie - lien avec UC 67) ?
    -   Est-il possible d'exporter les données ou le graphique du rapport ? (Lien avec UC 61).
    -   Comment les périodes d'analyse sont-elles facilement sélectionnables (prédéfinies: mois courant, trimestre, année, ou personnalisées) ?

---

**UC 69 - Enregistrer une entrée en caisse**

-   **Module :** 17 - Gestion Financière & Trésorerie Interne
-   **Acteur principal :** admin (avec les droits de gestion de caisse)

-   **Description :** Permet à un admin d'enregistrer une transaction qui augmente le solde de la caisse physique (argent liquide) gérée par la mutuelle. Il documente la source de l'entrée, le montant, la date et la justification.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour enregistrer les mouvements de caisse.
    -   Une caisse physique est configurée et gérée dans le système.
    -   Une somme d'argent liquide a été reçue et doit être enregistrée comme une entrée en caisse.

-   **Postconditions :**

    -   Un nouvel enregistrement d'entrée en caisse est créé dans le système.
    -   Le montant de l'entrée est pris en compte dans le calcul du solde de la caisse (UC 71).
    -   L'enregistrement détaille la date, le montant, la source et la justification de l'entrée.
    -   Un enregistrement d'audit est créé pour cette entrée en caisse (qui, quand, quoi).
    -   Les rapports récapitulatifs de caisse sont mis à jour (UC 72, UC 73).

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Gestion Financière", "Trésorerie", "Gestion de Caisse", ou "Mouvements de Caisse".
    3.  Le système affiche l'interface de gestion de caisse, potentiellement avec le solde actuel (UC 71 implicite) et les mouvements récents (UC 72 implicite), ainsi que des options pour enregistrer une entrée ou une sortie. L'admin clique sur "Enregistrer une entrée en caisse".
    4.  Le système affiche un formulaire de saisie pour une entrée en caisse. Le champ "Date de l'opération" est pré-rempli avec la date et l'heure actuelle, mais peut être modifiable si nécessaire. Le champ "Type d'opération" est pré-sélectionné sur "Entrée".
    5.  L'admin saisit les informations requises :
        -   Le montant de l'entrée (doit être un nombre positif).
        -   La source de cette entrée (ex: Rentrée de petite caisse, Versement de [Nom Mutualiste] en liquide - bien que ce type d'entrée doive être rare si les paiements mutualistes sont numérisés, Remboursement en liquide, Fonds initial).
        -   Une description ou justification détaillée de l'entrée (ex: "Espèces reçues de M. Dupont suite à...", "Vente de [Produit/Service] en liquide", "Remboursement avance").
    6.  (Optionnel) L'admin peut lier cette entrée à un mutualiste spécifique si la source est identifiable.
    7.  (Optionnel) L'admin peut joindre un justificatif numérique (reçu, bordereau).
    8.  L'admin vérifie les informations saisies.
    9.  L'admin clique sur un bouton "Enregistrer l'entrée".
    10. Le système valide les données saisies (montant positif et numérique, date valide, source et justification non vides si obligatoires).
    11. Si les validations réussissent, le système crée un nouvel enregistrement dans la base de données pour cette entrée en caisse.
    12. Le système met à jour le solde courant de la caisse en ajoutant le montant enregistré.
    13. Le système associe l'enregistrement à l'admin qui a effectué la saisie et à la date/heure de la saisie.
    14. (Optionnel) Si un justificatif a été joint, le système le traite et l'associe à l'enregistrement de l'entrée.
    15. Le système enregistre l'historique de cette opération dans les logs d'audit.
    16. Le système affiche un message de confirmation (ex: "Entrée en caisse de [Montant] enregistrée. Nouveau solde : [Nouveau Solde]."). L'affichage du solde actuel (UC 71) est mis à jour.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de la saisie par l'admin**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.a. L'admin décide de ne pas enregistrer l'entrée.
        -   11.a. L'admin clique sur "Annuler" ou quitte le formulaire.
        -   12.a. Le système abandonne le processus de saisie.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées lors de la validation**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.a. Le système valide les données et constate que des champs obligatoires sont vides ou que les données ne respectent pas le format attendu (ex: montant négatif ou nul, montant non numérique).
        -   12.a. Le système affiche des messages d'erreur clairs à côté des champs concernés. L'admin reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A3 : Échec du téléchargement d'un justificatif (si applicable)**

        -   ... (Étapes 1 à 7, puis tentative de téléchargement dans étape 11)
        -   12.a. Une erreur technique se produit pendant le téléchargement ou l'association du fichier justificatif.
        -   13.a. Le système affiche un message d'erreur spécifique au téléchargement. Le système peut permettre l'enregistrement de l'entrée sans le document échoué (avec un avertissement).

    -   **Scénario d'Exception E1 : Erreur système lors de l'enregistrement de l'entrée en caisse**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde de l'enregistrement de l'entrée en caisse dans la base de données ou de la mise à jour du solde.
        -   13.e. Le système enregistre l'erreur technique dans ses logs.
        -   14.e. Le système affiche un message d'erreur générique à l'admin indiquant que l'entrée n'a pas pu être enregistrée pour le moment. L'opération échoue, le solde n'est pas mis à jour.

-   **Points à considérer pour la suite :**
    -   Comment les différentes caisses (s'il y en a plusieurs) sont-elles gérées et sélectionnées pour un mouvement ? (Nécessiterait un UC de gestion des caisses et une sélection en début de flux).
    -   Comment le système garantit-il l'intégrité du solde de caisse (pas de modification/suppression de mouvements sans droits très stricts) ?
    -   Un rapprochement physique de la caisse avec le solde système est-il prévu ?
    -   Y a-t-il une limite de montant pour une entrée en caisse sans validation supplémentaire ?

---

**UC 70 - Enregistrer une sortie de caisse**

-   **Module :** 17 - Gestion Financière & Trésorerie Interne
-   **Acteur principal :** admin (avec les droits de gestion de caisse)

-   **Description :** Permet à un admin d'enregistrer une transaction qui diminue le solde de la caisse physique (argent liquide) gérée par la mutuelle. Il documente la destination/le motif de la sortie, le montant, la date et la justification.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour enregistrer les mouvements de caisse.
    -   Une caisse physique est configurée et gérée dans le système.
    -   Une somme d'argent liquide a été dépensée ou retirée de la caisse et doit être enregistrée comme une sortie.
    -   Le solde actuel de la caisse est suffisant pour couvrir le montant de la sortie.

-   **Postconditions :**

    -   Un nouvel enregistrement de sortie de caisse est créé dans le système.
    -   Le montant de la sortie est déduit du calcul du solde de la caisse (UC 71).
    -   L'enregistrement détaille la date, le montant, le motif/la destination et la justification de la sortie.
    -   Un enregistrement d'audit est créé pour cette sortie de caisse (qui, quand, quoi).
    -   Les rapports récapitulatifs de caisse sont mis à jour (UC 72, UC 73).

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Gestion Financière", "Trésorerie", "Gestion de Caisse", ou "Mouvements de Caisse".
    3.  Le système affiche l'interface de gestion de caisse, potentiellement avec le solde actuel (UC 71 implicite) et les mouvements récents (UC 72 implicite). L'admin clique sur "Enregistrer une sortie de caisse".
    4.  Le système affiche un formulaire de saisie pour une sortie de caisse. Le champ "Date de l'opération" est pré-rempli avec la date et l'heure actuelle, mais peut être modifiable. Le champ "Type d'opération" est pré-sélectionné sur "Sortie". Le solde actuel de la caisse est affiché pour information.
    5.  L'admin saisit les informations requises :
        -   Le montant de la sortie (doit être un nombre positif).
        -   Le motif ou la destination de cette sortie (ex: Achat fournitures petite caisse, Remboursement caution en liquide, Versement en banque, Avance sur frais, Règlement facture [Bénéficiaire] en espèces).
        -   Une description ou justification détaillée de la sortie.
    6.  (Optionnel) L'admin peut lier cette sortie à une dépense de fonctionnement enregistrée précédemment (UC 66) si c'est la source de la sortie.
    7.  (Optionnel) L'admin peut joindre un justificatif numérique (reçu, facturette).
    8.  L'admin vérifie les informations saisies et s'assure que le montant ne dépasse pas le solde actuel affiché.
    9.  L'admin clique sur un bouton "Enregistrer la sortie".
    10. Le système valide les données saisies (montant positif et numérique, date valide, motif et justification non vides si obligatoires, **montant de la sortie inférieur ou égal au solde courant de la caisse**).
    11. Si les validations réussissent, le système crée un nouvel enregistrement dans la base de données pour cette sortie en caisse.
    12. Le système met à jour le solde courant de la caisse en déduisant le montant enregistré.
    13. Le système associe l'enregistrement à l'admin qui a effectué la saisie et à la date/heure de la saisie.
    14. (Optionnel) Si un justificatif a été joint, le système le traite et l'associe à l'enregistrement de la sortie.
    15. Le système enregistre l'historique de cette opération dans les logs d'audit.
    16. Le système affiche un message de confirmation (ex: "Sortie de caisse de [Montant] enregistrée. Nouveau solde : [Nouveau Solde]."). L'affichage du solde actuel (UC 71) est mis à jour.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Annulation de la saisie par l'admin**

        -   ... (Étapes 1 à 9 du scénario principal)
        -   10.a. L'admin décide de ne pas enregistrer la sortie.
        -   11.a. L'admin clique sur "Annuler" ou quitte le formulaire.
        -   12.a. Le système abandonne le processus de saisie.

    -   **Scénario Alternatif A2 : Données manquantes ou invalides détectées lors de la validation**

        -   ... (Étapes 1 à 10 du scénario principal, hors solde)
        -   11.a. Le système valide les données et constate que des champs obligatoires sont vides ou que les données ne respectent pas le format attendu (ex: montant négatif ou nul, date invalide).
        -   12.a. Le système affiche des messages d'erreur. L'admin reste sur le formulaire pour corriger.

    -   **Scénario Alternatif A3 : Montant de la sortie supérieur au solde courant de la caisse**

        -   ... (Étapes 1 à 10 du scénario principal)
        -   11.a. Le système valide le montant de la sortie et constate qu'il est supérieur au solde actuel enregistré de la caisse.
        -   12.a. Le système affiche un message d'erreur clair (ex: "Le montant de la sortie ([Montant Saisi]) dépasse le solde actuel de la caisse ([Solde Actuel]). Impossible d'enregistrer cette sortie."). L'opération est bloquée. L'admin doit corriger le montant ou vérifier les entrées/sorties précédentes.

    -   **Scénario Alternatif A4 : Échec du téléchargement d'un justificatif (si applicable)**

        -   ... (Étapes 1 à 7, puis tentative de téléchargement dans étape 11)
        -   12.a. Une erreur technique se produit pendant le téléchargement ou l'association du fichier justificatif.
        -   13.a. Le système affiche un message d'erreur spécifique au téléchargement. Le système peut permettre l'enregistrement de la sortie sans le document échoué (avec un avertissement).

    -   **Scénario d'Exception E1 : Erreur système lors de l'enregistrement de la sortie en caisse**

        -   ... (Étapes 1 à 11 du scénario principal)
        -   12.e. Une erreur technique imprévue se produit lors de la tentative de sauvegarde de l'enregistrement de la sortie en caisse dans la base de données ou de la mise à jour du solde.
        -   13.e. Le système enregistre l'erreur technique dans ses logs.
        -   14.e. Le système affiche un message d'erreur générique à l'admin indiquant que la sortie n'a pas pu être enregistrée pour le moment. L'opération échoue, le solde n'est pas mis à jour.

-   **Points à considérer pour la suite :**
    -   Comment les différentes caisses sont-elles gérées et sélectionnées si plusieurs existent ?
    -   Y a-t-il une limite de montant pour une sortie de caisse sans validation supplémentaire ?
    -   Comment le système garantit-il l'intégrité du solde de caisse ?
    -   Un rapprochement physique de la caisse avec le solde système est-il prévu ?

---

**UC 71 - Consulter l'état de caisse (balance)**

-   **Module :** 17 - Gestion Financière & Trésorerie Interne
-   **Acteur principal :** admin (avec les droits de gestion de caisse)

-   **Description :** Permet à un admin de visualiser le solde actuel (balance) de la caisse physique telle qu'enregistrée dans le système. Ce solde est le résultat de toutes les entrées (UC 69) et sorties (UC 70) de caisse validées jusqu'à présent.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour consulter l'état de caisse.
    -   Une caisse physique est configurée et gérée dans le système.
    -   Le système contient des enregistrements de mouvements de caisse (entrées/sorties).

-   **Postconditions :**

    -   Le solde actuel de la caisse physique est affiché à l'écran de l'admin.
    -   Aucune modification des données n'est effectuée.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Gestion Financière", "Trésorerie", "Gestion de Caisse", ou accède à une vue/un tableau de bord affichant les informations de caisse.
    3.  (Optionnel) Si plusieurs caisses sont gérées, l'admin sélectionne la caisse spécifique dont il souhaite voir le solde.
    4.  Le système identifie la caisse concernée (sélectionnée ou par défaut).
    5.  Le système calcule le solde actuel de cette caisse en additionnant tous les montants des entrées enregistrées (UC 69) et en soustrayant tous les montants des sorties enregistrées (UC 70) qui lui sont associées.
    6.  Le système affiche clairement le solde calculé à l'écran de l'admin (ex: "Solde Caisse Principale : [Montant Courant] XOF").
    7.  (Optionnel) Le système peut également afficher la date et l'heure du dernier mouvement enregistré qui a affecté ce solde.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Aucune caisse configurée ou accessible**

        -   ... (Étapes 1 à 2 du scénario principal)
        -   3.a. Le système ne trouve aucune caisse configurée ou accessible pour cet admin.
        -   4.a. Le système affiche un message indiquant "Aucune caisse configurée" ou "Vous n'avez pas accès aux informations de caisse".
        -   5.a. L'admin prend connaissance de l'information.

    -   **Scénario Alternatif A2 : Aucune entrée/sortie enregistrée pour la caisse**

        -   ... (Étapes 1 à 4 du scénario principal)
        -   5.a. Le système interroge la base de données mais ne trouve aucun mouvement (entrée ou sortie) enregistré pour la caisse sélectionnée.
        -   6.a. Le solde calculé est donc 0. Le système affiche "Solde Caisse [Nom Caisse] : 0 XOF" et peut indiquer qu'aucun mouvement n'a été enregistré.
        -   7.a. L'admin prend connaissance du solde nul.

    -   **Scénario d'Exception E1 : Erreur système lors du calcul ou de la récupération du solde**
        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.e. Une erreur technique imprévue se produit lors de la tentative de récupérer les mouvements de caisse ou d'effectuer le calcul du solde.
        -   7.e. Le système enregistre l'erreur technique dans ses journaux.
        -   8.e. Le système affiche un message d'erreur générique à l'admin l'informant que le solde de caisse n'a pas pu être chargé pour le moment.

-   **Points à considérer pour la suite :**
    -   Le solde est-il calculé en temps réel à chaque consultation, ou stocké et mis à jour à chaque mouvement ? (Calcul en temps réel est plus sûr pour l'intégrité).
    -   Cette vue est-elle intégrée dans une interface plus large de gestion de caisse (avec enregistrement des mouvements UC 69/70 et visualisation des mouvements récents UC 72) ?
    -   Comment les différentes devises sont-elles gérées si plusieurs caisses utilisent des devises différentes ?
    -   Y a-t-il un indicateur visuel si le solde atteint un seuil bas ?

---

**UC 72 - Visualiser les états récapitulatifs de caisse**

-   **Module :** 17 - Gestion Financière & Trésorerie Interne
-   **Acteur principal :** admin (avec les droits financiers/comptables)

-   **Description :** Permet à un admin de consulter des rapports récapitulatifs sur les mouvements de la caisse physique (entrées et sorties) pour une période donnée. Ces rapports fournissent des totaux, des soldes d'ouverture et de clôture, et une vue synthétique de l'activité de caisse.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour visualiser les rapports de caisse.
    -   Une caisse physique est configurée et gérée dans le système.
    -   Le système contient des enregistrements de mouvements de caisse (entrées/sorties) pour la période concernée.

-   **Postconditions :**

    -   Un rapport récapitulatif de caisse pour une période spécifiée est affiché à l'écran de l'admin.
    -   Le rapport présente les totaux des entrées/sorties, et les soldes sur la période.
    -   Aucune modification des données n'est effectuée.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Gestion Financière", "Rapports", "Rapports de Caisse", ou accède directement à ce rapport depuis la liste des rapports (UC 60).
    3.  (Optionnel) Si plusieurs caisses sont gérées, l'admin sélectionne la caisse spécifique dont il souhaite voir le rapport.
    4.  Le système affiche l'interface de ce rapport. Le système présente un formulaire demandant à l'admin de spécifier la période pour le rapport.
    5.  L'admin spécifie la période pour laquelle il souhaite générer le rapport (ex: Journée du [Date], Semaine du [Date Début] au [Date Fin], Mois de [Mois], Période personnalisée).
    6.  L'admin valide les paramètres (clique sur "Générer Rapport", "Appliquer la période").
    7.  Le système identifie la caisse et la période.
    8.  Le système calcule :
        -   Le solde d'ouverture de la caisse au début de la période spécifiée.
        -   Le total des entrées enregistrées pendant la période.
        -   Le total des sorties enregistrées pendant la période.
        -   Le solde de clôture de la caisse à la fin de la période spécifiée (Solde Ouverture + Total Entrées - Total Sorties).
    9.  Le système génère la visualisation du rapport, généralement un tableau présentant ces chiffres récapitulatifs pour la période sélectionnée. Il peut aussi inclure des sous-totaux par type d'entrée/sortie si pertinent.
    10. Le système affiche le rapport récapitulatif à l'écran de l'admin.
    11. L'admin consulte le rapport pour analyser les flux de caisse sur la période et vérifier les soldes d'ouverture/clôture.
    12. (Optionnel) Le rapport peut inclure un lien vers la liste détaillée des mouvements de caisse pour cette période (UC 69/70 liste filtrée par date et caisse) pour permettre un drill-down.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Paramètres de période manquants ou invalides**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. L'admin ne fournit pas la période ou les valeurs sont invalides (ex: date de fin antérieure à la date de début).
        -   8.a. Le système affiche des messages d'erreur. L'admin doit corriger les paramètres.

    -   **Scénario Alternatif A2 : Aucune entrée/sortie enregistrée pour la période/caisse spécifiée**

        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.a. Le système calcule les totaux et soldes, mais constate qu'aucun mouvement n'a été enregistré pour la période et la caisse spécifiées.
        -   10.a. Le rapport affiche des totaux d'entrées et sorties à 0, et le solde d'ouverture et de clôture est identique (celui du début de période). Un message peut indiquer qu'aucun mouvement n'a été trouvé.
        -   11.a. L'admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors du calcul ou de la génération du rapport**
        -   ... (Étapes 1 à 8 du scénario principal)
        -   9.e. Une erreur technique imprévue se produit lors de la récupération des mouvements, du calcul des totaux/soldes, ou de la génération de la visualisation du rapport.
        -   10.e. Le système enregistre l'erreur technique.
        -   11.e. Le système affiche un message d'erreur générique à l'admin l'informant que le rapport récapitulatif n'a pas pu être généré ou affiché.

-   **Points à considérer pour la suite :**
    -   Comment la sélection de la période est-elle conviviale (calendrier, options rapides pour "Aujourd'hui", "Hier", "Cette semaine", "Ce mois") ?
    -   Le rapport peut-il être exporté ? (Lien avec UC 61).
    -   Le rapport permet-il de voir le détail des mouvements (drill-down vers UC 72) ou d'exporter ces détails ?
    -   Comment les différentes devises sont-elles gérées si applicable ?

---

**UC 73 - Visualiser les projections et tendances de caisse**

-   **Module :** 17 - Gestion Financière & Trésorerie Interne
-   **Acteur principal :** admin (avec les droits d'analyse financière)

-   **Description :** Permet à un admin de consulter des analyses prospectives ou des visualisations de tendances basées sur les mouvements de trésorerie (potentiellement englobant la caisse physique, mais aussi les flux bancaires, etc., selon la définition de "caisse" dans ce contexte - assumons une vue plus large des flux de trésorerie si le terme "projections" est utilisé). Ces analyses aident à anticiper les besoins futurs et à comprendre les dynamiques des flux financiers.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour accéder aux rapports de projections et tendances financières.
    -   Le système dispose de données historiques suffisantes sur les mouvements de trésorerie.
    -   Le système est configuré pour générer des analyses de projections et tendances (modèles de calcul, algorithmes).
    -   (Optionnel) Le système a des données sur les engagements futurs ou revenus attendus pour alimenter les projections.

-   **Postconditions :**

    -   Un rapport ou une visualisation des projections et tendances de trésorerie est affiché à l'écran de l'admin.
    -   L'admin a une vision prospective ou historique analysée des flux financiers.
    -   Aucune modification des données n'est effectuée.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Gestion Financière", "Analyse Financière", "Projections Trésorerie", ou accède directement à ce rapport depuis la liste des rapports (UC 60).
    3.  Le système affiche l'interface de ce rapport/analyse. Le système peut présenter un formulaire demandant à l'admin de spécifier les paramètres de l'analyse.
    4.  L'admin spécifie les critères pour l'analyse :
        -   La période historique à analyser pour les tendances.
        -   La période future pour les projections.
        -   Les types de flux financiers à inclure (ex: Entrées/Sorties Caisse, Encaissements Cotisations, Paiements Préstations, Dépenses Opérationnelles).
        -   (Optionnel) Des hypothèses pour les projections (ex: croissance estimée des cotisations, dépenses prévues).
    5.  L'admin valide les paramètres (clique sur "Générer Analyse", "Appliquer").
    6.  Le système récupère les données historiques nécessaires selon les critères spécifiés.
    7.  Le système exécute les calculs d'analyse de tendances (ex: moyennes, saisonnalité) et les modèles de projection basés sur les données historiques et les éventuelles hypothèses/données futures.
    8.  Le système génère la visualisation de l'analyse, typiquement sous forme de graphiques linéaires (ex: évolution des soldes dans le temps, projection des flux futurs) ou de tableaux synthétiques présentant les chiffres clés des tendances et projections.
    9.  Le système affiche le rapport ou la visualisation à l'écran de l'admin.
    10. L'admin consulte l'analyse pour identifier les dynamiques financières passées, anticiper les périodes de flux tendus ou excédentaires, et éclairer les décisions de gestion de trésorerie.

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Paramètres de rapport requis manquants ou invalides (géré par UC 60 si accessible via liste rapports)**

        -   ... (Étapes 1 à 5 du scénario principal)
        -   6.a. L'admin ne fournit pas les paramètres requis ou les valeurs sont invalides.
        -   7.a. Le système affiche des messages d'erreur. L'admin doit corriger les paramètres.

    -   **Scénario Alternatif A2 : Données historiques insuffisantes ou incohérentes pour l'analyse**

        -   ... (Étapes 1 à 6 du scénario principal)
        -   7.a. Le système constate que les données historiques disponibles sont insuffisantes, trop courtes, ou contiennent des incohérences qui empêchent de générer une analyse de tendance ou une projection fiable.
        -   8.a. Le système affiche un message d'erreur ou un avertissement (ex: "Données historiques insuffisantes pour une projection fiable"). Le rapport peut ne pas être généré ou être affiché avec une indication de fiabilité faible.
        -   9.a. L'admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors de la récupération/analyse des données ou de la génération du rapport**
        -   ... (Étapes 1 à 7 du scénario principal)
        -   8.e. Une erreur technique imprévue se produit lors de l'accès aux données, de l'exécution des calculs d'analyse/projection, ou de la génération de la visualisation du rapport.
        -   9.e. Le système enregistre l'erreur technique.
        -   10.e. Le système affiche un message d'erreur générique à l'admin l'informant que l'analyse n'a pas pu être générée ou affichée.

-   **Points à considérer pour la suite :**
    -   Quelles sources de données précises sont utilisées pour ces analyses (caisse physique, comptes bancaires, cotisations dues, prestations dues, etc.) ?
    -   Quels modèles ou méthodes sont utilisés pour les projections (basés sur l'historique, basés sur les engagements/revenus futurs connus) ?
    -   L'admin peut-il ajuster les modèles ou les hypothèses des projections ?
    -   Le rapport permet-il d'exporter les données ou les graphiques ? (Lien avec UC 61).
    -   Le niveau de détail de l'analyse est-il configurable (vue globale vs détaillée par type de flux) ?

---

**UC 74 - Visualiser la santé financière à J-1**

-   **Module :** 17 - Gestion Financière & Trésorerie Interne
-   **Acteur principal :** admin (avec les droits d'accès aux rapports financiers globaux)

-   **Description :** Fournit à un admin une vue d'ensemble agrégée et synthétique de la situation financière globale de la mutuelle, basée sur les données de la veille (J-1). Ce rapport ou tableau de bord consolidé inclut des indicateurs clés sur les actifs, les passifs, les revenus, les dépenses et les liquidités disponibles.

-   **Préconditions :**

    -   L'admin est authentifié dans le système et dispose des droits nécessaires pour accéder aux rapports financiers globaux.
    -   Le système a complété le traitement des données financières pour la journée précédente (clôture journalière si applicable).
    -   Le système est configuré pour agréger les données financières provenant de tous les modules pertinents (cotisations, prestations, dépenses, caisse, banques, etc.) en un rapport synthétique quotidien.

-   **Postconditions :**

    -   Un rapport consolidé ou un tableau de bord affichant la santé financière de la mutuelle à la date de la veille (J-1) est affiché à l'écran de l'admin.
    -   L'admin a une vision globale et à jour (de la veille) de la situation financière.
    -   Aucune modification des données n'est effectuée.

-   **Scénario principal :**

    1.  L'admin se connecte à l'interface d'administration.
    2.  L'admin navigue dans le menu vers la section "Gestion Financière", "Rapports", "Tableau de Bord Financier", ou accède directement à ce rapport spécifique.
    3.  Le système affiche le rapport ou le tableau de bord de santé financière à J-1. Ce rapport présente des indicateurs agrégés clés, qui peuvent être calculés quotidiennement lors d'un processus de clôture ou de synthèse. Les informations peuvent inclure :
        -   **Synthèse de Trésorerie :** Solde des comptes bancaires à J-1, Solde de la caisse physique à J-1 (UC 71), Total des liquidités disponibles.
        -   **Revenus :** Total des cotisations perçues à J-1 (journée précédente), Total des autres revenus perçus à J-1, Total des revenus cumulés (mois/année en cours).
        -   **Dépenses :** Total des prestations réglées à J-1, Total des dépenses de fonctionnement enregistrées à J-1 (UC 67), Total des dépenses cumulées (mois/année en cours), Répartition rapide des dépenses cumulées (lien vers UC 68).
        -   **Indicateurs Clés :** Ratio de couverture des prestations, Ratio de solvabilité simplifié, Marge d'exploitation (revenus - dépenses de fonctionnement).
        -   **Résumé des Créances/Dettes :** Total des cotisations dues non payées (arriérés), Total des prestations dues non réglées, Total des dettes fournisseurs.
    4.  L'admin consulte les différents indicateurs, tableaux et graphiques synthétiques présentés sur ce tableau de bord financier pour évaluer la santé financière globale de la mutuelle à la fin de la journée précédente.
    5.  (Optionnel) Certains indicateurs ou résumés peuvent être cliquables pour accéder à des rapports plus détaillés (ex: cliquer sur "Total Cotisations Perçues" mène à un rapport détaillé des encaissements de cotisations pour la veille ou le mois).

-   **Scénarios alternatifs et d'exception :**

    -   **Scénario Alternatif A1 : Données de J-1 non disponibles ou non finalisées**

        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.a. Le système détecte que le processus de synthèse financière pour la journée précédente (J-1) n'a pas été exécuté, a échoué, ou n'est pas encore terminé.
        -   5.a. Le système affiche un message indiquant que les données de J-1 ne sont pas disponibles et affiche soit les données du jour précédent complet disponible, soit un message d'erreur/information.
        -   6.a. L'admin prend connaissance de l'information.

    -   **Scénario d'Exception E1 : Erreur système lors de l'agrégation ou de l'affichage des données financières**
        -   ... (Étapes 1 à 3 du scénario principal)
        -   4.e. Une erreur technique imprévue se produit lors de la tentative de récupérer ou d'agréger les données financières de J-1 provenant des différents modules pour construire le rapport.
        -   5.e. Le système enregistre l'erreur technique dans ses journaux.
        -   6.e. Le système affiche un message d'erreur générique à l'admin l'informant que le rapport de santé financière n'a pas pu être généré ou affiché pour le moment.

-   **Points à considérer pour la suite :**
    -   Quelles sont précisément les sources de données financières agrégées dans ce rapport (tous les flux, ou seulement certains) ?
    -   Le rapport est-il personnalisable par l'administration (choix des indicateurs affichés) ?
    -   Est-ce un rapport statique quotidien ou un tableau de bord interactif ?
    -   L'accès à ce rapport est-il limité à des admins financiers ou de haut niveau ?
    -   Des alertes automatiques sont-elles générées si certains indicateurs atteignent des seuils critiques (ex: liquidités disponibles faibles) ?
    -   Le rapport permet-il d'exporter les données agrégées ? (Lien avec UC 61).

---
