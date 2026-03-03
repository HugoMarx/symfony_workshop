# Formation Symfony : ROADMAP

Objectif : construire une application de ticketing fonctionnelle tout en comprenant l’architecture moderne de Symfony.

---

# 📅 Jour 1 – De zéro à un CRUD fonctionnel

---

# 🟢 Bloc 1 — Initialisation & Modélisation

## 🎯 Objectif

Mettre en place le projet et modéliser le domaine métier.

---

## ✅ TODO

* [ ] Créer un nouveau projet Symfony 7
* [ ] Configurer la base de données
* [ ] Vérifier le Web Profiler
* [ ] Installer Doctrine
* [ ] Créer les entités :

  * [ ] `User`
  * [ ] `Ticket`
  * [ ] `TicketStatus`
* [ ] Configurer les relations entre entités
* [ ] Générer une migration
* [ ] Exécuter la migration
* [ ] Créer des fixtures avec FakerPhp
---

## 🧠 Concepts abordés

* Structure d’un projet Symfony
* `.env` et configuration
* Doctrine ORM
* Relations `ManyToOne` / `OneToMany`
* Typage PHP strict
* Migrations & versionnement de schéma
* Autowiring & container de services (intro)

---

## 🚀 Challenge bonus

👉 Ajouter un champ `priority` (low / medium / high) sur `Ticket` :

* Implémenter proprement le champ
* Mettre une valeur par défaut
* Générer la migration associée
* Vérifier la cohérence en base

---

# 🟢 Bloc 2 — Premier CRUD complet

## 🎯 Objectif

Créer une fonctionnalité complète : affichage, création et modification d’un ticket.

---

## ✅ TODO

* [ ] Créer un `TicketController`
* [ ] Mettre en place les routes :

  * [ ] index
  * [ ] show
  * [ ] create
  * [ ] edit
* [ ] Créer un `FormType`
* [ ] Implémenter la création d’un ticket
* [ ] Implémenter la modification
* [ ] Implémenter la suppression
* [ ] Créer les templates Twig associés
* [ ] Ajouter des redirections après soumission

---

## 🧠 Concepts abordés

* Routing
* Controller & injection de dépendances
* ParamConverter
* Form component
* Data binding formulaire ↔ entité
* Protection CSRF automatique
* Pattern Post/Redirect/Get
* Twig (bases)

---

## 🚀 Challenge bonus

👉 Ajouter un filtre dans la page `index` pour afficher uniquement :

* Les tickets ouverts
* Les tickets par priorité
* Les tickets d’un utilisateur spécifique

Bonus : utiliser un `QueryBuilder` personnalisé.

---

# 📅 Jour 2 – Sécurité, architecture & bonnes pratiques

---

# 🔐 Bloc 3 — Authentification & Sécurité

## 🎯 Objectif

Mettre en place un système d’authentification sécurisé.

---

## ✅ TODO

* [ ] Générer l’entité `User` sécurisée
* [ ] Configurer l’authentification (login/logout)
* [ ] Hasher les mots de passe
* [ ] Protéger les routes sensibles
* [ ] Ajouter des rôles (`ROLE_USER`, `ROLE_ADMIN`)
* [ ] Restreindre l’accès à certaines actions
* [ ] Vérifier le fonctionnement du token CSRF

---

## 🧠 Concepts abordés

* Firewall
* Provider
* Password hasher
* Rôles & hiérarchie
* `isGranted()`
* Sécurité dans Twig
* Protection CSRF

---

## 🚀 Challenge bonus

👉 Implémenter la règle suivante :

* Un utilisateur ne peut modifier QUE ses propres tickets.
* Un admin peut modifier tous les tickets.

(À implémenter sans mettre de `if` métier dans Twig.)

---

# 🧩 Bloc 4 — Architecture propre & Règles métier

## 🎯 Objectif

Refactorer pour obtenir une architecture propre et maintenable.

---

## ✅ TODO

* [ ] Ajouter des contraintes de validation sur `Ticket`
* [ ] Personnaliser les messages d’erreur
* [ ] Extraire la logique métier dans un service `TicketManager`
* [ ] Refactorer les controllers
* [ ] Ajouter des méthodes personnalisées dans `TicketRepository`
* [ ] Implémenter une logique métier centralisée

---

## 🧠 Concepts abordés

* Validation (Assert)
* Séparation des responsabilités
* Services Symfony
* Single Responsibility Principle
* Repository pattern
* Injection de dépendances avancée

---

## 🚀 Challenge bonus

👉 Ajouter la règle métier suivante :

* Un ticket fermé ne peut plus être modifié.
* Toute tentative doit lever une exception métier claire.

Bonus : gérer cela dans le service et non dans le controller.

---

# ⚡ Bloc 5 — UX & Concepts avancés

## 🎯 Objectif

Découvrir des outils avancés et moderniser l’application.

---

## ✅ TODO

* [ ] Mettre en place AssetMapper
* [ ] Ajouter un petit comportement dynamique (ex : changement visuel selon le statut)
* [ ] Créer une extension Twig personnalisée
* [ ] Implémenter un `EventSubscriber`
* [ ] Créer un `Voter` pour gérer les permissions fines
* [ ] Écrire un test unitaire simple pour un service

---

## 🧠 Concepts abordés

* AssetMapper
* Stimulus (intro)
* Extensions Twig
* EventDispatcher
* EventSubscriber
* Voters
* Tests unitaires avec PHPUnit

---

## 🚀 Challenge bonus

👉 À la fermeture d’un ticket :

* Déclencher un Event
* Logger l’action
* Simuler l’envoi d’un email
* Tester le service associé


