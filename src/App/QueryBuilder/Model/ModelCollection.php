<?php 

namespace App\QueryBuilder\Model;

class ModelCollection extends Query
{
    /**
     * @var array
     */
    public $items = [];

    /**
     * @var array
     */
    public function toArray()
    {
        return $this->items;
    }
}
