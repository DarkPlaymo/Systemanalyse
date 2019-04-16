<?php

// Diese Klasse erleichtert das Ausführen von SQL-Statements
class psDB
{
    // Die Rahmendaten der Datenbank werden als private Variablen festgelegt.
    private $host = '127.0.0.1';
    private $db = 'eveningpitch';
    private $user = 'root';
    private $pass = '';
    private $dsn;

    // Bei Initialiierung des Objekts werden die entsprechenden Variablen in den Treiber-String geschrieben.
    public function __construct()
    {
        $this->dsn = "mysql:host=$this->host;dbname=$this->db";
    }

    // Bei Ausführen wird eine Datenbankverbindung hergestellt und als Datenbank-Objekt zurückgegeben.
    public function getDatabaseConnection()
    {
        try {
            $pdo = new PDO($this->dsn, $this->user, $this->pass);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        return $pdo;
    }

    // Diese Funktion führt die Datenbankabfrage, welche als String im Parameter $query steht, auf die im Objekt festgelegte Datenbank aus.
    public function doQuery($databaseObject, $query)
    {
        $databaseObject = $databaseObject->query($query);
        /*
        * Gibt die SQL-Query einen Boolischen Wert zurück (Insert-Operationen) wird dieser direkt zurückgegeben.
        * Hat die SQL-Query einen Datensatz als Rückgabewert, wird dieser in ein Array geschrieben und ausgegeben.
        */
        if (is_bool($databaseObject)) {
            $result = $databaseObject;
        } else {
            $result = $databaseObject->fetchAll();
        }
        return $result;
    }
}