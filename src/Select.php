<?php
namespace FormBuilder;

final class Select implements FormElement
{
    private string $name;
    private array $options;
    private array $attr = [];

    public function __construct(string $name, array $options = [])
    {
        $this->name = $name;
        $this->options = $options;
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
        $options = '';
        foreach ($this->options as $value => $text) {
            $options .= sprintf('<option value="%s">%s</option>', htmlspecialchars($value, ENT_QUOTES, 'UTF-8'), htmlspecialchars($text, ENT_QUOTES, 'UTF-8'));
        }
        return sprintf('<select name="%s" %s>%s</select>', $this->name, implode(' ', $attr), $options);
    }
}
