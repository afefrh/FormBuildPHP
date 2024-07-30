<?php

namespace FormBuilder;

final class Input implements FormElement
{

    private string $name;
    private string $type;
    private array $attr = [];

    public function __construct(string $name, string $type)
    {
        $this->type = $type;
        $this->name = $name;
    }

    public function attr(array $attr) :self {
        $this->attr = $attr;
        return $this;
    }

    public function render(): string
    {
        $attr = [];
        foreach($this->attr as $key => $value) {
            if (in_array($key, self::notAllowedAttributes())) {
                continue;
            }

            $attr[] =  sprintf('%s="%s"', $key, $value);
        }
        return sprintf('<input type="%s" name="%s" %s>', $this->type, $this->name, implode(' ', $attr));
    }


    private static function notAllowedAttributes() : array {
        return [
            'name',
            'type'
        ];
    }
}
