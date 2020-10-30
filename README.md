# Backend developer position challenge

#### Description
> We require to develop an API for e-learning courses to integrate in our system. The purpose of this tool is for us, as professors to manage courses configuration and performance reviews and, for our students, to take courses when using our frontend. Our PM is a very busy person, so we donâ€™t have detailed tasks but only the business rules to work with. Here they are:
>

#### Instrucciones


1.    We have courses that contain lessons and lessons that contain questions

2.    The courses are correlative with previous ones

3.    The lessons are correlative with previous ones

4.    The questions for each lesson have no correlation

5.    All questions for a lesson are mandatory

6.    Each question has a score

7.    Each lesson has an approval score that has to be met by the sum of correctly answered questions to approve it

8.    A course is approved when all lessons are passed.

9.    There's no restriction on accessing approved courses

10.    Only professors can create and manage courses, lessons and questions

11.    Any student can take a course

12. Initially, we'll need to support these types of questions:
	* Boolean
	* Multiple choice where only one answer is correct
	* Multiple choice where more than one answer is correct
	* Multiple choice where more than one answer is correct and all of them must be answered correctly

13. Frontend guys specifically asked for these endpoints for the students to use:

	* Get a list of all courses, telling which ones the student can access
	* Get lessons for a course, telling which ones the student can access
	* Get lesson details for answering its questions
	* Take a lesson (to avoid several requests, they asked to send all answers in one go)
	* Basic CRUD for courses, lessons and questions

#### Codebase rules:

1.    The API must be developed using Python
2.    There must be a readme file documenting installation and usage.
3.    You can use any frameworks and libraries you want, but they must be included in the readme file documenting its purpose and a brief explanation with the reasoning for your choice.

## Requerimientos
* PHP >= 7.2.5
* MySQL 5.6+
* Composer 2.0

## Framework utilizado
* Laravel 6 - Se eligió este framework de PHP debido a la simplicidad de su sistema de rutas y el soporte que tiene para la generación de API's.

## Instalación
1. Clonar o descargar este repositorio
2. Guardar los ficheros descargados en el directorio web raíz
3. Entrar a la carpeta del proyecto y abrir la consola desde ahi
4. Instalar las librerías del framework por medio de composer
```bash
composer update
```
5. Copiar el archivo .env.example ubicado dentro de la carpeta raíz del proyecto y pegarlo en la misma ubicación
6. Renombrar el archivo pegado anteriormente a .env
7. Generar una llave aleatoria para la app por medio de artisan
```bash
php artisan key:generate
```
8. Crear una nueva base de datos con cualquier nombre
9. Configurar los accesos de la base de datos creada en el archivo .env
```bash
DB_DATABASE= nombredelabase
DB_USERNAME= nombredelusuario
DB_PASSWORD= password
```
6. Correr migración 
```bash
php artisan migrate
```

## Montaje del servidor
1. Ubicate por medio de consola en la carpeta del proyecto
2. Levantar servidor web
```bash
php artisan serve
```
3. La API será accesible desde la url 
```bash
http://127.0.0.1:8000
```

## Notas Importantes
* Se contemplaron dos roles en el sistema: Profesor(1) y Estudiante(2) 
* La base de datos del sistema cuenta con información precargada para fines prácticos
* Se crearon dos usuarios, uno de tipo profesor (usuario con id = 1) y uno de tipo estudiante (usuario con id = 2)
* En las peticiones POST,PUT y DELETE se requiere enviar el parámetro user_id con el fin de establecer si el usuario quien envia la petición cuenta con los permisos necesarios para ejecutar las acciones solicitadas
* El usuario de tipo estudiante solamente podrá realizar peticiones de tipo POST para enviar sus respuestas


## Documentación
A continuación se muestran las estructuras básicas de algunos endpoints para ejemplificar su uso, para el listado de endpoints completo, detalles y parámetros requeridos revise la <a href="https://documenter.getpostman.com/view/13265144/TVYKZbTC#1d165f52-8c5f-425a-8694-9eea0528afcf" target="_blank">Documentación</a>

* Cursos
```bash
GET http://127.0.0.1:8000/api/courses :Obtiene todos los cursos existentes
GET http://127.0.0.1:8000/api/courses/<id> :Obtiene la información del curso específicado por medio de su id
POST http://127.0.0.1:8000/api/courses/ :Crea un nuevo curso
PUT http://127.0.0.1:8000/api/courses/<id> :Actualiza el curso específicado por medio de su id
DELETE http://127.0.0.1:8000/api/courses/<id> :Elimina el curso específicado por medio de su id
```

* Lecciones
```bash
GET http://127.0.0.1:8000/api/lessons :Obtiene todas las lecciones existentes
GET http://127.0.0.1:8000/api/lessons/<id> :Obtiene la información de la lección específicada por medio de su id
POST http://127.0.0.1:8000/api/lessons/ :Crea una nueva lección
PUT http://127.0.0.1:8000/api/lessons/<id> :Actualiza la lección específicada por medio de su id
DELETE http://127.0.0.1:8000/api/lessons/<id> :Elimina la lección específicada por medio de su id
```

* Preguntas
```bash
GET http://127.0.0.1:8000/api/questions :Obtiene todas las preguntas existentes
GET http://127.0.0.1:8000/api/questions/<id> :Obtiene la información de la pregunta específicada por medio de su id
POST http://127.0.0.1:8000/api/questions/ :Crea una nueva pregunta
PUT http://127.0.0.1:8000/api/questions/<id> :Actualiza la pregunta específicada por medio de su id
DELETE http://127.0.0.1:8000/api/questions/<id> :Elimina la pregunta específicada por medio de su id
```

* Respuestas
```bash
GET http://127.0.0.1:8000/api/answers :Obtiene todas las respuestas existentes
GET http://127.0.0.1:8000/api/answers/<id> :Obtiene la información de la respuesta específicada por medio de su id
POST http://127.0.0.1:8000/api/answers/ :Crea una nueva respuesta
PUT http://127.0.0.1:8000/api/answers/<id> :Actualiza la respuesta específicada por medio de su id
DELETE http://127.0.0.1:8000/api/answers/<id> :Elimina la respuesta específicada por medio de su id
```

## Endpoints específicos para el FRONTEND

* Listar todos los cursos (list-courses)

Obtiene el listado de todos los cursos existente e indica a cuales cursos puede acceder el usuario. Este endpoint recibe como parametro el id del usuario (user_id), el usuario debe ser de tipo estudiante (type 2). Para poder acceder a un curso el usuario debe estar registrado en dicho curso (consultar documentación POST /api/user-courses/)

```bash
GET http://127.0.0.1:8000/api/list-courses/
```

* Lecciones por curso (lessons-for-course)

Lista todas las lecciones del curso indicado y muestra a cuales lecciones puede acceder el usuario. Este endpoint recibe como parametro el id del usuario (user_id), el usuario debe ser de tipo estudiante (type 2). Para que un usuario pueda acceder a una lección determinada, el usuario debe estar registrado en el curso que contiene a dicha lección(consultar documentación POST /api/user-courses-log/)

```bash
GET http://127.0.0.1:8000/api/lessons-for-course/<id>
```

* Detalles de la lección (lesson-details)

Lista las preguntas contenidas en la lección así como las respuestas registradas para cada pregunta

```bash
GET http://127.0.0.1:8000/api/lesson-details/<id>
```

* Guardar todas las respuestas en una petición (save-all-answers)

Este endpoint te permite almacenar todas las respuestas enviadas en el cuerpo de la petición en forma de un array de estructuras json. Cada json tiene como llave principal al id de la pregunta y como valor contiene al id de cada respuesta seleccionada. A continuación se muestra dicha estructura:
"answers": [
   {question_id1:[ans_id,ans2_id,..]},
   {question_id2:[ans_id2,ans2_id2,..]},
   .
   .
]


```bash
POST http://127.0.0.1:8000/api/save-all-answers/<id>
```


## Pruebas y resultados

Para poder conocer todos los endpoint disponibles, parámetros requeridos y respuestas puede importar la siguiente collección de Postman: <a href="https://www.postman.com/collections/39781919c0b0fe8cd50b">API Collection</a>