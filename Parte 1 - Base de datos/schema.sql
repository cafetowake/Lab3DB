-- Database: Lab3

-- DROP DATABASE IF EXISTS "Lab3";

CREATE DATABASE "Lab3"
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Spanish_Guatemala.1252'
    LC_CTYPE = 'Spanish_Guatemala.1252'
    LOCALE_PROVIDER = 'libc'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;

-- Tipos personalizados
CREATE TYPE estado_inscripcion AS ENUM ('activa', 'cancelada', 'completada');
CREATE TYPE tipo_curso AS ENUM ('obligatorio', 'electivo', 'taller', 'seminario');

-- Tabla estudiantes
CREATE TABLE estudiantes (
  id_estudiante SERIAL PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  apellido VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL CHECK (email ~* '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][A-Za-z]+$'),
  fecha_nacimiento DATE NOT NULL CHECK (fecha_nacimiento <= CURRENT_DATE - INTERVAL '15 years'),
  direccion TEXT,
  telefono VARCHAR(20) CHECK (telefono ~ '^[0-9]+$'),
  created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Tabla cursos
CREATE TABLE cursos (
  id_curso SERIAL PRIMARY KEY,
  nombre_curso VARCHAR(100) NOT NULL UNIQUE,
  descripcion TEXT,
  creditos SMALLINT NOT NULL CHECK (creditos > 0 AND creditos <= 10),
  profesor VARCHAR(100) NOT NULL,
  tipo tipo_curso NOT NULL DEFAULT 'obligatorio',
  cupo_maximo SMALLINT CHECK (cupo_maximo > 0),
  created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Tabla intermedia estudiante_curso
CREATE TABLE estudiante_curso (
  id_inscripcion SERIAL PRIMARY KEY,
  id_estudiante INTEGER NOT NULL,
  id_curso INTEGER NOT NULL,
  fecha_inscripcion DATE NOT NULL DEFAULT CURRENT_DATE,
  calificacion DECIMAL(3,1) CHECK (calificacion BETWEEN 0 AND 10),
  estado estado_inscripcion NOT NULL DEFAULT 'activa',
  created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_estudiante
    FOREIGN KEY (id_estudiante) 
    REFERENCES estudiantes(id_estudiante)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_curso
    FOREIGN KEY (id_curso) 
    REFERENCES cursos(id_curso)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT uk_estudiante_curso UNIQUE (id_estudiante, id_curso),
  CONSTRAINT chk_fecha_inscripcion 
    CHECK (fecha_inscripcion <= CURRENT_DATE + INTERVAL '7 days')
);

-- Tabla asistencia
CREATE TABLE asistencia (
  id_asistencia SERIAL PRIMARY KEY,
  id_inscripcion INTEGER NOT NULL,
  fecha DATE NOT NULL CHECK (fecha <= CURRENT_DATE),
  presente BOOLEAN NOT NULL DEFAULT FALSE,
  observaciones TEXT,
  created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_inscripcion
    FOREIGN KEY (id_inscripcion) 
    REFERENCES estudiante_curso(id_inscripcion)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT uk_asistencia UNIQUE (id_inscripcion, fecha)
);

-- Índices para mejorar el rendimiento
CREATE INDEX idx_estudiante_curso_estudiante ON estudiante_curso(id_estudiante);
CREATE INDEX idx_estudiante_curso_curso ON estudiante_curso(id_curso);
CREATE INDEX idx_asistencia_inscripcion ON asistencia(id_inscripcion);
CREATE INDEX idx_asistencia_fecha ON asistencia(fecha);

-- Vista consolidada (VIEW)
CREATE OR REPLACE VIEW vista_estudiantes_cursos AS
SELECT 
  e.id_estudiante,
  e.nombre || ' ' || e.apellido AS estudiante_completo,
  e.email,
  c.id_curso,
  c.nombre_curso,
  c.profesor,
  c.tipo AS tipo_curso,
  ec.fecha_inscripcion,
  ec.calificacion,
  ec.estado AS estado_inscripcion,
  COUNT(a.id_asistencia) FILTER (WHERE a.presente) AS total_asistencias,
  COUNT(a.id_asistencia) AS total_clases,
  ROUND(COUNT(a.id_asistencia) FILTER (WHERE a.presente) * 100.0 / 
        NULLIF(COUNT(a.id_asistencia), 0), 2) AS porcentaje_asistencia
FROM 
  estudiantes e
JOIN 
  estudiante_curso ec ON e.id_estudiante = ec.id_estudiante
JOIN 
  cursos c ON ec.id_curso = c.id_curso
LEFT JOIN 
  asistencia a ON ec.id_inscripcion = a.id_inscripcion
GROUP BY 
  e.id_estudiante, e.nombre, e.apellido, e.email,
  c.id_curso, c.nombre_curso, c.profesor, c.tipo,
  ec.fecha_inscripcion, ec.calificacion, ec.estado;