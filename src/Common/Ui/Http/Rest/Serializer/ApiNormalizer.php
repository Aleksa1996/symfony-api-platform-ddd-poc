<?php

namespace App\Common\Ui\Http\Rest\Serializer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use ApiPlatform\Core\Hydra\Serializer\PartialCollectionViewNormalizer;

final class ApiNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    /**
     * @var PartialCollectionViewNormalizer
     */
    private PartialCollectionViewNormalizer $decorated;

    /**
     * @param NormalizerInterface $decorated
     */
    public function __construct(NormalizerInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }

    /**
     * @inheritDoc
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = $this->decorated->normalize($object, $format, $context);

        if (!\is_array($data)) {
            throw new UnexpectedValueException('Expected data to be an array');
        }

        if (isset($context['api_sub_level'])) {
            return $data;
        }

        return $data;
    }

    /**
     * @param NormalizerInterface $normalizer
     *
     * @return void
     */
    public function setNormalizer(NormalizerInterface $normalizer): void
    {
        if ($this->decorated instanceof NormalizerAwareInterface) {
            $this->decorated->setNormalizer($normalizer);
        }
    }
}
