<?php

namespace Zwartpet\PHPCertificateToolbox;

/**
 * Interface CertificateStorageInterface
 * A class can implement this interface to store or deploy certificates anywhere, e.g. database, filesystem
 * remote server etc...
 */
interface CertificateStorageInterface
{
    /**
     * Get the certificate for the given domain
     *
     * @param $domain string given base domain of certificate (which might include *.wildcard)
     * @return string|null returns null if no certificate is available for domain
     */
    public function getCertificate($domain);

    /**
     * Set the certificate for the given domain
     *
     * @param $domain string given base domain of certificate (which might include *.wildcard)
     * @param $certificate string containing certificate
     */
    public function setCertificate($domain, $certificate);

    /**
     * Get the full chain certificate for the given domain
     *
     * @param $domain string given base domain of certificate (which might include *.wildcard)
     * @return string|null returns null if no certificate is available for domain
     */
    public function getFullChainCertificate($domain);

    /**
     * Set the full chain certificate for the given domain
     *
     * @param $domain string given base domain of certificate (which might include *.wildcard)
     * @param $certificate string containing certificate with any necessary chained certificates
     */
    public function setFullChainCertificate($domain, $certificate);

    /**
     * Get public key for given certificate
     * @param $domain string given base domain of certificate (which might include *.wildcard)
     * @return string|null returns null if no certificate is available for domain
     */
    public function getPublicKey($domain);

    /**
     * Set public key for domain
     * @param $domain string given base domain of certificate (which might include *.wildcard)
     * @param $key string containing private key for domain
     */
    public function setPublicKey($domain, $key);

    /**
     * Get private key for given certificate
     * @param $domain string given base domain of certificate (which might include *.wildcard)
     * @return string|null returns null if no certificate is available for domain
     */
    public function getPrivateKey($domain);

    /**
     * Set private key for domain
     * @param $domain string given base domain of certificate (which might include *.wildcard)
     * @param $key string containing private key for domain
     */
    public function setPrivateKey($domain, $key);

    /**
     * Get arbitrary persistent metadata
     * @param $key string unique key
     * @return mixed
     */
    public function getMetadata($key);

    /**
     * Store persistent metadata
     * @param $key string unique key
     * @param $value string value to store under given key
     */
    public function setMetadata($key, $value);
}
