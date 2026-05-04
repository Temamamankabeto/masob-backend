# eService route cleanup

This branch uses only Laravel's main API route registration in `bootstrap/app.php`.

Active API route file:

- `routes/api.php`

`routes/api.php` loads only:

- `routes/auth.php`
- `routes/admin.php`

Restaurant route files such as `public.php`, `waiter.php`, `cashier.php`, `kitchen.php`, `barman.php`, `finance.php`, and `foodcontroller.php` must not be loaded in Phase 1.
