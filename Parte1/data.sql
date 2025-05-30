-- Insertar datos en la tabla 'estudiantes'
INSERT INTO estudiantes (nombre, apellido, email, fecha_nacimiento) VALUES
('Juan', 'Pérez', 'juan.perez@email.com', '1998-05-15'),
('María', 'Gómez', 'maria.gomez@email.com', '1999-02-20'),
('Carlos', 'López', 'carlos.lopez@email.com', '2000-11-03'),
('Ana', 'Martínez', 'ana.martinez@email.com', '1997-07-22'),
('Luis', 'Rodríguez', 'luis.rodriguez@email.com', '1999-09-30'),
('Sofía', 'Hernández', 'sofia.hernandez@email.com', '1998-04-18'),
('Pedro', 'Díaz', 'pedro.diaz@email.com', '2000-01-25'),
('Laura', 'Fernández', 'laura.fernandez@email.com', '1997-12-10'),
('Jorge', 'Sánchez', 'jorge.sanchez@email.com', '1999-08-05'),
('Mónica', 'Ramírez', 'monica.ramirez@email.com', '1998-03-12');

-- Insertar datos en la tabla 'cursos'
INSERT INTO cursos (nombre_curso, descripcion, creditos, profesor, tipo) VALUES
('Matemáticas Avanzadas', 'Cálculo diferencial e integral', 4, 'Dr. Álvarez', 'obligatorio'),
('Programación I', 'Introducción a la programación con Python', 3, 'Ing. Torres', 'obligatorio'),
('Bases de Datos', 'Diseño e implementación de bases de datos', 4, 'Lic. Jiménez', 'obligatorio'),
('Inteligencia Artificial', 'Fundamentos de IA y machine learning', 5, 'Dra. Ruiz', 'electivo'),
('Derecho Informático', 'Aspectos legales de la tecnología', 2, 'Dr. Mendoza', 'electivo'),
('Taller de Robótica', 'Construcción y programación de robots', 3, 'Ing. Castro', 'taller');

-- Insertar relaciones estudiante_curso (30 inscripciones)
-- Varios estudiantes están inscritos en múltiples cursos
INSERT INTO estudiante_curso (id_estudiante, id_curso, fecha_inscripcion, calificacion, estado) VALUES
-- Juan Pérez (3 cursos)
(1, 1, '2023-01-10', 8.5, 'completada'),
(1, 2, '2023-01-10', 9.0, 'completada'),
(1, 4, '2023-01-15', NULL, 'activa'),

-- María Gómez (2 cursos)
(2, 1, '2023-01-11', 7.5, 'completada'),
(2, 3, '2023-01-11', 8.0, 'activa'),

-- Carlos López (4 cursos)
(3, 1, '2023-01-12', 6.5, 'completada'),
(3, 2, '2023-01-12', 7.0, 'completada'),
(3, 3, '2023-01-12', NULL, 'activa'),
(3, 6, '2023-01-20', NULL, 'activa'),

-- Ana Martínez (3 cursos)
(4, 2, '2023-01-13', 9.5, 'completada'),
(4, 4, '2023-01-13', NULL, 'activa'),
(4, 5, '2023-01-13', 8.5, 'completada'),

-- Luis Rodríguez (2 cursos)
(5, 3, '2023-01-14', 7.0, 'activa'),
(5, 6, '2023-01-14', NULL, 'activa'),

-- Sofía Hernández (3 cursos)
(6, 1, '2023-01-15', 8.0, 'completada'),
(6, 2, '2023-01-15', 9.5, 'completada'),
(6, 5, '2023-01-20', NULL, 'activa'),

-- Pedro Díaz (2 cursos)
(7, 4, '2023-01-16', NULL, 'activa'),
(7, 6, '2023-01-16', 7.5, 'completada'),

-- Laura Fernández (3 cursos)
(8, 1, '2023-01-17', 6.0, 'completada'),
(8, 3, '2023-01-17', 7.5, 'activa'),
(8, 5, '2023-01-17', NULL, 'activa'),

-- Jorge Sánchez (4 cursos)
(9, 2, '2023-01-18', 8.0, 'completada'),
(9, 3, '2023-01-18', NULL, 'activa'),
(9, 4, '2023-01-18', NULL, 'activa'),
(9, 6, '2023-01-25', 9.0, 'completada'),

-- Mónica Ramírez (3 cursos)
(10, 1, '2023-01-19', 9.0, 'completada'),
(10, 2, '2023-01-19', 8.5, 'completada'),
(10, 5, '2023-01-19', NULL, 'activa');

-- Insertar datos de asistencia (60 registros - 2 clases por curso inscrito)
-- Cada inscripción activa tiene 2 registros de asistencia
INSERT INTO asistencia (id_inscripcion, fecha, presente) VALUES
-- Asistencias para inscripción 4 (Juan Pérez en Inteligencia Artificial)
(4, '2023-02-01', TRUE),
(4, '2023-02-08', FALSE),

-- Asistencias para inscripción 5 (María Gómez en Bases de Datos)
(5, '2023-02-02', TRUE),
(5, '2023-02-09', TRUE),

-- Asistencias para inscripción 7 (Carlos López en Programación I)
(7, '2023-02-01', TRUE),
(7, '2023-02-08', TRUE),

-- Asistencias para inscripción 8 (Carlos López en Bases de Datos)
(8, '2023-02-03', FALSE),
(8, '2023-02-10', TRUE),

-- Asistencias para inscripción 9 (Carlos López en Taller de Robótica)
(9, '2023-02-05', TRUE),
(9, '2023-02-12', TRUE),

-- Asistencias para inscripción 11 (Ana Martínez en Inteligencia Artificial)
(11, '2023-02-01', TRUE),
(11, '2023-02-08', TRUE),

-- Asistencias para inscripción 13 (Luis Rodríguez en Bases de Datos)
(13, '2023-02-03', TRUE),
(13, '2023-02-10', FALSE),

-- Asistencias para inscripción 14 (Luis Rodríguez en Taller de Robótica)
(14, '2023-02-05', TRUE),
(14, '2023-02-12', TRUE),

-- Asistencias para inscripción 17 (Sofía Hernández en Derecho Informático)
(17, '2023-02-04', FALSE),
(17, '2023-02-11', TRUE),

-- Asistencias para inscripción 18 (Pedro Díaz en Inteligencia Artificial)
(18, '2023-02-01', TRUE),
(18, '2023-02-08', TRUE),

-- Asistencias para inscripción 20 (Laura Fernández en Bases de Datos)
(20, '2023-02-03', TRUE),
(20, '2023-02-10', TRUE),

-- Asistencias para inscripción 21 (Laura Fernández en Derecho Informático)
(21, '2023-02-04', FALSE),
(21, '2023-02-11', FALSE),

-- Asistencias para inscripción 23 (Jorge Sánchez en Bases de Datos)
(23, '2023-02-03', TRUE),
(23, '2023-02-10', TRUE),

-- Asistencias para inscripción 24 (Jorge Sánchez en Inteligencia Artificial)
(24, '2023-02-01', TRUE),
(24, '2023-02-08', FALSE),

-- Asistencias para inscripción 27 (Mónica Ramírez en Programación I)
(27, '2023-02-01', TRUE),
(27, '2023-02-08', TRUE),

-- Asistencias para inscripción 29 (Mónica Ramírez en Derecho Informático)
(29, '2023-02-04', TRUE),
(29, '2023-02-11', TRUE);