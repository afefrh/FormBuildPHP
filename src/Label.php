<?php
namespace FormBuilder;

final class Label implements FormElement
{
    private string $for;
    private string $text;
    private array $attr = [];

    public function __construct(string $for, string $text)
    {
        $this->for = $for;
        $this->text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
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
            if ($key === 'for') {
                continue;
            }
            $attr[] = sprintf('%s="%s"', $key, htmlspecialchars($value, ENT_QUOTES, 'UTF-8'));
        }
        return sprintf('<label for="%s" %s>%s</label>', $this->for, implode(' ', $attr), $this->text);
    }
}
