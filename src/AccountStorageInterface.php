<?php

namespace Zwartpet\PHPCertificateToolbox;

/**
 * Interface CertificateStorageInterface
 * A class can implement this interface to store or deploy certificates anywhere, e.g. database, filesystem
 * remote server etc...
 */
interface AccountStorageInterface
{
    /**
     * Get the public key for the ACME account
     * @return string
     */
    public function getAccountPublicKey();

    /**
     * Set the public key for the ACME account
     * @return string
     */
    public function setAccountPublicKey($key);

    /**
     * Get the private key for the ACME account
     * @return string
     */
    public function getAccountPrivateKey();

    /**
     * Set the private key for the ACME account
     * @return string
     */
    public function setAccountPrivateKey($key);
}
