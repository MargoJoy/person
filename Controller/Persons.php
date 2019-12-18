<?php
namespace Controller;

use PDOAdapter;
use MyLogger;

class Persons
{
    public $data;
    public $log_file;
    public $db;
    public $person;
    public $errorLogger;

//TODO Стоит вынести в отдельный класс
    public function __construct()
    {
        $this->data = include __DIR__ . '/../Data/config.php';

        $this->log_file = __DIR__ . '/../Data/log_file.txt';
        $this->errorLogger = new MyLogger($this->log_file);
        $this->db = new PDOAdapter($this->data['dsn'], $this->data['username'], $this->data['password'], $this->errorLogger);

    }

//TODO Не до конца поняла из задания как именно нужно делать сортировку, сделала самый простой вариант :)
    public function getPersonsMaxAge()
    {
        $sql = 'SELECT * FROM person WHERE age = (SELECT MAX(age) FROM person) ORDER BY firstname DESC, lastname DESC ';

        $persons = $this->db->execute('selectAll', $sql);

        return !empty($persons) ? $persons : null;

    }

    public function getMaxAge()
    {
        $sql = 'SELECT MAX(age) FROM person';

        $maxAge = $this->db->execute('selectOne', $sql);

        foreach ($maxAge as $value) {
            $maxAge = $value;
        }
        return !empty($maxAge) ? $maxAge : null;

    }

    public function update()
    {
        $sql = 'SELECT lastname, firstname, id, age, mother_id FROM person WHERE (mother_id IS NULL OR trim(mother_id) = \'\') AND (age < 46)';

        $person = $this->db->execute('selectOne', $sql);

        if ($person->age < $this->getMaxAge()) {

            $arg = [
                'id' => $person->id,
                'age' => $this->getMaxAge(),
            ];

            $sql = 'UPDATE person SET age = :age WHERE id = :id';

            $this->db->execute('execute', $sql, $arg);

        }

        return !empty($person) ? $person : null;
    }

}