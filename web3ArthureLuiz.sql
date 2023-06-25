--
-- PostgreSQL database dump
--

-- Dumped from database version 13.3
-- Dumped by pg_dump version 13.3

-- Started on 2023-03-14 22:20:32

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 205 (class 1259 OID 16428)
-- Name: autor; Type: TABLE; Schema: public; Owner: postgres
--


CREATE TABLE public.categoria (
    id serial NOT NULL PRIMARY KEY,
    descricao character varying(100)
);

CREATE TABLE public.funcionario (
  id serial  NOT NULL ,
  nome character varying(100) NOT NULL PRIMARY KEY,
  data_nascimento date NOT NULL,
  foto character varying(100) ,
  funcao_id integer NOT NULL REFERENCES funcao(id)
); 

-- --------------------------------------------------------

--
-- Estrutura da tabela funcoes
--

CREATE TABLE public.funcao (
  id serial  NOT NULL PRIMARY KEY,
  descricao text NOT NULL
); 

-- --------------------------------------------------------

--
-- Estrutura da tabela produtos
--

CREATE TABLE public.produto (
  id serial  NOT NULL PRIMARY KEY,
  nome character varying(100) NOT NULL,
  valor double precision NOT NULL,
  imagem character varying(100) ,
  categoria_id integer NOT NULL REFERENCES categoria(id)
); 
CREATE TABLE public.pedido(
  id SERIAL NOT NULL,
  nome_cliente VARCHAR(100) NOT NULL,
  funcionario_id INTEGER NOT NULL REFERENCES funcionario(id),
  horario TIME NOT NULL,
  valor_total DOUBLE PRECISION NOT NULL
  );

CREATE TABLE public.pedido_produto(
  id_pedido INTEGER NOT NULL REFERENCES pedido (id), 
  id_produto INTEGER NOT NULL REFERENCES produto (id)
  );

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;