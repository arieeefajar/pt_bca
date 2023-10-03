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

- Setup env
```bash
  add the code to the bottom line of the env
  PYTHON_END_POINT = "end point api py"
```

- Migrate and seeder
```bash
  php artisan migrate
  php artisan gb:seed --class=DatabaseSeeder
```

- Run project
```bash
  php artisan serve 
```
    
