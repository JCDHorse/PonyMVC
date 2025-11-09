# Lancer le projet avec Docker

Prérequis : Docker et docker-compose installés.

Démarrer les services :

```bash
docker compose up --build -d
```

Accéder à l'application : http://localhost:8080

Se connecter à la base MariaDB depuis le host :
- host: 127.0.0.1
- port: 3306
- user: pony
- password: ponypass
- database: ponymvc

Arrêter et supprimer :

```bash
docker compose down -v
```

