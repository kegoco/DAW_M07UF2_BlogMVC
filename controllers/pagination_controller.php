<?php
class PaginationController {
    public $total_pages;
    public $items_page;  // Elementos a mostrar por página
    private $range_paging;  // Número de páginas a mostrar en la paginación
    public $current_page;
    public $items_show;
    public $pages;

    public function __construct($page, $total_items) {
        $this->current_page = $page;
        $this->items_page = 5;
        $this->range_paging = 3;
        $this->total_pages = ceil($total_items / $this->items_page);
        $this->pages = [];
        $this->items_show = ($this->items_page * $this->current_page) - $this->items_page;

        $initial_num = $this->current_page - $this->range_paging;
        $condition_limit_num = $this->current_page + $this->range_paging;
        for ($i = $initial_num; $i < $condition_limit_num; $i++) {
            if ($i > 0 && $i <= $this->total_pages) {
                array_push($this->pages, $i);
            }
        }
    }

    public function createPagination($controller, $pages) {
        // Carga la vista de paginación
        require_once "views/pagination.php";
    }
}
?>