<?php

namespace db;


interface DB
{
    public function connect();
    public function insert(string $tableName, array $args): bool ;
    public function read(string $tableName, string $target): ?array;
    public function update(string $tableName, string $condition, array $args);
    public function delete(string $tableName, string $condition);
}