--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: condicion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE condicion (
    id integer NOT NULL,
    nombre text
);


ALTER TABLE public.condicion OWNER TO postgres;

--
-- Name: condicion_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE condicion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.condicion_id_seq OWNER TO postgres;

--
-- Name: condicion_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE condicion_id_seq OWNED BY condicion.id;


--
-- Name: estados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE estados (
    id integer NOT NULL,
    nombre text
);


ALTER TABLE public.estados OWNER TO postgres;

--
-- Name: estados_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE estados_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.estados_id_seq OWNER TO postgres;

--
-- Name: estados_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE estados_id_seq OWNED BY estados.id;


--
-- Name: foto; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE foto (
    id integer NOT NULL,
    id_item numeric,
    nombre text
);


ALTER TABLE public.foto OWNER TO postgres;

--
-- Name: foto_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE foto_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.foto_id_seq OWNER TO postgres;

--
-- Name: foto_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE foto_id_seq OWNED BY foto.id;


--
-- Name: genero; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE genero (
    id integer NOT NULL,
    nombre text
);


ALTER TABLE public.genero OWNER TO postgres;

--
-- Name: genero_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE genero_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.genero_id_seq OWNER TO postgres;

--
-- Name: genero_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE genero_id_seq OWNED BY genero.id;


--
-- Name: idioma; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE idioma (
    id integer NOT NULL,
    nombre text
);


ALTER TABLE public.idioma OWNER TO postgres;

--
-- Name: idioma_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE idioma_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.idioma_id_seq OWNER TO postgres;

--
-- Name: idioma_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE idioma_id_seq OWNED BY idioma.id;


--
-- Name: item; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE item (
    nombre text,
    editorial text,
    precio integer,
    escritor text,
    dibujante text,
    numero text,
    saga text,
    estado integer,
    id integer NOT NULL,
    id_user integer,
    condicion integer,
    genero integer,
    idioma integer,
    descripcion text
);


ALTER TABLE public.item OWNER TO postgres;

--
-- Name: item_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE item_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.item_id_seq OWNER TO postgres;

--
-- Name: item_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE item_id_seq OWNED BY item.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE users (
    id text NOT NULL,
    name text,
    password text,
    facebook numeric,
    rol numeric,
    email text,
    telefono text,
    reputacion integer,
    foto text
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: visitas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE visitas (
    id integer NOT NULL,
    fecha date,
    contador numeric,
    pagina text
);


ALTER TABLE public.visitas OWNER TO postgres;

--
-- Name: visitas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE visitas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.visitas_id_seq OWNER TO postgres;

--
-- Name: visitas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE visitas_id_seq OWNED BY visitas.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY condicion ALTER COLUMN id SET DEFAULT nextval('condicion_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY estados ALTER COLUMN id SET DEFAULT nextval('estados_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY foto ALTER COLUMN id SET DEFAULT nextval('foto_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY genero ALTER COLUMN id SET DEFAULT nextval('genero_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY idioma ALTER COLUMN id SET DEFAULT nextval('idioma_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY item ALTER COLUMN id SET DEFAULT nextval('item_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY visitas ALTER COLUMN id SET DEFAULT nextval('visitas_id_seq'::regclass);


--
-- Data for Name: condicion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY condicion (id, nombre) FROM stdin;
4	Nuevo
5	Usado casi nuevo
6	Usado aceptable
7	Usado en mal estado
\.


--
-- Name: condicion_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('condicion_id_seq', 7, true);


--
-- Data for Name: estados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY estados (id, nombre) FROM stdin;
1	Compra
2	Venta
3	Reserva
\.


--
-- Name: estados_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('estados_id_seq', 3, true);


--
-- Data for Name: foto; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY foto (id, id_item, nombre) FROM stdin;
26	5	batman_comic_book_cover_by_tangerineismine-d35nizv.jpg
27	5	images.jpeg
29	6	iron-man-she-hulk-maria-hill-wallpaper-35-l.jpg
30	6	iron-man.jpg
31	5	batman_comic_book_cover_by_tangerineismine-d35nizv (1).jpg
32	8	Comic_Books.png
33	8	images.jpeg
34	8	iron-man.jpg
35	8	iron-man-she-hulk-maria-hill-wallpaper-35-l.jpg
36	11	images.jpeg
37	11	iron-man-she-hulk-maria-hill-wallpaper-35-l.jpg
38	11	iron-man.jpg
\.


--
-- Name: foto_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('foto_id_seq', 38, true);


--
-- Data for Name: genero; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY genero (id, nombre) FROM stdin;
1	Ficción
2	Aventuras 
3	Misterio y serie negra 
4	Romántica 
5	Historieta policial 
6	Histórica 
\.


--
-- Name: genero_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('genero_id_seq', 6, true);


--
-- Data for Name: idioma; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY idioma (id, nombre) FROM stdin;
1	Español
2	Ingles
3	Ruso
4	Japones
\.


--
-- Name: idioma_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('idioma_id_seq', 4, true);


--
-- Data for Name: item; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY item (nombre, editorial, precio, escritor, dibujante, numero, saga, estado, id, id_user, condicion, genero, idioma, descripcion) FROM stdin;
Batman Giant-Sized Anniversary Issue!	Alma	4990	Grant Morrizon	Tony Daniel	700	None	2	5	1	5	\N	\N	\N
The Invincible Iron Man	tres norte	7500	Stan Lee	Don Heck	100	None	2	6	1	6	\N	\N	\N
test	lala	5000	lala	lala	3343	None	2	8	1	4	\N	\N	\N
test3	tres norte	4990					1	9	1	4	\N	\N	\N
test lala	lala	5000					1	10	1	4	1	1	
		\N					1	11	1	4	1	1	sadasd
\.


--
-- Name: item_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('item_id_seq', 11, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY users (id, name, password, facebook, rol, email, telefono, reputacion, foto) FROM stdin;
1	admin	7110eda4d09e062aa5e4a390b0a572ac0d2c0220	0	1	admin@tucomic.cl	12345678	0	\N
2	l30bravo	4d13fcc6eda389d4d679602171e11593eadae9b9	1	1	lala@mail.cl	1234	1	\N
3	taufic	4d13fcc6eda389d4d679602171e11593eadae9b9	0	1	taukic@mail.cl	123455	1	foto
4	test	40bd001563085fc35165329ea1ff5c5ecbdbbeef	0	2	test@mail.cl	123	0	foto
\.


--
-- Data for Name: visitas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY visitas (id, fecha, contador, pagina) FROM stdin;
1	2013-11-09	6	Home
2	2013-11-11	8	Home
3	2013-11-12	1	Home
4	2013-11-13	5	Home
\.


--
-- Name: visitas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('visitas_id_seq', 4, true);


--
-- Name: condicion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY condicion
    ADD CONSTRAINT condicion_pkey PRIMARY KEY (id);


--
-- Name: estados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY estados
    ADD CONSTRAINT estados_pkey PRIMARY KEY (id);


--
-- Name: foto_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY foto
    ADD CONSTRAINT foto_pkey PRIMARY KEY (id);


--
-- Name: genero_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY genero
    ADD CONSTRAINT genero_pkey PRIMARY KEY (id);


--
-- Name: idioma_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY idioma
    ADD CONSTRAINT idioma_pkey PRIMARY KEY (id);


--
-- Name: item_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY item
    ADD CONSTRAINT item_pkey PRIMARY KEY (id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: visitas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY visitas
    ADD CONSTRAINT visitas_pkey PRIMARY KEY (id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

