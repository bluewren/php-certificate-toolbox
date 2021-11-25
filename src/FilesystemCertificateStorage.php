<?php

namespace Zwartpet\PHPCertificateToolbox;

use Illuminate\Support\Facades\Storage;
use Zwartpet\PHPCertificateToolbox\Exception\RuntimeException;

/**
 * A default storage implementation which stores information in a local filesystem
 * @package Zwartpet\PHPCertificateToolbox
 */
class FilesystemCertificateStorage implements CertificateStorageInterface
{
    private $dir;

    public function __construct($dir = null)
    {
        $this->dir = $dir ?? "/certs";
    }

    private function getDomainKey($domain, $suffix)
    {
        return str_replace('*', 'wildcard', $domain) . '.' . $suffix;
    }
    /**
     * @inheritdoc
     */
    public function getCertificate($domain)
    {
        return $this->getMetadata($this->getDomainKey($domain, 'crt'));
    }

    /**
     * @inheritdoc
     */
    public function setCertificate($domain, $certificate)
    {
        $this->setMetadata($this->getDomainKey($domain, 'crt'), $certificate);
    }

    /**
     * @inheritdoc
     */
    public function getFullChainCertificate($domain)
    {
        return $this->getMetadata($this->getDomainKey($domain, 'fullchain.crt'));
    }

    /**
     * @inheritdoc
     */
    public function setFullChainCertificate($domain, $certificate)
    {
        $this->setMetadata($this->getDomainKey($domain, 'fullchain.crt'), $certificate);
    }

    /**
     * @inheritdoc
     */
    public function getPrivateKey($domain)
    {
        return $this->getMetadata($this->getDomainKey($domain, 'key'));
    }

    /**
     * @inheritdoc
     */
    public function setPrivateKey($domain, $key)
    {
        $this->setMetadata($this->getDomainKey($domain, 'key'), $key);
    }

    /**
     * @inheritdoc
     */
    public function getPublicKey($domain)
    {
        return $this->getMetadata($this->getDomainKey($domain, 'public'));
    }

    /**
     * @inheritdoc
     */
    public function setPublicKey($domain, $key)
    {
        $this->setMetadata($this->getDomainKey($domain, 'public'), $key);
    }

    private function getMetadataFilename($key)
    {
        $key = str_replace('*', 'wildcard', $key);
        $file = $this->dir . DIRECTORY_SEPARATOR . $key;
        return $file;
    }
    /**
     * @inheritdoc
     */
    public function getMetadata($key)
    {
        $file = $this->getMetadataFilename($key);

        return Storage::exists($file) ? Storage::get($file) : null;
    }

    /**
     * @inheritdoc
     */
    public function setMetadata($key, $value)
    {
        $file = $this->getMetadataFilename($key);
        // if (is_null($value)) {
        //     //nothing to store, ensure file is removed
        //     if (file_exists($file)) {
        //         unlink($file);
        //     }
        // } else {

        Storage::put($file, $value);
        // }
    }

    /**
     * @inheritdoc
     */
    public function hasMetadata($key)
    {
        $file = $this->getMetadataFilename($key);
        return Storage::exists($file);
    }
}
