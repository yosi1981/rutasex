<?php
namespace App\Http\Controllers;

use Auth;
use App\Pago;
use App\Useranunciante;
use Fahim\PaypalIPN\PaypalIPNListener;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;


class PaypalController extends BaseController
{
    private $_api_context;
    public function __construct()
    {
        // setup PayPal api context
        $paypal_conf        = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function ContratarDias()
    {
        $pagos=Pago::where('iduser',Auth::user()->id)
            ->orderBy('fecha_pago','DESC')
            ->paginate(10);
        return view("anunciante.ingresoDias",["pagos"=>$pagos]);
    }

    public function pruebaIPN()
    {
        return view('paypal.prueba');
    }

    public function paypalIpn()
    {
        $ipn              = new PaypalIPNListener();
        $ipn->use_sandbox = true;

        $verified = $ipn->processIpn();

        $report = $ipn->getTextReport();
        dd($ipn);
        Log::info("-----new payment-----");

        Log::info($report);

        if ($verified) {
            if ($_POST['address_status'] == 'confirmed') {
                // Check outh POST variable and insert your logic here
                Log::info("payment verified and inserted to db");
            }
        } else {
            Log::info("Some thing went wrong in the payment !");
        }
    }

    public function postPayment(Request $request)
    {
        $dias       = $request->get('Dias');
        $precio_dia = 5;
        $payer      = new Payer();
        $payer->setPaymentMethod('paypal');
        $items    = array();
        $subtotal = 0;
        //$cart = \Session::get('cart');
        $currency = 'EUR';
        //foreach($cart as $producto){
        $item = new Item();
        $item->setName('DIAS ANUNCIO')
            ->setCurrency($currency)
            ->setDescription('DIAS DE ANUNCIO')
            ->setQuantity($dias)
            ->setPrice($precio_dia);
        $items[]  = $item;
        $subtotal = ($dias * $precio_dia);
        //}
        $item_list = new ItemList();
        $item_list->setItems($items);
        $details = new Details();
        $details->setSubtotal($subtotal);
        $total  = $subtotal;
        $amount = new Amount();
        $amount->setCurrency($currency)
            ->setTotal($total)
            ->setDetails($details);
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Pedido de prueba en mi Laravel CONTACTOS');
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(\URL::route('payment.status'))
            ->setCancelUrl(\URL::route('payment.status'));
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Ups! Algo salió mal');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        // add payment ID to session
        \Session::put('paypal_payment_id', $payment->getId());
        \Session::put('dias_a_contratar', $dias);
        if (isset($redirect_url)) {
            // redirect to paypal
            return \Redirect::away($redirect_url);
        }

    }
    public function getPaymentStatus()
    {
        $newpago = new Pago();
        // Get the payment ID before session clear
        $payment_id = \Session::get('paypal_payment_id');
        $dias       = \Session::get('dias_a_contratar');
        // clear the session payment ID
        \Session::forget('paypal_payment_id');
        \Session::forget('dias_a_contratar');
        $payerId = Input::get('PayerID');
        $token   = Input::get('token');
        //if (empty(\Input::get('PayerID')) || empty(\Input::get('token'))) {
        if (empty($payerId) || empty($token)) {
            return \Redirect::to('/')
                ->with('message', 'Hubo un problema al intentar pagar con Paypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);
        //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
        if ($result->getState() == 'approved') {
            // payment made

            $newpago->paymentID  = $payment_id;
            $newpago->payerID    = $payerId;
            $newpago->iduser     = \Auth::user()->id;
            $newpago->fecha_pago = date("Ymd");
            $newpago->dias       = $dias;
            $newpago->precio     = 5;
            $newpago->total      = $dias * 5;
            $newpago->save();
            $usuarioAnuncio=Useranunciante::findorfail(\Auth::user()->id);
            $usuarioAnuncio->dias_disponibles=$usuarioAnuncio->dias_disponibles+$dias;
            $usuarioAnuncio->save();
            return \Redirect::to('/anunciante/ContratarDias')
                ->with('message', 'Compra realizada de forma correcta');
        }
        return \Redirect::to('/anunciante/ContratarDias')
            ->with('message', 'La compra fue cancelada');
    }

}
