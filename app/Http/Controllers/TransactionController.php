<?php

namespace App\Http\Controllers;
use App\Model\payments;
use App\model\Transactions;
use App\orders;
use App\Repository\OrderRtepository\OrderRepositoryInterface;
use App\Repository\ProductsRtepository\ProductsRtepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use SoapFault;

class TransactionController extends Controller
{
    protected $amonuts=100001;
    protected $id=1;
    /**
     * @var ProductsRtepositoryInterface
     */
    protected $products;
    /**
     * @var OrderRepositoryInterface
     */
    private $Order;

    public function __construct(OrderRepositoryInterface $Order,productsRtepositoryInterface $products){

        $this->middleware('auth');
        $this->products = $products;

        $this->Order = $Order;
    }



    public function purchase(Request $request ,$Request)
    {
        $Order_price= $this->Order->latest_Order_price($Request);

        try {

            $invoice = new Invoice;
            $invoice->amount((int)$Order_price);
            $invoice->detail('description1', 'Value1');
            $invoice->detail('description2', 'Value2');

            $user = Auth::user();

            $paymentId = md5(uniqid());
            $transaction = $user->payments()->create([
                'Product_id' =>$Request,
                'paid' => $invoice->getAmount(),
                'invoice_details' => $invoice,
                'payment_id' => $paymentId
            ]);
            $callbackUrl = route('purchase.Result', [$this->id, 'payment_id' => $paymentId,'id'=>$Request]);

            $payment = payment::callbackUrl($callbackUrl);
            $payment->config('description', 'خرید ' );

            $payment->purchase($invoice, function ($driver, $transactionId) use ($transaction) {
                $transaction->transaction_id = $transactionId;
                $transaction->save();
            });
            return $payment->pay()->render();

        } catch (Exception|InvalidPaymentException|SoapFault $exception) {
            $transaction->transaction_result = $exception;
            $transaction->status = Transactions::STATUS_FAILED;
            $transaction->save();
//            return redirect()->route('home');
//            echo $exception->getMessage();
        }

//        } catch (InvalidPaymentException $exception) {
////            $transaction->transaction_result = $e;
//            $transaction->status = payments::STATUS_FAILED;
//            $transaction->save();
//            echo $exception->getMessage();
////            return redirect()->route('home');
////            return redirect('/checkout/result')->withMessage('خطا در اتصال به درگاه بانک');
//        }
    }

    public function Result(Request $request){

//        $receipt=payment::amount($this->amonuts)->transactionId($request->Authority)
//            ->verify();
////
        if (!$request->get('payment_id')) {
//            dd($receipt);
        }

        $transaction = Transactions::where('payment_id', $request->payment_id)->first();
        if (empty($transaction)) {
//            dd($receipt);
        }
//
        if ($transaction->user_id <> Auth::id()) {
//            dd($receipt);
        }
//
        if ($request->id <> $transaction->Product_id) {
//            dd($receipt);
        }

        if ($transaction->status <> Transactions::STATUS_PENDING) {
//            dd($receipt);
        }

        try {
        $receipt = Payment::amount($transaction->paid)
            ->transactionId($transaction->transaction_id)
            ->verify();

            $transaction->transaction_result = $receipt;
            $transaction->status = Transactions::STATUS_SUCCESS;
            $transaction->save();
            $user = Auth::user();
            $pdata=new payments;
        $pdata['payment_method']='zarinpal';
        $pdata['user_id']=Auth::id();
        $pdata['Product_id']=$request->id;
        $pdata->save();
//            $user->purchased()->create(['payment_method'=>'zarinpal','user_id'=>Auth::id(),'Product_id' =>$request->id]);
            orders::where('order_id',$request->id)->update(['payment_id'=>$pdata->id,'order_status'=>' پرداخت شد','state_fa'=>1]);
//        $ds=orders::where('order_id',$request->idr)->update(['state_fa'=>1]);
            return view('page.payment_successful')->with([
                'status' => 1,
                'reference_id' => $receipt->getReferenceId(),
//                'book' => $book
            ]);

        }
         catch (Exception|InvalidPaymentException $e) {
            if ($e->getCode() < 0) {
                $transaction->status =Transactions::STATUS_FAILED;
                $transaction->transaction_result = [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                ];

                $transaction->save();
            }
                return $e->getMessage();
//            return view('page.payment_successful')->with([
//                'status' => $e->getCode(),
//                'message' => $e->getMessage()
//            ]);
        }

    }

}
