**Nom de la Classe :** Utilisateur

**Type :** Classe Abstraite / Principale

**Description :** Représente une personne ayant un compte et accédant au système (peut être un Mutualiste ou un Administrateur). Contient les informations d'identification et de connexion communes.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique du compte utilisateur.
-   `email` : String {Unique} - Adresse email utilisée comme identifiant de connexion et contact.
-   `motDePasseHache` : String {Non Nul} - Version hachée et sécurisée du mot de passe.
-   `statutCompte` : Enum (actif, inactif, bloqué) {Non Nul} - État actuel du compte utilisateur.
-   `dateCreation` : DateTime {Non Nul} - Date et heure de création du compte.
-   `derniereConnexion` : DateTime {Nullable} - Date et heure de la dernière connexion réussie.
-   `dateMiseAJourMotDePasse` : Date {Nullable} - Date du dernier changement de mot de passe.

**Méthodes Possibles :**

-   `authentifier(email, motDePasse)` : Boolean - Vérifie les informations de connexion.
-   `changerMotDePasse(ancienMotDePasse, nouveauMotDePasse)` : Boolean - Met à jour le mot de passe après vérification de l'ancien.
-   `reinitialiserMotDePasse(nouveauMotDePasseHache)` : Boolean - Définit un nouveau mot de passe (utilisé par Admin ou procédure automatisée).
-   `verrouillerCompte()` : Boolean - Change le statut du compte à "bloqué".
-   `activerCompte()` : Boolean - Change le statut du compte à "actif".

---

**Nom de la Classe :** Administrateur

**Type :** Classe Principale (Hérite de Utilisateur)

**Description :** Représente un membre du personnel de la mutuelle ayant accès à l'interface d'administration et à diverses fonctionnalités de gestion.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire, Clé Étrangère} - Identifiant unique de l'administrateur (hérité de Utilisateur).
-   `nom` : String {Non Nul} - Nom de famille de l'administrateur.
-   `prenom` : String {Non Nul} - Prénom(s) de l'administrateur.
-   `service` : String {Nullable} - Service ou département auquel appartient l'administrateur.

**Méthodes Possibles :**

-   `creerCompteAdmin(donnees)` : Administrateur - Crée un nouveau compte administrateur.
-   `modifierCompteAdmin(adminId, donnees)` : Boolean - Modifie les informations d'un compte administrateur.
-   `assignerRole(roleId)` : Boolean - Associe un rôle à cet administrateur.
-   `visualiserLogs(filtres)` : List\<LogActivité\> - Consulte les journaux d'activité.
-   `traiterReclamation(reclamationId, actions)` : Boolean - Effectue une action sur une réclamation.

---

**Nom de la Classe :** Super Administrateur

**Type :** Classe Principale (Hérite de Administrateur)

**Description :** Représente un administrateur disposant des droits les plus élevés, capable de gérer les users, les rôles, les permissions et la configuration système.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire, Clé Étrangère} - Identifiant unique du super administrateur (hérité de Administrateur).
    _(Souvent, cette classe n'a pas d'attributs propres, son rôle spécial est défini par les permissions associées à son compte via le système de rôles)._

**Méthodes Possibles :**

-   `gererRoles(actions, roleId, donnees)` : Boolean - Crée, modifie ou supprime des rôles.
-   `gererPermissions(actions, permissionId, donnees)` : Boolean - Crée, modifie ou supprime des permissions (ou les associe aux rôles).
-   `modifierConfigurationSysteme(parametres)` : Boolean - Met à jour les paramètres globaux du système.
-   `lancerSauvegardeBD()` : Boolean - Déclenche une sauvegarde manuelle de la base de données.
-   `gererComptesAdmin(actions, adminId, donnees)` : Boolean - Crée, modifie, active/désactive d'autres comptes administrateurs.

---

**Nom de la Classe :** Mutualiste

**Type :** Classe Principale (Hérite de Utilisateur)

**Description :** Représente un membre (adhérent) de la mutuelle. Contient ses informations personnelles et d'adhésion.

**Attributs :**

-   `id` : VARCHAR(36) {Clé Primaire, Clé Étrangère}
    -   `numero_adherent` : VARCHAR(255) {Unique, Non Nul}
    -   `nom` : VARCHAR(255) {Non Nul}
    -   `prenom` : VARCHAR(255) {Non Nul}
    -   `date_naissance` : DATE {Non Nul}
    -   `lieu_naissance` : VARCHAR(255) {Nullable}
    -   `sexe` : ENUM (H, F, Autre) {Nullable}
    -   `adresse` : TEXT {Nullable}
    -   `telephone` : VARCHAR(255) {Nullable}
    -   `profession_id` : INT {Clé Étrangère}
    -   `poste_responsabilite_id` : INT {Clé Étrangère}
    -   `statut_social` : VARCHAR(255) {Nullable}
    -   `date_premiere_adhesion` : DATE {Non Nul}
    -   `created_at` : DATETIME {Nullable}
    -   `updated_at` : DATETIME {Nullable}
    -   `created_by_user_id` : VARCHAR(36) {Clé Étrangère}
    -   `updated_by_user_id` : VARCHAR(36) {Clé Étrangère}

**Méthodes Possibles :**

-   `creerDossier(donneesPersonnelles)` : Mutualiste - Crée un nouvel enregistrement mutualiste.
-   `modifierDossier(donnees)` : Boolean - Met à jour les informations du mutualiste.
-   `ajouterAyantDroit(donneesAyantDroit)` : AyantDroit - Crée un nouvel ayant droit rattaché à ce mutualiste.
-   `ouvrirReclamation(sujet, description)` : Réclamation - Crée une nouvelle réclamation soumise par ce mutualiste.
-   `visualiserCotisations()` : List\<Cotisation\> - Récupère la liste de ses cotisations.

---

**Nom de la Classe :** Profession
**Type :** Classe Principale / Entité Lookup
**Description :** Représente un métier ou une activité professionnelle type.
**Attributs :**
_ `id` : Integer {Clé Primaire, Auto-incrément}
_ `libelle` : String {Unique, Non Nul}

**Méthodes Possibles :**
_ `creerProfession(libelle)` : Profession
_ `modifierProfession(libelle)` : Boolean \* `listerProfessions()` : List\<Profession\>

---

-   **Nom de la Classe :** GroupeMutualiste
-   **Type :** Classe Principale / Entité Lookup
-   **Description :** Représente une catégorie ou un ensemble de postes de responsabilité pour organiser les mutualistes.
-   **Attributs :**
    -   `id` : Integer {Clé Primaire, Auto-incrément}
    -   `libelle` : String {Unique, Non Nul}
-   **Operations:**
    -   `creerGroupe(libelle)` : GroupeMutualiste
    -   `modifierGroupe(libelle)` : Boolean
    -   `listerGroupes()` : List\<GroupeMutualiste\>
    -   `listerPostes()` : List\<PosteResponsabilite\>

---

**Nom de la Classe :** FonctionMutualiste
**Type :** Classe Principale / Entité Lookup
**Description :** Représente un rôle ou une fonction spécifique au sein d'un groupe de responsabilité.
**Attributs :**

-   `id` : Identifiant de la fonction
-   `libelle` : Libette de la function.
-   `groupe_mutualiste_id`: L'identifiant du groupe auquel cette fonction est rattache.

---

**Nom de la classe:** TypeAyantDroit
**Description:** Represente un type d'ayant droit

-   `id`: Identifiant
-   `libelle`: Libelle
-   `description:` Description du type d'ayant droit

---

**Nom de la Classe :** AyantDroit

**Type :** Classe Principale

**Description :** Représente une personne (conjoint, enfant, etc.) rattachée au mutualiste principal et bénéficiant de la couverture.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique de l'ayant droit.
-   `type_id`: Reference le type d'ayant droit.
-   `mutualisteId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence vers le mutualiste principal auquel il est rattaché.
-   `nom` : String {Non Nul} - Nom de famille (peut être celui du mutualiste ou le sien).
-   `prenom` : String {Non Nul} - Prénom(s).
-   `dateNaissance` : Date {Non Nul} - Date de naissance.
-   `gender`: Enum(masculin,feminin) - Sexe de l'ayant droit.
-   `statut` : Enum (actif, inactif, décédé) {Non Nul} - Statut de l'ayant droit au sein de la couverture.

**Méthodes Possibles :**

-   `creer(donneesAyantDroit, mutualisteId)` : AyantDroit - Crée un nouvel ayant droit rattaché à un mutualiste.
-   `modifier(donnees)` : Boolean - Met à jour les informations de l'ayant droit.
-   `desactiver()` : Boolean - Change le statut à "inactif".

---

**Nom de la Classe :** Contrat

**Type :** Classe Principale

**Description :** Définit un modèle de contrat d'adhésion avec ses caractéristiques (nom, garanties, coût de base, période de cotisation).

**Attributs :**

-   `id` : Integer {Clé Primaire} - Identifiant unique du contrat.
-   `nom` : String {Unique, Non Nul} - Nom du contrat (ex: "Formule Essentiel", "Pack Famille +").
-   `description` : Text {Nullable} - Description détaillée des garanties.
-   `dateDebutValidite` : Date {Non Nul} - Date à partir de laquelle ce modèle de contrat est valide.
-   `dateFinValidite` : Date {Nullable} - Date jusqu'à laquelle ce modèle est valide (si obsolète).
-   `montant`: Decimal {Non Nul} - Montant de l'adhésion.
-   `montantCotisationBase` : Decimal {Non Nul} - Montant de la cotisation standard pour ce contrat (hors options/réductions individuelles).
-   `periodeCotisation` : Enum (Mensuel, Trimestriel, Annuel) {Non Nul} - Fréquence de la cotisation.
-   `estActif` : Boolean {Non Nul} - Indique si ce modèle de contrat est actuellement proposé aux adhérents.

**Méthodes Possibles :**

-   `creer(donneesContrat)` : Contrat - Crée un nouveau modèle de contrat.
-   `modifier(donnees)` : Boolean - Modifie les caractéristiques du contrat.
-   `ajouterPrestation(prestationId)` : Boolean - Associe une prestation à ce contrat (géré via une classe d'association ContratPrestation si règles spécifiques par prestation).
-   `desactiver()` : Boolean - Change le statut "estActif" à false.

---

**Nom de la classe:** GroupeContrat
**Description:** Definit le choix de contrat d'adhesion pour un groupe donne
**Attributes:**

-   `groupe_id`: Identifiant du groupe
-   `contrat_id`: Identifiant du contrat

---

**Nom de la Classe :** Adhesion

**Type :** Classe Principale

**Description :** Représente l'engagement actif d'un Mutualiste vis-à-vis d'un Contrat sur une période donnée. Liens entre Mutualiste et Contrat.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique de l'adhésion.
-   `mutualisteId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence au mutualiste concerné.
-   `contratId` : Integer {Clé Étrangère, Non Nul} - Référence au modèle de contrat concerné.
-   `dateDebut` : Date {Non Nul} - Date de début de l'adhésion sous ce contrat.
-   `dateFin` : Date {Nullable} - Date de fin de l'adhésion (si résiliée ou expirée).
-   `statut` : Enum (actif, résilié, expiré, suspendu) {Non Nul} - Statut actuel de l'adhésion.
-   `referenceExterne` : String {Nullable} - Toute référence externe liée à l'adhésion (ex: ID dans un ancien système).

**Méthodes Possibles :**

-   `creer(mutualisteId, contratId, dateDebut)` : Adhesion - Crée une nouvelle adhésion.
-   `resilier(dateFin, motif)` : Boolean - Change le statut à "résilié" et définit la date de fin.
-   `suspendre()` : Boolean - Change le statut à "suspendu".
-   `reactiver()` : Boolean - Change le statut à "actif".
-   `genererCotisations()` : List\<Cotisation\> - Génère les échéances de cotisation basées sur le contrat et la période.

---

**Nom de la Classe :** Cotisation

**Type :** Classe Principale

**Description :** Représente une échéance de paiement due par un mutualiste pour une période donnée de son adhésion.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique de la cotisation.
-   `adhesionId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence à l'adhésion concernée.
-   `periodeConcerne` : String {Non Nul} - La période que couvre cette cotisation (ex: "2024-03", "2024-T2", "2024").
-   `montantPreviste` : Decimal {Non Nul} - Le montant initialement prévu pour cette échéance.
-   `montantPaye` : Decimal {Calculé, Non Nul} - La somme totale des montants appliqués par les paiements reçus.
-   `dateLimitePaiement` : Date {Non Nul} - Date avant laquelle la cotisation doit être payée.
-   `datePaiementEffective` : Date {Nullable} - Date à laquelle la cotisation a été considérée comme entièrement payée.
-   `statut` : Enum (due, payée, partielle, en retard, annulée) {Non Nul} - Statut actuel de l'échéance.
-   `referenceExterne` : String {Nullable} - Toute référence externe liée à cette cotisation.

**Méthodes Possibles :**

-   `generer(adhesionId, periode, montant, dateLimite)` : Cotisation - Crée une nouvelle échéance de cotisation.
-   `appliquerPaiement(montant)` : Boolean - Réduit le `montantPreviste` restant dû et met à jour le `montantPaye`.
-   `marquerPayee()` : Boolean - Change le statut à "payée" et met à jour `datePaiementEffective`.
-   `marquerEnRetard()` : Boolean - Change le statut à "en retard" (souvent déclenché par un processus automatique).
-   `annuler()` : Boolean - Change le statut à "annulée".

---

**Nom de la Classe :** Paiement

**Type :** Classe Principale

**Description :** Représente un encaissement d'argent réel reçu d'un mutualiste.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique du paiement.
-   `mutualisteId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence au mutualiste qui a effectué le paiement.
-   `datePaiement` : DateTime {Non Nul} - Date et heure de réception du paiement.
-   `montantRecu` : Decimal {Non Nul} - Le montant total reçu.
-   `modePaiement` : Enum (Espèces, Virement Bancaire, Mobile Money, Chèque, Carte Bancaire) {Non Nul} - Méthode utilisée pour le paiement.
-   `referenceTransactionExterne` : String {Nullable} - Numéro de transaction, référence bancaire, numéro de chèque, etc.
-   `statut` : Enum (validé, en attente, annulé, échoué) {Non Nul} - Statut du traitement du paiement dans le système.
-   `enregistreParUtilisateurId` : UUID / Integer {Clé Étrangère, Non Nul} - Qui a enregistré ce paiement (Mutualiste si paiement en ligne, Administrateur si paiement manuel).

**Méthodes Possibles :**

-   `enregistrer(donneesPaiement, utilisateurId)` : Paiement - Crée un nouvel enregistrement de paiement.
-   `valider()` : Boolean - Marque le paiement comme validé.
-   `appliquerAuxCotisations(listeCotisations, montants)` : Boolean - Associe ce paiement à une ou plusieurs cotisations et répartit le montant.
-   `annuler()` : Boolean - Marque le paiement comme annulé.

---

**Nom de la Classe :** PaiementCotisation

**Type :** Classe d'Association

**Description :** Lien entre un Paiement et une Cotisation, spécifiant quelle partie d'un paiement couvre quelle partie d'une cotisation. (Nécessaire car un paiement peut couvrir plusieurs cotisations, et une cotisation peut être couverte par plusieurs paiements partiels).

**Attributs :**

-   `paiementId` : UUID / Integer {Clé Primaire, Clé Étrangère, Non Nul} - Référence au paiement concerné.
-   `cotisationId` : UUID / Integer {Clé Primaire, Clé Étrangère, Non Nul} - Référence à la cotisation concernée.
-   `montantApplique` : Decimal {Non Nul} - Le montant de ce paiement qui est appliqué à cette cotisation spécifique.

**Méthodes Possibles :**

-   `creerLien(paiementId, cotisationId, montant)` : PaiementCotisation - Crée une nouvelle association entre un paiement et une cotisation.

---

**Nom de la Classe :** Prêt

**Type :** Classe Principale

**Description :** Représente un prêt financier accordé par la mutuelle à un mutualiste.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique du prêt.
-   `mutualisteId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence au mutualiste bénéficiaire du prêt.
-   `dateAccord` : Date {Non Nul} - Date à laquelle le prêt a été accordé.
-   `montantTotal` : Decimal {Non Nul} - Montant total du prêt.
-   `tauxInteret` : Decimal {Non Nul} - Taux d'intérêt annuel du prêt.
-   `dureeMois` : Integer {Non Nul} - Durée initiale du prêt en mois.
-   `montantRestantDu` : Decimal {Calculé, Non Nul} - Montant principal restant dû.
-   `dateProchaineEcheance` : Date {Nullable} - Date de la prochaine échéance de remboursement.
-   `statut` : Enum (en cours, soldé, en retard, annulé, en litige) {Non Nul} - Statut actuel du prêt.
-   `objectif` : String {Nullable} - Motif ou objectif du prêt (ex: "Frais de scolarité", "Projet divers").
-   `accordeParAdminId` : UUID / Integer {Clé Étrangère, Non Nul} - Administrateur qui a accordé le prêt.

**Méthodes Possibles :**

-   `accorder(mutualisteId, montant, taux, duree, objectif, adminId)` : Pret - Crée un nouveau prêt avec le statut "en cours".
-   `enregistrerRemboursement(montant, date)` : Boolean - Applique un remboursement au prêt, réduit le montant restant dû, met à jour la prochaine échéance.
-   `marquerSolde()` : Boolean - Change le statut à "soldé".
-   `marquerEnRetard()` : Boolean - Change le statut à "en retard" (souvent automatique).

---

**Nom de la Classe :** RachatPret

**Type :** Classe Principale

**Description :** Représente un dossier où la mutuelle a racheté le prêt d'un mutualiste auprès d'un organisme externe.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique du dossier de rachat.
-   `mutualisteId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence au mutualiste concerné par le rachat.
-   `organismeExterieur` : String {Non Nul} - Nom de l'organisme auprès duquel le prêt a été racheté.
-   `montantInitial` : Decimal {Non Nul} - Montant initial du prêt racheté.
-   `montantRachete` : Decimal {Non Nul} - Montant pour lequel le rachat a été effectué par la mutuelle.
-   `dateRachat` : Date {Non Nul} - Date de l l'opération de rachat.
-   `montantRestantDu` : Decimal {Calculé, Non Nul} - Montant restant dû à la mutuelle sur ce rachat.
-   `dateProchaineEcheance` : Date {Nullable} - Date de la prochaine échéance de remboursement à la mutuelle.
-   `statut` : Enum (en cours, soldé, en litige, clôturé) {Non Nul} - Statut actuel du dossier de rachat dans le système de la mutuelle.
-   `enregistreParAdminId` : UUID / Integer {Clé Étrangère, Non Nul} - Administrateur qui a enregistré le rachat.

**Méthodes Possibles :**

-   `enregistrerRachat(mutualisteId, organisme, montantRachete, date, adminId)` : RachatPret - Crée un nouveau dossier de rachat.
-   `enregistrerRemboursement(montant, date)` : Boolean - Applique un remboursement au rachat.
-   `marquerSolde()` : Boolean - Change le statut à "soldé".

---

**Nom de la classe:** TypeAllocation
**Description:** Decris des types d'allocation
**Attributs:**

-   `id`: Identifiant
-   `libelle`: Libelle du type d'allocation
-   `montantStandard`: Montant par default de ce type d'allocation.
-   `montantMax`: Montant maximal appliquable pour cette allocation.
-   `montantMin`: Montant minimal appliquable pour cette allocation.

---

**Nom de la classe:** GroupeAllocation
**Description:** Associe un type d'allocation a un groupe

-   `groupe_id`: Groupe id
-   `type_allocation_id`: Le type d'allocation
-   `montant`: Montant de l'allocation

---

**Nom de la Classe :** Allocation

**Type :** Classe Principale
**Description :** Représente une aide financière exceptionnelle accordée à un mutualiste, non liée à une prestation, un prêt ou un rachat.
**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique de l'aide ponctuelle.
-   `mutualisteId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence au mutualiste bénéficiaire de l'aide.
-   `type_allocation_id`: Reference le type d'allocation.
-   `date` : Date {Non Nul} - Date à laquelle l'aide a été accordée.
-   `montant` : Decimal {Non Nul} - Montant de l'aide.
-   `motif` : String {Non Nul} - Motif ou raison de l'aide.
-   `statut` : Enum (accordée, versée, refusée, annulée) {Non Nul} - Statut de l'aide.
-   `verifieeParAdminId` : UUID / Integer {Clé Étrangère, Non Nul} - Administrateur qui a validé l'aide.
-   `verseeParAdminId` : UUID / Integer {Clé Étrangère, Nullable} - Administrateur qui a enregistré le versement (si différent).

**Méthodes Possibles :**

-   `accorder(mutualisteId, montant, motif, adminId)` : AidePonctuelle - Crée une nouvelle aide avec statut "accordée".
-   `marquerVersee(adminId)` : Boolean - Change le statut à "versée".
-   `refuser(motif)` : Boolean - Change le statut à "refusée".

---

**Nom de la classe:** TypePrestation
**Description**: Representation une categorie de prestation.

-   `id`: Identifiant unique de la prestation
-   `libelle`: Le libelle du type de prestation.

---

**Nom de classe:** IneligibilitePrestation
**Description**: Represente l'ineligibilite d'un mutualiste pour une prestation donnee

-   `id`: Identifiant unique
-   `mutualiste_id:` Identifiant du mutualiste
-   `type_prestation_id`: Identifiant du type de prestation
-   `date_expiration`: Date d'expiration de l'ineligibilite

---

**Nom de la Classe :** Prestation

**Type :** Classe Principale

**Description :** Représente un type de service, soin ou acte qui peut être couvert ou proposé par la mutuelle.

**Attributs :**

-   `id` : Integer {Clé Primaire} - Identifiant unique de la prestation.
-   `nom` : String {Unique, Non Nul} - Nom de la prestation (ex: "Consultation Généraliste", "Radio X", "Lunettes Simples").
-   `description` : Text {Nullable} - Description détaillée de la prestation.
-   `codeInterne` : String {Nullable, Unique} - Code interne ou code utilisé dans des nomenclatures externes.
-   `montantReference` : Decimal {Nullable} - Montant de référence pour cette prestation (utilisé pour les calculs de prise en charge).
-   `estActive` : Boolean {Non Nul} - Indique si cette prestation est actuellement prise en charge.
-   `type_id` : String {Nullable} - Catégorie à laquelle appartient la prestation (ex: "Consultation", "Imagerie", "Optique", "Dentaire"). (Enum ou référence si liste finie).

**Méthodes Possibles :**

-   `creer(donneesPrestation)` : Prestation - Crée une nouvelle prestation.
-   `modifier(donnees)` : Boolean - Modifie les informations de la prestation.
-   `desactiver()` : Boolean - Change le statut "estActive" à false.

---

**Nom de la Classe :** PriseEnCharge

**Type :** Classe Principale

**Description :** Représente une demande de remboursement ou de prise en charge pour une prestation reçue par un mutualiste ou un ayant droit.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique de la prise en charge.
-   `reference` : String {Unique, Non Nul} - Référence unique attribuée par le système.
-   `dateSoinsFacture` : Date {Non Nul} - Date des soins ou de la facture.
-   `mutualisteId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence au mutualiste principal concerné.
-   `ayantDroitId` : UUID / Integer {Clé Étrangère, Nullable} - Référence à l'ayant droit bénéficiaire si applicable.
-   `prestationId` : Integer {Clé Étrangère, Non Nul} - Référence à la prestation concernée.
-   `adhesionId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence à l'adhésion active au moment des soins (pour vérifier la couverture).
-   `montantFacture` : Decimal {Non Nul} - Montant total de la facture des soins.
-   `montantPrisEnCharge` : Decimal {Non Nul} - Montant calculé qui sera pris en charge par la mutuelle.
-   `dateSoumission` : DateTime {Non Nul} - Date et heure de soumission de la demande dans le système.
-   `dateMiseAJourStatut` : DateTime {Non Nul} - Date et heure du dernier changement de statut.
-   `statut` : Enum (soumise, en cours, validée, remboursée, refusée, annulée) {Non Nul} - Statut actuel de la demande.
-   `description` : Text {Nullable} - Description ou motif de la demande.
-   `soumiseParUtilisateurId` : UUID / Integer {Clé Étrangère, Non Nul} - Qui a soumis la demande (Mutualiste si via espace personnel, Administrateur si enregistrée par Admin).
-   `valideeParAdminId` : UUID / Integer {Clé Étrangère, Nullable} - Administrateur qui a validé ou refusé la demande.

**Méthodes Possibles :**

-   `soumettre(donnees, utilisateurId)` : PriseEnCharge - Crée une nouvelle demande de prise en charge.
-   `valider(adminId, montantPrisEnCharge)` : Boolean - Calcule le montant pris en charge et change le statut à "validée".
-   `refuser(adminId, motif)` : Boolean - Change le statut à "refusée".
-   `marquerRemboursee()` : Boolean - Change le statut à "remboursée" (souvent lié à la création d'une Liquidation).
-   `associerJustificatif(documentId)` : Boolean - Lie un document justificatif à la demande.

**Note**
L'eligilite d'un mutualiste pour une prise en charge est calculee en prenant en compte les anciennes prestation recus

---

**Nom de la classe**: ModaliteRemboursement
**Description**: Represente les modalite de remboursement d'une prise en charge.

-   `id`: Identifiant de la modalité de prise en charge.
-   `type_prestation_id`: Identifiant du type de soin.
-   `type_ayant_droit_id`: Represente le type de l'ayant droit.
-   `taux_hopital_public`: Pourcentage de remboursement pour les frais dans un hopital public.
-   `taux_hopital_prive`: Pourcentage de remboursement pour les frais dans un hopital prive.

---

**Nom de la Classe :** Remboursement

**Type :** Classe Principale

**Description :** Représente le paiement effectif réalisé par la mutuelle pour régler une ou plusieurs prises en charge validées.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique du remboursement.
-   `priseEnChargeId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence à la prise en charge qui est réglée par ce remboursement.
-   `datePaiement` : Date {Non Nul} - Date à laquelle le paiement a été effectué.
-   `montantPaye` : Decimal {Non Nul} - Montant effectivement payé (doit correspondre au `montantPrisEnCharge` de la PriseEnCharge liée).
-   `modePaiement` : Enum (Virement Bancaire, Chèque, Espèces Caisse) {Non Nul} - Méthode de paiement utilisée pour le remboursement.
-   `referenceTransaction` : String {Nullable} - Référence de la transaction bancaire, numéro de chèque, référence de sortie de caisse.
-   `payeParAdminId` : UUID / Integer {Clé Étrangère, Non Nul} - Administrateur qui a enregistré/initié le paiement.

**Méthodes Possibles :**

-   `creer(priseEnChargeId, montant, modePaiement, reference, adminId)` : Remboursement - Enregistre un nouveau remboursement pour une prise en charge.
-   `associerPrisesEnCharge(listePrisesEnChargeIds)` : Boolean - Permet de lier potentiellement plusieurs prises en charge à une seule remboursement (si paiements groupés). _Note : Le modèle actuel lie Remboursement à 1 PriseEnCharge. Une relation M:N avec association class RemboursementPriseEnCharge serait plus flexible pour les paiements groupés._ Restons sur 1:1 pour l'instant comme dans le concept.
-   `notifierMutualiste()` : Boolean - Déclenche une notification ou un message pour informer le mutualiste du paiement.

---

**Nom de la Classe :** Matériel

**Type :** Classe Principale

**Description :** Représente un bien physique géré par la mutuelle et disponible pour prêt.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique du matériel.
-   `referenceUnique` : String {Unique, Non Nul} - Code ou numéro d'inventaire unique du matériel.
-   `nom` : String {Non Nul} - Nom du matériel (ex: "Fauteuil roulant", "Béquilles", "Lit médicalisé").
-   `description` : Text {Nullable} - Description détaillée et caractéristiques.
-   `typeMateriel` : String {Nullable} - Type de matériel (Enum ou référence si liste finie, ex: "Mobilité", "Respiration").
-   `statut` : Enum (disponible, prêté, en réparation, perdu, mis au rebut) {Non Nul} - Statut actuel du matériel physique.
-   `dateAcquisition` : Date {Nullable} - Date d'acquisition du matériel.
-   `valeurAcquisition` : Decimal {Nullable} - Valeur d'acquisition.

**Méthodes Possibles :**

-   `enregistrer(donneesMateriel)` : Materiel - Crée un nouvel enregistrement de matériel.
-   `marquerStatut(nouveauStatut)` : Boolean - Met à jour le statut du matériel.
-   `estDisponible()` : Boolean - Vérifie si le statut est "disponible".

---

**Nom de la Classe :** PretMateriel

**Type :** Classe Principale

**Description :** Représente une instance spécifique du prêt d'un Matériel à un Mutualiste.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique de ce prêt spécifique de matériel.
-   `materielId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence au matériel prêté.
-   `mutualisteId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence au mutualiste bénéficiaire du prêt.
-   `datePret` : Date {Non Nul} - Date à laquelle le matériel a été prêté.
-   `dateRetourPrevie` : Date {Non Nul} - Date à laquelle le matériel doit être retourné.
-   `dateRetourEffective` : Date {Nullable} - Date réelle du retour du matériel.
-   `etatInitial` : Text {Nullable} - Description ou photo de l'état du matériel au moment du prêt.
-   `etatRetour` : Text {Nullable} - Description ou photo de l'état du matériel au retour.
-   `statut` : Enum (en cours, retourné, en retard, perdu, endommagé) {Non Nul} - Statut du prêt de matériel.
-   `enregistreParAdminId` : UUID / Integer {Clé Étrangère, Non Nul} - Administrateur qui a enregistré le prêt.
-   `retourEnregistreParAdminId` : UUID / Integer {Clé Étrangère, Nullable} - Administrateur qui a enregistré le retour.

**Méthodes Possibles :**

-   `enregistrerPret(materielId, mutualisteId, datePret, dateRetourPrevie, etatInitial, adminId)` : PretMateriel - Crée un nouvel enregistrement de prêt matériel.
-   `enregistrerRetour(dateRetourEffective, etatRetour, adminId)` : Boolean - Enregistre le retour du matériel, met à jour le statut et les informations de retour.
-   `marquerEnRetard()` : Boolean - Change le statut à "en retard" (souvent automatique).
-   `marquerPerdu()` : Boolean - Change le statut à "perdu".

---

**Nom de la Classe :** Réclamation

**Type :** Classe Principale

**Description :** Représente une demande formelle ou une plainte soumise par un mutualiste.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique de la réclamation.
-   `reference` : String {Unique, Non Nul} - Référence unique générée par le système.
-   `mutualisteId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence au mutualiste qui soumet la réclamation.
-   `dateSoumission` : DateTime {Non Nul} - Date et heure de soumission de la réclamation.
-   `sujet` : String {Non Nul} - Sujet ou titre de la réclamation.
-   `description` : Text {Non Nul} - Contenu détaillé de la réclamation.
-   `statut` : Enum (soumise, en cours, résolue, fermée, escaladée) {Non Nul} - Statut actuel de la réclamation.
-   `dateMiseAJourStatut` : DateTime {Non Nul} - Date et heure du dernier changement de statut.
-   `soumiseParUtilisateurId` : UUID / Integer {Clé Étrangère, Non Nul} - Qui a soumis la réclamation (Mutualiste ou Administrateur).
-   `assigneeAAdminId` : UUID / Integer {Clé Étrangère, Nullable} - Administrateur actuellement responsable du traitement de la réclamation.

**Méthodes Possibles :**

-   `soumettre(mutualisteId, sujet, description, utilisateurId)` : Réclamation - Crée une nouvelle réclamation avec statut "soumise".
-   `assignerA(adminId)` : Boolean - Associe un administrateur à la réclamation.
-   `changerStatut(nouveauStatut)` : Boolean - Met à jour le statut de la réclamation.
-   `ajouterCommentaire(utilisateurId, commentaire)` : CommentaireReclamation - Ajoute une note ou un commentaire interne/public.
-   `cloturer(resolution)` : Boolean - Change le statut à "fermée" et enregistre la résolution.

---

**Nom de la Classe :** Conversation

**Type :** Classe Principale

**Description :** Représente un fil de discussion dans le système de messagerie interne.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique de la conversation.
-   `sujet` : String {Non Nul} - Sujet de la conversation.
-   `dateCreation` : DateTime {Non Nul} - Date et heure de création de la conversation.
-   `statut` : Enum (ouvert, fermé, archivé) {Non Nul} - Statut actuel de la conversation.

**Méthodes Possibles :**

-   `creer(sujet)` : Conversation - Crée une nouvelle conversation.
-   `ajouterParticipant(utilisateurId)` : Boolean - Associe un utilisateur à la conversation (via ConversationParticipant).
-   `envoyerMessage(utilisateurId, contenu)` : Message - Crée et ajoute un nouveau message à cette conversation.
-   `cloturer()` : Boolean - Change le statut à "fermé".

---

**Nom de la Classe :** Message

**Type :** Classe Principale

**Description :** Représente un message individuel envoyé dans le cadre d'une conversation interne.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique du message.
-   `conversationId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence à la conversation à laquelle appartient le message.
-   `utilisateurId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence à l'utilisateur qui a envoyé le message.
-   `dateEnvoi` : DateTime {Non Nul} - Date et heure d'envoi du message.
-   `contenu` : Text {Non Nul} - Corps du message.
-   `estLu` : Boolean {Non Nul, Par défaut = False} - Indique si le message a été lu par les destinataires. _Note : Le statut "lu" est souvent géré par destinataire plutôt qu'un attribut unique du message. Une classe d'association MessageLuParUtilisateur serait plus précise si le suivi de lecture par personne est nécessaire._ Restons simple pour l'instant et considérons cet attribut comme un flag général ou le premier "lu".

**Méthodes Possibles :**

-   `creer(conversationId, utilisateurId, contenu)` : Message - Crée un nouveau message.
-   `marquerLu(utilisateurId)` : Boolean - Enregistre que ce message a été lu par un utilisateur spécifique. _Implique la nécessité d'une structure pour suivre la lecture par destinataire._

---

**Nom de la Classe :** ConversationParticipant

**Type :** Classe d'Association

**Description :** Lie un Utilisateur à une Conversation, indiquant qu'il fait partie de ce fil de discussion. (Nécessaire car une conversation a plusieurs participants et un utilisateur peut participer à plusieurs conversations).

**Attributs :**

-   `conversationId` : UUID / Integer {Clé Primaire, Clé Étrangère, Non Nul} - Référence à la conversation.
-   `utilisateurId` : UUID / Integer {Clé Primaire, Clé Étrangère, Non Nul} - Référence au participant.
-   `dateJointure` : DateTime {Non Nul} - Date à laquelle l'utilisateur a rejoint/été ajouté à la conversation.
-   `estActif` : Boolean {Non Nul, Par défaut = True} - Indique si le participant est toujours actif dans cette conversation.

**Méthodes Possibles :**

-   `ajouterParticipant(conversationId, utilisateurId)` : ConversationParticipant - Crée un lien de participation.
-   `retirerParticipant()` : Boolean - Change le statut "estActif" à false.

---

**Nom de la Classe :** Notification

**Type :** Classe Principale

**Description :** Représente une alerte ou une information générée par le système et destinée à un utilisateur spécifique.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique de la notification.
-   `utilisateurId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence à l'utilisateur destinataire.
-   `dateGeneration` : DateTime {Non Nul} - Date et heure à laquelle la notification a été générée.
-   `typeNotification` : String {Non Nul} - Code ou type de notification (ex: "NOUVEAU_MESSAGE", "COTISATION_DUE", "PRISE_CHARGE_VALIDEE"). (Enum ou référence si liste finie).
-   `titre` : String {Non Nul} - Titre affiché de la notification.
-   `contenu` : Text {Nullable} - Contenu détaillé de la notification.
-   `estLue` : Boolean {Non Nul, Par défaut = False} - Indique si l'utilisateur a marqué la notification comme lue.
-   `dateLecture` : DateTime {Nullable} - Date et heure à laquelle la notification a été lue.
-   `lienCible` : String {Nullable} - URL ou référence interne vers l'élément du système auquel la notification se rapporte (ex: `/messages/conversation/123`, `/prestations/prise-en-charge/456`).

**Méthodes Possibles :**

-   `creer(utilisateurId, type, titre, contenu, lienCible)` : Notification - Crée une nouvelle notification.
-   `marquerLue()` : Boolean - Change "estLue" à true et définit "dateLecture".

---

-   **Nom de la Classe :** Caisse
-   **Type :** Classe Principale
-   **Description :** Représente une caisse physique pour la gestion de l'argent liquide.
-   **Attributs :**
    -   `id` : Integer {Clé Primaire, Auto-incrément}
    -   `nom` : String {Unique, Non Nul}
    -   `description` : String {Nullable}
    -   `devise` : String {Non Nul}
-   **Méthodes Possibles :**
    -   `creer(nom, description, devise)` : Caisse
    -   `getSoldeActuel()` : Decimal

---

-   **Nom de la Classe :** CategorieEntree
-   **Type :** Classe Principale / Entité Lookup
-   **Description :** Classification des types de mouvements d'entrée d'argent en caisse.
-   **Attributs :**
    -   `id` : Integer {Clé Primaire, Auto-incrément}
    -   `libelle` : String {Unique, Non Nul}
    -   `description` : String {Nullable}
    -   `estActif` : Boolean {Non Nul}
-   **Méthodes Possibles :**
    -   `creer(libelle, description)` : CategorieEntree
    -   `modifier(donnees)` : Boolean
    -   `desactiver()` : Boolean

---

-   **Nom de la Classe :** CategorieSortie
-   **Type :** Classe Principale / Entité Lookup
-   **Description :** Classification des types de mouvements de sortie de caisse, incluant les catégories de dépense.
-   **Attributs :**
    -   `id` : Integer {Clé Primaire, Auto-incrément}
    -   `libelle` : String {Unique, Non Nul}
    -   `description` : String {Nullable}
    -   `estActive` : Boolean {Non Nul}
-   **Méthodes Possibles :**
    -   `creer(libelle, description)` : CategorieSortie
    -   `modifier(donnees)` : Boolean
    -   `desactiver()` : Boolean

---

-   **Nom de la Classe :** Entree
-   **Type :** Classe Principale
-   **Description :** Enregistrement d'un mouvement d'entrée d'argent dans une caisse.
-   **Attributs :**

    -   `id` : UUID {Clé Primaire}
    -   `caisseId` : Integer {Clé Étrangère, Non Nul}
    -   `categorieEntreeId` : Integer {Clé Étrangère, Non Nul}
    -   `dateHeureMouvement` : DateTime {Non Nul}
    -   `montant` : Decimal {Non Nul}
    -   `sourceMotif` : String {Non Nul}
    -   `description` : Text {Nullable}
    -   `referenceExterne` : String {Nullable}
    -   `paiementId` : UUID {Clé Étrangère, Nullable}
    -   `dateEnregistrement` : DateTime {Non Nul}
    -   `enregistreParAdminId` : UUID {Clé Étrangère, Non Nul}

-   **Méthodes Possibles :**
    -   `enregistrer(donnees, adminId, paiementIdOptionnel)` : Entree
    -   `caisse()` : Caisse
    -   `categorieEntree()` : CategorieEntree
    -   `paiement()` : Paiement

---

-   **Nom de la Classe :** Sortie
-   **Type :** Classe Principale
-   **Description :** Enregistrement d'un mouvement de sortie d'argent d'une caisse (inclut le paiement de dépenses).
-   **Attributs :**

    -   `id` : UUID {Clé Primaire}
    -   `caisseId` : Integer {Clé Étrangère, Non Nul}
    -   `categorieSortieId` : Integer {Clé Étrangère, Non Nul}
    -   `dateHeureMouvement` : DateTime {Non Nul}
    -   `montant` : Decimal {Non Nul}
    -   `beneficiaireMotif` : String {Non Nul} - À qui/quoi la sortie est destinée.
    -   `description` : Text {Nullable}
    -   `referenceExterne` : String {Nullable}
    -   `dateEnregistrement` : DateTime {Non Nul}
    -   `enregistreParAdminId` : UUID {Clé Étrangère, Non Nul}

-   **Méthodes Possibles :**
    -   `enregistrer(donnees, adminId)` : Sortie
    -   `caisse()` : Caisse
    -   `categorieSortie()` : CategorieSortie

---

**Nom de la Classe :** Rôle

**Type :** Classe Principale

**Description :** Définit un groupe de permissions pour les administrateurs.

**Attributs :**

-   `id` : Integer {Clé Primaire} - Identifiant unique du rôle.
-   `nom` : String {Unique, Non Nul} - Nom du rôle (ex: "Gestionnaire Adhérents", "Comptable", "Superviseur").
-   `description` : String {Nullable} - Description du rôle.

**Méthodes Possibles :**

-   `creer(nom, description)` : Rôle - Crée un nouveau rôle.
-   `modifier(donnees)` : Boolean - Modifie les informations du rôle.
-   `ajouterPermission(permissionId)` : Boolean - Associe une permission à ce rôle (via RolePermission).
-   `retirerPermission(permissionId)` : Boolean - Dissocie une permission de ce rôle.

---

**Nom de la Classe :** Permission

**Type :** Classe Principale

**Description :** Représente une capacité ou une action spécifique autorisée dans le système.

**Attributs :**

-   `id` : Integer {Clé Primaire} - Identifiant unique de la permission.
-   `codeUnique` : String {Unique, Non Nul} - Code technique unique de la permission (ex: "mutualiste.creer", "pret.visualiser.tout", "systeme.configuration.gerer").
-   `description` : String {Non Nul} - Description lisible de la permission.

**Méthodes Possibles :**

-   `creer(code, description)` : Permission - Crée une nouvelle permission.
-   `modifier(donnees)` : Boolean - Modifie la description de la permission.

---

**Nom de la Classe :** AdministrateurRole

**Type :** Classe d'Association

**Description :** Lie un Administrateur à un Rôle, indiquant qu'un administrateur possède un certain rôle à partir d'une date donnée. (Nécessaire pour la relation N:N entre Administrateur et Rôle).

**Attributs :**

-   `administrateurId` : UUID / Integer {Clé Primaire, Clé Étrangère, Non Nul} - Référence à l'administrateur.
-   `roleId` : Integer {Clé Primaire, Clé Étrangère, Non Nul} - Référence au rôle.
-   `dateAttribution` : DateTime {Non Nul} - Date et heure à laquelle ce rôle a été attribué à cet administrateur.

**Méthodes Possibles :**

-   `attribuer(adminId, roleId)` : AdministrateurRole - Crée un lien d'attribution de rôle.
-   `retirer(adminId, roleId)` : Boolean - Supprime le lien d'attribution.

---

**Nom de la Classe :** RolePermission

**Type :** Classe d'Association

**Description :** Lie un Rôle à une Permission, définissant quelles permissions sont incluses dans un rôle. (Nécessaire pour la relation N:N entre Rôle et Permission).

**Attributs :**

-   `roleId` : Integer {Clé Primaire, Clé Étrangère, Non Nul} - Référence au rôle.
-   `permissionId` : Integer {Clé Primaire, Clé Étrangère, Non Nul} - Référence à la permission.
-   `dateAttribution` : DateTime {Non Nul} - Date à laquelle la permission a été associée à ce rôle.

**Méthodes Possibles :**

-   `associer(roleId, permissionId)` : RolePermission - Crée l'association entre un rôle et une permission.
-   `dissocier(roleId, permissionId)` : Boolean - Supprime l'association.

---

**Nom de la Classe :** LogActivité

**Type :** Classe Principale

**Description :** Enregistre une action significative ou un événement traçable survenu dans le système.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique du log.
-   `dateHeure` : DateTime {Non Nul} - Date et heure de l'événement.
-   `utilisateurId` : UUID / Integer {Clé Étrangère, Nullable} - Référence à l'utilisateur qui a initié l'action (Nullable pour actions système automatisées).
-   `typeAction` : String {Non Nul} - Type d'action (ex: "LOGIN_SUCCES", "MUTUALISTE_CREATION", "PRET_MODIFICATION", "SYSTEME_SAUVEGARDE"). (Code ou Enum/Référence si liste finie).
-   `objetType` : String {Nullable} - Le type de l'entité métier concernée (ex: "Mutualiste", "Pret", "PriseEnCharge").
-   `objetId` : String {Nullable} - L'identifiant de l'instance de l'entité concernée (stocké comme string pour flexibilité).
-   `details` : Text {Nullable} - Détails supplémentaires sur l'action (ex: anciennes/nouvelles valeurs pour une modification, motif d'échec). (Peut être JSON ou format structuré).
-   `resultat` : Enum (Succès, Échec) {Non Nul} - Résultat de l'action.
-   `adresseIP` : String {Nullable} - Adresse IP d'où provient l'action (pour actions utilisateur/externes).

**Méthodes Possibles :**

-   `enregistrer(utilisateurId, typeAction, objetType, objetId, details, resultat, adresseIp)` : LogActivité - Crée un nouvel enregistrement de log. _(Cette méthode est généralement appelée par le système après l'exécution d'une autre opération)._

---

**Nom de la Classe :** Rapport

**Type :** Classe Principale (Représente la Configuration d'un type de Rapport)

**Description :** Stocke la configuration et les métadonnées d'un rapport prédéfini disponible dans le système.

**Attributs :**

-   `id` : Integer {Clé Primaire} - Identifiant unique du rapport.
-   `nom` : String {Unique, Non Nul} - Nom affiché du rapport (ex: "Rapport Mensuel Cotisations", "Liste des Prêts en Retard").
-   `description` : String {Nullable} - Brève description du contenu du rapport.
-   `typeRapport` : Enum (Parametrable, Statique, Dynamique) {Non Nul} - Comment le rapport est généré/stocké.
-   `configurationGeneration` : Text {Nullable} - Configuration technique pour générer le rapport (requête SQL, paramètres, référence à un modèle). (Peut être JSON ou format structuré).
-   `cheminFichierStatique` : String {Nullable} - Chemin vers un fichier si c'est un rapport statique (ex: PDF pré-généré manuellement).
-   `estActif` : Boolean {Non Nul} - Indique si ce rapport est visible et utilisable par les administrateurs.

**Méthodes Possibles :**

-   `creer(donneesRapport)` : Rapport - Enregistre la configuration d'un nouveau type de rapport.
-   `modifier(donnees)` : Boolean - Met à jour la configuration d'un rapport.
-   `generer(parametresUtilisateur)` : FichierRapport / DonnéesRapport - Exécute la logique de génération du rapport avec les paramètres fournis. _(Cette méthode est appelée par le Système de Rapports, pas directement par cette classe de configuration)_.

---

**Nom de la Classe :** SauvegardeDB

**Type :** Classe Principale

**Description :** Enregistrement d'une opération de sauvegarde de la base de données.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique de l'enregistrement de sauvegarde.
-   `dateHeureDebut` : DateTime {Non Nul} - Date et heure du début de l'opération.
-   `dateHeureFin` : DateTime {Nullable} - Date et heure de fin de l'opération.
-   `statut` : Enum (EnCours, Succès, Échec, Annulé) {Non Nul} - Statut final de l'opération de sauvegarde.
-   `tailleFichier` : Decimal {Nullable} - Taille du fichier de sauvegarde généré en octets ou Mo/Go.
-   `cheminFichier` : String {Nullable} - Chemin ou identifiant de l'emplacement où le fichier de sauvegarde est stocké.
-   `typeSauvegarde` : Enum (Complète, Incrémentale, Différentielle) {Non Nul} - Type de sauvegarde effectuée.
-   `utilisateurId` : UUID / Integer {Clé Étrangère, Nullable} - Référence à l'utilisateur qui a déclenché la sauvegarde (Nullable si sauvegarde automatique planifiée).
-   `messageErreur` : Text {Nullable} - Message d'erreur détaillé en cas d'échec.

**Méthodes Possibles :**

-   `enregistrerDebut(type, utilisateurIdOptionnel)` : SauvegardeDB - Crée l'enregistrement de log au début de l'opération.
-   `terminer(statut, dateFin, taille, chemin, messageErreur)` : Boolean - Met à jour l'enregistrement avec les résultats de l'opération. _(Appelée par le processus de sauvegarde lui-même)_.

---

**Nom de la Classe :** RestaurationDB

**Type :** Classe Principale

**Description :** Enregistrement d'une opération de restauration de la base de données.

**Attributs :**

-   `id` : UUID / Integer {Clé Primaire} - Identifiant unique de l'enregistrement de restauration.
-   `dateHeureDebut` : DateTime {Non Nul} - Date et heure du début de l'opération.
-   `dateHeureFin` : DateTime {Nullable} - Date et heure de fin de l'opération.
-   `statut` : Enum (EnCours, Succès, Échec, Annulé) {Non Nul} - Statut final de l'opération de restauration.
-   `fichierSauvegardeSource` : String {Non Nul} - Chemin ou identifiant du fichier de sauvegarde utilisé pour la restauration. _Note : Pourrait être une FK si on stocke les SauvegardeDB en DB, mais le fichier existe potentiellement hors DB._
-   `utilisateurId` : UUID / Integer {Clé Étrangère, Non Nul} - Référence à l'utilisateur (Super Admin) qui a déclenché la restauration.
-   `messageErreur` : Text {Nullable} - Message d'erreur détaillé en cas d'échec.

**Méthodes Possibles :**

-   `enregistrerDebut(fichierSource, utilisateurId)` : RestaurationDB - Crée l'enregistrement de log au début de l'opération.
-   `terminer(statut, dateFin, messageErreur)` : Boolean - Met à jour l'enregistrement avec les résultats de l'opération. _(Appelée par le processus de restauration lui-même)_.
