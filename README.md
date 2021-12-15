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
# Licencia
La licencia del MIT (MIT). Consulte [Archivo de licencia](https://github.com/ricardocrem20/modu/blob/main/LICENSE) para obtener más información.
