@extends('layouts.app')
@section('title', 'Payment — ' . $course->name)

@section('content')
    <section class="max-w-2xl mx-auto px-4 py-12">
        <a href="{{ route('course.detail', $course) }}" class="text-primary-600 text-sm font-medium hover:underline"><i
                class="fas fa-arrow-left mr-1"></i> Back to Course</a>

        <div class="bg-white rounded-2xl p-8 shadow-sm border border-surface-100 mt-6">
            <h1 class="text-2xl font-bold mb-2">Complete Payment</h1>
            <p class="text-surface-500 text-sm mb-6">for <span
                    class="font-semibold text-surface-800">{{ $course->name }}</span></p>

            <div class="bg-surface-50 rounded-xl p-6 mb-8">
                <div class="flex items-center justify-between">
                    <span class="text-surface-600">Amount</span>
                    <span class="text-3xl font-extrabold text-primary-600">₹{{ number_format($course->price) }}</span>
                </div>
            </div>

            {{-- UPI Option --}}
            <div class="mb-8">
                <h3 class="font-bold mb-3"><i class="fas fa-mobile-alt text-primary-500 mr-2"></i>Pay via UPI</h3>
                <div class="bg-primary-50 rounded-xl p-6 text-center mb-4">
                    <p class="text-sm text-surface-600 mb-2">Send ₹{{ number_format($course->price) }} to UPI ID:</p>
                    <p class="text-lg font-bold text-primary-700">{{ config('services.upi.id', 'thecodingscience@upi') }}
                    </p>
                    <p class="text-xs text-surface-400 mt-1">Name: {{ config('services.upi.name', 'The Coding Science') }}
                    </p>
                </div>
                <form method="POST" action="{{ route('enrollment.utr', $enrollment) }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium mb-1">Enter UTR / Transaction Ref Number</label>
                        <input type="text" name="utr" required placeholder="e.g. 412345678901" minlength="8"
                            class="w-full px-4 py-2.5 border border-surface-200 rounded-lg focus:ring-2 focus:ring-primary-500 text-sm">
                        @error('utr')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <button type="submit"
                        class="w-full py-3 bg-gradient-to-r from-primary-500 to-accent-500 text-white font-semibold rounded-xl hover:shadow-lg transition">
                        Submit Payment Reference
                    </button>
                </form>
            </div>

            <div class="relative my-6">
                <hr class="border-surface-200"><span
                    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 bg-white px-4 text-surface-400 text-sm">OR</span>
            </div>

            {{-- Razorpay Option --}}
            <div>
                <h3 class="font-bold mb-3"><i class="fas fa-credit-card text-primary-500 mr-2"></i>Pay via Razorpay</h3>
                <button id="razorpayBtn"
                    class="w-full py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition"
                    data-enrollment="{{ $enrollment->id }}">
                    Pay with Card / UPI / NetBanking
                </button>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            document.getElementById('razorpayBtn')?.addEventListener('click', async function () {
                const btn = this;
                btn.disabled = true;
                btn.textContent = 'Processing...';

                try {
                    const res = await fetch('{{ route("payment.razorpay.create") }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({ enrollment_id: btn.dataset.enrollment })
                    });
                    const data = await res.json();
                    if (data.error) { alert(data.error); btn.disabled = false; btn.textContent = 'Pay with Card / UPI / NetBanking'; return; }

                    const options = {
                        key: data.key,
                        amount: data.amount,
                        currency: 'INR',
                        name: data.name,
                        order_id: data.order_id,
                        handler: async function (response) {
                            const verifyRes = await fetch('{{ route("payment.razorpay.verify") }}', {
                                method: 'POST',
                                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                body: JSON.stringify(response)
                            });
                            const verifyData = await verifyRes.json();
                            if (verifyData.success) {
                                window.location.href = '{{ route("dashboard") }}';
                            } else {
                                alert('Verification failed. Please contact support.');
                            }
                        },
                        prefill: { email: '{{ auth()->user()->email }}', contact: '{{ auth()->user()->phone }}' },
                        theme: { color: '#6366f1' }
                    };
                    new Razorpay(options).open();
                } catch (e) { alert('Error initiating payment.'); }
                btn.disabled = false;
                btn.textContent = 'Pay with Card / UPI / NetBanking';
            });
        </script>
    @endpush
@endsection