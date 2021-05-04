<?php

namespace App\Common\Ui\Http\Rest\Serializer;


use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;

final class ApiNormalizer implements NormalizerInterface, NormalizerAwareInterface
{

    private $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }

    public function normalize($object, $format = null, array $context = [])
    {
        // dd($object);
        // dd($format);
        // dd($context);

        $data = $this->decorated->normalize($object, $format, $context);

        if (!\is_array($data)) {
            throw new UnexpectedValueException('Expected data to be an array');
        }

        if (isset($context['api_sub_level'])) {
            return $data;
        }

        // dd($data);


        return $data;
    }

    public function setNormalizer(NormalizerInterface $normalizer)
    {
        if ($this->decorated instanceof NormalizerAwareInterface) {
            $this->decorated->setNormalizer($normalizer);
        }
    }
}
