<?php

namespace app\database;

use PDO;

class DatabaseInitializer
{

    // Cria o banco e executa os scripts de estrutura e do administrador inicial
    public function init(PDO $connection)
    {
        $connection->exec('CREATE DATABASE IF NOT EXISTS `' . DB_NAME . '` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci');
        $connection->exec('USE `' . DB_NAME . '`');

        foreach (['script.sql', 'admin.sql'] as $arquivo) {
            $scriptPath = __DIR__ . '/scripts/' . $arquivo;

            if (!file_exists($scriptPath)) {
                continue;
            }

            try {
                $connection->exec(file_get_contents($scriptPath));
            } catch (\Exception $e) {
                error_log('Erro ao executar ' . $arquivo . ': ' . $e->getMessage());
            }
        }
    }
}
