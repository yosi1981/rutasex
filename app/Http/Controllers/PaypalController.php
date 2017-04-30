<?php 
namespace App\Http\Controllers;


use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Fahim\PaypalIPN\PaypalIPNListener;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PayerInfo;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Illuminate\Support\Facades\Input;
use App\Pago;
use App\Auth;


class PaypalController extends BaseController
{
	private $_api_context;
	public function __construct()
	{
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}

	public function pruebaIPN()
	{
		return view('paypal.prueba');
	}
	public function postPayment()
	{
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');
		$items = array();
		$subtotal = 0;
		//$cart = \Session::get('cart');
		$currency = 'EUR';
		//foreach($cart as $producto){
			$item = new Item();
			$item->setName('DIAS ANUNCIO')
			->setCurrency($currency)
			->setDescription('DIAS DE ANUNCIO')
			->setQuantity(25)
			->setPrice(5);
			$items[] = $item;
		$subtotal =(125);
		//}
		$item_list = new ItemList();
		$item_list->setItems($items);
		$details = new Details();
		$details->setSubtotal($subtotal);
		$total = $subtotal ;
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
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
		// add payment ID to session
		\Session::put('paypal_payment_id', $payment->getId());
		if(isset($redirect_url)) {
			// redirect to paypal
			return \Redirect::away($redirect_url);
		}

	}
	public function getPaymentStatus()
	{
		$newpago=new Pago();
		// Get the payment ID before session clear
		$payment_id = \Session::get('paypal_payment_id');
		// clear the session payment ID
		\Session::forget('paypal_payment_id');
		$payerId = Input::get('PayerID');
		$token = Input::get('token');
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
		if ($result->getState() == 'approved') { // payment made

			$newpago->paymentID=$payment_id;
			$newpago->payerID=$payerId;
			$newpago->iduser=\Auth::user()->id;
			$newpago->fecha_pago=date("Ymd");
			$newpago->dias=25;
			$newpago->precio=5;
			$newpago->total=125;
			$newpago->save();
			return \Redirect::to('/')
				->with('message', 'Compra realizada de forma correcta');
		}
		return \Redirect::to('/')
			->with('message', 'La compra fue cancelada');
	}


 

}