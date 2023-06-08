<template>
    <footer class="bg-light text-black">
        <div class="container">
            
          <div class="row">
            <div class="col-md-4" style="margin-top: 50px;">
              <h4>Company Name</h4>
              <p>123 Main St<br>
              Anytown, USA 12345</p>
              <p>Phone: (123) 456-7890<br>
              Email: info@companyname.com</p>
            </div>
            <div class="col-md-4" style="margin-top: 50px;">
              <h4>Follow Us</h4>
              <ul class="list-unstyled">
                <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
              </ul>
            </div>
            <div class="col-md-4" style="margin-top: 50px;">
              <h4>Accepted Payment Methods</h4>
              <ul class="list-unstyled">
                <li><i class="fab fa-cc-visa"></i> VISA</li>
                <li><i class="fab fa-cc-mastercard"></i> MasterCard</li>
                <li><i class="fas fa-wallet"></i> TnG E-wallet</li>
              </ul>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 text-center">
              <hr>
              <p>&copy; {{ new Date().getFullYear() }} Company Name. All rights reserved.</p>
            </div>
          </div>

        </div>
    </footer>
</template>