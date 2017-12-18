<?php

namespace App\Table;

use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;

class Table
{
    /**
     * A paginated object or model collection.
     *
     * @var mixed
     */
    protected $data;

    /**
     * A columns name for the table.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * A primary key for table.
     *
     * @var string
     */
    protected $primaryKey = '';

    /**
     * Table Init
     *
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Output a table for given data.
     *
     * @return void
     */
    public function display()
    {
        ?>
        <table class="table is-bordered is-fullwidth">
            <thead>
                <tr>
                    <?php $this->printColumns() ?>
                </tr>
            </thead>
            <tbody>
                <?php $this->getRows() ?>
            </tbody>
        </table>
        <?php
        if ($this->data instanceof LengthAwarePaginator) {
            echo $this->data->appends(Input::except('page'))->links('vendor.pagination.bulma');
        }
    }

    /**
     * Output a column. name.
     *
     * @return void
     */
    public function printColumns()
    {
        foreach ($this->getColumns() as $key => $name) {
            echo "<td id=\"$key\">$name</td>";
        }
    }

    /**
     * Get a columns for table.
     *
     * @return void
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Get the rows for table.
     *
     * @return void
     */
    public function getRows()
    {
        if (empty($this->getItems())) {
            return $this->noItems();
        }
        
        foreach ($this->getItems() as $item) {
            $this->singleRow($item);
        }
    }

    /**
     * Get a items from a $data property to render table.
     *
     * @return mixed;
     */
    public function getItems()
    {
        return ($this->data instanceof LengthAwarePaginator) ? $this->data->items() : $this->data;
    }

    /**
     * Render a single row in table.
     *
     * @param [type] $item
     * @return void
     */
    public function singleRow($item)
    {
        echo "<tr>";
        foreach ($this->getColumns() as $key => $name) {
            echo "<td>";
            
            echo $this->getColumnValue($key, $item);

            if ($key === $this->primaryKey) {
                echo $this->renderQuickActions($item);
            }
            
            echo "</td>";
        }
        echo "</tr>";
    }

    /**
     * Render a noitems texts if $data is empty.
     *
     * @return void
     */
    public function noItems()
    {
        ?>
        <tr>
            <td class="has-text-centered" colspan="<?php echo count($this->getColumns()) ?>">
                No Items Found
            </td>
        </tr>
        <?php
    }

    /**
     * Get a column value for every row.
     *
     * @param string $columnIdentifier
     * @param object $item
     * @return mixed
     */
    public function getColumnValue($columnIdentifier, $item)
    {
        return $this->defaultColumnValue($columnIdentifier, $item);
    }
    
    /**
     * Get a default column value from column key.
     *
     * @param string $columnIdentifier
     * @param object $item
     * @return mixed
     */
    public function defaultColumnValue($columnIdentifier, $item)
    {
        return (isset($item[$columnIdentifier]) && is_string($item[$columnIdentifier])) ? $item[$columnIdentifier] : '-';
    }

    /**
     * Render a additional links in primary column.
     *
     * @param object $item
     * @return string
     */
    public function renderQuickActions($item)
    {
        $actionsHtml = '';

        $actions = $this->generateQuickActionLinks($item);

        foreach ($actions as $key => $action) {
            if ($key === 'delete') {
                $randomString = str_random(4);
                $actionsHtml .= '<div><a href="#"
                class="level-item has-text-danger"
                onclick="event.preventDefault();document.getElementById(\''.$randomString.'-delete-form-'.$item->id.'\').submit();"
                >Delete</a>
                <form
                id="'.$randomString.'-delete-form-'. $item->id .'"
                action="'.$action['link'].'"
                method="POST"
                style="display: none;">'.method_field('DELETE').''.csrf_field().'</form></div>';
            } else {
                $actionsHtml .= '<a class="level-item" href="'. $action['link'] .'">'.$action['title'].'</a>';
            }

            if (end($actions) !== $action) {
                $actionsHtml .= '<span class="level-item"> | </span>';
            }
        }

        if (empty($actionsHtml)) {
            return $actionsHtml;
        }
        
        return '<div class="level quick-actions"><div class="level-left">'.$actionsHtml.'</div></div>';
    }

    /**
     * Get a additional links.
     *
     * @param [type] $item
     * @return void
     */
    public function generateQuickActionLinks($item)
    {
        return [];
    }
}
