<?php

namespace Src\Shared\Features\Core\Infrastructure\Persistence\Repositories;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Src\Shared\Features\Core\Application\Exceptions\FeatureFlagAlreadyExistsException;
use Src\Shared\Features\Core\Application\Exceptions\FeatureFlagNotFoundException;
use Src\Shared\Features\Core\Domain\FeatureFlag;
use Src\Shared\Features\Core\Domain\Repositories\FeatureFlagRepository;

class DoctrineFeatureFlagRepository implements FeatureFlagRepository
{
    private ObjectManager $objectManager;
    private ObjectRepository $objectRepository;


    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->objectManager = $managerRegistry->getManager('default');
        $this->objectRepository = $this->objectManager->getRepository(FeatureFlag::class);
    }

    /**
     * @throws FeatureFlagAlreadyExistsException
     */
    public function add(string $name, bool $enabled = false): void
    {
        /** @var FeatureFlag $featureFlag */
        $featureFlag = $this->objectRepository->find($name);
        if (!is_null($featureFlag)) {
            throw new FeatureFlagAlreadyExistsException();
        }

        $featureFlag = new FeatureFlag($name, $enabled);
        $this->objectManager->persist($featureFlag);
        $this->objectManager->flush($featureFlag);
    }

    /**
     * @throws FeatureFlagNotFoundException
     */
    public function edit(string $name, bool $enabled): void
    {
        /** @var FeatureFlag $featureFlag */
        $featureFlag = $this->objectRepository->find($name);
        if (is_null($featureFlag)) {
            throw new FeatureFlagNotFoundException();
        }

        $this->objectManager->remove($featureFlag);
        $this->objectManager->flush($featureFlag);

        $featureFlag->setEnabled($enabled);
        $this->objectManager->persist($featureFlag);
        $this->objectManager->flush($featureFlag);
    }

    /**
     * @throws FeatureFlagNotFoundException
     */
    public function deleteByName(string $name): void
    {
        $featureFlag = $this->objectRepository->find($name);
        if (is_null($featureFlag)) {
            throw new FeatureFlagNotFoundException();
        }

        $this->objectManager->remove($featureFlag);
        $this->objectManager->flush($featureFlag);
    }

    /**
     * @throws FeatureFlagNotFoundException
     */
    public function getByName(string $name): FeatureFlag
    {
        /** @var FeatureFlag $featureFlag */
        $featureFlag = $this->objectRepository->find($name);
        if (is_null($featureFlag)) {
            throw new FeatureFlagNotFoundException();
        }

        return $featureFlag;
    }

    /**
     * @return FeatureFlag[]
     */
    public function getAll(): array
    {
        return $this->objectRepository->findAll();
    }
}
