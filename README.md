# Backend-posts-php
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
