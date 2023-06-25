<template>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                        <div class="card shadow">
                            <div class="card-body">
                                <h2 class="mb-4" style="text-align: center;">Pay</h2>
                                <form class="form-container" @submit.prevent="processPayment">
                                <div class="form-group">
                                    <label class="form-label" for="card-element">Card Details</label>
                                    <div id="card-element" ref="cardElement"></div>
                                </div>
                                <hr>
                                <div class="d-grid">
                                    <button class="d-grid" type="submit">Pay</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
  </template>

  <script>
  import { ref, onMounted } from 'vue';
  import { loadStripe } from '@stripe/stripe-js';
  import axios from 'axios';

  export default {
    name: 'PaymentForm',
    setup() {
      const cardElement = ref(null);
      let stripe = null;

      onMounted(async () => {
        stripe = await loadStripe('pk_test_51NGxNDGmA7QKNFMQAHGPm8IVsFAp2dqD7P5tvURFQCz3iDIAu0kWnOJgZ2mpVGSatoJxAKQRguqFqWC9FxYWOno800PHJXypYc');
        const elements = stripe.elements();
        const card = elements.create('card');
        card.mount('#card-element');
        cardElement.value = card;
      });

      const processPayment = async () => {
        if (!cardElement.value) {
          console.error('Card element is not mounted');
          return;
        }

        const { error, paymentMethod } = await stripe.createPaymentMethod({
          type: 'card',
          card: cardElement.value,
        });

        if (error) {
          console.error(error);
          return;
        }

        await axios.post('/api/reserve/payment', {
          paymentMethodId: paymentMethod.id,
        });

        alert('Payment successful!');
      };

      return {
        processPayment,
      };
    },
  };
  </script>
