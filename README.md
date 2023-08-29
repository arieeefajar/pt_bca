## Requirement

- PHP >= 8.1.0
- Composer

## Development

- Clone project
```bash
  git clone https://github.com/arieeefajar/pt_bca.git
```

- Setup .env
```bash
  copy env.example
  rename env.example to .env
  set database name, username and password
```

- Composer
```bash
  composer Install
```

- Generate key
```bash
  php artisan key:generate  
```

- Migrate and seeder
```bash
  php artisan Migrate
  php artisan gb:seed --class=DatabaseSeeder
```

- Run project
```bash
  php artisan serve 
```
    