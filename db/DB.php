<?php

namespace db;


interface DB
{
    public function connect();
    public function insert(string $tableName, array $args): int;
    public function read(string $tableName, string $condition): array;
    public function update(string $tableName, string $condition, array $args);
    public function delete(string $tableName, string $condition);
}