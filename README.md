# Backend-posts-php (authentication version)
### ***Por: Santiago Ochoa Montoya - PREELEC2202PC-TDS0032-F30 - Opción 2***  
##### ***(Código fuente ubicado en la rama "master")***  

##### ______________________________________________________________________________________________________________________________________________
***1. CategoryController:***
  
* GET: /api/category/list  
Permite listar todas las categorías creadas. 

* GET: /api/category/listById  
Permite listar una categoría creada por su id. 

* POST: /api/category/store  
Permite crear una nueva categoría.  

* PUT: /api/category/update/:id  
Permite actualizar una categoría existente por su id. 

* DELETE: /api/category/destroy/:id  
Permite eliminar definitivamente una categoría existente por su id. 

***2. UserController:***

* GET: /api/user/list  
Permite listar todos los usuarios guardados. 

* GET: /api/user/listById  
Permite listar un usuario creado por su id. 

* POST: /api/user/store  
Permite guardar un nuevo usuario.  

* PUT: /api/user/update/:id  
Permite actualizar un usuario existente por su id. 

* DELETE: /api/user/destroy/:id  
Permite eliminar definitivamente un usuario existente por su id. 

***3. PostController:***

* GET: /api/post/list  
Permite listar todos los posts creados. 

* GET: /api/post/listById  
Permite listar un post creado por su id. 

* POST: /api/post/store  
Permite crear un nuevo post.  

* PUT: /api/post/update/:id  
Permite actualizar un post existente por su id. 

* DELETE: /api/post/destroy/:id  
Permite eliminar definitivamente un post existente por su id. 

***4. AuthController:***

* POST: /api/login/auth  
Genera un token de acceso. 

##### ______________________________________________________________________________________________________________________________________________
***Inserts:***

*Roles inserts:

INSERT INTO `posts-db`.`roles` (`role`) 
VALUES ('Administrador');

INSERT INTO `posts-db`.`roles` (`role`) 
VALUES ('Lector');

*Users inserts:

INSERT INTO `posts-db`.`users` (`role_id`, `name`, `email`, `password`) 
VALUES ('1', 'Alejandro Puerta', 'Alejo.Puerta@gmail.com', '123456789');

INSERT INTO `posts-db`.`users` (`role_id`, `name`, `email`, `password`) 
VALUES ('1', 'Sebastián Franco', 'Sebas.Franco@gmail.com', '123456789');

INSERT INTO `posts-db`.`users` (`role_id`, `name`, `email`, `password`) 
VALUES ('1', 'Rodrigo Betancur', 'Rodri.BetancurP@gmail.com', '123456789');

INSERT INTO `posts-db`.`users` (`role_id`, `name`, `email`, `password`) 
VALUES ('2', 'Manuela Estrada', 'Manu.Estrada gmail.com', '123456789');


*Categories inserts:

INSERT INTO `posts-db`.`categories` (`name`, `description`) 
VALUES ('Tecnología', '');

INSERT INTO `posts-db`.`categories` (`name`, `description`) 
VALUES ('Hogar', '');

INSERT INTO `posts-db`.`categories` (`name`, `description`) 
VALUES ('Exterior', '');

INSERT INTO `posts-db`.`categories` (`name`, `description`) 
VALUES ('Mascotas', '');

INSERT INTO `posts-db`.`categories` (`name`, `description`) 
VALUES ('Gastronomía', '');

INSERT INTO `posts-db`.`categories` (`name`, `description`) 
VALUES ('Otros', '');


*Posts inserts:

INSERT INTO `posts-db`.`posts` (`category_id`, `user_id`, `tittle`, `content`, `state`, `description`) 
VALUES ('1', '1', 'Iphone 12 Max', 'Publicidad', 1, '');

INSERT INTO `posts-db`.`posts` (`category_id`, `user_id`, `tittle`, `content`, `state`, `description`) 
VALUES ('2', '2', 'Sanduchera', 'Publicidad', 1, '');

INSERT INTO `posts-db`.`posts` (`category_id`, `user_id`, `tittle`, `content`, `state`, `description`) 
VALUES ('5', '3', 'Pizza Pepperoni', 'Oferta', 1, '');
