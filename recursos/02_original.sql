--
-- PostgreSQL database dump
--

-- Dumped from database version 10.3
-- Dumped by pg_dump version 10.3

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: persona; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.persona (
    id_persona integer NOT NULL,
    cedula_p character(8),
    nombre_apellido_p character(30) NOT NULL,
    fecha_nacimiento_p date,
    parentesco character(10),
    semana_embarazo character(2),
    talla_zapato character(2),
    talla_pantalon character(2),
    talla_franela character(3)
);


ALTER TABLE public.persona OWNER TO postgres;

--
-- Name: COLUMN persona.id_persona; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.persona.id_persona IS 'Es el identificador de la tabla persona, es único, auto incrementable y clave primaria';


--
-- Name: COLUMN persona.cedula_p; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.persona.cedula_p IS 'La cedula del  beneficiario ';


--
-- Name: COLUMN persona.nombre_apellido_p; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.persona.nombre_apellido_p IS 'Los nombres del  beneficiario ';


--
-- Name: COLUMN persona.parentesco; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.persona.parentesco IS 'El parentesco del beneficiario si pertenece alguna rama de la familia';


--
-- Name: COLUMN persona.semana_embarazo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.persona.semana_embarazo IS 'Semana de embarazo en caso de solicitud de canastilla ';


--
-- Name: beneficiario_id_beneficiario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.beneficiario_id_beneficiario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.beneficiario_id_beneficiario_seq OWNER TO postgres;

--
-- Name: beneficiario_id_beneficiario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.beneficiario_id_beneficiario_seq OWNED BY public.persona.id_persona;


--
-- Name: familiar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.familiar (
    id_familiar integer NOT NULL,
    nombre_apellido_f character(30),
    fecha_nacimiento_f date,
    parentesco_f character(10),
    ocupacion_f character(50),
    ingreso_f character(7),
    peso_f character(6),
    talla_f character(3)
);


ALTER TABLE public.familiar OWNER TO postgres;

--
-- Name: familiar_id_familiar_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.familiar_id_familiar_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.familiar_id_familiar_seq OWNER TO postgres;

--
-- Name: familiar_id_familiar_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.familiar_id_familiar_seq OWNED BY public.familiar.id_familiar;


--
-- Name: familiar_solicitud; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.familiar_solicitud (
    id_familiar_solicitud integer NOT NULL,
    id_familiar integer,
    id_solicitud integer
);


ALTER TABLE public.familiar_solicitud OWNER TO postgres;

--
-- Name: familiar_solicitud_id_familiar_solicitud_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.familiar_solicitud_id_familiar_solicitud_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.familiar_solicitud_id_familiar_solicitud_seq OWNER TO postgres;

--
-- Name: familiar_solicitud_id_familiar_solicitud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.familiar_solicitud_id_familiar_solicitud_seq OWNED BY public.familiar_solicitud.id_familiar_solicitud;


--
-- Name: permiso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.permiso (
    id_permiso integer NOT NULL,
    nombre character(30) NOT NULL
);


ALTER TABLE public.permiso OWNER TO postgres;

--
-- Name: TABLE permiso; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.permiso IS 'Aquí en donde se va almacenar los permisos para el usuario';


--
-- Name: COLUMN permiso.id_permiso; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.permiso.id_permiso IS 'Es el identificador de la tabla permiso, es único, auto incrementable y clave primaria';


--
-- Name: COLUMN permiso.nombre; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.permiso.nombre IS 'Es en donde se almacena el nombre del permiso';


--
-- Name: permiso_id_permiso_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.permiso_id_permiso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permiso_id_permiso_seq OWNER TO postgres;

--
-- Name: permiso_id_permiso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.permiso_id_permiso_seq OWNED BY public.permiso.id_permiso;


--
-- Name: solicitante; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitante (
    id_solicitante integer NOT NULL,
    cedula character(8) NOT NULL,
    nombre_apellido character(30) NOT NULL,
    fecha_nacimiento date NOT NULL,
    sexo character(9) NOT NULL,
    direccion character(100) NOT NULL,
    telefono_1 character(12) NOT NULL,
    telefono_2 character(12),
    email character(30),
    parroquia character(16) NOT NULL,
    estado_civil character(13) NOT NULL,
    ocupacion character(50) NOT NULL,
    esterilizada character(2) NOT NULL,
    beneficio_gubernamental character(50),
    num_hijo integer,
    ingreso character(6)
);


ALTER TABLE public.solicitante OWNER TO postgres;

--
-- Name: TABLE solicitante; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.solicitante IS 'Esta tabla contiene todos los datos personales del solicitante';


--
-- Name: COLUMN solicitante.id_solicitante; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.id_solicitante IS 'Es el identificador de la tabla solicitante, es único, auto incrementable y clave primaria';


--
-- Name: COLUMN solicitante.cedula; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.cedula IS 'El número de cedula del solicitante y es una llave primaria';


--
-- Name: COLUMN solicitante.nombre_apellido; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.nombre_apellido IS 'Los nombre del solicitante';


--
-- Name: COLUMN solicitante.direccion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.direccion IS 'Dirección de habitación del solicitante';


--
-- Name: COLUMN solicitante.telefono_1; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.telefono_1 IS 'El teléfono celular o personal del solicitante';


--
-- Name: COLUMN solicitante.telefono_2; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.telefono_2 IS 'El teléfono fijo o de casa del solicitante';


--
-- Name: COLUMN solicitante.email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.email IS 'El Correo del solicitante';


--
-- Name: COLUMN solicitante.parroquia; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.parroquia IS 'El área en donde se ubica';


--
-- Name: COLUMN solicitante.estado_civil; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.estado_civil IS 'Si el solicitante es casado, soltero, entre otras cosas.';


--
-- Name: COLUMN solicitante.ocupacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.ocupacion IS 'A que se dedica el solicitante actualmente';


--
-- Name: COLUMN solicitante.esterilizada; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.esterilizada IS 'Si el solicitante es esterilizada';


--
-- Name: COLUMN solicitante.beneficio_gubernamental; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.beneficio_gubernamental IS 'Si posee algún beneficio por parte del gobierno';


--
-- Name: solicitante_id_solicitante_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitante_id_solicitante_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.solicitante_id_solicitante_seq OWNER TO postgres;

--
-- Name: solicitante_id_solicitante_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solicitante_id_solicitante_seq OWNED BY public.solicitante.id_solicitante;


--
-- Name: solicitud; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.solicitud (
    id_solicitud integer NOT NULL,
    id_solicitante integer NOT NULL,
    id_tipo_solicitud integer NOT NULL,
    id_persona integer NOT NULL,
    fecha date NOT NULL,
    medio_informacion character(30) NOT NULL,
    tipo_vivienda character(11) NOT NULL,
    tenencia character(9) NOT NULL,
    construccion character(9) NOT NULL,
    tipo_piso character(8) NOT NULL,
    estado character(9) NOT NULL
);


ALTER TABLE public.solicitud OWNER TO postgres;

--
-- Name: TABLE solicitud; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.solicitud IS 'La tabla principal en donde se hace la solicitud y el informe social al mismo tiempo conectando todas las tablas';


--
-- Name: COLUMN solicitud.id_solicitud; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitud.id_solicitud IS 'Numero de control para identificarlo y archivarlo';


--
-- Name: COLUMN solicitud.id_solicitante; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitud.id_solicitante IS 'Es el identificador de la solicitante, es único, auto incrementable y clave foranea';


--
-- Name: COLUMN solicitud.id_tipo_solicitud; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitud.id_tipo_solicitud IS 'Llave foránea haciendo referencia a la tabla beneficiario';


--
-- Name: COLUMN solicitud.fecha; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitud.fecha IS 'Fecha en la que se hizo la solicitud';


--
-- Name: COLUMN solicitud.estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitud.estado IS 'El estado de la solicitud, aprobado o en espera';


--
-- Name: solicitud_numero_control_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitud_numero_control_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.solicitud_numero_control_seq OWNER TO postgres;

--
-- Name: solicitud_numero_control_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.solicitud_numero_control_seq OWNED BY public.solicitud.id_solicitud;


--
-- Name: tipo_solicitud; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tipo_solicitud (
    id_tipo_solicitud integer NOT NULL,
    solicitud character(45) NOT NULL,
    descripcion character(45) NOT NULL,
    condicion character(1) DEFAULT 1 NOT NULL
);


ALTER TABLE public.tipo_solicitud OWNER TO postgres;

--
-- Name: TABLE tipo_solicitud; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.tipo_solicitud IS 'Aquí es donde se va almacenar los tipos de solicitud que existen o que en algún futuro quiere añadir';


--
-- Name: COLUMN tipo_solicitud.id_tipo_solicitud; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.tipo_solicitud.id_tipo_solicitud IS 'ID de la tabla autoincrementable';


--
-- Name: COLUMN tipo_solicitud.solicitud; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.tipo_solicitud.solicitud IS 'Nombre o titulo de la solicitud';


--
-- Name: COLUMN tipo_solicitud.descripcion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.tipo_solicitud.descripcion IS 'Las infinidades de ayudas asociada a la solicitud';


--
-- Name: COLUMN tipo_solicitud.condicion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.tipo_solicitud.condicion IS 'Si esta activa o no la solicitud para el beneficiario';


--
-- Name: tipo_solicitud_id_tipo_solicitud_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tipo_solicitud_id_tipo_solicitud_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipo_solicitud_id_tipo_solicitud_seq OWNER TO postgres;

--
-- Name: tipo_solicitud_id_tipo_solicitud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tipo_solicitud_id_tipo_solicitud_seq OWNED BY public.tipo_solicitud.id_tipo_solicitud;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    id_usuario integer NOT NULL,
    nombre_apellido character(30) NOT NULL,
    cedula character(8) NOT NULL,
    telefono character(12) NOT NULL,
    email character(30),
    cargo character(20),
    login character(20) NOT NULL,
    clave character(64) NOT NULL,
    imagen character(50),
    condicion integer DEFAULT 1 NOT NULL
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- Name: TABLE usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.usuario IS 'Los datos del usuario al registrar, entrar y manipular el sistema';


--
-- Name: COLUMN usuario.id_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario.id_usuario IS 'Es el identificador de la tabla usuario, es único, auto incrementable y clave primaria';


--
-- Name: COLUMN usuario.nombre_apellido; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario.nombre_apellido IS 'Nombre del usuario a manipular el sistema';


--
-- Name: COLUMN usuario.cedula; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario.cedula IS 'Numero de identificación que es la cedula';


--
-- Name: COLUMN usuario.telefono; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario.telefono IS 'Teléfono de contacto del usuario, preferiblemente un teléfono móvil ';


--
-- Name: COLUMN usuario.email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario.email IS 'Correo electronico del usuario';


--
-- Name: COLUMN usuario.cargo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario.cargo IS 'Tipo de cargo del usuario';


--
-- Name: COLUMN usuario.login; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario.login IS 'Nombre de usuario al entrar al sistema';


--
-- Name: COLUMN usuario.clave; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario.clave IS 'Passwor o clave del usuario, no mayoro menor de 8 digitos';


--
-- Name: COLUMN usuario.imagen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario.imagen IS 'En donde se guarda la imagen del usuario';


--
-- Name: COLUMN usuario.condicion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario.condicion IS 'La condicion del usuario';


--
-- Name: usuario_id_usuario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_id_usuario_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_usuario_seq OWNER TO postgres;

--
-- Name: usuario_id_usuario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_id_usuario_seq OWNED BY public.usuario.id_usuario;


--
-- Name: usuario_permiso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario_permiso (
    id_usuario_permiso integer NOT NULL,
    id_usuario integer NOT NULL,
    id_permiso integer NOT NULL
);


ALTER TABLE public.usuario_permiso OWNER TO postgres;

--
-- Name: TABLE usuario_permiso; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.usuario_permiso IS 'Es una relación para establecer uno o más permiso a un usuario';


--
-- Name: COLUMN usuario_permiso.id_usuario_permiso; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario_permiso.id_usuario_permiso IS 'Es el identificador de la tabla usuario_permiso, es único, auto incrementable y clave primaria';


--
-- Name: COLUMN usuario_permiso.id_usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario_permiso.id_usuario IS 'Llave foránea haciendo referencia a la tabla usuario';


--
-- Name: COLUMN usuario_permiso.id_permiso; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.usuario_permiso.id_permiso IS 'Llave foránea haciendo referencia a la tabla permiso';


--
-- Name: usuario_permiso_id_usuario_permiso_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_permiso_id_usuario_permiso_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_permiso_id_usuario_permiso_seq OWNER TO postgres;

--
-- Name: usuario_permiso_id_usuario_permiso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_permiso_id_usuario_permiso_seq OWNED BY public.usuario_permiso.id_usuario_permiso;


--
-- Name: usuario_solicitud; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario_solicitud (
    id_usuario_solicitud integer NOT NULL,
    id_solicitud integer NOT NULL,
    id_usuario integer NOT NULL,
    fecha_hora_u date NOT NULL,
    descripcion_u character(45) NOT NULL
);


ALTER TABLE public.usuario_solicitud OWNER TO postgres;

--
-- Name: TABLE usuario_solicitud; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.usuario_solicitud IS 'intermedio entre usuario y solicitud para conocer y saber que usuario acepta o hace una solicitud en el sistema';


--
-- Name: usuario_solicitud_id_usuario_solicitud_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuario_solicitud_id_usuario_solicitud_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_solicitud_id_usuario_solicitud_seq OWNER TO postgres;

--
-- Name: usuario_solicitud_id_usuario_solicitud_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.usuario_solicitud_id_usuario_solicitud_seq OWNED BY public.usuario_solicitud.id_usuario_solicitud;


--
-- Name: visita_social; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.visita_social (
    id_visita_social integer NOT NULL,
    id_persona integer NOT NULL,
    fecha_v date NOT NULL,
    observaciones character(300),
    trabajador_social character(45)
);


ALTER TABLE public.visita_social OWNER TO postgres;

--
-- Name: TABLE visita_social; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE public.visita_social IS 'Informe de la visita social sobre el solicitante';


--
-- Name: COLUMN visita_social.id_visita_social; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.visita_social.id_visita_social IS 'Es el identificador de la tabla visita_social, es único, auto incrementable y clave primaria';


--
-- Name: COLUMN visita_social.id_persona; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.visita_social.id_persona IS 'Numero de control para identificarlo y archivarlo';


--
-- Name: COLUMN visita_social.observaciones; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.visita_social.observaciones IS 'Observaciones de la visita social';


--
-- Name: COLUMN visita_social.trabajador_social; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.visita_social.trabajador_social IS 'El trabajador social quien hizo la visita social';


--
-- Name: visita_social_id_visita_social_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.visita_social_id_visita_social_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.visita_social_id_visita_social_seq OWNER TO postgres;

--
-- Name: visita_social_id_visita_social_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.visita_social_id_visita_social_seq OWNED BY public.visita_social.id_visita_social;


--
-- Name: familiar id_familiar; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familiar ALTER COLUMN id_familiar SET DEFAULT nextval('public.familiar_id_familiar_seq'::regclass);


--
-- Name: familiar_solicitud id_familiar_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familiar_solicitud ALTER COLUMN id_familiar_solicitud SET DEFAULT nextval('public.familiar_solicitud_id_familiar_solicitud_seq'::regclass);


--
-- Name: permiso id_permiso; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permiso ALTER COLUMN id_permiso SET DEFAULT nextval('public.permiso_id_permiso_seq'::regclass);


--
-- Name: persona id_persona; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona ALTER COLUMN id_persona SET DEFAULT nextval('public.beneficiario_id_beneficiario_seq'::regclass);


--
-- Name: solicitante id_solicitante; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitante ALTER COLUMN id_solicitante SET DEFAULT nextval('public.solicitante_id_solicitante_seq'::regclass);


--
-- Name: solicitud id_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud ALTER COLUMN id_solicitud SET DEFAULT nextval('public.solicitud_numero_control_seq'::regclass);


--
-- Name: tipo_solicitud id_tipo_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_solicitud ALTER COLUMN id_tipo_solicitud SET DEFAULT nextval('public.tipo_solicitud_id_tipo_solicitud_seq'::regclass);


--
-- Name: usuario id_usuario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario ALTER COLUMN id_usuario SET DEFAULT nextval('public.usuario_id_usuario_seq'::regclass);


--
-- Name: usuario_permiso id_usuario_permiso; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_permiso ALTER COLUMN id_usuario_permiso SET DEFAULT nextval('public.usuario_permiso_id_usuario_permiso_seq'::regclass);


--
-- Name: usuario_solicitud id_usuario_solicitud; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_solicitud ALTER COLUMN id_usuario_solicitud SET DEFAULT nextval('public.usuario_solicitud_id_usuario_solicitud_seq'::regclass);


--
-- Name: visita_social id_visita_social; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visita_social ALTER COLUMN id_visita_social SET DEFAULT nextval('public.visita_social_id_visita_social_seq'::regclass);


--
-- Data for Name: familiar; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.familiar VALUES (1, 'dcsfsr                        ', '2018-11-05', 'scscs     ', 'scscsc                                            ', '1      ', '2     ', '3  ');
INSERT INTO public.familiar VALUES (2, 'xwd3dqwd                      ', '2018-11-01', 'ewqe      ', 'acdasc                                            ', '3      ', '5     ', '6  ');
INSERT INTO public.familiar VALUES (3, 'prueba2                       ', '2018-11-05', 'prueba2   ', 'prueba2                                           ', '2.000  ', '0     ', '   ');
INSERT INTO public.familiar VALUES (4, 'prueba22                      ', '2018-11-02', 'prueba22  ', 'prueba22                                          ', '0      ', '1     ', '   ');
INSERT INTO public.familiar VALUES (5, 'prueba23                      ', '2018-11-05', 'prueba23  ', 'prueba23                                          ', '2      ', '3     ', '   ');
INSERT INTO public.familiar VALUES (6, 'dwdad                         ', '2018-11-20', 'adwasfs   ', 'sefsef                                            ', '9      ', '8     ', '7  ');
INSERT INTO public.familiar VALUES (7, 'wdadada                       ', '2018-11-14', 'fesfsf    ', 'sefsef                                            ', '6      ', '5     ', '4  ');
INSERT INTO public.familiar VALUES (8, 'fami1                         ', '2018-11-30', 'hermano   ', 'chofer                                            ', '1.000  ', '90    ', '80 ');
INSERT INTO public.familiar VALUES (9, 'fami2                         ', '2018-11-26', 'padre     ', 'colector                                          ', '500    ', '70    ', '150');
INSERT INTO public.familiar VALUES (10, 'fami3                         ', '2018-10-12', 'madre     ', 'puta                                              ', '10.000 ', '60    ', '180');
INSERT INTO public.familiar VALUES (11, 'familiares1                   ', '2018-11-26', 'hermana   ', 'cantante                                          ', '10.000 ', '50    ', '160');
INSERT INTO public.familiar VALUES (12, 'familiares2                   ', '1986-12-02', 'Marico    ', 'regalado                                          ', '5.000  ', '70    ', '180');
INSERT INTO public.familiar VALUES (13, 'familiares3                   ', '1999-11-05', 'Primo     ', 'doctor                                            ', '8.000  ', '90    ', '168');
INSERT INTO public.familiar VALUES (14, 'Nunm1                         ', '2009-10-08', 'quien     ', 'nada                                              ', '0      ', '100   ', '150');
INSERT INTO public.familiar VALUES (15, 'Num2                          ', '2013-10-26', 'sabe      ', 'menos                                             ', '0      ', '90    ', '160');
INSERT INTO public.familiar VALUES (16, 'fami sin soli y sin bene 1    ', '2009-07-14', 'esta      ', 'vamos                                             ', '4.500  ', '40    ', '169');
INSERT INTO public.familiar VALUES (17, 'fami sin soli y sin bene 2    ', '1996-08-14', 'ves       ', 'a intentar                                        ', '5.000  ', '56    ', '180');
INSERT INTO public.familiar VALUES (18, 'fami sin soli y sin bene 3    ', '2000-08-07', 'es        ', 'por ultima                                        ', '9.444  ', '75    ', '143');
INSERT INTO public.familiar VALUES (19, 'fami sin soli y sin bene 4    ', '2014-08-11', 'el final  ', 'vez                                               ', '1.230  ', '70    ', '100');


--
-- Data for Name: familiar_solicitud; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.familiar_solicitud VALUES (9, 1, 56);
INSERT INTO public.familiar_solicitud VALUES (10, 2, 56);
INSERT INTO public.familiar_solicitud VALUES (11, 3, 57);
INSERT INTO public.familiar_solicitud VALUES (12, 4, 57);
INSERT INTO public.familiar_solicitud VALUES (13, 5, 57);
INSERT INTO public.familiar_solicitud VALUES (16, 8, 59);
INSERT INTO public.familiar_solicitud VALUES (17, 9, 59);
INSERT INTO public.familiar_solicitud VALUES (18, 10, 59);
INSERT INTO public.familiar_solicitud VALUES (19, 14, 60);
INSERT INTO public.familiar_solicitud VALUES (20, 15, 60);
INSERT INTO public.familiar_solicitud VALUES (21, 16, 61);
INSERT INTO public.familiar_solicitud VALUES (22, 17, 61);
INSERT INTO public.familiar_solicitud VALUES (23, 18, 61);
INSERT INTO public.familiar_solicitud VALUES (24, 19, 61);


--
-- Data for Name: permiso; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.permiso VALUES (1, 'Gestion de Usuario            ');
INSERT INTO public.permiso VALUES (2, 'Solicitante                   ');
INSERT INTO public.permiso VALUES (3, 'Gestion de Solicitud          ');
INSERT INTO public.permiso VALUES (4, 'Reportes                      ');


--
-- Data for Name: persona; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.persona VALUES (34, '45689989', 'prueba benefi                 ', '2018-11-23', 'Hija(o)   ', '0 ', '30', '30', 'M  ');
INSERT INTO public.persona VALUES (33, '        ', 'ana baske                     ', '2016-06-15', 'Tia(o)    ', '18', '32', '28', 'L  ');
INSERT INTO public.persona VALUES (35, '34538758', 'prueba                        ', '2018-11-15', 'Tia(o)    ', '0 ', '23', '10', 'S  ');
INSERT INTO public.persona VALUES (32, '19000000', 'Esdinaldo Salas               ', '2007-02-05', 'Nieta(o)  ', '  ', '29', '22', 'M  ');
INSERT INTO public.persona VALUES (37, '46823796', 'Benefi con solicitante        ', '2014-12-04', 'Suegra(o) ', '  ', '18', '14', '12 ');
INSERT INTO public.persona VALUES (38, '00788690', 'sin soli y sin bene           ', '2006-02-22', 'Nieta(o)  ', '13', '36', '34', '2XL');


--
-- Data for Name: solicitante; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.solicitante VALUES (35, '12365955', 'prueba                        ', '2018-11-23', 'Masculino', 'prueba                                                                                              ', '0414-3659863', '0251-2736989', 'prueba@gmil.com               ', 'Unión           ', 'Soltera(o)   ', 'ninguna                                           ', 'Si', 'adwqwd                                            ', 0, '1.800 ');
INSERT INTO public.solicitante VALUES (36, '6864884 ', 'lo que no sabemos             ', '2018-11-02', 'Femenino ', 'calle 3 entre 4 y 5 a lo evera                                                                      ', '0416-3267562', '0251-7896532', 'freyte@hotmail.com            ', 'El Cuji         ', 'Soltera(o)   ', 'nnguna                                            ', 'No', 'hogares                                           ', 7, '2.000 ');
INSERT INTO public.solicitante VALUES (37, '65865256', 'pruB_Familiar_Solicitante     ', '2018-11-27', 'Femenino ', 'calle prueba familiar sin solicitante                                                               ', '0416-3566364', '            ', 'fami_sin@solicitario.com      ', 'Unión           ', 'Divorciada(o)', 'prueba fami sin solicitante pero con beneficiario ', 'Si', 'familiar sin solicitante                          ', 13, '1.880 ');
INSERT INTO public.solicitante VALUES (33, '19640186', 'Deibys Freytez                ', '1989-09-14', 'Masculino', 'calle 3 entre carrera 4 y 5 Barrio la Victoria                                                      ', '0424-5684643', '0251-2736860', 'deibysfreytez@gmail.com       ', 'Catedral        ', 'Conviviente  ', 'estudiante obrero                                 ', 'Si', 'hogares patrias                                   ', 3, '2.800 ');
INSERT INTO public.solicitante VALUES (34, '12942778', 'carina navos                  ', '2015-06-16', 'Femenino ', 'victoria solicitante existe pero no el beneficiario                                                 ', '0424-0000000', '0251-2736860', 'solicitante_sin@benefi.com    ', 'Santa Rosa      ', 'Casada(o)    ', 'solicitante sin beneficiario                      ', 'No', 'horages patria                                    ', 0, '1.800 ');
INSERT INTO public.solicitante VALUES (38, '00025655', 'Sin Soli y Sin Bene           ', '2006-03-16', 'Femenino ', 'sin Solicit y Sin benefiario                                                                        ', '0424-5698799', '0251-8945632', 'sin_soli_sin_bene@ejemplo.com ', 'Tamaca          ', 'Casada(o)    ', 'Quin sabe sin solicitante y sin bene              ', 'Si', 'ninguno                                           ', 14, '4.500 ');


--
-- Data for Name: solicitud; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.solicitud VALUES (48, 33, 5, 32, '2018-11-23', 'radio                         ', 'Rancho     ', 'Otros    ', 'Otros    ', 'Tierra  ', 'En espera');
INSERT INTO public.solicitud VALUES (49, 33, 1, 32, '2018-11-23', 'conocida                      ', 'Casa       ', 'Propia   ', 'Bahareque', 'Cerámica', 'En espera');
INSERT INTO public.solicitud VALUES (47, 33, 3, 32, '2018-11-23', 'amigo                         ', 'Casa       ', 'Alojada  ', 'Bloque   ', 'Cemento ', 'Aprobado ');
INSERT INTO public.solicitud VALUES (50, 34, 6, 33, '2018-11-23', 'trabajadora                   ', 'Casa       ', 'Alojada  ', 'Bloque   ', 'Granito ', 'Aprobado ');
INSERT INTO public.solicitud VALUES (51, 35, 3, 34, '2018-11-23', 'conocida                      ', 'Apartamento', 'Alquilada', 'Zinc     ', 'Cerámica', 'En espera');
INSERT INTO public.solicitud VALUES (52, 33, 2, 32, '2018-11-24', 'conocida                      ', 'Quinta     ', 'Otros    ', 'Otros    ', 'Granito ', 'En espera');
INSERT INTO public.solicitud VALUES (53, 34, 6, 33, '2018-11-24', 'conocida                      ', 'Apartamento', 'Alquilada', 'Bahareque', 'Cerámica', 'En espera');
INSERT INTO public.solicitud VALUES (54, 33, 1, 32, '2018-11-24', 'trabajadora                   ', 'Apartamento', 'Propia   ', 'Zinc     ', 'Tierra  ', 'En espera');
INSERT INTO public.solicitud VALUES (55, 33, 1, 32, '2018-11-24', 'trabajadora                   ', 'Apartamento', 'Alquilada', 'Bloque   ', 'Granito ', 'En espera');
INSERT INTO public.solicitud VALUES (56, 34, 2, 33, '2018-11-24', 'trabajadora                   ', 'Apartamento', 'Alojada  ', 'Zinc     ', 'Cemento ', 'En espera');
INSERT INTO public.solicitud VALUES (57, 36, 5, 35, '2018-11-24', 'trabajadora                   ', 'Apartamento', 'Alojada  ', 'Bloque   ', 'Granito ', 'En espera');
INSERT INTO public.solicitud VALUES (60, 34, 2, 37, '2018-12-02', 'radio                         ', 'Casa       ', 'Alquilada', 'Zinc     ', 'Cerámica', 'En espera');
INSERT INTO public.solicitud VALUES (61, 38, 2, 38, '2018-12-02', 'Amiga                         ', 'Quinta     ', 'Otros    ', 'Zinc     ', 'Cemento ', 'En espera');
INSERT INTO public.solicitud VALUES (59, 37, 2, 32, '2018-12-02', 'cualquier cosa                ', 'Quinta     ', 'Alojada  ', 'Otros    ', 'Cemento ', 'Aprobado ');


--
-- Data for Name: tipo_solicitud; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.tipo_solicitud VALUES (1, 'Canastillas                                  ', 'Solo Embarazada                              ', '1');
INSERT INTO public.tipo_solicitud VALUES (5, 'Enseres y Ayudas Tecnicas                    ', 'Coche                                        ', '1');
INSERT INTO public.tipo_solicitud VALUES (6, 'Ayudas Medicas                               ', 'Insumos                                      ', '1');
INSERT INTO public.tipo_solicitud VALUES (3, 'Ayudas Medicas                               ', 'Cirugía                                      ', '1');
INSERT INTO public.tipo_solicitud VALUES (4, 'Enseres y Ayudas Tecnicas                    ', 'Cama                                         ', '0');
INSERT INTO public.tipo_solicitud VALUES (2, 'Ayudas Medicas                               ', 'Alimentacion                                 ', '1');


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuario VALUES (34, 'ruth                          ', '12345678', '0416-0000000', '                              ', 'ninguno             ', 'ruth                ', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '1542982577.png                                    ', 1);
INSERT INTO public.usuario VALUES (7, 'deibys                        ', '19640186', '0424-5684643', 'deibysfreytez@gmail.com       ', 'Programador         ', 'deibys              ', 'f9fb27c13f249a644aac72f00fb98f304bda86ac6534746f037c66f5726d1efb', '1545251336.jpg                                    ', 1);


--
-- Data for Name: usuario_permiso; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuario_permiso VALUES (165, 34, 1);
INSERT INTO public.usuario_permiso VALUES (166, 34, 2);
INSERT INTO public.usuario_permiso VALUES (167, 34, 3);
INSERT INTO public.usuario_permiso VALUES (168, 34, 4);
INSERT INTO public.usuario_permiso VALUES (169, 7, 1);
INSERT INTO public.usuario_permiso VALUES (170, 7, 2);
INSERT INTO public.usuario_permiso VALUES (171, 7, 3);
INSERT INTO public.usuario_permiso VALUES (172, 7, 4);


--
-- Data for Name: usuario_solicitud; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuario_solicitud VALUES (46, 47, 7, '2018-11-23', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (47, 48, 7, '2018-11-23', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (48, 49, 7, '2018-11-23', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (49, 47, 7, '2018-11-23', 'Aprobo la Solicitud                          ');
INSERT INTO public.usuario_solicitud VALUES (50, 50, 7, '2018-11-23', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (51, 50, 7, '2018-11-23', 'Aprobo la Solicitud                          ');
INSERT INTO public.usuario_solicitud VALUES (52, 51, 7, '2018-11-23', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (53, 52, 7, '2018-11-24', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (54, 53, 7, '2018-11-24', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (55, 54, 7, '2018-11-24', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (56, 55, 7, '2018-11-24', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (57, 56, 7, '2018-11-24', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (58, 57, 7, '2018-11-24', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (60, 59, 7, '2018-12-02', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (61, 60, 7, '2018-12-02', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (62, 61, 7, '2018-12-02', 'Registro de Solicitud                        ');
INSERT INTO public.usuario_solicitud VALUES (63, 59, 7, '2018-12-19', 'Aprobo la Solicitud                          ');


--
-- Data for Name: visita_social; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: beneficiario_id_beneficiario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.beneficiario_id_beneficiario_seq', 38, true);


--
-- Name: familiar_id_familiar_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.familiar_id_familiar_seq', 19, true);


--
-- Name: familiar_solicitud_id_familiar_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.familiar_solicitud_id_familiar_solicitud_seq', 24, true);


--
-- Name: permiso_id_permiso_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permiso_id_permiso_seq', 8, true);


--
-- Name: solicitante_id_solicitante_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitante_id_solicitante_seq', 38, true);


--
-- Name: solicitud_numero_control_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitud_numero_control_seq', 61, true);


--
-- Name: tipo_solicitud_id_tipo_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_solicitud_id_tipo_solicitud_seq', 6, true);


--
-- Name: usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_id_usuario_seq', 34, true);


--
-- Name: usuario_permiso_id_usuario_permiso_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_permiso_id_usuario_permiso_seq', 172, true);


--
-- Name: usuario_solicitud_id_usuario_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_solicitud_id_usuario_solicitud_seq', 63, true);


--
-- Name: visita_social_id_visita_social_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.visita_social_id_visita_social_seq', 14, true);


--
-- Name: familiar familiar_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familiar
    ADD CONSTRAINT familiar_pkey PRIMARY KEY (id_familiar);


--
-- Name: familiar_solicitud familiar_solicitud_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familiar_solicitud
    ADD CONSTRAINT familiar_solicitud_pkey PRIMARY KEY (id_familiar_solicitud);


--
-- Name: persona pk_id_beneficiario; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT pk_id_beneficiario PRIMARY KEY (id_persona);


--
-- Name: permiso pk_id_permiso; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.permiso
    ADD CONSTRAINT pk_id_permiso PRIMARY KEY (id_permiso);


--
-- Name: solicitante pk_id_solicitante; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitante
    ADD CONSTRAINT pk_id_solicitante PRIMARY KEY (id_solicitante);


--
-- Name: usuario pk_id_usuario; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT pk_id_usuario PRIMARY KEY (id_usuario);


--
-- Name: usuario_permiso pk_id_usuario_permiso; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_permiso
    ADD CONSTRAINT pk_id_usuario_permiso PRIMARY KEY (id_usuario_permiso);


--
-- Name: visita_social pk_id_visita_social; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visita_social
    ADD CONSTRAINT pk_id_visita_social PRIMARY KEY (id_visita_social);


--
-- Name: solicitud pk_solicitud; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud
    ADD CONSTRAINT pk_solicitud PRIMARY KEY (id_solicitud);


--
-- Name: tipo_solicitud tipo_solicitud_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tipo_solicitud
    ADD CONSTRAINT tipo_solicitud_pkey PRIMARY KEY (id_tipo_solicitud);


--
-- Name: solicitante u_cedula; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitante
    ADD CONSTRAINT u_cedula UNIQUE (cedula);


--
-- Name: persona ub_cedula; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT ub_cedula UNIQUE (cedula_p);


--
-- Name: usuario_solicitud usuario_solicitud_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_solicitud
    ADD CONSTRAINT usuario_solicitud_pkey PRIMARY KEY (id_usuario_solicitud);


--
-- Name: familiar_solicitud fk_familiar_solicitud_familiar; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familiar_solicitud
    ADD CONSTRAINT fk_familiar_solicitud_familiar FOREIGN KEY (id_familiar) REFERENCES public.familiar(id_familiar) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: familiar_solicitud fk_familiar_solicitud_solicitud; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familiar_solicitud
    ADD CONSTRAINT fk_familiar_solicitud_solicitud FOREIGN KEY (id_solicitud) REFERENCES public.solicitud(id_solicitud) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: solicitud fk_solicitud_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud
    ADD CONSTRAINT fk_solicitud_persona FOREIGN KEY (id_persona) REFERENCES public.persona(id_persona) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: solicitud fk_solicitud_solicitante; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud
    ADD CONSTRAINT fk_solicitud_solicitante FOREIGN KEY (id_solicitante) REFERENCES public.solicitante(id_solicitante) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: solicitud fk_solicitud_tipo_solicitud; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud
    ADD CONSTRAINT fk_solicitud_tipo_solicitud FOREIGN KEY (id_tipo_solicitud) REFERENCES public.tipo_solicitud(id_tipo_solicitud) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: usuario_permiso fk_usuario_permiso; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_permiso
    ADD CONSTRAINT fk_usuario_permiso FOREIGN KEY (id_permiso) REFERENCES public.permiso(id_permiso) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: usuario_permiso fk_usuario_permiso_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_permiso
    ADD CONSTRAINT fk_usuario_permiso_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: usuario_solicitud fk_usuario_solicitud_solicitud; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_solicitud
    ADD CONSTRAINT fk_usuario_solicitud_solicitud FOREIGN KEY (id_solicitud) REFERENCES public.solicitud(id_solicitud) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: usuario_solicitud fk_usuario_solicitud_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario_solicitud
    ADD CONSTRAINT fk_usuario_solicitud_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: visita_social fk_visita_social_persona; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visita_social
    ADD CONSTRAINT fk_visita_social_persona FOREIGN KEY (id_persona) REFERENCES public.persona(id_persona) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

