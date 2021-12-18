# Modu, es la modularización inicial de un sistema
La modularización cuenta con la siguiente estructura
### Modulos
Son los modulos principales del sistema.
### Areas
Las areas hacen parte de los modulos, y son esas partes mas pequeñas en la estructura del sistema.
### Roles
Los roles son asignados a los usuarios, y tienen permisos asignados a los modulos.
### Tipo de roles
Los roles se pueden categorizar por tipos, de acuerdo a su necesidad.
### Permisos
Los permisos son asignados a los usurios, de acuerdo a las areas que desea asignar.
### Usuarios
Los usuarios padrean tener asignados roles por tipo y modulos, y de acuerdo a los modulos permisos
a las areas.
# Instalación
Este paquete necesita tambien la instlación de [Laravel Passport](https://laravel.com/docs/8.x/passport).
```
composer require ricardocrem20/modu
```
# Configuración
1. Ve a la el directorio 'app/Providers/AuthServiceProvider.php' y en la función 'boot' defina el siguiente 'Gate'
```
use App\Models\User;

public function boot()
{
    $this->registerPolicies();

    if (!$this->app->routesAreCached()) {
        Passport::routes();
    }
    
    Gate::define('tieneAcceso', function ($user, $permiso) {
        return $user->tienePermiso($permiso, $user->id);
    });
}
```
2. Ve a la siguiente migración 'database/migrations/####_##_##_create_users_table.php' y debe quedar asi:
```
public function up()
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->enum('tipo_identificacion', ['CC',  'TI'])->nullable();
        $table->string('identificacion', 15)->unique()->nullable();
        $table->string('nombre', 90);
        $table->string('nombres', 45)->nullable();
        $table->string('apellidos', 45)->nullable();
        $table->string('email', 60)->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->string('foto_perfil')
            ->default('http://modu.test/storage/img/perfiles/default.png');
        $table->rememberToken();
        $table->timestamps();
    });
}
```
3. En el siguiente directorio 'app/Models/User.php' agrege
```
use Ricardo\Modu\Traits\UserTrait;
```
```
class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable, UserTrait;
}
```
4. Ejecute las migraciones con sus siembras
```
php artisan migrate --seed
o
php artisan migrate:fres --seed
```
En la base de datos, debe de averce creado datos, y un usuario que es el siguiente
```
user: ricardo@app.io
password: password 
```
5. Ejecute el Passport Laravel y publique el storage
```
php artisan passport:install
```
```
php artisan storage:link
```
Si te jala algun error no olvides ejecutar
```
php artisan optimize
```
# Implementación
En cada función del controlador que necesites darle algun permiso agrege lo siguiente
```
Gate::authorize('tieneAcceso', 'slug_del_permiso');
```
Las rutas deben de estar dentro de
```
Route::group(['middleware' => 'auth:api'], function() {
  // Routes
}
```
# Licencia
La licencia del MIT (MIT). Consulte [Archivo de licencia](https://github.com/ricardocrem20/modu/blob/main/LICENSE) para obtener más información.
