<?php

namespace Src\Shared\Features\Core\Domain;

class FeatureFlag
{
    private string $name;
    private bool $enabled;

    public function __construct(string $name, bool $enabled)
    {
        $this->name = $name;
        $this->enabled = $enabled;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }
}
