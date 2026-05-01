# Deploy Railway

Questa versione è pronta per Railway e usa il server PHP integrato, quindi non avvia Apache e non può generare l'errore `More than one MPM loaded`.

## Variabili Railway richieste
Nel servizio dell'app aggiungi:

```env
MYSQLHOST=mysql.railway.internal
MYSQLPORT=3306
MYSQLUSER=root
MYSQLPASSWORD=LA_TUA_PASSWORD
MYSQLDATABASE=railway
```

## Start
Railway userà automaticamente il Dockerfile. In caso serva, lo start command è:

```bash
php -S 0.0.0.0:$PORT -t /app
```

## Nota GitHub
Carica i file nella root della repo, non dentro una sottocartella.
