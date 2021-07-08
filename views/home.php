
<?php include('layout/header.php'); ?>

    <?php if(Session::has('newsletter-activate')) : ?>

        <div class="alert alert-success text-center">

            <?php echo Session::get('newsletter-activate'); ?>

        </div>

    <?php endif; ?>

    <?php if(Session::has('order-success')) : ?>

        <div class="alert alert-success text-center">

            <?php echo Session::get('order-success'); ?>

        </div>

    <?php endif; ?>

    <div class="container" style="margin-top: 100px;">
    
        <div class="font-weight-bold text-muted">

            This site was developed as a personal representation of web technologies i have learned over time (PHP/MySQL, HTML/CSS, JS).
        
        </div>
    
    </br>

        <div class="font-weight-bold text-muted">

            Beside that, I'm capable of using web frameworks such as Laravel, Vue and Bootstrap.

        </div>

    </br>

        <div class="font-weight-bold text-muted">

            Note: This project has an admin panel for updating web content. (Check <a href="<?php echo $config['url']['path'] . 'admin-panel/sign-in'; ?>" target="_blank">here</a>).
        
        </div>

    </br>

        <img src="<?php echo $config['url']['path'] . 'public/images/online-shop.png'; ?>" class="img-fluid rounded shadow" alt="Responsive image">

    </div>

    <div class="container-fluid p-5 mt-5" style="margin-bottom: 120px;">

    <div class="row w-100">

        <div class="col-md-6 text-center">
        <svg viewBox="0 0 256 134" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMinYMin meet"><g fill-rule="evenodd"><ellipse fill="#8993BE" cx="128" cy="66.63" rx="128" ry="66.63"/><path d="M35.945 106.082l14.028-71.014H82.41c14.027.877 21.041 7.89 21.041 20.165 0 21.041-16.657 33.315-31.562 32.438H56.11l-3.507 18.411H35.945zm23.671-31.561L64 48.219h11.397c6.137 0 10.52 2.63 10.52 7.89-.876 14.905-7.89 17.535-15.78 18.412h-10.52zM100.192 87.671l14.027-71.013h16.658l-3.507 18.41h15.78c14.028.877 19.288 7.89 17.535 16.658l-6.137 35.945h-17.534l6.137-32.438c.876-4.384.876-7.014-5.26-7.014H124.74l-7.89 39.452h-16.658zM153.425 106.082l14.027-71.014h32.438c14.028.877 21.042 7.89 21.042 20.165 0 21.041-16.658 33.315-31.562 32.438h-15.781l-3.507 18.411h-16.657zm23.67-31.561l4.384-26.302h11.398c6.137 0 10.52 2.63 10.52 7.89-.876 14.905-7.89 17.535-15.78 18.412h-10.521z" fill="#232531"/></g></svg>
        </div>

        <div class="col-md-6 align-self-center">

                <h1 class="font-weight-bold">PHP: Hypertext Preprocessor</h1>
                
                PHP is a popular general-purpose scripting language that is especially suited to web development.

                Fast, flexible and pragmatic, PHP powers everything from your blog to the most popular websites in the world.
        
        </div>

    </div>

    <div class="row w-100 mt-5">

        <div class="col-md-6 align-self-center"><h1 class="font-weight-bold">Build fast, responsive sites with Bootstrap</h1>
Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</div>

        <div class="col-md-6 text-center">
        
            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="300" height="300" class="d-block" viewBox="0 0 612 612" role="img" focusable="false"><title>Bootstrap</title><path fill="currentColor" d="M510 8a94.3 94.3 0 0 1 94 94v408a94.3 94.3 0 0 1-94 94H102a94.3 94.3 0 0 1-94-94V102a94.3 94.3 0 0 1 94-94h408m0-8H102C45.9 0 0 45.9 0 102v408c0 56.1 45.9 102 102 102h408c56.1 0 102-45.9 102-102V102C612 45.9 566.1 0 510 0z"></path><path fill="currentColor" d="M196.77 471.5V154.43h124.15c54.27 0 91 31.64 91 79.1 0 33-24.17 63.72-54.71 69.21v1.76c43.07 5.49 70.75 35.82 70.75 78 0 55.81-40 89-107.45 89zm39.55-180.4h63.28c46.8 0 72.29-18.68 72.29-53 0-31.42-21.53-48.78-60-48.78h-75.57zm78.22 145.46c47.68 0 72.73-19.34 72.73-56s-25.93-55.37-76.46-55.37h-74.49v111.4z"></path></svg>
        
        </div>
 
    </div>

    <div class="row w-100 mt-5">

        <div class="col-md-6 text-center"><svg width="300" height="300" viewBox="0 0 114 29" xmlns="http://www.w3.org/2000/svg"><title>Logotype</title><path d="M4.773.917v23.046h8.338v3.976H.333V.917h4.44zm24.01 11.465V9.95h4.208v17.99h-4.207v-2.433c-.567.901-1.37 1.609-2.413 2.123-1.042.515-2.091.772-3.146.772-1.365 0-2.613-.25-3.745-.752a8.758 8.758 0 0 1-2.915-2.066 9.6 9.6 0 0 1-1.89-3.01 9.717 9.717 0 0 1-.677-3.63c0-1.26.225-2.464.676-3.61a9.56 9.56 0 0 1 1.891-3.03 8.766 8.766 0 0 1 2.915-2.065c1.132-.502 2.38-.752 3.745-.752 1.055 0 2.104.257 3.146.772 1.042.515 1.846 1.222 2.413 2.123zm-.386 8.763a6.293 6.293 0 0 0 .387-2.2c0-.773-.13-1.506-.387-2.2a5.58 5.58 0 0 0-1.08-1.815 5.233 5.233 0 0 0-1.68-1.236c-.656-.308-1.383-.463-2.18-.463-.799 0-1.52.155-2.163.463a5.29 5.29 0 0 0-1.66 1.236 5.307 5.307 0 0 0-1.06 1.814 6.56 6.56 0 0 0-.368 2.2c0 .772.122 1.506.367 2.2.244.696.598 1.3 1.062 1.815a5.279 5.279 0 0 0 1.66 1.236c.642.309 1.363.463 2.161.463s1.525-.154 2.181-.463a5.222 5.222 0 0 0 1.68-1.236 5.575 5.575 0 0 0 1.08-1.814zm7.914 6.794V9.95h11.427v4.141h-7.22v13.85h-4.207zm26.675-15.557V9.95h4.208v17.99h-4.208v-2.433c-.566.901-1.37 1.609-2.413 2.123-1.042.515-2.09.772-3.146.772-1.364 0-2.612-.25-3.744-.752a8.758 8.758 0 0 1-2.915-2.066 9.6 9.6 0 0 1-1.891-3.01 9.717 9.717 0 0 1-.676-3.63c0-1.26.225-2.464.676-3.61a9.56 9.56 0 0 1 1.89-3.03 8.766 8.766 0 0 1 2.916-2.065c1.132-.502 2.38-.752 3.744-.752 1.055 0 2.104.257 3.146.772 1.043.515 1.847 1.222 2.413 2.123zm-.386 8.763a6.293 6.293 0 0 0 .386-2.2c0-.773-.13-1.506-.386-2.2a5.58 5.58 0 0 0-1.08-1.815 5.233 5.233 0 0 0-1.68-1.236c-.656-.308-1.384-.463-2.181-.463-.798 0-1.519.155-2.162.463a5.29 5.29 0 0 0-1.66 1.236 5.307 5.307 0 0 0-1.061 1.814 6.56 6.56 0 0 0-.367 2.2c0 .772.121 1.506.367 2.2.244.696.598 1.3 1.061 1.815a5.279 5.279 0 0 0 1.66 1.236c.643.309 1.364.463 2.162.463.797 0 1.525-.154 2.181-.463a5.222 5.222 0 0 0 1.68-1.236 5.575 5.575 0 0 0 1.08-1.814zM84.063 9.95h4.262L81.42 27.94H76.13L69.224 9.95h4.262l5.289 13.776L84.063 9.95zm13.44-.463c5.729 0 9.636 5.078 8.902 11.021H92.446c0 1.552 1.567 4.552 5.288 4.552 3.2 0 5.345-2.815 5.346-2.817l2.843 2.2c-2.542 2.713-4.623 3.96-7.882 3.96-5.823 0-9.77-3.684-9.77-9.458 0-5.223 4.079-9.458 9.231-9.458zm-5.046 7.894h10.084c-.031-.346-.578-4.552-5.072-4.552-4.495 0-4.98 4.206-5.012 4.552zm16.688 10.558V.917h4.208v27.022h-4.208z" fill="#FF2D20" fill-rule="evenodd"/></svg></div>

        <div class="col-md-6 align-self-center"><h1 class="font-weight-bold">The PHP Framework for Web Artisans</h1>
Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.</div>

    </div>

    <div class="row w-100 mt-5">

        <div class="col-md-6 align-self-center">
        
        <h1 class="font-weight-bold">The Progressive JavaScript Framework</h1>

            Vue (pronounced /vjuː/, like view) is a progressive framework for building user interfaces. Unlike other monolithic frameworks, Vue is designed from the ground up to be incrementally adoptable.
        
        </div>

        <div class="col-md-6 text-center">

            <img width="300" height="300" src="<?php echo $config['url']['path'] . 'public/images/vue-logo.png'; ?>" class="img-fluid" alt="Responsive image">
        
        </div>
    
    </div>

    <div class="row w-100 mt-5">

        <div class="col-md-6 align-self-center">
        
            <img width="300" height="300" src="<?php echo $config['url']['path'] . 'public/images/git.png'; ?>" class="img-fluid" alt="Responsive image">
        
        </div>

        <div class="col-md-6 align-self-center">

            <h1 class="font-weight-bold">Distributed Version Control Systems</h1>

            Git is a free and open source distributed version control system designed to handle everything from small to very large projects with speed and efficiency.
        
        </div>

    </div>

    </div>

   

<?php include('layout/footer.php'); ?>