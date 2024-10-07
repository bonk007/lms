<?php

namespace App\DTO;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class AbstractData implements ArrayAccess, Arrayable, Jsonable
{
    public function __construct(protected array $data = [])
    {
    }

    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }

    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!$this->offsetExists($offset)) {
            return;
        }

        $this->data[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $offset): void
    {
        if (!$this->offsetExists($offset)) {
            return;
        }

        unset($this->data[$offset]);
    }

    /**
     * @param string $offset
     * @return mixed
     */
    public function __get(string $offset): mixed
    {
        return $this->offsetGet($offset);
    }

    public function __set(string $offset, $value): void
    {
        $this->offsetSet($offset, $value);
    }

    public function __unset(string $offset): void
    {
        $this->offsetUnset($offset);
    }

    public function __isset(string $offset): bool
    {
        return $this->offsetExists($offset);
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * @throws \JsonException
     */
    public function toJson($options = 0): string
    {
        return json_encode($this->toArray(), JSON_THROW_ON_ERROR | $options);
    }
}
