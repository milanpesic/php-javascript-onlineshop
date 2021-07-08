   
   </div>

    <footer class="shadow p-5" style="background: black; margin-top: 100px;">

        <div class="container-fluid">

            <div class="row d-flex justify-content-between align-items-center">

                <div class="col-md-5 p-3">

                    <form id="newsletterForm" method="post" class="input-group form-inline">

                        <input type="text" class="form-control shadow-none" id="subscribeEmail" onkeypress="if(event.keyCode === 13) { event.preventDefault(); return enableSubscribe(); }"  name="email" placeholder="Email newsletter">

                        <input type="hidden" id="csrf_newsletter" name="csrf_newsletter" value="<?= Token::generated('csrf_newsletter'); ?>">

                        <div class="input-group-append">

                            <input id="newsletterSubmit" type="button" class="btn btn-secondary shadow-none" onclick="return enableSubscribe()" value="Subscribe">

                        </div>

                    </form>

                    <div id="newsletterMessage"></div>

                </div>

                <div class="col-md-auto d-flex justify-content-center p-3">
                    <ul class="list-group list-group-horizontal">
                        <li class="list-group-item rounded ml-1 bg-light"><a href="<?php echo $config['url']['path'] ?>"><img src="<?php echo $config['url']['path'] . 'public/facebook.png'; ?>" alt="" width="30px"></a></li>
                        <li class="list-group-item rounded ml-1 bg-light"><a href="<?php echo $config['url']['path'] ?>"><img src="<?php echo $config['url']['path'] . 'public/twitter.png'; ?>" alt="" width="30px"></a></li>
                        <li class="list-group-item rounded ml-1 bg-light"><a href="<?php echo $config['url']['path'] ?>"><img src="<?php echo $config['url']['path'] . 'public/instagram.png'; ?>" alt="" width="30px"></a></li>
                    </ul>
                
                </div>

            </div>

            <div class="row mb-5">

                <div class="col-md-auto mt-5 mb-5">

                    <h5 class="text-light font-weight-bold">Online Shop</h5>

                    <hr class="bg-light">

                    <div class="text-muted">
                        
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aenean facilisis arcu ac nisi vulputate, non venenatis augue bibendum.
                        Nunc fermentum diam non vulputate iaculis.
                        Aliquam tempor nulla vitae ligula viverra feugiat.
                        Cras rutrum nibh sed ligula efficitur, vitae vestibulum lectus eleifend.
                
                    </div>

                </div>

                <div class="col-md-4 text-center">  

                        <h5 class="text-light font-weight-bold">Links</h5>
                        <hr class="bg-light">
                        <ul class="list-unstyled">
                            <li><a class="text-left text-muted" href="<?php echo $config['url']['path'] . 'home' ?>">Home</a></li>
                            <li><a class="text-left text-muted" href="<?php echo $config['url']['path'] . 'products' ?>">Products</a></li>
                            <li><a class="text-left text-muted" href="<?php echo $config['url']['path'] . 'about' ?>">About</a></li>
                            <li><a class="text-left text-muted" href="<?php echo $config['url']['path'] . 'contact' ?>">Contact</a></li>
                        </ul>
                </div>

                <div class="col-md-4 justify-content-center text-center">
                    <h5 class="text-light font-weight-bold">Resources</h5>
                    <hr class="bg-light">
                    <ul class="list-unstyled">
                    <li><a class="text-muted" href="https://www.php.net/">PHP</a></li>
                    <li>
                        <a class="text-muted" href="https://getbootstrap.com/">
                            Bootstrap 
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bootstrap-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.002 0a4 4 0 0 0-4 4v8a4 4 0 0 0 4 4h8a4 4 0 0 0 4-4V4a4 4 0 0 0-4-4h-8zm1.06 12h3.475c1.804 0 2.888-.908 2.888-2.396 0-1.102-.761-1.916-1.904-2.034v-.1c.832-.14 1.482-.93 1.482-1.816 0-1.3-.955-2.11-2.542-2.11H5.062V12zm1.313-4.875V4.658h1.78c.973 0 1.542.457 1.542 1.237 0 .802-.604 1.23-1.764 1.23H6.375zm0 3.762h1.898c1.184 0 1.81-.48 1.81-1.377 0-.885-.65-1.348-1.886-1.348H6.375v2.725z"/>
                            </svg>
                        </a>
                    </li>

                    <li><a class="text-muted" href="https://laravel.com/">Laravel</a></li>
                    <li><a class="text-muted" href="https://vuejs.org/">Vue.js</a></li>
                    <li><a class="text-muted" href="https://git-scm.com/">Git</a></li>
                    
                    </ul>

                </div>

                <div class="col-md-4 justify-content-center">

                    <h5 class="text-light font-weight-bold">Info</h5>

                    <hr class="bg-light">

                    <ul class="list-unstyled">
                    <li>
                        <span class="text-muted">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-building" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694L1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                                <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                            </svg>
                            &nbsp 16000 Leskovac
                        </span>
                    </li>
                    <li>
                        <span class="text-muted">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-briefcase-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M0 12.5A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5V6.85L8.129 8.947a.5.5 0 0 1-.258 0L0 6.85v5.65z"/>
                                <path fill-rule="evenodd" d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5v1.384l-7.614 2.03a1.5 1.5 0 0 1-.772 0L0 5.884V4.5zm5-2A1.5 1.5 0 0 1 6.5 1h3A1.5 1.5 0 0 1 11 2.5V3h-1v-.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5V3H5v-.5z"/>
                            </svg>
                            &nbsp 00 - 24h
                        </span>
                    </li>
                    <li>
                        <span class="text-muted">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z"/>
                            </svg>
                        &nbsp +38116.123.456
                        </span>
                    </li>
                    <li>
                        <span class="text-muted">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
                            </svg>
                            &nbsp onlineshop@example.com
                        </span>
                    </li>
                    </ul>
                
                </div>

            </div>

            <div class="row text-light font-weight-bold" style="margin-top: 150px;"> 

                <div class="col-md-12 text-center">
                
                    &copy; 2020 by&nbsp;
                
                    <a class="text-muted" href="https://github.com/milanpesic" target="_blank">
                        Milan Pesic 
                    </a>

                </div>
            
            </div>

        </div>

    </footer>

        <script src="<?php echo $config['url']['path'] . 'public/jquery.slim.min.js'; ?>"></script>

        <script src="<?php echo $config['url']['path'] . 'public/popper.min.js'; ?>"></script>

        <script src="<?php echo $config['url']['path'] . 'public/bootstrap.min.js'; ?>"></script>

        <script src="<?php echo $config['url']['path'] . 'public/app.js'; ?>"></script>

    </body>

</html>