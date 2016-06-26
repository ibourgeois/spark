<?php

namespace iBourgeois\Spark\Http\Controllers\Stripe;

use iBourgeois\Spark\Spark;
use iBourgeois\Spark\Contracts\Billing\InvoiceNotifier;
use Laravel\Cashier\Http\Controllers\WebhookController as BaseWebhookController;

class WebhookController extends BaseWebhookController
{
    /**
     * Handle a cancelled customer from a Stripe subscription.
     *
     * By default, this e-mails a copy of the invoice to the customer.
     *
     * @param  array  $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function handleInvoicePaymentSucceeded(array $payload)
    {
        $model = config('services.stripe.model');

        $user = (new $model)->where(
            'stripe_id', $payload['data']['object']['customer']
        )->first();

        if (is_null($user)) {
            return;
        }

        app(InvoiceNotifier::class)->notify(
            $user, $user->findInvoice($payload['data']['object']['id'])
        );
    }
}
