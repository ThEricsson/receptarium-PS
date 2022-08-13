# About

Receptarium es un proyecto desarrollado con Laravel y algo de Vue, el objetivo de este proyecto es crear una red social en la cual los usuarios pueden explorar recetas creadas por otros usuarios sin necesidad de registrarse.

Pero si este decide crearse una cuenta, podrá crear sus propias recetas y compartirlas con los otros usuarios, junto a otras funcionalidades, así como guardarse sus recetas favoritas, interactuar con otros usuarios dándole like a sus posts o comentando.

Otra funcionalidad muy potente de este proyecto es el sistema de búsqueda, este se puede combinar tanto como gustes, filtrando las publicaciones por nombre, más populares, etc...

Todo esto se puede ver de forma más detallada en el apartado de capturas.

## Development server

Run `php artisan serve` for a dev server. Navigate to `http://localhost:8000/`.

## Screenshots

Algunas capturas de muestra del funcionamiento de forma detallada.

### Pantalla principal / busqueda

En la página principal te encontrarás los últimos posts o recetas publicadas, aquí también puedes filtrar gracias a la barra de búsqueda, con esta podrás filtrar por nombre, tipos de platos (entrante, principal o postre), dificultad y buscar por mejores valorados o últimos publicados, todo esto obviamente combinable.

![imagen](https://user-images.githubusercontent.com/56220682/184483467-b5a8175d-6b17-459b-b9c4-bc9a3078acb0.png)

#### Flitrado por nombre

![imagen](https://user-images.githubusercontent.com/56220682/184488164-0b94a73d-b50a-4edf-803b-6bca44915b5f.png)

### Visitar perfil

En caso de que te guste un perfil podrás visitarlo para ver todas sus recetas junto a todos los likes y favoritos que ha recibido.

![imagen](https://user-images.githubusercontent.com/56220682/184487633-583255cc-8c67-4a1b-8d09-ec37a21245c1.png)

### Crear perfil

Formulario de creación de perfil.

![imagen](https://user-images.githubusercontent.com/56220682/184491565-57f6f105-b1de-42d1-ace5-d97a9553dbaf.png)

## Crear receta

Para crear una receta tienes que hacer clic en el icono "+" al lado izquierdo de tu perfil, a continuación te redireccionara la a página de creación de recetas, aquí simplemente rellenas el formulario con la información.

![imagen](https://user-images.githubusercontent.com/56220682/184493235-bc424915-4f6d-4811-87bb-302974c38c25.png)

Como podemos ver, el formulario es dinámico, la cantidad de ingredientes y pasos los elige el usuario, eso es gracias a vue.

![imagen](https://user-images.githubusercontent.com/56220682/184493746-fd9326dd-ca9f-4500-9610-dbd98397a71b.png)

Receta creada en la página principal:

![imagen](https://user-images.githubusercontent.com/56220682/184493878-f0b83055-2044-46f4-b054-6e7b960cbe80.png)

### Visualizar receta

Si hacemos clic encima de una receta, la web redirecciona a la página de detalle de esta, aquí podemos ver la descripción, ingredientes y pasos de la receta.

![imagen](https://user-images.githubusercontent.com/56220682/184494055-f9a5cd38-a5de-4393-9af7-9e8e72d385fa.png)

#### Más información de la receta

![imagen](https://user-images.githubusercontent.com/56220682/184494107-1bda4312-d81a-4807-903e-5314351fffeb.png)

### Comentarios

![imagen](https://user-images.githubusercontent.com/56220682/184494200-1041af3f-652c-4ac2-85ce-d7886f8be2a2.png)

### Favoritos

Como usuario registrado puedes guardarte tus recetas favoritas dando clic a la estrella de los posts, para poder ver tus recetas favoritas en el buscador aparecerá el botón de búsqueda de favoritos.

![imagen](https://user-images.githubusercontent.com/56220682/184494261-4da2e09e-f539-4f4d-b879-b9dbb998d29c.png)

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
