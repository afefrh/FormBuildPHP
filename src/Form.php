<?php

namespace FormBuilder;

use FormBuilder\FormElement;

final class Form
{
    private array $elements = [];

    private function __construct(string $action, string $method)
    {
        $this->elements[] = sprintf("<form action='%s' method='%s'>", htmlspecialchars($action), htmlspecialchars($method));
    }

    public static function create(string $action, string $method): self
    {
        return new self($action, $method);
    }

    private function close(): self
    {
        $this->elements[] = "</form>";
        return $this;
    }

    public function addElement(FormElement $element): self
    {
        $this->elements[] = $element;
        return $this;
    }

    public function __toString(): string
    {
        $this->close();
        return implode('', array_map(fn ($element) => $element instanceof FormElement ? $element->render() : $element, $this->elements));
    }
}
