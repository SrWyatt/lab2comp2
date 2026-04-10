# Programación IV

**Estudiante:** Josué Esaú Batres Guardado  
**Código:** SMSS058820  
**Actividad:** Laboratorio 2 - Cómputo II  

---

### Respuestas

#### 1. ¿De qué forma manejaste el login de usuarios?
El acceso se gestiona mediante el envío de datos desde un formulario hacia el servidor, donde se comparan con los registros almacenados. Se utiliza una lógica de sesiones para que el sistema reconozca el rol del usuario (administrador o regular) tras la validación. Esto permite que la página funcione de forma selectiva: el administrador obtiene herramientas de gestión total, mientras que el usuario estándar solo visualiza su información personal.

#### 2. ¿Por qué es necesario para las aplicaciones web utilizar bases de datos en lugar de variables?
Las variables son volátiles y su contenido se borra al cerrar la página o finalizar la ejecución del código. Una base de datos es indispensable para la persistencia; permite que la información de los 20 usuarios y sus perfiles se mantenga guardada permanentemente en el almacenamiento físico, garantizando que los datos no se pierdan entre sesiones o reinicios.

#### 3. ¿En qué casos usar bases de datos vs datos temporales?
* **Bases de Datos:** Para información crítica y fija, como expedientes de empleados, teléfonos y fechas de contrato que deben consultarse en cualquier momento.
* **Datos Temporales (Sesiones/Cookies):** Para el control de flujo inmediato, como saber quién está logueado en el instante o recordar preferencias visuales del navegador que no requieren almacenamiento permanente.

#### 4. Descripción de tablas y tipos de datos
* **usuarios:** Almacena credenciales y permisos. Se usa `INT` para IDs correlativos, `VARCHAR` para nombres y claves, y `ENUM` para definir los roles, asegurando que solo existan niveles de acceso autorizados.
* **perfiles:** Contiene la información detallada. Se emplea `VARCHAR` para textos y teléfonos (permitiendo símbolos), y `DATE` para cumpleaños y contratos, lo que facilita el orden cronológico. Se vincula a la tabla anterior mediante una llave foránea para mantener la integridad de la información.

---

### Nota sobre la carpeta de datos
La carpeta `databases` dentro del proyecto se incluye para hacer constancia del diseño y la integración de la base de datos en el desarrollo. Sin embargo, para que el sistema funcione, dicha estructura debe estar cargada y activa en la ruta de datos correspondiente de la plataforma donde se ejecute el sitio.
