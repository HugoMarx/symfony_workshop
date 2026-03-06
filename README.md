# Formation Symfony : ROADMAP

> Objectif : construire une application de ticketing propre, sécurisée et bien architecturée.

---

# 📅 Jour 1 — Fondations & CRUD

---

## 🟢 Bloc 1 — Setup & Modélisation

### 🎯 Objectif

Poser les bases du projet et modéliser le domaine.

### ✅ À faire

* Initialiser un projet Symfony 7
* Configurer la base de données
* Installer Doctrine
* Créer les entités :

  * `User`
  * `Ticket`
  * `TicketStatus`
* Mettre en place les relations
* Générer et exécuter les migrations

### 🧠 Concepts

* Structure d’un projet Symfony
* Doctrine ORM
* Relations entre entités
* Migrations
* Autowiring (intro)

### 🚀 Challenge

Ajouter une notion de **priorité** sur les tickets avec valeur par défaut cohérente.

---

## 🟢 Bloc 2 — CRUD Ticket

### 🎯 Objectif

Construire une feature complète.

### ✅ À faire

* Créer un `TicketController`
* Implémenter :

  * index
  * show
  * create
  * edit
  * delete
* Créer un `FormType`
* Mettre en place les templates Twig

### 🧠 Concepts

* Routing
* Injection de dépendances
* Form component
* Data binding
* CSRF
* Twig

### 🚀 Challenge

Implémenter un système de filtre sur la liste des tickets
(ex : par statut ou priorité).

---

# 📅 Jour 2 — Sécurité & Architecture

---

## 🔐 Bloc 3 — Authentification & Permissions

### 🎯 Objectif

Sécuriser l’application.

### ✅ À faire

* Mettre en place l’authentification
* Gérer les rôles (`ROLE_USER`, `ROLE_ADMIN`)
* Protéger les routes sensibles
* Restreindre certaines actions

### 🧠 Concepts

* Firewall
* Provider
* Password hasher
* isGranted()
* CSRF


---

## 🧩 Bloc 4 — Architecture & Logique métier

### 🎯 Objectif

Rendre l’application maintenable.

### ✅ À faire

* Ajouter des contraintes de validation
* Extraire la logique métier dans un service
* Ajouter des méthodes personnalisées dans le repository
* Refactorer les controllers

### 🧠 Concepts

* Validation
* Services
* Repository pattern
* Séparation des responsabilités

### 🚀 Challenge

Empêcher toute modification d’un ticket fermé
→ Implémentation propre (pas de logique métier dans Twig).

---

## ⚡ Bloc 5 — Concepts avancés

### 🎯 Objectif

Introduire des outils avancés de Symfony.

### ✅ À faire

* Implémenter un `EventSubscriber`
* Créer un `Voter`
* Ajouter un comportement UX simple
* Écrire un test unitaire

### 🧠 Concepts

* EventDispatcher
* Voters
* AssetMapper
* Tests unitaires

### 🚀 Challenges

- Un utilisateur ne peut modifier que ses propres tickets.
Un admin peut tout modifier.

- Déclencher un événement à la fermeture d’un ticket
et tester la logique associée.
