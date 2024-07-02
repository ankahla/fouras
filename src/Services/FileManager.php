<?php
namespace Services;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    public function __construct(private string $targetDirectory)
    {
    }

    public function upload(UploadedFile $file, ?string $targetDir = null): ?string
    {
        $targetDir ??= $this->targetDirectory;

        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($targetDir, $fileName);
        } catch (FileException $e) {
            $this->logger->error($e->getMessage(),['exception' => $e]);

            return null;
        }

        return $fileName;
    }

    public function delete($filename, ?string $targetDir = null): bool
    {
        $filePath = ($targetDir ?? $this->targetDirectory).$filename;

        if (is_file($filePath)) {
            unlink($filePath);

            return true;
        }

        return false;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function setTargetDirectory(string $dir): self
    {
        if (is_dir($dir)) {
            $this->targetDirectory = $dir;
        } else {
            throw new \InvalidArgumentException('Invalide Directory: '.$dir);
        }

        return $this;
    }
}