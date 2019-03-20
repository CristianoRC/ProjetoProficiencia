--
-- PostgreSQL database dump
--

-- Dumped from database version 11.2 (Debian 11.2-1.pgdg90+1)
-- Dumped by pg_dump version 11.2 (Debian 11.2-1.pgdg90+1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: cliente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cliente (
    cpf character varying(15) NOT NULL,
    nome character varying(60) NOT NULL,
    email character varying(50) NOT NULL,
    telefone character varying(20),
    deletado boolean NOT NULL
);


ALTER TABLE public.cliente OWNER TO postgres;

--
-- Name: locacao; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.locacao (
    id integer NOT NULL,
    cliente character varying(20) NOT NULL,
    veiculo character varying(8) NOT NULL,
    data_inicial date NOT NULL,
    data_final date NOT NULL,
    devolvido boolean NOT NULL
);


ALTER TABLE public.locacao OWNER TO postgres;

--
-- Name: locacao_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.locacao_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.locacao_id_seq OWNER TO postgres;

--
-- Name: locacao_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.locacao_id_seq OWNED BY public.locacao.id;


--
-- Name: veiculo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.veiculo (
    placa character varying(8) NOT NULL,
    marca character varying(30) NOT NULL,
    modelo character varying(60) NOT NULL,
    cor character varying(25) NOT NULL,
    diaria numeric(5,2) NOT NULL,
    disponivel boolean NOT NULL,
    deletado boolean NOT NULL
);


ALTER TABLE public.veiculo OWNER TO postgres;

--
-- Name: locacao id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.locacao ALTER COLUMN id SET DEFAULT nextval('public.locacao_id_seq'::regclass);


--
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cliente (cpf, nome, email, telefone, deletado) FROM stdin;
040.696.610-93	ipoip	teste@test	456456	t
292.654.350-62	Cristiano	contato@cristianoprogramador.com	53 984319169	f
\.


--
-- Data for Name: locacao; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.locacao (id, cliente, veiculo, data_inicial, data_final, devolvido) FROM stdin;
7	040.696.610-93	FDG-9856	2019-03-13	2019-03-15	t
8	292.654.350-62	ABC-0123	2019-03-16	2019-03-23	t
10	292.654.350-62	ABC-0123	2019-03-16	2019-03-21	t
11	292.654.350-62	ABC-0123	2019-03-20	2019-04-20	t
14	292.654.350-62	ABC-0123	2019-03-20	2019-03-23	t
9	292.654.350-62	XYZ-9876	2019-03-13	2019-03-16	t
12	292.654.350-62	XYZ-9876	2019-03-20	2019-03-23	t
13	292.654.350-62	XYZ-9876	2019-03-20	2019-03-23	t
15	292.654.350-62	XYZ-9876	2019-03-20	2019-03-23	t
16	292.654.350-62	ABC-0123	2019-03-20	2019-03-22	t
17	292.654.350-62	XYZ-9876	2019-03-20	2019-03-22	t
18	292.654.350-62	ABC-0123	2019-03-22	2019-03-24	t
\.


--
-- Data for Name: veiculo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.veiculo (placa, marca, modelo, cor, diaria, disponivel, deletado) FROM stdin;
FDG-9856	Citroen	dfg	Prata	455.00	t	t
VCD-9856	Audi	A4	Branco	56.00	t	t
XYZ-9876	Volkswagen	Gol G7	Vermelho	280.00	t	f
ABC-0123	Audi	A4	Branco	320.00	t	f
\.


--
-- Name: locacao_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.locacao_id_seq', 18, true);


--
-- Name: cliente pk_cliente; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT pk_cliente PRIMARY KEY (cpf);


--
-- Name: locacao pk_locacao; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.locacao
    ADD CONSTRAINT pk_locacao PRIMARY KEY (id);


--
-- Name: veiculo pk_veiculo; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.veiculo
    ADD CONSTRAINT pk_veiculo PRIMARY KEY (placa);


--
-- Name: cliente unique_email; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cliente
    ADD CONSTRAINT unique_email UNIQUE (email);


--
-- Name: locacao fk_cpf_cliente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.locacao
    ADD CONSTRAINT fk_cpf_cliente FOREIGN KEY (cliente) REFERENCES public.cliente(cpf);


--
-- Name: locacao pf_placa_veiculo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.locacao
    ADD CONSTRAINT pf_placa_veiculo FOREIGN KEY (veiculo) REFERENCES public.veiculo(placa);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

GRANT USAGE ON SCHEMA public TO locadora;


--
-- Name: TABLE cliente; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.cliente TO locadora;


--
-- Name: TABLE locacao; Type: ACL; Schema: public; Owner: postgres
--

GRANT ALL ON TABLE public.locacao TO locadora;


--
-- Name: SEQUENCE locacao_id_seq; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,USAGE ON SEQUENCE public.locacao_id_seq TO PUBLIC;


--
-- Name: TABLE veiculo; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.veiculo TO locadora;


--
-- PostgreSQL database dump complete
--