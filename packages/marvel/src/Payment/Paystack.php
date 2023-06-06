<?php

namespace Marvel\Payments;

use Exception;
use Illuminate\Support\Facades\Http;
use Marvel\Exceptions\MarvelException;
use Marvel\Payments\PaymentInterface;
use Marvel\Payments\Base;
use Unicodeveloper\Paystack\Facades\Paystack as PaystackFacade;
use Illuminate\Support\Facades\Log;
// use Paystack\Paystack;


class Paystack extends Base implements PaymentInterface
{
//   public function getIntent($data)
    public function getIntent(array $data): array
  {
    // $data = [
    //     'amount' => 1000,
    //     'currency' => 'NGN',
    //     'email' => 'johndoe@example.com',
    //     'metadata' => [
    //         'order_id' => 123456,
    //     ],
    // ];
    try {
      extract($data);
// Log::info($data);
extract($data);
return ['redirect_url' => PaystackFacade::getAuthorizationUrl()->url,  'is_redirect' => true];
    } catch (Exception $e) {
      throw new MarvelException(SOMETHING_WENT_WRONG_WITH_PAYMENT);
    }
  }

//   public function verify($paymentId)
//   public function verify(array $paymentId): array
public function verify(string $paymentId): mixed
  {
    try {
      $response = Http::withHeaders([
        "Authorization" => "Bearer " . config('shop.paystack.secret_key'),
        "Cache-Control" => "no-cache",
      ])->get(config('shop.paystack.payment_url') . '/verify' . '/' . $paymentId);

      return $response->successful();
    } catch (Exception $e) {
      throw new MarvelException(SOMETHING_WENT_WRONG_WITH_PAYMENT);
    }
  }
}
