php artisan optimize
php atisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan serve


$ php artisan make:factory CategoryFactory
 public function definition(): array
    {
        return [
            'name' =>fake()->name()
        ];
    }
DatabaseSeeder
  \App\Models\Category::factory(10)->create();

php artisan db:seed

composer require barryvdh/laravel-debugbar --dev