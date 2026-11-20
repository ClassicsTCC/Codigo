<?php 
namespace app\database;

use PDO;
use PDOException;

class ConnectionFactory {

    // Código do MySQL para "banco de dados inexistente"
    private const BANCO_INEXISTENTE = 1049;

    private static ?PDO $connection = null;

    public static function getConnection(){

        if (self::$connection == null) {

            try {
                self::$connection = self::createConnection(self::dsn(true));
            } catch (PDOException $e) {
                try {
                    if ((int) $e->getCode() !== self::BANCO_INEXISTENTE) {
                        throw $e;
                    }

                    // Na primeira execução o banco é criado com as tabelas e o administrador
                    $databaseInit = new DatabaseInitializer();
                    $databaseInit->init(self::createConnection(self::dsn(false)));

                    self::$connection = self::createConnection(self::dsn(true));
                } catch (PDOException $erro) {
                    self::exibirErroConexao($erro);
                }
            }
        }

        return self::$connection;
        
    }

    private static function dsn(bool $comBanco): string
    {
        return 'mysql:host=' . DB_HOST . ($comBanco ? ';dbname=' . DB_NAME : '') . ';charset=utf8mb4';
    }

    private static function createConnection(string $dsn){
        $connection = new PDO($dsn, DB_USER, DB_PASS);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $connection;
    }

    // Mostra uma página simples em vez do erro técnico; o detalhe fica no log do PHP
    private static function exibirErroConexao(PDOException $erro): void
    {
        error_log('Classics - falha ao conectar no banco de dados: ' . $erro->getMessage());
        http_response_code(500);

        echo '<!DOCTYPE html><html lang="pt-br"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">'
            . '<title>Classics • Banco de dados indisponível</title></head>'
            . '<body style="font-family: Arial, sans-serif; background: #f7f4ef; color: #2b2b2b; display: flex; min-height: 100vh; margin: 0; align-items: center; justify-content: center;">'
            . '<div style="max-width: 520px; margin: 16px; padding: 32px; background: #fff; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,.08);">'
            . '<h1 style="font-size: 22px; margin-top: 0;">Não foi possível conectar ao banco de dados</h1>'
            . '<p>Verifique se o MySQL está ligado e se o usuário e a senha do banco estão corretos em '
            . '<code>app/config/Config.php</code> (DB_USER e DB_PASS).</p>'
            . '</div></body></html>';
        exit();
    }
}
