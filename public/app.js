            var password = document.getElementById("password");
            var newPassword = document.getElementById("newPassword");
            var repeatPassword = document.getElementById("repeatPassword");

            var openEye = document.getElementById("openEye");
            var openEye1 = document.getElementById("openEye1");
            var openEye2 = document.getElementById("openEye2");

            var closeEye = document.getElementById("closeEye");
            var closeEye1 = document.getElementById("closeEye1");
            var closeEye2 = document.getElementById("closeEye2");

            window.addEventListener('load', function() {

                if(openEye) {
                    openEye.style.display = "none";
                } 
                
                if(openEye1) {
                    openEye1.style.display = "none";
                } 
                
                if(openEye2) {
                    openEye2.style.display = "none";
                }
                
            });
            
            var productPlus = document.getElementById('productPlus');
            var productMinus = document.getElementById('productMinus');
            var productQuantity = document.getElementById('productQuantity');

            if(productPlus) {
                productPlus.addEventListener('click', function() {
                    productQuantity.stepUp();
                });

            }
            
            if(productMinus) {
                productMinus.addEventListener('click', function() {
                    productQuantity.stepDown();
                });
            }
            
            function incrementQuantity(productID) {

                let qty = document.getElementById("quantity-"+productID);

                qty.stepUp();
                let quantity = qty.value;
                
                return updateQuantity(productID, quantity);
            }

            function decrementQuantity(productID) {

                let qty = document.getElementById("quantity-"+productID);

                if(qty.value > 1) {
                    qty.stepDown();
                    let quantity = qty.value;
                
                    return updateQuantity(productID, quantity);
                }
            }
            

            function updateQuantity(productID, quantity) {

                let url = "http://localhost/complete-mvc-framework/cart/update/"+productID;

                let request = new XMLHttpRequest();

                request.onreadystatechange = function() {

                    if (request.readyState === XMLHttpRequest.DONE && request.status === 200) {
                        
                        let response = request.responseText;
                        //console.log(response);

                        document.open();
                        document.write(response);
                        document.close();

                    } 
                };

                request.open('POST', url, true);
                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.send("quantity="+quantity);

            }

            function showHidePassword() {
        
                if (password.type === "password") {
                        password.type = "text";
                        closeEye.style.display = "none";
                        openEye.style.display = "block";   
                } else {
                        password.type = "password";
                        openEye.style.display = "none";
                        closeEye.style.display = "block";  
                }
        
            }
        
            function showHidePassword1() {
        
                if (newPassword.type === "password") {
                        newPassword.type = "text";
                        closeEye1.style.display = "none";
                        openEye1.style.display = "block";   
                } else {
                        newPassword.type = "password";
                        openEye1.style.display = "none";
                        closeEye1.style.display = "block";  
                }
        
            }
        
            function showHidePassword2() {
        
                if (repeatPassword.type === "password") {
                        repeatPassword.type = "text";
                        closeEye2.style.display = "none";
                        openEye2.style.display = "block";   
                } else {
                        repeatPassword.type = "password";
                        openEye2.style.display = "none";
                        closeEye2.style.display = "block";  
                }
        
            }

            function enableSubscribe() {

                let subscribeEmail = document.getElementById('subscribeEmail').value;

                let csrf_token = document.getElementById('csrf_newsletter').value;

                let subscribe = subscribeEmail.trim();

                if(!subscribe.length > 0) {

                    return false;

                } else {

                    return subscribeNewsletterEmail(subscribe, csrf_token);

                }

            }


            function subscribeNewsletterEmail(email, csrf_token) {

                let newCsrfToken = document.getElementById('csrf_newsletter');

                let subscribeEmail = document.getElementById('subscribeEmail');

                let newsletterForm = document.getElementById('newsletterForm');

                let newsletterSubmit = document.getElementById('newsletterSubmit');

                let newsletterMessage = document.getElementById('newsletterMessage');

                let url = "http://localhost/complete-mvc-framework/newsletter";

                let request = new XMLHttpRequest();

                    request.onreadystatechange = function() {
                    
                        if(request.readyState === XMLHttpRequest.DONE && request.status === 200) {

                            let response = request.responseText.trim();

                            let result = JSON.parse(response);
            
                            if(result.success === true) {

                                clearTimeout(timeoutResponse);

                                newCsrfToken.value = result.token;
                                       
                                newsletterMessage.innerHTML = '<div class="position-absolute text-success">'+result.message+'</div>';

                                newsletterSubmit.disabled = false;

                                subscribeEmail.disabled = false;

                                newsletterForm.reset();

                            } else {

                                clearTimeout(timeoutResponse);

                                newsletterMessage.innerHTML = '<div class="mt-2 position-absolute text-warning">'+result.message+'</div>';

                                newsletterSubmit.disabled = false;

                                subscribeEmail.disabled = false;

                            } 

                        } 
                  
                    };


                request.open('POST', url, true);

                let timeoutResponse = setTimeout(function() { 
                    newsletterMessage.innerHTML = '<div class="mt-2 position-absolute spinner-border spinner-border-sm text-success" role="status">'+'<span class="sr-only">Loading...</span>'+'</div>';                                                                                                            
                    newsletterSubmit.disabled = true;
                    subscribeEmail.disabled = true;
                }, 100);

                request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                request.send("email="+email+"&"+"csrf_token="+csrf_token);

            }


            function enableSearch() {

                let searchName = document.getElementById('productName').value;
        
                let productName = searchName.trim();
        
                if(!productName.length > 0) {
        
                    return false;
        
                }
        
            }
            
            function openDropdown() {

                let openDropdown = document.getElementById('openDropdown');
            
                if(openDropdown) {

                    openDropdown.style.display = 'block';

                }
            
            }
            
            function openSubDropdown(id) {
            
                let openSubDropdown = document.getElementById('openSubDropdown-'+id);
            
                if(openSubDropdown) {

                    openSubDropdown.style.display = 'block';

                }

            }
            
            function closeDropdown() {
            
                let closeSubDropdown = document.getElementById('openDropdown');
            
                closeSubDropdown.style.display = 'none';
            
            }


            function closeSubDropdown(id) {

                let closeSubDropdown = document.getElementById('openSubDropdown-'+id);
            
                if(closeSubDropdown) {

                    closeSubDropdown.style.display = 'none';

                }

            }