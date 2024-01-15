<div class="container">
    <div class="justify-content-center">
        <div class="shadow rounded bg-white">
            <div class="px-4 py-2">
                <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
                    <h1 class="">Pricing</h1>
                    <p class="fs-5 text-body-secondary">Quickly build an effective pricing table for your potential
                        customers
                        with
                        this Bootstrap example. It’s built with default Bootstrap components and utilities with little
                        customization.</p>
                    <div class="mx-auto">
                        <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                            <div class="col">
                                <div class="card mb-4 rounded-3 shadow-sm">
                                    <div class="card-header py-3">
                                        <h4 class="my-0 fw-normal">Pro</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="pricing-card-title">$25<small
                                                class="text-body-secondary fw-light">/mensual</small>
                                        </h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>20 users included</li>
                                            <li>10 GB of storage</li>
                                            <li>Priority email support</li>
                                            <li>Help center access</li>
                                        </ul>
                                        @if (auth()->user()->subscribedToPrice('price_1OFK3zFQC2bFZOM4OaO92fPF', 'importador 3 en 1'))
                                            Suscrito
                                        @else
                                            <button type="button" class="w-100 btn btn-primary" wire:loading.attr="disabled"
                                                wire:click="getSuscription('price_1OFK3zFQC2bFZOM4OaO92fPF')">
                                                <div class="d-flex">
                                                    <div wire:target="getSuscription('price_1OFK3zFQC2bFZOM4OaO92fPF')"
                                                        wire:loading>
                                                        <div class="spinner-border spinner-border-sm" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span>Comprar</span>
                                                    </div>
                                                </div>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card mb-4 rounded-3 shadow-sm">
                                    <div class="card-header py-3">
                                        <h4 class="my-0 fw-normal">Pro</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="card-title pricing-card-title">$75<small
                                                class="text-body-secondary fw-light">/trimestral</small>
                                        </h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>20 users included</li>
                                            <li>10 GB of storage</li>
                                            <li>Priority email support</li>
                                            <li>Help center access</li>
                                        </ul>
                                        @if (auth()->user()->subscribedToPrice('price_1OFK7QFQC2bFZOM4MMh04HkD', 'importador 3 en 1'))
                                            Suscrito
                                        @else
                                            <button type="button" class="w-100 btn btn-primary" wire:loading.attr="disabled"
                                                wire:click="getSuscription('price_1OFK7QFQC2bFZOM4MMh04HkD')">
                                                <div class="d-flex">
                                                    <div wire:target="getSuscription('price_1OFK7QFQC2bFZOM4MMh04HkD')"
                                                        wire:loading>
                                                        <div class="spinner-border spinner-border-sm" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span>Comprar</span>
                                                    </div>
                                                </div>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card mb-4 rounded-3 shadow-sm">
                                    <div class="card-header py-3">
                                        <h4 class="my-0 fw-normal">Pro</h4>
                                    </div>
                                    <div class="card-body">
                                        <h1 class="card-title pricing-card-title">$100<small
                                                class="text-body-secondary fw-light">/semestral</small>
                                        </h1>
                                        <ul class="list-unstyled mt-3 mb-4">
                                            <li>20 users included</li>
                                            <li>10 GB of storage</li>
                                            <li>Priority email support</li>
                                            <li>Help center access</li>
                                        </ul>
                                        @if (auth()->user()->subscribedToPrice('price_1OFK7eFQC2bFZOM4EiaTheTU', 'importador 3 en 1'))
                                            Suscrito
                                        @else
                                            <button type="button" class="w-100 btn btn-primary" wire:loading.attr="disabled"
                                                wire:click="getSuscription('price_1OFK7eFQC2bFZOM4EiaTheTU')">
                                                <div class="d-flex">
                                                    <div wire:target="getSuscription('price_1OFK7eFQC2bFZOM4EiaTheTU')"
                                                        wire:loading>
                                                        <div class="spinner-border spinner-border-sm" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                        <div class="spinner-grow spinner-grow-sm" role="status">
                                                            <span class="visually-hidden">Loading...</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <span>Comprar</span>
                                                    </div>
                                                </div>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-2 d-flex justify-content-center align-items-center">
            <div wire:target='addMethodPaymed' wire:loading>
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="spinner-grow spinner-grow-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="shadow p-3 mb-5 bg-white rounded">
                    <div class="px-4 py-4 mb-8">
                        <h4>Agregar metodo de pago</h4>
                        <hr>
                        <p class="float-start">Información de tarjeta</p>
                        <div wire:ignore>
                            <input id="card-holder-name" class="form-control" type="text">

                            <!-- Stripe Elements Placeholder -->
                            <div id="card-element" class="form-control mt-2"></div>
                            <span class="text-danger text-sm" id="error"></span>

                        </div>
                        <section class="mb-2 py-2">
                            <button id="card-button" class="btn btn-dark float-end mt-2"
                                data-secret="{{ $intent->client_secret }}">
                                Update Payment Method
                            </button>
                        </section>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                @if (count($paymentMethods))
                    <section class="shadow rounded">
                        <header class="bg-light px-4 py-2">
                            <h4 class="fw-semibold mt-2">Métodos de pago</h4>
                        </header>
                        <div class="bg-white py-2 px-2">
                            <ul class="list-group list-group-flush">
                                @foreach ($paymentMethods as $item)
                                    <li class="list-group-item" wire:key='{{ $item->id }}'>
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p><span class="fw-semibold">{{ $item->billing_details->name }}</span>
                                                    xxxx-{{ $item->card->last4 }}
                                                    @if ($this->defaultPaymentMethod->id == $item->id)
                                                        <span
                                                            class="badge rounded-pill text-bg-primary">Predeterminado</span>
                                                    @endif
                                                </p>
                                                <p>Expira: {{ $item->card->exp_month . '/' . $item->card->exp_year }}
                                                </p>
                                            </div>
                                            @if ($this->defaultPaymentMethod->id != $item->id)
                                                <div>
                                                    <a wire:target="deleteMethodPaymed('{{ $item->id }}')"
                                                        wire:loading.attr='disabled'
                                                        wire:click="deleteMethodPaymed('{{ $item->id }}')"
                                                        type="button"><i
                                                            class="fa-regular fa-trash-can text-danger"></i></a>
                                                    <a wire:target="defaultMethodPaymed('{{ $item->id }}')"
                                                        wire:loading.attr='disabled'
                                                        wire:click="defaultMethodPaymed('{{ $item->id }}')"
                                                        type="button"><i class="fa-regular fa-star"></i></a>
                                                </div>
                                            @endif
                                        </div>

                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                @else
                    <div class="alert alert-warning">No existen meotodos de pagos</div>
                @endif
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');
    </script>
    <script>
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');


        cardButton.addEventListener('click', async (e) => {
            cardButton.disabled = true;

            const clientSecret = cardButton.dataset.secret;

            const {
                setupIntent,
                error
            } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: cardHolderName.value
                        }
                    }
                }
            );
            cardButton.disabled = false
            if (error) {
                let span = document.getElementById('error');
                span.textContent = error.message;
            } else {
                @this.addMethodPaymed(setupIntent.payment_method);
                cardHolderName.value = '';
                cardElement.clear();
            }
        });
    </script>
    <script>
        Livewire.on('er', function(event){
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: event,
            });
        });
    </script>
@endpush
