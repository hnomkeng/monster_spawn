<?php
if (!defined('FLUX_ROOT')) exit;

require __DIR__ . '/../../mapImage.php';

$title = 'List Map';

try {
    $sth = $server->connection->getStatement('select * from `map_index` order by name');
    $sth->execute();
    if((int)$sth->stmt->errorCode()){
        throw new Flux_Error('db not found');
    }
    $maps = $sth->fetchAll();
} catch(Exception $e){
    $maps = false;
}