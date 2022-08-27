<?php

namespace Tests\Src\Shared\Features\Core\Domain;

use Src\Shared\Features\Core\Domain\FeatureFlag;
use function mimic\hydrate;

class FeatureFlagTestDataBuilder
{
    private array $properties;

    public static function aFeatureFlag(string $name, bool $enabled = false): FeatureFlagTestDataBuilder
    {
        $builder = new FeatureFlagTestDataBuilder();
        $builder->properties['name'] = $name;
        $builder->properties['enabled'] = $enabled;

        return $builder;
    }

    public function build(): FeatureFlag
    {
        return hydrate(FeatureFlag::class, $this->properties);
    }
}
