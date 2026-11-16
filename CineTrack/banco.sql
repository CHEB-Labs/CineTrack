CREATE DATABASE IF NOT EXISTS cinetrack;
use cinetrack;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    diretor VARCHAR(100),
    ano INT,
    genero VARCHAR(50),
    capa VARCHAR(255),
    descricao TEXT
);

CREATE TABLE IF NOT EXISTS biblioteca (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    filme_id INT,
    status ENUM('quero_ver', 'assistido', 'favorito') DEFAULT 'quero_ver',
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (filme_id) REFERENCES filmes(id) ON DELETE CASCADE
);