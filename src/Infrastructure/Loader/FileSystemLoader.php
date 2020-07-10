<?php

/*
 * This file is part of the FrontOne package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Infrastructure\Loader;

use Liip\ImagineBundle\Binary\Loader\LoaderInterface;
use Liip\ImagineBundle\Binary\Locator\FileSystemLocator;
use Liip\ImagineBundle\Binary\Locator\LocatorInterface;
use Liip\ImagineBundle\Exception\Binary\Loader\NotLoadableException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\File\File;
use Liip\ImagineBundle\Model\FileBinary;

/**
 * Class FileSystemLoader.
 */
class FileSystemLoader implements LoggerAwareInterface, LoaderInterface
{
    use LoggerAwareTrait;

    const MAX_SIZE = 5242880;

    /**
     * @var LocatorInterface
     */
    protected $locator;

    public function __construct(array $dataRoots)
    {
        if (empty($dataRoots)) {
            throw new \InvalidArgumentException('Data root path must be specified.');
        }

        $this->locator = new FileSystemLocator($dataRoots);
    }

    /**
     * {@inheritdoc}
     */
    public function find($path)
    {
        $path = $this->locator->locate($path);
        $file = new File($path);
        $mime = $file->getMimeType();

        if (0 !== strpos($mime, 'image/')) {
            $this->throwException(sprintf('The mime type of image %s must be image/xxx got %s.', $path, $mime));
        }

        if (self::MAX_SIZE < $file->getSize()) {
            $this->throwException(sprintf('The size of image %s must be less then 2M.', $path));
        }
        return new FileBinary($path, $mime, $file->getExtension());
    }

    /**
     * Writes to log and throws exception.
     *
     * @param string $message
     */
    protected function throwException(string $message)
    {
        $this->logger->critical('[{subject}] {exception}', [
            'subject' => 'internal-filesystem',
            'exception' => $message
        ]);

        throw new NotLoadableException();
    }
}
