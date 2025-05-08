**Modèle Relationnel Détaillé pour MySQL**

Basé sur le diagramme de classes détaillé, le modèle relationnel pour une base de données MySQL se traduit par les tables et structures suivantes :

**1. Table : `users`**

-   **Description :** Informations de base pour tous les comptes users.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique (UUID converti en chaîne).
-   `email` : VARCHAR(255) {Non Nul, Unique} - Adresse email de connexion.
-   `mot_de_passe_hache` : VARCHAR(255) {Non Nul} - Mot de passe haché.
-   `statut_compte` : ENUM('actif', 'inactif', 'bloqué') {Non Nul, Défaut: 'actif'} - Statut du compte.
-   `date_creation` : DATETIME {Non Nul} - Date et heure de création.
-   `derniere_connexion` : DATETIME {Nullable} - Dernière connexion réussie.
-   `date_mise_a_jour_mot_de_passe` : DATE {Nullable} - Date du dernier changement de mot de passe.

**2. Table : `administrateurs`**

-   **Description :** Détails spécifiques aux users de type Administrateur.
-   `id` : VARCHAR(36) {Clé Primaire, Clé Étrangère référence `users(id)`} - Identifiant de l'utilisateur (est aussi l'administrateur).
-   `nom` : VARCHAR(255) {Non Nul} - Nom de l'administrateur.
-   `prenom` : VARCHAR(255) {Non Nul} - Prénom de l'administrateur.
-   `service` : VARCHAR(255) {Nullable} - Service ou département.

**3. Table : `super_administrateurs`**

-   **Description :** Marqueur pour les administrateurs ayant le statut de Super Administrateur.
-   `id` : VARCHAR(36) {Clé Primaire, Clé Étrangère référence `administrateurs(id)`} - Identifiant de l'administrateur (qui est super admin).

**4. Table : `mutualistes`**

-   **Description :** Détails spécifiques aux users de type Mutualiste (adhérents).
-   `id` : VARCHAR(36) {Clé Primaire, Clé Étrangère référence `users(id)`} - Identifiant de l'utilisateur (est aussi le mutualiste).
-   `numero_adherent` : VARCHAR(255) {Non Nul, Unique} - Numéro d'adhérent unique.
-   `nom` : VARCHAR(255) {Non Nul} - Nom du mutualiste.
-   `prenom` : VARCHAR(255) {Non Nul} - Prénom du mutualiste.
-   `date_naissance` : DATE {Non Nul} - Date de naissance.
-   `lieu_naissance` : VARCHAR(255) {Nullable} - Lieu de naissance.
-   `sexe` : ENUM('H', 'F') {Nullable} - Sexe.
-   `adresse` : TEXT {Nullable} - Adresse.
-   `telephone` : VARCHAR(255) {Nullable} - Numéro de téléphone.
-   `profession` : VARCHAR(255) {Nullable} - Profession.
-   `statut_social` : VARCHAR(255) {Nullable} - Statut social.
-   `date_premiere_adhesion` : DATE {Non Nul} - Date de la première adhésion.

**5. Table : `ayants_droit`**

-   **Description :** Informations sur les personnes rattachées à un mutualiste principal.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique de l'ayant droit.
-   `mutualiste_id` : VARCHAR(36) {Clé Étrangère référence `mutualistes(id)`, Non Nul} - Référence au mutualiste principal. {Contrainte : ON DELETE CASCADE}
-   `nom` : VARCHAR(255) {Non Nul} - Nom.
-   `prenom` : VARCHAR(255) {Non Nul} - Prénom.
-   `date_naissance` : DATE {Non Nul} - Date de naissance.
-   `lien_parente` : VARCHAR(255) {Non Nul} - Relation avec le mutualiste (ex: 'Conjoint', 'Enfant').
-   `statut` : ENUM('actif', 'inactif', 'décédé') {Non Nul, Défaut: 'actif'} - Statut dans la couverture.

**6. Table : `contrats`**

-   **Description :** Modèles de contrats d'adhésion proposés par la mutuelle.
-   `id` : INT {Clé Primaire, Auto-incrément} - Identifiant unique du contrat.
-   `nom` : VARCHAR(255) {Non Nul, Unique} - Nom du contrat.
-   `description` : TEXT {Nullable} - Description des garanties.
-   `date_debut_validite` : DATE {Non Nul} - Date de début de validité du modèle.
-   `date_fin_validite` : DATE {Nullable} - Date de fin de validité du modèle.
-   `montant_cotisation_base` : DECIMAL(10, 2) {Non Nul} - Montant de base de la cotisation.
-   `periode_cotisation` : ENUM('Mensuel', 'Trimestriel', 'Annuel') {Non Nul} - Fréquence de la cotisation.
-   `est_actif` : BOOLEAN {Non Nul, Défaut: TRUE} - Modèle actuellement proposé.

**7. Table : `adhesions`**

-   **Description :** Instance de l'adhésion d'un mutualiste à un contrat spécifique pour une période.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique de l'adhésion.
-   `mutualiste_id` : VARCHAR(36) {Clé Étrangère référence `mutualistes(id)`, Non Nul} - Référence au mutualiste.
-   `contrat_id` : INT {Clé Étrangère référence `contrats(id)`, Non Nul} - Référence au contrat.
-   `date_debut` : DATE {Non Nul} - Date de début de l'adhésion.
-   `date_fin` : DATE {Nullable} - Date de fin de l'adhésion.
-   `statut` : ENUM('actif', 'résilié', 'expiré', 'suspendu') {Non Nul, Défaut: 'actif'} - Statut de l'adhésion.
-   `reference_externe` : VARCHAR(255) {Nullable} - Référence externe.

**8. Table : `cotisations`**

-   **Description :** Échéances de paiement dues par un mutualiste.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique de la cotisation.
-   `adhesion_id` : VARCHAR(36) {Clé Étrangère référence `adhesions(id)`, Non Nul} - Référence à l'adhésion concernée.
-   `periode_concerne` : VARCHAR(7) {Non Nul} - Période de la cotisation (ex: 'YYYY-MM').
-   `montant_previste` : DECIMAL(10, 2) {Non Nul} - Montant prévu.
-   `montant_paye` : DECIMAL(10, 2) {Non Nul, Défaut: 0.00} - Montant total payé pour cette échéance.
-   `date_limite_paiement` : DATE {Non Nul} - Date limite de paiement.
-   `date_paiement_effective` : DATE {Nullable} - Date où la cotisation a été considérée comme payée.
-   `statut` : ENUM('due', 'payée', 'partielle', 'en retard', 'annulée') {Non Nul, Défaut: 'due'} - Statut de l'échéance.
-   `reference_externe` : VARCHAR(255) {Nullable} - Référence externe.

**9. Table : `paiements`**

-   **Description :** Enregistrements des encaissements reçus des mutualistes.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique du paiement.
-   `mutualiste_id` : VARCHAR(36) {Clé Étrangère référence `mutualistes(id)`, Non Nul} - Référence au mutualiste payeur.
-   `date_paiement` : DATETIME {Non Nul} - Date et heure de réception.
-   `montant_recu` : DECIMAL(10, 2) {Non Nul} - Montant total reçu.
-   `mode_paiement` : ENUM('Espèces', 'Virement Bancaire', 'Mobile Money', 'Chèque', 'Carte Bancaire') {Non Nul} - Mode de paiement.
-   `reference_transaction_externe` : VARCHAR(255) {Nullable, Unique} - Référence de transaction externe.
-   `statut` : ENUM('validé', 'en attente', 'annulé', 'échoué') {Non Nul, Défaut: 'en attente'} - Statut du traitement.
-   `enregistre_par_utilisateur_id` : VARCHAR(36) {Clé Étrangère référence `users(id)`, Non Nul} - Qui a enregistré le paiement.

**10. Table : `paiements_cotisations`**

-   **Description :** Table de jointure liant les paiements aux cotisations couvertes (relation N:N).
-   `paiement_id` : VARCHAR(36) {Clé Primaire, Clé Étrangère référence `paiements(id)`} - Référence au paiement.
-   `cotisation_id` : VARCHAR(36) {Clé Primaire, Clé Étrangère référence `cotisations(id)`} - Référence à la cotisation.
-   `montant_applique` : DECIMAL(10, 2) {Non Nul} - Montant du paiement appliqué à cette cotisation.

**11. Table : `prets`**

-   **Description :** Prêts financiers accordés aux mutualistes.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique du prêt.
-   `mutualiste_id` : VARCHAR(36) {Clé Étrangère référence `mutualistes(id)`, Non Nul} - Bénéficiaire du prêt.
-   `date_accord` : DATE {Non Nul} - Date d'accord.
-   `montant_total` : DECIMAL(10, 2) {Non Nul} - Montant total.
-   `taux_interet` : DECIMAL(5, 2) {Non Nul} - Taux d'intérêt.
-   `duree_mois` : INT {Non Nul} - Durée en mois.
-   `montant_restant_du` : DECIMAL(10, 2) {Non Nul} - Montant restant dû.
-   `date_prochaine_echeance` : DATE {Nullable} - Prochaine échéance.
-   `statut` : ENUM('en cours', 'soldé', 'en retard', 'annulé', 'en litige') {Non Nul, Défaut: 'en cours'} - Statut du prêt.
-   `objectif` : VARCHAR(255) {Nullable} - Motif du prêt.
-   `accorde_par_admin_id` : VARCHAR(36) {Clé Étrangère référence `administrateurs(id)`, Non Nul} - Administrateur ayant accordé.

**12. Table : `rachats_prets`**

-   **Description :** Dossiers de rachat de prêts externes.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique du rachat.
-   `mutualiste_id` : VARCHAR(36) {Clé Étrangère référence `mutualistes(id)`, Non Nul} - Mutualiste concerné.
-   `organisme_exterieur` : VARCHAR(255) {Non Nul} - Organisme initial.
-   `montant_initial` : DECIMAL(10, 2) {Non Nul} - Montant initial du prêt.
-   `montant_rachete` : DECIMAL(10, 2) {Non Nul} - Montant racheté par la mutuelle.
-   `date_rachat` : DATE {Non Nul} - Date de l'opération de rachat.
-   `montant_restant_du` : DECIMAL(10, 2) {Non Nul} - Montant restant dû à la mutuelle.
-   `date_prochaine_echeance` : DATE {Nullable} - Prochaine échéance de remboursement à la mutuelle.
-   `statut` : ENUM('en cours', 'soldé', 'en litige', 'clôturé') {Non Nul, Défaut: 'en cours'} - Statut du dossier.
-   `enregistre_par_admin_id` : VARCHAR(36) {Clé Étrangère référence `administrateurs(id)`, Non Nul} - Administrateur ayant enregistré.

**13. Table : `aides_ponctuelles`**

-   **Description :** Aides financières exceptionnelles.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique de l'aide.
-   `mutualiste_id` : VARCHAR(36) {Clé Étrangère référence `mutualistes(id)`, Non Nul} - Bénéficiaire de l'aide.
-   `date_aide` : DATE {Non Nul} - Date d'accord.
-   `montant` : DECIMAL(10, 2) {Non Nul} - Montant de l'aide.
-   `motif` : VARCHAR(255) {Non Nul} - Motif de l'aide.
-   `statut` : ENUM('accordée', 'versée', 'refusée', 'annulée') {Non Nul, Défaut: 'accordée'} - Statut de l'aide.
-   `verifiee_par_admin_id` : VARCHAR(36) {Clé Étrangère référence `administrateurs(id)`, Non Nul} - Administrateur ayant validé.
-   `versee_par_admin_id` : VARCHAR(36) {Clé Étrangère référence `administrateurs(id)`, Nullable} - Administrateur ayant enregistré le versement.

**14. Table : `prestations`**

-   **Description :** Types de services ou actes couverts.
-   `id` : INT {Clé Primaire, Auto-incrément} - Identifiant unique.
-   `nom` : VARCHAR(255) {Non Nul, Unique} - Nom de la prestation.
-   `description` : TEXT {Nullable} - Description.
-   `code_interne` : VARCHAR(255) {Nullable, Unique} - Code interne/externe.
-   `montant_reference` : DECIMAL(10, 2) {Nullable} - Montant de référence.
-   `est_active` : BOOLEAN {Non Nul, Défaut: TRUE} - Active ou non.
-   `categorie_prestation` : VARCHAR(255) {Nullable} - Catégorie.

**15. Table : `prises_en_charge`**

-   **Description :** Demandes de remboursement ou couverture de prestations.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique.
-   `reference` : VARCHAR(255) {Non Nul, Unique} - Référence unique de la demande.
-   `date_soins_facture` : DATE {Non Nul} - Date des soins ou facture.
-   `mutualiste_id` : VARCHAR(36) {Clé Étrangère référence `mutualistes(id)`, Non Nul} - Mutualiste principal.
-   `ayant_droit_id` : VARCHAR(36) {Clé Étrangère référence `ayants_droit(id)`, Nullable} - Ayant droit bénéficiaire.
-   `prestation_id` : INT {Clé Étrangère référence `prestations(id)`, Non Nul} - Prestation concernée.
-   `adhesion_id` : VARCHAR(36) {Clé Étrangère référence `adhesions(id)`, Non Nul} - Adhésion active au moment des soins.
-   `montant_facture` : DECIMAL(10, 2) {Non Nul} - Montant total facturé.
-   `montant_pris_en_charge` : DECIMAL(10, 2) {Non Nul} - Montant validé à prendre en charge.
-   `date_soumission` : DATETIME {Non Nul} - Date et heure de soumission.
-   `date_mise_a_jour_statut` : DATETIME {Non Nul} - Dernière mise à jour statut.
-   `statut` : ENUM('soumise', 'en cours', 'validée', 'remboursée', 'refusée', 'annulée') {Non Nul, Défaut: 'soumise'} - Statut de la demande.
-   `description` : TEXT {Nullable} - Description/motif de la demande.
-   `soumise_par_utilisateur_id` : VARCHAR(36) {Clé Étrangère référence `users(id)`, Non Nul} - Qui a soumis.
-   `validee_par_admin_id` : VARCHAR(36) {Clé Étrangère référence `administrateurs(id)`, Nullable} - Administrateur valideur.

**16. Table : `liquidations`**

-   **Description :** Paiements réalisés pour les prises en charge validées.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique.
-   `prise_en_charge_id` : VARCHAR(36) {Clé Étrangère référence `prises_en_charge(id)`, Non Nul, Unique} - Référence à la prise en charge (si 1:1).
-   `date_paiement` : DATE {Non Nul} - Date du paiement.
-   `montant_paye` : DECIMAL(10, 2) {Non Nul} - Montant payé.
-   `mode_paiement` : ENUM('Virement Bancaire', 'Chèque', 'Espèces Caisse') {Non Nul} - Mode de paiement.
-   `reference_transaction` : VARCHAR(255) {Nullable} - Référence de transaction.
-   `paye_par_admin_id` : VARCHAR(36) {Clé Étrangère référence `administrateurs(id)`, Non Nul} - Administrateur ayant traité le paiement.

**17. Table : `materiels`**

-   **Description :** Biens physiques disponibles pour prêt.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique.
-   `reference_unique` : VARCHAR(255) {Non Nul, Unique} - Code d'inventaire unique.
-   `nom` : VARCHAR(255) {Non Nul} - Nom du matériel.
-   `description` : TEXT {Nullable} - Description.
-   `type_materiel` : VARCHAR(255) {Nullable} - Type de matériel.
-   `statut` : ENUM('disponible', 'prêté', 'en réparation', 'perdu', 'mis au rebut') {Non Nul, Défaut: 'disponible'} - Statut actuel.
-   `date_acquisition` : DATE {Nullable} - Date d'acquisition.
-   `valeur_acquisition` : DECIMAL(10, 2) {Nullable} - Valeur.

**18. Table : `prets_materiels`**

-   **Description :** Instances de prêts de matériel à un mutualiste.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique du prêt matériel.
-   `materiel_id` : VARCHAR(36) {Clé Étrangère référence `materiels(id)`, Non Nul} - Matériel prêté.
-   `mutualiste_id` : VARCHAR(36) {Clé Étrangère référence `mutualistes(id)`, Non Nul} - Mutualiste bénéficiaire.
-   `date_pret` : DATE {Non Nul} - Date du prêt.
-   `date_retour_previe` : DATE {Non Nul} - Date de retour prévue.
-   `date_retour_effective` : DATE {Nullable} - Date réelle de retour.
-   `etat_initial` : TEXT {Nullable} - État au prêt.
-   `etat_retour` : TEXT {Nullable} - État au retour.
-   `statut` : ENUM('en cours', 'retourné', 'en retard', 'perdu', 'endommagé') {Non Nul, Défaut: 'en cours'} - Statut du prêt.
-   `enregistre_par_admin_id` : VARCHAR(36) {Clé Étrangère référence `administrateurs(id)`, Non Nul} - Qui a enregistré le prêt.
-   `retour_enregistre_par_admin_id` : VARCHAR(36) {Clé Étrangère référence `administrateurs(id)`, Nullable} - Qui a enregistré le retour.

**19. Table : `reclamations`**

-   **Description :** Demandes ou plaintes soumises par les mutualistes.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique.
-   `reference` : VARCHAR(255) {Non Nul, Unique} - Référence unique.
-   `mutualiste_id` : VARCHAR(36) {Clé Étrangère référence `mutualistes(id)`, Non Nul} - Mutualiste soumetteur.
-   `date_soumission` : DATETIME {Non Nul} - Date et heure de soumission.
-   `sujet` : VARCHAR(255) {Non Nul} - Sujet.
-   `description` : TEXT {Non Nul} - Contenu.
-   `statut` : ENUM('soumise', 'en cours', 'résolue', 'fermée', 'escaladée') {Non Nul, Défaut: 'soumise'} - Statut.
-   `date_mise_a_jour_statut` : DATETIME {Non Nul} - Dernière mise à jour statut.
-   `soumise_par_utilisateur_id` : VARCHAR(36) {Clé Étrangère référence `users(id)`, Non Nul} - Qui a soumis.
-   `assignee_a_admin_id` : VARCHAR(36) {Clé Étrangère référence `administrateurs(id)`, Nullable} - Admin responsable.

**20. Table : `conversations`**

-   **Description :** Fils de discussion dans la messagerie interne.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique.
-   `sujet` : VARCHAR(255) {Non Nul} - Sujet de la conversation.
-   `date_creation` : DATETIME {Non Nul} - Date et heure de création.
-   `statut` : ENUM('ouvert', 'fermé', 'archivé') {Non Nul, Défaut: 'ouvert'} - Statut de la conversation.

**21. Table : `messages`**

-   **Description :** Messages individuels dans une conversation.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique.
-   `conversation_id` : VARCHAR(36) {Clé Étrangère référence `conversations(id)`, Non Nul} - Conversation parente.
-   `utilisateur_id` : VARCHAR(36) {Clé Étrangère référence `users(id)`, Non Nul} - Expéditeur.
-   `date_envoi` : DATETIME {Non Nul} - Date et heure d'envoi.
-   `contenu` : TEXT {Non Nul} - Contenu du message.
-   `est_lu` : BOOLEAN {Non Nul, Défaut: FALSE} - Indique si le message est lu (simplifié).

**22. Table : `conversations_participants`**

-   **Description :** Table de jointure liant users et conversations (relation N:N participants).
-   `conversation_id` : VARCHAR(36) {Clé Primaire, Clé Étrangère référence `conversations(id)`} - Référence à la conversation.
-   `utilisateur_id` : VARCHAR(36) {Clé Primaire, Clé Étrangère référence `users(id)`} - Référence au participant.
-   `date_jointure` : DATETIME {Non Nul} - Date d'ajout à la conversation.
-   `est_actif` : BOOLEAN {Non Nul, Défaut: TRUE} - Participant toujours actif.

**23. Table : `notifications`**

-   **Description :** Alertes système pour les users.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique.
-   `utilisateur_id` : VARCHAR(36) {Clé Étrangère référence `users(id)`, Non Nul} - Destinataire.
-   `date_generation` : DATETIME {Non Nul} - Date de génération.
-   `type_notification` : VARCHAR(255) {Non Nul} - Type (code).
-   `titre` : VARCHAR(255) {Non Nul} - Titre.
-   `contenu` : TEXT {Nullable} - Contenu.
-   `est_lue` : BOOLEAN {Non Nul, Défaut: FALSE} - Marqué comme lu.
-   `date_lecture` : DATETIME {Nullable} - Date de lecture.
-   `lien_cible` : VARCHAR(255) {Nullable} - Lien vers l'élément concerné.

**24. Table : `depenses_fonctionnement`**

-   **Description :** Enregistrements des dépenses opérationnelles internes.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique.
-   `reference` : VARCHAR(255) {Non Nul, Unique} - Référence unique.
-   `date_depense` : DATE {Non Nul} - Date de la dépense.
-   `montant` : DECIMAL(10, 2) {Non Nul} - Montant.
-   `beneficiaire` : VARCHAR(255) {Non Nul} - Bénéficiaire.
-   `categorie_depense_id` : INT {Clé Étrangère référence `categories_depenses(id)`, Non Nul} - Catégorie.
-   `description` : TEXT {Nullable} - Description.
-   `mode_paiement` : VARCHAR(255) {Nullable} - Mode de paiement.
-   `date_enregistrement` : DATETIME {Non Nul} - Date d'enregistrement système.
-   `enregistre_par_admin_id` : VARCHAR(36) {Clé Étrangère référence `administrateurs(id)`, Non Nul} - Administrateur ayant enregistré.

**25. Table : `categories_depenses`**

-   **Description :** Classification des dépenses.
-   `id` : INT {Clé Primaire, Auto-incrément} - Identifiant unique.
-   `nom` : VARCHAR(255) {Non Nul, Unique} - Nom de la catégorie.
-   `description` : VARCHAR(255) {Nullable} - Description.
-   `est_active` : BOOLEAN {Non Nul, Défaut: TRUE} - Catégorie active.

**26. Table : `caisses`**

-   **Description :** Caisses physiques gérées.
-   `id` : INT {Clé Primaire, Auto-incrément} - Identifiant unique.
-   `nom` : VARCHAR(255) {Non Nul, Unique} - Nom de la caisse.
-   `description` : VARCHAR(255) {Nullable} - Description.
-   `devise` : VARCHAR(3) {Non Nul} - Devise (code ISO 4217, ex: 'XOF').

**27. Table : `mouvements_caisse`**

-   **Description :** Transactions (entrées/sorties) affectant une caisse physique.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique.
-   `caisse_id` : INT {Clé Étrangère référence `caisses(id)`, Non Nul} - Caisse concernée.
-   `date_heure_mouvement` : DATETIME {Non Nul} - Date et heure du mouvement physique.
-   `type_mouvement` : ENUM('Entrée', 'Sortie') {Non Nul} - Type de mouvement.
-   `montant` : DECIMAL(10, 2) {Non Nul} - Montant du mouvement.
-   `source_motif` : VARCHAR(255) {Non Nul} - Source ou motif.
-   `description` : TEXT {Nullable} - Justification détaillée.
-   `enregistre_par_admin_id` : VARCHAR(36) {Clé Étrangère référence `administrateurs(id)`, Non Nul} - Administrateur ayant enregistré.
-   `date_enregistrement` : DATETIME {Non Nul} - Date d'enregistrement système.
-   `depense_fonctionnement_id` : VARCHAR(36) {Clé Étrangère référence `depenses_fonctionnement(id)`, Nullable} - Dépense associée (si sortie pour dépense).
-   `paiement_id` : VARCHAR(36) {Clé Étrangère référence `paiements(id)`, Nullable} - Paiement associé (si entrée pour encaissement).

**28. Table : `logs_activites`**

-   **Description :** Journal des actions et événements système.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique.
-   `date_heure` : DATETIME {Non Nul} - Date et heure de l'événement.
-   `utilisateur_id` : VARCHAR(36) {Clé Étrangère référence `users(id)`, Nullable} - Utilisateur ayant déclenché l'action.
-   `type_action` : VARCHAR(255) {Non Nul} - Type d'action.
-   `objet_type` : VARCHAR(255) {Nullable} - Type de l'entité concernée.
-   `objet_id` : VARCHAR(36) {Nullable} - ID de l'entité concernée (en chaîne).
-   `details` : TEXT {Nullable} - Détails supplémentaires (changements, etc.).
-   `resultat` : ENUM('Succès', 'Échec') {Non Nul} - Résultat de l'action.
-   `adresse_ip` : VARCHAR(45) {Nullable} - Adresse IP source.

**29. Table : `rapports`**

-   **Description :** Configuration des types de rapports disponibles.
-   `id` : INT {Clé Primaire, Auto-incrément} - Identifiant unique.
-   `nom` : VARCHAR(255) {Non Nul, Unique} - Nom du rapport.
-   `description` : VARCHAR(255) {Nullable} - Description.
-   `type_rapport` : ENUM('Parametrable', 'Statique', 'Dynamique') {Non Nul} - Type de génération.
-   `configuration_generation` : TEXT {Nullable} - Configuration technique (JSON, etc.).
-   `chemin_fichier_statique` : VARCHAR(255) {Nullable} - Chemin si rapport statique.
-   `est_actif` : BOOLEAN {Non Nul, Défaut: TRUE} - Visible et utilisable.

**30. Table : `sauvegardes_db`**

-   **Description :** Journal des opérations de sauvegarde de la base de données.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique de l'enregistrement.
-   `date_heure_debut` : DATETIME {Non Nul} - Début de l'opération.
-   `date_heure_fin` : DATETIME {Nullable} - Fin de l'opération.
-   `statut` : ENUM('EnCours', 'Succès', 'Échec', 'Annulé') {Non Nul} - Statut final.
-   `taille_fichier` : DECIMAL(15, 2) {Nullable} - Taille du fichier (ex: en Mo).
-   `chemin_fichier` : VARCHAR(255) {Nullable} - Chemin/Identifiant du fichier.
-   `type_sauvegarde` : ENUM('Complète', 'Incrémentale', 'Différentielle') {Non Nul} - Type de sauvegarde.
-   `utilisateur_id` : VARCHAR(36) {Clé Étrangère référence `users(id)`, Nullable} - Qui a déclenché (si manuel).
-   `message_erreur` : TEXT {Nullable} - Message d'erreur.

**31. Table : `restaurations_db`**

-   **Description :** Journal des opérations de restauration de la base de données.
-   `id` : VARCHAR(36) {Clé Primaire} - Identifiant unique de l'enregistrement.
-   `date_heure_debut` : DATETIME {Non Nul} - Début de l'opération.
-   `date_heure_fin` : DATETIME {Nullable} - Fin de l'opération.
-   `statut` : ENUM('EnCours', 'Succès', 'Échec', 'Annulé') {Non Nul} - Statut final.
-   `fichier_sauvegarde_source` : VARCHAR(255) {Non Nul} - Référence au fichier de sauvegarde utilisé.
-   `utilisateur_id` : VARCHAR(36) {Clé Étrangère référence `users(id)`, Non Nul} - Qui a déclenché (Super Admin).
-   `message_erreur` : TEXT {Nullable} - Message d'erreur.
