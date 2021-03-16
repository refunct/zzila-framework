<?php

namespace App\Libraries;

use App\Libraries\Loader;

class Pagination
{

    private $pagination_data = array('page' => 0, 'limit' => 0, 'count' => 0);

    public function setCurrentPage(int $current_page): void
    {
        $this->pagination_data['page'] = abs($current_page);
    }
    public function setLimit(int $limit): void
    {
        $this->pagination_data['limit'] = abs($limit);
    }
    public function setCount(int $count): void
    {
        $this->pagination_data['count'] = abs($count);
    }
    public function getPagination(): array
    {
        $this->pagination_data['pages'] = ceil($this->pagination_data['count'] / $this->pagination_data['limit']);

        $this->pagination_data['list'] = $this->getPaginationList();
        return $this->pagination_data;
    }
    private function getPaginationList(): array
    {
        $list = array('start' => 0, 'prev' => 0, 'current' => 0, 'next' => 0, 'end' => 0);

        //start
        if ($this->pagination_data['page'] - 2 >= 1) {
            $list['start'] = 1;
        }

        //prev
        if ($this->pagination_data['page'] - 1 >= 1) {
            $list['prev'] = $this->pagination_data['page'] - 1;
        }

        //current
        $list['current'] = $this->pagination_data['page'];

        //next
        if ($this->pagination_data['page'] + 1 <= $this->pagination_data['pages']) {
            $list['next'] = $this->pagination_data['page'] + 1;
        }

        //end
        if ($this->pagination_data['page'] + 2 <= $this->pagination_data['pages']) {
            $list['end'] = $this->pagination_data['pages'];
        }


        return $list;
    }
}
