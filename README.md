# Hundir la Flota (Battleship Game)

Juego clásico de Hundir la Flota desarrollado con HTML, CSS, JavaScript y PHP. El jugador debe localizar y hundir toda la flota enemiga en el menor número de disparos posible.

## Descripción General

Este proyecto implementa el juego tradicional de Hundir la Flota con las siguientes características:

- Tablero de juego de 10x10 celdas
- Sistema de puntuación basado en el número de disparos
- Ranking de mejores puntuaciones persistente
- Interfaz visual con retroalimentación inmediata (agua, tocado, hundido)
- Generación aleatoria de posiciones de barcos en el servidor
- Modal de victoria con registro de puntuación

### Flota Enemiga

El juego incluye 5 barcos con diferentes tamaños:

- **Portaaviones**: 5 casillas
- **Acorazado**: 4 casillas
- **Destructor**: 3 casillas
- **Submarino**: 3 casillas
- **Patrullero**: 2 casillas

## Requisitos Previos

Para ejecutar este proyecto necesitas:

- **Servidor web** con soporte PHP (Apache, Nginx, etc.)
- **PHP 7.0 o superior**
- **Navegador web moderno** (Chrome, Firefox, Safari, Edge)
- Permisos de escritura en el directorio del proyecto para `scores.json`

### Recomendaciones de Entorno

- **XAMPP** (Windows/Mac/Linux)
- **WAMP** (Windows)
- **MAMP** (Mac)
- **LAMP** (Linux)
- Servidor PHP integrado para desarrollo

## Instalación

### Opción 1: Servidor Local (XAMPP/WAMP/MAMP)

1. Clona o descarga el repositorio:
   \`\`\`bash
   git clone https://github.com/tu-usuario/hundir-la-flota.git
   \`\`\`

2. Copia el proyecto al directorio del servidor web:

   - **XAMPP**: `C:\xampp\htdocs\hundir-la-flota\`
   - **WAMP**: `C:\wamp64\www\hundir-la-flota\`
   - **MAMP**: `/Applications/MAMP/htdocs/hundir-la-flota/`

3. Asegúrate de que el archivo `scores.json` tenga permisos de escritura:
   \`\`\`bash
   chmod 666 scores.json
   \`\`\`

4. Inicia el servidor web desde el panel de control de XAMPP/WAMP/MAMP

5. Accede al juego desde el navegador:
   \`\`\`
   http://localhost/hundir-la-flota/
   \`\`\`

### Opción 2: Servidor PHP Integrado (Desarrollo)

1. Navega al directorio del proyecto:
   \`\`\`bash
   cd hundir-la-flota
   \`\`\`

2. Inicia el servidor PHP integrado:
   \`\`\`bash
   php -S localhost:8000
   \`\`\`

3. Accede al juego desde el navegador:
   \`\`\`
   http://localhost:8000
   \`\`\`

## Configuración

### Estructura de Archivos

```
hundir-la-flota/
│
├── index.html # Página principal del juego
├── app.js # Lógica del cliente (JavaScript)
├── style.css # Estilos visuales
├── start_game.php # Genera tablero y posiciones de barcos
├── save_score.php # Guarda puntuaciones en JSON
├── get_scores.php # Recupera ranking de puntuaciones
├── scores.json # Almacenamiento de puntuaciones
├── img/
│ └── battleship-u-\_062.png # Icono del juego
└── README.md # Documentación
```

### Configuración del Tablero

Para modificar el tamaño del tablero, edita `start_game.php`:

```php
$boardSize = 10; // Cambia este valor (mínimo 10 recomendado)
```

### Configuración de la Flota

Para modificar los barcos disponibles, edita el array `$fleetDefinition` en `start_game.php`:

```php
$fleetDefinition = [
["name" => "Portaaviones", "size" => 5],
["name" => "Acorazado", "size" => 4],
// Añade o modifica barcos aquí
];
```

## Uso

### Iniciar el Juego

1. Abre el juego en tu navegador
2. Haz clic en el botón **START** en la pantalla de inicio
3. El tablero se generará automáticamente con los barcos colocados aleatoriamente

### Mecánica de Juego

1. **Disparar**: Haz clic en cualquier celda del tablero
2. **Retroalimentación visual**:
   - **Azul oscuro**: Agua (fallo)
   - **Naranja**: Tocado (impacto en barco)
   - **Rojo**: Hundido (barco completamente destruido)
3. **Objetivo**: Hundir todos los barcos en el menor número de disparos posible

### Guardar Puntuación

1. Al hundir toda la flota, aparecerá un modal de victoria
2. Introduce tu nombre en el campo de texto
3. Haz clic en **Guardar Puntuación**
4. Tu puntuación se añadirá al ranking si está entre las mejores
5. El juego se reiniciará automáticamente

### Consultar Ranking

El ranking de mejores puntuaciones se muestra en el panel izquierdo durante el juego, ordenado por menor número de disparos.

## Funcionalidades Principales

### API Endpoints

#### `start_game.php`

Genera una nueva partida con posiciones aleatorias de barcos.

**Método**: GET  
**Respuesta**:

```json
{
"boardSize": 10,
"fleet": [
{
"name": "Portaaviones",
"size": 5,
"positions": [
{"row": 2, "col": 3},
{"row": 2, "col": 4},
...
],
"hits": 0,
"isSunk": false
},
...
]
}
```

#### `save_score.php`

Guarda una nueva puntuación en el sistema.

**Método**: POST  
**Body**:

```json
{
  "name": "Jugador",
  "shots": 42
}
```

**Respuesta**:

```json
{
  "success": true,
  "message": "Puntuación guardada correctamente"
}
```

#### `get_scores.php`

Recupera el ranking de puntuaciones.

**Método**: GET
**Respuesta**:

```json
[
{"name": "Jugador1", "shots": 35},
{"name": "Jugador2", "shots": 42},
...
]
```

### Características Técnicas

- **Generación aleatoria**: Los barcos se colocan aleatoriamente sin superposiciones
- **Validación de posiciones**: El servidor valida que los barcos no se salgan del tablero
- **Persistencia de datos**: Las puntuaciones se almacenan en formato JSON
- **Interfaz responsiva**: Diseño adaptable con CSS Grid y Flexbox
- **Fuente retro**: Tipografía "Press Start 2P" para estética arcade

## Solución de Problemas

### El juego no carga

- Verifica que el servidor web esté ejecutándose
- Comprueba que PHP esté instalado y configurado correctamente
- Revisa la consola del navegador (F12) para errores JavaScript

### No se guardan las puntuaciones

- Verifica que `scores.json` tenga permisos de escritura:
  \`\`\`bash
  chmod 666 scores.json
  \`\`\`
- Comprueba que el directorio tenga permisos adecuados
- Revisa los logs del servidor PHP para errores

### El tablero no se muestra correctamente

- Limpia la caché del navegador
- Verifica que `style.css` se esté cargando correctamente
- Comprueba que la fuente de Google Fonts esté accesible

## Contribución

Para contribuir al proyecto:

1. Haz un fork del repositorio
2. Crea una rama para tu funcionalidad (`git checkout -b feature/nueva-funcionalidad`)
3. Realiza tus cambios y haz commit (`git commit -am 'Añade nueva funcionalidad'`)
4. Sube los cambios a tu fork (`git push origin feature/nueva-funcionalidad`)
5. Abre un Pull Request

## Contacto y Reportes

- **Repositorio**: [GitHub - Hundir la Flota](https://github.com/jordiForn/HundirLaFlota)
- **Reportar Issues**: [GitHub Issues](https://github.com/jordiForn/HundirLaFlota/issues)

---

Desarrollado con dedicación para recrear el clásico juego de estrategia naval.
