De ce qui ressort de nos cas d'utilisation, voici les entités centrales qui manipulent des données et représenter des concepts clés de la mutuelle :

1.  **Utilisateur :** Concept général pour toute personne accédant au système.
    **Relations:**
    -   **mutualiste**: Un utilisateur peut etre un mutualiste
    -   **admin**: Un utilisateur peut etre une admin
    -   **superadmin**: Un utilisateur peut etre un super admin
2.  **Mutualiste :** Un type spécifique d'utilisateur (l'adhérent).
    **Relations**:

    -   **contract**: Un mutualiste peut avoir plusieurs contract d'adhesion.

3.  **admin :** Un autre type spécifique d'utilisateur (le personnel de la mutuelle).
4.  **Ayant Droit :** Personne rattachée à un mutualiste et bénéficiant potentiellement de services.
5.  **Contrat :** Un modèle de contrat d'adhésion définissant les garanties et règles (UC 36).
6.  **Prestation :** Un type de service ou de soin couvert par la mutuelle (UC 36).
7.  **Adhésion :** Représente l'instance de l'adhésion d'un mutualiste à un contrat spécifique pour une période donnée. (Bien que pas un UC dédié, ce concept semble nécessaire pour lier un mutualiste à son contrat _actuel_ et gérer l'historique).
8.  **Cotisation :** Une échéance de paiement due par un mutualiste dans le cadre de son adhésion/contrat.
9.  **Paiement :** Un enregistrement d'un encaissement réel reçu d'un mutualiste, pouvant couvrir plusieurs cotisations.
10. **Prêt :** Un prêt financier accordé à un mutualiste.
11. **Rachat Prêt :** Un dossier de rachat de prêt externe pour un mutualiste.
12. **Allocation:** Une aide financière spécifique accordée à un mutualiste en dehors des prestations ou prêts standard.
13. **Prise en Charge :** Une demande ou un dossier de remboursement/couverture pour une prestation spécifique, soumise par un mutualiste ou un ayant droit.
14. **Liquidation :** Le processus ou l'enregistrement du paiement effectué par la mutuelle pour une prise en charge.
15. **Matériel :** Un bien physique appartenant à la mutuelle et pouvant être prêté.
16. **Prêt Matériel :** L'enregistrement d'un prêt spécifique d'un matériel à un mutualiste.
17. **Réclamation :** Une demande formelle ou une plainte soumise par un mutualiste.
18. **Conversation :** Un fil de discussion dans la messagerie interne, impliquant un mutualiste et un(des) admin(s).
19. **Message :** Un message individuel envoyé dans une conversation interne.
20. **Notification :** Une alerte ou information générée par le système pour un utilisateur spécifique.
21. **Dépense Fonctionnement :** Une dépense opérationnelle interne de la mutuelle.
22. **Catégorie Dépense :** Classification des dépenses de fonctionnement.
23. **Caisse :** Représente une caisse physique gérée pour les transactions en espèces.
24. **Mouvement Caisse :** Une entrée ou une sortie d'argent enregistrée pour une caisse physique.
25. **Rôle :** Définit un ensemble de permissions pour les admins.
26. **Permission :** Une action spécifique autorisée dans le système.
27. **Log Activité :** Enregistrement d'une action traçable effectuée dans le système.
28. **Groupe Mutualiste :** Une categorie de mutualiste. Elle definit.
29. **Poste Responsabilite:** Un poste de responsibilite dans une entreprise.
30. **Profession**: Une liste des professions disponible prise en compte dans le systeme.

Ces classes représentent les concepts clés que le système gère et manipule. Pour le diagramme conceptuel, nous nous concentrerons sur ces entités et leurs relations principales, sans nous attarder sur les attributs.
