--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;

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
-- Name: product; Type: TABLE; Schema: public; Owner: marcelo; Tablespace: 
--

CREATE TABLE public.product (
    id integer NOT NULL,
    name character varying(50),
    product_type_id integer,
    price money
);


ALTER TABLE public.product OWNER TO marcelo;

--
-- Name: product_id_seq; Type: SEQUENCE; Schema: public; Owner: marcelo
--

CREATE SEQUENCE public.product_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_id_seq OWNER TO marcelo;

--
-- Name: product_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: marcelo
--

ALTER SEQUENCE public.product_id_seq OWNED BY public.product.id;


--
-- Name: product_type; Type: TABLE; Schema: public; Owner: marcelo; Tablespace: 
--

CREATE TABLE public.product_type (
    id smallint NOT NULL,
    name character varying(50) NOT NULL,
    tax numeric(5,2) NOT NULL
);


ALTER TABLE public.product_type OWNER TO marcelo;

--
-- Name: product_type_id_seq; Type: SEQUENCE; Schema: public; Owner: marcelo
--

CREATE SEQUENCE public.product_type_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.product_type_id_seq OWNER TO marcelo;

--
-- Name: product_type_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: marcelo
--

ALTER SEQUENCE public.product_type_id_seq OWNED BY public.product_type.id;


--
-- Name: sales; Type: TABLE; Schema: public; Owner: marcelo; Tablespace: 
--

CREATE TABLE public.sales (
    id integer NOT NULL,
    purchase_date timestamp without time zone
);


ALTER TABLE public.sales OWNER TO marcelo;

--
-- Name: sales_id_seq; Type: SEQUENCE; Schema: public; Owner: marcelo
--

CREATE SEQUENCE public.sales_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sales_id_seq OWNER TO marcelo;

--
-- Name: sales_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: marcelo
--

ALTER SEQUENCE public.sales_id_seq OWNED BY public.sales.id;


--
-- Name: sales_products; Type: TABLE; Schema: public; Owner: marcelo; Tablespace: 
--

CREATE TABLE public.sales_products (
    id integer NOT NULL,
    product_id integer NOT NULL,
    value_product money,
    value_tax double precision,
    sales_id integer,
    quantity integer
);


ALTER TABLE public.sales_products OWNER TO marcelo;

--
-- Name: sales_products_id_seq; Type: SEQUENCE; Schema: public; Owner: marcelo
--

CREATE SEQUENCE public.sales_products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sales_products_id_seq OWNER TO marcelo;

--
-- Name: sales_products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: marcelo
--

ALTER SEQUENCE public.sales_products_id_seq OWNED BY public.sales_products.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: marcelo
--

ALTER TABLE ONLY public.product ALTER COLUMN id SET DEFAULT nextval('public.product_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: marcelo
--

ALTER TABLE ONLY public.product_type ALTER COLUMN id SET DEFAULT nextval('public.product_type_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: marcelo
--

ALTER TABLE ONLY public.sales ALTER COLUMN id SET DEFAULT nextval('public.sales_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: marcelo
--

ALTER TABLE ONLY public.sales_products ALTER COLUMN id SET DEFAULT nextval('public.sales_products_id_seq'::regclass);


--
-- Data for Name: product; Type: TABLE DATA; Schema: public; Owner: marcelo
--

COPY public.product (id, name, product_type_id, price) FROM stdin;
2	Roupão	7	$2,450.25
1	Serra elétrica	23	$358.50
\.


--
-- Name: product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: marcelo
--

SELECT pg_catalog.setval('public.product_id_seq', 2, true);


--
-- Data for Name: product_type; Type: TABLE DATA; Schema: public; Owner: marcelo
--

COPY public.product_type (id, name, tax) FROM stdin;
20	Higiene	14.00
14	Eletrônico	14.50
17	Limpeza	18.40
16	Frios	12.25
7	Cama, Mesa e Banho	24.00
23	Maquinas	21.14
18	Bazar	25.25
\.


--
-- Name: product_type_id_seq; Type: SEQUENCE SET; Schema: public; Owner: marcelo
--

SELECT pg_catalog.setval('public.product_type_id_seq', 24, true);


--
-- Data for Name: sales; Type: TABLE DATA; Schema: public; Owner: marcelo
--

COPY public.sales (id, purchase_date) FROM stdin;
28	2021-02-25 01:38:40
29	2021-02-25 02:24:59
43	2021-02-25 03:10:18
\.


--
-- Name: sales_id_seq; Type: SEQUENCE SET; Schema: public; Owner: marcelo
--

SELECT pg_catalog.setval('public.sales_id_seq', 49, true);


--
-- Data for Name: sales_products; Type: TABLE DATA; Schema: public; Owner: marcelo
--

COPY public.sales_products (id, product_id, value_product, value_tax, sales_id, quantity) FROM stdin;
17	1	$358.50	75.7869000000000028	28	4
18	2	$2,450.25	588.059999999999945	28	2
19	2	$2,450.25	588.059999999999945	29	1
20	2	$2,450.25	588.059999999999945	29	1
21	2	$2,450.25	588.059999999999945	29	1
22	2	$2,450.25	588.059999999999945	29	1
23	2	$2,450.25	588.059999999999945	29	1
24	2	$2,450.25	588.059999999999945	29	1
25	2	$2,450.25	588.059999999999945	29	1
43	1	$358.50	75.7869000000000028	43	5
\.


--
-- Name: sales_products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: marcelo
--

SELECT pg_catalog.setval('public.sales_products_id_seq', 53, true);


--
-- Name: pk_product_type; Type: CONSTRAINT; Schema: public; Owner: marcelo; Tablespace: 
--

ALTER TABLE ONLY public.product_type
    ADD CONSTRAINT pk_product_type PRIMARY KEY (id);


--
-- Name: product_pk; Type: CONSTRAINT; Schema: public; Owner: marcelo; Tablespace: 
--

ALTER TABLE ONLY public.product
    ADD CONSTRAINT product_pk PRIMARY KEY (id);


--
-- Name: sales_pk; Type: CONSTRAINT; Schema: public; Owner: marcelo; Tablespace: 
--

ALTER TABLE ONLY public.sales
    ADD CONSTRAINT sales_pk PRIMARY KEY (id);


--
-- Name: sales_products_pk; Type: CONSTRAINT; Schema: public; Owner: marcelo; Tablespace: 
--

ALTER TABLE ONLY public.sales_products
    ADD CONSTRAINT sales_products_pk PRIMARY KEY (id);


--
-- Name: sales_products_sales_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: marcelo
--

ALTER TABLE ONLY public.sales_products
    ADD CONSTRAINT sales_products_sales_id_fk FOREIGN KEY (sales_id) REFERENCES public.sales(id) ON DELETE CASCADE;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

