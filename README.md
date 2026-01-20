# Module Rating
Modulo dedicato alla gestione delle valutazioni

## Aggiungere Modulo nella base del progetto
Dentro la cartella laravel/Modules

```bash
git submodule add https://github.com/laraxot/module_rating_fila3.git Rating
```

## Verificare che il modulo sia attivo
```bash
php artisan module:list
```
in caso abilitarlo
```bash
php artisan module:enable Rating
```

## Eseguire le migrazioni
```bash
php artisan module:migrate Rating
```
