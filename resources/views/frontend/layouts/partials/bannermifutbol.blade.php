<div class="gt3-page-title_wrapper">
    <div class="gt3-page-title"
    style="">
        <div class="gt3-page-title__inner ">
            <div class="container">
                <div class="gt3-page-title__content">
                    <div class="page_title">
                        <h1>
                            @yield('title')
                        </h1>
                    </div>
                    <div class="gt3_breadcrumb">
                        <div class="breadcrumbs">
                            <a href="{{ route('pedidos.view', ['store_slug' => $storeSlug]) }}" >
                               Home
                            </a>
                            <span class="gt3_pagination_delimiter">
                                </span>
                                <span class="current">
                                    @yield('title')
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
