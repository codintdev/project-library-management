# Proyecto gestión de biblioteca en PHP
Realizado en PHP, simulando una app de gestión de biblioteca.

# Capa de presentación (UI)
Esta capa se encargará de interactuar con el usuario a través de la consola.
# Capa de lógica de negocio (Business Logic Layer)
Esta capa contendrá la lógica de negocio de nuestra aplicación, como la creación, actualización y eliminación de libros. 
# Capa de acceso a datos (Data Access Layer)
Esta capa será responsable de interactuar con la base de datos para realizar operaciones de lectura y escritura.

La cadena de bibliotecas de la ciudad requiere un aplicativo para la gestión de material bibliotecario para ser implementado en todas sus sedes, para ello los contrata para diseñar la arquitectura e implementar el sistema de acuerdo a las siguientes consideraciones:

El sistema debe permitir registrar a los usuarios para que puedan realizar préstamos de material (identificación, un nombre completo, dirección y teléfono). Por su parte, de cada material se conoce su código, título, autor y la cantidad de ejemplares disponibles para el préstamo; además se puede saber en cualquier momento la ubicación del material en la biblioteca, así como la categoría a la que pertenece. Un material puede ser cambiado de lugar, y se le puede cambiar igualmente categoría; de hecho, siempre que se cambia la categoría de un libro es porque se cambia de lugar. Los materiales que se prestan deben quedar registrados y se debe almacenar información básica del usuario, información básica del libro la fecha de préstamo, la fecha de devolución y cantidad de días prestados. 

El sistema debe permitir gestionar todo lo relacionado con los materiales que se manejen en la biblioteca, así mismo que la gestión de usuarios y empleados. De igual forma, el aplicativo debe permitir reservar material por parte de un usuario y gestionar la devolución del material, el cual, tendrá una multa en caso de pasarse de la fecha o días de préstamo del libro. El sistema debe permitir saber el número de libros que un usuario tiene prestados, las multas generadas, que usuarios tienen más de 5 libros prestados a los cuales no se les permitirá prestar más materiales.

# El aplicativo debe contener lo siguiente:

Debe haber un formulario principal donde aparezca un menú de opciones: Gestión de libros, Gestión Empleados, Gestión usuarios, Gestión reservas de materiales, registro de préstamo y devolución de material, Reportes.
Los formularios de Gestión Empleados, usuarios y materiales, deben permitir guardar, buscar, actualizar y eliminar la respectiva información (de acuerdo a los campos que ustedes crearon en la base de datos).
Tenga en cuenta que los formularios que deban gestionar la información de los empleados deben permitir: buscar el código del empleado y traer el nombre y apellido del empleado. Así mismo con los formularios donde se deba manipular la información de los usuarios y materiales.

Debe haber formularios donde se pueda ver el listado de los materiales discriminados por categorías.
En el formulario de reportes se debe permitir mostrar los siguientes reportes:

- Listado de todos los usuarios registrados.
- Listado de todos los empleados.
- Listado de todos los materiales prestados por X usuario.
- Listado de los materiales que han sido prestados por X empleado.
- Listado de las reservas hechas por los usuarios.

# NOTA: El aplicativo debe llevar diseño, crear el logo del hospital, imágenes e información acerca del hospital.

