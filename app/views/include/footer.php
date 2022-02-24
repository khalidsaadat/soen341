<!-- Footer Section Begin -->
<footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="/assets/img/footer-logo.png" alt=""></a>
                        </div>
                        <p>The customer is at the heart of our unique business model, which includes design.</p>
                        <a href="#"><img src="/assets/img/payment.png" alt=""></a>
                    </div>
                </div>
          
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="footer__copyright__text">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p>Copyright ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            SOEN 341 - Mini Amazon
                           
                        </p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script>
        CKEDITOR.replace( 'product_description', {
            customConfig: '/js/config.js'
        });
    </script>  
    
    <!-- user account -->
    <script>
        const $tabsToDropdown = $(".tabs-to-dropdown");

        function generateDropdownMarkup(container) {
        const $navWrapper = container.find(".nav-wrapper");
        const $navPills = container.find(".nav-pills");
        const firstTextLink = $navPills.find("li:first-child a").text();
        const $items = $navPills.find("li");
        const markup = `
            <div class="dropdown d-md-none">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ${firstTextLink}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> 
                ${generateDropdownLinksMarkup($items)}
            </div>
            </div>
        `;
        $navWrapper.prepend(markup);
        }

        function generateDropdownLinksMarkup(items) {
        let markup = "";
        items.each(function () {
            const textLink = $(this).find("a").text();
            markup += `<a class="dropdown-item" href="#">${textLink}</a>`;
        });

        return markup;
        }

        function showDropdownHandler(e) {
        // works also
        //const $this = $(this);
        const $this = $(e.target);
        const $dropdownToggle = $this.find(".dropdown-toggle");
        const dropdownToggleText = $dropdownToggle.text().trim();
        const $dropdownMenuLinks = $this.find(".dropdown-menu a");
        const dNoneClass = "d-none";
        $dropdownMenuLinks.each(function () {
            const $this = $(this);
            if ($this.text() == dropdownToggleText) {
            $this.addClass(dNoneClass);
            } else {
            $this.removeClass(dNoneClass);
            }
        });
        }

        function clickHandler(e) {
        e.preventDefault();
        const $this = $(this);
        const index = $this.index();
        const text = $this.text();
        $this.closest(".dropdown").find(".dropdown-toggle").text(`${text}`);
        $this
            .closest($tabsToDropdown)
            .find(`.nav-pills li:eq(${index}) a`)
            .tab("show");
        }

        function shownTabsHandler(e) {
        // works also
        //const $this = $(this);
        const $this = $(e.target);
        const index = $this.parent().index();
        const $parent = $this.closest($tabsToDropdown);
        const $targetDropdownLink = $parent.find(".dropdown-menu a").eq(index);
        const targetDropdownLinkText = $targetDropdownLink.text();
        $parent.find(".dropdown-toggle").text(targetDropdownLinkText);
        }

        $tabsToDropdown.each(function () {
        const $this = $(this);
        const $pills = $this.find('a[data-toggle="pill"]');

        generateDropdownMarkup($this);

        const $dropdown = $this.find(".dropdown");
        const $dropdownLinks = $this.find(".dropdown-menu a");

        $dropdown.on("show.bs.dropdown", showDropdownHandler);
        $dropdownLinks.on("click", clickHandler);
        $pills.on("shown.bs.tab", shownTabsHandler);
        });

    </script>

    

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

    
    <script src="/js/jquery.nicescroll.min.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/jquery.countdown.min.js"></script>
    <script src="/js/jquery.slicknav.js"></script>
    <script src="/js/mixitup.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="/js/main.js"></script>


</body>

</html>