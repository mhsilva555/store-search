<?php

namespace App\StoreSearch\Providers;

date_default_timezone_set('America/Sao_Paulo');

abstract class DatabaseServiceProvider
{
    public $table = null;
    private $conn;
    private $prefix;

    public function __construct()
    {
        global $wpdb;
        $this->conn = $wpdb;
        $this->prefix = $wpdb->prefix;
    }

    public function getAll()
    {
        return $this->conn->get_results("SELECT * FROM {$this->prefix}{$this->table}", OBJECT);
    }

    public function find($column, $id)
    {
        $result = $this->conn->get_row("
        SELECT * FROM {$this->prefix}{$this->table}
        WHERE {$column} = '{$id}'
        ", OBJECT);

        return $result;
    }

    public function update($data , $where_column, $id)
    {
        $update_data = [
            'store_name'    => sanitize_text_field($data['store_name_edit']),
            'store_city'    => sanitize_text_field($data['store_city_edit']),
            'store_address' => sanitize_text_field($data['store_address_edit']),
            'store_lat'     => sanitize_text_field($data['store_lat_edit']),
            'store_long'    => sanitize_text_field($data['store_long_edit']),
        ];

        return $this->conn->update($this->prefix.$this->table, $update_data, ["{$where_column}" => $id]);
    }

    public function create(array $data)
    {
        if (empty($data)) {
            return false;
        }

        return $this->conn->insert($this->prefix.$this->table, $data);
    }

    public function delete($delete_ids, string $column)
    {
        if (is_array($delete_ids)) {
            $delete_ids = array_values($delete_ids);

            foreach ($delete_ids as $id) {
                $this->conn->delete($this->prefix.$this->table, ["{$column}" => $id]);
            }

            return 200;
        }

        $this->conn->delete($this->prefix.$this->table, ["{$column}" => $delete_ids]);

        return 200;
    }

    public function where(array $where, $fields = "*", $operator = "AND")
    {
        $conditions = [];

        foreach ($where as $key => $value) {
            $conditions[] = "{$key} = '{$value}'";
        }

        $query = implode(" {$operator} ", $conditions);

        return $this->conn->get_results("SELECT {$fields} FROM {$this->prefix}{$this->table} WHERE {$query}", OBJECT);
    }
}