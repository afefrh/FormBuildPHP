<?php
namespace FormBuilder;

final class Textarea implements FormElement
{
    private string $name;
    private string $value;
    private array $attr = [];

    public function __construct(string $name, string $value = '')
    {
        $this->name = $name;
        $this->value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    public function attr(array $attr): self
    {
        $this->attr = $attr;
        return $this;
    }

    public function render(): string
    {
        $attr = [];
        foreach ($this->attr as $key => $value) {
            if ($key === 'name') {
                continue;
            }
            $attr[] = sprintf('%s="%s"', $key, htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
        }
        return sprintf('<textarea name="%s" %s>%s</textarea>', $this->name, implode(' ', $attr), $this->value);
    }
}
