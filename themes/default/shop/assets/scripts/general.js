// General scripts for all pages
$(function () {
    $(document).on('click', '.reload-captcha', function (e) {
        e.preventDefault();
        let link = $(this).attr('href');
        $.ajax({ url: link + '?width=210&height=34', type: 'GET' }).done(function (data) {
            if (data) {
                $('.captcha-image').html(data);
            } else {
                sa_alert('Error!', 'Something went wrong.', 'error', true);
            }
        });
    });
    $(document).on('click', '.add-to-cart', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var cart = $('.shopping-cart:visible');
        var qty_input = $(this).parents('.product-bottom').find('.quantity-input');
        var imgtodrag = $(this).parents('.product').find('img').eq(0);
        if (imgtodrag) {
            var imgclone = imgtodrag
                .clone()
                .offset({ top: imgtodrag.offset().top, left: imgtodrag.offset().left })
                .css({ opacity: '0.5', position: 'absolute', height: '150px', width: '150px', 'z-index': '1000' })
                .appendTo($('body'))
                .animate({ top: cart.offset().top + 10, left: cart.offset().left + 10, width: '50px', height: '50px' }, 400);
            imgclone.animate({ width: 0, height: 0 }, function () {
                $(this).detach();
            });
        }
        $.ajax({ url: site.site_url + 'cart/add/' + id, type: 'GET', dataType: 'json', data: { qty: qty_input.val() } }).done(function (
            data
        ) {
            if (data.error) {
                sa_alert('Error!', data.message, 'error', true);
            } else {
                cart = data;
                update_mini_cart(data);
            }
        });
    });

    $(document).on('click', '.btn-minus', function (e) {
        var input = $(this).parent().find('input');
        if (parseInt(input.val()) > 1) {
            input.val(parseInt(input.val()) - 1);
        }
    });
    $(document).on('click', '.guest-checkout', function (e) {
        console.log(this);
        $('.nav-tabs a:last').tab('show');
        return false;
    });
    $(document).on('click', '.btn-plus', function (e) {
        var input = $(this).parent().find('input');
        input.val(parseInt(input.val()) + 1);
    });

    $(document).on('click', '.add-to-wishlist', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $.ajax({ url: site.site_url + 'cart/add_wishlist/' + id, type: 'GET', dataType: 'json' }).done(function (res) {
            if (res.total) {
                $('#total-wishlist').text(res.total);
            } else if (res.redirect) {
                window.location.href = res.redirect;
                return false;
            }
            sa_alert(res.status, res.message, res.level);
        });
    });

    $(document).on('click', '.remove-wishlist', function (e) {
        e.preventDefault();
        var self = $(this);
        var id = $(this).attr('data-id');
        $.ajax({ url: site.site_url + 'cart/remove_wishlist/' + id, type: 'GET', dataType: 'json' }).done(function (res) {
            if (res.total == 0) {
                setTimeout(function () {
                    location.reload();
                }, 1000);
            } else if (res.redirect) {
                window.location.href = res.redirect;
                return false;
            }
            if (res.status != lang.error) {
                self.closest('tr').remove();
            }
            $('#total-wishlist').text(res.total);
            sa_alert(res.status, res.message, res.level);
        });
    });

    update_mini_cart(cart);

    $('#dropdown-cart').click(function () {
        $(this)
            .next('.dropdown-menu')
            .animate(
                {
                    scrollTop: $(this).next('.dropdown-menu').height() + 400,
                },
                100
            );
    });

    $('#add-address').click(function (e) {
        e.preventDefault();
        add_address();
    });
    $('.edit-address').click(function (e) {
        e.preventDefault();
        var sa = $(this).attr('data-id');
        if (addresses) {
            $.each(addresses, function () {
                if (this.id == sa) {
                    add_address(this);
                }
            });
        }
    });

    $(document).on('click', '.forgot-password', function (e) {
        e.preventDefault();
        prompt(lang.reset_pw, lang.type_email);
    });

    // open dropdown menu on hover (if width >= 768px)
    $('ul.nav li.dropdown').hover(
        function () {
            if (get_width() >= 767) {
                $(this).addClass('open');
            }
        },
        function () {
            if (get_width() >= 767) {
                $(this).removeClass('open');
            }
        }
    );

    // Dropdiwn submenu
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().siblings().removeClass('open');
        $(this).parent().toggleClass('open');
    });

    // Tooltip
    $('.tip').tooltip({ container: 'body' });

    // Form validation
    $('.validate').formValidation({
        framework: 'bootstrap',
        // icon: {
        //     valid: 'fa fa-ok',
        //     invalid: 'fa fa-remove',
        //     validating: 'fa fa-refresh'
        // },
        message: lang.required_invalid,
    });

    // Back top Top
    $(window).scroll(function () {
        if ($(this).scrollTop() > 70) {
            $('.back-to-top').fadeIn();
        } else {
            $('.back-to-top').fadeOut();
        }
    });

    sticky_footer();
    $(window).resize(sticky_footer);

    sticky_con();
    $(window).resize(sticky_con);

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
        $('.selectpicker').selectpicker({ modile: true });
    } else {
        var elements = document.querySelectorAll('.mobile-device');
        for (var i = 0; i < elements.length; i++) {
            elements[i].classList.remove('mobile-device');
        }
        $('.selectpicker').selectpicker();
    }

    // Theme color
    $('.theme-color').click(function (e) {
        store('shop_color', $(this).attr('data-color'));
        $('#wrapper').removeAttr('class').addClass($(this).attr('data-color'));
        return false;
    });
    if ((shop_color = get('shop_color'))) {
        $('#wrapper').removeAttr('class').addClass(shop_color);
    }

    if (v == 'products') {
        $(window).resize(function () {
            gen_html(products);
        });

        if (site.settings.products_page == 1) {
            $('.grid').isotope({ itemSelector: '.grid-item' });
        }

        // Products Sorting
        $('#sorting').on('changed.bs.select', function (e) {
            console.log($(this).val());
            store('sorting', $(this).val());
            searchProducts();
            return false;
        });

        // Products Grid - 2 Cols
        $('.two-col').click(function () {
            store('shop_grid', '.two-col');
            $(this).addClass('active');
            $('.three-col').removeClass('active');
            gen_html(products);
            return false;
        });
        // Products Grid - 3 Cols
        $('.three-col').click(function () {
            store('shop_grid', '.three-col');
            $(this).addClass('active');
            $('.two-col').removeClass('active');
            gen_html(products);
            return false;
        });

        // Top search on products page - dont load page but recall ajax
        $('#product-search-form').submit(function (e) {
            e.preventDefault();
            filters.query = $('#product-search').val();
            filters.page = 1;
            searchProducts();
            // $('#product-search').val('');
            return false;
        });
        $('#product-search').blur(function (e) {
            e.preventDefault();
            filters.query = $(this).val();
            filters.page = 1;
            searchProducts();
            // $(this).val('');
            return false;
        });
        // $('#product-category').change(function(e) {
        //     window.location = site.site_url+'category/'+$(this).val();
        // });

        // Filters - unselect brand
        $('.reset_filters_brand').click(function (e) {
            filters.brand = null;
            filters.page = 1;
            searchProducts();
            $(this).closest('li').remove();
        });
        // Filters - unselect category
        $('.reset_filters_category').click(function (e) {
            filters.category = null;
            filters.page = 1;
            searchProducts();
            $(this).closest('li').remove();
        });

        // Reload products if the min/max price or in stock val change
        $('#min-price, #max-price, #in-stock, #promotions, #featured').change(function () {
            filters.page = 1;
            searchProducts();
        });

        $(document).on('click', '#pagination a', function (ev) {
            ev.preventDefault();
            var link = $(this).attr('href');
            var p = link.split('page=');
            if (p[1]) {
                var pp = p[1].split('&');
                filters.page = pp[0];
            } else {
                filters.page = 1;
            }
            searchProducts(link);
            return false;
        });

        // Get user selected grip and sorting and apply to page
        if ((shop_grid = get('shop_grid'))) {
            $(shop_grid).click();
        }
        if ((sorting = get('sorting'))) {
            $('#sorting').selectpicker('val', sorting);
        } else {
            store('sorting', 'name-asc');
        }

        if (filters.query) {
            $('#product-search').val(filters.query);
        }

        // Load products
        searchProducts();
    }

    // Featured products grid - hover view
    $('.product').each(function (i, el) {
        $(el)
            .find('.details')
            .hover(
                function () {
                    $(this).parent().css('z-index', '20');
                    $(this).addClass('animate');
                },
                function () {
                    $(this).removeClass('animate');
                    $(this).parent().css('z-index', '1');
                }
            );
    });

    if (m == 'cart_ajax' && v == 'index') {
        update_mini_cart(cart);
        update_cart(cart);
        // Remove cart item
        $(document).on('click', '.remove-item', function (e) {
            e.preventDefault();
            var fdata = {};
            fdata['rowid'] = $(this).attr('data-rowid');
            var action = site.site_url + 'cart/remove';
            saa_alert(action, false, 'post', fdata);
        });
        $(document).on('change', '.cart-item-option, .cart-item-qty', function (e) {
            e.preventDefault();
            var pv = this.defaultValue;
            var row = $(this).closest('tr');
            var rowid = row.attr('id');
            var action = site.site_url + 'cart/update';
            var fdata = {};
            fdata[site.csrf_token] = site.csrf_token_value;
            fdata['rowid'] = rowid;
            fdata['qty'] = row.find('.cart-item-qty').val();
            fdata['option'] = row.find('.cart-item-option').children('option:selected').val();
            update_cart_item(action, fdata, pv, $(this), e.target.type);
        });
        $('.cart-item-option').on('shown.bs.select', function (e) {
            if ($(this).children('option:selected').val()) {
                $po = $(this).children('option:selected').val();
            }
        });

        // Destroy cart
        $('#empty-cart').click(function (e) {
            e.preventDefault();
            var action = $(this).attr('href');
            saa_alert(action);
        });
    } else if (m == 'shop' && v == 'product') {
        var $lightbox = $('#lightbox');
        $('[data-target="#lightbox"]').on('click', function (event) {
            var $img = $(this).find('img'),
                src = $img.attr('src'),
                alt = $img.attr('alt'),
                css = { maxWidth: $(window).width() - 10, maxHeight: $(window).height() - 10 };
            $lightbox.find('.close').addClass('hidden');
            $lightbox.find('img').attr('src', src);
            $lightbox.find('img').attr('alt', alt);
            $lightbox.find('img').css(css);
            $lightbox.find('.modal-content').removeClass('swal2-hide').addClass('swal2-show');
        });
        $lightbox.on('shown.bs.modal', function (e) {
            var $img = $lightbox.find('img');
            $lightbox.find('.modal-dialog').css({ width: $img.width() });
            $lightbox.find('.close').removeClass('hidden');
            $lightbox.addClass('fade');
            $('.modal-backdrop').addClass('fade');
        });
        $lightbox.on('hide.bs.modal', function () {
            $lightbox.find('.modal-content').removeClass('swal2-show').addClass('swal2-hide');
        });
        $lightbox.on('hidden.bs.modal', function () {
            $lightbox.removeClass('fade');
            $('.modal-backdrop').removeClass('fade');
        });
    }

    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    }

    $(document).on('click', '.show-tab', function (e) {
        e.preventDefault();
        $('.nav-tabs a[href="#' + $(this).attr('href') + '"]').tab('show');
    });

    $('.history-tabs a').on('shown.bs.tab', function (e) {
        if (history.pushState) {
            history.pushState(null, null, e.target.hash);
        } else {
            window.location.hash = e.target.hash;
        }
    });

    $('.email-modal').click(function (e) {
        e.preventDefault();
        email_form();
    });

    $('#same_as_billing').change(function (e) {
        if ($(this).is(':checked')) {
            $('#shipping_line1').val($('#billing_line1').val()).change();
            $('#shipping_line2').val($('#billing_line2').val()).change();
            $('#shipping_city').val($('#billing_city').val()).change();
            $('#shipping_state').val($('#billing_state').val()).change();
            $('#shipping_postal_code').val($('#billing_postal_code').val()).change();
            $('#shipping_country').val($('#billing_country').val()).change();
            $('#shipping_phone').val($('#phone').val()).change();
            $('#guest-checkout').data('formValidation').resetForm();
        }
    });
});

function sa_img(title, msg) {
    swal({
        title: title,
        html: msg,
        type: 'success',
        confirmButtonText: lang.okay,
    }).catch(swal.noop);
}

var $po;
function update_cart_item(action, data, pv, el, type) {
    $.ajax({
        url: action,
        type: 'POST',
        data: data,
        success: function (res) {
            if (res.error) {
                if (type == 'text') {
                    el.val(pv);
                } else {
                    el.selectpicker('val', $po);
                }
                sa_alert('Error!', res.message, 'error', true);
            } else {
                if (res.cart) {
                    cart = res.cart;
                    update_mini_cart(cart);
                    update_cart(cart);
                }
                sa_alert(res.status, res.message);
            }
        },
        error: function () {
            sa_alert('Error!', 'Ajax call failed, please try again or contact site owner.', 'error', true);
        },
    });
}

// Sticky Container
function sticky_con() {
    if (get_width() > 767) {
        $('#sticky-con').stick_in_parent({ parent: $('.container') });
        $('#sticky-con')
            .on('sticky_kit:bottom', function (e) {
                $(this).parent().css('position', 'static');
            })
            .on('sticky_kit:unbottom', function (e) {
                $(this).parent().css('position', 'relative');
            });
    } else {
        $('#sticky-con').trigger('sticky_kit:detach');
    }
}

// Set body padding
function sticky_footer() {
    $('body').css('padding-bottom', $('.footer').height());
}

// Get body width
function get_width() {
    return $(window).width();
}

// Show loading animation for n miliseconds
function loading(n) {
    $('#loading').show();
    setTimeout(function () {
        $('#loading').hide();
    }, n);
}

// Get localStorage item
function get(name) {
    if (typeof Storage !== 'undefined') {
        return localStorage.getItem(name);
    } else {
        alert('Please use a modern browser as this site needs localstroage!');
    }
}

// Set localStorage item
function store(name, val) {
    if (typeof Storage !== 'undefined') {
        localStorage.setItem(name, val);
    } else {
        alert('Please use a modern browser as this site needs localstroage!');
    }
}

// Remove localStorage item
function remove(name) {
    if (typeof Storage !== 'undefined') {
        localStorage.removeItem(name);
    } else {
        alert('Please use a modern browser as this site needs localstroage!');
    }
}

// Show/hide animation for ajax requires
// $(document).ajaxStart(function() { $('#loading').show(); })
// .ajaxStop(function() { $('#loading').hide(); });

// Generate html code for products
function gen_html(products) {
    var self = this;
    var html = '';
    if (get_width() > 992) {
        var shop_grid = get('shop_grid');
        var cols = shop_grid == '.three-col' ? 3 : 2;
    } else {
        var shop_grid = '.two-col';
        var cols = 2;
    }
    var pr_con = shop_grid && shop_grid == '.three-col' ? 'col-sm-6 col-md-4' : 'col-md-6';
    var pr_c = shop_grid && shop_grid == '.three-col' ? 'alt' : '';

    if (!products) {
        html +=
            '<div class="col-sm-12"><div class="alert alert-warning text-center padding-xl margin-top-lg"><h4 class="margin-bottom-no">' +
            lang.x_product +
            '</h4></div></div>';
    }

    if (site.settings.products_page == 1) {
        $('#results').empty();
        $('.grid').isotope('destroy').isotope();
    }

    $.each(products, function (index, product) {
        var nprice = product.special_price ? product.special_price : product.price;
        var fnprice = product.special_price ? product.formated_special_price : product.formated_price;
        var pprice = product.promotion && product.promo_price && product.promo_price != 0 ? product.promo_price : nprice;
        var fpprice = product.promotion && product.promo_price && product.promo_price != 0 ? product.formated_promo_price : fnprice;
        if (site.settings.products_page != 1) {
            if (index === 0) {
                html += '<div class="row">';
            } else if (index % cols === 0) {
                html += '</div><div class="row">';
            }
        }
        html += `<div class="product-container ${pr_con} ${site.settings.products_page == 1 ? 'grid-item' : ''}">
        <div class="product ${pr_c} ${site.settings.products_page == 1 ? 'grid-sizer' : ''}">
        ${product.promo_price ? '<span class="badge badge-right theme">Promo</span>' : ''}
        <div class="product-top">
        <div class="product-image">
        <a href="${site.site_url}product/${product.slug}">
        <img class="img-responsive" src="${site.base_url}assets/uploads/${product.image}" alt=""/>
        </a>
        </div>
        <div class="product-desc">
        <a href="${site.site_url}product/${product.slug}">
        <h2 class="product-name">${product.name}</h2>
        </a>
        <p>${product.details}</p>
        </div>
        </div>
        <div class="clearfix"></div>
        ${
            site.shop_settings.hide_price == 1
                ? ''
                : `
        <div class="product-bottom">
        <div class="product-price">
        ${product.promo_price ? '<del class="text-danger text-size-sm">' + fnprice + '</del>' : ''}
        ${fpprice}
        </div>
        <div class="product-rating">
        <div class="form-group" style="margin-bottom:0;">
        <div class="input-group">
        <span class="input-group-addon pointer btn-minus"><span class="fa fa-minus"></span></span>
        <input type="text" name="quantity" class="form-control text-center quantity-input" value="1" required="required">
        <span class="input-group-addon pointer btn-plus"><span class="fa fa-plus"></span></span>
        </div>
        </div>
        </div>
        <div class="clearfix"></div>
        <div class="product-cart-button">
        <div class="btn-group" role="group" aria-label="...">
        <button class="btn btn-info add-to-wishlist" data-id="${product.id}"><i class="fa fa-heart-o"></i></button>
        <button class="btn btn-theme add-to-cart" data-id="${product.id}"><i class="fa fa-shopping-cart padding-right-md"></i> ${
                      lang.add_to_cart
                  }</button>
        </div>
        </div>
        <div class="clearfix"></div>
        </div>`
        }
        </div>
        <div class="clearfix"></div>
        </div>`;
        if (site.settings.products_page != 1) {
            if (index + 1 === products.length) {
                html += '</div>';
            }
        }
    });
    //${(product.type != 'standard' || product.quantity > 0) ? '' : 'disabled="true"'}

    if (site.settings.products_page != 1) {
        $('#results').empty();
        $(html).appendTo($('#results'));
    } else {
        var data = $(html);
        $('.grid').isotope('insert', data).isotope('layout');
        setTimeout(function () {
            $('.grid').isotope({ itemSelector: '.grid-item' });
        }, 200);
    }
}

// Seach products
function searchProducts(link) {
    if (history.pushState) {
        var newurl = window.location.origin + window.location.pathname + '?page=' + filters.page;
        // var newurl = window.location.protocol + '//' + window.location.host + window.location.pathname + '?page=' + filters.page;
        window.history.pushState({ path: newurl, filters: filters }, '', newurl);
    }
    $('#loading').show();
    var data = {};
    data[site.csrf_token] = site.csrf_token_value;
    data['filters'] = get_filters();
    data['format'] = 'json';
    $.ajax({ url: site.shop_url + 'search?page=' + filters.page, type: 'POST', data: data, dataType: 'json' })
        .done(function (data) {
            products = data.products;
            $('.page-info').empty();
            $('#pagination').empty();
            if (data.products) {
                if (data.pagination) {
                    $('#pagination').html(data.pagination);
                }
                if (data.info) {
                    $('.page-info').text(lang.page_info.replace('_page_', data.info.page).replace('_total_', data.info.total));
                }
            }
            gen_html(products);
        })
        .always(function () {
            $('#loading').hide();
        });
    if (location.href.includes('products')) {
        if (link) {
            window.history.pushState({ link: link, filters: filters }, '', link);
            window.onpopstate = function (e) {
                if (e.state && e.state.filters) {
                    filters = e.state.filters;
                    searchProducts();
                } else {
                    filters.page = 1;
                    searchProducts();
                }
            };
        }
    }
    setTimeout(function () {
        window.scrollTo(0, 0);
    }, 500);
}

// Get page filters
function get_filters() {
    filters.category = $('#product-category').val() ? $('#product-category').val() : filters.category;
    filters.min_price = $('#min-price').val();
    filters.max_price = $('#max-price').val();
    filters.in_stock = $('#in-stock').is(':checked') ? 1 : 0;
    filters.promo = $('#promotions').is(':checked') ? 'yes' : 0;
    filters.featured = $('#featured').is(':checked') ? 'yes' : 0;
    filters.sorting = get('sorting');
    return filters;
}

// Update mini cart
function update_mini_cart(cart) {
    if (cart.total_items && cart.total_items > 0) {
        $('.cart-total-items').text(cart.total_items + ' ' + (cart.total_items > 1 ? lang.items : lang.item));
        $('#cart-items').empty();
        $.each(cart.contents, function () {
            var row = `<td><a href="${site.site_url}/product/${this.slug}"><span class="cart-item-image"><img src="${site.base_url}assets/uploads/thumbs/${this.image}" alt=""></span></a></td><td><a href="${site.site_url}/product/${this.slug}">${this.name}</a><br>${this.qty} x ${this.price}</td><td class="text-right text-bold">${this.subtotal}</td>`;
            $('<tr>' + row + '</tr>').appendTo('#cart-items');
        });
        var row = `
        <tr class="text-bold"><td colspan="2">${lang.total_items}</td><td class="text-right">${cart.total_items}</td></tr>
        <tr class="text-bold"><td colspan="2">${lang.total}</td><td class="text-right">${cart.total}</td></tr>
        `;
        $('<tfoot>' + row + '</tfoot>').appendTo('#cart-items');
        $('#cart-empty').hide();
        $('#cart-contents').show();
    } else {
        $('.cart-total-items').text(lang.cart_empty);
        $('#cart-contents').hide();
        $('#cart-empty').show();
    }
}

function update_cart(cart) {
    if (cart.total_items && cart.total_items > 0) {
        $('#cart-table tbody').empty();
        var i = 1;
        $.each(cart.contents, function () {
            var item = this;
            var row = `
            <td class="text-center">
            <a href="#" class="text-red remove-item" data-rowid="${this.rowid}"><i class="fa fa-trash-o"></i><a>
            </td>
            <td><input type="hidden" name="${i}[rowid]" value="${this.rowid}">${i}</td>
            <td>
            <a href="${site.site_url}/product/${this.slug}"><span class="cart-item-image pull-right"><img src="${site.base_url}assets/uploads/thumbs/${this.image}" alt=""></span></a>
            </td>
            <td><a href="${site.site_url}/product/${this.slug}">${this.name}</a></td>
            <td>`;
            if (this.options) {
                row += `<select name="${i}[option]" class="selectpicker cart-item-option" data-width="100%" data-style="btn-default">`;
                $.each(this.options, function () {
                    row += `<option value="${this.id}" ${this.id == item.option ? 'selected' : ''}>${this.name} ${
                        parseFloat(this.price) != 0 ? '(+' + this.price + ')' : ''
                    }</option>`;
                });
                row += `</select>`;
            }

            row += `</td>
            <td><input type="text" name="${i}[qty]" class="form-control text-center input-qty cart-item-qty" value="${this.qty}"></td>
            <td class="text-right">${this.price}</td>
            <td class="text-right">${this.subtotal}</td>
            `;
            i++;

            $('<tr id="' + this.rowid + '">' + row + '</tr>').appendTo('#cart-table tbody');
        });

        $('#cart-totals').empty();
        var trow = `<tr><td>${lang.total_w_o_tax}</td><td class="text-right">${cart.subtotal}</td></tr>`;
        trow += `<tr><td>${lang.product_tax}</td><td class="text-right">${cart.total_item_tax}</td></tr>`;
        trow += `<tr><td>${lang.total}</td><td class="text-right">${cart.total}</td></tr>`;
        if (site.settings.tax2 !== false) {
            trow += `<tr><td>${lang.order_tax}</td><td class="text-right">${cart.order_tax}</td></tr>`;
        }
        trow += `<tr><td>${lang.shipping} *</td><td class="text-right">${cart.shipping}</td></tr>`;
        trow += `<tr><td colspan="2"></td></tr>`;
        trow += `<tr class="active text-bold"><td>${lang.grand_total}</td><td class="text-right">${cart.grand_total}</td></tr>`;

        $('<tbody>' + trow + '</tbody>').appendTo('#cart-totals');

        $('#total-items').text(cart.total_items + '(' + cart.total_unique_items + ')');
        $('.cart-item-option').selectpicker('refresh');
        $('.cart-empty-msg').hide();
        $('.cart-contents').show();
    } else {
        $('#total-items').text(cart.total_items);
        $('.cart-contents').hide();
        $('.cart-empty-msg').show();
    }
}

// Format Money - for products price
function formatMoney(x, symbol) {
    if (!symbol) {
        symbol = site.settings.symbol;
    }
    if (site.settings.sac == 1) {
        return (
            (site.settings.display_symbol == 1 ? symbol : '') +
            '' +
            formatSA(parseFloat(x).toFixed(site.settings.decimals)) +
            (site.settings.display_symbol == 2 ? symbol : '')
        );
    }
    var fmoney = accounting.formatMoney(
        x,
        symbol,
        site.settings.decimals,
        site.settings.thousands_sep == 0 ? ' ' : site.settings.thousands_sep,
        site.settings.decimals_sep,
        '%s%v'
    );
    return (site.settings.display_symbol == 1 ? symbol : '') + fmoney + (site.settings.display_symbol == 2 ? symbol : '');
}

// Format helper fun for South Asian Currencies
function formatSA(x) {
    x = x.toString();
    var afterPoint = '';
    if (x.indexOf('.') > 0) afterPoint = x.substring(x.indexOf('.'), x.length);
    x = Math.floor(x);
    x = x.toString();
    var lastThree = x.substring(x.length - 3);
    var otherNumbers = x.substring(0, x.length - 3);
    if (otherNumbers != '') lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ',') + lastThree + afterPoint;
    return res;
}

function sa_alert(title, message, level, overlay) {
    level = level || 'success';
    overlay = overlay || false;
    swal({
        title: title,
        html: message,
        type: level,
        timer: overlay ? 60000 : 2000,
        confirmButtonText: 'Okay',
    }).catch(swal.noop);
}

function saa_alert(action, message, method, form_data) {
    method = method || lang.delete;
    message = message || lang.x_reverted_back;
    form_data = form_data || {};
    form_data._method = method;
    form_data[site.csrf_token] = site.csrf_token_value;
    swal({
        title: lang.r_u_sure,
        html: message,
        type: 'question',
        showCancelButton: true,
        allowOutsideClick: false,
        showLoaderOnConfirm: true,
        preConfirm: function () {
            return new Promise(function () {
                $.ajax({
                    url: action,
                    type: 'POST',
                    data: form_data,
                    success: function (data) {
                        if (data.redirect) {
                            window.location.href = data.redirect;
                            return false;
                        } else {
                            if (data.cart) {
                                cart = data.cart;
                                update_mini_cart(cart);
                                update_cart(cart);
                            }
                            sa_alert(data.status, data.message);
                        }
                    },
                    error: function () {
                        sa_alert('Error!', 'Ajax call failed, please try again or contact site owner.', 'error', true);
                    },
                });
            });
        },
    }).catch(swal.noop);
}

function prompt(title, message, form_data) {
    title = title || 'Reset Password';
    message = message || 'Please type your email address';
    form_data = form_data || {};
    form_data[site.csrf_token] = site.csrf_token_value;

    swal({
        title: title,
        html: message,
        input: 'email',
        showCancelButton: true,
        allowOutsideClick: false,
        showLoaderOnConfirm: true,
        cancelButtonText: lang.cancel,
        confirmButtonText: lang.submit,
        preConfirm: function (email) {
            form_data['email'] = email;
            return new Promise(function (resolve, reject) {
                $.ajax({
                    url: site.base_url + 'forgot_password',
                    type: 'POST',
                    data: form_data,
                    success: function (data) {
                        if (data.status) {
                            resolve(data);
                        } else {
                            reject(data);
                        }
                    },
                    error: function () {
                        sa_alert('Error!', 'Ajax call failed, please try again or contact site owner.', 'error', true);
                    },
                });
            });
        },
    }).then(function (data) {
        sa_alert(data.status, data.message);
    });
}

function add_address(address) {
    address = address || {};
    var astate = '';
    if (istates) {
        var selectList = document.createElement('select');
        selectList.id = 'address-state';
        selectList.name = 'state';
        selectList.className = 'selectpickerstate mobile-device';
        selectList.setAttribute('data-live-search', true);
        selectList.setAttribute('title', 'State');
        let iskeys = Object.keys(istates);
        iskeys.map(s => {
            if (s != 0) {
                var option = document.createElement('option');
                option.value = s;
                option.text = istates[s];
                selectList.appendChild(option);
            }
        });
        astate = selectList.outerHTML;
    } else {
        astate =
            '<input name="state" value="' +
            (address.state ? address.state : '') +
            '" id="address-state" class="form-control" placeholder="' +
            lang.state +
            '">';
    }
    swal({
        title: address.id ? lang.update_address : lang.add_address,
        html:
            '<span class="text-bold padding-bottom-md">' +
            lang.fill_form +
            '</span>' +
            '<hr class="swal2-spacer padding-bottom-xs" style="display: block;"><form action="' +
            site.shop_url +
            'address" id="address-form" class="padding-bottom-md">' +
            '<input type="hidden" name="' +
            site.csrf_token +
            '" value="' +
            site.csrf_token_value +
            '">' +
            '<div class="row"><div class="form-group col-sm-12"><input name="line1" id="address-line-1" value="' +
            (address.line1 ? address.line1 : '') +
            '" class="form-control" placeholder="' +
            lang.line_1 +
            '"></div></div>' +
            '<div class="row"><div class="form-group col-sm-12"><input name="line2" id="address-line-2" value="' +
            (address.line2 ? address.line2 : '') +
            '" class="form-control" placeholder="' +
            lang.line_2 +
            '"></div></div>' +
            '<div class="row">' +
            '<div class="form-group col-sm-6"><input name="city" value="' +
            (address.city ? address.city : '') +
            '" id="address-city" class="form-control" placeholder="' +
            lang.city +
            '"></div>' +
            '<div class="form-group col-sm-6" id="istates">' +
            astate +
            '</div>' +
            '<div class="form-group col-sm-6"><input name="postal_code" value="' +
            (address.postal_code ? address.postal_code : '') +
            '" id="address-postal-code" class="form-control" placeholder="' +
            lang.postal_code +
            '"></div>' +
            '<div class="form-group col-sm-6"><input name="country" value="' +
            (address.country ? address.country : '') +
            '" id="address-country" class="form-control" placeholder="' +
            lang.country +
            '"></div>' +
            '<div class="form-group col-sm-12 margin-bottom-no"><input name="phone" value="' +
            (address.phone ? address.phone : '') +
            '" id="address-phone" class="form-control" placeholder="' +
            lang.phone +
            '"></div>' +
            '</form></div>',
        showCancelButton: true,
        allowOutsideClick: false,
        cancelButtonText: lang.cancel,
        confirmButtonText: lang.submit,
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if (!$('#address-line-1').val()) {
                    reject(lang.line_1 + ' ' + lang.is_required);
                }
                // if (!$('#address-line-2').val()) { reject('Line 2 is required'); }
                if (!$('#address-city').val()) {
                    reject(lang.city + ' ' + lang.is_required);
                }
                if (!$('#address-state').val()) {
                    reject(lang.state + ' ' + lang.is_required);
                }
                // if (!$('#address-postal-code').val()) { reject('Postal code is required'); }
                if (!$('#address-country').val()) {
                    reject(lang.country + ' ' + lang.is_required);
                }
                if (!$('#address-phone').val()) {
                    reject(lang.phone + ' ' + lang.is_required);
                }
                resolve();
            });
        },
        onOpen: function () {
            $('#address-line-1')
                .val(address.line1 ? address.line1 : '')
                .focus();
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
                $('.selectpickerstate').selectpicker({ modile: true });
                $('.selectpickerstate').selectpicker('val', address.state ? address.state : '');
            } else {
                var elements = document.querySelectorAll('.mobile-device');
                for (var i = 0; i < elements.length; i++) {
                    elements[i].classList.remove('mobile-device');
                }
                $('.selectpickerstate').selectpicker({ size: 5 });
                $('.selectpickerstate').selectpicker('val', address.state ? address.state : '');
            }
        },
    })
        .then(function (data) {
            var $form = $('#address-form');
            // resolve($form)
            $.ajax({
                url: $form.attr('action') + (address.id ? '/' + address.id : ''),
                type: 'POST',
                data: $form.serialize(),
                success: function (data) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                        return false;
                    } else {
                        sa_alert(data.status, data.message, data.level);
                    }
                },
                error: function () {
                    sa_alert('Error!', 'Ajax call failed, please try again or contact site owner.', 'error', true);
                },
            });
        })
        .catch(swal.noop);
}

function email_form() {
    swal({
        title: lang.send_email_title,
        html:
            '<div><span class="text-bold padding-bottom-md">' +
            lang.fill_form +
            '</span>' +
            '<hr class="swal2-spacer padding-bottom-xs" style="display: block;"><form action="' +
            site.shop_url +
            'send_message" id="message-form" class="padding-bottom-md">' +
            '<input type="hidden" name="' +
            site.csrf_token +
            '" value="' +
            site.csrf_token_value +
            '">' +
            '<div class="row"><div class="form-group col-sm-12"><input type="text" name="name" id="form-name" value="" class="form-control" placeholder="' +
            lang.full_name +
            '"></div></div>' +
            '<div class="row"><div class="form-group col-sm-12"><input type="email" name="email" id="form-email" value="" class="form-control" placeholder="' +
            lang.email +
            '"></div></div>' +
            '<div class="row"><div class="form-group col-sm-12"><input type="text" name="subject" id="form-subject" value="" class="form-control" placeholder="' +
            lang.subject +
            '"></div></div>' +
            '<div class="row"><div class="col-sm-12"><textarea name="message" id="form-message" class="form-control" placeholder="' +
            lang.message +
            '" style="height:100px;"></textarea></div></div>' +
            '</form></div>',
        showCancelButton: true,
        allowOutsideClick: false,
        cancelButtonText: lang.cancel,
        confirmButtonText: lang.submit,
        preConfirm: function () {
            return new Promise(function (resolve, reject) {
                if (!$('#form-name').val()) {
                    reject(lang.name + ' ' + lang.is_required);
                }
                if (!$('#form-email').val()) {
                    reject(lang.email + ' ' + lang.is_required);
                }
                if (!$('#form-subject').val()) {
                    reject(lang.subject + ' ' + lang.is_required);
                }
                if (!$('#form-message').val()) {
                    reject(lang.message + ' ' + lang.is_required);
                }
                if (!validateEmail($('#form-email').val())) {
                    reject(lang.email_is_invalid);
                }
                resolve();
            });
        },
        onOpen: function () {
            $('#form-name').focus();
        },
    })
        .then(function (data) {
            var $form = $('#message-form');
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function (data) {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                        return false;
                    } else {
                        sa_alert(data.status, data.message, data.level, true);
                    }
                },
                error: function () {
                    sa_alert('Error!', 'Ajax call failed, please try again or contact site owner.', 'error', true);
                },
            });
        })
        .catch(swal.noop);
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

var inputs = document.querySelectorAll('.file');
var submit_btn = document.querySelector('#submit-container');
if (submit_btn) {
    submit_btn.style.display = 'none';
}
Array.prototype.forEach.call(inputs, function (input) {
    var label = input.nextElementSibling,
        labelVal = label.innerHTML;

    input.addEventListener('change', function (e) {
        var fileName = '';
        if (this.files && this.files.length > 1) {
            fileName = (this.getAttribute('data-multiple-caption') || '').replace('{count}', this.files.length);
            if (submit_btn) {
                submit_btn.style.display = 'inline-block';
            }
        } else {
            fileName = e.target.value.split('\\').pop();
            if (submit_btn) {
                submit_btn.style.display = 'none';
            }
        }

        if (fileName) {
            label.querySelector('span').innerHTML = fileName;
            if (submit_btn) {
                submit_btn.style.display = 'inline-block';
            }
        } else {
            label.innerHTML = labelVal;
            if (submit_btn) {
                submit_btn.style.display = 'none';
            }
        }
    });
});
