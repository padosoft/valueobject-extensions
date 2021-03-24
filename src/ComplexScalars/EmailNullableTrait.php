<?php

declare(strict_types=1);

namespace Funeralzone\ValueObjectExtensions\ComplexScalars;

use Funeralzone\ValueObjects\ValueObject;

trait EmailNullableTrait
{
    /**
     * @var string
     */
    protected $string;


    /**
     * EmailTrait constructor.
     * @param ?string $string
     */
    public function __construct(?string $string)
    {
        if($string===null){
            $this->string = null;
            return;
        }

        if (!filter_var($string, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Invalid email address.');
        }

        $this->string = $string;
    }

    /**
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->string===null;
    }

    /**
     * @param ValueObject $object
     * @return bool
     */
    public function isSame(ValueObject $object): bool
    {
        if($this->string===null || $object->string===null){
            return $this->string===$object->string;
        }
        return ($this->toNative() === $object->toNative());
    }

    /**
     * @param ?string $native
     * @return static
     */
    public static function fromNative($native)
    {
        return new static($native);
    }

    /**
     * @return ?string
     */
    public function toNative()
    {
        return $this->string;
    }
}
