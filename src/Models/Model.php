<?php

namespace NotesApp\Models;

abstract class Model
{
    protected $fields = [];
    protected $attributes = [];

    public function __construct(array $attributes = [])
    {
        $tmpArray = $this->attributes;

        foreach ($this->fields as $field) {
            if (key_exists($field, $tmpArray)) {
                continue;
            }
            $tmpArray[$field] = null;
        }

        $attributes = array_merge($tmpArray, $attributes);
        $this->attributes = $attributes;
    }

    public function __set($name, $value)
    {
        $this->setAttribute($name, $value);
    }

    public function __get($name)
    {
        return $this->getAttribute($name);
    }

    protected function setAttribute($name, $value)
    {
        if (in_array($name, $this->fields)) {
            $this->attributes[$name] = $value;
        }
    }

    protected function getAttribute($name)
    {
        if (key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }

        throw new \Exception('Unknown property: ' . $name);
    }

    public function toArray()
    {
        return $this->attributes;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
