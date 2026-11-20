-- Dados de demonstração do Classics (opcional)
-- Rode no banco Classics DEPOIS do script.sql e do admin.sql.
-- Cria 7 empresas (5 aprovadas e 2 pendentes, para testar a aprovação no painel)
-- e 11 atividades com categorias, localização e sessões.
-- Senha de todas as empresas: Empresa@123
-- As sessões usam datas relativas ao dia em que o script é executado
-- (ex.: hoje + 2 dias), então aparecem como disponíveis no catálogo.
-- As atividades ficam sem foto; a foto pode ser enviada em Minhas Atividades > Editar.

INSERT INTO Empresa (Name, Email, CNPJ, Localizacao, Telefone, Senha, Status) VALUES
('Aventuras Radicais', 'contato@aventurasradicais.com.br', '12345678000195', 'Foz do Iguaçu, PR', '45991234567', '$2y$10$u2hUEOWB4ZT0LJ80wHkjBuZ.76dk9b3g7CaGWj1TwIhgYUEZOufZ.', 'aprovada'),
('Cataratas Turismo', 'reservas@cataratasturismo.com.br', '23456789000195', 'Foz do Iguaçu, PR', '4535221100', '$2y$10$u2hUEOWB4ZT0LJ80wHkjBuZ.76dk9b3g7CaGWj1TwIhgYUEZOufZ.', 'aprovada'),
('Sabores do Sul', 'contato@saboresdosul.com.br', '34567891000184', 'Curitiba, PR', '41998765432', '$2y$10$u2hUEOWB4ZT0LJ80wHkjBuZ.76dk9b3g7CaGWj1TwIhgYUEZOufZ.', 'aprovada'),
('Curitiba Cultural', 'agenda@curitibacultural.com.br', '45678912000155', 'Curitiba, PR', '4132345678', '$2y$10$u2hUEOWB4ZT0LJ80wHkjBuZ.76dk9b3g7CaGWj1TwIhgYUEZOufZ.', 'aprovada'),
('Parque Diversão Kids', 'atendimento@diversaokids.com.br', '56789123000108', 'São Paulo, SP', '11987654321', '$2y$10$u2hUEOWB4ZT0LJ80wHkjBuZ.76dk9b3g7CaGWj1TwIhgYUEZOufZ.', 'aprovada'),
('Trilhas da Serra Ecoturismo', 'contato@trilhasdaserra.com.br', '67891234000147', 'Florianópolis, SC', '48996543210', '$2y$10$u2hUEOWB4ZT0LJ80wHkjBuZ.76dk9b3g7CaGWj1TwIhgYUEZOufZ.', 'pendente'),
('Arena Esportes', 'contato@arenaesportes.com.br', '78912345000109', 'Londrina, PR', '43991112233', '$2y$10$u2hUEOWB4ZT0LJ80wHkjBuZ.76dk9b3g7CaGWj1TwIhgYUEZOufZ.', 'pendente');

-- ==== contato@aventurasradicais.com.br ====
SET @empresa := (SELECT ID_Empresa FROM Empresa WHERE Email = 'contato@aventurasradicais.com.br');
INSERT INTO Categorias (Nome_Categoria, Empresa_ID) VALUES ('Aventura', @empresa);
SET @categoria := LAST_INSERT_ID();

INSERT INTO Atividades (Nome, Duracao, Descricao, Localizacao, Valor, Fotos, Categoria_ID, Empresa_ID)
VALUES ('Rafting no Rio Iguaçu', '03:00:00', 'Descida de bote pelas corredeiras do Rio Iguaçu com guias certificados, colete e capacete inclusos. Indicado para maiores de 14 anos.', 'Foz do Iguaçu', 180.00, NULL, @categoria, @empresa);
SET @atividade := LAST_INSERT_ID();
INSERT INTO Localizacao (CEP, Complemento, ID_Atividade) VALUES ('85855750', 'Rodovia das Cataratas, km 25 - Base Náutica', @atividade);
INSERT INTO Sessao (Data, Hora, Qtd_min, Qtd_max, Qtd_disponivel, ID_Atividade) VALUES
(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '09:00:00', 4, 8, 8, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 3 DAY), '14:00:00', 4, 8, 8, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 9 DAY), '09:00:00', 4, 8, 8, @atividade);

INSERT INTO Atividades (Nome, Duracao, Descricao, Localizacao, Valor, Fotos, Categoria_ID, Empresa_ID)
VALUES ('Rapel na Cachoeira', '02:30:00', 'Descida de rapel de 30 metros ao lado de uma cachoeira, com treinamento prévio e todo o equipamento de segurança.', 'Foz do Iguaçu', 150.00, NULL, @categoria, @empresa);
SET @atividade := LAST_INSERT_ID();
INSERT INTO Localizacao (CEP, Complemento, ID_Atividade) VALUES ('85863000', 'Estrada do Parque Nacional, s/n', @atividade);
INSERT INTO Sessao (Data, Hora, Qtd_min, Qtd_max, Qtd_disponivel, ID_Atividade) VALUES
(DATE_ADD(CURDATE(), INTERVAL 4 DAY), '08:30:00', 1, 10, 10, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 11 DAY), '08:30:00', 1, 10, 10, @atividade);

INSERT INTO Atividades (Nome, Duracao, Descricao, Localizacao, Valor, Fotos, Categoria_ID, Empresa_ID)
VALUES ('Arvorismo e Tirolesa', '01:30:00', 'Circuito de arvorismo com 12 estações e tirolesa de 200 metros no meio da mata atlântica. Diversão para toda a família.', 'Foz do Iguaçu', 95.00, NULL, @categoria, @empresa);
SET @atividade := LAST_INSERT_ID();
INSERT INTO Localizacao (CEP, Complemento, ID_Atividade) VALUES ('85853000', 'Av. das Cataratas, 6500', @atividade);
INSERT INTO Sessao (Data, Hora, Qtd_min, Qtd_max, Qtd_disponivel, ID_Atividade) VALUES
(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '10:00:00', 1, 15, 15, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 5 DAY), '15:00:00', 1, 15, 15, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 8 DAY), '10:00:00', 1, 15, 15, @atividade);

-- ==== reservas@cataratasturismo.com.br ====
SET @empresa := (SELECT ID_Empresa FROM Empresa WHERE Email = 'reservas@cataratasturismo.com.br');
INSERT INTO Categorias (Nome_Categoria, Empresa_ID) VALUES ('Passeio', @empresa);
SET @categoria := LAST_INSERT_ID();

INSERT INTO Atividades (Nome, Duracao, Descricao, Localizacao, Valor, Fotos, Categoria_ID, Empresa_ID)
VALUES ('Passeio de Barco nas Cataratas', '01:00:00', 'Passeio de barco até a base das quedas das Cataratas do Iguaçu. Prepare-se para se molhar!', 'Foz do Iguaçu', 260.00, NULL, @categoria, @empresa);
SET @atividade := LAST_INSERT_ID();
INSERT INTO Localizacao (CEP, Complemento, ID_Atividade) VALUES ('85855750', 'Rodovia das Cataratas, km 22 - Píer principal', @atividade);
INSERT INTO Sessao (Data, Hora, Qtd_min, Qtd_max, Qtd_disponivel, ID_Atividade) VALUES
(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '10:00:00', 1, 20, 20, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '15:00:00', 1, 20, 20, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 6 DAY), '10:00:00', 1, 20, 20, @atividade);

INSERT INTO Atividades (Nome, Duracao, Descricao, Localizacao, Valor, Fotos, Categoria_ID, Empresa_ID)
VALUES ('Tour Três Fronteiras ao Pôr do Sol', '02:00:00', 'Visita ao Marco das Três Fronteiras com vista para Brasil, Argentina e Paraguai no fim da tarde, com guia bilíngue.', 'Foz do Iguaçu', 120.00, NULL, @categoria, @empresa);
SET @atividade := LAST_INSERT_ID();
INSERT INTO Localizacao (CEP, Complemento, ID_Atividade) VALUES ('85853810', 'Av. General Meira, s/n - Marco das Três Fronteiras', @atividade);
INSERT INTO Sessao (Data, Hora, Qtd_min, Qtd_max, Qtd_disponivel, ID_Atividade) VALUES
(DATE_ADD(CURDATE(), INTERVAL 3 DAY), '17:00:00', 2, 25, 25, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 10 DAY), '17:00:00', 2, 25, 25, @atividade);

-- ==== contato@saboresdosul.com.br ====
SET @empresa := (SELECT ID_Empresa FROM Empresa WHERE Email = 'contato@saboresdosul.com.br');
INSERT INTO Categorias (Nome_Categoria, Empresa_ID) VALUES ('Gastronomia', @empresa);
SET @categoria := LAST_INSERT_ID();

INSERT INTO Atividades (Nome, Duracao, Descricao, Localizacao, Valor, Fotos, Categoria_ID, Empresa_ID)
VALUES ('Oficina de Pierogi', '02:00:00', 'Aprenda a preparar o tradicional pierogi polonês com uma chef local. Todos os ingredientes inclusos e degustação ao final.', 'Curitiba', 89.90, NULL, @categoria, @empresa);
SET @atividade := LAST_INSERT_ID();
INSERT INTO Localizacao (CEP, Complemento, ID_Atividade) VALUES ('80020000', 'Rua XV de Novembro, 1200 - Sala 3', @atividade);
INSERT INTO Sessao (Data, Hora, Qtd_min, Qtd_max, Qtd_disponivel, ID_Atividade) VALUES
(DATE_ADD(CURDATE(), INTERVAL 3 DAY), '19:00:00', 4, 12, 12, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 10 DAY), '19:00:00', 4, 12, 12, @atividade);

INSERT INTO Atividades (Nome, Duracao, Descricao, Localizacao, Valor, Fotos, Categoria_ID, Empresa_ID)
VALUES ('Tour Gastronômico no Mercado Municipal', '03:00:00', 'Caminhada guiada pelo Mercado Municipal com degustação de queijos, cafés especiais e doces típicos paranaenses.', 'Curitiba', 140.00, NULL, @categoria, @empresa);
SET @atividade := LAST_INSERT_ID();
INSERT INTO Localizacao (CEP, Complemento, ID_Atividade) VALUES ('80060140', 'Av. Sete de Setembro, 1865 - Mercado Municipal', @atividade);
INSERT INTO Sessao (Data, Hora, Qtd_min, Qtd_max, Qtd_disponivel, ID_Atividade) VALUES
(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '09:30:00', 2, 10, 10, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 7 DAY), '09:30:00', 2, 10, 10, @atividade);

-- ==== agenda@curitibacultural.com.br ====
SET @empresa := (SELECT ID_Empresa FROM Empresa WHERE Email = 'agenda@curitibacultural.com.br');
INSERT INTO Categorias (Nome_Categoria, Empresa_ID) VALUES ('Cultural', @empresa);
SET @categoria := LAST_INSERT_ID();

INSERT INTO Atividades (Nome, Duracao, Descricao, Localizacao, Valor, Fotos, Categoria_ID, Empresa_ID)
VALUES ('Visita Guiada ao Museu Oscar Niemeyer', '01:30:00', 'Visita guiada pelas principais exposições do Museu do Olho, com mediador especializado em arte e arquitetura.', 'Curitiba', 45.00, NULL, @categoria, @empresa);
SET @atividade := LAST_INSERT_ID();
INSERT INTO Localizacao (CEP, Complemento, ID_Atividade) VALUES ('80530000', 'Rua Marechal Hermes, 999 - Centro Cívico', @atividade);
INSERT INTO Sessao (Data, Hora, Qtd_min, Qtd_max, Qtd_disponivel, ID_Atividade) VALUES
(DATE_ADD(CURDATE(), INTERVAL 1 DAY), '14:00:00', 1, 30, 30, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 4 DAY), '10:00:00', 1, 30, 30, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 12 DAY), '14:00:00', 1, 30, 30, @atividade);

INSERT INTO Atividades (Nome, Duracao, Descricao, Localizacao, Valor, Fotos, Categoria_ID, Empresa_ID)
VALUES ('Noite no Teatro Guaíra', '02:00:00', 'Bastidores do Teatro Guaíra seguidos de apresentação da orquestra. Uma noite completa de cultura no coração de Curitiba.', 'Curitiba', 70.00, NULL, @categoria, @empresa);
SET @atividade := LAST_INSERT_ID();
INSERT INTO Localizacao (CEP, Complemento, ID_Atividade) VALUES ('80060070', 'Rua Conselheiro Laurindo, 175', @atividade);
INSERT INTO Sessao (Data, Hora, Qtd_min, Qtd_max, Qtd_disponivel, ID_Atividade) VALUES
(DATE_ADD(CURDATE(), INTERVAL 5 DAY), '20:00:00', 1, 40, 40, @atividade);

-- ==== atendimento@diversaokids.com.br ====
SET @empresa := (SELECT ID_Empresa FROM Empresa WHERE Email = 'atendimento@diversaokids.com.br');
INSERT INTO Categorias (Nome_Categoria, Empresa_ID) VALUES ('Parque', @empresa);
SET @categoria := LAST_INSERT_ID();

INSERT INTO Atividades (Nome, Duracao, Descricao, Localizacao, Valor, Fotos, Categoria_ID, Empresa_ID)
VALUES ('Dia no Parque Aquático', '06:00:00', 'Acesso ao parque aquático com toboáguas, piscina de ondas e área kids. Crianças até 5 anos não pagam (inclua apenas os pagantes).', 'São Paulo', 120.00, NULL, @categoria, @empresa);
SET @atividade := LAST_INSERT_ID();
INSERT INTO Localizacao (CEP, Complemento, ID_Atividade) VALUES ('04094050', 'Av. Pedro Álvares Cabral, s/n - Portão 3', @atividade);
INSERT INTO Sessao (Data, Hora, Qtd_min, Qtd_max, Qtd_disponivel, ID_Atividade) VALUES
(DATE_ADD(CURDATE(), INTERVAL 2 DAY), '09:00:00', 1, 50, 50, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 9 DAY), '09:00:00', 1, 50, 50, @atividade);

INSERT INTO Atividades (Nome, Duracao, Descricao, Localizacao, Valor, Fotos, Categoria_ID, Empresa_ID)
VALUES ('Festa na Fazendinha', '03:00:00', 'Passeio pela fazendinha com alimentação de animais, passeio de pônei e oficina de horta para crianças de 3 a 10 anos.', 'São Paulo', 60.00, NULL, @categoria, @empresa);
SET @atividade := LAST_INSERT_ID();
INSERT INTO Localizacao (CEP, Complemento, ID_Atividade) VALUES ('04709110', 'Rua Verbo Divino, 1500', @atividade);
INSERT INTO Sessao (Data, Hora, Qtd_min, Qtd_max, Qtd_disponivel, ID_Atividade) VALUES
(DATE_ADD(CURDATE(), INTERVAL 3 DAY), '10:00:00', 1, 20, 20, @atividade),
(DATE_ADD(CURDATE(), INTERVAL 6 DAY), '14:00:00', 1, 20, 20, @atividade);
