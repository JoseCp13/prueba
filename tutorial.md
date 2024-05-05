Ejecución de Comandos y Configuración de la Base de Datos
Comandos Symfony

1.  Asignar un Influencer a una Campaña
    Este comando asigna un influencer existente a una campaña existente en la base de datos.

            php bin/console app:influencers-campaign <campaignId> <influencerId>


        Reemplaza <campaignId> con el ID de la campaña existente y <influencerId> con el ID del influencer existente.

2.  Listar Campañas
    Este comando lista todas las campañas existentes en la base de datos, mostrando sus detalles como nombre, descripción, fechas, etc.

            php bin/console app:list-campaign

3. Crear campañas
    Este comando se encarga de crear las campañas, dicho comando 
    al ejecutarlo nos pedira el nombre y descripcion junto a la fecha de inicio con un formato el cual se indica y la fecha de fin de la dicha campaña.


        php bin/console app:create-campaign   

Configuración de la Base de Datos

1.  Configuración del archivo .env
    Asegúrate de configurar correctamente tu archivo .env para que Symfony pueda conectarse a tu base de datos. Esto incluye configurar las variables de entorno DATABASE_URL para la conexión.

            DATABASE_URL=mysql://usuario:contraseña@localhost/nombre_base_de_datos

        Reemplaza usuario con tu nombre de usuario de MySQL, contraseña con tu contraseña de MySQL y nombre_base_de_datos con el nombre de tu base de datos.



