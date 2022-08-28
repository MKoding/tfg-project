<?php

namespace Tests\Src\Shared\Features\Core\Infrastructure\Persistence\Repositories;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Mockery;
use Src\Shared\Features\Core\Application\Exceptions\FeatureFlagAlreadyExistsException;
use Src\Shared\Features\Core\Application\Exceptions\FeatureFlagNotFoundException;
use Src\Shared\Features\Core\Domain\FeatureFlag;
use Src\Shared\Features\Core\Infrastructure\Persistence\Repositories\DoctrineFeatureFlagRepository;
use Tests\BaseTestCase;
use Tests\Src\Shared\Features\Core\Domain\FeatureFlagTestDataBuilder;

/**
 * @group Unit
 */
class DoctrineFeatureFlagRepositoryTest extends BaseTestCase
{
    private ObjectRepository $objectRepository;
    private ObjectManager $objectManager;
    private ManagerRegistry $managerRegistry;
    private DoctrineFeatureFlagRepository $doctrineFeatureFlagRepository;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->objectRepository = Mockery::mock(ObjectRepository::class);
        $this->objectManager = Mockery::mock(ObjectManager::class);
        $this->managerRegistry = Mockery::mock(ManagerRegistry::class);
        $this->managerRegistry->shouldReceive('getManager')
            ->with('default')
            ->once()
            ->andReturn($this->objectManager);
        $this->objectManager->shouldReceive('getRepository')
            ->with(FeatureFlag::class)
            ->once()
            ->andReturn($this->objectRepository);
        $this->doctrineFeatureFlagRepository = new DoctrineFeatureFlagRepository($this->managerRegistry);
    }

    /**
     * @test
     */
    public function doesntAddFeatureFlagIfAlreadyExists()
    {
        $name = 'feature_flag';
        $featureFlag = FeatureFlagTestDataBuilder::aFeatureFlag($name)->build();
        $this->objectRepository->shouldReceive('find')
            ->with($name)
            ->once()
            ->andReturn($featureFlag);

        $this->expectException(FeatureFlagAlreadyExistsException::class);

        $this->doctrineFeatureFlagRepository->add($name, false);
    }

    /**
     * @test
     */
    public function addsFeatureFlag()
    {
        $name = 'feature_flag';
        $this->objectRepository->shouldReceive('find')
            ->with($name)
            ->once()
            ->andReturnNull();
        $this->objectManager->shouldReceive('persist')
            ->once();
        $this->objectManager->shouldReceive('flush')
            ->once();

        $this->doctrineFeatureFlagRepository->add($name, false);
    }

    /**
     * @test
     */
    public function doesntEditFeatureFlagIfDoesntExists()
    {
        $name = 'feature_flag';
        $this->objectRepository->shouldReceive('find')
            ->with($name)
            ->once()
            ->andReturnNull();

        $this->expectException(FeatureFlagNotFoundException::class);

        $this->doctrineFeatureFlagRepository->edit($name, true);
    }

    /**
     * @test
     */
    public function editsFeatureFlag()
    {
        $name = 'feature_flag';
        $featureFlag = FeatureFlagTestDataBuilder::aFeatureFlag($name)->build();
        $this->objectRepository->shouldReceive('find')
            ->with($name)
            ->once()
            ->andReturn($featureFlag);
        $this->objectManager->shouldReceive('remove')
            ->with($featureFlag)
            ->once();
        $this->objectManager->shouldReceive('flush')
            ->with($featureFlag)
            ->twice();
        $this->objectManager->shouldReceive('persist')
            ->with($featureFlag)
            ->once();

        $this->doctrineFeatureFlagRepository->edit($name, true);
    }

    /**
     * @test
     */
    public function doesntDeleteFeatureFlagByNameIfDoesntExists()
    {
        $name = 'feature_flag';
        $this->objectRepository->shouldReceive('find')
            ->with($name)
            ->once()
            ->andReturnNull();

        $this->expectException(FeatureFlagNotFoundException::class);

        $this->doctrineFeatureFlagRepository->deleteByName($name);
    }

    /**
     * @test
     */
    public function deletesFeatureFlagByName()
    {
        $name = 'feature_flag';
        $featureFlag = FeatureFlagTestDataBuilder::aFeatureFlag($name)->build();
        $this->objectRepository->shouldReceive('find')
            ->with($name)
            ->once()
            ->andReturn($featureFlag);
        $this->objectManager->shouldReceive('remove')
            ->with($featureFlag)
            ->once();
        $this->objectManager->shouldReceive('flush')
            ->with($featureFlag)
            ->once();

        $this->doctrineFeatureFlagRepository->deleteByName($name);
    }

    /**
     * @test
     */
    public function doesntGetFeatureFlagByNameIfDoesntExists()
    {
        $name = 'feature_flag';
        $this->objectRepository->shouldReceive('find')
            ->with($name)
            ->once()
            ->andReturnNull();

        $this->expectException(FeatureFlagNotFoundException::class);

        $this->doctrineFeatureFlagRepository->getByName($name);
    }

    /**
     * @test
     */
    public function getsFeatureFlagByName()
    {
        $name = 'feature_flag';
        $expectedFeatureFlag = FeatureFlagTestDataBuilder::aFeatureFlag($name)->build();
        $this->objectRepository->shouldReceive('find')
            ->with($name)
            ->once()
            ->andReturn($expectedFeatureFlag);

        $featureFlag = $this->doctrineFeatureFlagRepository->getByName($name);

        $this->assertEquals($expectedFeatureFlag, $featureFlag);
    }
}
