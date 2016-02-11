CREATE TABLE `usuario` (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`login`	TEXT NOT NULL,
	`senha`	TEXT NOT NULL,
	`ativo`	INTEGER NOT NULL,
	`criadoEm`	NUMERIC NOT NULL,
	`atualizadoEm`	NUMERIC,
	`excluido`	INTEGER NOT NULL
);
CREATE TABLE "sessao" (
	`id`	TEXT NOT NULL,
	`usuarioId`	INTEGER NOT NULL,
	`dataHoraInicio`	NUMERIC NOT NULL,
	`dataHoraFim`	NUMERIC NOT NULL,
	`criadoEm`	NUMERIC NOT NULL,
	`atualizadoEm`	NUMERIC,
	`excluido`	INTEGER NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE `modulo` (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`titulo`	TEXT NOT NULL,
	`descricao`	TEXT,
	`ativo`	INTEGER NOT NULL,
	`criadoEm`	NUMERIC NOT NULL,
	`atualizadoEm`	NUMERIC,
	`excluido`	INTEGER NOT NULL
);

CREATE TABLE `atividade` (
	`id`	INTEGER PRIMARY KEY AUTOINCREMENT,
	`moduloId`	INTEGER NOT NULL,
	`titulo`	TEXT NOT NULL,
	`descricao`	TEXT,
	`ativo`	INTEGER NOT NULL,
	`criadoEm`	NUMERIC NOT NULL,
	`atualizadoEm`	NUMERIC,
	`excluido`	INTEGER NOT NULL
);
