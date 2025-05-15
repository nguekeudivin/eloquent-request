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
-   `enregistreParUtilisateurId` : UUID / Integer {Clé Étrangère, Non Nul} - Qui a enregistré ce paiement (Mutualiste si paiement en ligne, admin si paiement manuel).

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
-   `accordeParAdminId` : UUID / Integer {Clé Étrangère, Non Nul} - admin qui a accordé le prêt.

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
-   `enregistreParAdminId` : UUID / Integer {Clé Étrangère, Non Nul} - admin qui a enregistré le rachat.

**Méthodes Possibles :**

-   `enregistrerRachat(mutualisteId, organisme, montantRachete, date, adminId)` : RachatPret - Crée un nouveau dossier de rachat.
-   `enregistrerRemboursement(montant, date)` : Boolean - Applique un remboursement au rachat.
-   `marquerSolde()` : Boolean - Change le statut à "soldé".

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
-   `enregistreParAdminId` : UUID / Integer {Clé Étrangère, Non Nul} - admin qui a enregistré le prêt.
-   `retourEnregistreParAdminId` : UUID / Integer {Clé Étrangère, Nullable} - admin qui a enregistré le retour.

**Méthodes Possibles :**

-   `enregistrerPret(materielId, mutualisteId, datePret, dateRetourPrevie, etatInitial, adminId)` : PretMateriel - Crée un nouvel enregistrement de prêt matériel.
-   `enregistrerRetour(dateRetourEffective, etatRetour, adminId)` : Boolean - Enregistre le retour du matériel, met à jour le statut et les informations de retour.
-   `marquerEnRetard()` : Boolean - Change le statut à "en retard" (souvent automatique).
-   `marquerPerdu()` : Boolean - Change le statut à "perdu".

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
-   `estActif` : Boolean {Non Nul} - Indique si ce rapport est visible et utilisable par les admins.

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
