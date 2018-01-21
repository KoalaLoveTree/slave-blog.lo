<?php

namespace db;


interface DB
{
    public function connect(array $db);
    public function insert(string $tableName, array $args): int;
    public function read(string $tableName, int $id): array;
    public function update(string $tableName, int $id, array $args);
    public function delete(string $tableName, int $id);
}