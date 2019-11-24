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
-- Name: beneficiario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.beneficiario (
    id_beneficiario integer NOT NULL,
    cedula_b character(8),
    nombre_apellido_b character(30),
    fecha_nacimiento_b date,
    semana_embarazo character(2)
);


ALTER TABLE public.beneficiario OWNER TO postgres;

--
-- Name: COLUMN beneficiario.id_beneficiario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.beneficiario.id_beneficiario IS 'Es el identificador de la tabla persona, es único, auto incrementable y clave primaria';


--
-- Name: COLUMN beneficiario.cedula_b; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.beneficiario.cedula_b IS 'La cedula del  beneficiario ';


--
-- Name: COLUMN beneficiario.nombre_apellido_b; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.beneficiario.nombre_apellido_b IS 'Los nombres del  beneficiario ';


--
-- Name: COLUMN beneficiario.semana_embarazo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.beneficiario.semana_embarazo IS 'Semana de embarazo en caso de solicitud de canastilla ';


--
-- Name: beneficiario_id_beneficiario_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.beneficiario_id_beneficiario_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.beneficiario_id_beneficiario_seq OWNER TO postgres;

--
-- Name: beneficiario_id_beneficiario_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.beneficiario_id_beneficiario_seq OWNED BY public.beneficiario.id_beneficiario;


--
-- Name: bitacora; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bitacora (
    id_bitacora integer NOT NULL,
    id_usuario integer NOT NULL,
    fecha_b date,
    accion character(10),
    descripcion character(45)
);


ALTER TABLE public.bitacora OWNER TO postgres;

--
-- Name: bitacora_id_bitacora_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bitacora_id_bitacora_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bitacora_id_bitacora_seq OWNER TO postgres;

--
-- Name: bitacora_id_bitacora_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bitacora_id_bitacora_seq OWNED BY public.bitacora.id_bitacora;


--
-- Name: familiar; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.familiar (
    id_familiar integer NOT NULL,
    nombre_apellido_f character(30),
    fecha_nacimiento_f date,
    parentesco_f character(10),
    ocupacion_f character(50),
    observacion_f character(45)
);


ALTER TABLE public.familiar OWNER TO postgres;

--
-- Name: familiar_id_familiar_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.familiar_id_familiar_seq
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
    fecha_nacimiento date,
    direccion character(100) NOT NULL,
    telefono_1 character(11) NOT NULL,
    telefono_2 character(11),
    parroquia character(16) NOT NULL,
    ocupacion character(50),
    ingreso character(7),
    estado_civil character(13)
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
-- Name: COLUMN solicitante.parroquia; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.parroquia IS 'El área en donde se ubica';


--
-- Name: COLUMN solicitante.ocupacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.solicitante.ocupacion IS 'A que se dedica el solicitante actualmente';


--
-- Name: solicitante_id_solicitante_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.solicitante_id_solicitante_seq
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
    id_beneficiario integer NOT NULL,
    id_usuario integer NOT NULL,
    fecha date,
    tipo_vivienda character(11),
    tenencia character(9),
    construccion character(9),
    tipo_piso character(8),
    estado character(9) NOT NULL,
    diagnostico character(45),
    observacion character(100)
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
    descripcion character(45),
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
    telefono character(12),
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
-- Name: visita_social; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.visita_social (
    id_visita_social integer NOT NULL,
    id_solicitud integer NOT NULL,
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
-- Name: COLUMN visita_social.id_solicitud; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.visita_social.id_solicitud IS 'Numero de control para identificarlo y archivarlo';


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
-- Name: beneficiario id_beneficiario; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.beneficiario ALTER COLUMN id_beneficiario SET DEFAULT nextval('public.beneficiario_id_beneficiario_seq'::regclass);


--
-- Name: bitacora id_bitacora; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bitacora ALTER COLUMN id_bitacora SET DEFAULT nextval('public.bitacora_id_bitacora_seq'::regclass);


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
-- Name: visita_social id_visita_social; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visita_social ALTER COLUMN id_visita_social SET DEFAULT nextval('public.visita_social_id_visita_social_seq'::regclass);


--
-- Data for Name: beneficiario; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: bitacora; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: familiar; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: familiar_solicitud; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: permiso; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.permiso VALUES (1, 'Gestion de Usuario            ');
INSERT INTO public.permiso VALUES (2, 'Solicitante                   ');
INSERT INTO public.permiso VALUES (3, 'Gestion de Solicitud          ');


--
-- Data for Name: solicitante; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: solicitud; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: tipo_solicitud; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuario VALUES (7, 'deibys                        ', '19640186', '0424-5684643', 'deibysfreytez@gmail.com       ', 'Programador         ', 'deibys              ', 'f9fb27c13f249a644aac72f00fb98f304bda86ac6534746f037c66f5726d1efb', '1545251336.jpg                                    ', 1);
INSERT INTO public.usuario VALUES (36, 'usuario                       ', '00000000', '0424-0000000', 'nada@gmail.com                ', 'Usuario             ', 'usuario             ', '9250e222c4c71f0c58d4c54b50a880a312e9f9fed55d5c3aa0b0e860ded99165', '1557152188.jpg                                    ', 1);
INSERT INTO public.usuario VALUES (37, 'Administrador                 ', '11111111', '0426-1111111', '00000@gmail.com               ', 'Administrador       ', 'administrador       ', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1557156842.png                                    ', 1);


--
-- Data for Name: usuario_permiso; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.usuario_permiso VALUES (169, 7, 1);
INSERT INTO public.usuario_permiso VALUES (170, 7, 2);
INSERT INTO public.usuario_permiso VALUES (171, 7, 3);
INSERT INTO public.usuario_permiso VALUES (176, 36, 2);
INSERT INTO public.usuario_permiso VALUES (177, 37, 1);
INSERT INTO public.usuario_permiso VALUES (178, 37, 2);
INSERT INTO public.usuario_permiso VALUES (179, 37, 3);


--
-- Data for Name: visita_social; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: beneficiario_id_beneficiario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.beneficiario_id_beneficiario_seq', 43, true);


--
-- Name: bitacora_id_bitacora_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bitacora_id_bitacora_seq', 34, true);


--
-- Name: familiar_id_familiar_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.familiar_id_familiar_seq', 34, true);


--
-- Name: familiar_solicitud_id_familiar_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.familiar_solicitud_id_familiar_solicitud_seq', 39, true);


--
-- Name: permiso_id_permiso_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.permiso_id_permiso_seq', 8, true);


--
-- Name: solicitante_id_solicitante_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitante_id_solicitante_seq', 44, true);


--
-- Name: solicitud_numero_control_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.solicitud_numero_control_seq', 74, true);


--
-- Name: tipo_solicitud_id_tipo_solicitud_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tipo_solicitud_id_tipo_solicitud_seq', 11, true);


--
-- Name: usuario_id_usuario_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_id_usuario_seq', 37, true);


--
-- Name: usuario_permiso_id_usuario_permiso_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.usuario_permiso_id_usuario_permiso_seq', 179, true);


--
-- Name: visita_social_id_visita_social_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.visita_social_id_visita_social_seq', 25, true);


--
-- Name: bitacora bitacora_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bitacora
    ADD CONSTRAINT bitacora_pkey PRIMARY KEY (id_bitacora);


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
-- Name: beneficiario pk_id_beneficiario; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.beneficiario
    ADD CONSTRAINT pk_id_beneficiario PRIMARY KEY (id_beneficiario);


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
-- Name: beneficiario ub_cedula; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.beneficiario
    ADD CONSTRAINT ub_cedula UNIQUE (cedula_b);


--
-- Name: bitacora fk_bitacora_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bitacora
    ADD CONSTRAINT fk_bitacora_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- Name: solicitud fk_solicitud_beneficiario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud
    ADD CONSTRAINT fk_solicitud_beneficiario FOREIGN KEY (id_beneficiario) REFERENCES public.beneficiario(id_beneficiario) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- Name: solicitud fk_solicitud_usuario; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.solicitud
    ADD CONSTRAINT fk_solicitud_usuario FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario) ON UPDATE CASCADE ON DELETE CASCADE;


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
-- Name: visita_social fk_visita_social_solicitud; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visita_social
    ADD CONSTRAINT fk_visita_social_solicitud FOREIGN KEY (id_solicitud) REFERENCES public.solicitud(id_solicitud) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

