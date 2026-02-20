<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\UnclaimedPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Razorpay: create order (AJAX)
     */
    public function createRazorpayOrder(Request $request)
    {
        $request->validate([
            'enrollment_id' => 'required|exists:enrollments,id',
        ]);

        $enrollment = Enrollment::with('course')->findOrFail($request->enrollment_id);

        $keyId = config('services.razorpay.key');
        $keySecret = config('services.razorpay.secret');

        if (!$keyId || !$keySecret) {
            return response()->json(['error' => 'Razorpay not configured'], 500);
        }

        $api = new \Razorpay\Api\Api($keyId, $keySecret);
        $order = $api->order->create([
            'amount' => (int) ($enrollment->course->price * 100),
            'currency' => 'INR',
            'receipt' => 'enroll_' . $enrollment->id,
        ]);

        $enrollment->update(['razorpay_order_id' => $order->id]);

        return response()->json([
            'order_id' => $order->id,
            'key' => $keyId,
            'amount' => $order->amount,
            'name' => 'The Coding Science',
        ]);
    }

    /**
     * Razorpay: verify payment callback (AJAX)
     */
    public function verifyRazorpayPayment(Request $request)
    {
        $request->validate([
            'razorpay_order_id' => 'required',
            'razorpay_payment_id' => 'required',
            'razorpay_signature' => 'required',
        ]);

        $keySecret = config('services.razorpay.secret');

        $generated = hash_hmac(
            'sha256',
            $request->razorpay_order_id . '|' . $request->razorpay_payment_id,
            $keySecret
        );

        if (!hash_equals($generated, $request->razorpay_signature)) {
            return response()->json(['error' => 'Payment verification failed'], 400);
        }

        $enrollment = Enrollment::where('razorpay_order_id', $request->razorpay_order_id)->first();

        if (!$enrollment) {
            return response()->json(['error' => 'Enrollment not found'], 404);
        }

        $course = $enrollment->course;
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        $enrollment->update([
            'status' => 'completed',
            'payment_gateway' => 'razorpay',
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
            'amount_paid' => $course->price,
            'verified_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Payment verified successfully!']);
    }

    /**
     * UTR Webhook: receive SMS-based payment info
     */
    public function paymentWebhook(Request $request)
    {
        $webhookSecret = config('services.razorpay.webhook_secret');
        
        if ($webhookSecret && $request->hasHeader('X-Razorpay-Signature')) {
            $signature = $request->header('X-Razorpay-Signature');
            $payload = $request->getContent();
            $expected = hash_hmac('sha256', $payload, $webhookSecret);
            
            if (!hash_equals($expected, $signature)) {
                Log::warning('Invalid webhook signature attempt');
                return response()->json(['error' => 'Invalid signature'], 401);
            }
        }

        $request->validate([
            'utr' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        // Try to match with a pending enrollment
        $enrollment = Enrollment::where('utr', $request->utr)
            ->where('status', 'pending')
            ->first();

        if ($enrollment) {
            $enrollment->update([
                'status' => 'completed',
                'payment_gateway' => 'upi-webhook',
                'amount_paid' => $request->amount,
                'verified_at' => now(),
            ]);
            Log::info("UTR {$request->utr} matched and verified for enrollment #{$enrollment->id}");
            return response()->json(['matched' => true]);
        }

        // Store as unclaimed payment
        UnclaimedPayment::updateOrCreate(
            ['utr' => $request->utr],
            ['amount' => $request->amount, 'sender' => $request->input('sender')]
        );

        Log::info("UTR {$request->utr} stored as unclaimed payment");
        return response()->json(['matched' => false, 'stored' => true]);
    }
}
