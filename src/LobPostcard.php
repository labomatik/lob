<?php

namespace NotificationChannels\Lob;

class LobPostcard
{
    /** @var string */
    public $type = 'postcards';

    /** @var string|null */
    protected $fromAddress = null;

    /** @var string|null */
    protected $toAddress = null;

    /** @var string */
    protected $front;

    /** @var string */
    protected $back;

    /** @var array */
    protected $merge_variables;

    /** @var string */
    protected $size = '4x6';


    /**
     * @param string $message
     *
     * @return static
     */
    public static function create($message = '')
    {
        return new static($message);
    }

    /**
     * @param string $message
     */
    public function __construct($message = '')
    {
        $this->message = $message;
    }

    /**
     * @param string|LobAddress $value
     *
     * @return $this
     */
    public function fromAddress($value)
    {
        $this->fromAddress = is_string($value) ? $value : $value->toArray();

        return $this;
    }

    /**
     * @param string|LobAddress $value
     *
     * @return $this
     */
    public function toAddress($value)
    {
        $this->toAddress = is_string($value) ? $value : $value->toArray();

        return $this;
    }

    /**
     * @param mixed $front
     *
     * @return $this
     */
    public function front($front)
    {
        $this->front = $front;

        return $this;
    }

    /**
     * @param mixed $back
     *
     * @return $this
     */
    public function back($back)
    {
        $this->back = $back;

        return $this;
    }

    /**
     * @param array $message
     *
     * @return $this
     */
    public function merge_variables($merge_variables)
    {
        $this->merge_variables = $merge_variables;

        return $this;
    }

    /**
     * @param string $size
     *
     * @return $this
     */
    public function size($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return $this
     */
    public function size4x6()
    {
        $this->size = '4x6';

        return $this;
    }

    /**
     * @return $this
     */
    public function size6x11()
    {
        $this->size = '6x11';

        return $this;
    }

    /**
     * Get an array representation of the message.
     *
     * @return array
     */
    public function toArray()
    {
        return array_filter([
            'to' => $this->toAddress,
            'from' => $this->fromAddress,
            'front' => $this->front,
            'back' => $this->back,
            'merge_variables' => $this->merge_variables,
            'size' => $this->size,
        ]);
    }
}
