# Market Mboa

**Market Mboa** est une plateforme e-commerce multi-vendeurs (marketplace) destinée au marché camerounais, accessible à l'adresse [marketmboa.com](https://marketmboa.com). Le projet permet à des vendeurs indépendants de créer leur boutique en ligne et de vendre leurs produits à des acheteurs à travers le Cameroun, avec paiement, livraison et commande via WhatsApp intégrés.

- 🌍 **Site en production** : https://marketmboa.com
- 📍 **Localisation** : PK 14, Douala, Cameroun
- 📞 **Contact** : +237 696 47 29 43
- ✉️ **Email** : contact@genius-s.site
- 🏢 **Exploité par** : Genius Startup

---

## Sommaire

- [Aperçu](#aperçu)
- [Stack technique](#stack-technique)
- [Fonctionnalités](#fonctionnalités)
- [Structure du projet](#structure-du-projet)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Base de données](#base-de-données)
- [Rôles & espaces](#rôles--espaces)
- [Commande via WhatsApp](#commande-via-whatsapp)
- [Déploiement](#déploiement)
- [Contribution](#contribution)
- [Licence](#licence)
- [Contact](#contact)

---

## Aperçu

Market Mboa est bâtie sur la solution marketplace **6valley**, adaptée et personnalisée pour le contexte camerounais :

- Devise principale : **XAF (Franc CFA)**
- Langues : Français (par défaut), Anglais
- Paiement : Mobile Money (MTN MoMo / Orange Money via Campay), paiement à la livraison, et autres passerelles configurables
- Livraison : gestion des frais par vendeur, par catégorie, ou par zone
- Commande rapide : bouton **"Discuter sur WhatsApp"** disponible sur tout le site

## Stack technique

| Composant | Technologie |
|---|---|
| Backend | PHP / Laravel |
| Base de données | MySQL 8 |
| Frontend | Blade, Bootstrap, jQuery |
| Panels | Admin, Vendeur (Seller), Livreur (Delivery Man), Client |
| Paiement | Campay (Mobile Money CM), Paystack, Flutterwave, autres passerelles 6valley |
| Notifications | Firebase (push), Email (SMTP), WhatsApp (lien direct `wa.me`) |
| Stockage | Local (`storage/app/public`) ou distant configurable |

## Fonctionnalités

- 🛍️ Marketplace multi-vendeurs (boutiques indépendantes avec page dédiée `shopView`)
- 🗂️ Catégories, sous-catégories et sous-sous-catégories
- 🏷️ Marques (brands) avec pages dédiées
- ⚡ Offres flash (Flash Deals) et deals du jour
- ⭐ Produits vedettes, meilleures ventes, mieux notés, derniers arrivages
- 🎟️ Coupons de réduction
- 💬 Chat intégré client ↔ vendeur ↔ admin
- 📦 Suivi de commande public (`/track-order`)
- ❤️ Liste de souhaits (wishlist)
- 🌐 Multi-langue et multi-devise
- 📱 Bouton de commande directe via **WhatsApp**
- 🧾 Pages légales : À propos, CGU, Politique de confidentialité, Politique de remboursement
- 📰 Blog intégré

## Structure du projet

```
market-mboa/
├── app/
│   ├── Http/Controllers/       # Web, Admin, Vendor, Api
│   ├── Models/                 # Product, Order, Cart, Seller, Category...
│   └── Utils/                  # CartManager, helpers métier
├── resources/
│   └── views/
│       ├── web-view/           # Vues front-end client (blade)
│       ├── admin-views/        # Panel admin
│       └── vendor-views/       # Panel vendeur
├── routes/
│   ├── web.php
│   ├── admin.php
│   └── vendor.php
├── database/
│   └── migrations/
├── public/
│   └── assets/front-end/       # CSS, JS, images du thème
└── storage/app/public/         # Images produits, bannières, logos
```

## Prérequis

- PHP >= 8.1
- Composer
- MySQL >= 8.0
- Node.js & NPM (build des assets)
- Extension PHP : `mbstring`, `openssl`, `pdo`, `gd`, `curl`, `zip`

## Installation

```bash
# 1. Cloner le dépôt
git clone <url-du-depot> market-mboa
cd market-mboa

# 2. Installer les dépendances PHP
composer install

# 3. Copier le fichier d'environnement
cp .env.example .env
php artisan key:generate

# 4. Configurer la base de données dans .env
# DB_DATABASE=market_mboa
# DB_USERNAME=...
# DB_PASSWORD=...

# 5. Lancer les migrations et le seed
php artisan migrate --seed

# 6. Lier le stockage public
php artisan storage:link

# 7. Installer et compiler les assets front-end
npm install
npm run build

# 8. Lancer le serveur local
php artisan serve
```

## Configuration

Les réglages principaux (nom de la boutique, devise, méthode de livraison, réseaux sociaux, WhatsApp, etc.) sont gérés depuis le **panel admin** via la table `business_settings`, et non en dur dans le code. Les points clés à vérifier après installation :

- `system_default_currency` → XAF
- `shipping_method` → `inhouse_shipping`
- `whatsapp` → numéro de contact affiché en flottant sur le site
- `country_code` → CM
- Passerelle de paiement Mobile Money (Campay) à activer dans **Admin → Business Settings → Payment Methods**

## Base de données

Le projet utilise une base MySQL structurée autour des tables principales :

- `products`, `categories`, `brands` — catalogue
- `carts`, `cart_shippings` — panier et frais de livraison
- `orders`, `order_details` — commandes
- `sellers`, `admins`, `customers`, `delivery_men` — utilisateurs
- `business_settings`, `addon_settings` — configuration dynamique (paiement, SMS, apparence)
- `coupons`, `flash_deals` — promotions

## Rôles & espaces

| Espace | URL | Description |
|---|---|---|
| Client | `/` | Navigation, achat, suivi de commande |
| Connexion client | `/customer/auth/login` | |
| Inscription vendeur | `/vendor/auth/registration/index` | Devenir vendeur |
| Connexion vendeur | `/vendor/auth/login` | Gestion boutique, produits, commandes |
| Administration | `/admin` | Gestion globale de la marketplace |

## Commande via WhatsApp

Le site propose un widget flottant **"Discuter avec nous sur WhatsApp"** pointant vers le numéro officiel, ainsi qu'un mécanisme de commande directe :

- Un client peut initier une commande qui génère un **numéro de commande unique**, enregistré en base avec un statut dédié (`pending`, `contacted`, `confirmed`…).
- Si le panier contient des produits d'un **seul vendeur**, le message est adressé au **numéro WhatsApp du vendeur**.
- Si le panier contient des produits de **plusieurs vendeurs différents**, la commande est automatiquement redirigée vers le **numéro WhatsApp de l'administrateur**, qui centralise et redispatch la commande.
- Le message pré-rempli envoyé sur WhatsApp contient : le numéro de commande, la liste des articles, les quantités, le sous-total, les frais de livraison et le total.

> 📌 Détails d'implémentation (migration, contrôleur, génération du lien `wa.me`) disponibles dans la documentation technique interne du projet.

## Déploiement

Le site de production tourne sur **marketmboa.com**. Avant tout déploiement :

1. `php artisan config:cache && php artisan route:cache`
2. `npm run build`
3. Vérifier les migrations en attente (`php artisan migrate --pretend`)
4. Sauvegarder la base de données avant toute migration destructive

## Contribution

1. Créer une branche depuis `main` : `git checkout -b feature/nom-de-la-fonctionnalite`
2. Commit avec des messages clairs
3. Ouvrir une Pull Request avec description du changement et captures d'écran si UI

## Licence

Projet propriétaire — © 2026 **Genius Startup**. Tous droits réservés. Toute reproduction ou distribution sans autorisation est interdite.

## Contact

- 🌐 [marketmboa.com](https://marketmboa.com)
- 📞 [+237 696 47 29 43](tel:+237696472943)
- ✉️ contact@genius-s.site
- 📘 [Page Facebook](https://web.facebook.com/profile.php?id=100088954959608)
- 📍 PK 14, Douala, Cameroun
