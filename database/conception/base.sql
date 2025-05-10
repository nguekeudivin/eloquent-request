-- ==============================================================
-- Script de création des tables pour la base de données MySQL
-- Modèle Relationnel basé sur les diagrammes de classes détaillés
-- Modifications:
-- - Utilisation cohérente des UUID (VARCHAR(36)) pour les IDs principaux.
-- - Remplacement des ENUMs de statut par une table de lookup 'type_statuts'.
-- - Ajout des champs d'audit (created_at, updated_at, created_by_user_id, updated_by_user_id).
-- ==============================================================

SET FOREIGN_KEY_CHECKS=0; -- Désactiver temporairement les vérifications de clés étrangères

-- DROP TABLES IN REVERSE ORDER OF DEPENDENCY IF THEY EXIST
/*
DROP TABLE IF EXISTS restaurations_db;
DROP TABLE IF EXISTS sauvegardes_db;
DROP TABLE IF EXISTS rapports;
DROP TABLE IF EXISTS conversation_participants;
DROP TABLE IF EXISTS notifications;
DROP TABLE IF EXISTS messages;
DROP TABLE IF EXISTS conversations;
DROP TABLE IF EXISTS reclamations;
DROP TABLE IF EXISTS pret_materiels;
DROP TABLE IF EXISTS materiels;
DROP TABLE IF EXISTS liquidations;
DROP TABLE IF EXISTS prise_en_charges;
DROP TABLE IF EXISTS mouvements_caisse;
DROP TABLE IF EXISTS caisses;
DROP TABLE IF EXISTS depense_fonctionnements;
DROP TABLE IF EXISTS categorie_depenses;
DROP TABLE IF EXISTS aides_ponctuelles;
DROP TABLE IF EXISTS rachats_prets;
DROP TABLE IF EXISTS prets;
DROP TABLE IF EXISTS paiements_cotisations;
DROP TABLE IF EXISTS cotisations;
DROP TABLE IF EXISTS paiements;
DROP TABLE IF EXISTS adhesions;
DROP TABLE IF EXISTS contrats;
DROP TABLE IF EXISTS ayant_droits;
DROP TABLE IF EXISTS super_admins;
DROP TABLE IF EXISTS admins;
DROP TABLE IF EXISTS admin_role;
DROP TABLE IF EXISTS role_permission;
DROP TABLE IF EXISTS permissions;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS mutualistes;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS type_statuts;
*/

-- -------------------------------------------------------------
-- Table type_statuts
-- -------------------------------------------------------------
CREATE TABLE type_statuts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code_interne VARCHAR(50) NOT NULL UNIQUE,
    libelle VARCHAR(100) NOT NULL,
    description VARCHAR(255) NULL,
    contexte VARCHAR(100) NOT NULL,
    couleur_hex VARCHAR(7) NULL,
    ordre_affichage INT DEFAULT 0,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    UNIQUE KEY uk_code_contexte (code_interne, contexte)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table users
-- -------------------------------------------------------------
CREATE TABLE users (
    id VARCHAR(36) PRIMARY KEY,
    nom_utilisateur VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe_hache VARCHAR(255) NOT NULL,
    statut_id INT NOT NULL,
    date_creation DATETIME NOT NULL,
    derniere_connexion DATETIME NULL,
    date_mise_a_jour_mot_de_passe DATE NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (statut_id) REFERENCES type_statuts(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table admins
-- -------------------------------------------------------------
CREATE TABLE admins (
    id VARCHAR(36) PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    service VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




-- -------------------------------------------------------------
-- Table mutualistes
-- -------------------------------------------------------------
CREATE TABLE mutualistes (
    id VARCHAR(36) PRIMARY KEY,
    numero_adherent VARCHAR(255) NOT NULL UNIQUE,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    date_naissance DATE NOT NULL,
    lieu_naissance VARCHAR(255) NULL,
    sexe ENUM('H', 'F', 'Autre') NULL,
    adresse TEXT NULL,
    telephone VARCHAR(255) NULL,
    profession VARCHAR(255) NULL,
    statut_social VARCHAR(255) NULL,
    date_premiere_adhesion DATE NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table ayant_droits
-- -------------------------------------------------------------
CREATE TABLE ayant_droits (
    id VARCHAR(36) PRIMARY KEY,
    mutualiste_id VARCHAR(36) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    date_naissance DATE NOT NULL,
    lien_parente VARCHAR(255) NOT NULL,
    statut_id INT NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (mutualiste_id) REFERENCES mutualistes(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (statut_id) REFERENCES type_statuts(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




-- -------------------------------------------------------------
-- Table contrats
-- -------------------------------------------------------------
CREATE TABLE contrats (
    id VARCHAR(36) PRIMARY KEY,
    nom VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NULL,
    date_debut_validite DATE NOT NULL,
    date_fin_validite DATE NULL,
    montant_cotisation_base DECIMAL(10, 2) NOT NULL,
    periode_cotisation ENUM('Mensuel', 'Trimestriel', 'Annuel') NOT NULL,
    est_actif BOOLEAN NOT NULL DEFAULT TRUE,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table adhesions
-- -------------------------------------------------------------
CREATE TABLE adhesions (
    id VARCHAR(36) PRIMARY KEY,
    mutualiste_id VARCHAR(36) NOT NULL,
    contrat_id VARCHAR(36) NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NULL,
    statut_id INT NOT NULL,
    reference_externe VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (mutualiste_id) REFERENCES mutualistes(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (contrat_id) REFERENCES contrats(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (statut_id) REFERENCES type_statuts(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table cotisations
-- -------------------------------------------------------------
CREATE TABLE cotisations (
    id VARCHAR(36) PRIMARY KEY,
    adhesion_id VARCHAR(36) NOT NULL,
    periode_concerne VARCHAR(7) NOT NULL,
    montant_previste DECIMAL(10, 2) NOT NULL,
    montant_paye DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    date_limite_paiement DATE NOT NULL,
    date_paiement_effective DATE NULL,
    statut_id INT NOT NULL,
    reference_externe VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (adhesion_id) REFERENCES adhesions(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (statut_id) REFERENCES type_statuts(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table paiements
-- -------------------------------------------------------------
CREATE TABLE paiements (
    id VARCHAR(36) PRIMARY KEY,
    mutualiste_id VARCHAR(36) NOT NULL,
    date_paiement DATETIME NOT NULL,
    montant_recu DECIMAL(10, 2) NOT NULL,
    mode_paiement ENUM('Espèces', 'Virement Bancaire', 'Mobile Money', 'Chèque', 'Carte Bancaire', 'Autre') NOT NULL,
    reference_transaction_externe VARCHAR(255) NULL UNIQUE,
    statut_id INT NOT NULL,
    enregistre_par_utilisateur_id VARCHAR(36) NOT NULL, -- This is the user who recorded, distinct from created_by
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (mutualiste_id) REFERENCES mutualistes(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (statut_id) REFERENCES type_statuts(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (enregistre_par_utilisateur_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table paiements_cotisations
-- -------------------------------------------------------------
CREATE TABLE paiements_cotisations (
    paiement_id VARCHAR(36) NOT NULL,
    cotisation_id VARCHAR(36) NOT NULL,
    montant_applique DECIMAL(10, 2) NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    -- No created_by/updated_by here for simplicity on association table
    PRIMARY KEY (paiement_id, cotisation_id),
    FOREIGN KEY (paiement_id) REFERENCES paiements(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (cotisation_id) REFERENCES cotisations(id) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- -------------------------------------------------------------
-- Table aides
-- -------------------------------------------------------------
CREATE TABLE aides (
    id VARCHAR(36) PRIMARY KEY,
    mutualiste_id VARCHAR(36) NOT NULL,
    date_aide DATE NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    motif VARCHAR(255) NOT NULL,
    statut_id INT NOT NULL,
    verifiee_par_admin_id VARCHAR(36) NOT NULL, -- This is the admin who verified, distinct from created_by
    versee_par_admin_id VARCHAR(36) NULL, -- This is the admin who paid, distinct from updated_by if updated_by is the verifier/creator
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (mutualiste_id) REFERENCES mutualistes(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (statut_id) REFERENCES type_statuts(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (verifiee_par_admin_id) REFERENCES admins(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (versee_par_admin_id) REFERENCES admins(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table prestations
-- -------------------------------------------------------------
CREATE TABLE prestations (
    id VARCHAR(36) PRIMARY KEY,
    nom VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NULL,
    code_interne VARCHAR(255) NULL UNIQUE,
    montant_reference DECIMAL(10, 2) NULL,
    est_active BOOLEAN NOT NULL DEFAULT TRUE,
    categorie_prestation VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table prise_en_charges
-- -------------------------------------------------------------
CREATE TABLE prise_en_charges (
    id VARCHAR(36) PRIMARY KEY,
    reference VARCHAR(255) NOT NULL UNIQUE,
    date_soins_facture DATE NOT NULL,
    mutualiste_id VARCHAR(36) NOT NULL,
    ayant_droit_id VARCHAR(36) NULL,
    prestation_id VARCHAR(36) NOT NULL,
    adhesion_id VARCHAR(36) NOT NULL,
    montant_facture DECIMAL(10, 2) NOT NULL,
    montant_pris_en_charge DECIMAL(10, 2) NOT NULL,
    date_soumission DATETIME NOT NULL, -- Keep this specific date
    date_mise_a_jour_statut DATETIME NOT NULL, -- Keep this specific date for status changes
    statut_id INT NOT NULL,
    description TEXT NULL,
    soumise_par_utilisateur_id VARCHAR(36) NOT NULL, -- This is the user who submitted, distinct from created_by
    validee_par_admin_id VARCHAR(36) NULL, -- This is the admin who validated, distinct from updated_by if updated_by is the submitter/creator
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (mutualiste_id) REFERENCES mutualistes(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (ayant_droit_id) REFERENCES ayant_droits(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (prestation_id) REFERENCES prestations(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (adhesion_id) REFERENCES adhesions(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (statut_id) REFERENCES type_statuts(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (soumise_par_utilisateur_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (validee_par_admin_id) REFERENCES admins(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table liquidations
-- -------------------------------------------------------------
CREATE TABLE liquidations (
    id VARCHAR(36) PRIMARY KEY,
    prise_en_charge_id VARCHAR(36) NOT NULL UNIQUE,
    date_paiement DATE NOT NULL, -- Keep this specific date
    montant_paye DECIMAL(10, 2) NOT NULL,
    mode_paiement ENUM('Virement Bancaire', 'Chèque', 'Espèces Caisse', 'Autre') NOT NULL,
    reference_transaction VARCHAR(255) NULL,
    paye_par_admin_id VARCHAR(36) NOT NULL, -- This is the admin who paid, distinct from created_by
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (prise_en_charge_id) REFERENCES prise_en_charges(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (paye_par_admin_id) REFERENCES admins(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table materiels
-- -------------------------------------------------------------
CREATE TABLE materiels (
    id VARCHAR(36) PRIMARY KEY,
    reference_unique VARCHAR(255) NOT NULL UNIQUE,
    nom VARCHAR(255) NOT NULL,
    description TEXT NULL,
    type_materiel VARCHAR(255) NULL,
    statut_id INT NOT NULL,
    date_acquisition DATE NULL,
    valeur_acquisition DECIMAL(10, 2) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (statut_id) REFERENCES type_statuts(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table pret_materiels
-- -------------------------------------------------------------
CREATE TABLE pret_materiels (
    id VARCHAR(36) PRIMARY KEY,
    materiel_id VARCHAR(36) NOT NULL,
    mutualiste_id VARCHAR(36) NOT NULL,
    date_pret DATE NOT NULL, -- Keep this specific date
    date_retour_previe DATE NOT NULL, -- Keep this specific date
    date_retour_effective DATE NULL, -- Keep this specific date
    etat_initial TEXT NULL,
    etat_retour TEXT NULL,
    statut_id INT NOT NULL,
    enregistre_par_admin_id VARCHAR(36) NOT NULL, -- This is the admin who recorded the loan, distinct from created_by
    retour_enregistre_par_admin_id VARCHAR(36) NULL, -- This is the admin who recorded the return, distinct from updated_by if updated_by is the loan recorder/creator
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (materiel_id) REFERENCES materiels(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (mutualiste_id) REFERENCES mutualistes(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (statut_id) REFERENCES type_statuts(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (enregistre_par_admin_id) REFERENCES admins(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (retour_enregistre_par_admin_id) REFERENCES admins(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table reclamations
-- -------------------------------------------------------------
CREATE TABLE reclamations (
    id VARCHAR(36) PRIMARY KEY,
    reference VARCHAR(255) NOT NULL UNIQUE,
    mutualiste_id VARCHAR(36) NOT NULL,
    date_soumission DATETIME NOT NULL, -- Keep this specific date
    sujet VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    statut_id INT NOT NULL,
    date_mise_a_jour_statut DATETIME NOT NULL, -- Keep this specific date for status changes
    soumise_par_utilisateur_id VARCHAR(36) NOT NULL, -- This is the user who submitted, distinct from created_by
    assignee_a_admin_id VARCHAR(36) NULL, -- This is the admin responsible, distinct from updated_by if updated_by is the submitter/creator
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (mutualiste_id) REFERENCES mutualistes(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (statut_id) REFERENCES type_statuts(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (soumise_par_utilisateur_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (assignee_a_admin_id) REFERENCES admins(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table conversations
-- -------------------------------------------------------------
CREATE TABLE conversations (
    id VARCHAR(36) PRIMARY KEY,
    sujet VARCHAR(255) NOT NULL,
    date_creation DATETIME NOT NULL, -- Keep this specific date
    statut_id INT NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (statut_id) REFERENCES type_statuts(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table messages
-- -------------------------------------------------------------
CREATE TABLE messages (
    id VARCHAR(36) PRIMARY KEY,
    conversation_id VARCHAR(36) NOT NULL,
    utilisateur_id VARCHAR(36) NOT NULL, -- This is the sender, distinct from created_by
    date_envoi DATETIME NOT NULL, -- Keep this specific date
    contenu TEXT NOT NULL,
    est_lu BOOLEAN NOT NULL DEFAULT FALSE,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL, -- Will likely be same as utilisateur_id, but kept for consistency
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (conversation_id) REFERENCES conversations(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (utilisateur_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table conversation_participants
-- -------------------------------------------------------------
CREATE TABLE conversation_participants (
    conversation_id VARCHAR(36) NOT NULL,
    utilisateur_id VARCHAR(36) NOT NULL, -- This is the participant, distinct from created_by (who added them)
    date_jointure DATETIME NOT NULL, -- Keep this specific date
    est_actif BOOLEAN NOT NULL DEFAULT TRUE, -- Could potentially use statut_id here if states are complex
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL, -- User who added the participant
    updated_by_user_id VARCHAR(36) NULL,
    PRIMARY KEY (conversation_id, utilisateur_id),
    FOREIGN KEY (conversation_id) REFERENCES conversations(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (utilisateur_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table notifications
-- -------------------------------------------------------------
CREATE TABLE notifications (
    id VARCHAR(36) PRIMARY KEY,
    utilisateur_id VARCHAR(36) NOT NULL, -- This is the recipient, distinct from created_by (who triggered it)
    date_generation DATETIME NOT NULL, -- Keep this specific date
    type_notification VARCHAR(255) NOT NULL, -- Could be a lookup table
    titre VARCHAR(255) NOT NULL,
    contenu TEXT NULL,
    est_lue BOOLEAN NOT NULL DEFAULT FALSE,
    date_lecture DATETIME NULL,
    lien_cible VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL, -- User/System who triggered the notification
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table categorie_depenses
-- -------------------------------------------------------------
CREATE TABLE categorie_depenses (
    id VARCHAR(36) PRIMARY KEY,
    nom VARCHAR(255) NOT NULL UNIQUE,
    description VARCHAR(255) NULL,
    est_active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table depense_fonctionnements
-- -------------------------------------------------------------
CREATE TABLE depense_fonctionnements (
    id VARCHAR(36) PRIMARY KEY,
    reference VARCHAR(255) NOT NULL UNIQUE,
    date_depense DATE NOT NULL, -- Keep this specific date
    montant DECIMAL(10, 2) NOT NULL,
    beneficiaire VARCHAR(255) NOT NULL,
    categorie_depense_id VARCHAR(36) NOT NULL,
    description TEXT NULL,
    mode_paiement VARCHAR(255) NULL, -- Could be a lookup table or ENUM if fixed
    date_enregistrement DATETIME NOT NULL, -- Keep this specific date
    enregistre_par_admin_id VARCHAR(36) NOT NULL, -- This is the admin who recorded, distinct from created_by
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL, -- Will likely be same as enregistre_par_admin_id, but kept for consistency
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (categorie_depense_id) REFERENCES categorie_depenses(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (enregistre_par_admin_id) REFERENCES admins(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- -------------------------------------------------------------
-- Table caisses (Corrigée pour utiliser UUID)
-- -------------------------------------------------------------
CREATE TABLE caisses (
    id VARCHAR(36) PRIMARY KEY, -- Corrigé de INT AUTO_INCREMENT à VARCHAR(36)
    nom VARCHAR(255) NOT NULL UNIQUE,
    description VARCHAR(255) NULL,
    devise VARCHAR(3) NOT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table mouvements_caisse (Corrigée pour référencer la caisse en UUID)
-- -------------------------------------------------------------
CREATE TABLE mouvements_caisse (
    id VARCHAR(36) PRIMARY KEY,
    caisse_id VARCHAR(36) NOT NULL, -- Corrigé de INT à VARCHAR(36)
    date_heure_mouvement DATETIME NOT NULL,
    type_mouvement ENUM('ENTREE', 'SORTIE') NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    source_motif VARCHAR(255) NOT NULL,
    description TEXT NULL,
    enregistre_par_admin_id VARCHAR(36) NOT NULL,
    date_enregistrement DATETIME NOT NULL,
    depense_fonctionnement_id VARCHAR(36) NULL,
    paiement_id VARCHAR(36) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (caisse_id) REFERENCES caisses(id) ON DELETE RESTRICT ON UPDATE CASCADE, -- Référence maintenant VARCHAR(36)
    FOREIGN KEY (enregistre_par_admin_id) REFERENCES admins(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (depense_fonctionnement_id) REFERENCES depenses_fonctionnement(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (paiement_id) REFERENCES paiements(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table rapports (Corrigée pour utiliser UUID)
-- -------------------------------------------------------------
CREATE TABLE rapports (
    id VARCHAR(36) PRIMARY KEY, -- Corrigé de INT AUTO_INCREMENT à VARCHAR(36)
    nom VARCHAR(255) NOT NULL UNIQUE,
    description VARCHAR(255) NULL,
    type_rapport ENUM('PARAMETRABLE', 'STATIQUE', 'DYNAMIQUE') NOT NULL,
    configuration_generation TEXT NULL,
    chemin_fichier_statique VARCHAR(255) NULL,
    est_actif BOOLEAN NOT NULL DEFAULT TRUE,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table sauvegardes_db (Pas de changement d'ID)
-- -------------------------------------------------------------
CREATE TABLE sauvegardes_db (
    id VARCHAR(36) PRIMARY KEY,
    date_heure_debut DATETIME NOT NULL,
    date_heure_fin DATETIME NULL,
    statut ENUM('EN_COURS', 'SUCCES', 'ECHEC', 'ANNULE') NOT NULL,
    taille_fichier DECIMAL(15, 2) NULL,
    chemin_fichier VARCHAR(255) NULL,
    type_sauvegarde ENUM('COMPLETE', 'INCREMENTALE', 'DIFFERENTIELLE') NOT NULL,
    utilisateur_id VARCHAR(36) NULL,
    message_erreur TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES users(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- -------------------------------------------------------------
-- Table restaurations_db (Pas de changement d'ID)
-- -------------------------------------------------------------
CREATE TABLE restaurations_db (
    id VARCHAR(36) PRIMARY KEY,
    date_heure_debut DATETIME NOT NULL,
    date_heure_fin DATETIME NULL,
    statut ENUM('EN_COURS', 'SUCCES', 'ECHEC', 'ANNULE') NOT NULL,
    fichier_sauvegarde_source VARCHAR(255) NOT NULL,
    utilisateur_id VARCHAR(36) NOT NULL,
    message_erreur TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    created_by_user_id VARCHAR(36) NULL,
    updated_by_user_id VARCHAR(36) NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES users(id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (created_by_user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (updated_by_user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SET FOREIGN_KEY_CHECKS=1; -- Réactiver les vérifications de clés étrangères
