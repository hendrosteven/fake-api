<?php

class BaseModel extends DB\SQL\Mapper{

    public function __construct(\DB\SQL $db, $table) {
        parent::__construct($db, $table);
    }
    
}