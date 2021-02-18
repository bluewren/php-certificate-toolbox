<?php

namespace Zwartpet\PHPCertificateToolbox;

use Zwartpet\PHPCertificateToolbox\Exception\RuntimeException;

/**
 * A default storage implementation which stores information in a local filesystem
 * @package Zwartpet\PHPCertificateToolbox
 */
class FilesystemAccountStorage implements AccountStorageInterface
{
    private $dir;

    public function __construct($dir = null)
    {
        $this->dir = $dir ?? getcwd().DIRECTORY_SEPARATOR.'account';

        if (!is_dir($this->dir)) {
            /** @scrutinizer ignore-unhandled */ @mkdir($this->dir);
        }
        if (!is_writable($this->dir)) {
            throw new RuntimeException("{$this->dir} is not writable");
        }
    }


    /**
     * @inheritdoc
     */
    public function getAccountPublicKey()
    {
        return $this->getMetadata('account.public');
    }

    /**
     * @inheritdoc
     */
    public function setAccountPublicKey($key)
    {
        $this->setMetadata('account.public', $key);
    }

    /**
     * @inheritdoc
     */
    public function getAccountPrivateKey()
    {
        return $this->getMetadata('account.key');
    }

    /**
     * @inheritdoc
     */
    public function setAccountPrivateKey($key)
    {
        $this->setMetadata('account.key', $key);
    }

    private function getMetadataFilename($key)
    {
        $key=str_replace('*', 'wildcard', $key);
        $file=$this->dir.DIRECTORY_SEPARATOR.$key;
        return $file;
    }
    /**
     * @inheritdoc
     */
    public function getMetadata($key)
    {
        $file=$this->getMetadataFilename($key);
        if (!file_exists($file)) {
            return null;
        }
        return file_get_contents($file);
    }

    /**
     * @inheritdoc
     */
    public function setMetadata($key, $value)
    {
        $file=$this->getMetadataFilename($key);
        if (is_null($value)) {
            //nothing to store, ensure file is removed
            if (file_exists($file)) {
                unlink($file);
            }
        } else {
            file_put_contents($file, $value);
        }
    }
}
