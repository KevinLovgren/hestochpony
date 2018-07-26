<?php

namespace App;

use Illuminate\Database\Connection;

class YugiRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

     /**
     * Returns a list of all gameids in safesystem
     */
    public function getDeckNames()
    {
        $names = $this->connection->table('decks')->select('name')->get()->toArray();

        return array_map(create_function('$o', 'return $o->name;'), $names);
    }
}
