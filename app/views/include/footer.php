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

    <!-- cc expiry date mask -->
    <script>
		$(document).ready(function()
		{
			var phones = [{"mask": "##/####"}];
			$('#expiry_date').inputmask({ 
				mask: phones, 
				greedy: false, 
				definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
		});
	</script>

    <!-- my account tabs - open specific tab -->
    <script>
        $(document).ready(function(){

            // $('#pills-tab a[href="#wish-list"]').tab('show') 

        });

        $('a[href="#myaccount_wishlist"]').click(function(){
            $('#pills-tab a[href="#wish-list"]').tab('show') 
        });
    </script>

    <!-- filter -->
    <script>
        $('li.size_filter').on('click', function() {
            var id = $(this).attr("id");

            window.location = "/shop/index/filter/size/" + id;
        });

        $('li.color_filter').on('click', function() {
            var id = $(this).attr("id");

            window.location = "/shop/index/filter/color/" + id;
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

    <!-- generate baby reg link using jquery -->
    <script>
        
        $('form.share_form').submit(function(event) {
            event.preventDefault();

            // generate flag
            var generate_flag;

            var $form = $(this);

            var serialized_data = $form.serialize();

            request = $.ajax({
                url: "/babyregistry/generate",
                type: "post",
                data: serialized_data,
                dataType: "json",
                encode: true,
            }).done(function(response) {
                if(!response.success) {
                    // return the existing token
                    console.log(response.token);

                    generate_flag = 0;
                }
                else {
                    // get the token and show it
                    console.log(response.token);
                    
                    var url = "/babyregistry/shareable/" + response.token;
                    $("#shareable_link_url").attr({href: url});
                    $("#shareable_link_url").html("");
                    $("#shareable_link_url").append("/babyregistry/shareable/" + response.token);
                    
                    generate_flag = 0;
                }
            });
          
        });
    </script>

    <!-- Copy a text -->
    <script>
        function copyText() {
            
            var copyText = document.getElementById("shareable_url");
            copyToClipboard(copyText.value);
            
            
            
            // var tooltip = document.getElementById("myTooltip");
            // tooltip.innerHTML = "Copied: " + copyText.value;
        }

        function copyToClipboard(text) {
            var sampleTextarea = document.createElement("textarea");
            document.body.appendChild(sampleTextarea);
            sampleTextarea.value = text; //save main text in it
            sampleTextarea.select(); //select textarea contenrs
            document.execCommand("copy");
            document.body.removeChild(sampleTextarea);
        }

        function changeTooltip() {
            $('[data-toggle="tooltip"]').click(function(){
                $(this).tooltip('hide').attr('data-original-title', 'Link copied').tooltip('show');
            }); 
        }
    </script>
    

    <script>
        $(document).ready(function () {
            //Initialize tooltips
            $('.nav-tabs > li a[title]').tooltip();
            
            //Wizard
            $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

                var $target = $(e.target);
            
                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);

            });
            $(".prev-step").click(function (e) {

                var $active = $('.wizard .nav-tabs li.active');
                prevTab($active);

            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }
        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }

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