<?php

namespace App\Http\Controllers\Frontend\BankID;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BankIDService;
use Dimafe6\BankID\Model\CollectResponse;
use Dimafe6\BankID\Model;

class BankIDController extends Controller
{
    private $bankIDService;

    public function __construct()
    {
        //'https://appapi2.bankid.com/rp/v5.1',
        $this->bankIDService = new BankIDService(
            'https://appapi2.test.bankid.com/rp/v5.1',
            isset($_SERVER["REMOTE_ADDR"]) ? $_SERVER["REMOTE_ADDR"] : '127.0.0.1',
            [
                'verify' => true,
                'cert'   => [env('APP_URL') . "bankid/certs/FPTestcert4_20220818.p12", "qwerty123"] // qwerty123 = default password from BankID,
            ]
        );
    }
    public function index(Request $request)
    {
        return view('frontend.BankID.index');
    }

    public function bankid_post(Request $request)
    {
        // Signing. Step 1 - Get orderRef
        /** @var OrderResponse $response */
        $response = $this->bankIDService->getSignResponse($request->personal_number, 'User visible data', "user non visible data", "user visible data format");

        // Signing. Step 2 - Collect orderRef.
        // Repeat until $collectResponse->status !== CollectResponse::STATUS_COMPLETED
        $collectResponse = $this->bankIDService->collectResponse($response->orderRef);
        if ($collectResponse->status === CollectResponse::STATUS_COMPLETED) {
            return true; //Signed successfully
        }

        // Authorize. Step 1 - Get orderRef
        $response = $this->bankIDService->getAuthResponse($request->personal_number);
        // Authorize. Step 2 - Collect orderRef.
        // Repeat until $authResponse->status !== CollectResponse::STATUS_COMPLETED
        $authResponse = $this->bankIDService->collectResponse($response->orderRef);
        if ($authResponse->status == CollectResponse::STATUS_COMPLETED) {
            return true; //Authorized
        }

        // Cancel auth or collect order
        // Authorize. Step 1 - Get orderRef
        $response = $this->bankIDService->getAuthResponse('PERSONAL_NUMBER');

        // Cancel authorize order
        if ($this->bankIDService->cancelOrder($response->orderRef)) {
            return 'Authorization canceled';
        }
    }
}
