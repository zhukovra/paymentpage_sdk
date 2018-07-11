<?php

namespace ecommpay;

/**
 * Payment page URL Builder
 */
class PaymentPage
{
    /**
     * Base URL for payment
     *
     * @var string
     */
    private $baseUrl = 'https://paymentpage.ecommpay.com/payment';

    /**
     * Signature Handler
     *
     * @var SignatureHandler $signatureHandler
     */
    private $signatureHandler;

    /**
     * @param SignatureHandler $signatureHandler
     * @param string $baseUrl
     */
    public function __construct(SignatureHandler $signatureHandler, string $baseUrl = '')
    {
        $this->signatureHandler = $signatureHandler;

        if ($baseUrl) {
            $this->baseUrl = $baseUrl;
        }
    }

    /**
     * Get full URL for payment
     *
     * @param Payment $payment
     *
     * @return string
     */
    public function getUrl(Payment $payment): string
    {
        return $this->baseUrl . '?'. http_build_query($payment->getParams()) . '&signature=' .
            $this->signatureHandler->sign($payment->getParams());
    }

    /**
     * Return configuration array (for Javascript)
     *
     * @param Payment $payment
     *
     * @return array
     */
    public function getConfiguration(Payment $payment): array
    {
        return array_merge(
            $payment->getParams(),
            [
                'signature' => $this->signatureHandler->sign($payment->getParams()),
            ]
        );
    }
}
