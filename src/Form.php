<?php

namespace FormBuilder;

use FormBuilder\FormElement;

final class Form
{
    private array $elements = [];
    private bool $isOpen = false;

    public function create(string $action, string $method): self
    {
        if ($this->isOpen) {
            throw new \Exception("Form open"); 
        }
        
        $this->elements[] = sprintf("<form action='%s' method='%s'>", htmlspecialchars($action), htmlspecialchars($method));
        $this->isOpen = true;
        return $this;
    }

    private function close(): self
    {
        if ($this->isOpen) {
            $this->elements[] = "</form>";
            $this->isOpen = false;
        }
        return $this;
    }

    public function addElement(FormElement $element): self
    {
        if (!$this->isOpen) {
            throw new \Exception("erreur ");
        }

        $this->elements[] = $element;
        return $this;
    }

    public function __toString(): string
    {
        if ($this->isOpen) {
            $this->close();
        }

        return implode('', array_map(fn($element) => $element instanceof FormElement ? $element->render() : $element, $this->elements));
    }
}
