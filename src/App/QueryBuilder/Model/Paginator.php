<?php

namespace App\QueryBuilder\Model;

class Paginator extends Query
{
    /**
     * @var int
     */
    protected $current_page;
    protected $number_of_page;
    protected $page_first_result;
    protected $result_per_page;
    protected $countRows;
    protected $total_data_per_page;

    /**
     * @return array
     */
    public $items = [];

    /**
     * @return array
     */
    public $active = [];

    /**
     * Method to set paginator property
     */
    public function setProp(array $datas)
    {
        $this->current_page = $datas['current_page'];
        $this->number_of_page = $datas['number_of_page'];
        $this->page_first_result = $datas['page_first_result'];
        $this->result_per_page = $datas['result_per_page'];
        $this->countRows = $datas['countRows'];
        $this->total_data_per_page = $datas['total_data_per_page'];

        unset($this->query);
    }

    /**
     * Method to set items data
     */
    public function setItems(array $items)
    {
        $this->items = $items;
    }

    /**
     * Method to get items data
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Method to display pagination
     */
    public function links()
    {
        $this->active = [];

        $template = '<div class="row mt-3"><div class="col-4"><h6 class="text-muted fw-normal mt-2" style="font-size: 14px;">Showing ' . ($this->countRows > 0 ? ($this->page_first_result + 1) : $this->page_first_result) . ' to ' . $this->total_data_per_page . ' of ' . $this->countRows . ' entries</h6></div>';

        if ($this->number_of_page > 1) {
            $template .= '<div class="col" style="font-size: 14px;">';
            $template .= "<ul class=\"pagination float-end\">
<li class=\"page-item " . ($this->current_page - 1 == 0 ? 'disabled' : '') . "\"><a class=\"page-link\" href=\"?page=" . (intval($this->current_page) - 1) . "&" . $this->queryString . "\">Prev</a></li>";
            if ($this->number_of_page >= 1 && $this->current_page <= $this->number_of_page) {
                $i = max(2, $this->current_page - 5);
                $template .= "<li class=\"page-item " . ($this->current_page == ($i - 1) ? 'active' : '') . "\"><a class=\"page-link\" href=\"?page=1" . "&" . $this->queryString . "\">1</a></li>";
                if ($i > 2)
                    $template .= "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=" . ($i - 1) . "&" . $this->queryString . "\"> ... </a></li>";
                for (; $i < min($this->current_page + 4, $this->number_of_page); $i++) {
                    $template .= "<li class=\"page-item " . ($this->current_page == $i ? 'active' : '') . "\"><a class=\"page-link\" href=\"?page=" . $i . "&" . $this->queryString . "\">" . $i . "</a></li>";
                }
                if ($i != $this->number_of_page)
                    $template .= "<li class=\"page-item\"><a class=\"page-link\" href=\"?page=" . $i . "&" . $this->queryString . "\"> ... </a></li>";
                $template .= "<li class=\"page-item " . ($this->current_page == $this->number_of_page ? 'active' : '') . "\"><a class=\"page-link\" href=\"?page=" . $this->number_of_page . "&" . $this->queryString . "\">" . $this->number_of_page . "</a></li>";
            }
            $template .= "<li class=\"page-item " . ($this->current_page + 1 > $this->number_of_page ? 'disabled' : '') . "\"><a class=\"page-link\" href=\"?page=" . (intval($this->current_page) + 1) . "&" . $this->queryString . "\">Next</a></li>
</ul>";
            $template .= '</div>';
        }

        $template .= '</div>';

        return html_entity_decode(nl2br($template));
    }
}
